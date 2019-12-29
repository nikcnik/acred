<?php 

class upload extends dbh{

	public function uploadFile($content_id , $user_id , $name , $location , $filename ) {
		
		$sql = "INSERT INTO doc_loc (content , user_encoder , name , loc , viewStat)
				VALUES ('$content_id' , '$user_id' , '$name' , '$location' , 0) " ;
		$this->connect()->query($sql);

		$showName = $filename;
		if (strlen($filename) >20) {
			$showName = substr($filename, 0, 20)."...";
		}
		echo "
			<li class=\"row\">
			  <i class=\"col-sm-2 fa fa-file-alt m-view-upload\" docu-name=\"$location\" style=\"font-size:18px;\"></i> 
			  <strong class=\"col-sm-7\" style=\"font-weight: normal; font-size:12px;\" title=\"$filename\">$showName</strong> 
			  <button class=\"col-sm-1 btn btn-default up-bot-switch\" 
			  					data-id=\"$location\"
					  		  	data-state=\"new\"  
					  		  	style=\"font-size: 12px; padding:0; height: 20px;\">off</button>";
		
		$location = str_replace('docu/', '', $location);
		$location = str_replace('.pdf', '', $location);

		 echo   "<i class=\"col-sm-1 btn btn-danger fa fa-trash-alt m-delete-file\" data-id=\"$location\" title=\"delete\" style=\"font-size:11px; height:22px; margin-left:5px;\"></i>

			</li>";

	}

