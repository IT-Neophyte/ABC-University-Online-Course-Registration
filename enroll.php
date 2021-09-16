<?php
session_start();
include('config.php');
if(isset($_POST['submit'])){
    $studentRegistrationNo=$_POST['studentRegistrationNo'];
    $dept=$_POST['department'];
    $sem=$_POST['semester'];
    $course=$_POST['course'];
    $ret=mysqli_query($bd, "INSERT INTO enrollment (studentRegistrationNo, department, semester, course) VALUES ('$studentRegistrationNo', '$dept', '$sem', '$course')");
    if($ret){
        $_SESSION['msg']="Enroll Successfully !!";
    }else{
        $_SESSION['msg']="Error : Not Enroll";
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
    <title>Course Enrollment</title>
    <h1 class="page-head-line"> ABC University </h1>
    <h2 class="page-head-line"> Course Enrollment Page </h2>
    <?php include('header.php');?>
    <?php if($_SESSION['login']!=""){
        include('menubar.php');
    }
    ?>
    <?php $sql=mysqli_query($bd, "SELECT * FROM students WHERE studentRegistrationNo='".$_SESSION['login']." ");
    $cnt=1;
    while($row=mysqli_fetch_array($sql))
    ?>
    <div class="panel-body">
        <form name="dept" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="studentName">Student Name  </label>
        <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo htmlentities($row['studentName']);?>" placeholder="Student Name." />
        <br><br/>
    </div>

    <div class="form-group">
        <label for="studentRegistrationNo">Student Registration Number </label>
        <input type="text" class="form-control" id="studentRegistrationNo" name="studentRegistrationNo" value="<?php echo htmlentities($row['studentRegistrationNo']);?>"  placeholder="Student Registration No." />
        <br><br/>
    </div>

    <div class="form-group">
        <label for="department">Department  </label> 
        <select class="form-control" name="department" required="required">
            <option value="">Select Depertment</option>
            <?php
            $sql=mysqli_query($bd, "select * from department");
            while($row=mysqli_fetch_array($sql))
            ?>
            <option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['department']);?></option>
        </select> 
    </div>

    <div class="form-group">
        <label for="semester">Semester  </label>
        <select class="form-control" name="sem" required="required">
            <option value="">Select Semester</option>
            <?php
            $sql=mysqli_query($bd, "select * from semester");
            while($row=mysqli_fetch_array($sql))
            ?>
            <option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['semester']);?></option>
        </select> 
    </div>  

    <div class="form-group">
        <label for="course">Course  </label>
        <select class="form-control" name="course" id="course" onBlur="courseAvailability()" required="required">
            <option value="">Select Course</option>   
            <?php
            $sql=mysqli_query($bd ,"select * from course");
            while($row=mysqli_fetch_array($sql))
            ?>
            <option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['courseName']);?></option>}
        </select>
        <span id="course-availability-status1" style="font-size:12px;">
    </div>
    
    <button type="submit" name="submit" id="submit" class="btn btn-default">Enroll</button>
    <?php include('footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
    function courseAvailability(){
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_avail.php",
            data:'cid='+$("#course").val(),
            type: "POST",
            success:function(data){
                $("#course-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }
    </script>
</body>
</html>