<?php 
require_once("config.php");
if(!empty($_POST["cid"])) {
    $cid= $_POST["cid"];
    $result =mysqli_query($bd, "SELECT studentRegistrationNo FROM enrollment WHERE course='$cid'");
	$count=mysqli_num_rows($result);
    if($count>0){
        echo "<span style='color:red'> Already Applied for this course.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } 
}
if(!empty($_POST["cid"])) {
	$cid= $_POST["cid"];
	$result =mysqli_query($bd, "SELECT * FROM enrollment WHERE course='$cid'");
	$count=mysqli_num_rows($result);
	$result1 =mysqli_query($bd, "SELECT * FROM course WHERE id='$cid'");
	$row=mysqli_fetch_array($result1);
}
?>