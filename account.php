<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>STCET Online Examination System </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main1.css?version=51">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->
<script>



function validatePassword() {
var currentPassword,newPassword,confirmPassword;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
alert("Current Password cannot be empty");
return false;
}
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

<?php
include_once 'dbConnection.php';
?>
<body>
<div class="header">
<div class="row">
<div class="col-md-6">
<span class="another">Dashboard</span></div>
<div class="col-md-6">
 <?php
 include_once 'dbConnection.php';
session_start();
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];
if($name=='Admin')
	header("location:dash.php");
include_once 'dbConnection.php';
$arr = explode(" ", $name, 2);
$firstname = $arr[0];
ob_start();
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Hello,</span> <a href="account.php?q=1" class="log">'.$firstname.'</a>&nbsp;|&nbsp;<a class="logwa2" href="#myModal"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;Change password</a>&nbsp;|<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Sign out</button></a></span>';

}?>
</div>
</div></div>
<div class="bg">
<!--change password-->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content title1">
      <div class="modal-header">

		 
        <h3 class="modal-title title1"><span style="color:orange"><b>Change password</b></span></h3>
		 
      </div>
	 
      <div class="modal-body">
<form name="frmChange" method="post" onSubmit="return validatePassword()" action="update.php?q=7" >
<div style="width:500px;">
<!--<div class="message"> //if(isset($message)) { echo $message; } ?></div>-->
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2"></td>
</tr>
<tr>
<td width="40%"><label><h4>Current Password</h4></label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label><h4>New Password</h4></label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label><h4>Confirm Password</h4></label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>


<td colspan="1"></td>
<td colspan="2"><input type="submit" name="submit"   class="btn btn-default"></td>&nbsp;&nbsp;
<td colspan="1"> <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;Close</button></td>
</tr>
</table>
</div>
</form>
</div></div></div></div>
<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="navbar-brand"><b>STCET E-Examination</b></span>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;Ranking<span class="caret"></span></a>
          <ul class="dropdown-menu">
		    <li><a href="account.php?q=5">Quiz-wise ranking</a></li>
            <li><a href="account.php?q=4">Overall ranking</a></li>
          </ul>
        </li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
     <li>
	 <form class="navbar-form navbar-left"  action="" >
        <div class="form-group">
          <input type="text" class="form-control" name="tag" placeholder="Enter tag ">
        </div>
		    <div class="form-group">
        <button type="submit"  class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search</button>
      </div>
	  </form>
	  </li>
	  </ul>
	 </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">
<?php if(@$_GET['q7'])
{ echo'<p style="color:red;font-size:35px;text-align:center">'.@$_GET['q7'];}?>
<?php if(@$_GET['q8'])
{ echo'<p style="color:green;font-size:35px;text-align:center">'.@$_GET['q8'];}?>

<!--search-->
<?php if(@$_GET['tag']) {
	
$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Topic</b></td><td style="text-align:center"><b>Total questions</b></td><td style="text-align:center"><b>Marks</b></td><td style="text-align:center"><b>Time limit</b></td><td style="text-align:center"><b>Description<b></td style="text-align:center"><td style="text-align:center"></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
	$tag = $row['tag'];
	if($tag!=@$_GET['tag'] && $title!=@$_GET['tag'])
		continue;
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$title.'</td><td style="text-align:center">'.$total.'</td><td style="text-align:center">'.$sahi*$total.'</td><td style="text-align:center">'.$time.'&nbsp;min</td>
	<td style="text-align:center"><a title="Open quiz description" href="account.php?q=1&did='.$eid.'#didi"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>
	<td style="text-align:center"><b><form action="quizstart.php" method="post" >';
	if(isset($_POST['submit'])){
		$q=$_POST['q'];
    $step=$_POST['step'];
    $eid=$_POST['eid'];
	
    //$step=$_POST['step'];
    //$eid=$_POST['eid'];
	$n=$_POST['n'];
	$t=$_POST['t'];
	}
	echo '<input type="hidden" name="q" value="quiz" /><input type="hidden" name="step" value="2" />
	<input type="hidden" name="eid" value="'.$eid.'" /><input type="hidden" name="n" value="1" /><input type="hidden" name="t" value="'.$total.'"/>
	<span class="title1"><b><input class="pull-center btn sub1" style="margin:0px;background:#99cc32;text-align:center;font-weight:bold"  type="submit" value="Start" ></b></form></b></td></tr>';
       
	  if(isset($_POST['submit'])){
		$q=$_POST['q'];
    $step=$_POST['step'];
    $eid=$_POST['eid'];
	
    //$step=$_POST['step'];
    //$eid=$_POST['eid'];
	$n=$_POST['n'];
	$t=$_POST['t'];
	}
}
else
{
echo '<tr style="color:#99cc32"><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td style="text-align:center">'.$total.'</td><td style="text-align:center">'.$sahi*$total.'</td><td style="text-align:center">'.$time.'&nbsp;min</td>
	<td style="text-align:center"><a title="Open quiz description" href="account.php?q=1&did='.$eid.'#didi"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>
	<td style="text-align:center"><b><span class="title1" style="text-align:center"><b>Submitted</b></span></b></td></tr>';
}
}
$c=0;
echo '</table></div>';

}
?>

