<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Dashboard </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main1.css?version=51">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

<script>
$(function () {
    $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});</script>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>
</head>

<body  style="background:#eee;">
<div class="header">
<div class="row">
<div class="col-md-6">
<span class="another">Admin Zone</span></div>
<div class="col-md-6">
<?php
 include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
  if(!(isset($_SESSION['email']))){
	
header("location:index.php");

}
else
{
$name = $_SESSION['name'];
if($name!='Admin')
header("location:index.php");	
include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="dash.php" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=index.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Sign out</button></a></span>';
}?>
</div>
</div></div>
<!-- admin start-->

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
      <a class="navbar-brand" href="dash.php?q=0"><b>STCET E-Examination</b></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash.php?q=0"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Users<span class="sr-only">(current)</span></a></li>
		<li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dash.php?q=2"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;Ranking</a></li>
		<li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash.php?q=3"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>&nbsp;Feedbacks</a></li>
        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Test<span class="caret"></span></a>
          <ul class="dropdown-menu">
		    <li><a href="dash.php?q=6">Test-wise ranking</a></li>
            <li><a href="dash.php?q=4">Add Test</a></li>
            <li><a href="dash.php?q=5">Remove Test</a></li>
          </ul>
        </li>
      </ul>
          </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">
<!--home start-->
<div class="col-md-12" id="cont">


</div>

<?php if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td style="text-align:center"><b>Rank</b></td><td style="text-align:center"><b>Name</b></td><td style="text-align:center"><b>Year</b></td><td style="text-align:center"><b>Department</b></td><td style="text-align:center"><b>Score</b></td><td style="text-align:center"></td></tr>';
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

$a="Admin";
 if($name==$a)
	 continue;
 $c++;
echo '<tr><td style="color:#99cc32;text-align:center"><b>'.$c.'</b></td><td style="text-align:center">'.$name.'</td><td style="text-align:center">'.$gender.'</td><td style="text-align:center">'.$college.'</td><td style="text-align:center">'.$s.'</td><td>';
}
echo '</table></div>';}

?>


<!--home closed-->
<!--users start-->
<?php if(@$_GET['q']==0) {

$result = mysqli_query($con,"SELECT * FROM user") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Name</b></td><td style="text-align:center"><b>Year</b></td><td style="text-align:center"><b>Deapartment</b></td><td style="text-align:center"><b>Email</b></td><td style="text-align:center"><b>University roll no.</b></td><td style="text-align:center"></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$mob = $row['mob'];
	$gender = $row['year1'];
    $email = $row['email'];
	$college = $row['department'];
$a="Admin";
 if($name==$a)
	 continue;
 
	echo '<tr><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$name.'</td><td style="text-align:center">'.$gender.'</td><td style="text-align:center">'.$college.'</td><td style="text-align:center">'.$email.'</td><td style="text-align:center">'.$mob.'</td>
	<td style="text-align:center"><a title="Delete User" href="update.php?demail='.$email.'"  onClick="return confirm(\'Are you sure?\')"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
$c=0;
echo '</table></div>';

}?>
<!--user end-->

<!--feedback start-->
<?php if(@$_GET['q']==3) {
$result = mysqli_query($con,"SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Subject</b></td><td style="text-align:center"><b>Email</b></td><td style="text-align:center"><b>Date</b></td><td style="text-align:center"><b>Time</b></td><td style="text-align:center"><b>By</b></td><td style="text-align:center"></td><td style="text-align:center"></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$subject = htmlspecialchars($row['subject']);
	$name = htmlspecialchars($row['name']);
	$email = $row['email'];
	$id = $row['id'];
	 echo '<tr><td style="text-align:center">'.$c++.'</td>';
	echo '<td style="text-align:center"><a title="Click to open feedback" href="dash.php?q=3&fid='.$id.'#feedi">'.$subject.'</a></td><td style="text-align:center">'.$email.'</td><td style="text-align:center">'.$date.'</td><td style="text-align:center">'.$time.'</td><td style="text-align:center">'.$name.'</td>
	<td style="text-align:center"><a  title="Open Feedback" href="dash.php?q=3&fid='.$id.'#feedi"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	echo '<td style="text-align:center"><a title="Delete Feedback" href="update.php?fdid='.$id.'" onClick="return confirm(\'Are you sure?\')"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td>

	</tr>';
}
echo '</table></div>';
}
?>
<!--feedback closed-->

