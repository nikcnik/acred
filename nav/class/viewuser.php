<?php 

class ViewUser extends User{

	public function showAllUsers() {
		
		$datas = $this->getAllUsers();
		
		foreach ($datas as $data) {
			echo $data['uname']."<br>";
			echo $data['pass']."<br>";
		}

	}	

}

?>