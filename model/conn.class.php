<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 06/07/2018
 * Time: 12:30
 */


class Conn
{
    private $_connection;
	private static $_instance; //The single instance
	private $_host;
	private $_username;
	private $_password;
	private $_database;
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
	    //parseo los datos de db.ini y los paso a variables privadas

        $db_config = parse_ini_file(dirname(__DIR__) . "/conf/db.ini");
        $this->_host = $db_config['host_db'];
        $this->_username = $db_config['usuario_db'];
        $this->_password = $db_config['password_db'];
        $this->_database = $db_config['nombre_db'];

		$this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        $this->_connection->set_charset("utf8");
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(),
				 E_USER_ERROR);
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
}//EOC