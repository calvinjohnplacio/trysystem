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



}

function footer(){

$this->SetY(-15);
$this->SetFont('Arial','',8);
$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');

}

function headerTable($db){

	


	
	
	$this->Ln();
	$this->Ln();
	$this->Ln();
	$this->SetFont('times','B',12);

	$this->SetFont('Arial', 'B', 8);
$this->Cell(180,5,'Notice: The default password for student accounts is "password" after logging in change it immediately for security purposes',1,0,'C');
	$this->Ln();
	$this->Cell(180,5,'Notice: if your request a reset password to the admin the password is "test@123" ',1,0,'C');
	$this->Ln();
	$this->Cell(80,5,'Student register no',1,0,'C');
	$this->Cell(50,5,'Student name',1,0,'C');
	$this->Cell(50,5,'Pincode',1,0,'C');

	$this->Ln();

	}

function viewTable($db){

$this->SetFont('times','B',9);
	 
	$stmnt=$db->query("SELECT * FROM students");

	while($data=$stmnt->fetch(PDO::FETCH_OBJ)){
	$this->Cell(80,5,$data->StudentRegno,1,0,'L');
	$this->Cell(50,5,$data->studentName,1,0,'L');
	$this->Cell(50,5,$data->pincode,1,0,'L');
	$this->Ln();
}

}	

}











$pdf=new mypdf();
$pdf->title = 'Student List';

$pdf->Addpage('P','A4',0);

$pdf->headerTable($db);
$pdf->viewTable($db);
$pdf->AliasNbPages();
$pdf->Output();

?>