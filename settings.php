<?php
	include 'config/dbcon.php';


    if(isset($_REQUEST['submit'])){

            $base_currency=$_REQUEST['base_currency'];
            $additional_currency=$_REQUEST['additional_currency'];
            $date_format=$_REQUEST['date_format'];
            $sql="select * from settings where user_id=4";
            $re=mysqli_query($conn,$sql);
            $numOfRow=mysqli_num_rows($re);
          
            $query='';
            if($numOfRow==0){
                $query="insert into settings (base_currency,additional_currency,date_format,user_id,created_by) values ('$base_currency','$additional_currency','$date_format',4,4)";
            }else{
                $query="update settings set base_currency='$base_currency',additional_currency='$additional_currency',date_format='$date_format' where user_id=4"; 
            }
            
            
            $re=mysqli_query($conn,$query) or die(mysqli_error($conn));
            if($re){
                header("location:settings.php");
            }
    }
    $sql="select * from settings where user_id=4";
    $re=mysqli_query($conn,$sql);
    $numOfRow=mysqli_num_rows($re);
    
    $data=($numOfRow>0)?mysqli_fetch_assoc($re):[];
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
                <div class="card grid-margin stretch-card">
                    <div class="card-body">
                        <h4 class="card-title">Currency</h4>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="base_currency">Base Currency</label>
                                        <select class="js-example-basic-single w-100" id="base_currency" name="base_currency">
                                            <option value="">Select</option>
                                            <?php
                                            foreach(CURRENCY as $key=>$value){
                                            ?>

                                            <option value="<?php echo $key;  ?>" <?php echo (isset($data['base_currency']) && $data['base_currency']==$key)?'selected':''; ?>><?php echo $value;  ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="additional_currency">Additional Currencies (optional)</label>
                                        <select class="js-example-basic-single w-100" id="additional_currency" name="additional_currency">
                                        <option value="">--Select--</option>
                                            <?php
                                            foreach(CURRENCY as $key=>$value){
                                            ?>

                                            <option value="<?php echo $key;  ?>" <?php echo (isset($data['additional_currency'])&& $data['additional_currency']==$key)?'selected':''; ?>><?php echo $value;  ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_format">Date Format</label>
                                        <select class="js-example-basic-single w-100" id="date_format" name="date_format">
                                            <option value="">--Select--</option>
                                            <?php
                                            foreach(DB_DATE_FORMAT as $key=>$value){
                                            ?>

                                            <option value="<?php echo $key;  ?>" <?php echo (isset($data['date_format']) && $data['date_format']==$key)?'selected':''; ?>><?php echo $value;  ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Save" name="submit">
                        </form>
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