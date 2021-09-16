<?php
session_start();
include('config.php');
if(strlen($_SESSION['login'])==0){
  header('index.php');
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php include('header.php');?>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Student Profile</title>
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>  
<?php if($_SESSION['login']!=""){
  include('menubar.php');
}?>
<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">Student Registration  </h1>
      </div>
    </div>
    <div class="row" >
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"> Registration
            </div>
            <?php $sql=mysqli_query($bd, "select * from students where studentRegistrationNo='".$_SESSION['login']."'");
            $cnt=1;
            while($row=mysqli_fetch_array($sql))?>
            <div class="panel-body">
              <form name="dept" method="post" enctype="multipart/form-data">
              <div class="form-group">
              <br><br/>
                <label for="studentname">Student Name  </label>
                <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>"  />
                <br><br/>
              </div>
              <div class="form-group">
                <label for="studentRegistrationNo">Student Reg No   </label>
                <input type="text" class="form-control" id="studentRegistrationNo" name="studentRegistrationNo" value="
                <?php echo htmlentities($row['studentRegistrationNo']);?>"  placeholder="studentRegistrationNo" readonly />
                <br><br/>
              </div>
              <div class="form-group">
                <label for="CGPA">CGPA  </label>
                <input type="text" class="form-control" id="cgpa" name="cgpa"  value="<?php echo htmlentities($row['cgpa']);?>" required />
                <br><br/>
              </div>
              <button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
            </form>
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