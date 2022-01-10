<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '102030');
define('DBNAME', 'crudgames');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
