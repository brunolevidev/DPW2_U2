<?php
require '/var/www/html/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html');
$dotenv->load();

$base_url = $_ENV['BASE_URL'];
$mysql_host = $_ENV['MARIADB_HOST'];
$mysql_database = $_ENV['MARIADB_DATABASE'];
$mysql_user = $_ENV['MARIADB_USER'];
$mysql_password = $_ENV['MARIADB_PASSWORD'];
$mysql_port = $_ENV['MARIADB_PORT'];