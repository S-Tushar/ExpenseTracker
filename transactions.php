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

		<!-- sidebar.html -->
		<?php include 'layout/sidebar.php';?>
		<!-- sidebar -->
	
		<div class="page-wrapper">
				
			<!-- navbar.html -->
			<?php include 'layout/topnav.php';?>
			<!-- navbar -->

			<div class="page-content">
                <div class="card">
					<div class="card-body">
						<h3 class="card-title">Transactions</h3>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#expense" role="tab" aria-controls="home" aria-selected="true">Expense</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#transfer" role="tab" aria-controls="profile" aria-selected="false">Transfer</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#income" role="tab" aria-controls="contact" aria-selected="false">Income</a>
							</li>
						</ul>
						<form action="" method="">
							<div class="tab-content border border-top-0 p-3" id="myTabContent">
								<div class="tab-pane fade show active" id="expense" role="tabpanel" aria-labelledby="home-tab">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_lists">From</label>
												<select class="js-example-basic-single w-100" id="account_lists" name="account_lists">
													<option value="">--Select--</option>
												</select>
											</div>
										</div>
										<div class="col-md-6 align-self-end">
											<div class="form-group">
												<div class="btn-group">
													<input type="number" class="form-control" id="currency_number" name="currency_number">
													<select class="js-example-basic-single w-50" id="currency" name="currency">
														<option value="USD">USD</option>
														<option value="AED">AED</option>
														<option value="GBP">GBP</option>
														<option value="IDR">IDR</option>
														<option value="INR" selected>INR</option>s
														<option value="JPY">JPY</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<h6 class="card-title">Tags</h6>
													<div>
														<input name="tags" id="tags" value="" />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="transfer" role="tabpanel" aria-labelledby="profile-tab">4556</div>
								<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">789</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- footer.html -->
			<?php include 'layout/footer.php'; ?>		
			<!-- footer -->
	
		</div>
	</div>

	<!-- core:js -->
	<?php include 'layout/script.php'?>	
 	<!-- core:js ends -->
	 <script>
		$(function() {
		'use strict';

		$('#tags').tagsInput({
			'width': '100%',
			'height': '75%',
			'interactive': true,
			'defaultText': 'Add tags',
			'removeWithBackspace': true,
			'minChars': 0,
			'maxChars': 20,
			'placeholderColor': '#666666'
		});
		});
	 </script>
</body>
</html>