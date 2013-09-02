<?php

return array(
    'table' => 'settings',
    'db' => 'db', // or redis
    'user_column' => '',
    'db_connection' => 'mysql',
    'controller' => 'SettingsController',
    'route_path' => 'settings',
    'route_before' => '',
    'route_after' => '',
    'form_types' => array(
            '*' => 'text', //Default
            'string' => 'text',
            'text' => 'textarea',
            'integer' => 'number',
            // 'date' => 'date',
            // 'datetime' => 'datetime'
    ),
);