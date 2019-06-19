<?php

abstract class Model
{
	private $pdo;
	private $rowCount  = 0;
	private $errorInfo = array();
	protected $tables;
	
	public function __construct()
	{
		try
		{ 
			require ROOT.'classified/database.php';
			$driver = "{$server['driver']}: host={$server['host']}; dbname={$server['name']};";
			$this->pdo = new PDO($driver, $server['user'], $server['pass']);
			#$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			#$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE); // there are other ways to set attributes. this is one
			
			$connections = Session::getTemp('connections') ?: 1;
			Session::setTemp('connections', $connections++);
		}
		catch(PDOException $e)
		{
			die( __CLASS__.': '.$e->getMessage() );
		}
		
		// If connected, $tables come from database.php
		$this->tables = $tables;
	}
		
	protected function prepare($sql)
	{	
		return $this->pdo->prepare($sql);	
	}
	
	protected function execute($stmt, $fetch = false)
	{
		if( $stmt->execute() )
		{
			$this->setRowCount( $stmt->rowCount() );
			return ($fetch) ? $stmt->$fetch() : true;
		}
		$this->setErrorInfo( $stmt->errorInfo() );
		return false;
	}
	
	protected function query($sql)
	{
		$stmt = $this->pdo->query($sql);
		if($stmt)
		{	
			return $stmt->fetchAll();
		}
		return false;
	}
	
	protected function getLastInsertId()
	{
		return (int) $this->pdo->lastInsertId();
	}
	
	protected function getLastInsertIdSelected($table)
	{
		$sql = "SELECT LAST_INSERT_ID('id') AS 'lastid' FROM {$table}";
		$result = $this->query($sql);
		return $result[0]['lastid'];
	}
	
	protected function getIdentityInserted()
	{
		$sql = "SELECT @@identity AS id";
		return $this->query($sql);
	}
	
	protected function getMaxId($table)
	{
		$sql = "SELECT MAX(id) AS maxid FROM {$table} LIMIT 1";
		if( $result = $this->query($sql) )
		{
			return (int) $result[0]['maxid'];
		}
		return false;
	}
	
	protected function getTableCount($table)
	{
		$sql = "SELECT COUNT(*) AS count FROM {$table}";
		return $this->query($sql);
	}
	
	private function setRowCount($count)
	{
		$this->rowCount = $count;
	}
	
	public function getRowCount()
	{
		return $this->rowCount;
	}
	
	private function setErrorInfo($data)
	{
		$this->errorInfo['sqlstate'] = $data[0];
		$this->errorInfo['code'] 		 = $data[1];
		$this->errorInfo['message']  = $data[2];
	}
	
	public function getErrorInfo($key = false)
	{		
		if($key && is_string($key))
		{
			return $this->errorInfo[$key];
		}
		return $this->errorInfo;
	}
	
	public function getErrorDuplicate()
	{
		if($this->errorInfo['code'] == 1062)
		{
			return true;
		}
		return false;
	}
	
	public function __clone(){ return false; }
	public function __destruct(){ return false; }
}