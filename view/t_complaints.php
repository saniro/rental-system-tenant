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
                    <h1 class="page-header">Complaints</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button data-toggle="tooltip" title="Add Complaint" class="btn btn-info" id="btnAdd"><span class="glyphicon glyphicon-plus"></span> Add</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Complaint ID</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>1</td>
                                        <td>Jan 02 2019</td>
                                        <td>Policies</td>
                                        <td>I can't follow rule #2. I have a pet (cat) and can't simply leave it outdoor. Can I instead keep it in? I promise to keep it quiet and clean to avoid any possible problem.</td>
                                        <td class="center">
                                            <center>
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info"><span class="fa fa-file-text-o"></span></button>
                                               <!--  <button data-toggle="tooltip" title="Edit Complaint" class="btn btn-success" id="btnEdit"><span class="fa fa-edit"></span></button> -->
                                                <button data-toggle="tooltip" title="Cancel Complaint" class="btn btn-danger" id="btnCancel"><span class="glyphicon glyphicon-remove"></span></button>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        $('#dataTables-example').DataTable({
            responsive: true
        });

        $(document).on('click', '#btnAdd', function(){
            $('#modalAddComplaint').modal('show');
        });

        // $(document).on('click', '#btnEdit', function(){
        //     $('#modalEditComplaint').modal('show');
        // });

        $(document).on('click', '#btnCancel', function(){
            $('#modalCancelComplaint').modal('show');
        });

        $('[data-toggle="tooltip"]').tooltip();

    });
    </script>


 <!-- This is the Modal that will be called for add complaint -->
      <div class = "modal fade" id = "modalAddComplaint" role = "dialog">
        <div class = "modal-dialog">

          <div class="modal-content">
            <div class = "modal-header">
              <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Send New Complaint </h4>
                  </div>
                  <div class="modal-body">
                    <form>

                      <div class = "form-group">
                        <table>
                            <tr>
                                <td> Subject: </td>
                                <td><input type="text" placeholder="Enter Subject" required></td>
                            </tr>
                            <tr>
                                <td> Description: </td>
                                <td><textarea placeholder="Describe here..."></textarea></td>
                            </tr>
                        </table>
                      </div><br>

                    </form>
                  </div>
                  <div class = "modal-footer">
                    <button type ="button" class= "btn btn-primary" data-dismiss="modal" id="SubmitAdd">SEND </button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
                  </div>
                </div>
          </div>
        </div>

<!-- This is the Modal that will be called for cancel complaint -->
          <div id = "modalCancelComplaint" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Cancel Complaint </h4>
                      </div>
                      <div class="modal-body">
                        <form>
                            <table>
                            <tr>
                                <td> ID: </td>
                                <td> 1</td>
                            </tr>
                            <tr>
                                <td> Date: </td>
                                <td> Feb 23 2019</td>
                            </tr>
                            <tr>
                                <td> Subject: </td>
                                <td> Policies</td>
                            </tr>
                        </table>
                      <br>
                       <label style="color:red;">PLEASE CONFIRM:</label> 
                        <label style="color:gray;">&emsp; Please confirm cancellation of complaint. This complaint will be voided and disregarded once you confirmed to cancel complaint.</label>
                      <br>
                      </form>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-danger" data-dismiss = "modal">CANCEL COMPLAINT </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
            </div>

</body>

</html>
