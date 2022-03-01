<?php
    include 'config/dbcon.php';
 
    

  //  if(isset($_REQUEST['add_expense'])){

        
        $from_account=setNull($_REQUEST['from_account']);
        $amount=setNull(str_replace(',','',$_REQUEST['amount']));
        $currency=setNull($_REQUEST['currency']);
        $to_account=setNull((isset($_REQUEST['to_account'])?$_REQUEST['to_account']:''));
        $transaction_type=setNull($_REQUEST['transaction_type']);
        $debit_credit=setNull($_REQUEST['debit_credit']);
        $notes=setNull((isset($_REQUEST['notes'])?$_REQUEST['notes']:''));
        $tags=setNull((isset($_REQUEST['tags'])?$_REQUEST['tags']:''));
        $transaction_date=setNull((isset($_REQUEST['transaction_date'])?date('Y-m-d',strtotime($_REQUEST['transaction_date'])):''));
        $user_id=setNull($_REQUEST['user_id']);



        $query= "insert into transactions (user_id,from_account,amount,currency,to_account,transaction_type,debit_credit,tags,notes,transaction_date,created_by,created_at,updated_by) values ('$user_id','$from_account','$amount','$currency','$to_account','$transaction_type','$debit_credit','$tags','$notes','$transaction_date',4,'current_timestamp()','NULL')";
         $re=mysqli_query($conn,$query) or die(mysqli_error($conn));




         
        if(!empty($tags)){
          $tags=explode(',',$tags);
          
          if(!empty($tags)){
            foreach ($tags as $key => $t) {
              # code...
              $t=trim($t);
                $sql = "SELECT * from tags where LOWER(tags)='".strtolower($t)."'";
              
              $re = mysqli_query($conn, $sql);
              $numOfRow = mysqli_num_rows($re);
             
              if($numOfRow==0){
                  $s="insert tags (tags) value ('".ucwords($t)."')";
                  $re = mysqli_query($conn, $s);

              }
            }
          }
         

           
      }
      //  }

        function setNull($value){

            return (isset($value) && $value!="")?$value:NULL;
        }
?>