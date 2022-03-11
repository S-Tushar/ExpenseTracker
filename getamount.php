<?php
    include 'config/dbcon.php';

     if(isset($_REQUEST['user_id'])){
        //$sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type='INCOME' and from_account='".$_REQUEST['account']."'";
        $sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type='INCOME'";
        $re = mysqli_query($conn, $sql);
        $numOfRow = mysqli_num_rows($re);
        $income=mysqli_fetch_assoc($re)['total'];

        //$sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type!='INCOME' and from_account='".$_REQUEST['account']."'";
        $sql = "select sum(amount) as total from transactions where transaction_type!='INCOME' and user_id='".$_REQUEST['user_id']."'";
        $re = mysqli_query($conn, $sql);
        $numOfRow = mysqli_num_rows($re);
        $expense=mysqli_fetch_assoc($re)['total'];
        echo (!empty($income))?numberformet($income-$expense):'0.00';

        $sql2='SELECT (select sum(amount) from transactions i where i.transaction_date=tr.transaction_date and i.transaction_type="INCOME") as income,(select sum(amount) from transactions i where i.transaction_date=tr.transaction_date and i.transaction_type in ("EXPENSE","TRANSFER")) as expense, tr.transaction_type, ifnull(tr.transaction_date,"0000-00-00") as "Transaction Date" FROM transactions tr GROUP by tr.transaction_date order by tr.transaction_date';
     }
?>
