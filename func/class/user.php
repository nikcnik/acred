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

	public function usersName($uid='')
	{	
		if (!empty($uid)) {
			$sql = "SELECT * FROM user WHERE id = $uid";
			$result = $this->connect()->query($sql);
			$numRows = $result->num_rows;
			if ($numRows>0) {
				if ($row = $result->fetch_assoc()) {
					$name = $row['name'];
					return $name;
				}
			}
		}
	}
	public function usersUname($uid='')
	{
		if (!empty($uid)) {
			$sql = "SELECT * FROM user WHERE id = $uid";
			$result = $this->connect()->query($sql);
			$numRows = $result->num_rows;
			if ($numRows>0) {
				if ($row = $result->fetch_assoc()) {
					$uname = $row['uname'];
					return $uname;
				}
			}
		}
	}

	public function usersContact($uid='')
	{
		if (!empty($uid)) {
			$sql = "SELECT * FROM user WHERE id = $uid";
			$result = $this->connect()->query($sql);
			$numRows = $result->num_rows;
			if ($numRows>0) {
				if ($row = $result->fetch_assoc()) {
					$contact = $row['contact'];
					return $contact;
				}
			}
		}
	}

	public function usersEmail($uid='')
	{
		if (!empty($uid)) {
			$sql = "SELECT * FROM user WHERE id = $uid";
			$result = $this->connect()->query($sql);
			$numRows = $result->num_rows;
			if ($numRows>0) {
				if ($row = $result->fetch_assoc()) {
					$email = $row['email'];
					return $email;
				}
			}
		}

	}

	public function editName($uid,$name,$valcode)
	{
		if (isset($uid) && isset($name) && isset($valcode)) {
			$id = mysqli_real_escape_string( $this->connect(), $uid);
			$code = mysqli_real_escape_string( $this->connect(), $valcode);
			$nName = mysqli_real_escape_string( $this->connect(), $name);

			$sql1 = "SELECT * FROM user WHERE id = $id AND code = '$code' ";
			$result1 = $this->connect()->query($sql1);
			$numRows1 = $result1->num_rows;
			if ($numRows1>0) {

				$sql = "UPDATE user SET name = '$nName' WHERE id = $id AND code = '$code' ";
				$this->connect()->query($sql);
				$_SESSION['name'] = $nName;
				return "1";
			} else{ return "0";}
			
			
		}
	}

	public function editUname($uid,$uname,$valcode)
	{
		if (isset($uid) && isset($uname) && isset($valcode)) {
			$id = mysqli_real_escape_string( $this->connect(), $uid);
			$code = mysqli_real_escape_string( $this->connect(), $valcode);
			$nUname = mysqli_real_escape_string( $this->connect(), $uname);

			$sql1 = "SELECT * FROM user WHERE id = $id AND code = '$code' ";
			$result1 = $this->connect()->query($sql1);
			$numRows1 = $result1->num_rows;
			if ($numRows1>0) {

				$sql = "UPDATE user SET uname = '$nUname' WHERE id = $id AND code = '$code' ";
				$this->connect()->query($sql);

				return "1";
			} else{ return "0";}
			
			
		}
	}

	public function editContact($uid,$contact,$valcode)
	{
		if (isset($uid) && isset($contact) && isset($valcode)) {
			$id = mysqli_real_escape_string( $this->connect(), $uid);
			$code = mysqli_real_escape_string( $this->connect(), $valcode);
			$nContact = mysqli_real_escape_string( $this->connect(), $contact);

			$sql1 = "SELECT * FROM user WHERE id = $id AND code = '$code' ";
			$result1 = $this->connect()->query($sql1);
			$numRows1 = $result1->num_rows;
			if ($numRows1>0) {

				$sql = "UPDATE user SET contact = '$nContact' WHERE id = $id AND code = '$code' ";
				$this->connect()->query($sql);

				return "1";
			} else{ return "0";}
			
			
		}
	}

	public function editEmail($uid,$email,$valcode)
	{
		if (isset($uid) && isset($email) && isset($valcode)) {
			$id = mysqli_real_escape_string( $this->connect(), $uid);
			$code = mysqli_real_escape_string( $this->connect(), $valcode);
			$nEmail = mysqli_real_escape_string( $this->connect(), $email);

			$sql1 = "SELECT * FROM user WHERE id = $id AND code = '$code' ";
			$result1 = $this->connect()->query($sql1);
			$numRows1 = $result1->num_rows;
			if ($numRows1>0) {

				$sql = "UPDATE user SET email = '$nEmail' WHERE id = $id AND code = '$code' ";
				$this->connect()->query($sql);

				return "1";
			} else{ return "0";}
			
			
		}
	}

	public function editPass($uid,$password,$valcode)
	{
		if (isset($uid) && isset($password) && isset($valcode)) {
			$id = mysqli_real_escape_string( $this->connect(), $uid);
			$code = mysqli_real_escape_string( $this->connect(), $valcode);
			$nPassword = mysqli_real_escape_string( $this->connect(), $password);

			$sql1 = "SELECT * FROM user WHERE id = $id AND code = '$code' ";
			$result1 = $this->connect()->query($sql1);
			$numRows1 = $result1->num_rows;
			if ($numRows1>0) {

				$sql = "UPDATE user SET pass = '$nPassword' WHERE id = $id AND code = '$code' ";
				$this->connect()->query($sql);

				return "1";
			} else{ return "0";}
			
			
		}
	}


	public function regUser( $name , $user , $type , $area=0 ) {

		$nName = mysqli_real_escape_string( $this->connect(), $name);
		$nUser = mysqli_real_escape_string( $this->connect(), $user);
		$nType = mysqli_real_escape_string( $this->connect(), $type);
		$nArea = mysqli_real_escape_string( $this->connect(), $area);

		$password = "123456";
		$nPass = password_hash( $password , PASSWORD_DEFAULT);

		$verCode = uniqid();

		$getType = "SELECT title FROM type WHERE id = $nType ";
		$typeResult = $this->connect()->query($getType);
		$succType = '';
		while ($row = $typeResult->fetch_assoc()) {
			$succType = $row['title'];
		}

		$verUsPas = "SELECT uname FROM user WHERE uname = '$nUser' ";
		$verResult = $this->connect()->query($verUsPas);
		$verResultNum = $verResult->num_rows;
		
		if ($verResultNum > 0) {
			header('Location: ../admin.php?error=invUser'); //USER ALREADY TAKEN MASSAGE
		}else{
			$sql = "INSERT INTO user( `name`, `uname`, `type`, `pass`, `code` ) 
					VALUES ( '$nName', '$nUser', '$nType' , '$nPass' , '$verCode' )";

			$this->connect()->query($sql);

			header('Location: ../admin.php?succ=1&regName='.$nName.'&regUser='.$nUser.'&regPass='.$password.'&regType='.$succType.'&regArea='.$nArea.'&verCode='.$verCode);
		}

		/*
		UNFINISHED...
		CODE for UPDATE SET.. area for users
		*/	

	}

	public function viewUser()
	{
		$sql = "SELECT user.name , type.title, user.uname, user.stat , user.code FROM user INNER JOIN type ON user.type = type.id ORDER BY type.title DESC";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows>0) {
			while($row = $result->fetch_assoc() ){
				
				$name 	= $row['name'];
				$title 	= $row['title'];
				$uname 	= $row['uname'];
				$stat 	= $row['stat'];
				$code  	= $row['code'];

				if ($title!='admin') {
					if ($stat == 0) {
						$stat = "PRE-REG";
					} elseif ($stat == 1 ) {
						$stat = "VALID";
					}
					
					echo "
						<tr>
						  <td  >".strtoupper($name)."</td>

						  <td  >".strtoupper($title)."</td>
						  <td  >".$uname."</td>
						  <td  >".strtoupper($stat)."</td>
						  <td  >".$code."</td>
						</tr>
					";	
				}
				

			}
		}
	}

	//USERS PRE REGISTRATION
	// VALIDATION of CODE
	public function verCode($id,$code)
	{
		$nId 	= mysqli_real_escape_string( $this->connect(), $id);
		$nCode 	= mysqli_real_escape_string( $this->connect(), $code);

		$sql = "SELECT stat FROM user WHERE id = $nId AND code = '$nCode' ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows>0) {
			echo "ok";
			//update stat = 1
			$updSql = "UPDATE user SET stat = 2 WHERE id = $id";
			$this->connect()->query($updSql);
			return 'ok';
		}else{
			echo "invalid";
			return 'invalid';
		}
	}

	//CHANGE OF PASSWORDS OR PASSWORD AND FILL UP ALL USER DATAS
	public function preReg($id)
	{
		$sql = "SELECT * FROM user WHERE id = $id";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows>0) {
			while ($row = $result->fetch_assoc()) {
				$user 	= $row['uname'];
				$name  	= $row['name'];
				$getid 	= $row['id'];
				
				echo "
					<input type=\"hidden\" name=\"id\" value=\"$getid\">

					<div class=\"col-lg-4\">name:</div>
					<div class=\"col-lg-8\">$name</div>
					
					<div class=\"col-lg-4\">username:</div>
					<div class=\"col-lg-8\">
						<input type=\"text\" class=\"form-control form-control-sm\" id=\"pre-user\" name=\"user\" value=\"$user\">
					</div>

					<div class=\"col-lg-4\">new password:</div>
					<div class=\"col-lg-8\">
						<input type=\"password\" class=\"form-control form-control-sm\" id=\"pre-nPass\" name=\"nPass\" placeholder=\"enter new password minimum of 6...\">
					</div>

					<div class=\"col-lg-4\">re-enter new pass:</div>
					<div class=\"col-lg-8\">
						<input type=\"password\" class=\"form-control form-control-sm\" id=\"pre-rnPass\" name=\"rnPass\" placeholder=\"re-enter new password minimum of 6...\">
					</div>

					<div class=\"col-lg-4\">*address:</div>
					<div class=\"col-lg-8\">
						<input type=\"text\" class=\"form-control form-control-sm\" id=\"pre-address\" name=\"address\" placeholder=\"e.g: taguig city\">
					</div>
					
					<div class=\"col-lg-4\">*contact no.:</div>
					<div class=\"col-lg-8\">
						<input type=\"text\" class=\"form-control form-control-sm\" id=\"pre-contact\" name=\"contact\" placeholder=\"e.g: 0919-45987415\">
					</div>

					<div class=\"col-lg-4\">*email:</div>
					<div class=\"col-lg-8\">
						<input type=\"text\" class=\"form-control form-control-sm\" id=\"pre-email\" name=\"email\" placeholder=\"e.g: email@gmail.com\">
					</div>
					";


			}
		}else{
			echo "INVALID USER";
		}
	}

	public function preRegNewData($id, $user, $nPass, $rnPass, $address, $contact, $email)
	{
		$pass = password_hash( $nPass , PASSWORD_DEFAULT); //HASH PASSWORD
		$presUser = "SELECT * FROM user WHERE uname = '$user' AND id = $id "; //CHECK IF USING SAME USERNAME
		$preuResult = $this->connect()->query($presUser);
		$preNumRows = $preuResult->num_rows;
		if ($preNumRows>0) {
			$sql = "UPDATE user 
					SET uname 	= '$user' , 
						pass 	= '$pass' , 
						address = '$address' , 
						contact = '$contact' , 
						email 	= '$email' ,
						stat 	= 1 
					WHERE id 	= $id
					";
			$this->connect()->query($sql);
			return "success";
		}else{
			$userSql = "SELECT * FROM user WHERE uname = '$user' "; //CHECK IF USERNAME ALREADY EXIST
			$uResult = $this->connect()->query($userSql);
			$numRows = $uResult->num_rows;
			if ($numRows>0) {
				return "uExist";			
			}else{
				$sql = "UPDATE user 
						SET uname 	= '$user' , 
							pass 	= '$pass' , 
							address = '$address' , 
							contact = '$contact' , 
							email 	= '$email' ,
							stat 	= 1 
						WHERE id 	= $id
						";
				$this->connect()->query($sql);
			}		
		}


	}
}

?>