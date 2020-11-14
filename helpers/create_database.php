<?php

use Model\Database;

require_once '../vendor/autoload.php';

$database = new Database('mysql', '127.0.0.1', 'crud_clientes', 'root');

$database->createDb();
$database->createTable();
