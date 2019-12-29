
<?php

class constant extends dbh{
		
	public function type(){
		
		$sql = "SELECT * FROM type";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;

		if ($numRows > 0) {
			while($row = $result->fetch_assoc() ){
				$id = $row['id'];
				$title = $row['title'];

				if ($title!='admin') {

					if ($id==1) {
						echo
						"<div class=\"form-check\">
						  <input class=\"form-check-input\" type=\"radio\" name=\"utype\" value=\"$id\" checked>
						  <label class=\"form-check-label\" >
						    $title
						  </label>
						</div>";
					}else{
						echo
						"<div class=\"form-check\">
						  <input class=\"form-check-input\" type=\"radio\" name=\"utype\" value=\"$id\" >
						  <label class=\"form-check-label\" >
						    $title
						  </label>
						</div>";
					}
					
				}
				

			}
		}
	}

	public function area(){

		$sql = "SELECT * FROM area";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;

		if ($numRows > 0) {

			echo
			"<legend class=\"col-form-label col-sm-2 pt-0\">Area</legend>
			    <div class=\"col-sm-8\">";
			while($row = $result->fetch_assoc() ){
				
				$id = $row['id'];
				$code = strtoupper($row['code']);
				$title = $row['title'];

				
				if ($id==1) {
					echo
					"<div class=\"form-check\">
					  <input class=\"form-check-input\" type=\"radio\" name=\"area\" value=\"$id\" checked>
					  <label class=\"form-check-label\" >
					    $code ( $title )
					  </label>
					</div>";
				}else{
					echo
					"<div class=\"form-check\">
					  <input class=\"form-check-input\" type=\"radio\" name=\"area\" value=\"$id\" >
					  <label class=\"form-check-label\" >
					    $code ( $title )
					  </label>
					</div>";
				}
				
			}
			echo "</div>";
		}
	}



	public function checkEmptyTable( $value )
	{
		$output = '';
		$sql = "SELECT * FROM $value ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;

		if ($numRows==0) {
			$output = "disabled";
		}

		return $output;
	}

	
	// FOR OUTPUT OF SELECT>OPTION CONTENT

	public function optArea()
	{
		$output = '';
		$sql = "SELECT * FROM area";
		$return = $this->connect()->query($sql);
		$numRows = $return->num_rows;

		if ($numRows>0) {
			while ($row = $return->fetch_assoc()) {
				$id 	= $row['id'];
				$code	= strtoupper($row['code']);
				$title 	= $row['title'];

				$output = $output."<option value=\"$id\">$code ( $title )</option>";
			}
		}

		return $output;
	}

	public function optSubA()
	{
		$output = '';
		$sql = "SELECT sub_a.id, area.code, sub_a.title FROM sub_a INNER JOIN area WHERE area.id = sub_a.area";
		$return = $this->connect()->query($sql);
		$numRows = $return->num_rows;

		if ($numRows>0) {
			while ($row = $return->fetch_assoc()) {
				$id 	= $row['id'];
				$code	= strtoupper($row['code']);
				$title 	= strtoupper($row['title']);

				$output = $output."<option value=\"$id\">$code - $title</option>";
			}
		}	
		return $output;
	}

	public function optCategory()
	{
		$output = '';
		$sql = "SELECT * FROM c";
		$return = $this->connect()->query($sql);
		$numRows = $return->num_rows;

		if ($numRows>0) {
			while ($row = $return->fetch_assoc()) {
				$id 	= $row['id'];
				$cat	= strtoupper($row['cat']);
				$perc 	= 100*$row['perc'];

				$output = $output."<option value=\"$id\">$cat - $perc%</option>";
			}
		}

		return $output;
	}


	//FOR REGISTRATION OF CONTENTS

	public function regArea($code , $title)
	{	
		$nCode = mysqli_real_escape_string( $this->connect(), $code);
		$nTitle = mysqli_real_escape_string( $this->connect(), $title);

		$sql = "INSERT INTO area ( code , title ) VALUES( '$nCode' , '$nTitle' )";
		$this->connect()->query($sql);
	}

	public function regSubA($area , $title)
	{
		$nArea = mysqli_real_escape_string( $this->connect(), $area);
		$nTitle = mysqli_real_escape_string( $this->connect(), $title);

		$sql = "INSERT INTO sub_a ( area , title ) VALUES( '$nArea' , '$nTitle' )";
		$this->connect()->query($sql);	
	}

	public function regContent($subA , $cat , $desc)
	{
		$nSubA = mysqli_real_escape_string( $this->connect(), $subA);
		$nCat = mysqli_real_escape_string( $this->connect(), $cat);
		$nDesc = mysqli_real_escape_string( $this->connect(), $desc);

		$nDesc = str_replace('\r\n', '<br>', $nDesc);
		$sql = "INSERT INTO content	 ( `sub_a` , `category`, `desc` ) VALUES( '$nSubA' , '$nCat' , '$nDesc' )";
		$this->connect()->query($sql);
	}


