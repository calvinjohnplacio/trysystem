<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$id=$_GET['id'];
if(isset($_POST['submit']))
{
$coursecode=$_POST['coursecode'];
$coursename=$_POST['coursename'];
$courseunit=$_POST['courseunit'];
$seatlimit=$_POST['seatlimit'];
$ret=mysqli_query($con,"insert into course(courseCode,courseName,courseUnit,noofSeats) values('$coursecode','$coursename','$courseunit','$seatlimit')");
if($ret)
{
$_SESSION['msg']="Course Created Successfully !!";
}
else
{
  $_SESSION['msg']="Error : Course not created";
}
}
if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from course where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Course deleted !!";
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Course</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        
                                            <th>student name</th>
                                            <th>pincode </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"SELECT students.studentName,students.pincode FROM courseenrolls,students WHERE students.StudentRegno=courseenrolls.studentRegno AND courseenrolls.course=".$id);
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['pincode']);?></td>
                                            
                                           
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                            <center>
                             <a href="fpdf/r2.php?id=<?php echo $id?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i>Print</button> </a>
</center>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>





        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <br><br><br><br><br>

  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>



