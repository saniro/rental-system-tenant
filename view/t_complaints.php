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

    <title>Rental Platform</title>
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
                                                    <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnView" data-id="<?php echo $value -> {'complaint_id'}; ?>"><span class="fa fa-file-text-o"></span></button>
                                                    <?php if($value -> {'status'} != 'Responded'){?>
                                                    <button data-toggle="tooltip" title="Cancel Complaint" class="btn btn-danger" id="btnCancel" data-id="<?php echo $value -> {'complaint_id'}; ?>"><span class="glyphicon glyphicon-remove"></span></button>
                                                    <?php
                                                        }
                                                    ?>
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
                      <div class = "form-group">
                        <label> Message: </label>
                        <textarea id="s_message" class="form-control" placeholder="Describe here..."></textarea>
                      </div>
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
                                <label id="c_complaint_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date: </label>
                                <label id="c_complaint_date" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message: </label>
                                <textarea id="c_complaint_message" class ="form-control" disabled></textarea>
                                <!-- <input class="form-control" placeholder="" value="" disabled="true"> -->
                            </div>
                      </form>
                      
                       <label style="color:red;">PLEASE CONFIRM:</label> 
                        <label style="color:gray;">&emsp; Please confirm cancellation of complaint. This complaint will be voided and disregarded once you confirmed to cancel complaint.</label>
                      <br>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-danger" id="SubmitCancelComplaint" data-dismiss = "modal">CANCEL COMPLAINT </button>
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
                                <label id="v_complaint_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date: </label>
                                <label id="v_complaint_date" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message: </label>
                                <textarea id="v_message" class="form-control" placeholder="" value="" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label> Status: </label>
                                <label id="v_status" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date Responded: </label>
                                <label id="v_replied_date" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Response: </label>
                                <textarea id="v_response" class="form-control" placeholder="" value="" disabled></textarea>
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
            var table_row;
            $('#contents').DataTable({
                responsive: true
            });

            $(document).on('click', '#btnAdd', function(){
                $('#modalAddComplaint').modal('show');
            });

            $(document).on('click', '#btnView', function(){
                var complaint_id = $(this).attr('data-id');
                var view_complaint_details = 'selected';

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_complaint_details_data: view_complaint_details,
                        complaint_id_data: complaint_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        var table = $("#contents").DataTable();
                        if(data.success == "true"){
                            $('#v_complaint_id').html(data.complaint_id);
                            $('#v_complaint_date').html(data.message_date);
                            $('#v_message').html(data.message);
                            $('#v_status').html(data.status);
                            $('#v_replied_date').html(data.response_date);
                            $('#v_response').html(data.response);

                            $('#modalViewComplaint').modal('show');
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

            $(document).on('click', '#btnCancel', function(){
                var complaint_id = $(this).attr('data-id');
                var view_complaint = 'selected';
                table_row = $(this).parents('tr');
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_complaint_data: view_complaint,
                        complaint_id_data: complaint_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        var table = $("#contents").DataTable();
                        if(data.success == "true"){
                            $('#c_complaint_id').html(data.complaint_id);
                            $('#c_complaint_date').html(data.message_date);
                            $('#c_complaint_message').html(data.message);
                            $('#SubmitCancelComplaint').attr('data-id', data.complaint_id);
                            $('#modalCancelComplaint').modal('show');
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
                            table.row.add([
                                data.complaint_id,
                                data.message_date,
                                data.message_send,
                                data.status,
                                data.buttons
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

            $(document).on('click', '#SubmitCancelComplaint', function(){
                var complaint_id = $(this).attr('data-id');
                var delete_complaint = 'selected';
                $.ajax({
                    url: 'functions/delete_function.php',
                    method: 'POST',
                    data: {
                        delete_complaint_data: delete_complaint,
                        complaint_id_data: complaint_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            var table = $("#contents").DataTable();
                            table.row( table_row ).remove().draw();
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
