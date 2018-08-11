<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/class.user.php");

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('http://www.managecoupon.com/home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$fname = trim($_POST['firstName']);
	$lname = trim($_POST['lastName']);
	$code = md5(uniqid(rand()));
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code,$fname,$lname))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to Manage Coupon!<br/>
						To complete your registration please, just click following link<br/>
						<br /><br />
						<a href='http://www.managecoupon.com/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks!";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Signup | Manage Coupon</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
  <div align ="center"><img src="images/logofinal.png" alt="logo area" class="brand" width ="180px" height ="36px" /></div>
        </br>
    <div class="container">
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        <input type="text" class="input-block-level" placeholder="Username" name="txtuname" required />
        <input type="text" class="input-block-level" placeholder="First Name" name="firstName" required />
        <input type="text" class="input-block-level" placeholder="Last Name" name="lastName" required />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
		     	<hr />
		<input type="checkbox" style="vertical-align:top;" required /><span><b> I have read and agree to the<a href="http://www.managecoupon.com/terms.html">
		Terms and Conditions and Privacy Policy.</a><b></span>
      </br></br>
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
        <a href="index.php" style="float:right;" class="btn btn-large">Sign In</a>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<div align="center">		
				
<span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=xbo8WnnH7UkEKwqLc62jJtkPLTvFDVRDNBQxTMgi6vD5K6CWv1QW0VSM7yRx"></script></span>
<script type="text/javascript" src="https://sealserver.trustwave.com/seal.js?code=26dc321ba0c24b6fb0fe27495bad1ea3"></script>

</div>