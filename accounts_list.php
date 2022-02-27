<?php
include 'config/dbcon.php';
if(!isset($_SESSION['is_loggedin'])){
    header('location:login.php');
}
if(isset($_REQUEST['did'])){
    $sql="delete from add_accounts where id='".$_REQUEST['did']."'";
    $re=mysqli_query($conn,$sql);
     $r=mysqli_affected_rows($conn);
     if($r){
        $_SESSION['_flash']['success']=true;
        $_SESSION['_flash']['message']="Deleted Successfully";
        header("Refresh:1;accounts_list.php");
     }
    
   
    
    
}


$sql = "select * from add_accounts where user_id='".$_SESSION['id']."'";
$re = mysqli_query($conn, $sql);
$numOfRow = mysqli_num_rows($re);
$accounts_list = [];
$x = 0;
if ($numOfRow > 0) {
    while ($res = mysqli_fetch_assoc($re)) {

        switch ($res['type']) {
            case 'CASH':
                $accounts_list['CASH'][] = $res;
                break;
            case 'BANK_ACCOUNT':
                $accounts_list['BANK_ACCOUNT'][] = $res;
                break;
            case 'CREDIT':
                $accounts_list['CREDIT'][] = $res;
                break;
            case 'ASSET':
                $accounts_list['ASSET'][] = $res;
                break;
            case 'DEPOSIT':
                $accounts_list['DEPOSIT'][] = $res;
                break;
            default:
                $accounts_list['OTHER'][] = $res;
        }
    }
}
// print_r($accounts_list);
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Account Lists</h4>
                        <?php include 'include/component/alert_message.php' ?>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Cash
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php
                                        if (isset($accounts_list['CASH']) && !empty($accounts_list['CASH'])) {
                                        ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Account Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    foreach ($accounts_list['CASH'] as $account_details) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $account_details['name'] ?? ''; ?></td>
                                                            <td><a href="add-accounts.php?eid=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="edit" class="feather-18"></i></a>
                                                            <a href="accounts_list.php?did=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="delete" class="feather-18"></i></a></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                        ?>
                                            <h5>No record found!</h5>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Bank Account
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php
                                        if (isset($accounts_list['BANK_ACCOUNT']) && !empty($accounts_list['BANK_ACCOUNT'])) {
                                        ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Account Name</th>
                                                        <th>Account Number</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($accounts_list['BANK_ACCOUNT'] as $account_details) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $account_details['name'] ?? ''; ?></td>
                                                            <td><?php echo $account_details['account_number'] ?? ''; ?></td>
                                                            <td><a href="add-accounts.php?eid=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="edit" class="feather-18" class="sm"></i></a>
                                                            <a href="accounts_list.php?did=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="delete" class="feather-18"></i></a></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                        ?>
                                            <h5>No record found!</h5>
                                        <?php
                                        }
                                        ?>
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
                                        <?php
                                        if (isset($accounts_list['CREDIT']) && !empty($accounts_list['CREDIT'])) {
                                        ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Account Name</th>
                                                        <th>Card Number</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($accounts_list['CREDIT'] as $account_details) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $account_details['name'] ?? ''; ?></td>
                                                            <td><?php echo $account_details['card_number'] ?? ''; ?></td>
                                                            <td><a href="add-accounts.php?eid=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="edit" class="feather-18"></i></a>
                                                            <a href="accounts_list.php?did=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="delete" class="feather-18"></i></a></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                        ?>
                                            <h5>No record found!</h5>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Asset
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php
                                        if (isset($accounts_list['ASSET']) && !empty($accounts_list['ASSET'])) {
                                        ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Account Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($accounts_list['ASSET'] as $account_details) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $account_details['name'] ?? ''; ?></td>
                                                            <td><a href="add-accounts.php?eid=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="edit" class="feather-18"></i></a>
                                                            <a href="accounts_list.php?did=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="delete" class="feather-18"></i></a></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                        ?>
                                            <h5>No record found!</h5>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Deposit
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php
                                        if (isset($accounts_list['DEPOSIT']) && !empty($accounts_list['DEPOSIT'])) {
                                        ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Account Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($accounts_list['DEPOSIT'] as $account_details) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $account_details['name'] ?? ''; ?></td>
                                                            <td><a href="add-accounts.php?eid=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="edit" class="feather-18"></i></a>
                                                            <a href="accounts_list.php?did=<?php echo $account_details['id'] ?? ''; ?>" class="mr-3" ><i data-feather="delete" class="feather-18"></i></a></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                        ?>
                                            <h5>No record found!</h5>
                                        <?php
                                        }
                                        ?>
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
    <?php include 'layout/script.php' ?>
    <!-- core:js ends -->
</body>

</html>