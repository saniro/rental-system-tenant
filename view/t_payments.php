<?php
    if(!isset($_SESSION['user_id'])){
        header("location:index");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Apartment Rental</title>
    <link rel="icon" href="img/apicon.png">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>

    <div id="wrapper">

        <?php
            require("t_navigation.php");
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Payments</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">



                    
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#general" data-toggle="tab">General</a>
                                </li>
                                <li><a href="#room" data-toggle="tab">Room Rental</a>
                                </li>
                                <li><a href="#electricity" data-toggle="tab">Electricity Consumption</a>
                                </li>
                                <li><a href="#water" data-toggle="tab">Water Consumption</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="general">
                                    <br>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="tblgeneral">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Room Rental Cost</th>
                                        <th>Electricity Consumption Cost</th>
                                        <th>Water Consumption Cost</th>
                                        <th>Total Cost</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>January</td>
                                        <td>2019</td>
                                        <td>10000</td>
                                        <td>2000</td>
                                        <td>1000</td>
                                        <td>13000</td>
                                        <td>10000</td>
                                        <td>Not Paid</td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                                <div class="tab-pane fade" id="room">
                                    <br>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="tblroom">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Room Rental Cost</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>January</td>
                                        <td>2019</td>
                                        <td>10000</td>
                                        <td>10000</td>
                                        <td>Paid</td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                                <div class="tab-pane fade" id="electricity">
                                    <br>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="tblelectricity">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Electricity Consumption Cost</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>January</td>
                                        <td>2019</td>
                                        <td>2000</td>
                                        <td>0</td>
                                        <td>Not Paid</td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                                <div class="tab-pane fade" id="water">
                                    <br>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="tblwater">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Water Consumption Cost</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>January</td>
                                        <td>2019</td>
                                        <td>1000</td>
                                        <td>0</td>
                                        <td>Not Paid</td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->


  
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {

        $('#tblgeneral').DataTable({
            responsive: true
        });
        $('#tblroom').DataTable({
            responsive: true
        });
        $('#tblelectricity').DataTable({
            responsive: true
        });
        $('#tblwater').DataTable({
            responsive: true
        });
        
        $('[data-toggle="tooltip"]').tooltip();

    });
    </script>

    



</body>

</html>
