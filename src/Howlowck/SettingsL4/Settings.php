<?php namespace Howlowck\SettingsL4;

use Howlowck\HtmlBuilder\Element;

class Settings {
    protected $db;
    protected $route;
    protected $form;
    protected $data;

    public function __construct($db, $route, $form, $config) {
        $this->db = $db;
        $this->route = $route;
        $this->config = $config;
        $this->form = $form;
        $this->form->setSettingInstance($this);
        $this->data = $this->fetchSettings();

    }
    public function all() {
        return array_except($this->data, array('created_at', 'updated_at'));
    }
    public function fetchSettings() {
        $table = $this->config['table'];
        $settings = $this->db->table($table)->first();
        if (is_null($settings)) {
            throw new \Exception("Your settings table has no data!", 1);
        }
        return (array) $settings;
    }

    public function routes() {
        $path = $this->config['route_path'];
        $before = $this->config['route_before'];
        $after = $this->config['route_after'];
        return $this->route->group(array('before' => $before, 'after' => $after), function () use ($path) {
            $this->route->resource($path , $this->config['controller']);
        });
    }
    
    public function get($name) {
        if ( ! array_key_exists($name, $this->data)) {
            throw new \Exception("Sorry! $name is not in the database", 1);
        }
        return $this->data[$name];
    }
    public function save($name, $value) {
        $table = $this->config['table'];
        $data[$name] = $value;
        $settings = $this->db->table($table)->update(array($name => $value));
    }
    public function getColumnType($name) {
        return $this->db->connection()->getDoctrineColumn('settings', $name)->getType()->getName();
    }
    public function __call($method, $parameters)
    {
        if (method_exists($this->form, $method))
        {
            return call_user_func_array(array($this->form, $method), $parameters);
        }

        throw new \BadMethodCallException("Sorry! $methodName does not exist", 1);
        
    }
}