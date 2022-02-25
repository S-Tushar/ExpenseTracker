<?php
	include 'config/dbcon.php';

	if(isset($_REQUEST['submit'])){

		$name=$_REQUEST['name'];
		$account_number=$_REQUEST['account_number'];
		$card_number=$_REQUEST['card_number'];
		$type=$_REQUEST['type'];
		$numOfRow=0;
		if($type==BANK_ACCOUNT){
		$sql="select * from add_accounts where user_id=4 and account_number='$account_number' and (type='".BANK_ACCOUNT."')";
		$re=mysqli_query($conn,$sql);
		 $numOfRow=mysqli_num_rows($re);
		}
	 
		$query='';
		if($numOfRow==0){
			$query = "INSERT INTO `add_accounts` (`user_id`, `name`, `type`, `account_number`, `card_number`, `created_by`, `created_at`, `updated_at`) VALUES (4, '$name', '$type', '$account_number', '$card_number', 4, current_timestamp(), current_timestamp())";
			$re=mysqli_query($conn,$query) or die(mysqli_error($conn));
			if($re){
				$_SESSION['_flash']['success']=true;
				$_SESSION['_flash']['message']="ACCOUNT ADDED SUCCESSFULLY";
				header("Refresh:1;accounts_list.php");
				//exit;
			}
		}
		else{
			$_SESSION['_flash']['fail']=true;
			$_SESSION['_flash']['message']="Already have account";
			header("Refresh:3;accounts_list.php");
			//exit;
		}
		/*else{
			$query="update add_accounts set name='$name', type='$type', account_number='$account_number',card_number='$card_number' where user_id=4"; 
		}*/
		
		
	}
	$edit_data=[];
	if(isset($_REQUEST['eid'])){
		$sql="select * from add_accounts where id='".$_REQUEST['eid']."'";
		$re=mysqli_query($conn,$sql);
		$numOfRow=mysqli_num_rows($re);
		
		$edit_data=($numOfRow>0)?mysqli_fetch_assoc($re):[];
		// print_r($edit_data);
		
		
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
								<?php include 'include/component/alert_message.php' ?>
								<form class="cmxform" id="add_account" method="post" action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input id="name" class="form-control" name="name" type="text" autocomplete="off" placeholder="Account holder name" value="<?php echo (isset($edit_data['name']) && !empty($edit_data['name']))?$edit_data['name']:old('name'); ?>">
                                            </div>
                                            <div class="form-group account_detail">
                                                <label for="account_number">Account Number</label>
                                                <input id="account_number" class="form-control" name="account_number" type="text" placeholder="Account Number" value="<?php echo (isset($edit_data['account_number']) && !empty($edit_data['account_number']))?$edit_data['account_number']:old('account_number'); ?>">
                                            </div>
                                            <div class="form-group card_detail">
                                                <label for="card_number">Card Number</label>
                                                <input id="card_number" class="form-control" name="card_number" type="text" placeholder="Card Number" value="<?php echo (isset($edit_data['card_number']) && !empty($edit_data['card_number']))?$edit_data['card_number']:old('card_number'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="js-example-basic-single w-100" id="account_method" name="type">
													<option value="" selected disabled>--Please select a account method--</option>
													<?php
													foreach(PAYMENT_METHOD as $key=>$value){
													?>

													<option value="<?php echo $key;  ?>" <?php echo (isset($edit_data['type']) && $edit_data['type']==$key)?'selected':''; ?>><?php echo $value;  ?></option>

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
			</div>
			
			<!-- partial:../../partials/_footer.html -->
			<?php include 'layout/footer.php'; ?>		
			<!-- partial -->		
		</div>

	<!-- core:js -->
	<?php include 'layout/script.php'?>	
 	<!-- core:js ends -->
	 <script>
		$(document).ready(function() {
			$("#account_method").change(function() {
				var v=$(this).val();


				switch(v){
					 case 'BANK_ACCOUNT':
						$('div.account_detail').show(1200);
						$('div.card_detail').hide(1200);
						break;
					case 'CREDIT':
						$('div.card_detail').show(1200);
						$('div.account_detail').hide(1200);
						break;
					default:
							$('div.card_detail').hide(1200);
							$('div.account_detail').hide(1200);
						break;
				}
			})

			<?php
			if(isset($edit_data['type']) && ($edit_data['type']==BANK_ACCOUNT || $edit_data['type']==CREDIT)){
			?>
			$("#account_method").trigger('change');
			<?php
			}
			?>
        });
	 </script>
</body>
</html>