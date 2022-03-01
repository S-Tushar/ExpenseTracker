<?php 
include 'config/dbcon.php';
$trs_id=$_REQUEST['trs_id'];

 $sql=  "DELETE FROM `transactions` where id='$trs_id'";
 $re=mysqli_query($conn,$sql);


?>