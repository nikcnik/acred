<?php 

class dbh {
	
	private $servername;
	private $username;	
	private $password;	
	private $dbname;

	protected function connect()
	{
		$this->servername 	= "bdjpcjzyaquqq3qjqsxl-mysql.services.clever-cloud.com";
		$this->username 	= "ubikxnxdur57shta";
		$this->password 	= "oUhyior9J0Aaltc3aSDx";
		$this->dbname 		= "bdjpcjzyaquqq3qjqsxl";

		$conn = new mysqli($this->servername, $this->username , $this->password, $this->dbname);

		return $conn;

	}	

}

?>
