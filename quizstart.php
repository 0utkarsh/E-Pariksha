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
<?php
include_once 'dbConnection.php';
$eid=@$_REQUEST['eid'];
?>
<script>
function startTimer(duration, display) {
	var idi = '<?php echo $eid; ?>';
	
    var timer = duration, minutes, seconds;
    setInterval(function () {
		
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds ;
        var temp = timer-1;	
        document.cookie = "clock="+temp;
        if (timer-- == 0) {
        	alert("Times Up");
		}
		if(timer<=0)
            window.location.replace("account.php?q=result&eid="+idi);
        
    }, 1000);
}
</script>
<?php
include_once 'dbConnection.php';
$eid=@$_REQUEST['eid'];
$q1=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
$t=0;
while($row=mysqli_fetch_array($q1) ){
	$t=$row['time'];
}
if(isset($_COOKIE["clock"]))
			$clock = $_COOKIE["clock"];
		else
			$clock = $t*60;
		?>
<script>
	window.onload =function (){
    var fiveMinutes = <?php echo $clock; ?>,
    display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
	};

	
</script>

</head>

 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->


<?php
include_once 'dbConnection.php';
?>
<body>
<div class="header">
<div class="row">
<div class="col-md-6">
<span class="another">Dashboard</span></div></div></div>
<div class="col-md-12">
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



}?>


<br><br>
<?php
if(@$_REQUEST['q']== 'quiz' && @$_REQUEST['step']== 2) {
	$eid=@$_REQUEST['eid'];
	
	
	$q1=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
$t=0;
while($row=mysqli_fetch_array($q1) ){
	$t=$row['time'];
}


	
	
//$eid=@$_GET['eid'];
$sn=@$_REQUEST['n'];
$total=@$_REQUEST['t'];
date_default_timezone_set("Asia/Kolkata");
$now = time();
 $yo= date('Y-m-d H:i:s',$now);	
if($sn==1){
	$q2=mysqli_query($con,"SELECT * FROM history where email='$email' AND eid='$eid'" );
	$rowcount=mysqli_num_rows($q2);
	if($rowcount!=0)
	{
		echo '<script>
	window.location.replace("account.php?w=You cannot attempt a question/test more than once!");
    </script>';
	}
	else
	$q1=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid',0,0,0,0,'$yo') " );
}


echo  '<div class="col-md-11" style="text-align:center;color:green;font-family:typo"> <fieldset id = "timer" >
	<h1 >Time left : <span id="time" align="center"></span></h4>
	</fieldset></div><br>';

	
	
	

$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=htmlspecialchars($row['qns']);
$qid=$row['qid'];

$q1=mysqli_query($con,"SELECT * FROM qnset WHERE id='$qid' AND email='$email' " );
$rowcount=mysqli_num_rows($q1);
if($rowcount==0){
	$email=$_SESSION['email'];
	$q1=mysqli_query($con,"INSERT INTO qnset VALUES ('$email','$qid')");
}
else{
	//ob_flush();
	echo '<script>
	window.location.replace("account.php?w=You cannot attempt a question/test more than once!");
    </script>';
   
}

echo '<b>Question &nbsp;'.$sn.'&nbsp;:<br />'.$qns.'</b><br /><br />';
}
//$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form action="update.php" method="post"  class="form-horizontal">
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
echo'<input type="hidden" name="ans" value="null">';
echo '<div class="form-group">
  <label class="col-md-12 control-label" for="ans"></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="ans" class="form-control" placeholder="Write your answer here..."></textarea>  
  </div>
</div>';
echo'<input type="hidden" name="q" value="quiz" /><input type="hidden" name="step" value="2" />
<input type="hidden" name="eid" value="'.$eid.'" /><input type="hidden" name="n" value="'.$sn.'" />
<input type="hidden" name="t" value="'.$total.'" /><input type="hidden" name="qid" value="'.$qid.'" />';
echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';


echo '</div>';	
echo'<div style="color:red">Note: Refreshing, going back or leaving the window in any case will lead to submission of exam at this point</div>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
} ?>
</div>
</body>
</html>