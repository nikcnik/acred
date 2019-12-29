<?php 
session_start();

if (isset($_SESSION['type'])&&isset($_SESSION['adminTab'])) {
  if ($_SESSION['type']=='1') {
    header("Location: staff.php");
  }elseif($_SESSION['type']=='2'){
    header("Location: evaluator.php");
  }elseif($_SESSION['type']=='3'){
    header("Location: dean.php");
  }
}else{
	header("Location: ../accred/");
}

include 'header.php'; 
include 'func/class/db.php';
include 'func/class/content.php';
include 'func/class/user.php';

$cons = new constant();
$userData = new User();

//$_SESSION['adminTab'] = 'accReg';

/*
accReg
accMan
cntMan
*/

$navAccReg = "\"nav-link m-nav-a\"";
$navAccMan = "\"nav-link m-nav-a\"";
$navCntMan = "\"nav-link m-nav-a\"";

$tabAccReg = "\"col-lg-12\"";
$tabAccMan = "\"col-lg-12\"";
$tabCntMan = "\"col-lg-12\"";

$navTab = $_SESSION['adminTab'];

if ( $navTab == 'accReg' ) {
	
	$navAccReg = "\"nav-link m-nav-a active\"";
	$tabAccReg = "\"col-lg-12 active\"";

} elseif ( $navTab == 'accMan') {
	
	$navAccMan = "\"nav-link m-nav-a active\"";
	$tabAccMan = "\"col-lg-12 active\"";

} elseif ( $navTab == 'cntMan') {
	
	$navCntMan = "\"nav-link m-nav-a active\"";
	$tabCntMan = "\"col-lg-12 active\"";

}


?>


