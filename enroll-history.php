<?php
session_start();
include('config.php');
if(strlen($_SESSION['login'])==0){
    header('index.php');
}else{
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enroll History</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('header.php');?>
<?php if($_SESSION['login']!="")
{
 include('menubar.php');
}
 ?>
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Enroll History  </h1>
                    </div>
                </div>
                <div class="row" >
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Enroll History
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name </th>
                                            <th>Department</th>
                                            <th>Semester</th>
                                            <th>Enrollment Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "SELECT enrollment.course AS cid, course.courseName AS courseName, department.department AS dept, enrollment.enrollDate AS edate, semester.semester AS sem FROM enrollment JOIN course ON course.id=enrollment.semester  WHERE enrollment.studentRegistrationNo='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['courname']);?></td>
                                            <td><?php echo htmlentities($row['dept']);?></td>
                                            <td><?php echo htmlentities($row['sem']);?></td>
                                             <td><?php echo htmlentities($row['edate']);?></td>
                                            <td>
                                            <a href="print.php?id=<?php echo $row['cid']?>" target="_blank">
<button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> </a>                                        
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
   
  <?php include('footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>