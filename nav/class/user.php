<?php 

class User extends dbh{

	protected function getAllUsers() {
		
		$sql = "SELECT * FROM user";
		$result = $this->connect()->query($sql); 
		$numRows = $result->num_rows;
		
		if ($numRows > 0) {
			while ($row= $reuslt->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;					
		}				
	}

	public function userLogin($user, $pass)	{
		
		$username = mysqli_real_escape_string( $this->connect(), $user );
		$password = mysqli_real_escape_string( $this->connect(), $pass ); 
		

		$sql = "SELECT id, stat , type , pass ,name FROM user WHERE uname = '$username' ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;

		if ($numRows > 0) {
			if ($row = $result->fetch_assoc()) {
				//De-hashing the password
				$passCheck = password_verify( $password , $row['pass'] );
				if ($passCheck == false) {
					header("Location: ../index.php?login=error");
					exit();
				} elseif ($passCheck == true) {
					
					$_SESSION['type'] = $row['type'];
					$_SESSION['userStat'] = $row['stat'];
					$_SESSION['userId'] = $row['id'];
					$_SESSION['name']	= $row['name'];

					if ($_SESSION['type']=='1') {
					  header("Location: ../staff.php");
					  exit();
					}elseif($_SESSION['type']=='2'){
					  header("Location: ../evaluator.php");
					  exit();
					}elseif($_SESSION['type']=='3'){
					  header("Location: ../dean.php");
					  exit();
					}elseif($_SESSION['type']=='4'){
					  $_SESSION['adminTab'] = 'accReg';
					  header("Location: ../admin.php");
					  exit(); 
					}					
				}


			}
		}else{
			header("Location: ../index.php?login=error");
		}
	}

	

}

?>