<!--CONTENT START-->
	<style>
		.m-nav-area{
			background: #999;
		}
		.m-nav-area li a{
			color: #fff;
		}
		.m-nav-area li a:hover{
			background: #777;
		}
		.m-nav-area li .active{
			background: #fff;
			color: #111;	
		}
		#reg-area , 
		#accnt-mngr-area ,
		#contnt-area{
			display: none;
		}
		#reg-area h3, 
		#accnt-mngr-area h3,
		#contnt-area h3{

		}
		#main-content .active{
			display: inline-block;
		}
		.cmTab{
			box-shadow: 1px 1px 10px 2px #ddd; 
			border-radius:5px;
		}
		.cmTab h5{
			background: #212529;
			color: #fff;
			border-left: 10px solid green;
			padding-left:10px;
		}
		.nav-item .m-nav-a{
			color: white;
			cursor: pointer;
		}
		.aM-user{
			cursor: pointer;
		}
		.aM-user:hover{
			color: blue;
		}
		#userEdit .modal-header{
			background: green;
			color: #fff;
		}

		/*START OF CONTENTS*/
		.m-area-reg-title{
			background: #212529;
			color: #fff;
			padding: 0px 10px;
			display: block;
		}
		.m-sub-area-reg{
			border-bottom: 3px solid #212529;
		}

		.m-sub-area-reg:hover{
			background: #cfcfcf;
		}
		.m-sub-area-title{
			display: block;
		}
		.regContent:hover{
			background: #cfcfcf;
		}
		/*END OF CONTENT*/

		/*.modal-backdrop { background-color: #fff; }
	</style>
		
	<ul class="nav justify-content-center m-nav-area" style="background: #343a40; color:#aaa;">
		<input id="m-nav-tab" type="hidden" <?php echo "value=\"$navTab\""; ?> >	
	  <li class="nav-item">
	    <a class=<?php  echo $navAccReg; ?> data-link="#reg-area">Account Registration</a>
	  </li>
	  <li class="nav-item">
	    <a class=<?php echo $navAccMan; ?> data-link="#accnt-mngr-area">Account Manager</a>
	  </li>
	  <li class="nav-item">
	    <a class=<?php echo $navCntMan;?> data-link="#contnt-area">Content Manager</a>
	  </li>
	</ul>
	

	<div class="row" style="margin:0; background: #fff;">
		<div class="col-lg-2" style="background: #fff; border-right: 1px solid #efefef;"">
			<div style="position:absolute; right:0px; top:0px; background: red; height: 100%; width:80px; transform: rotate(00deg); "></div>

			<div style="position:absolute; right:0px; top:-42px; background: #343a40; height: 250px; width:90px; transform: rotate(00deg); "></div>
			<a href="http://www.tcu.x10host.com" target="_blank">
			  <img  src="img/tcu_logo.png" alt="tcu logo" style="position:absolute; right:-10px; height:120px; width:120px;">
			</a>
			<a href="http://www.alcucoa.org.ph" target="_blank">
			  <img  src="img/alcucoa_logo.png" alt="alcucoa logo" style="position:absolute; top:125px; right:5px; height:80px; width:80px;">
			</a>
		</div>
		<div id="main-content" class="col-lg-8" >
		  



		  <div id="reg-area" class=<?php echo $tabAccReg; ?> >
			<br>
			<div class="row" style=" margin: 0px 10px;border-left: 10px solid green;  border-top: 5px solid #fff; border-bottom: 5px solid #fff; padding-left:10px;">
				<h3  >REGISTER NEW ACCOUNT</h3>
			</div>

			<div class="row"><br></div>

			<form action="func/regAccnt.php" method="post">
					
				<div class="form-group row">
					<div class="col-sm-1"></div>
				    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
				    <div class="col-sm-8">
				      	<input type="text" class="form-control" name="name" placeholder="Fullname" required>
				    </div>
					<div class="col-sm-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-sm-1"></div>
				    <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>
				    <div class="col-sm-8">
				      	<input type="text" class="form-control" name="user" placeholder="Username" minlength="6" required>
				    </div>
					<div class="col-sm-1"></div>
				</div>
				  
				<fieldset class="form-group">
				    <div class="row">
						<div class="col-sm-1"></div>
					    <legend class="col-form-label col-sm-2 pt-0">Type</legend>
					    <div class="col-sm-8">
					        <?php
					        	$cons->type();
					        ?>
					    </div>
						<div class="col-sm-1"></div>

				    </div>
				</fieldset>

				<fieldset class="form-group">
				    <div class="row">
						<div class="col-sm-1"></div>

					    <?php
					        //$cons->area();
					    ?>
						<div class="col-sm-1"></div>

				    </div>
				</fieldset>
				
			

				<div class="form-group row">
			      	<div class="col-sm-2"></div>
			      	<button type="submit" class="col-sm-8 btn btn-success">Sign up</button>
			      	<div class="col-sm-2"></div>
				</div>
			</form>

		  	<div class="row">
		  		<div class="col-lg-12"><br></div>
		  	</div>

		  </div>





















		  <div id="accnt-mngr-area" class=<?php echo $tabAccMan; ?> >
		  	<br>
		  	<div class="row" style="margin:10px 0px; border-left: 10px solid green;  border-top: 5px solid #fff; border-bottom: 5px solid #fff; padding-left:10px;">
		  		<h3  >ACCOUNT MANAGER</h3>
		  	</div>
		  	<div class="row">
		  		
				<div class="col-lg-12">
					<table class="table table-sm">
					  <thead class="thead-dark">
					    <tr>
					    	<th colspan="4">
								<h5 >AREA MANAGER</h5>
					    	</th>
					    </tr>
					    <tr>
					      <th scope="col">Area</th>
					      <th scope="col">Staff</th>
					      <th scope="col">Evaluator</th>
					      <th scope="col">Dean</th>
					    </tr>
					  </thead>
					  <tbody id="contManTable">
					    <?php echo $cons->accountManager(); ?>
					  </tbody>
					</table>
				</div>

		  		<div class="col-lg-12">
		  			<table class="table table-sm">
		  			  <thead class="thead-dark">
		  				<tr>
		  					<th colspan="5">
		  						<h5 >USER STATUS</h5>
		  					</th>
		  				</tr>
		  			    <tr>
		  			      <th scope="col">NAME</th>
		  			      <th scope="col">TYPE</th>
		  			      <th scope="col">USERNAME</th>
		  			      <th scope="col">VALIDATION</th>
		  			      <th scope="col">CODE</th>
		  			    </tr>
		  			  </thead>
		  			  <tbody >
		  			    <?php echo $userData->viewUser(); ?>
		  			  </tbody>
		  			</table>
		  		</div>
				
		  		
		  	</div>
		  </div>













		<?php 	
			$stasSubArea = $cons->checkEmptyTable('area');
			$statContent = $cons->checkEmptyTable('sub_a');
		?>




		  <div id="contnt-area" class=<?php echo $tabCntMan; ?> >
		  	<br>
		  	<div class="row" style=" margin:10px 0px; border-left: 10px solid green; border-top: 5px solid #fff; border-bottom: 5px solid #fff; padding-left:10px;">
		  		<h3>CONTENT MANAGER</h3>
		  	</div>
		  	<div class="row">
		  		<!--AREA-->
		  		<div class="col-sm-12">
		  			<p style="margin-bottom: 0px; font-size: 12px;">AREA</p>
		  			<div class="form-row" id="regAreaCont">
		  			   	<div class="form-group col-md-2">
		  			   	 	<label>Area Code</label>
		  			     	<input name="aCode" type="text" class="form-control form-control-sm" placeholder="Code...">
		  			   	</div>
		  			  
		  			   	<div class="form-group col-md-8">
		  			   		<label>Title</label>
		  			     	<input name="aTitle" type="text" class="form-control form-control-sm" placeholder="Title..." >
		  			   	</div>
		  			   	<div class="form-group col-md-2">
		  			     	<label>&nbsp;</label>
		  			     	<input type="button" onclick="regArea('#regAreaCont')" class="form-control form-control-sm btn btn-success" style="line-height: 20px;" value="save">
		  			   	</div>
		  			 </div>
		  		</div>	
		  	
		  		<!--SUB AREA-->
		  		<div class="col-sm-12">
		  			<p style="margin-bottom: 0px; font-size: 12px;">SUB AREA</p>
		  			<div class="form-row" id="regSubACont">
		  			   	<div class="form-group col-md-2">
		  			   		<label>Area</label>
		  			     	<select name="saArea" type="text" class="form-control form-control-sm" <?php echo $stasSubArea; ?>>
								<?php echo $cons->optArea(); ?>
		  			     	</select>
		  			   	</div>

		  			   	<div class="form-group col-md-8">
		  			   		<label>Title</label>
		  			     	<input name="saTitle" type="text" class="form-control form-control-sm" placeholder="Title..." <?php echo $stasSubArea; ?>>
		  			   	</div>
		  			   	<div class="form-group col-md-2">
		  			   		<label>&nbsp;</label>
		  			     	<input type="button" onclick="regSubA('#regSubACont')" class="form-control form-control-sm btn btn-success" style="line-height: 20px;" value="save" <?php echo $stasSubArea; ?>>
		  			   	</div>
		  			</div>
		  		</div>
		  		<!--CONTENT-->
		  		<div class="col-sm-12" >
		  			<p style="margin-bottom: 0px; font-size: 12px;">CONTENT</p>
		  			<div class="form-row" id="regContentCont">
		  			   	<div class="form-group col-md-2">
		  			   		<label>Area:Sub area</label>
		  			    	<select name="cASub" type="text" class="form-control form-control-sm" <?php echo $statContent; ?>>
								<?php echo $cons->optSubA(); ?>
		  			    	</select>
		  			   	</div>

		  			   	<div class="form-group col-md-2">
		  			   		<label>Category</label>
		  			     	<select name="cCategory" type="text" class="form-control form-control-sm" <?php echo $statContent; ?>>
								<?php echo $cons->optCategory(); ?>
		  			     	</select>
		  			   	</div>

		  			   	<div class="form-group col-md-6">
		  			   		<label>Content</label>
		  			     	<textarea name="cContent"  class="form-control form-control-sm" placeholder="Title..." <?php echo $statContent; ?>></textarea>
		  			   	</div>

		  			   	<div class="form-group col-md-2">
		  			   		<label>&nbsp;</label>
		  			     	<input type="button" onclick="regContent(regContentCont)" class="form-control form-control-sm btn btn-success" style="line-height: 20px;" value="save" <?php echo $statContent; ?>>
		  			   	</div>
		  			 </div>
		  		</div>	
		  	</div>
		  	<hr style="border:2px solid #111;">
		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
			
		  	<div class="row">
	  			<?php $cons->viewContent(); ?>
		  	</div>


		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
		  	<div class="row"><div class="col-lg-12">&nbsp;</div></div>
		  </div>














		</div>	
		<div class="col-lg-2" style="background: #fff; border-left: 1px solid #efefef;">
			<div style="position:absolute; left:0px; top:8px; background: red; height: 98%; width:80px; transform: rotate(00deg); "></div>

			<div style="position:absolute; left:0px; top:-45px; background: #343a40; height: 250px; width:90px; transform: rotate(00deg); "></div>
		</div>
	</div>
	
	

<!--CONTENT END-->

<div class="modal fade " id="userEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<input id="succ" type="hidden" >
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <p class="modal-title" id="exampleModalLabel" ><?php ?></p>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close" autofocus>
	        <span aria-hidden="true" style="color:#fff;">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	    	USERS EDIT
	    </div>
	    <div class="modal-footer">
        	<button type="button" class="btn btn-success" id="saveUserEdit" >Save changes</button>
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	</div>
	  </div>
	</div>
</div>

<?php include 'footer.php'; ?>

<script src="func/js/regContent.js"></script>
<script src="func/js/rmvContent.js"></script>

<script>
	$(function () {

      //history.pushState({},'','');


		function contentHidden() {
			$("#reg-area").hide();
			$("#accnt-mngr-area").hide();
			$("#contnt-area").hide();
		}



		

		$('.m-nav-a').on('click', function () {
			var tabArea = $(this).attr('data-link');

			$('.m-nav-a').removeClass('active');
			$(this).addClass('active');
			
			contentHidden();
			$(tabArea).show();

			$.ajax({
				type: 'POST' , 
				url:  'func/navTab.php' ,
				data: {'tab':tabArea} 
			});

		});

		
		$('.aM-user').on('click', function () {

			var aId  = $(this).attr('data-areaId');
			var id   = $(this).attr('data-id');
			var type = $(this).attr('data-type');
			var name = $(this).html();

			$("#userEdit .modal-header .modal-title").html("EDIT "+type.toUpperCase()+"<input type=\"hidden\" name=\"areaId\" value=\""+aId+"\" >");
			getUsers( name , id , type , aId );

			$("#userEdit").modal('show');

			$('#saveUserEdit').on('click', function () {
				var edit = $('#userEdit').find('input').serialize();

				$.ajax({
					type: 'POST' ,
					url:  'func/editContent.php' ,
					data: edit ,
					success: function (data) {
						location.reload();
					}
				});				
				
			});

		});

		$('.hideArea').on('click',function () {
			$(this).next().toggle();
		});

		
		
	});
</script>