	//FOR VIEW OF CONTENT
	public function viewContent() 
	{	

		$sqlArea = "SELECT id, code, title FROM area";
		$resArea = $this->connect()->query($sqlArea);
		$numRows = $resArea->num_rows;
		if ($numRows>0) {
			$areaIdCount = 1;
			$contIdCount = 1;
			while ( $rowArea = $resArea->fetch_assoc() ) {
				$areaId	= $rowArea['id'];
				$code 	= strtoupper($rowArea['code']);
				$title 	= strtoupper($rowArea['title']);

				//start of output area
				$subAOnA = $this->connect()->query("SELECT * FROM sub_a INNER JOIN area ON sub_a.area = area.id WHERE area.id=$areaId");
				$subAOnARows = $subAOnA->num_rows;

				if ($subAOnARows>0) {
					echo "<div class=\"col-lg-12 \"> 
							<strong class=\"m-area-reg-title\">$code - $title</strong> 
							<a class=\"hideArea btn btn-primary\" style=\"padding:0px 5px; color:#fff; display:inline-block;\">toggle</a> ";
				}else{
					echo "<div id=\"area$areaIdCount\" class=\"col-lg-12\"> 
							<strong class=\"m-area-reg-title\">$code - $title</strong> 
							<a type=\"button\" onclick=\"rmvContent('1','$areaId' , '#area$areaIdCount')\" style=\"color:#fff; border:0px; padding:0px 16px; display:inline-block;\" class=\"btn btn-danger\" >
								rmv
							</a>
						";		
				}
				$areaIdCount++;

				echo "
						<div class=\"col-lg-12 m-area-content\"> ";

				$sqlSubA = "SELECT sub_a.title , sub_a.id FROM sub_a  WHERE sub_a.area = '$areaId' ";
				$resSubA = $this->connect()->query($sqlSubA);
				$SnumRows = $resSubA->num_rows;
				if ($SnumRows>0) {
					$subAIdcount = 1;
					while ( $rowSubA = $resSubA->fetch_assoc() ) {
						
						$subAid	   = $rowSubA['id'];
						$subATitle = strtoupper($rowSubA['title']);

						//start of output SUB_AREA
						$contOnSubA = $this->connect()->query("SELECT * FROM content INNER JOIN sub_a ON content.sub_a = sub_a.id WHERE sub_a.id=$subAid");
						$cOnSubRows = $contOnSubA->num_rows;
						if ($cOnSubRows>0) {
							echo "<div id=\"subA$subAIdcount\" class=\"col-lg-12 \">	<strong class=\"m-sub-area-title m-sub-area-reg\">SUB-AREA: $subATitle</strong>  ";
							//echo "</div>";
						}else{
							echo "<div id=\"subA$subAIdcount\" class=\"col-lg-12 \">	

									<strong class=\"m-sub-area-title m-sub-area-reg\">
										<button class=\"btn btn-default\" 
												onclick=\"rmvContent('2','$subAid', '#subA$subAIdcount')\" 
												title=\"remove\" 
												style=\"border:0px; padding:0px; background:none; \"
										>
											
											<span aria-hidden=\"true\" style=\"color:#111;\">&times;</span>
										</button>

										SUB-AREA: $subATitle

									</strong>
									
								";
						}
						$subAIdcount++;

						$sqlCategory = "SELECT id , cat , perc FROM c ";
						$resCategory = $this->connect()->query($sqlCategory);
						while( $rowCat = $resCategory->fetch_assoc()	){
							
							$catId   = $rowCat['id'];
							$catCat  = strtoupper($rowCat['cat']);
							$catPerc = $rowCat['perc']*100;
							
							//start of output CATEGORY
							echo "<div  class=\"col-lg-12\" style=\"background:#efefef\"> $catCat $catPerc% </div>";

							$sqlCont = "SELECT content.id,content.desc FROM content WHERE content.sub_a = $subAid AND content.category = $catId ";
							$resCont = $this->connect()->query( $sqlCont );
							$CnumRows = $resCont->num_rows;
							if ($CnumRows>0) {
								$contNum = 1;

								while ( $rowCont = $resCont->fetch_assoc() ) {
									$desc = $rowCont['desc'];
									$cntId = $rowCont['id'];
									echo "
										<div id=\"content$contIdCount\" class=\"row regContent\">
											<div class=\"col-sm-1\">
												$contNum.
											</div>
											<div  class=\"col-lg-10 \">
												 $desc 
											</div>
											<div class=\"col-lg-1\">
												<button onclick=\"rmvContent('3','$cntId','#content$contIdCount')\" class=\"btn btn-default\" title=\"remove\" style=\"border:0px; padding:0px; background:none; float:right;\">
												<span aria-hidden=\"true\" style=\"color:#111;\">&times;</span>
												</button>
											</div>
										</div>
										";
									$contNum++;
									$contIdCount++;
								}
							}

							//end of output CATEGORY

						}
						echo "
							</div>";
						//end of output SUB_AREA

					}
				}
				echo "
						</div>
					</div>
					";
				//end of output area
			}
		}
	}
	//VIEW STAFF CONTENT
	public function viewStaffContent($userId=0)
	{	
		//GET THE AREA OF THE USER
		$getAreaId = "SELECT id FROM area WHERE staff = $userId";
		$areaIdRes = $this->connect()->query($getAreaId);
		$aIdResNumR = $areaIdRes->num_rows;
		$navCnt = 0; // for navigation (right nav)

		if ($aIdResNumR>0) {
			while ($row = $areaIdRes->fetch_assoc())  {
				$areaId = $row['id'];
				//$this->areaContentOfUserStaff($areaId);		 	
				$sqlArea = "SELECT id, code, title FROM area WHERE id = $areaId ";
				$resArea = $this->connect()->query($sqlArea);
				$numRows = $resArea->num_rows;
				if ($numRows>0) {
					$areaIdCount = 1;
					$contIdCount = 1;
					while ( $rowArea = $resArea->fetch_assoc() ) {
						$areaId	= $rowArea['id'];
						$code 	= strtoupper($rowArea['code']);
						$title 	= strtoupper($rowArea['title']);
						$navCnt++;

						//start of output area
						$subAOnA = $this->connect()->query("SELECT * FROM sub_a INNER JOIN area ON sub_a.area = area.id WHERE area.id=$areaId");
						$subAOnARows = $subAOnA->num_rows;

						if ($subAOnARows>0) {
							echo "
								<div class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
								<div id=\"nav$navCnt\" class=\"col-lg-12 \" style=\"background:#fafafa;\"> 
									<h5 class=\"m-area-reg-title\" style=\"font-family:arial narrow;\">
										<i class=\"fa fa-dharmachakra\"></i> $code - $title
									</h5> 
									 ";
						}else{
							echo "<div id=\"area$areaIdCount\" class=\"col-lg-12\"> 
									<h5 id=\"nav$navCnt\" class=\"m-area-reg-title\" style=\"font-family:arial narrow;\">$code - $title</h5> 
								";		
						}
						$areaIdCount++;

						echo "
								<div class=\"col-lg-12 m-area-content\"> ";

						$sqlSubA = "SELECT sub_a.title , sub_a.id FROM sub_a  WHERE sub_a.area = '$areaId' ";
						$resSubA = $this->connect()->query($sqlSubA);
						$SnumRows = $resSubA->num_rows;
						if ($SnumRows>0) {
							$subAIdcount = 1;		
							while ( $rowSubA = $resSubA->fetch_assoc() ) {
								
								$subAid	   = $rowSubA['id'];
								$subATitle = strtoupper($rowSubA['title']);
								$navCnt++;

								//start of output SUB_AREA
								echo "<div id=\"subA$subAIdcount\" class=\"col-lg-12 \" style=\"\">	
										<strong id=\"nav$navCnt\" class=\"m-sub-area-title m-sub-area-reg\" 
												style=\"font-family:arial narrow; background:#196F3D; color:#fff; padding:0 10px; border-radius:20px;\">
											SUB-AREA: $subATitle
										</strong>  ";
								
								$subAIdcount++;

								$sqlCategory = "SELECT id , cat , perc FROM c ";
								$resCategory = $this->connect()->query($sqlCategory);
								while( $rowCat = $resCategory->fetch_assoc()	){
									
									$catId   = $rowCat['id'];
									$catCat  = strtoupper($rowCat['cat']);
									$catPerc = $rowCat['perc']*100;
									
									//start of output CATEGORY
									echo "<div class=\"row\">
											<div  class=\"col-lg-12\" style=\"color:#111; background:#efefef;\"> 
											<strong style=\"font-family:arial narrow; font-size:14px; \">$catCat $catPerc% </strong>
											</div>
										  </div>";

									$sqlCont = "SELECT content.id,content.desc,content.selfRate,content.evalRate FROM content WHERE content.sub_a = $subAid AND content.category = $catId ";
									$resCont = $this->connect()->query( $sqlCont );
									$CnumRows = $resCont->num_rows;
									if ($CnumRows>0) {
										$contNum = 1;

										while ( $rowCont = $resCont->fetch_assoc() ) {
											$desc = $rowCont['desc'];
											$cntId = $rowCont['id'];
											$self_r = $rowCont['selfRate']>0 ? $rowCont['selfRate']:'' ;
											$eval_r = $rowCont['evalRate']>0 ? $rowCont['evalRate']:'' ;

											$sqlNotes = "SELECT * FROM notes WHERE content = $cntId AND view_staff = 0";
											$resultNotes = $this->connect()->query($sqlNotes);
											$numRowsNotes = $resultNotes->num_rows;

											echo "	<div class=\"row\" style=\"background:#fff;  border:1px solid #eee;\">
														<div class=\"col-sm-1\">
												  			$contNum.
														</div>
												  		<div id=\"content$contIdCount\" class=\"col-lg-10 regContent\" style=\" padding-left:10px; font-size:13px;\">
															 
															<div class=\"row\">
															 	<div class=\"col-lg-12\">
																	<i id=\"sStar_$cntId\" class=\"m-func-icon fa fa-star-half-alt\"  
																		sub-a-title=\"$subATitle\"
																		category-no=\"$catCat $catPerc%\"
																		content-no=\"$contNum.\"
																		cnt-key=\"$cntId\"
																		data-var=\"selfRate\" 
																		title=\"documentor rate\"
																		style=\" margin-right: 2px ;\" 
																		>$self_r
																	</i>
																	<i class=\"fa fa-star\" data-var=\"evalRate\" title=\"evaluator rate\" style=\"color: #196F3D; margin-right: 2px ; \">$eval_r
																	</i>
															 	</div>
															 </div>
															 $desc 
												  		</div>
												  		<div class=\"col-lg-1\" style=\"background:#efefef;\">
															<i 	class=\"m-func-icon fa fa-file-upload\" 
																sub-a-title=\"$subATitle\"
																category-no=\"$catCat $catPerc%\"
																content-no=\"$contNum.\"
																cnt-key=\"$cntId\"
																data-var=\"upload\"
																title=\"upload\"
																style=\"width:30%;\" 
																>
															</i>
															<i class=\"m-func-icon fa fa-sticky-note\"  
																sub-a-title=\"$subATitle\"
																category-no=\"$catCat $catPerc%\"
																content-no=\"$contNum.\"
																cnt-key=\"$cntId\"
																data-var=\"notes\"
																title=\"notes\"
																style=\"width:30%; 
																		position:relative;\">";

													if ($numRowsNotes!=0) {
																	
														echo 	"<p style=\"padding:2px; background:red; border-radius:2px; position:absolute; top:-4px; left:10px; color:#fff; font-family:arial narrow; font-weight:normal; font-size:7px;\">$numRowsNotes</p>";
													}

														
														echo"</i>

															
												  		</div>
												  	</div>
												  ";
											$contNum++;
											$contIdCount++;
										}
									}

									//end of output CATEGORY

								}
								echo "
									</div>";
								//end of output SUB_AREA

							}
						}
						echo "
								</div>
							<div class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
							<div class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
							</div>

							";
						//end of output area
					}
				}
			}
		} else{
			echo "USER DON'T HAVE AREA";
		}

	}

	
	//VIEW EVALUATOR CONTENT
	public function viewEvaluatorContent($userId=0)
	{	
		//GET THE AREA OF THE USER
		$getAreaId = "SELECT id FROM area WHERE evaluator = $userId";
		$areaIdRes = $this->connect()->query($getAreaId);
		$aIdResNumR = $areaIdRes->num_rows;
		$navCnt = 0; // for navigation (right nav)
		
		if ($aIdResNumR>0) {
			while ($row = $areaIdRes->fetch_assoc())  {
				$areaId = $row['id'];
				//$this->areaContentOfUserEvaluator($areaId);		 	
				$sqlArea = "SELECT id, code, title FROM area WHERE id = $areaId ";
				$resArea = $this->connect()->query($sqlArea);
				$numRows = $resArea->num_rows;

				if ($numRows>0) {
					$areaIdCount = 1;
					$contIdCount = 1;
					while ( $rowArea = $resArea->fetch_assoc() ) {
						$areaId	= $rowArea['id'];
						$code 	= strtoupper($rowArea['code']);
						$title 	= strtoupper($rowArea['title']);
						$navCnt++;

						//start of output area
						$subAOnA = $this->connect()->query("SELECT * FROM sub_a INNER JOIN area ON sub_a.area = area.id WHERE area.id=$areaId");
						$subAOnARows = $subAOnA->num_rows;

						if ($subAOnARows>0) {
							echo "
								<div  class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
								<div class=\"col-lg-12 \" style=\"background:#fafafa;\"> 
									<h5 id=\"nav$navCnt\" class=\"m-area-reg-title\" style=\"font-family:arial narrow;\">
										<i class=\"fa fa-dharmachakra\"></i> $code - $title
									</h5> 
									 ";
						}else{
							echo "<div id=\"area$areaIdCount\" class=\" col-lg-12\"> 
									<h5 id=\"nav$navCnt\" class=\"m-area-reg-title\" style=\"font-family:arial narrow;\">$code - $title</h5> 
								";		
						}

						$areaIdCount++;

						echo "
								<div class=\"col-lg-12 m-area-content\"> ";

						$sqlSubA = "SELECT sub_a.title , sub_a.id FROM sub_a  WHERE sub_a.area = '$areaId' ";
						$resSubA = $this->connect()->query($sqlSubA);
						$SnumRows = $resSubA->num_rows;
						if ($SnumRows>0) {
							$subAIdcount = 1;		
							while ( $rowSubA = $resSubA->fetch_assoc() ) {
								
								$subAid	   = $rowSubA['id'];
								$subATitle = strtoupper($rowSubA['title']);
								$navCnt++; 

								//start of output SUB_AREA
								echo "<div id=\"subA$subAIdcount\" class=\" col-lg-12 \" style=\"\">	
										<strong id=\"nav$navCnt\" class=\"m-sub-area-title m-sub-area-reg\" 
												style=\"font-family:arial narrow; background:#196F3D; color:#fff; padding:0 10px; border-radius:20px;\">
											SUB-AREA: $subATitle
										</strong>  ";
								$subAIdcount++;

								$sqlCategory = "SELECT id , cat , perc FROM c ";
								$resCategory = $this->connect()->query($sqlCategory);
								while( $rowCat = $resCategory->fetch_assoc()	){
									
									$catId   = $rowCat['id'];
									$catCat  = strtoupper($rowCat['cat']);
									$catPerc = $rowCat['perc']*100;
									
									//start of output CATEGORY
									echo "<div class=\"row\">
											<div  class=\"col-lg-12\" style=\"color:#111; background:#efefef;\"> 
											<strong style=\"font-family:arial narrow; font-size:14px; \">$catCat $catPerc% </strong>
											</div>
										  </div>";

									$sqlCont = "SELECT content.id,content.desc,content.selfRate,content.evalRate FROM content WHERE content.sub_a = $subAid AND content.category = $catId ";
									$resCont = $this->connect()->query( $sqlCont );
									$CnumRows = $resCont->num_rows;
									if ($CnumRows>0) {
										$contNum = 1;

										while ( $rowCont = $resCont->fetch_assoc() ) {
											$desc = $rowCont['desc'];
											$cntId = $rowCont['id'];
											$self_r = $rowCont['selfRate']>0 ? $rowCont['selfRate']:'' ;
											$eval_r = $rowCont['evalRate']>0 ? $rowCont['evalRate']:'' ;

											$sqlUpload = "SELECT * FROM doc_loc WHERE content = $cntId AND viewed = 0 AND viewStat = 1";
											$resultUpload = $this->connect()->query($sqlUpload);
											$numRowsUpload = $resultUpload->num_rows;

											$sqlNotes = "SELECT * FROM notes WHERE content = $cntId AND view_evaluator = 0";
											$resultNotes = $this->connect()->query($sqlNotes);
											$numRowsNotes = $resultNotes->num_rows;

											echo "	<div class=\"row\" style=\"background:#fff;  border:1px solid #eee;\">
														<div class=\"col-sm-1\">
												  			$contNum.
														</div>
												  		<div id=\"content$contIdCount\" class=\"col-lg-10 regContent\" style=\" padding-left:10px; font-size:13px;\">
															<div class=\"row\">
																<div class=\"col-lg-12\">
																	<i  id=\"eStar_$cntId\"
																		class=\"m-func-icon fa fa-star\"
																		sub-a-title=\"$subATitle\"
																		category-no=\"$catCat $catPerc%\"
																		content-no=\"$contNum.\"
																		cnt-key=\"$cntId\"  
																		data-var=\"evalRate\"
																		title=\"evaluator rate\" 
																		self-rate=\"$self_r\" 
																		style=\"color: #196F3D\">$eval_r
																	</i>
																	<i class=\" fa fa-star-half-alt\"  data-var=\"selfRate\"
																	title=\"documentor rate\" style=\"color:;\">$self_r</i>
																</div>
															</div>
															$desc 
												  		</div>
												  		<div class=\"col-lg-1\" style=\"background:#efefef;\">
															<i 	class=\"m-func-icon fa fa-file-upload\" 
																sub-a-title=\"$subATitle\"
																category-no=\"$catCat $catPerc%\"
																content-no=\"$contNum.\"
																data-var=\"upload\"
																title=\"upload\" 
																cnt-key=\"$cntId\"

																style=\"color:; width:30%; margin-right: 2px ; position:relative;\">";

													if ($numRowsUpload!=0) {
																	
														echo 	"<p style=\"padding:2px; background:red; border-radius:2px; position:absolute; top:-4px; left:-6px; color:#fff; font-family:arial narrow; font-weight:normal; font-size:7px;\">$numRowsUpload</p>";
													}
															
															echo"</i>
															<i class=\"m-func-icon fa fa-sticky-note\"  
																sub-a-title=\"$subATitle\"
																category-no=\"$catCat $catPerc%\"
																content-no=\"$contNum.\"
																cnt-key=\"$cntId\"
																data-var=\"notes\"
																title=\"notes\"
																style=\"width:30%; 
																		position:relative;\">";

													if ($numRowsNotes!=0) {
																	
														echo 	"<p style=\"padding:2px; background:red; border-radius:2px; position:absolute; top:-4px; left:10px; color:#fff; font-family:arial narrow; font-weight:normal; font-size:7px;\">$numRowsNotes</p>";
													}

														echo"
															</i>

															
												  		</div>
												  	</div>
												  ";
											$contNum++;
											$contIdCount++;
										}
									}

									//end of output CATEGORY

								}
								echo "
									</div>";
								//end of output SUB_AREA

							}
						}
						echo "
								</div>
							<div class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
							<div class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
							</div>

							";
						//end of output area
					}
				}
			}
		} else{
			echo "USER DON'T HAVE AREA";
		}

	}


