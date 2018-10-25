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
                    <h1 class="page-header">Monthly Payments</h1>
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
                                <li class="active"><a href="#room" data-toggle="tab">Room Rental</a>
                                </li>
                                <li><a href="#uti" data-toggle="tab">Utility Bills</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="room">
                                    <br>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="tblroommp">
                                    <thead>
                                        <tr>
                                            <th>Due Date</th>
                                            <th>Room Rental Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $m_payment = m_payment();
                                        $m_payment = json_decode($m_payment);

                                        foreach ($m_payment as $value) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value -> {'due_date'}; ?></td>
                                            <td><?php echo $value -> {'payables'}; ?></td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="uti">
                                    <br>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="tblutimp">
                                    <thead>
                                        <tr>
                                            <th>Due Date</th>
                                            <th>Utility Bill Type</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr class="odd gradeX">
                                            <td>January 02, 2019</td>
                                            <td>Electricity Consumption Bill</td>
                                            <td style="width:50%;">Payment for electricity consumption. Amount computed from submeter readings and meralco bill.</td>
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

       
        $('#tblroommp').DataTable({
            responsive: true
        });
        $('#tblutimp').DataTable({
            responsive: true
        });
        
        $('[data-toggle="tooltip"]').tooltip();

    });
    </script>

    



</body>

</html>
