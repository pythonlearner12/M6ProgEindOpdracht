<?php

$envFilePath = __DIR__."/.env";
if (!file_exists($envFilePath)) {
    die('geen .env bestand gevonden');
}
$env = parse_ini_file($envFilePath);

function database_connect() {
    global $env;
    $connection = new mysqli('mariadb', $env['MYSQL_USER'], $env['MYSQL_PASSWORD'], $env['MYSQL_DATABASE']);
    if ($connection->connect_errno) {
        die("failed to connect $connection->connect_error");
    }
    return $connection;
}