	//VIEW DEAN CONTENT
	public function viewDeanContent($userId=654654)
	{	
		//GET THE AREA OF THE USER
				$getAreaId = "SELECT id FROM area WHERE dean = $userId";
				$areaIdRes = $this->connect()->query($getAreaId);
				$aIdResNumR = $areaIdRes->num_rows;
				$navCnt = 0; // for navigation (right nav)
				
				if ($aIdResNumR>0) {
					while ($row = $areaIdRes->fetch_assoc())  {
						$areaId = $row['id'];
						//$this->areaContentOfUserEvaluator($areaId);		 	
						$sqlArea = "SELECT id, code, title FROM area WHERE id = $areaId ";
						$resArea = $this->connect()->query($sqlArea);
						$numRows = $resArea->num_rows;

						if ($numRows>0) {
							$areaIdCount = 1;
							$contIdCount = 1;
							while ( $rowArea = $resArea->fetch_assoc() ) {
								$areaId	= $rowArea['id'];
								$code 	= strtoupper($rowArea['code']);
								$title 	= strtoupper($rowArea['title']);
								$navCnt++;

								//start of output area
								$subAOnA = $this->connect()->query("SELECT * FROM sub_a INNER JOIN area ON sub_a.area = area.id WHERE area.id=$areaId");
								$subAOnARows = $subAOnA->num_rows;

								if ($subAOnARows>0) {
									echo "
										<div  class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
										<div class=\"col-lg-12 \" style=\"background:#fafafa;\"> 
											<h5 id=\"nav$navCnt\" class=\"m-area-reg-title\" style=\"font-family:arial narrow;\">
												<i class=\"fa fa-dharmachakra\"></i> $code - $title
											</h5> 
											 ";
								}else{
									echo "<div id=\"area$areaIdCount\" class=\" col-lg-12\"> 
											<h5 id=\"nav$navCnt\" class=\"m-area-reg-title\" style=\"font-family:arial narrow;\">$code - $title</h5> 
										";		
								}

								$areaIdCount++;

								echo "
										<div class=\"col-lg-12 m-area-content\"> ";

								$sqlSubA = "SELECT sub_a.title , sub_a.id FROM sub_a  WHERE sub_a.area = '$areaId' ";
								$resSubA = $this->connect()->query($sqlSubA);
								$SnumRows = $resSubA->num_rows;
								if ($SnumRows>0) {
									$subAIdcount = 1;		
									while ( $rowSubA = $resSubA->fetch_assoc() ) {
										
										$subAid	   = $rowSubA['id'];
										$subATitle = strtoupper($rowSubA['title']);
										$navCnt++; 

										//start of output SUB_AREA
										echo "<div id=\"subA$subAIdcount\" class=\" col-lg-12 \" style=\"\">	
												<strong id=\"nav$navCnt\" class=\"m-sub-area-title m-sub-area-reg\" 
														style=\"font-family:arial narrow; background:#196F3D; color:#fff; padding:0 10px; border-radius:20px;\">
													SUB-AREA: $subATitle
												</strong>  ";
										$subAIdcount++;

										$sqlCategory = "SELECT id , cat , perc FROM c ";
										$resCategory = $this->connect()->query($sqlCategory);
										while( $rowCat = $resCategory->fetch_assoc()	){
											
											$catId   = $rowCat['id'];
											$catCat  = strtoupper($rowCat['cat']);
											$catPerc = $rowCat['perc']*100;
											
											//start of output CATEGORY
											echo "<div class=\"row\">
													<div  class=\"col-lg-12\" style=\"color:#111; background:#efefef;\"> 
													<strong style=\"font-family:arial narrow; font-size:14px; \">$catCat $catPerc% </strong>
													</div>
												  </div>";

											$sqlCont = "SELECT content.id,content.desc,content.selfRate,content.evalRate FROM content WHERE content.sub_a = $subAid AND content.category = $catId ";
											$resCont = $this->connect()->query( $sqlCont );
											$CnumRows = $resCont->num_rows;
											if ($CnumRows>0) {
												$contNum = 1;

												while ( $rowCont = $resCont->fetch_assoc() ) {
													$desc = $rowCont['desc'];
													$cntId = $rowCont['id'];
													$self_r = $rowCont['selfRate']>0 ? $rowCont['selfRate']:'' ;
													$eval_r = $rowCont['evalRate']>0 ? $rowCont['evalRate']:'' ;

													$sqlUpload = "SELECT * FROM doc_loc WHERE content = $cntId AND viewed = 0 AND viewStat = 1";
													$resultUpload = $this->connect()->query($sqlUpload);
													$numRowsUpload = $resultUpload->num_rows;

													$sqlNotes = "SELECT * FROM notes WHERE content = $cntId AND view_dean = 0";
													$resultNotes = $this->connect()->query($sqlNotes);
													$numRowsNotes = $resultNotes->num_rows;

													echo "	<div class=\"row\" style=\"background:#fff;  border:1px solid #eee;\">
																<div class=\"col-sm-1\">
														  			$contNum.
																</div>
														  		<div id=\"content$contIdCount\" class=\"col-lg-10 regContent\" style=\" padding-left:10px; font-size:13px;\">
																	<div class=\"row\">
																		<div class=\"col-lg-12\">
																			
																			<i  id=\"eStar_$cntId\"
																				class=\"m-func-icon fa fa-star\"
																				sub-a-title=\"$subATitle\"
																				category-no=\"$catCat $catPerc%\"
																				content-no=\"$contNum.\"
																				cnt-key=\"$cntId\"  
																				data-var=\"evalRate\"
																				title=\"evaluator rate\" 
																				self-rate=\"$self_r\" 
																				style=\"color: #196F3D\">$eval_r
																			</i>
																			
																		</div>
																	</div>
																	$desc 
														  		</div>
														  		<div class=\"col-lg-1\" style=\"background:#efefef;\">
																	<i 	class=\"m-func-icon fa fa-file-upload\" 
																		sub-a-title=\"$subATitle\"
																		category-no=\"$catCat $catPerc%\"
																		content-no=\"$contNum.\"
																		data-var=\"upload\"
																		title=\"upload\" 
																		cnt-key=\"$cntId\"

																		style=\"color:; width:30%; margin-right: 2px ; position:relative;\">";

															if ($numRowsUpload!=0) {
																			
																echo 	"<p style=\"padding:2px; background:red; border-radius:2px; position:absolute; top:-4px; left:-6px; color:#fff; font-family:arial narrow; font-weight:normal; font-size:7px;\">$numRowsUpload</p>";
															}
																	
															
																	echo"</i>
																	<i class=\"m-func-icon fa fa-sticky-note\"  
																		sub-a-title=\"$subATitle\"
																		category-no=\"$catCat $catPerc%\"
																		content-no=\"$contNum.\"
																		cnt-key=\"$cntId\"
																		data-var=\"notes\"
																		title=\"notes\"
																		style=\"width:30%; 
																				position:relative;\">";

															if ($numRowsNotes!=0) {
																			
																echo 	"<p style=\"padding:2px; background:red; border-radius:2px; position:absolute; top:-4px; left:10px; color:#fff; font-family:arial narrow; font-weight:normal; font-size:7px; text-shadow:1px 1px 1px #555;\">$numRowsNotes</p>";
															}

																echo"
																	</i>
															
														  		</div>
														  	</div>
														  ";
													$contNum++;
													$contIdCount++;
												}
											}

											//end of output CATEGORY

										}
										echo "
											</div>";
										//end of output SUB_AREA

									}
								}
								echo "
										</div>
									<div class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
									<div class=\"row\">	<div class=\"col-lg-12\"><br></div>	</div>
									</div>

									";
								//end of output area
							}
						}
					}
				} else{
					echo "USER DON'T HAVE AREA";
				}

	}


