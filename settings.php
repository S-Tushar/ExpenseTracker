<?php
	include 'config/dbcon.php';
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
                            <div class="col-12">
                                <h4 class="card-title">Currency</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Base Currency</label>
                                        <select class="js-example-basic-single w-100" id="currency" name="currency">
                                            <option value="USD"><i class="flag-icon flag-icon-us"></i>USD, US Dollar</option>
                                            <option value="AED">AED, Emirati Dirham</option>
                                            <option value="GBP">GBP, British Pound</option>
                                            <option value="IDR">IDR, Indonesian Rupiah</option>
                                            <option value="INR" selected>INR, Indian Rupee</option>s
                                            <option value="JPY">JPY, Japanese yen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Additional Currencies (optional)</label>
                                        <select class="js-example-basic-single w-100">
                                            <option value="USD">USD, US Dollar</option>
                                            <option value="AED">AED, Emirati Dirham</option>
                                            <option value="GBP">GBP, British Pound</option>
                                            <option value="IDR">IDR, Indonesian Rupiah</option>
                                            <option value="INR">INR, Indian Rupee</option>
                                            <option value="JPY">JPY, Japanese yen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date Format</label>
                                        <select class="js-example-basic-single w-100" id="date_format" name="date_format">
                                            <option value="DD-MM-YYYY">DD-MM-YYYY</option>
                                            <option value="MM-DD-YYYY">MM-DD-YYYY</option>
                                            <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                            <option value="MM-DD-YY">MM-DD-YY</option>
                                            <option value="DD-MM-YY">DD-MM-YY</option>
                                            <option value="YY-MM-DD">YY-MM-DD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </div>
            </div>
        </div>

        <!-- partial:../../partials/_footer.html -->
        <?php include 'layout/footer.php'; ?>
        <!-- partial -->

    </div>

    <!-- core:js -->
    <?php include 'layout/script.php'?>
    <!-- core:js ends -->
</body>

</html>