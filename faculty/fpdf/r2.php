<?php
require ("fpdf.php");

$db=new PDO('mysql:host=localhost;dbname=onlinecourse','root','');
         
class mypdf extends FPDF{
	
function Header()
{	
	$this->Image('cecs.png',10,6,30);

  $this->SetFont('Arial', 'B', 15);
    $this->Cell(0, 10, $this->title, 10, 10, 'C');
   
$this->Ln();
$this->Ln();
$this->Ln();


}

function footer(){

$this->SetY(-15);
$this->SetFont('Arial','',8);
$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');

}

function headerTable($db){
$id=$_GET['id'];  
	$stmnt=$db->query("SELECT course.courseName,course.courseCode FROM course,courseenrolls WHERE course.id=courseenrolls.id AND course.id=".$id);


	while($data=$stmnt->fetch(PDO::FETCH_OBJ)){
	$this->Cell(130,10,$data->courseName,1,0,'L');
	$this->Cell(50,10,$data->courseCode,1,0,'L');
	$this->Ln();
	$this->Ln();
	$this->Ln();
	$this->SetFont('times','B',12);
	$this->Cell(130,10,'Student name',1,0,'C');
	$this->Cell(50,10,'Pincode',1,0,'C');
	$this->Ln();

	}

}

function viewTable($db){

$this->SetFont('times','B',12);
	$id=$_GET['id'];  
	$stmnt=$db->query("SELECT students.studentName,students.StudentRegno FROM courseenrolls,students WHERE students.StudentRegno=courseenrolls.studentRegno AND courseenrolls.course=".$id);

	while($data=$stmnt->fetch(PDO::FETCH_OBJ)){
	$this->Cell(130,10,$data->studentName,1,0,'L');
	$this->Cell(50,10,$data->StudentRegno,1,0,'L');
	$this->Ln();
}
}







}


$pdf=new mypdf();
$pdf->title = 'Class list';

$pdf->Addpage('P','A4',0);

$pdf->headerTable($db);
$pdf->viewTable($db);
$pdf->AliasNbPages();
$pdf->Output();

?>