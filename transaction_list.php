<?php 

include 'config/dbcon.php';
$user_id=$_REQUEST['user_id'];

$str="SELECT transactions.*,add_accounts.name as from_account_name,to_account.name as to_account_name FROM `transactions` join add_accounts on add_accounts.id=transactions.from_account left join add_accounts to_account on to_account.id=transactions.to_account where transactions.user_id=4 order by transaction_date DESC ";
$re=mysqli_query($conn,$str);
$numOfRow=mysqli_num_rows($re);
$data=[];
    if(isset($numOfRow) && $numOfRow>0){
         while($res=mysqli_fetch_assoc($re)){

            $data[]=$res;

         }

    }
json_encode($data)
    


?>