<!--feedback reading portion start-->
<a id="feedi">
<?php if(@$_GET['fid']) {

echo '<br />';
$id=@$_GET['fid'];
$result = mysqli_query($con,"SELECT * FROM feedback WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$name = htmlspecialchars($row['name']);
	$subject = htmlspecialchars($row['subject']);
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$feedback = htmlspecialchars($row['feedback']);
	
echo '<div class="panel"><a title="Back to Archive" href="dash.php?q=3"><b>Back to Feedbacks</b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$subject.'</b></h1>';
 echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>&nbsp;'.$date.'</span>
<span style="line-height:35px;padding:5px;">&nbsp;<b>Time:</b>&nbsp;'.$time.'</span><span style="line-height:35px;padding:5px;">&nbsp;<b>By:</b>&nbsp;'.$name.'</span><br />'.$feedback.'</div></div>';}
}?>
<!--Feedback reading portion closed-->
</a>
<!--add quiz start-->
<?php
if(@$_GET['q']==4 && !(@$_GET['step']) ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Test Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter Test title(16 chars max)" class="form-control input-md" type="text">
    
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="right"></label>  
  <div class="col-md-12">
  <input id="right" name="right" placeholder="Enter mark(s) per right answer" class="form-control input-md" min="0" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="wrong"></label>  
  <div class="col-md-12">
  <input id="wrong" name="wrong" placeholder="Enter negative mark(s) per wrong answer without sign" class="form-control input-md" min="0" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="time" name="time" placeholder="Enter time limit for test in minute(s)" class="form-control input-md" min="1" type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="tag"></label>  
  <div class="col-md-12">
  <input id="tag" name="tag" placeholder="Enter #tag which is used for searching" class="form-control input-md" type="text">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="desc"></label>  
  <div class="col-md-12">
  <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?>
<!--add quiz end-->

<!--add quiz step2 start-->

<?php
if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form  class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].' "  method="POST">
<fieldset>
';
 
 for($i=1;$i<=@$_GET['n'];$i++)
 {
echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="key'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="key'.$i.'" class="form-control" placeholder="Write keyword for question number '.$i.' here..."></textarea>  
  </div>
</div>';
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?><!--add quiz step 2 end-->

<!--remove quiz-->
<?php if(@$_GET['q']==5) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Topic</b></td><td style="text-align:center"><b>Total question</b></td><td style="text-align:center"><b>Marks</b></td><td style="text-align:center"><b>Time limit</b></td><td style="text-align:center"></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
	echo '<tr><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$title.'</td><td style="text-align:center">'.$total.'</td><td>'.$sahi*$total.'</td><td style="text-align:center">'.$time.'&nbsp;min</td>
	<td><b><a href="update.php?q=rmquiz&eid='.$eid.'"   class="pull-right btn sub1" style="margin:0px;background:red" onClick="return confirm(\'Are you sure?\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
}
$c=0;
echo '</table></div>';

}
?>

<!---quiz-wise ranking--->
<?php if(@$_GET['q']==6) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td style="text-align:center"><b>S.N.</b></td><td style="text-align:center"><b>Topic</b></td><td style="text-align:center"><b>Total question</b></td><td style="text-align:center"><b>Marks</b></td><td style="text-align:center"><b>Time limit</b></td><td style="text-align:center"></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
	echo '<tr><td style="text-align:center">'.$c++.'</td><td style="text-align:center">'.$title.'</td><td style="text-align:center">'.$total.'</td><td style="text-align:center">'.$sahi*$total.'</td><td style="text-align:center">'.$time.'&nbsp;min</td>
	<td><b><a href="dash.php?q=7&eid='.$eid.'"   class="pull-right btn sub1" style="margin:0px;background:yellowgreen"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Ranking</b></span></a></b></td></tr>';
}
$c=0;
echo '</table></div>';

}
?>
<!--particular quiz-wise rank--->
<?php if(@$_GET['q']==7 && (@$_GET['eid'])) {
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


</div><!--container closed-->
</div></div>
</body>
</html>
