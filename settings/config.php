<?php

ini_set('display_errors', 1);

define('DSN', 'mysql:host=localhost;dbname=advanced_bbs_db');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'zaq123');

define('SITE_URL', $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');
