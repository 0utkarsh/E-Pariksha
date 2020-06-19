
<?php
include_once 'dbConnection.php';
session_start();
if(@$_GET['q']==1){
	if(!empty($_POST["forgot-password"])){
		$con = mysqli_connect("localhost", "root", "", "project");
		
		$condition = "";
		
		if(!empty($_POST["user-email"])) {
			
			$condition = " email = '" . $_POST["user-email"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "Select * from user " . $condition;
		$result = mysqli_query($con,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			require_once("forgot-password-recovery-mail.php");
		} else {
			$error_message = 'No User Found';
		}
	}
}
?>
<link href="main1.css" rel="stylesheet" type="text/css">
<script>
function validate_forgot() {
	if((document.getElementById("user-email").value == "")) {
		//document.getElementById("validation-message= "Login name or Email is required!";
		alert("Email cannot be empty!");
		return false;
	}
	return true
}
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>STCET Online Examination System</title>
<link  rel="stylesheet" href="/css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="/css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="/css/main1.css?version=51">
 <link  rel="stylesheet" href="/css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
</head>

<body style="background-color:#CC00DC">
<div class="header">
<div class="row">
<div class="col-lg-6"><span class="logo">STCET Online Examination System</span></div>
<br><br><br>
<div class="col-lg-12" >
<?php
echo '<a href="index.php" class="pull-left sub1 btn title3" ><span class="glyphicon glyphicon-arrow-left aria-hidden="true"></span>&nbsp;Back</a>&nbsp;';
?>
</div>
<form name="frmForgot" id="frmForgot" method="post" action="forgot.php?q=1" onSubmit="return validate_forgot();">
<div>

<h1 style="text-align:center;font-family:typo;color:#E1FF00">Forgot Password ?</h1>
	<?php if(!empty($success_message)) { ?>
	<div class="success_message" style="text-align:center;color:white;font-size:30px"><?php echo "<br>'$success_message'"; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<div class="success_message" style="text-align:center;color:white;font-size:30px"><?php echo "<br>'$error_message'"; ?></div>
	<?php } ?>
	</div>
    <br>
	
	<div class="field-group">
		<div style="text-align:center"><label for="email">Email</label></div>
		<div style="text-align:center"><input type="text" name="user-email" id="user-email" class="input-field" style="border-radius: 5px;"></div>
	</div>
	<br>
	<div class="field-group">
		<div style="text-align:center"><input type="submit" name="forgot-password" id="forgot-password" value="Submit" style="border-radius: 5px;" class="form-submit-button"></div>
	</div>
</div>	
</form>
</body>
</html>