<!--home start-->
<?php if(@$_GET['q']==1) {
	
date_default_timezone_set("Asia/Kolkata");
        ob_start();
		setcookie("clock", "", time() - 3600);
		ob_end_flush();
		
	class MyMemcachedSessionHandler extends SessionHandler {
    public function read($id)
    {
        $data = parent::read($id);
        if(empty($data)) {
            return '';
        } else {
            return $data;
        }
    } 
}


$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Topic</b></td><td style="text-align:center"><b>Total questions</b></td><td style="text-align:center"><b>Marks</b></td><td style="text-align:center"><b>Time limit</b></td><td style="text-align:center"><b>Description<b></td><td  style="text-align:left"></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	if(isset($_POST['submit'])){
		$q=$_POST['q'];
    $step=$_POST['step'];
    $eid=$_POST['eid'];
	
    //$step=$_POST['step'];
    //$eid=$_POST['eid'];
	$n=$_POST['n'];
	$t=$_POST['t'];
	}
	echo '<tr><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$title.'</td><td style="text-align:center">'.$total.'</td><td style="text-align:center">'.$sahi*$total.'</td><td style="text-align:center">'.$time.'&nbsp;min</td>
	<td style="text-align:center"><a title="Open quiz description" href="account.php?q=1&did='.$eid.'#didi"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>
	<td style="text-align:center"><b><form action="quizstart.php" method="post" >';
	if(isset($_POST['submit'])){
		$q=$_POST['q'];
    $step=$_POST['step'];
    $eid=$_POST['eid'];
	
    //$step=$_POST['step'];
    //$eid=$_POST['eid'];
	$n=$_POST['n'];
	$t=$_POST['t'];
	}
	echo '<input type="hidden" name="q" value="quiz" /><input type="hidden" name="step" value="2" />
	<input type="hidden" name="eid" value="'.$eid.'" /><input type="hidden" name="n" value="1" /><input type="hidden" name="t" value="'.$total.'"/>
	<span class="title1"><b><input class="pull-center btn sub1" style="margin:0px;background:#99cc32;text-align:center;font-weight:bold"  type="submit" value="Start" ></b></form></b></td></tr>';
       
	  if(isset($_POST['submit'])){
		$q=$_POST['q'];
    $step=$_POST['step'];
    $eid=$_POST['eid'];
	
    //$step=$_POST['step'];
    //$eid=$_POST['eid'];
	$n=$_POST['n'];
	$t=$_POST['t'];
	}
}
else
{
echo '<tr style="color:#99cc32"><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td style="text-align:center">'.$total.'</td><td style="text-align:center">'.$sahi*$total.'</td><td style="text-align:center">'.$time.'&nbsp;min</td>
	<td style="text-align:center"><a title="Open quiz description" href="account.php?q=1&did='.$eid.'#didi"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>
	<td style="text-align:center"><b><span class="title1" style="text-align:center"><b>Submitted</b></span></b></td></tr>';
}
}
$c=0;
echo '</table></div>';

}?>

<a id="didi">
<?php if(@$_GET['did']) {

echo '<br />';
$id=@$_GET['did'];
$result = mysqli_query($con,"SELECT * FROM quiz WHERE eid='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$description = $row['intro'];
  echo '<div class="panel"><a title="Back to Archive" href="account.php?q=1"><b>Back to Home</b></a><br><br><b>Description : '.$description.'</b></div>';

 }
}?>
</a>


<!--home closed--> 	

<!--quiz start-->
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
	$eid=@$_GET['eid'];
	
	
	$q1=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
$t=0;
while($row=mysqli_fetch_array($q1) ){
	$t=$row['time'];
}

	if(isset($_COOKIE["clock"]))
			$clock = $_COOKIE["clock"];
		else
			$clock = $t*60;

	
	
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];



