  
    
  </div>

</body>

<div class="row" style="background: #343a40; margin:0; border:0;">
	<div class="col-lg-12"><br></div>
  <div class="col-lg-10"></div>
  <div class="col-lg-2">
    <p style="color:#888; font-family:arial narrow; font-size: 12px;"><i class="fa fa-copyright"></i> Taguig City University Thesis - 2018</p>
  </div>
</div>

</html>

<!-- Modal -->
<div class="modal fade " id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<input id="error" type="hidden" 
		<?php 
			$errMass = '';

			if ( isset($_GET['error']) ) {
				$err = $_GET['error'];
				echo "value=\"$err\""; 

				if ($err == 'invUser') {
					$errMass = 'username already exist';
				}
			}else{
				//echo "value=\"\"";

				$succMass = '';
				
				if ( isset($_GET['succ']) && $_SESSION['adminTab']=='accReg' ) {
					$succ = $_GET['succ'];
					echo "value=\"$succ\""; 


					if ($succ == 1) {
						
						if (isset($_GET['regName'])&&isset($_GET['regUser'])&&
							isset($_GET['regPass'])&&isset($_GET['regArea'])&&
							isset($_GET['regType'])&&isset($_GET['verCode'])) {
							
							$name = $_GET['regName'];
							$user = $_GET['regUser'];
							$pass = $_GET['regPass'];
							$area = $_GET['regArea'];
							$type = $_GET['regType'];
							$verCode = $_GET['verCode'];

							$succMass = '
								<div class=\'row\'>
									<div class=\'col-sm-5\'>Name</div> 		<div class=\'col-sm-7\'>'.$name.' </div>
									<div class=\'col-sm-5\'>Username</div> 	<div class=\'col-sm-7\'>'.$user.' </div>
									<div class=\'col-sm-5\'>Password </div> <div class=\'col-sm-7\'>'.$pass.' </div>
									<div class=\'col-sm-5\'>Area 	 </div> <div class=\'col-sm-7\'>'.$area.' </div>
									<div class=\'col-sm-5\'>Type	 </div> <div class=\'col-sm-7\'>'.$type.' </div>
									<div class=\'col-sm-5\'>Verification code </div> 
										<div class=\'col-sm-7\' >
											<p style=\'background:#DAF7A6; text-align:center;\'>'.$verCode.' </p>
										</div>
								</div>'
								;
						}

						$succTitle = 'Registration Success';


					}
				}else{
					echo "value=\"\"";
				}
			}
		?> >
	<div class="modal-dialog " role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	    	
	      <i class="modal-title" id="exampleModalLabel" style="color:red;"><?php echo $errMass; ?></i>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close" autofocus>
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	  </div>
	</div>
</div>

	<input id="succ" type="hidden" 
		<?php 
		/*
			$succMass = '';

			if ( isset($_GET['succ']) ) {
				$succ = $_GET['succ'];
				echo "value=\"$succ\""; 


				if ($succ == 1) {
					
					$name = $_GET['regName'];
					$user = $_GET['regUser'];
					$pass = $_GET['regPass'];
					$area = $_GET['regArea'];
					$type = $_GET['regType'];
					$verCode = $_GET['verCode'];

					$succTitle = 'Registration Success';
					$succMass = '
						<div class=\'row\'>
							<div class=\'col-sm-5\'>Name</div> 		<div class=\'col-sm-7\'>'.$name.' </div>
							<div class=\'col-sm-5\'>Username</div> 	<div class=\'col-sm-7\'>'.$user.' </div>
							<div class=\'col-sm-5\'>Password </div> <div class=\'col-sm-7\'>'.$pass.' </div>
							<div class=\'col-sm-5\'>Area 	 </div> <div class=\'col-sm-7\'>'.$area.' </div>
							<div class=\'col-sm-5\'>Type	 </div> <div class=\'col-sm-7\'>'.$type.' </div>
							<div class=\'col-sm-5\'>Verification code </div> 
								<div class=\'col-sm-7\' >
									<p style=\'background:#DAF7A6; text-align:center;\'>'.$verCode.' </p>
								</div>
						</div>'
						;


				}
			}else{
				echo "value=\"\"";
			}
			*/
		?> >
<div class="modal fade " id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <p class="modal-title" id="exampleModalLabel" style="color:green;"><?php echo $succTitle; ?></p>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close" autofocus>
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	    	<?php echo $succMass; ?>
	    </div>
	  </div>
	</div>
</div>

<script type="text/javascript">
	$(function () {

		//SUCCESS
		//ADMIN START
		if ( $('#error').val() == 1) {
			//alert();
			$("#successModal").modal('show');
		}
		//ADMIN END
		
		//ERRORS
		//ADMIN START
		if ($('#error').val() == 'invUser') {
			//$('#errorModal').modal({backdrop: 'static', keyboard: false});
			$("#errorModal").css({'top':'250'});
			$("#errorModal").modal('show');
		}
		
		//ADMIN END


		
	});
</script>

