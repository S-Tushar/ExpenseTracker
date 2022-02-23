<?php
	include 'config/dbcon.php';

	if(isset($_REQUEST['submit'])){

		$name=$_REQUEST['name'];
		$account_number=$_REQUEST['account_number'];
		$card_number=$_REQUEST['card_number'];
		$type=$_REQUEST['type'];
		$sql="select * from add_accounts where user_id=4";
		$re=mysqli_query($conn,$sql);
		$numOfRow=mysqli_num_rows($re);
	  
		$query='';
		if($numOfRow==0){
			$query = "INSERT INTO `add_accounts` (`user_id`, `name`, `type`, `account_number`, `card_number`, `created_by`, `created_at`, `updated_at`) VALUES (4, '$name', '$type', '$account_number', '$card_number', 4, current_timestamp(), current_timestamp())";
		}else{
			$query="update add_accounts set name='$name', type='$type', account_number='$account_number',card_number='$card_number' where user_id=4"; 
		}
		
		$re=mysqli_query($conn,$query) or die(mysqli_error($conn));
		if($re){
			header("location:add-accounts.php");
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
		<?php include 'layout/sidebar.php';?>
		<!-- partial -->
	
		<div class="page-wrapper">
				
			<!-- partial:../../partials/_navbar.html -->
			<?php include 'layout/topnav.php';?>
			<!-- partial -->

			<div class="page-content">
                <div class="row justify-content-center">
					<div class="col-md-10 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">New Account</h4> 
								<form class="cmxform" id="add_account" method="post" action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input id="name" class="form-control" name="name" type="text" placeholder="Account holder name">
                                            </div>
                                            <div class="form-group account_detail">
                                                <label for="account_number">Account Number</label>
                                                <input id="account_number" class="form-control" name="account_number" type="number" placeholder="Account Number">
                                            </div>
                                            <div class="form-group card_detail">
                                                <label for="card_number">Card Number</label>
                                                <input id="card_number" class="form-control" name="card_number" type="number" placeholder="Card Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="js-example-basic-single w-100" id="account_method" name="type">
													<option value="" selected disabled>Please select a account method</option>
													<?php
													foreach(PAYMENT_METHOD as $key=>$value){
													?>

													<option value="<?php echo $key;  ?>" <?php echo (isset($data['type']) && $data['type']==$key)?'selected':''; ?>><?php echo $value;  ?></option>

													<?php
													}
													?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="btn btn-primary" type="submit" value="Save" name="submit">
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
	<?php include 'layout/script.php'?>	
 	<!-- core:js ends -->
	 <script>
		$(document).ready(function() {
			$("#account_method").change(function() {
				$(this).find("option:selected").each(function() {
					var type = $(this).attr("value");
					if (type=="bank_account") {
						$('div.account_detail').show(1200);
					} else {
						$('div.account_detail').hide(1200);
					}
				});
				$(this).find("option:selected").each(function() {
					var type = $(this).attr("value");
					if (type=="credit") {
						$('div.card_detail').show(1200);
					} else {
						$('div.card_detail').hide(1200);
					}
				});
			})
        });
	 </script>
</body>
</html>