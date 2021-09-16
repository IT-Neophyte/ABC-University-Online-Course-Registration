<?php
session_start();
include('config.php');
if(strlen($_SESSION['login'])==0){   
    header('index.php');
}else{
    if(isset($_POST['submit'])){
        $studentname=$_POST['studentname'];
        $studentRegistrationNo=$_POST['studentRegistrationNo'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $ret=mysqli_query($bd, "INSERT INTO students (studentName,studentRegistrationNo,email, password,) VALUES ('$studentName','$studentRegistrationNo', '$email', '$password')");
            if($ret){
                $_SESSION['msg']="Student Registered Successfully !!";       
            }else{
                $_SESSION['msg']="Error : Student  not Register";
            }
        }
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <h1 class="page-head-line"> ABC University Registration Page </h1>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Student Registration</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('header.php');?>
    
<?php if($_SESSION['login']!=""){include('menubar.php');}?> 
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
                            <div class="panel-heading">
                                Student Registration <br><br/>
                            </div>
                            <div class="panel-body">
                            <form name="dept" method="post">
                                <div class="form-group">
                                    <label for="studentname"> Student Name: </label>
                                    <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Student Name" required />
                                    <br><br/>
                                </div>
                                <div class="form-group">
                                    <label for="studentRegistrationNo"> Student Registration Number: </label>
                                    <input type="text" class="form-control" id="studentRegistrationNo" name="studentRegistrationNo" onBlur="userAvailability()" placeholder="Student Registration No." required />
                                    <span id="user-availability-status1" style="font-size:12px;">
                                    <br><br/>
                                </div>
                                <div class="form-group">
                                    <label for="email"> Email: </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                                    <br><br/>
                                </div>
                                <div class="form-group">
                                    <label for="password"> Password: </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                                    <br><br/>
                                </div>   
                                <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
                                <p> Already registered?<a href="index.php"><b> Login </b></a></p>

                            </form>
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
<script>
function userAvailability(){
    $("#loaderIcon").show();
    jQuery.ajax({
    url: "check_avail.php",
    data:'regno='+$("#studentRegistrationNo").val(),
    type: "POST",
    success:function(data){
        $("#user-availability-status1").html(data);
        $("#loaderIcon").hide();
        },
        error:function (){}
    });
}
</script>
</body>
</html>