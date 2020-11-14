<?php

use App\Classes\Request;

require 'vendor/autoload.php';

$request = new Request($_SERVER['REQUEST_METHOD'], file_get_contents('php://input'));

print_r($request->processRequest());
