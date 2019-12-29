<?php 

/**
* AVERAGE SUMMARY for RATINGS
*/
class aveSummaryRating extends dbh
{
	public function userAreaStaff($user_id)
	{
		$sql = "SELECT area.id AS id , area.title , area.code  FROM area INNER JOIN user ON user.id = area.staff WHERE area.staff = $user_id ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows>0) {
			while ($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$title = $row['title'];
				$code = $row['code'];
				
				echo "
					<div class=\"row\" >
						<div class=\"col-lg-12\" style=\"background:#eee; color:#111; font-family: arial narrow; font-size:12px;\">
							<i class=\"fa fa-dharmachakra\"></i> <strong style=\"font-size:15px;\">$code</strong> - $title 
							</div>
					</div>";
				$this->areaSummaryRate($id);
			}	
		}
	}
	
	public function userAreaEval($user_id)
	{
		$sql = "SELECT area.id AS id , area.title , area.code  FROM area INNER JOIN user ON user.id = area.evaluator WHERE area.evaluator = $user_id";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows>0) {
			while ($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$title = $row['title'];
				$code = $row['code'];
				
				echo "
					<div class=\"row\">
						<div class=\"col-lg-12\" style=\"background:#eee; color:#111; font-family: arial narrow; font-size:12px;\">
							<i class=\"fa fa-dharmachakra\"></i> <strong style=\"font-size:15px;\">$code</strong> - $title 
							</div>
					</div>";
				$this->areaSummaryRate($id);
			}	
		}
	}
	
	public function userAreaDean($user_id)
	{
		$sql = "SELECT area.id AS id , area.title , area.code FROM area INNER JOIN user ON user.id = area.dean WHERE area.dean = $user_id";

		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;


		if ($numRows>0) {
			$id='';		
			while ($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$title = $row['title'];
				$code = $row['code'];
		 
				echo "

					<div class=\"row\">

						<div class=\"col-lg-12\" style=\"background: #eee; color:#111; font-family: arial narrow; font-size:12px;\">
							<i class=\"fa fa-dharmachakra\"></i> <strong style=\"font-size:15px;\">$code</strong> - $title 
						</div>
					</div>";

				$this->areaSummaryRate($id);
				$id='';
			}	
		}
	}

	private function areaSummaryRate($area_id)
	{
		$sql = "SELECT sub_a.id AS id , area.title AS title FROM sub_a INNER JOIN area ON sub_a.area = area.id WHERE sub_a.area = $area_id";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		$output = "";
		$cnt=0;
		$aveSub_a = 0;
		$cntSubA = 0;
		$ave_area = 0;
		$totalMean = 0;


		if ($numRows>0) {
			while ($row = $result->fetch_assoc()) {
				$numberOfSubA = 0;

				$id = $row['id'];
				$title = $row['title'];
				$ave_suba = 0; //var for SUB AREA AVERAGE


				if ($cnt==0) {
					
					$output .="
					<div class=\"row\">
						<div class=\"col-lg-12\" style=\"border-top:solid 1px #eee; background: #343a40; color:#fff; text-align:center; font-size:11px;\">AVERAGE SUMMARY RATING</div>
					</div>";
					$cnt++;
				}

				$sqlSubArow = "	SELECT * FROM sub_a
								WHERE sub_a.area = $area_id";

				$resultSubArow = $this->connect()->query($sqlSubArow);
				$numROwsSubArow = $resultSubArow->num_rows;
				$numberOfSubA = $numROwsSubArow;

				$sqlCateg = "SELECT * FROM c ";
				$resultCateg = $this->connect()->query($sqlCateg);
				$numRowsCateg = $resultCateg->num_rows;
				
				//AVE of SUBAREA
				$input_ave = 0;
				$proc_ave = 0;
				$output_ave = 0;

				if ($numRowsCateg>0) {
					$output .="<div class=\"row\" style=\" background:#fff; font-size:12px; border-bottom:solid 1px #eee;\">";
					$cnt_subA = 1;


					while ($rowCateg = $resultCateg->fetch_assoc()) {
						$cat_id = $rowCateg['id'];
						$cat_cat = strtoupper(substr($rowCateg['cat'], 0,1));
						$cat_perc = $rowCateg['perc'];

						$sqlSubA = "
							SELECT 
								sub_a.title AS 'sub area' , 
								round((sum(content.evalRate)/(count(content.evalRate)*5))*100 , 2 )*$cat_perc  AS percentage
							FROM sub_a INNER JOIN content
							ON content.sub_a = sub_a.id
							WHERE sub_a.id = $id AND sub_a.area = $area_id AND content.category =  $cat_id
							";

						$resultSubA = $this->connect()->query($sqlSubA);
						$numRowsSubA = $resultSubA->num_rows;
					
						if ($numRowsSubA>0) {
							while ($rowSubA = $resultSubA->fetch_assoc()) {
								$titleSubA 	= $rowSubA['sub area'];
								$perc 	= round($rowSubA['percentage'],2);

								if ($cnt_subA==1) {
									$output .= "<div class=\"col-sm-12\" style=\"font-weight:normal; font-size:11px; background:#fff;\"><i class=\"fa fa-chevron-circle-right\"></i> $titleSubA</div>
												<div class=\"col-sm-9\" style=\"text-align:right; color:#aaa; \"><strong> IPO:</strong> 
									";
								}

								$output .= " $perc | ";

								$cnt_subA++;

								if ($cat_id==1) {
									$input_ave += $perc;
								}elseif ($cat_id==2) {
									$proc_ave += $perc;
								}elseif ($cat_id==3) {
									$output_ave += $perc;
								}

							}
						}

					}
					$ave_suba += $input_ave+$proc_ave+$output_ave;
					
					$fntWeight = '';
					$numeric = round(($ave_suba/100)*5, 2);
					$totalMean += $numeric;

					if ($ave_suba <= 50) {
						$fntWeight = "font-weight:bold; color:red;";
					}



					//.$ave_suba."%  "

					$output .= "</div>
									<div class=\"col-sm-2\" style=\"color:green; $fntWeight\">".$numeric."</div>";
					$output .= "</div>";
				}

				$ave_area += $ave_suba;
			}
			//$ave = round(($ave_area/($cntSubA*100))*100 , 2);
			$ave = round(($ave_area/($numberOfSubA*100)*100), 2);
			$aveStyle = '';
			$numeric = round(($ave/100)*5, 2);
			if ($ave <= 50) {
				$aveStyle = "background:red; color:white; font-weight:bold";
			} else {
				$aveStyle = "background:green; color:white;";
			}

			$output .= "<div class=\"row\" style=\"background:#fff;\">
							<div class=\"col-sm-9\" style=\"font-weight:bold; color:#111; background:#fff;\">TOTAL MEAN</div>
							<div class=\"col-sm-3\" style=\"\">$totalMean</div>
						</div>";

			$output .= "<div class=\"row\" style=\"background:#fff;\">
							<div class=\"col-sm-9\" style=\"font-weight:bold; color:#111; background:#ddd;\">AREA MEAN</div>
							<div class=\"col-sm-3\" style=\"$aveStyle\">$numeric</div>
						</div>";
					//


			echo $output;
		}


	}


}

?>