<?php 

session_start();

if (isset($_SESSION['type'])) {
  if ($_SESSION['type']=='1') {
    header("Location: staff.php");
  }elseif($_SESSION['type']=='2'){
    header("Location: evaluator.php");
  }elseif($_SESSION['type']=='3'){
    header("Location: dean.php");
  }elseif($_SESSION['type']=='4'){
    header("Location: admin.php");
  }
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Accred Manager</title>
  <link rel="icon" href="icon/icon1.png">
  
  <script src="include/js/jquery.js"></script>
  <script src="include/js/bootstrap.js"></script>
  <link rel="stylesheet" href="include/css/bootstrap.css">
  <link rel="stylesheet" href="include/fontawesome/css/all.css">
  
  <style>
    /* width */
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #343a40; 
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #343a40; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #343a40; 
    }
    html{
      scroll-behavior: smooth;
      margin:0;
      background: #343a40;
    }
    body{
      margin:0;
    }
    footer{
      background: #343a40;
      margin:0;
      width: 100%;
    }
    .container-fluid{
      margin:0;
      padding:0;
      border:0;
    }
    .icon{
      font-weight: bold;
    }
    .icon i{
      font-weight: normal;
      font-size: 12px;
    }
    .m-user-circle{
      font-size: 30px;
      color: #fff;
      float: right;
    }
    .m-user-circle:hover{
      text-shadow: 1px 1px 1px #555;
      cursor: pointer;
    }
    .m-dropdown-menu{
      top: 40px;
      left: -117px;
      padding:0;
      border:0;
      box-shadow: 1px 1px 5px  #999;
      background: #343a40 ;
    }

    .m-dropdown-header{
      padding:3px;
      background: #343a40;
      text-align: center;
      color: #fff;
    }
    
    .m-dropdown-header i {
      font-size: 20px;
    }

    .m-btn-login{
      width:100%;
      border-radius: 0;
      background: #343a40;
      color:#fff;
    }

    .m-dropdown-menu li input{
      border-radius: 0px;
      margin-bottom: 1px;
    }


  </style>

</head>
<body>
  <div class="container-fluid" >
    <!--HEADER-->
    <nav class="navbar  navbar-dark bg-dark" style="border-bottom: 2px solid #C0392B;">
      <a class="navbar-brand icon" href="#">AM<i>anager</i></a>
      <div class="dropdown">
        <i class="fa fa-user-circle m-user-circle" id="loginMenu" data-toggle="dropdown"></i>
        <ul class="dropdown-menu m-dropdown-menu" >
            <li class="dropdown-header m-dropdown-header"><i class="fa fa-user-circle"></i> ACCOUNT</li>
            <div class="divider"></div>

            <form action="nav/accnt.nav.php" method="POST">
              <li><input class="form-control" name="user" type="text" placeholder="username" required></li>
              <li><input class="form-control" name="pass" type="password" placeholder="password" required></li>
              <li><button class="btn btn-default m-btn-login" type="submit">login</button></li>
            </form>

        </ul>
      </div>
    </nav>
    
    <div class="row" style="width:100%; margin:0px;">
      <!--
      <div class="col-lg-2" style="background: #cfcfcf;"></div>
      -->
      <div class="col-lg-12" style="background: #efef; height: 550px; position: relative;">
        <div style="position:absolute; left:328px; top:-10px; background: red; height: 25%; width:100px; transform: rotate(10deg); "></div>
        <div style="position:absolute; left:138px; top:-125px; background: red; height: 105%; width:100px; transform: rotate(60deg); "></div>
        <div style="position:absolute; left:270px; top:-20px; background: red; height: 25%; width:100px; transform: rotate(70deg); "></div>
        <div style="position:absolute; left:270px; top:0px; background: red; height: 5%; width:100px; transform: rotate(00deg); "></div>

        <div style="position:absolute; left:120px; top:-132px; background: #343a40; height: 120%; width:100px; transform: rotate(45deg); border-right: 2px solid #C0392B;"></div>
        <br>
        
        <div class="row" >
          <div class="col-lg-2" >
            
          </div>
          <div class="col-lg-7">
            <div class="row" >
              <div class="col-sm-10">
                <a href="http://www.tcu.x10host.com" target="_blank">
                  <img class="" src="img/tcu_logo.png" alt="tcu logo" style="height:120px; width:120px;">
                </a>
              </div>
              <div class="col-sm-1" style="position: relative;">
                <div style="position:absolute; left:35px; top:-24px; background: red; height: 155%; width:90px; transform: rotate(00deg); "></div>

                <div style="position:absolute; left:30px; top:-28px; background: #343a40; height: 150%; width:100px; transform: rotate(00deg);"></div>
                <a href="http://www.alcucoa.org.ph" target="_blank">
                  <img  src="img/alcucoa_logo.png" alt="alcucoa logo" style="border:1px solid #fff;
                   border-radius:120px; position:absolute;height:120px; width:120px;">
                </a>
              </div>
            </div>
            <div class="row">
              <br>
              <?php
                if (isset($_GET['login'])=='error') {
                  echo "  <div class=\"alert alert-warning alert-danger fade show\" role=\"alert\" style=\"background:#fff; font-size:12px;\">
                            <strong>Access Denied:</strong> Invalid Username / Password...
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                              
                            </button>
                          </div>";
                }
              ?>
            </div>
            <div class="row" style="text-shadow: 1px 1px 1px #efef;">
              
              <h3 style="padding: 0 10px;"><i class="fa fa-university"></i> Taguig City University Alcucoa Accreditation </h3>
              <br>
              <br>
              <p style="text-align:justify; padding: 0 20px;">Every school dreams to be transformed with a better atmosphere which will open its gate to learners who will soon be the leaders of change. The learners will spearhead innovations into different fields of endeavor.  The educational setting in our country today seems like a zooming jet in the sky that keeps on accelerating until it reaches its maximum speed. The educational struggle of every learner becomes even more complex this time because of the standards set by different accrediting agencies in pursuit of quality education which will serve as the gatepass of learners in creating a formidable image towards global competitiveness.</p>

              <p style="text-align:justify; padding: 0 20px;">Accreditation is the formal recognition of an educational program that possesses high level of quality or excellence based on the analysis of the merits of its educational operations in attaining its objectives and its role in the community that it serves.</p>
            </div>
          </div>
          <div class="col-lg-2" style="position:relative;">
              
            
          </div>
        </div>

        <img src="img/tcu_building.png" style="position: absolute; right:0px; bottom: 0px; height:85%; width:65%;">
        <!--
      <div class="col-lg-2" style="background: #cfcfcf; position: relative;">
        -->
      </div>
        
      </div>
    </div>
  </div>
</body>

<footer>
  <div class="container-fluid">
    <br>
    <div class="row" style="margin:0px;border:0px;">
      <div class="col-lg-10"></div>
      <div class="col-lg-2">
        <p style="color:#888; font-family:arial narrow; font-size: 12px;"><i class="fa fa-copyright"></i> - 2020</p>
      </div>
    </div>
  </div>
</footer>

</html>
<script>
  $(function () {
    history.pushState({},'','index.php');
  });
</script>
  

