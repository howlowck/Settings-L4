<?php namespace Howlowck\SettingsL4;

class Form {
    protected $config;
    protected $builder;
    protected $settingInstance;
    public function __construct($builder, $config) {
        $this->builder = $builder;
        $this->config = $config;
    }
    public function setSettingInstance($instance) {
        $this->settingInstance = $instance;
    }
    public function getUpdateUrl($name) {
        $path = $this->config['route_path'];
        return url("$path/$name");
    }
    public function getActionUrl() {
        return $this->config['controller'].'@update';
    }
    public function getTitle($name) {
        $name = snake_case($name);
        $name = str_replace("_", " ", $name);
        $name = ucwords($name);
        return $name;
    }
    public function getField($name) {
        $value = $this->settingInstance->get($name);
        $formType = $this->getFormType($name);
        if ($formType == 'textarea') {
            $textarea = $this->builder->make('textarea');
            $textarea->addAttribute(array('name' => $name));
            $textarea->addContent($value);
            return $textarea->getHtml();
        }
        $input = $this->builder->make('input');
        $input->addAttribute(array('type' => $formType, 'value' => $value, 'name' => $name));
        return $input->getHtml();
    }
    public function getFormType($name) {
        $colType = $this->settingInstance->getColumnType($name);
        if (array_key_exists($colType, $this->config['form_types'])) {
            return $this->config['form_types'][$colType];
        }
        return $this->config['form_types']['*'];
    }
}