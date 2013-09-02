# Settings Package Laravel

This package is created to easily change application-level settings that Administator can change.

## Setup 

1. Include ``` "howlowck/html-builder": "dev-master", ``` in your application composer.json
2. run ``` composer update ```
3. Add service provider by adding ``` 'Howlowck\SettingsL4\SettingsL4ServiceProvider', ``` in ``` app/config/app.php ```
4. Add Setting Facade by adding ``` 'Setting' => 'Howlowck\SettingsL4\Facade\Setting' ``` in ``` app/config/app.php ```
5. Run config:publish
6. generate your own migration with the table name 'settings'. (if you want to use a table named other than 'settings', please change the 'table' config item in the configuration file)

## Configuration
In ``` app/config/howlowck/settings-l4/config.php ```

``` table ``` --- table name
``` db ``` --- whether to use db or redis
``` user_column ``` --- the column name of user if you want to capture who changed the setting (not implemented)
``` controller ``` --- the controller name
``` route_path ``` --- the route path to get to the settings resource controller
``` route_before ``` --- the filter string for before running to the route
``` route_after ``` --- the filter string after running to the route
``` form_types ``` --- the associated array for the input types are is associated with the database data fields, * is default

## To Use
The Settings Package allows you to interact your settings in various ways.

### Basic Usage
``` Setting::get($settingName) ``` returns the value of the setting with that name
``` Setting::set($settingName, $settingValue) ``` sets the value to the setting name
``` Setting::all() ``` returns all the settings in an array

### Built-in views and Routes
1. Include ``` Setting::route() ``` in your routes.php this will set up a route group for your settings controller.  You can change the path and before/after filters in the config file.
2. Copy the Settings Controller from ``` vendors/howlowck/settings-l4/src/controllers/SettingsController.php ``` to your controllers folder.  Feel free to change the name of the controller to anything you like, you just have to change the 'controller' configuration item in the config file.
3. Run asset:publish
4. Now when you go to any path with ``` path/to/settings/settingName/edit ``` you will see a UI that allows you to edit the value.

The available paths are only ``` path/to/settings ``` and ```path/to/settings/settingName```

### Making your own views
If you prefer to make your own views you can simply use ```Setting::getTitle($settingName)```, ```Setting::getField($settingName)```, ```Settings::getUpdateUrl($settingName)```... all of which should be self-explainatory.
