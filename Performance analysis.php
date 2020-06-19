<?php
require_once("connection.php");
require_once("dbConnection.php");
session_start();
if(!isset($_SESSION['email'])){
	header("location:index.php");
}
$db_handle = new DBController();
$year1=$_SESSION['year1'];

$name = $_SESSION['name'];
$email=$_SESSION['email'];
$q1=mysqli_query($con,"SELECT * FROM user WHERE email='$email' " )or die('Error231');



	

ob_start();
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);	
$pdf->Image('image/logo1.png', 64, 8);
$pdf->SetFont('Times', 'B', 20); 
$pdf->Cell(187, 180, 'Performance Analysis', 0, 2, 'C');
$pdf->SetFont('Times', 'B', 15); 
$pdf->SetY(110);
$pdf->SetX(80);
$pdf->Cell(36,12,'Name:', 0, 0, 'L');
$pdf->SetY(110);
$pdf->SetX(96);
$pdf->Cell(36,12,$name , 0,1, 'L');
$pdf->SetY(120);
$pdf->SetX(80);
$pdf->Cell(36,12,'Year(number):', 0, 0, 'L');

while($row=mysqli_fetch_array($q1) ){
$year1=$row['year1'];
$pdf->Cell(36,12,$year1 , 0,1, 'L');
}
$q1=mysqli_query($con,"SELECT * FROM user WHERE email='$email' " )or die('Error231');
$pdf->SetY(130);
$pdf->SetX(80);
$pdf->Cell(36,12,'Department:', 0, 0, 'L');
$pdf->SetY(130);
$pdf->SetX(110);
while($row=mysqli_fetch_array($q1) ){
$department=$row['department'];
$pdf->Cell(36,12,$department, 0, 1, 'L');
}


$pdf->SetFont('Times', 'B', 14); 

$header = array('Quiz','Total questions','Full marks', 'Correct', 'Incorrect','Marks obtained');	

$pdf->SetY(150);
$pdf->SetX(2);
foreach($header as $heading) {

		$pdf->Cell(34.5,12,$heading,1,' ','C');
}
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];

$q23=mysqli_query($con,"SELECT * FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
$qa=$row['total'];
$r1=$row['sahi'];
}
$fm=$r1 * $qa;
$c++;

$result=array($title,$qa,$fm,$r,$w,$s);
$pdf->ln();
$pdf->SetX(2);
foreach($result as $row) {
	$pdf->SetFont('Arial','B',12);	
	
	
		$pdf->Cell(34.5,12,$row,1,'','C');
	}

}
$pdf->Output();
ob_end_flush(); 
?>