	//FOR ACCOUNT MANAGER ADMIN SECTION
	public function accountManager()
	{	
		$userArr = array('0'=>'none');
		$users = "SELECT * FROM user";
		$usersRes = $this->connect()->query($users);
		$uRNumRows= $usersRes->num_rows;
		if ($uRNumRows>0) {
			while ($data = $usersRes->fetch_assoc()) {
				$id 	= $data['id'];
				$name 	= $data['name'];
				
				$userArr[$id] = $name;		
			}
		}
		//print_r($userArr);

		$sql = "SELECT * FROM area ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;

		if ($numRows>0) {
			while ($row = $result->fetch_assoc()) {
				
				$id 		= $row['id'];
				$code 		= strtoupper($row['code']);
				$title 		= strtoupper($row['title']);
				$staff 		= $row['staff'];
				$evaluator 	= $row['evaluator'];
				$dean 		= $row['dean'];
				
				echo "
					<tr>
					  <th scope=\"row\">$code <br> <i style=\"font-size:11px;\">$title</i></th>

					  <td class=\"aM-user\" data-areaId=\"$id\" data-id=\"$staff\" data-type=\"staff\">".strtoupper($userArr[$staff])."</td>
					  <td class=\"aM-user\" data-areaId=\"$id\" data-id=\"$evaluator\" data-type=\"evaluator\">".strtoupper($userArr[$evaluator])."</td>
					  <td class=\"aM-user\" data-areaId=\"$id\" data-id=\"$dean\" data-type=\"dean\">".strtoupper($userArr[$dean])."</td>
					</tr>
				";
			}
		}
	}