echo  "<fieldset id = 'timer'>
	<h4>Time Left : <span id='time'></span></h4>
	</fieldset>";

	
	
	

$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=$row['qns'];
$qid=$row['qid'];
echo '<b>Question &nbsp;'.$sn.'&nbsp;:<br />'.$qns.'</b><br /><br />';
}
$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
<br />';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$optionid=$row['optionid'];
echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
}
echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';

echo '</div>';	
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
//result display
if(@$_REQUEST['q']== 'result' && @$_REQUEST['eid']) 
{

$eid=@$_REQUEST['eid'];

$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
echo '<tr style="color:#66CCFF"><td>Questions Attempted</td><td>'.$qa.'</td></tr>
      <tr style="color:#99cc32"><td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
$c=0;

echo '</table></div>';

}
?>
<!--quiz end-->

<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red;text-align:center"><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Quiz</b></td><td style="text-align:center"><b>Total Questions</b></td><td style="text-align:center"><b>Question Solved</b></td><td style="text-align:center"><b>Right</b></td><td style="text-align:center"><b>Wrong<b></td><td style="text-align:center"><b>Full marks</b></td><td style="text-align:center"><b>Marks obtained</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT * FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$tq=$row['total'];
$title=$row['title'];
$sahi=$row['sahi'];
}
$c++;
$fm=$sahi * $tq;
echo '<tr><td style="text-align:center">'.$c.'</td><td style="text-align:center">'.$title.'</td><td style="text-align:center">'.$tq.'</td><td style="text-align:center">'.$qa.'</td><td style="text-align:center">'.$r.'</td><td style="text-align:center">'.$w.'</td><td style="text-align:center">'.$fm.'</td><td style="text-align:center">'.$s.'</td></tr>';
}
echo'</table></div>';
	echo'
<form class="form-inline" method="post" action="Performance analysis.php">
<button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary"><i class="fa fa-pdf"" aria-hidden="true"></i>
Generate PDF</button>
</form>';
}

//ranking start
if(@$_GET['q']== 4) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td style="text-align:center"><b>Rank</b></td><td style="text-align:center"><b>Name</b></td><td style="text-align:center"><b>Year</b></td><td style="text-align:center"><b>Department</b></td><td style="text-align:center"><b>Total Score</b></td><td style="text-align:center"></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['year1'];
$college=$row['department'];
}
$c++;
echo '<tr><td style="color:#99cc32;text-align:center"><b>'.$c.'</b></td><td style="text-align:center">'.$name.'</td><td style="text-align:center">'.$gender.'</td><td style="text-align:center">'.$college.'</td><td style="text-align:center">'.$s.'</td><td>';
}
echo '</table></div>';}
?>

<?php if(@$_GET['q']== 5) 
{
$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Topic</b></td><td style="text-align:center"><b>Total questions</b></td><td style="text-align:center"><b>Marks</b></td><td style="text-align:center"><b>Time limit</b></td><td style="text-align:center"></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
	echo '<tr><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$title.'</td><td style="text-align:center">'.$total.'</td><td style="text-align:center">'.$sahi*$total.'</td><td style="text-align:center">'.$time.'&nbsp;min</td>
	<td><b><a href="account.php?q=6&eid='.$eid.'"   class="pull-right btn sub1" style="margin:0px;background:yellowgreen"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Ranking</b></span></a></b></td></tr>';
}
$c=0;
echo '</table></div>';
}
?>

<?php if(@$_GET['q']==6 && (@$_GET['eid'])) {
$id=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM history WHERE history.eid='$id' ORDER BY score DESC") or die('Error');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td style="text-align:center"><b>Rank</b></td><td style="text-align:center"><b>Name</b></td><td style="text-align:center"><b>Year</b></td><td style="text-align:center"><b>Department</b></td><td style="text-align:center"><b>Score</b></td><td style="text-align:center"></td></tr>';
$c=0;
while($row=mysqli_fetch_array($result) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['year1'];
$college=$row['department'];
}


$c++;
echo '<tr><td style="color:#99cc32;text-align:center"><b>'.$c.'</b></td><td style="text-align:center">'.$name.'</td><td style="text-align:center">'.$gender.'</td><td style="text-align:center">'.$college.'</td><td style="text-align:center">'.$s.'</td><td>';
}
echo '</table></div>';

}
?>



</div></div></div></div>
<!--Footer start-->

<!--footer end-->

</body>
</html>
