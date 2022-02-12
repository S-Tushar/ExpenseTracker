<?php
session_start();
if (isset($_SESSION['is_loggedin'])) {

    header('location:index.php');
}
include('config/dbcon.php');

if (isset($_REQUEST['login'])) {


    $first_name = $_REQUEST['fname'];
    $last_name = $_REQUEST['lname'];
    $mobile_no = $_REQUEST['mobile_no'];
    $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING);
    $error = [];
    $sql = "insert into users (first_name,last_name,email,mobile_no,password) values ('$first_name','$last_name','$email','$mobile_no','$password')";
    $s = mysqli_query($conn, $sql);
    if ($s) {
        header('location:login.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Tracker</title>
    <!-- core:css -->
    <link rel="stylesheet" href="assets/css/prostyle.css">
    <link rel="stylesheet" href="assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <!-- End layout styles -->
	<style>
	.logo img{
		width:50px;
	}
	 .logo span {
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #012970;
    font-family: "Nunito", sans-serif;
    margin-top: 3px;
	}
	</style>

</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-8 mx-auto">
                        <?php
                        if (isset($success)) {
                            echo '<div class="alert alert-success">Login successfully </div>';
                        } elseif (!empty($error_list) && isset($error_list['login'])) {
                            echo '<div class="alert alert-danger">' . $error_list['login'] . '</div>';
                            unset($error_list['login']);
                        }
                        ?>
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-6 pr-md-0">
                                    <div class="auth-left-wrapper">
                                        <img class="img " src="assets2\img\entrepreneur-icon-2.jpg".alt="#" style="  max-width:100%;max-height:150%; margin:20%0 0 0">
										
                                    </div>
                                </div>
                                <div class="col-sm-6 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">

                                         <a href="index.html" class="logo d-flex align-items-center mb-4 mr-2">
												<img src="assets2\img\logo2.png" alt="">
												<span>Expense<span class="text-danger">Traker</span></span>
										 </a>
                                        <h5 class="text-muted font-weight-normal mb-4">Welcome back! create your account.</h5>
                                        <form class="forms-sample" method="post" id="signupForm">
                                            <div class="form-group">
                                                <label for="exampleInputfname">First Name</label>
                                                <input type="text" name="fname" class="form-control"  placeholder="First name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputlname">Last Name</label>
                                                <input type="text" name="lname" class="form-control"  placeholder="Last Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" name="email" class="form-control"  placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mobile NO</label>
                                                <input type="text" name="mobile_no" class="form-control"  placeholder="Mobile No" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password" required>
                                            </div>

                                            <div class="mt-3">
                                                <button name="login" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white" type="submit">Sign up</button>
                                            </div>
                                            <a href="login.php" class="d-block mt-3 text-muted">already have Account? Sign IN</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- end plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <!-- endinject -->
    <!-- custom js for this page -->
    <!-- end custom js for this page -->
    <script>
        $.validator.addMethod(
  "regex",
  function(value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  },
  "Please check your input."
);
        	$("#signupForm").validate({
			rules: {
				fname: {required:true, regex:/^[[A-Z]|[a-z]][[A-Z]|[a-z]|\\d|[_]]{7,29}$/},
				lname: {required:true, regex:/^[[A-Z]|[a-z]][[A-Z]|[a-z]|\\d|[_]]{7,29}$/},
				email: {
					required: true,
					email: true,
                    regex:/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
				},
				password: {
					required: true,
					minlength: 5
				},
				mobile_no: {
					required: true,
                    regex:/^[0-9]{10,10}$/
					
				},
				
			},
			messages: {
				fname: {required:"Please enter your firstname"},
				lname: {required:"Please enter your lastname"},
				
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				
				email: {
                    email:"Please enter a valid email address",
                    regex:"please enter valid email address",
                },
				mobile_no: {
                    regex:"Please enter a valid mobile no."
                },
				
			}
		});
    </script>
</body>

</html>