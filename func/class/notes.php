<?php 

class notes extends dbh{

	public function inputNotes( $user_id , $content_id , $input_notes)
	{
		$id 	= mysqli_real_escape_string( $this->connect(), $content_id);
		$userId = mysqli_real_escape_string( $this->connect(), $user_id);
		$notes 	= mysqli_real_escape_string( $this->connect(), $input_notes);

		date_default_timezone_set('Asia/Manila');
		$current_date = date('h:i a M. j, Y');
		$db_current_date = date('Y-m-d H:i:s');
		$notes = str_replace('\r\n', '<br>', $notes);
		$sql = '';
		$output = '';

		$sqlUser = "SELECT type , name FROM user WHERE id = $userId ";
		$resultUser = $this->connect()->query($sqlUser);
		$numRowsUser = $resultUser->num_rows;

		if ($numRowsUser>0) {
			if ($row = $resultUser->fetch_assoc()) {
				$name = $row['name'];
				if ($row['type']==1) {
					$sql = "INSERT INTO notes (content , notes , date_time , view_staff , user_id) VALUES ($id , '$notes' , '$db_current_date' , 1 , $userId )";

					$output = "<div class=\"row\"> 
									<div class=\"col-lg-12 alert alert-success\" style=\"border-radius:5px; border:1px solid #fff; color:#111; font-size:11px; position:relative;  background:#fff; box-shadow:1px 1px 5px #cfcfcf;\">
										<div style=\"position:absolute; padding:2px 5px 2px 2px; border-radius:10px; top:-15px; left:-20px;  background:#007bff; color:#fff; \"><i class=\"fa fa-user-circle\"></i> You</div>
										$notes <br> <i style=\"font-size:8px; float:right;\">$current_date</i>
									</div>
							 	</div>";

				} elseif ($row['type']==2) {
					$sql = "INSERT INTO notes (content , notes , date_time , view_evaluator , user_id) VALUES ($id , '$notes' , '$db_current_date' , 1 , $userId )";	
					$output = "	<div class=\"row\"> 
									<div class=\"col-lg-12 alert alert-primary\" style=\"border-radius:5px; border:1px solid #fff; color:#111; font-size:11px; position:relative;  background:#fff; box-shadow:1px 1px 5px #cfcfcf;\">
										<div style=\"position:absolute; padding:2px 5px 2px 2px; border-radius:10px; top:-15px; left:-20px;  background:#007bff; color:#fff; \"><i class=\"fa fa-user-circle\"></i> You</div>
										$notes <br><i style=\"font-size:8px; float:right;\">$current_date</i>
									</div>
							 	</div>";

				} elseif ($row['type']==3) {
					$sql = "INSERT INTO notes (content , notes , date_time , view_dean , user_id) VALUES ($id , '$notes' , '$db_current_date' , 1 , $userId )";	
					$output = "	<div class=\"row\"> 
									<div class=\"col-lg-12 alert alert-danger\" style=\"border-radius:5px; border:1px solid #fff; color:#111; font-size:11px; position:relative;  background:#fff; box-shadow:1px 1px 5px #cfcfcf;\">
										<div style=\"position:absolute; padding:2px 5px 2px 2px; border-radius:10px; top:-15px; left:-20px;  background:#007bff; color:#fff; \"><i class=\"fa fa-user-circle\"></i> You</div>
										$notes <br><i style=\"font-size:8px; float:right;\">$current_date</i>
									</div>
							 	</div>";
				}

				if (!empty($sql)) {
					$this->connect()->query($sql);
					
					return $output;
					
				}
				
			}
		}



	}

