<?php
include 'config/dbcon.php';
if(!isset($_SESSION['is_loggedin'])){
    header('location:login.php');
}

if(isset($_SESSION['id'])){
    $sql="select * from users where id='".$_SESSION['id']."'";
    $re=mysqli_query($conn,$sql);
    $numOfRow=mysqli_num_rows($re);

    $edit_data = ($numOfRow > 0) ? mysqli_fetch_assoc($re) : [];
}
if(isset($_REQUEST['update'])){

        
    $first_name=$_REQUEST['first_name'];
    $last_name=$_REQUEST['last_name'];
    $mobile_no=$_REQUEST['mobile_no'];
    $email=$_REQUEST['email'];
    $profile_image='';
    if(!empty($_FILES['profile_image']['name'])){
        $profile_image=date('ymdhis')."_".$_FILES['profile_image']['name'];
        move_uploaded_file($_FILES['profile_image']['tmp_name'],'assets/images/upload/'.$profile_image);
    }
   

   
  
    $query='';
    
        echo $query="update users set first_name='$first_name',last_name='$last_name',email='$email',mobile_no='$mobile_no'".((!empty($profile_image))?", profile_image='$profile_image'":"")." where id='".$_SESSION['id']."'"; 
   
    
    
    $re=mysqli_query($conn,$query) or die(mysqli_error($conn));
    if($re){
        $_SESSION['profile_image']=$profile_image;
        header("location:profile.php");
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
                                <form class="forms-sample" id="user_profile" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="firstname" name="first_name" placeholder="First Name" autocomplete="off" value="<?php echo (isset($edit_data['first_name']) && !empty($edit_data['first_name']))?$edit_data['first_name']:old('first_name'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Last Name" value="<?php echo (isset($edit_data['last_name']) && !empty($edit_data['last_name']))?$edit_data['last_name']:old('last_name'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="Email" value="<?php echo (isset($edit_data['email']) && !empty($edit_data['email']))?$edit_data['email']:old('email'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile_number" class="col-sm-3 col-form-label">Mobile</label>
                                        <div class="col-sm-9">
                                        
                                            <input type="text" data-inputmask="'mask': '9999999999'"  class="form-control" id="mobile_number" name="mobile_no" placeholder="Mobile number" value="<?php echo (isset($edit_data['mobile_no']) && !empty($edit_data['mobile_no']))?$edit_data['mobile_no']:old('mobile_no'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="profile_img" class="col-sm-3 col-form-label">Profile Image</label>
                                        <div class="col-sm-9">
										<input class="form-control" type="file" id="formFile" value="profile_image" name="profile_image" accept=".jpg,.png,.jpeg">
                                        </div>
									</div>
                                    <button type="submit" class="btn btn-primary mr-2" name="update">Update</button>
                                    <button class="btn btn-light" name="cancel">Cancel</button>
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
				mobile_no: {
					required: true,
                    minlength:10,
                    maxlength:10,
                    
                    //regex:/^((\+){1}91){1}[1-9]{1}[0-9]{9}$/	
				},
                profile_image: {
                    accept: "image/*"
                },				
			},
			messages: {
				fname: {required:"Please enter your firstname"},
				lname: {required:"Please enter your lastname"},				
				email: {
                    email:"Please enter a valid email address",
                    regex:"please enter valid email address",
                },
				mobile_no: {
                    regex:"Please enter a valid mobile no."
                },
				
				
			}
		});

    });

        		
    </script>

</body>

</html>