	public function uploadViewStaff($content_id )
	{
		$sql = "SELECT * FROM doc_loc WHERE content = $content_id";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()) {

				$name = $row['name'];
				$loc  = $row['loc'];
				$id   = $row['id'];
				$stat = $row['viewStat'];

				$class = '';
				$cur_state = '';

				$showName = $name;
				if (strlen($name)>20) {
					$showName = substr($name, 0, 20)."...";
				}

				if ($stat == 0) {
					$class = 'btn-default';
					$cur_state = 'off';
				} elseif ($stat == 1) {
					$class = 'btn-primary';
					$cur_state = 'on';
				}

				echo "
					<li class=\"row\">
					  	<i class=\"col-sm-2 fa fa-file-alt m-view-upload\" docu-name=\"$loc\" style=\"font-size:18px; \"></i> 

					  	<strong class=\"col-sm-7\" style=\"font-weight: normal; font-size:12px;\" title=\"$name\">$showName</strong> 
					  	<button class=\"col-sm-1 btn $class up-bot-switch\"
					  		  data-id=\"$id\"
					  		  data-state=\"$cur_state\" 
							  style=\"font-size: 12px; padding:0; height: 20px;\">
							$cur_state
				      	</button>";

				$loc = str_replace('docu/', '', $loc);
				$loc = str_replace('.pdf', '', $loc);

				echo  "<i class=\"col-sm-1 btn btn-danger fa fa-trash-alt m-delete-file\" data-id=\"$loc\" title=\"delete\" style=\"font-size:11px; height:22px; margin-left:5px;\"></i>
					</li>
				";

			}
		}
	}

	


	public function uploadViewEvaluator($content_id )
	{
		$sql = "SELECT * FROM doc_loc WHERE content = $content_id AND viewStat = 1 ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()) {

				$name = $row['name'];
				$loc  = $row['loc'];
				$view = $row['viewed'];
				$showName = $name;
				if (strlen($name)>20) {
					$showName = substr($name, 0, 20)."...";
				}

				if ($view == 0) {
					echo "
						<li class=\"row\" style=\"margin-bottom:8px;\">
						  <i class=\"col-sm-2 fa fa-file-alt m-view-upload\" docu-name=\"$loc\" docu-cont=\"$content_id\" style=\"font-size:18px; position:relative;\">
							<p style=\"padding:2px; background:red; border-radius:2px; position:absolute; top:-4px; left:10px; color:#fff; font-family:arial narrow; font-weight:normal; font-size:3px; text-shadow: 1px 1px 1px #555;\">new</p>
						  </i> 
						  <strong class=\"col-sm-8\" style=\"font-weight: normal;\" title=\"$name\">$showName</strong> 
						</li>
					";
				} elseif ($view==1) {
					echo "
						<li class=\"row\" style=\"margin-bottom:8px;\">
						  <i class=\"col-sm-2 fa fa-file-alt m-view-upload\" docu-name=\"$loc\" docu-cont=\"$content_id\" style=\"font-size:18px; position:relative;\">
						  </i> 
						  <strong class=\"col-sm-8\" style=\"font-weight: normal; font-size:12px;\" title=\"$name\">$showName</strong> 
						</li>
					";
				}
			}
		}
	}

	public function uploadViewDean($content_id )
	{
		$sql = "SELECT * FROM doc_loc WHERE content = $content_id AND viewStat = 1 ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows > 0) {
			while ($row = $result->fetch_assoc()) {

				$name = $row['name'];
				$loc  = $row['loc'];
				$view = $row['viewed'];
				$showName = $name;
				if (strlen($name)>20) {
					$showName = substr($name, 0, 20)."...";
				}

				if ($view == 0) {
					echo "
						<li class=\"row\" style=\"margin-bottom:8px;\">
						  <i class=\"col-sm-2 fa fa-file-alt m-view-upload\" docu-name=\"$loc\" docu-cont=\"$content_id\" style=\"font-size:18px; position:relative;\">
							<p style=\"padding:2px; background:red; border-radius:2px; position:absolute; top:-4px; left:10px; color:#fff; font-family:arial narrow; font-weight:normal; font-size:3px; text-shadow: 1px 1px 1px #555;\">new</p>
						  </i> 
						  <strong class=\"col-sm-8\" style=\"font-weight: normal; font-size:12px;\" title=\"$name\">$showName</strong> 
						</li>
					";
				} elseif ($view==1) {
					echo "
						<li class=\"row\" style=\"margin-bottom:8px;\">
						  <i class=\"col-sm-2 fa fa-file-alt m-view-upload\" docu-name=\"$loc\" docu-cont=\"$content_id\" style=\"font-size:18px; position:relative;\">
						  </i> 
						  <strong class=\"col-sm-8\" style=\"font-weight: normal;\" title=\"$name\">$showName</strong> 
						</li>
					";
				}
			}
		}
	}


	public function switchStatus($docu_id , $docu_state, $new='old')
	{
		$sql = "";
		if ($new=='old') {
			if ($docu_state=='on') {
				$sql = "UPDATE doc_loc SET viewStat = 0 , viewed = 0 WHERE id = $docu_id ";
				$this->connect()->query($sql);
				return 0;
			} elseif ($docu_state=='off') {
				$sql = "UPDATE doc_loc SET viewStat = 1   WHERE id = $docu_id ";
				$this->connect()->query($sql);
				return 1;
			}	
		} elseif ($new=='new') {
			if ($docu_state=='on') {
				$sql = "UPDATE doc_loc SET viewStat = 0 , viewed = 0 WHERE loc = '$docu_id' ";
				$this->connect()->query($sql);
				return 0;
			} elseif ($docu_state=='off') {
				$sql = "UPDATE doc_loc SET viewStat = 1  WHERE loc = '$docu_id' ";
				$this->connect()->query($sql);
				return 1;
			} else {
				$sql = "UPDATE doc_loc SET viewStat = 1  WHERE loc = '$docu_id' ";
				$this->connect()->query($sql);
				return 1;
			}
		}
		
	}

	public function rmvUpload($id)
	{
		$loc = 'docu/'.$id.'.pdf';
		
		if (!unlink('../'.$loc)) {
			echo "<div class=\"alert alert-warning\">file don't exist...</div>";
		} else {
			$sql = " DELETE FROM doc_loc WHERE loc = '$loc' ";
			$this->connect()->query($sql);
			echo '1';
		}

	}

	public function changeNotiStat($docu_name)
	{
		$docu_name = mysqli_real_escape_string( $this->connect(), $docu_name);

		$sql = "UPDATE doc_loc SET viewed = 1 WHERE loc = '$docu_name'";
		$this->connect()->query($sql);
		return 1;
	}
}

?>