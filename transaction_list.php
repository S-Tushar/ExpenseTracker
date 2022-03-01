<?php 
include 'config/dbcon.php';

$user_id=$_REQUEST['user_id'];

$str="SELECT transactions.*,add_accounts.name as from_account_name,to_account.name as to_account_name FROM `transactions` join add_accounts on add_accounts.id=transactions.from_account left join add_accounts to_account on to_account.id=transactions.to_account where transactions.user_id='$user_id' and transaction_date is not null and transaction_date!='0000-00-00' ";
if(isset($_REQUEST['from_date']) && isset($_REQUEST['end_date']) && !empty($_REQUEST['from_date']) && !empty($_REQUEST['end_date'] )){

  $str.=" and  transactions.transaction_date between '".$_REQUEST['from_date']."' and '".$_REQUEST['end_date']."'";
}
if(isset($_REQUEST['tags']) && !empty($_REQUEST['tags'])){

  $str.=" and  transactions.tags like '%".$_REQUEST['tags']."%'";
}


$str.="  order by transaction_date DESC ";

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
                
            $res['tags']=(!empty($res['tags'])?'<div class="badge badge-primary">'.implode('</div><div class="badge badge-primary">',explode(',',$res['tags'])).'</div>':'');
            $res['action']='<button class="btn btn-danger" onclick="deleterow(\''.$res['id'].'\')"><i data-feather="delete" class="feather-18"></i> Delete</button>';
            $data[]=$res;

         }

    }
echo json_encode(['data'=>$data])
?>