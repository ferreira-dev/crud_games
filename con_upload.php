<?php

define('HOST', 'marcos.central.illimitar.com.br');
define('USER', 'root');
define('PASS', '!@A7v400mx');
define('DBNAME', 'crudgames');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
