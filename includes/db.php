<?php
// Connect to the demo database file
$db_hostname = $config['db']['host'];
$db_name     = $config['db']['name'];
$db_username = $config['db']['user'];
$db_password = $config['db']['pass'];

ORM::configure(array(
    'connection_string' => 'mysql:host='.$db_hostname.';dbname='.$db_name.'',
    'username' => ''.$db_username.'',
    'password' => ''.$db_password.''
));

//ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
ORM::configure('error_mode', PDO::ERRMODE_WARNING);
ORM::configure('return_result_sets', true);
ORM::configure('logging', true);
//ORM::configure('caching', true);
//ORM::configure('caching_auto_clear', true);
//ORM::clear_cache();