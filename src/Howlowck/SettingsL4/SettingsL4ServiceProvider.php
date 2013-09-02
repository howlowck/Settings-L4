<?php namespace Howlowck\SettingsL4;

use Illuminate\Support\ServiceProvider;
use Howlowck\HtmlBuilder\Factory as Builder;
class SettingsL4ServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('howlowck/settings-l4');

		$this->app['settings'] = $this->app->share(function($app){
			$db = $app['db'];
		   	$builder = new Builder();
		   	$route = $app['route']->getFacadeRoot();
		   	$config = $app['config']->get('settings-l4::config');
		   	$form = new Form($builder, $config);
		    $settings = new Settings($db, $route, $form, $config);
		    return $settings;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('settings');
	}

}