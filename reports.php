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
                                    
                                        <div class="form-group col-md-3">
                                           

                                            <select name="transaction_type" class="form-control" id="transaction_type">
                                                <option value="">--Transaction Type--</option>
                                                <option value="INCOME">Income</option>
                                                <option value="EXPENSE">Expense</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control" name="daterange" value="" />
                                            <input type="hidden" id="from_date" name="from_date" />
                                            <input type="hidden" id="end_date" name="end_date" />
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
                maxDate: new Date()
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
            dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ],
            "ajax": {
                url: 'transaction_list.php?',
                
               
                method: "POST",
                data: function(d) {
                    d.user_id = <?php echo $_SESSION['id']; ?>;
                    d.from_date = $('#from_date').val();
                    d.end_date = $('#end_date').val();
                    d.transaction_type= $('#transaction_type').val();
                    d.tags = $('#tags2').val();
                   
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
                


            ],
           
                "drawCallback": function( settings ) {
                    var api = this.api();
                   console.log(api.data());
                    if($('#transaction_list tfoot').length==0){
                    //$('#transaction_list').append('<tfoot><tr><td colspan="3"><Total/td><td></td></tr></tfoot>');
                    }
                }
            


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
        $('#transaction_type').on('change',function(){
            trans.ajax.reload();
        });
        function callajax(){
            trans.ajax.reload();
        }
    </script>
</body>

</html>