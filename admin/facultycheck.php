<?php 
require_once("includes/config.php");
if(!empty($_POST["regno"])) {
	$regno= $_POST["regno"];
	
		$result =mysqli_query($con,"SELECT Username FROM Faculty WHERE Username='$regno'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Instructor with this Usernamename is Already Registered.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	

}
}


?>
