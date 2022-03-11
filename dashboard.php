<?php
include 'config/dbcon.php';

if (!isset($_SESSION['is_loggedin'])) {
    header('location:login.php');
}

//$sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type='INCOME' and from_account='".$_REQUEST['account']."'";
$sql = "select sum(amount) as total from transactions where user_id='" . $_SESSION['id'] . "' and transaction_type='INCOME'";
$re = mysqli_query($conn, $sql);
$numOfRow = mysqli_num_rows($re);
$income = mysqli_fetch_assoc($re)['total'];

//$sql = "select sum(amount) as total from transactions where user_id='".$_REQUEST['user_id']."' and transaction_type!='INCOME' and from_account='".$_REQUEST['account']."'";
$sql = "select sum(amount) as total from transactions where transaction_type!='INCOME' and user_id='" . $_SESSION['id'] . "'";
$re = mysqli_query($conn, $sql);
$numOfRow = mysqli_num_rows($re);
$expense = mysqli_fetch_assoc($re)['total'];


$sql = "SELECT add_accounts.type,add_accounts.name,sum(amount) as total FROM `transactions` join add_accounts on add_accounts.id=transactions.from_account WHERE transactions.user_id='" . $_SESSION['id'] . "' GROUP BY add_accounts.type";
$re = mysqli_query($conn, $sql);
$numOfRow = mysqli_num_rows($re);
$data = [];
$x = 0;
$i = 0;
if ($numOfRow > 0) {
    while ($res = mysqli_fetch_assoc($re)) {

        $data[$i]['type'] = $res['type'];
        $data[$i]['total'] = $res['total'];
        $data[$i]['data'] = getrow($res['type'], 4, $conn);

        $i++;
    }
}

function getrow($type, $user_id, $conn)
{
    $sql2 = "SELECT add_accounts.type,add_accounts.name,sum(amount) as total FROM `transactions` join add_accounts on add_accounts.id=transactions.from_account WHERE transactions.user_id='$user_id' and add_accounts.type='$type' GROUP BY add_accounts.type,transactions.from_account";

    $re = mysqli_query($conn, $sql2);
    $numOfRow = mysqli_num_rows($re);

    $data = [];
    if ($numOfRow > 0) {
        while ($res = mysqli_fetch_assoc($re)) {
            $data[] = $res;
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
                <div class="card mb-5">
                    <div class="card-body">
                        <div id="barchart_material" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Expense</h6>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="daterange" value="" />
                                    <input type="hidden" id="from_date" name="from_date" />
                                    <input type="hidden" id="end_date" name="end_date" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                $sql2 = "SELECT * from tags ";

                                $re2 = mysqli_query($conn, $sql2);
                                $numOfRow2 = mysqli_num_rows($re2);
                                ?>
                                <div class="form-group">
                                    <select class="form-control" id="tags2" onchange="callajax()">
                                        <option value="">Select Tags </option>
                                        <?php
                                        if ($numOfRow2 > 0) {
                                            while ($r = mysqli_fetch_assoc($re2)) {
                                        ?>
                                                <option value="<?php echo $r['tags'] ?>"><?php echo $r['tags'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" id="transaction_list">

                        </table>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-body">
                        <h6 class="card-title">Income</h6>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="daterange" value="" />
                                    <input type="hidden" id="from_date2" name="from_date" />
                                    <input type="hidden" id="end_date2" name="end_date" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                $sql2 = "SELECT * from tags ";

                                $re2 = mysqli_query($conn, $sql2);
                                $numOfRow2 = mysqli_num_rows($re2);
                                ?>
                                <div class="form-group">
                                    <select class="form-control" id="tags3" onchange="callajax()">
                                        <option value="">Select Tags </option>
                                        <?php
                                        if ($numOfRow2 > 0) {
                                            while ($r = mysqli_fetch_assoc($re2)) {
                                        ?>
                                                <option value="<?php echo $r['tags'] ?>"><?php echo $r['tags'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" id="transaction_list_credit">

                        </table>
                    </div>
                </div>

                <div class="card mt-5 d-none">
                    <div class="card-body">
                        <h6 class="card-title">Net Worth</h6>

                        <div class="accordion" id="accordionExample">

                            <?php
                            if (!empty($data)) {
                                foreach ($data as $key => $d) {
                            ?>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key; ?>">
                                                <?php echo ucwords($d['type']) . ' &nbsp;&nbsp;-' . $d['total'] ?>
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
    <script>
        var ts;

        var ts = $('#transaction_list').DataTable({
            "ajax": {
                url: 'transaction_list.php',
                method: "POST",
                data: function(d) {
                    d.user_id = <?php echo $_SESSION['id']; ?>;
                    d.from_date = $('#from_date2').val();
                    d.end_date = $('#end_date2').val();
                    d.tags = $('#tags2').val();
                    d.type = 'D';
                },
            },
            ordering: false,
            order: [
                [1, 'asc']
            ],
            "columns": [
                /*{
                    data: 'from_account_name',
                    title: "Form Account"
                },*/
                {
                    data: 'transaction_type',
                    title: "Transaction Type"
                },
                {
                    data: 'tags',
                    title: "Tags"
                },
                {
                    data: 'transaction_date',
                    title: "Transaction Date"
                },
                {
                    data: 'amount',
                    title: "Amount"
                },


            ],

        });



        var ts2 = $('#transaction_list_credit').DataTable({
            "ajax": {
                url: 'transaction_list.php',
                method: "POST",
                data: function(d) {
                    d.user_id = <?php echo $_SESSION['id']; ?>;
                    d.from_date = $('#from_date').val();
                    d.end_date = $('#end_date').val();
                    d.tags = $('#tags3').val();
                    d.type = 'C';
                },
            },
            ordering: false,
            order: [
                [1, 'asc']
            ],
            "columns": [
                /*{
                    data: 'from_account_name',
                    title: "Form Account"
                },*/
                {
                    data: 'transaction_type',
                    title: "Transaction Type"
                },
                {
                    data: 'tags',
                    title: "Tags"
                },
                {
                    data: 'transaction_date',
                    title: "Transaction Date"
                },
                {
                    data: 'amount',
                    title: "Amount"
                },
                {
                    data: 'amount',
                    title: "Amount",
                    visible: false,
                },


            ],

        });


        $(document).ready(function() {




            $('input[name="daterange"]').daterangepicker({
                opens: 'right',
                "startDate": moment().startOf('month'),
                "endDate": moment().endOf('month'),
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                $('#from_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
                callajax();
            });

        });

        function callajax() {

            ts.ajax.reload();
            ts2.ajax.reload();

        }
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Income', 'Expenses'],
                ['2014', 1000, 400],
                ['2015', 1170, 460],
                ['2016', 660, 1120],
                ['2017', 1030, 540]
            ]);

            var options = {
                chart: {
                    title: 'Net Worth',
                    subtitle: 'Income and Expenses: Month',
                },
                bars: 'vertical' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</body>

</html> 