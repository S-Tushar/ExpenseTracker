<?php
    include 'config/dbcon.php';

     if(isset($_REQUEST['user_id'])){
        //$sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type='INCOME' and from_account='".$_REQUEST['account']."'";
        $sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type='INCOME'";
        $re = mysqli_query($conn, $sql);
        $numOfRow = mysqli_num_rows($re);
        $income=mysqli_fetch_assoc($re)['total'];

        //$sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type!='INCOME' and from_account='".$_REQUEST['account']."'";
        $sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."'";
        $re = mysqli_query($conn, $sql);
        $numOfRow = mysqli_num_rows($re);
        $expense=mysqli_fetch_assoc($re)['total'];
        echo (!empty($income))?numberformet($income-$expense):'0.00';
     }
?>