	public function getUsers( $name , $id , $type , $area )
	{
		$sql = "SELECT user.id , user.name FROM user INNER JOIN type ON user.type = type.id WHERE user.id != '$id' AND type.title = '$type' ";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if ($numRows>0) {
			echo "
				<div class=\"row\">
					<div class=\"col-sm-1\"></div>
					<div class=\"col-sm-3\">Current user</div>
					<div class=\"col-sm-8\">$name</div>

					<div class=\"col-sm-1\"></div>
					<div class=\"col-sm-3\">New user</div>
					<div class=\"col-sm-8\">
				";
			$cnt=1;
			while ($row = $result->fetch_assoc()) {
				$id 	= $row['id'];
				$name 	= strtoupper($row['name']);
				if ($cnt==1) {
					echo "
						<div class=\"form-check\">
						  	<input type=\"hidden\" name=\"area\" value=\"$area\">
						  	<input type=\"hidden\" name=\"type\" value=\"$type\">
							<input type=\"hidden\" name=\"name\" value=\"none\">
						  	<input class=\"form-check-input\" type=\"radio\" name=\"userId\" value=\"0\" >
						  	<label class=\"form-check-label\" >
						    	none
						  	</label>
						</div>
					";
				}

				echo "
					<div class=\"form-check\">
					  	<input type=\"hidden\" name=\"area\" value=\"$area\">
					  	<input type=\"hidden\" name=\"type\" value=\"$type\">
						<input type=\"hidden\" name=\"name\" value=\"$name\">
					  	<input class=\"form-check-input\" type=\"radio\" name=\"userId\" value=\"$id\" >
					  	<label class=\"form-check-label\" >
					    	$name
					  	</label>
					</div>
				";
				$cnt++;
			}
			echo "</div>

				</div>";
		}else{
			echo "
				<div class=\"row\">
					<div class=\"col-sm-1\"></div>
					<div class=\"col-sm-3\">Current user</div>
					<div class=\"col-sm-8\">$name</div>

					<div class=\"col-sm-1\"></div>
					<div class=\"col-sm-3\">New user</div>
					<div class=\"col-sm-8\">
				";
			echo "
				<div class=\"form-check\">
				  	<input type=\"hidden\" name=\"area\" value=\"$area\">
				  	<input type=\"hidden\" name=\"type\" value=\"$type\">
					<input type=\"hidden\" name=\"name\" value=\"none\">
				  	<input class=\"form-check-input\" type=\"radio\" name=\"userId\" value=\"0\" >
				  	<label class=\"form-check-label\" >
				    	none
				  	</label>
				</div>
			";
		}
	}


