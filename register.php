<?php include ("header.php") ?>

<?php

 //if( isset($_SESSION['user'])!="" ){
  //header("Location: home.php");
 //}

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
     
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

     $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
     $code = '';
     $max = strlen($characters) - 1;
     for ($i = 0; $i < 5; $i++) {
         $code .= $characters[mt_rand(0, $max)];
     }

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  else {
      $query = "SELECT userName FROM dbuser WHERE userName='$name'";
      $result = mysqli_query($conn, $query);
      $count = mysqli_num_rows($result);
      if($count!=0){
          $error = true;
          $nameError = "Provided userName is already in use.";
      }
  }
     
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM dbuser WHERE userEmail='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);

  //captcha validation
    if($_POST['captcha'] != $_SESSION['digit']){ 
	$captchaerror = "Sorry, the CAPTCHA code entered was incorrect!"; }
    


$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$name.'
Password: '.$pass.'
------------------------
 
Please type in the following verification code to Fully Sign Up: '.$code.' 
';
                     
$headers = 'From:noreply@stuweb.cms.gre.ac.uk' . "\r\n"; // Set from headers

  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO dbuser(userName,userEmail,userPass,code) VALUES('$name','$email','$password','$code')";
   $res = mysqli_query($conn, $query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully entered the details, please check your email for activation code";
    unset($name);
    unset($email);
    unset($pass);
    mail($to, $subject, $message, $headers); // Send our email
       header("Location: verify.php");
    
  } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }
  
 }
?>

<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype="multipart/form-data">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Sign Up.</h2>
            </div>
        
         <div class="form-group">
             <hr/>
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
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
             <input type="text" name="name" class="form-control" maxlength="50" value="<?php echo $name ?>" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
         
            <div class="form-group">
                <label>Enter Email:</label>
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                 <input type="text" name="email" class="form-control" maxlength="40" value="<?php echo $email ?>" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
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
             <div class="input-group">
				<label>Picture: </label><img src="captcha.php" width="160" height="45" alt="Captcha"/>
                </div>
            </div>

         <div class="form-group">
             <label>Enter The Code Shown in the Picture:</label>
             <div class="input-group">
                 <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                 <input type="text"  class="form-control"  maxlength="100" name="captcha" value=""/>
             </div>
             <span class="text-danger"><?php echo $captchaerror; ?></span>
         </div>



            <div class="form-group">
             <hr/>
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
             <hr/>
            </div>
            
            <div class="form-group">
             <a href="login.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

<?php include ("footer.php") ?>

<?php ob_end_flush(); ?>