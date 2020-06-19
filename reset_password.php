<html>
<head>
<script>
function validate_password_reset() {
var currentPassword,newPassword,confirmPassword;


newPassword = document.frmReset.member_password;
confirmPassword = document.frmReset.confirm_password;


if(!newPassword.value) {
newPassword.focus();
alert("New Password cannot be empty");
return false;
}
var len=newPassword.value.length;
if(len<5 || len>25)
{
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
alert("Passwords must be 5 to 25 characters long.");
return false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
alert("Passwords did not match");
return false;
} 	
return true;
}
</script>
<link href="main1.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php

include_once 'dbConnection.php';
$id=$_GET['id'];
$email=$_GET['email'];
    if(@$_REQUEST['q']==1 ){
		$email=$_REQUEST['email'];
         $qmail=$_REQUEST['email'];
 $qid=$_REQUEST['id'];
 date_default_timezone_set('Asia/Kolkata');
 $now = time();
 $expires_at= date('Y-m-d H:i:s',$now);	
 //echo $expires_at;
 $r2 = mysqli_query($con,"SELECT * FROM reset WHERE id='$qid' ") or die('Error');
 while($row = mysqli_fetch_array($r2)) {
	 if($expires_at>$row['expires']){
		$result3 = mysqli_query($con,"DELETE FROM reset WHERE email='$qmail' ") or die('Error2');
        header("location:forgot.php?w='Link expired!'");
		 exit();
	 }
 }
 if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM reset WHERE id='$qid' "))==0){
	 header("location:forgot.php?w='Link expired!'");
	 exit();
 }
 
		
	if(isset($_POST["reset-password"])) {
		
		$con = mysqli_connect("localhost", "root", "", "project");
		//$email=$_GET['email'];
		
		
			$email=$_GET['email'];
         $qmail=$_GET['email'];
 
 //echo $expires_at;
 $r2 = mysqli_query($con,"SELECT * FROM reset WHERE id='$qid' ") or die('Error');
 while($row = mysqli_fetch_array($r2)) {
	 if($expires_at>$row['expires']){
		$result3 = mysqli_query($con,"DELETE FROM reset WHERE email='$qmail' ") or die('Error2');
        header("location:forgot.php?w='Link expired!'");
		 exit();
	 }
 }
 if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM reset WHERE id='$qid' "))==0){
	 header("location:forgot.php?w='Link expired!'");
	 exit();
 }
 
		
		$password=md5($_POST["member_password"]);
		//$sql = "UPDATE user SET password = '" . md5($_POST["member_password"]). "' WHERE email = $email";
		$result = mysqli_query($con,"UPDATE `user` SET `password`='$password' WHERE email='$email'");
	    $result1 = mysqli_query($con,"DELETE FROM reset WHERE email='$email' ") or die('Error2');
		$success_message = "Password reset successfully.";
		
		// header("location:index.php?w1='$success_message'");
		// exit();
		
	}
	}
?>



<form name="frmReset" id="frmReset" method="post" action="reset_password.php?q=1&email=<?php echo $_GET['email']; ?>&id=<?php echo $_GET['id']; ?>" onSubmit="return validate_password_reset();">
 <?php 
 if($_GET['q']!=1){
 include_once 'dbConnection.php';
 $qmail=$_GET['email'];
 $qid=$_GET['id'];
 date_default_timezone_set('Asia/Kolkata');
 $now = time();
 $expires_at= date('Y-m-d H:i:s',$now);	

 $r2 = mysqli_query($con,"SELECT * FROM reset WHERE id='$qid' ") or die('Error');
 while($row = mysqli_fetch_array($r2)) {
	 if($expires_at>$row['expires']){
		$result3 = mysqli_query($con,"DELETE FROM reset WHERE email='$qmail' ") or die('Error2');
        header("location:forgot.php?w='Link expired!'");
		 exit();
	 }
 }
 
 $r1 = mysqli_query($con,"SELECT * FROM reset WHERE id='$qid' ") or die('Error');
 
 while($row = mysqli_fetch_array($r1)) {
	 if($qmail!=$row['email']){
		 
		 header("location:forgot.php?w='Invalid Link!'");
		 exit();
	 }
 }
 
 if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM reset WHERE id='$qid' "))==0){
	 header("location:forgot.php?w='Invalid Link!'");
	 exit();
 }
 
 }
 ?>
 <h1>Reset Password</h1>

 
 
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?><?php echo '<br><br>' ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?><?php echo '<br><br>' ?>
	<?php } ?>
	</div>

	<div class="field-group">
		<div><label for="Password">Password</label></div>
		<div>
		<input type="password" name="member_password" id="member_password" class="input-field"></div>
	</div>
	
	<div class="field-group">
		<div><label for="email">Confirm Password</label></div>
		<div><input type="password" name="confirm_password" id="confirm_password" class="input-field"></div>
	</div>
	
	<div class="field-group">
		<br>	<div><input type="submit" name="reset-password" id="reset-password" value="Reset Password" class="form-submit-button"></div>
	</div>	
</form>
</body>
</html>		