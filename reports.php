<?php
include 'config/dbcon.php';
if (!isset($_SESSION['is_loggedin'])) {
    header('location:login.php');
}
if (isset($_REQUEST['submit'])) {

    $add_expense = $_REQUEST['add_expense'];
    $add_transfer = $_REQUEST['add_transfer'];
    $add_income = $_REQUEST['add_income'];
}

$sql = "select id,name,type from add_accounts where user_id='" . $_SESSION['id'] . "'";
$re = mysqli_query($conn, $sql);
$numOfRow = mysqli_num_rows($re);
$accounts_list = [];

if ($numOfRow > 0) {
    while ($res = mysqli_fetch_assoc($re)) {
        $accounts_list[] = $res;
    }
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

        <!-- sidebar.html -->
        <?php include 'layout/sidebar.php'; ?>
        <!-- sidebar -->

        <div class="page-wrapper">

            <!-- navbar.html -->
            <?php include 'layout/topnav.php'; ?>
            <!-- navbar -->

            <div class="page-content">
                <div class="row mt-4">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">TRANSACTIONS LIST</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Transaction Types
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Income</a>
                                                    <a class="dropdown-item" href="#">Expense</a>
                                                    <a class="dropdown-item" href="#">Transfer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="daterange" value="" />
                                            <input type="hidden" id="from_date2" name="from_date" />
                                            <input type="hidden" id="end_date2" name="end_date" />
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-bordered" id="transaction_list">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer.html -->
            <?php include 'layout/footer.php'; ?>
            <!-- footer -->

        </div>
    </div>

    <!-- core:js -->
    <?php include 'layout/script.php' ?>
    <!-- core:js ends -->
    <script>
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

        $.validator.addMethod("lessThan",
            function(value, element, param) {
                var otherElement = $('#from_amount').text();

                value = value.replace(/[,₹]/ig, '');
                otherElement = otherElement.replace(/[,₹]/ig, '');

                return Number(value) <= Number(otherElement);
            }, 'Please enter a Amount less than or equal to ' + ($('#from_amount').html()));

        $("#addexpense").validate({
            rules: {
                from_account: {
                    required: true
                },
                amount: {
                    required: true,
                    lessThan: true
                },
                transaction_date: {
                    required: true
                },

            },
            messages: {


            },
            errorPlacement: function(error, element) {
                console.log(element.attr('name'));
                if (element.attr('name') == 'amount') {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
        const trans = $('#transaction_list').DataTable({
            "ajax": {
                url: 'transaction_list.php?',
                method: "POST",
                data: {
                    "user_id": <?php echo $_SESSION['id']; ?>
                }
            },
            order: [
                [1, 'asc']
            ],
            ordering: false,
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
                    data: 'action',
                    title: "Action"
                },


            ]


        });


        $(function() {
            'use strict';
            if ($('#datePickerExample1,#datePickerExample2,#datePickerExample3').length) {
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                $('#datePickerExample1,#datePickerExample2,#datePickerExample3').datepicker({
                    format: "mm/dd/yyyy",
                    todayHighlight: true,
                    autoclose: true,
                    endDate: today
                });
                $('#datePickerExample1,#datePickerExample2,#datePickerExample3').datepicker('setDate', today);
                $('#datePickerExample1,#datePickerExample2,#datePickerExample3').datepicker('minDate', today);
            }
            $('#addtransfer,#addexpense,#addincome').validate();
            $('#addtransfer,#addexpense,#addincome').on('submit', function(e) {
                e.preventDefault();
                // alert($(this).serialize());
                var form = $(this);
                if ($(this).valid()) {
                    $.ajax({
                        url: "addexpense.php",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            console.log(form);
                            form[0].reset();

                            trans.ajax.reload();
                        }
                    })
                }
                return false;

            });
        });

        $(document).ready(function() {

            $.ajax({
                url: "getamount.php",
                method: "POST",
                data: {
                    account: $(this).val(),
                    user_id: <?php echo $_SESSION['id']; ?>
                },
                success: function(response) {
                    $('#ac').show();
                    $('#from_amount').html(response);
                }
            });

        });

        function deleterow(id) {

            debugger
            if (id != "" && id != "undefined") {
                $.ajax({
                    url: "delete_trs.php",
                    method: "POST",
                    data: {
                        trs_id: id,
                        user_id: <?php echo $_SESSION['id']; ?>
                    },
                    success: function(response) {
                        trans.ajax.reload();
                    }
                });

            }
            return false;
        }
    </script>
</body>

</html>