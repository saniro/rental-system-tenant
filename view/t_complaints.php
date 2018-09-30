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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="contents">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date Sent</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $all_complaint = complaint_list();
                                        $all_complaint = json_decode($all_complaint);

                                        foreach ($all_complaint as $value) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value -> {'complaint_id'}; ?></td>
                                            <td><?php echo $value -> {'message_date'}; ?></td>
                                            <td style="width: 55%;"><?php echo $value -> {'message'}; ?></td>
                                            <td><?php echo $value -> {'status'}; ?></td>
                                            <td class="center">
                                                <center>
                                                    <button data-toggle="tooltip" title="View Full Details" class="btn btn-info"><span class="fa fa-file-text-o"></span></button>
                                                   <!--  <button data-toggle="tooltip" title="Edit Complaint" class="btn btn-success" id="btnEdit"><span class="fa fa-edit"></span></button> -->
                                                    <button data-toggle="tooltip" title="Cancel Complaint" class="btn btn-danger" id="btnCancel"><span class="glyphicon glyphicon-remove"></span></button>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
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
                        <label> Message: </label>
                        <textarea id="s_message" class="form-control" placeholder="Describe here..."></textarea>
                      </div>
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
                            <div class="form-group">
                                <label> ID: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message: </label>
                                <input class="form-control" placeholder="" value="" disabled="true">
                            </div>
                      </form>
                      
                       <label style="color:red;">PLEASE CONFIRM:</label> 
                        <label style="color:gray;">&emsp; Please confirm cancellation of complaint. This complaint will be voided and disregarded once you confirmed to cancel complaint.</label>
                      <br>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-danger" data-dismiss = "modal">CANCEL COMPLAINT </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
        </div>



<!-- This is the Modal that will be called for view complaint -->
          <div id = "modalViewComplaint" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Complaint Details </h4>
                      </div>
                      <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label> ID: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message: </label>
                                <input class="form-control" placeholder="" value="" disabled="true">
                            </div>
                            <div class="form-group">
                                <label> Status: </label>
                                <label id="" class="form-control"></label>
                            </div>
                        </form>
                      </div>
                      <div class = "modal-footer">
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
        </div>


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
            $('#contents').DataTable({
                responsive: true
            });

            $(document).on('click', '#btnAdd', function(){
                $('#modalAddComplaint').modal('show');
            });

            $(document).on('click', '#btnView', function(){
                $('#modalViewComplaint').modal('show');
            });

            $(document).on('click', '#btnCancel', function(){
                $('#modalCancelComplaint').modal('show');
            });

            $(document).on('click', '#SubmitAdd', function(){
                var message = $("#s_message").val();
                var complaint_send = 'selected';
                $.ajax({
                    url: 'functions/insert_function.php',
                    method: 'POST',
                    data: {
                        complaint_send_data: complaint_send,
                        message_data: message
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        var table = $("#contents").DataTable();
                        if(data.success == "true"){
                            var buttons = '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info"><span class="fa fa-file-text-o"></span></button><button data-toggle="tooltip" title="Cancel Complaint" class="btn btn-danger" id="btnCancel"><span class="glyphicon glyphicon-remove"></span></button></center>';
                            table.row.add([
                                data.complaint_id,
                                data.message_date,
                                data.message_send,
                                data.status,
                                buttons
                            ]).draw(true);
                            alert(data.message);
                        }
                        else if (data.success == "false"){
                            alert(data.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>
</body>

</html>
