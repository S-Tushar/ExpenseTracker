<?php
	include 'config/dbcon.php';

	$sql="select * from add_accounts where user_id=4";
	$re=mysqli_query($conn,$sql);
	$numOfRow=mysqli_num_rows($re);
	$accounts_list=[];
	$x = 0;
	if($numOfRow>0){
	while ($res=mysqli_fetch_assoc($re)){

			switch($res['type']){
				case 'CASH':
					$accounts_list['CASH'][]=$res;
					break;
				case 'BANK_ACCOUNT':
					$accounts_list['BANK_ACCOUNT'][]=$res;
					break;
				case 'CREDIT':
					$accounts_list['CREDIT'][]=$res;
					break;
				case 'ASSET':
					$accounts_list['ASSET'][]=$res;
					break;
				case 'DEPOSIT':
					$accounts_list['DEPOSIT'][]=$res;
					break;
				default:
					$accounts_list['OTHER'][]=$res;
			}
		}
	}
    
    print_r($accounts_list);

  
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
                <div class="card">
                    <div class="card-body">
                            <h4 class="card-title">Account Lists</h4>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Cash
                                </button>
                            </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    <p>
                                        <?php
                                          if
                                        ?>
                                    </p>
                                    </div>
                                </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Asset
                            </button>
                        </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Para2</p>
                                </div>
                            </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Credit
                            </button>
                        </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>para3</p>
                                </div>
                            </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Bank Account
                            </button>
                        </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Para4</p>
                                </div>
                            </div>
                    </div>
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