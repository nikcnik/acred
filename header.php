<?php 



$viewName = ucfirst($_SESSION['name']);
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
        background: #f1f1f1; 
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #343a40; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #196F3D; 
    }
    html{
      scroll-behavior: smooth;
    
      background: #343a40;
    }
    footer{
      background: #343a40;
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
      left: -70px;
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
    #titleBar{
      box-shadow: 1px 1px 1px #fff;
    }
    .nameBLogo{
      font-size:14px; 
      font-family:sans-serif; 
      font-weight: normal; 
      padding-left: 10px;
    }
    .account:hover{
      cursor: pointer;
      text-shadow: 1px 1px 1px #555;
    }
    .accntClass{
      background: #eee;
      display: none;
    }
  </style>

</head>
<body>
  <div class="container-fluid" >
    <!--HEADER-->
    <nav id="titleBar " class="navbar  navbar-dark bg-dark" style="border-bottom: 2px solid #C0392B;">
      <a class="navbar-brand icon" href="./">AM<i>anager</i></a>
      <div class="dropdown">
        <i class="fa fa-user-circle m-user-circle" id="loginMenu" data-toggle="dropdown"><strong class="nameBLogo"><?php echo $viewName; ?></strong></i>
        <ul class="dropdown-menu m-dropdown-menu">
            <li class=" row dropdown-header m-dropdown-header"><i class="fa fa-user-circle"></i> <?php echo $viewName; ?></li>
            <div class="divider"></div>
            
            <li class="row" style="background: #fff;  text-decoration: none; border-bottom:1px solid #999;">
              <a href="settings.php?setting" style=" width:100%; padding:0px; margin: 0px; color:#555;">
                <i class="fa fa-address-card col-sm-5"></i>Account
              </a>
            </li>

            <li class="row"  style="background: #fff;  text-decoration: none;">
              <a href="func/logout.php"  style="color:#555; width:100%; padding:0px; margin: 0px;">
                <i class="fa fa-sign-out-alt col-sm-5"></i>Logout
              </a>
            </li>

        </ul>
      </div>
    </nav>
    