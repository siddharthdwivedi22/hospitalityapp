
<?php require("header.php") ?>

<?php

 $error = false;
 
 if( isset($_POST['btn-login']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
  
  if(empty($name)){
   $error = true;
   $nameError = "Please enter your userName.";
  }
  
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
  
  // if there's no error, continue to login
  if (!$error) {
   
   $password = hash('sha256', $pass); // password hashing using SHA256
  
   $res=mysqli_query($conn,"SELECT ID, userEmail, userPass FROM dbuser WHERE userName='$name'");
   $row=mysqli_fetch_array($res);
   $count = mysqli_num_rows($res); // if email/pass correct it returns must be 1 row

      $search = mysqli_query($conn, "SELECT userName, userPass FROM dbuser WHERE active='0'") or die(mysqli_error());
      $match  = mysqli_num_rows($search);
      $row1 = mysqli_fetch_array($search);
   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['ID'];
       $res1=mysqli_query($conn,"SELECT * FROM dbuser WHERE ID=".$_SESSION['user']);
       $userRow=mysqli_fetch_assoc($res1);
       $_SESSION['username'] = $userRow['userName'];
     header("Location: home.php");
   }


   else if($match>0 && $row1['userName'] == $name && $row1['userPass'] == $password) {
      header("Location:verify.php");

   }
   else {
    $errMSG = "Incorrect Credentials, Try again...";
   }

  }

 }
?>
<?php
$cookie_name = "username";
$cookie_value = $_SESSION['username'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>


<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Sign In.</h2>
            </div>
        
         <div class="form-group">
             <hr/>
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
                <label>Enter Username:</label>
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                 <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
                <label>Enter Password:</label>
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
             <hr/>
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            
            <div class="form-group">
             <hr/>
            </div>
            
            <div class="form-group">
             <a href="register.php">Sign Up Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

<?php include ("footer.php") ?>

