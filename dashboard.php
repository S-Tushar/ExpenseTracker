<?php
include 'config/dbcon.php';
if(!isset($_SESSION['is_loggedin'])){
    header('location:login.php');
}

$sql = "SELECT add_accounts.type,add_accounts.name,sum(amount) as total FROM `transactions` join add_accounts on add_accounts.id=transactions.from_account WHERE transactions.user_id='".$_SESSION['id']."' GROUP BY add_accounts.type";
$re = mysqli_query($conn, $sql);
$numOfRow = mysqli_num_rows($re);
$data = [];
$x = 0;
$i=0;
if ($numOfRow > 0) {
    while ($res = mysqli_fetch_assoc($re)) {

            $data[$i]['type']=$res['type'];
            $data[$i]['total']=$res['total'];
            $data[$i]['data']=getrow($res['type'],4,$conn);
           
        $i++;
    }
   
    
  
}

function getrow($type,$user_id,$conn){
     $sql2 = "SELECT add_accounts.type,add_accounts.name,sum(amount) as total FROM `transactions` join add_accounts on add_accounts.id=transactions.from_account WHERE transactions.user_id='$user_id' and add_accounts.type='$type' GROUP BY add_accounts.type,transactions.from_account";
    
    $re = mysqli_query($conn, $sql2);
     $numOfRow = mysqli_num_rows($re);
    
    $data = [];
    if ($numOfRow > 0) {
        while ($res = mysqli_fetch_assoc($re)) {
            $data[]=$res;
        }
    }
    return $data;
     
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Net Worth</h4>
                        <div class="accordion" id="accordionExample">
                                
                            <?php 
                                    if(!empty($data)){
                                        foreach($data as $key=>$d){
                                          ?>
                                          
                                          <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key; ?>">
                                        <?php  echo ucwords($d['type']).' &nbsp;&nbsp;-'.$d['total']?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $key; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php
                                        if (isset($d['data']) && !empty($d['data'])) {
                                        ?>
                                            <table class="table">
                                                <thead>
                                                    <th>Account Name</th>
                                                    <th>Total</th>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    foreach ($d['data'] as $account_details) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $account_details['name'] ?? ''; ?></td>
                                                            <td><?php echo $account_details['total'] ?? ''; ?></td>
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

                                          <?php
                                        }
                                    }
                            
                            ?>



                           
                           
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