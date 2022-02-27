<?php
include 'config/dbcon.php';
if(!isset($_SESSION['is_loggedin'])){
	header('location:login.php');
}
if (isset($_REQUEST['submit'])) {

	$add_expense = $_REQUEST['add_expense'];
	$add_transfer = $_REQUEST['add_transfer'];
	$add_income = $_REQUEST['add_income'];
}

$sql = "select id,name,type from add_accounts where user_id='".$_SESSION['id']."'";
$re = mysqli_query($conn, $sql);
$numOfRow = mysqli_num_rows($re);
$accounts_list = [];

if ($numOfRow > 0) {
	while ($res = mysqli_fetch_assoc($re)) {
		$accounts_list[] = $res;
	}
}
?>
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

		<!-- sidebar.html -->
		<?php include 'layout/sidebar.php'; ?>
		<!-- sidebar -->

		<div class="page-wrapper">

			<!-- navbar.html -->
			<?php include 'layout/topnav.php'; ?>
			<!-- navbar -->

			<div class="page-content">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title">Transactions</h3>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="expense-tab" data-bs-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="true">Expense</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="transfer-tab" data-bs-toggle="tab" href="#transfer" role="tab" aria-controls="transfer" aria-selected="false">Transfer</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="income-tab" data-bs-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="false">Income</a>
							</li>
						</ul>

						<div class="tab-content border border-top-0 p-3" id="myTabContent">
							<div class="tab-pane fade show active" id="expense" role="tabpanel" aria-labelledby="expense-tab">
								<form method="post" id="addexpense">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_lists">From</label>
												<select class="js-example-basic-single w-100" id="account_lists" name="from_account">
													<option value="">--Select--</option>

													<?php
													if (!empty($accounts_list)) {
														foreach ($accounts_list as $res) {
													?>
															<option value="<?php echo $res['id'] ?>"><?php echo $res['name'] . ((isset(PAYMENT_METHOD[$res['type']])) ? ' - ' . PAYMENT_METHOD[$res['type']] : ''); ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6 align-self-end">
											<div class="form-group">
												<div class="btn-group">
													<input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'currency'" name="amount" />
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
										<div class="col-md-6">
											<div class="form-group">
												<input class="form-control" name="tags" id="tags" value="" />
											</div>
											<div class="form-group">
												<textarea id="maxlength-textarea" class="form-control" maxlength="100" rows="6" placeholder="This textarea has a limit of 100 chars." name="notes"></textarea>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group date datepicker" id="datePickerExample1">
												<input type="text" class="form-control" name="transaction_date"><span class="input-group-addon"><i data-feather="calendar"></i></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<input type="hidden" name="transaction_type" value="EXPENSE">
											<input type="hidden" name="debit_credit" value="D">
											<input type="hidden" name="user_id" value="<?php echo $_SESSION['id'];?>">
											<input class="btn btn-primary" type="submit" value="Add Expense" name="add_expense">
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="transfer" role="tabpanel" aria-labelledby="transfer-tab">
								<form action="" method="" id="addtransfer">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_lists">From</label>
												<select class="js-example-basic-single w-100" id="account_lists" name="from_account">
													<option value="">--Select--</option>
													<?php
													if (!empty($accounts_list)) {
														foreach ($accounts_list as $res) {
													?>
															<option value="<?php echo $res['id'] ?>"><?php echo $res['name'] . ((isset(PAYMENT_METHOD[$res['type']])) ? ' - ' . PAYMENT_METHOD[$res['type']] : ''); ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6 align-self-end">
											<div class="form-group">
												<div class="btn-group">
													<input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'currency'" name="amount" />
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
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_lists">To</label>
												<select class="js-example-basic-single w-100" id="account_lists" name="to_account">
													<option value="">--Select--</option>
													<?php
													if (!empty($accounts_list)) {
														foreach ($accounts_list as $res) {
													?>
															<option value="<?php echo $res['id'] ?>"><?php echo $res['name'] . ((isset(PAYMENT_METHOD[$res['type']])) ? ' - ' . PAYMENT_METHOD[$res['type']] : ''); ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6 align-self-end">
											<div class="form-group">
												<div class="input-group date datepicker" id="datePickerExample2">
													<input type="text" class="form-control" name="transaction_date"><span class="input-group-addon"><i data-feather="calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<textarea id="maxlength-textarea" class="form-control" maxlength="100" rows="4" name="notes" placeholder="This textarea has a limit of 100 chars."></textarea>
										</div>
										<div class="col-md-4">
											<input type="hidden" name="transaction_type" value="TRANSFER">
											<input type="hidden" name="debit_credit" value="D">
											<input type="hidden" name="user_id" value="<?php echo $_SESSION['id'];?>">
											<input class="btn btn-primary" type="submit" value="Add Transfer" name="add_expense">
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab">
								<form action="" method="" id="addincome">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="account_lists">From</label>
												<select class="js-example-basic-single w-100" id="account_lists" name="from_account">
													<option value="">--Select--</option>
													<?php
													if (!empty($accounts_list)) {
														foreach ($accounts_list as $res) {
													?>
															<option value="<?php echo $res['id'] ?>"><?php echo $res['name'] . ((isset(PAYMENT_METHOD[$res['type']])) ? ' - ' . PAYMENT_METHOD[$res['type']] : ''); ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6 align-self-end">
											<div class="form-group">
												<div class="btn-group">
													<input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'currency'" name="amount" />
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
										<div class="col-md-6">
											<div class="form-group">
												<input class="form-control" name="tags" id="tags" value="" />
											</div>
											<div class="form-group">
												<textarea id="maxlength-textarea" class="form-control" maxlength="100" rows="5" name="notes" placeholder="This textarea has a limit of 100 chars."></textarea>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group date datepicker" id="datePickerExample3">
												<input type="text" class="form-control" name="transaction_date"><span class="input-group-addon"><i data-feather="calendar"></i></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<input type="hidden" name="transaction_type" value="INCOME">
											<input type="hidden" name="debit_credit" value="C">
											<input type="hidden" name="user_id" value="<?php echo $_SESSION['id'];?>">
											<input class="btn btn-primary" type="submit" value="Add income" name="add_expense">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h6 class="card-title">TRANSACTIONS LIST</h6>
									<table class="table table-bordered" id="transaction_list">
										
									</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- footer.html -->
			<?php include 'layout/footer.php'; ?>
			<!-- footer -->

		</div>
	</div>

	<!-- core:js -->
	<?php include 'layout/script.php' ?>
	<!-- core:js ends -->
	<script>
		$("#addexpense").validate({
			rules: {
				from_account: {required:true},
				amount: {required:true},
				transaction_date: {required:true},
								
			},
			messages: {
				
				
			}
		});

    $(document).ready(function() {

				$('#transaction_list').DataTable( {
        			"ajax": {
						url:'transaction_list.php?',
						method:"POST",
						data:{"user_id":<?php echo $_SESSION['id'];?>}
					},
					order: [[1, 'asc']],
					"columns": [
							{ data:'from_account_name' ,title:"Form Account"},
							//{ data:'tag' ,title:"Form Account"},

							{ data:'amount' ,title:"Amount"},
							
							
						]

					
    			});
	});

		$(function() {
			'use strict';
			if ($('#datePickerExample1,#datePickerExample2,#datePickerExample3').length) {
				var date = new Date();
				var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
				$('#datePickerExample1,#datePickerExample2,#datePickerExample3').datepicker({
					format: "mm/dd/yyyy",
					todayHighlight: true,
					autoclose: true
				});
				$('#datePickerExample1,#datePickerExample2,#datePickerExample3').datepicker('setDate', today);
			}
			$('#addtransfer,#addexpense,#addincome').validate();
			$('#addtransfer,#addexpense,#addincome').on('submit', function(e) {
				e.preventDefault();
				// alert($(this).serialize());
				if ($(this).valid()) {
					$.ajax({
						url: "addexpense.php",
						method: "POST",
						data: $(this).serialize(),
						success: function(response) {}
					})
				}
				return false;

			});
		});
	</script>
</body>

</html>