	// FOR EDIT AMIN DATAS
	// ACCOUNT MANAGER EDIT USERS
	public function editAreaUser( $area , $type , $userId , $name )
	{
		$getData = "SELECT * FROM area WHERE id = $area";
		$resultGetD = $this->connect()->query($getData);
		$numRows = $resultGetD->num_rows;
		if ($numRows>0) {
			while ($row = $resultGetD->fetch_assoc()) {
				$code 	= strtoupper($row['code']);		
				$title 	= strtoupper($row['title']);

				$sql = "UPDATE area SET $type = $userId WHERE id = $area ";
				$this->connect()->query($sql);

				echo "
					<div class=\"row\">
						<div class=\"col-sm-1\"></div>
						<div class=\"col-sm-3\">$code</div>
						<div class=\"col-sm-8\">$title</div>
						
						<div class=\"col-sm-4\"></div>
						<div class=\"col-sm-4\">$name</div>
						<div class=\"col-sm-4\"></div>
						
					</div>
					";
			}	
		} else{
			echo "AREA DOESN'T EXIST...";
		}

	}


	public function removeContent($table,$id)
	{
		$ntable = '';

		if ($table==1) {
			$ntable = 'area';
		} elseif ($table==2) {
			$ntable = 'sub_a';
		} elseif ($table==3) {
			$ntable = 'content';
		}


		$sql = "DELETE FROM $ntable WHERE id = $id ";
		$this->connect()->query($sql);	
	}



