<?php
	include 'config/dbcon.php';
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
								<form class="cmxform" id="add_account" method="" action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input id="name" class="form-control" name="name" type="text" placeholder="Account Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="account_name">Account Number</label>
                                                <input id="account_name" class="form-control" name="account_number" type="text" placeholder="Account Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_number">Card Number</label>
                                                <input id="card_number" class="form-control" name="card_number" type="text" placeholder="Card Number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Group</label>
                                                <select class="js-example-basic-single w-100">
                                                    <option value="cash">Cash</option>
                                                    <option value="bank_account">Bank Account</option>
                                                    <option value="credit">Credit</option>
                                                    <option value="assest">Assest</option>
                                                    <option value="deposit">Deposit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="btn btn-primary" type="submit" value="Submit Account">
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
</body>
</html>