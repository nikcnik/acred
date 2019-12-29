<?php 

include "func/class/db.php";
include "func/class/user.php";


$newUser = new User();


session_start();

if (isset($_SESSION['type']) && isset($_GET['setting'])) {
  
}else{
  header("Location: ./");
}

$uStat = $_SESSION['userStat'];
$uId   = $_SESSION['userId'];

include 'header.php'; 

?>

<!--CONTENT START-->
<div class="row" style="margin:0; background: #fff;">
  <input id="user-status" type="hidden" <?php echo "value=\"$uStat\""; ?>>

  <div class="col-lg-2" style="background: #fff; border-right: 1px solid #efefef; position:relative;">
    

  </div>

  <div class="col-lg-8" style="background: #fff;">
    <br>
    <h5><i class="fa fa-cogs"></i> SETTINGS ACCOUNT</h5>
    <hr>
    <div class="row">
      <div class="col-lg-1"></div>
      <div class="col-lg-11">
        <div class="row" style="margin: 0px; padding:0px;">
          <div class="col-md-12">
     
            <div class="row" id="name">
              <label class="col-sm-2" style="font-family: arial narrow; ">Name :</label>
              <div class="col-sm-8"><?php echo "<i style=\"color:#999; font-family:arial narrow; font-size:13px;\">".$newUser->usersName($uId)."</i>"; ?></div>              
              <a  class=" account col-sm-2" style="font-family: arial narrow;">edit</a>
            </div>
            <div class=" form-group accntClass row"  style="font-size: 12px ;">
                <br>
                <div class="col-sm-12" >
                  <i class="fa fa-user-edit"></i> edit
                  <div class=" row"  style=" font-size: 12px; border:none;">
                    <div class="col-sm-1" ></div>
                    <div class="col-sm-10" style="background:#fff; border-radius: 2px; padding:10px 40px;">
                      <strong>Please Note:</strong> Don't add any special character (e.g: @#$%^&*) or numbers. Your name at note section also change.
                    </div>
                    <div class="col-sm-1"></div>
                  </div>
                </div>
                <form class="form-input">
                  <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Name:</label>
                      <input name="name" required type="text" class="form-control form-control-sm" 
                        <?php $curName = $newUser->usersName($uId); 
                              echo "value=\"".$curName."\"";
                        ?> 
                      >
                    </div>
                    <div class="col-sm-4">
                      <label for="inputValCode" class="col-form-label" >Validation Code:</label>
                      <input name="valCode" required type="password" class="form-control form-control-sm" placeholder="validation code...">
                    </div>
                    <div class="col-sm-2">
                      <label for="inputValCode" class="col-form-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      <button class="btn btn-primary btn-sm">save</button>
                    </div>
                  </div>
                </form>

                  <div class="col-sm-1" style="display: inline-block;"></div>
                  <div class="alert-success col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
                  <div class="col-sm-1" ></div>

                  <div class="col-sm-1" style="display: inline-block;"></div>
                  <div class="alert-danger col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
                  <div class="col-sm-1" style="display: inline-block;"></div>

                <br>
            </div>

            <div class="row" id="username">
              <label class="col-sm-2" style="font-family: arial narrow;">Username :</label>
              <div class="col-sm-8"><?php echo "<i style=\"color:#999; font-family:arial narrow; font-size:13px;\">".$newUser->usersUname($uId)."</i>"; ?></div>
              <a  class=" account col-sm-2" style="font-family: arial narrow;">edit</a>
            </div>
            <div class="row accntClass" style="font-size: 12px ;" >
              <form class="form-input">
                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-4">
                    <label for="inputName" class="col-form-label">Username:</label>
                    <input name="username" required type="text" class="form-control form-control-sm" 
                      <?php $curUname = $newUser->usersUname($uId); 
                            echo "value=\"".$curUname."\"";
                      ?> 
                    >
                  </div>
                  <div class="col-sm-4">
                    <label for="inputValCode" class="col-form-label" >Validation Code:</label>
                    <input name="valCode" required type="password" class="form-control form-control-sm" placeholder="validation code...">
                  </div>
                  <div class="col-sm-2">
                    <label for="inputValCode" class="col-form-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <button class="btn btn-primary btn-sm">save</button>
                  </div>
                </div>
              </form>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-success col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" ></div>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-danger col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" style="display: inline-block;"></div>

              <br>
            </div>

            
            <div class="row" id="password">
              <label class="col-sm-2" style="font-family: arial narrow;">Password :</label>
              <div class="col-sm-8"><i style="color:#999; font-family:arial narrow; font-size:13px;">**********</i></div>
              <a  class=" account col-sm-2" style="font-family: arial narrow;">edit</a>
            </div>
            <div class="row accntClass" style="font-size: 12px ;" >
              <form class="form-input">
                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-4">
                    <label for="inputName" class="col-form-label">New Password:</label>
                    <input name="npassword" required type="password" class="form-control form-control-sm" >
                    <label for="inputName" class="col-form-label">Re-new Password:</label>
                    <input name="rnpassword" required type="password" class="form-control form-control-sm" >
                  </div>
                  <div class="col-sm-4">
                    <label for="inputValCode" class="col-form-label" >Validation Code:</label>
                    <input name="valCode" required type="password" class="form-control form-control-sm" placeholder="validation code...">
                  </div>
                  <div class="col-sm-2">
                    <label for="inputValCode" class="col-form-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <button class="btn btn-primary btn-sm">save</button>
                  </div>
                </div>
              </form>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-success col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" ></div>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-danger col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" style="display: inline-block;"></div>

              <br>
            </div>
            
            <div class="row" id="contact">
              <label class="col-sm-2" style="font-family: arial narrow;">Contact No. :</label>
              <div class="col-sm-8"><?php echo "<i style=\"color:#999; font-family:arial narrow; font-size:13px;\">".$newUser->usersContact($uId)."</i>"; ?></div>
              <a  class=" account col-sm-2" style="font-family: arial narrow;">edit</a>
            </div>
            <div class="row accntClass" style="font-size: 12px ;" >
              <form class="form-input">
                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-4">
                    <label for="inputName" class="col-form-label">Name:</label>
                    <input name="contact" required type="text" class="form-control form-control-sm" 
                      <?php $curCont = $newUser->usersContact($uId); 
                            echo "value=\"".$curCont."\"";
                      ?> 
                    >
                  </div>
                  <div class="col-sm-4">
                    <label for="inputValCode" class="col-form-label" >Validation Code:</label>
                    <input name="valCode" required type="password" class="form-control form-control-sm" placeholder="validation code...">
                  </div>
                  <div class="col-sm-2">
                    <label for="inputValCode" class="col-form-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <button class="btn btn-primary btn-sm">save</button>
                  </div>
                </div>
              </form>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-success col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" ></div>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-danger col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" style="display: inline-block;"></div>

              <br>
            </div>


            <div class="row">
              <label class="col-sm-2" style="font-family: arial narrow;">Email :</label>
              <div class="col-sm-8"><?php echo "<i style=\"color:#999; font-family:arial narrow; font-size:13px;\">".$newUser->usersEmail($uId)."</i>"; ?></div>
              <a  class=" account col-sm-2" style="font-family: arial narrow;">edit</a>
            </div>
            <div class="row accntClass" id="email" style="font-size: 12px ;">
              <form class="form-input">
                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-4">
                    <label for="inputName" class="col-form-label">Name:</label>
                    <input name="email" required type="text" class="form-control form-control-sm" 
                      <?php $curEmail = $newUser->usersEmail($uId); 
                            echo "value=\"".$curEmail."\"";
                      ?> 
                    >
                  </div>
                  <div class="col-sm-4">
                    <label for="inputValCode" class="col-form-label" >Validation Code:</label>
                    <input name="valCode" required type="password" class="form-control form-control-sm" placeholder="validation code...">
                  </div>
                  <div class="col-sm-2">
                    <label for="inputValCode" class="col-form-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <button class="btn btn-primary btn-sm">save</button>
                  </div>
                </div>
              </form>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-success col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" ></div>

              <div class="col-sm-1" style="display: inline-block;"></div>
              <div class="alert-danger col-sm-10" style="display: inline-block; border-radius: 4px;"></div>
              <div class="col-sm-1" style="display: inline-block;"></div>

              <br>
            </div>
            

          </div>
        </div>
      </div>
    </div>
  <br><br><br><br><br><br>
  </div>

  <div class="col-lg-2" style="background: #fff; border-left: 1px solid #efefef; position:relative;">
    
  </div>
</div>
  
<!--CONTENT END-->

<?php include 'footer.php'; ?>


<script>
  $(function () {
    
    $('.account').on('click',function () {
      $('.accntClass').hide();
      $(this).parent().next().toggle(); 
    });

    $('.form-input').on('submit',function (e) {
      e.preventDefault();
      var successSib = $(this).siblings('.alert-success');
      var dangerSib = $(this).siblings('.alert-danger');

      //console.log(successSib);
      $.ajax({
        type: 'POST' ,
        url: 'func/editAccount.php' ,
        data: new FormData(this) ,
        contentType: false,
        cache: false ,
        processData: false ,
        success:function (data) {
          $(successSib).html('');
          $(dangerSib).html('');
          if (data==1) {$(successSib).html('Edit Success...');}
          else if(data==0){$(dangerSib).html('Invalid Entry...');}
          else if(data==2){$(dangerSib).html("password must atleast 6 characters...");}
          else if(data==3){$(dangerSib).html("password doesn't match...");}
        }   
      });
    });

  });
</script>


