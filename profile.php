<?php
include 'config/dbcon.php';
if(!isset($_SESSION['is_loggedin'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Tracker</title>
    <?php include 'layout/css.php'; ?>
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:../../partials/_sidebar.html -->
        <?php include 'layout/sidebar.php'; ?>
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:../../partials/_navbar.html -->
            <?php include 'layout/topnav.php'; ?>
            <!-- partial -->

            <div class="page-content">

                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>

                <div class="row">
                    
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">User Profile</h6>
                                <form class="forms-sample" id="user_profile">
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="firstname" name="first_name" placeholder="First Name" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile_number" class="col-sm-3 col-form-label">Mobile</label>
                                        <div class="col-sm-9">
                                            <input type="tel" class="form-control" id="mobile_number" name="mobile_no" placeholder="Mobile number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="exampleInputPassword2" name= "password" autocomplete="off" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-check form-check-flat form-check-primary mt-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">
                                            Remember me
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

               
            <!-- partial:../../partials/_footer.html -->
            <?php include 'layout/footer.php'; ?>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <?php include 'layout/script.php' ?>
    <!-- core:js ends -->

    <!-- jquery form validation starts -->
  
    <!-- jquery form validation ends -->
    <script>
        $(document).ready(function(){
            $.validator.addMethod("regex",function(value, element, regexp){
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
            );
            $("#user_profile").validate({
			rules: {
				first_name: {required:true, regex:/^[[A-Z]|[a-z]][[A-Z]|[a-z]|\\d|[_]]{7,29}$/},
				last_name: {required:true, regex:/^[[A-Z]|[a-z]][[A-Z]|[a-z]|\\d|[_]]{7,29}$/},
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

        })
        		
    </script>

</body>

</html>