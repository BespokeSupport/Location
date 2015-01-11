<?php

if (file_exists(dirname(__FILE__).'/../vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/../vendor/autoload.php';
}


// load in credentials
if (file_exists(dirname(__FILE__).'/credentials.php')) {
    include_once dirname(__FILE__).'/credentials.php';
} else {
    define('CREDENTIALS_TYPE', 'mysql');
    define('CREDENTIALS_HOST', 'localhost');
    define('CREDENTIALS_NAME', 'tests');
    define('CREDENTIALS_USER', 'root');
    define('CREDENTIALS_PASS', '');
}

/**
 * @return \PDO
 */
function getPdo()
{
    $pdo = new \PDO(
        CREDENTIALS_TYPE.':host='.CREDENTIALS_HOST.';dbname='.CREDENTIALS_NAME,
        CREDENTIALS_USER,
        CREDENTIALS_PASS
    );

    return $pdo;
}