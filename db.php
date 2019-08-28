<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database
{
	protected $host='';
	protected $username='';
	protected $password='';
	protected $dbName='';

	public function dbInfo($h,$u,$pass,$db)
	{
		$this->host=$h;
		$this->username=$u;
		$this->password=$pass;
		$this->dbName=$db;
	}
	
	public function connect()
	{
		return new mysqli($this->host, $this->username, $this->password, $this->dbName);
	}
	public function getlocation($conn,$table)
	{
		return $conn->query('select * from '.$table);
	}
	public function delete($conn,$table,$where)
	{
		$conn->query('DELETE FROM '.$table.' WHERE '.$where);
	}
	public function insert($conn,$table,$data)
	{
		$column=array();
		$values=array();
		foreach ($data as $key => $value) {
			 array_push($column, $key);
			 array_push($values, '"'.$value.'"');
		}
		$cols=implode(',',$column);
		$val=implode(',',$values);
	
		$conn->query('insert into '.$table.' ('.$cols.') values('.$val.')');
	}
}



?>