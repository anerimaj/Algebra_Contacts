<?php

class DB
{
	private static $_instance = null;
	private $_config;
	private $_connection;
	private $_query;
	private $_error = false;
	private $_results;
	private $_count = 0;
	
	public static function getInstance()
	{
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		
		return self::$_instance;
	}
	
	private function __construct()
	{
		$this->_config = Config::get('database');
		$driver = $this->_config['driver'];
		$host = $this->_config[$driver]['host'];
		$db = $this->_config[$driver]['db'];
		$user = $this->_config[$driver]['user'];
		$pass = $this->_config[$driver]['pass'];
		
		$this->_connection = new PDO("{$driver}:host={$host};dbname={$db}", $user, $pass);
	}

	private function __clone(){}
	
	public function query($sql, $params = array())
	{
		$this->_error = false;

		if($this->_query = $this->_connection->prepare($sql)) {
			$x = 1;
			if(!empty($params)) {
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll($this->_config['fetch']);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
			
		}
		
		return $this;
		
	}
	
	private function action($action, $table, $where = array())
	{
		if(count($where) === 3) {
			
			$operators = array('=','<','>','<=','>=');
			
			$field    = $where[0];
			$operator = $where[1];
			$value    = $where[2];
			
			if(in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
			
		} else {
			$sql = "{$action} FROM {$table}";
			if(!$this->query($sql)->error()) {
				return $this;
			}
			
		}
		
		return false;
	}
	
	
	### GETERI ###
	public function connection()
	{
		return $this->_connection;
	}
	
	public function error()
	{
		return $this->_error;
	}
	
	public function first()
	{
		return $this->_results[0];
	}
	
	public function results()
	{
		return $this->_results;
	}
	
	public function count()
	{
		return $this->_count;
	}
}






