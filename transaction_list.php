<?php 
include 'config/dbcon.php';

$user_id=$_SESSION['id'];

$str="SELECT transactions.*,add_accounts.name as from_account_name,to_account.name as to_account_name FROM `transactions` join add_accounts on add_accounts.id=transactions.from_account left join add_accounts to_account on to_account.id=transactions.to_account where transactions.user_id='$user_id' order by transaction_date DESC ";
$re=mysqli_query($conn,$str);
$numOfRow=mysqli_num_rows($re);
$data=[];
    if(isset($numOfRow) && $numOfRow>0){
         while($res=mysqli_fetch_assoc($re)){

            if(isset($res['debit_credit'])){
                  if($res['debit_credit']=='D'){
                    $res['amount']="<span class='text-danger'>-".numberformet($res['amount'])."</span>";
                  }
                  else{
                    $res['amount']="<span class='text-success'>".numberformet($res['amount'])."</span>";
                  } 
            }
            if(isset($res['transaction_type']) && $res['transaction_type']=="TRANSFER"){
                $res['from_account_name']=$res['from_account_name'].'->'.$res['to_account_name'];
            }
            $res['transaction_date']=dateformat($res['transaction_date']);
                
            $res['tags']=(!empty($res['tags'])?'<div class="badge">'.implode('</div><div class="badge">',explode(',',$res['tags'])).'</div>':'');
            $data[]=$res;


         }

    }
echo json_encode(['data'=>$data])
    


?>