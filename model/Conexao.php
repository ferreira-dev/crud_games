<?php  

class Conexao {

	public static $instance;

	public static function get_instance() {
		if(!isset(self::$instance)) {
			// self::$instance = new PDO("mysql:host=localhost;dbname=crudgames;", "root", "102030", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			self::$instance = new PDO("mysql:host=marcos.central.illimitar.com.br;dbname=crudgames;", "root", "!@A7v400mx", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return self::$instance;

	}

}

?>