<?php
include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
//delete feedback
if(isset($_SESSION['key'])){
if(@$_GET['fdid'] && $_SESSION['key']=='utkarsh911') {
echo "<script type='text/javascript'>alert('Are you sure?');</script>";
$id=@$_GET['fdid'];
$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
header("location:dash.php?q=3");
}
}

//delete user
if(isset($_SESSION['key'])){
if(@$_GET['demail'] && $_SESSION['key']=='utkarsh911') {
echo "<script type='text/javascript'>alert('Are you sure?');</script>";
$demail=@$_GET['demail'];
echo "<script type='text/javascript'>alert('Are you sure?');</script>";
$r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
$r3 = mysqli_query($con,"DELETE FROM qnset WHERE email='$demail' ") or die('Error');
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:dash.php?q=0");
}
}
//remove quiz
if(isset($_SESSION['key'])){

if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='utkarsh911') {
echo "<script type='text/javascript'>alert('Are you sure?');</script>";
$eid=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$qid = $row['qid'];
$r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
}
$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

header("location:dash.php?q=5");
}
}

//add quiz
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='utkarsh911') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$total = $_POST['total'];
$sahi = $_POST['right'];
$wrong = $_POST['wrong'];
$time = $_POST['time'];
$tag = $_POST['tag'];
$desc = $_POST['desc'];
$id="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$id=substr(str_shuffle($id),0,20);
$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc','$tag', NOW())");

header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
}

//add question
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addqns' && $_SESSION['key']=='utkarsh911') {
$n=@$_GET['n'];
$eid=@$_GET['eid'];


for($i=1;$i<=$n;$i++)
 {
 $qid="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$qid=substr(str_shuffle($qid),0,20);
 $qns=$_POST['qns'.$i];
$q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$i')");
$aid="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$aid=substr(str_shuffle($aid),0,20);

$a=$_POST['key'.$i];



$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$a')");

 }
header("location:dash.php?q=0");
}
}

//quiz start
if(@$_REQUEST['q']== 'quiz' && @$_REQUEST['step']== 2) {
$eid=@$_REQUEST['eid'];
$sn=@$_REQUEST['n'];
$total=@$_REQUEST['t'];
$ans=@$_REQUEST['ans'];
$qid=@$_REQUEST['qid'];

if($ans!="null" || ans!=''){
$q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
while($row=mysqli_fetch_array($q) )
{
$ans1=$row['ansid'];
}
$ans=strtolower($ans);
$ans1=strtolower($ans1);
$ans=str_replace(' ', '', $ans);
$ans1=str_replace(' ', '', $ans1);
if($ans==$ans1)
{
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$sahi=$row['sahi'];
}

$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');
$q1=mysqli_query($con,"SELECT * FROM rank WHERE email='$email' ")or die('Error115');

$rowcount=mysqli_num_rows($q1);
if($rowcount == 0)
{
$q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$sahi',NOW())")or die('Error165');
}

while($row=mysqli_fetch_array($q1) )
{
$rs=$row['score'];
}

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$r=$row['sahi'];
}
$r++;
$s=$s+$sahi;
$rs=$rs+$sahi;
date_default_timezone_set("Asia/Kolkata");
$now = time();
 $yo= date('Y-m-d H:i:s',$now);	
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
$q1=mysqli_query($con,"UPDATE `rank` SET `score`=$rs  WHERE  email = '$email' ")or die('Error124');
} 
else
{
	
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$wrong=$row['wrong'];
}

$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
$q1=mysqli_query($con,"SELECT * FROM rank WHERE email='$email' ")or die('Error115');

$rowcount=mysqli_num_rows($q1);
$wr=0-$wrong;
if($rowcount == 0)
{
$q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$rs',NOW())")or die('Error165');
}

while($row=mysqli_fetch_array($q1) )
{
$rs=$row['score'];
}

while($row=mysqli_fetch_array($q) )
{
$wrong=$row['wrong'];
}

$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
}
$w++;
$s=$s-$wrong;
$rs=$rs-$wrong;
date_default_timezone_set("Asia/Kolkata");
$now = time();
 $yo= date('Y-m-d H:i:s',$now);	
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
$q1=mysqli_query($con,"UPDATE `rank` SET `score`=$rs  WHERE  email = '$email' ")or die('Error124');
}
}
if($sn != $total)
{
$sn++;
//header("location:quizstart.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
echo '<form action="quizstart.php" method="POST"  id="next" class="form-horizontal">
<br />';
if(isset($_POST['submit'])){
		$q=$_POST['q'];
    $step=$_POST['step'];
    $eid=$_POST['eid'];
	
    //$step=$_POST['step'];
    //$eid=$_POST['eid'];
	$n=$_POST['n'];
	$t=$_POST['t'];
	$qid=$_POST['qid'];
	}
	echo'<input type="hidden" name="q" value="quiz" /><input type="hidden" name="step" value="2" />
<input type="hidden" name="eid" value="'.$eid.'" /><input type="hidden" name="n" value="'.$sn.'" />
<input type="hidden" name="t" value="'.$total.'" /><input type="hidden" name="qid" value="'.$qid.'" />';
echo'<script>document.getElementById("next").submit();</script>';
echo'</form></div>';
//echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
//
}
/*else if( $_SESSION['email']!='utkarsh911@gmail.com')
{
$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
$rowcount=mysqli_num_rows($q);
if($rowcount == 0)
{
$q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
}
else
{
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$s+$sun;
$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
}
header("location:account.php?q=result&eid=$eid");
exit();
}*/
else
{
//header("location:account.php?q=result&eid=$eid");
echo '<form action="account.php" method="POST"  id="result" class="form-horizontal">
<br />';
if(isset($_POST['submit'])){
		$q=$_POST['q'];
    $step=$_POST['step'];
    $eid=$_POST['eid'];
	
    //$step=$_POST['step'];
    //$eid=$_POST['eid'];
	$n=$_POST['n'];
	$t=$_POST['t'];
	$qid=$_POST['qid'];
	}
	echo'<input type="hidden" name="q" value="result" />
<input type="hidden" name="eid" value="'.$eid.'" />
';
echo'<script>document.getElementById("result").submit();</script>';
echo'</form></div>';
}
}

//restart quiz
/*if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
$eid=@$_GET['eid'];
$n=@$_GET['n'];
$t=@$_GET['t'];
$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$sun-$s;
$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}*/

//change password
 if(@$_GET['q']== 7 ){
$email=$_SESSION["email"];

//$conn = mysqli_connect("localhost", "root", "", "project") or die("Connection Error: " . mysqli_error($conn));


    $result = mysqli_query($con, "SELECT * from user WHERE email='$email'");
    while($row = mysqli_fetch_array($result)){
		$password = $row["password"];
		$currentPassword=md5(@$_POST["currentPassword"]);
		$newPassword=md5(@$_POST["newPassword"]);
		
    if ( $currentPassword==$password) {
        mysqli_query($con, "UPDATE user set password='" . $newPassword . "' WHERE email='" . $email . "'");
        $message="Password changed successfully";
		header("location:account.php?q8=$message");
    } else{
        $message="Current Password is incorrect, kindly try again";
	     header("location:account.php?q7=$message");
	}
	}
	




 }
?>