	public function viewNotes( $user_id,  $content_id)
	{
		$id 	= mysqli_real_escape_string( $this->connect(), $content_id );
		$presuserId	= mysqli_real_escape_string( $this->connect(), $user_id );

		$sql = "SELECT notes, date_time, user_id FROM notes WHERE content = $id ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		$all_notes = '';

		if ($numRows > 0 ) {

			while ($row = $result->fetch_assoc()) {
			
				$notes = $row['notes'];
				date_default_timezone_set('Asia/Manila');
				$d_time = date( 'h:i a M. j, Y' , strtotime($row['date_time']));
				$userId = $row['user_id']; 

				$sqlUser = "SELECT type, name FROM user WHERE id = $userId ";
				$resultUser = $this->connect()->query($sqlUser);
				$numRowsUser = $resultUser->num_rows;

				if ($numRowsUser>0) {
					if ($rowUser = $resultUser->fetch_assoc()) {
						$name = $rowUser['name'];
						$u_icon = "<div style=\"position:absolute; padding:2px 5px 2px 2px; border-radius:10px; top:-15px; left:-20px; border:solid 1px #cfcfcf; background:#fff;\"><i class=\"fa fa-user-circle\"></i> $name </div>";
						
						if ($presuserId==$userId) {
							$u_icon = "<div style=\"position:absolute; padding:2px 5px 2px 2px; border-radius:10px; top:-15px; left:-20px;  background:#007bff; color:#fff; \"><i class=\"fa fa-user-circle\"></i> You</div>";
						}

						if ($rowUser['type']==1) {
							$all_notes = $all_notes."
								<div class=\"row\" style=\"width:auto;\"> 
									<div class=\"col-lg-12 alert alert-success\" style=\"border-radius:5px; border:1px solid #fff; color:#111; font-size:11px; position:relative; background:#fff; box-shadow:1px 1px 5px #cfcfcf; \">
										$u_icon
										$notes <br> <i style=\"font-size:8px; float:right;\">$d_time</i>
									</div>
								 </div>
							";
						} elseif ($rowUser['type']==2) {
							$all_notes = $all_notes."
								<div class=\"row\" style=\"width:auto;\"> 
									<div class=\"col-lg-12 alert alert-primary\" style=\"border-radius:5px; border:1px solid #fff; color:#111; font-size:11px; position:relative; background:#fff; box-shadow:1px 1px 5px #cfcfcf; \">
										$u_icon
										$notes <br><i style=\"font-size:8px; float:right;\">$d_time</i>
									</div>
								 </div>
							";
						} elseif ($rowUser['type']==3) {
							$all_notes = $all_notes."
								<div class=\"row\" style=\"width:auto;\"> 
									<div class=\"col-lg-12 alert alert-danger\" style=\"border-radius:5px; border:1px solid #fff; color:#111; font-size:11px; position:relative; background:#fff; box-shadow:1px 1px 5px #cfcfcf;\">
										$u_icon
										$notes <br><i style=\"font-size:8px; float:right;\">$d_time</i>
									</div>
							 	</div>
							";
						}

						
					}
				}

			}
		}

		return $all_notes;

	}



	public function changeNotiStat($user_id ,$content_id)
	{
		$id = mysqli_real_escape_string( $this->connect(), $content_id);
		$userId = mysqli_real_escape_string( $this->connect(), $user_id);
		$sql = '';

		$sqlUser = "SELECT type FROM user WHERE id = $userId ";
		$resultUser = $this->connect()->query($sqlUser);
		$numRowsUser = $resultUser->num_rows;

		if ($numRowsUser>0) {
			if ($row = $resultUser->fetch_assoc()) {
				
				if ($row['type']==1) {
					$sql = "UPDATE notes SET view_staff = 1 WHERE content = $id";
				} elseif ($row['type']==2) {
					$sql = "UPDATE notes SET view_evaluator = 1 WHERE content = $id";
				} elseif ($row['type']==3) {
					$sql = "UPDATE notes SET view_dean = 1 WHERE content = $id";
				}

				if (!empty($sql)) {
					$this->connect()->query($sql);
					return 1;	
				}
			}
		}

	}
}
?>