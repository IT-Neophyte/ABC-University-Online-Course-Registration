<?php
session_start();
error_reporting(1);
include("config.php");
if(isset($_POST['submit'])){
  $email=$_POST['email'];
  $password=$_POST['password'];
  $query=mysqli_query($bd, "SELECT * FROM students WHERE email='$email' and password='$password'");
  if(mysqli_num_rows($query)>0){
    $num=mysqli_fetch_array($query);
    $_SESSION['login']=$_POST['email'];
    $_SESSION['id']=$num['studentRegistrationNo'];
    $_SESSION['sname']=$num['studentName'];
    $uip=$_SERVER['REMOTE_ADDR'];
    $status=1;
    $host=$_SERVER['HTTP_HOST'];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location: profile.php");
    exit();
  }else{
    $_SESSION['errmsg']="Invalid Email or Password";
    $extra="index.php";
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location: index.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Student Login</title>
  <h1 class="page-head-line"> ABC University Login Page </h1>
</head>
<body>
  <?php include('header.php');?>
  <div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4 class="page-head-line">Please Login </h4>
        </div>
      </div>
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <label>Enter Email: </label>
            <input type="text" name="email" class="form-control" placeholder="Email" required/>
            <br><br/>
            <label>Enter Password:  </label>
            <input type="password" name="password" class="form-control"  placeholder="**********" required />
            <br><br/>
            <hr/>
            <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span>&nbsp;Login </button>&nbsp;
            <p> Not registered?<a href="student-registration.php"><b> Registration </b></a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include('footer.php');?>
  <script src="assets/js/jquery-1.11.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>