	public function contentScroll($user_id, $type)
	{
		$sql = "SELECT area.id , area.title , area.code 
				FROM area INNER JOIN user 
				ON area.$type = user.id 
				WHERE area.$type = $user_id";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		$output = "";

		$cnt = 0;
		$output .= "
				
				<div class=\"col-lg-2\" style=\"position: fixed; height: 665px; overflow: scroll; padding-left:0px;\">
				  <a href=\"http://www.tcu.x10host.com\" target=\"_blank\" style=\"display: block; font-size: 12px; \">
				    <div style=\"position:absolute; top:10px; left:25px; font-size:10px; background:  #922B21; color:#ddd; padding: 0 10px; width: 100%;\">Taguig City University Website</div>
				    <img  src=\"img/tcu_logo.png\" alt=\"tcu logo\" style=\" height:30px; width:30px; top:5px; position: absolute;\">
				  </a>

				  <a href=\"http://www.alcucoa.org.ph\" target=\"_blank\" style=\"display: block; font-size: 12px; \">
				    <div style=\"position:absolute; top:42px; background: #922B21; left:25px; color:#ddd; padding: 0 10px; width: 100%; font-size:10px;	\">Alcucoa Website</div>
				    <img  src=\"img/alcucoa_logo.png\" alt=\"alcucoa logo\" style=\" height:30px; width:30px; position: absolute; top:35px; \">
				  </a>
				  
				  <br>
				  <br>
				  <br>
		";
		if ($numRows>0) {
			while ($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$title = $row['title'];
				$code = $row['code'];
				$cnt++;


				$output .= "<ul  style=\"
									font-family:arial narrow; 
									font-size:13px; 
									padding-left:0px;
									list-style:none;
									\">";
				if ($cnt==1) {
					$output .="<li><i class=\"fa fa-dharmachakra\"></i> <a style=\"text-decoration:none; color:#111;\" href=\"#\">$code - $title</a></li>";
				} else{
					$output .="<li><i class=\"fa fa-dharmachakra\"></i> <a style=\"text-decoration:none; color:#111;\" href=\"#nav$cnt\">$code - $title</a></li>";
				}					

				$sqlSubA = "SELECT sub_a.title , sub_a.id FROM sub_a WHERE area = $id ";
				$resultSubA = $this->connect()->query($sqlSubA);
				$numRowsSubA = $resultSubA->num_rows;
				if ($numRowsSubA>0) {
					$output .= "
					<li>
						<ul style=\"list-style-type: circle; padding-left:15px;  font-size:13px; \">";
					while ($rowSubA = $resultSubA->fetch_assoc()) {
						$idSubA = $rowSubA['id'];
						$titleSubA = $rowSubA['title'];
						$cnt++;

						$output .= "<li style=\"border-bottom:solid 1px #eee; font-size:11px;\"><a style=\"color:#999; text-decoration:none; \" href=\"#nav$cnt\">$titleSubA</a></li>";


					}
					$output .="
						</ul>
					</li>";
				}

				$output .= "</ul>";

			}
		}

		echo $output;



	}

}

?>	



























