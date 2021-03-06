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

    <!-- Rooms Map -->
    <link href="dist/css/map.css" rel="stylesheet">


</head>

<body>

    <div id="wrapper">

        <?php
            require("t_navigation.php");
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Rooms
                        <?php
                            $check_termination = check_termination();
                            $check_termination = json_decode($check_termination);
                        ?>
                        <button style = "font-weight:bold;float:right;" class="btn btn-primary" id="btnViewTR" <?php if($check_termination -> {'success'} == 'true'){ if($check_termination -> {'status'} == 'okay'){ echo 'data-id="' . $check_termination -> {'rental_id'} . '"'; } } ?> <?php if($check_termination -> {'success'} == 'true'){ if($check_termination -> {'status'} == 'not'){ echo $check_termination -> {'message'}; } } else{ echo "<script>alert('".$check_termination -> {'message'}."');</script>"; } ?>>View Termination Request</button>
                        <?php
                            $check_change_room = check_change_room();
                            $check_change_room = json_decode($check_change_room);
                        ?>
                        <button style = "font-weight:bold;float:right;margin-right:5px;" class="btn btn-success" id="btnViewCR" <?php if($check_change_room -> {'success'} == 'true'){ if($check_change_room -> {'status'} == 'okay'){ echo 'data-id="' . $check_change_room -> {'rental_id'} . '"'; } } ?> <?php if($check_change_room -> {'success'} == 'true'){ if($check_change_room -> {'status'} == 'not'){ echo $check_change_room -> {'message'}; } } else{ echo "<script>alert('".$check_change_room -> {'message'}."');</script>"; } ?>>View Change Room Request</button>
                    </h1>
                    <div class="floordivider"></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">First Floor</h4>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(1, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            leftcorner" data-id="1">Room 01</button>

                            <button class="room 
                                <?php 
                                    $room_check = room_check(2, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="2">Room 02</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(3, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="3">Room 03</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(4, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="4">Room 04</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Second Floor</h4>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(5, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            leftcorner" data-id="5">Room 05</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(6, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="6">Room 06</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(7, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="7">Room 07</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(8, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="8">Room 08</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Third Floor</h4>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(9, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            leftcorner" data-id="9">Room 09</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(10, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="10">Room 10</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(11, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="11">Room 11</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(12, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="12">Room 12</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Fourth Floor</h4>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(13, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?> 
                            leftcorner" data-id="13">Room 13</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(14, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="14">Room 14</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(15, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="15">Room 15</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(16, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="16">Room 16</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Fifth Floor</h4>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(17, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                             leftcorner" data-id="17">Room 17</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(18, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="18">Room 18</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(19, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="19">Room 19</button>
                            <button class="room 
                                <?php 
                                    $room_check = room_check(20, $_SESSION['user_id']);
                                    $room_check = json_decode($room_check);
                                    //echo "<script>alert('".$room_check."');</script>";
                                    if($room_check -> {'status'} == 'occupied'){
                                        if($room_check -> {'who'} == 'mine'){
                                            echo 'mine';
                                        }
                                        else{
                                            echo 'occupied';
                                        }
                                    }
                                ?>
                            " data-id="20">Room 20</button>
                            <br>
                    </div>
                </div>
            </div>

            <div class="floordivider"><br></div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<!-- Pag occupied yung room di niya maviview details kasi private yun, si admin lang makakakita -->
<!-- This is the Modal that will be called for occupied room btn -->
          <div id = "modalOccupiedRoom" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Room Occupied! </h4>
                      </div>
                      <div class="modal-body">
                            <p> &emsp; This room is occupied. Unable to apply or transfer to this room. For security reasons, information about the current room tenant is always kept private.</p>
                      </div>
                      <div class = "modal-footer">
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
            </div>

<!-- This is the Modal that will be called for vacant room btn -->
          <div id = "modalVacantRoom" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Room Vacant! </h4>
                      </div>
                      <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label id="v_room_id" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Name: </label>
                                        <label id="v_room_name" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Rate: </label>
                                        <label id="v_rent_rate" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Description: </label>
                                        <label id="v_room_description" class="form-control"></label>
                                    </div>
                                </form>
                                <p><br> &emsp; This room is not yet occupied. Click <label>TRANSFER</label> to send request of change room. If approved by the admin,  tranferring of stuffs must be done the next day after approval.</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class="btn btn-success" id="SubmitTransfer" data-dismiss="modal"> TRANSFER </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
            </div>

<!-- This is the Modal that will be called for my room btn -->
        <div id = "modalMyRoom" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Room Tenant's Details </h4>
                      </div>
                      <div class="modal-body">
                        <form>
                            <center>
                                    <img src="users/defaultprofpic.jpg" alt="Profile Picture">
                            </center>
                            <form>
                                <div class="form-group">
                                    <label> Name: </label>
                                    <label id="m_name" class="form-control"></label>
                                </div>
                                <div class="form-group">
                                    <label> Birthdate: </label>
                                    <label id="m_birth_date" class="form-control"></label>
                                </div>
                                <div class="form-group">
                                    <label> Gender: </label>
                                    <label id="m_gender" class="form-control"></label>
                                </div>
                                <div class="form-group">
                                    <label> Contact No: </label>
                                    <label id="m_contact_no" class="form-control"></label>
                                </div>
                                <div class="form-group">
                                    <label> Email: </label>
                                    <label id="m_email" class="form-control"></label>
                                </div>
                        </form>
                      </form>
                      <br>
                       <label style="color:red;">PLEASE BE INFORMED:</label> 
                        <label style="color:gray;">&emsp; Clicking terminate button will send termination request to the administrator. It will only be terminated if the admin approves the request after reviewing your payment records.</label>
                      <br>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-danger" id="SubmitTerminate" data-dismiss = "modal">TERMINATE </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
        </div>

        <div id = "modalConfirmRemovalExistingRequest" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Confirmation </h4>
                      </div>
                      <div class="modal-body">
                            <p> &emsp; <label>You already have a request.</label> <br>
                            <br> &emsp; Click <label>YES</label> to cancel your request to change room to <label id="old_room"></label> to <label id="new_room"></label>.</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class="btn btn-success" id="SubmitNewTransfer" data-dismiss="modal"> YES </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> NO </button>
                      </div>
                    </div>
              </div>
        </div>

        <div id = "modalConfirmTerminationRequest" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Confirmation </h4>
                      </div>
                      <div class="modal-body">
                            <p> &emsp; <label>Are you sure to send termination request?</label></p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class="btn btn-success" id="SubmitConfirmTerminate" data-dismiss="modal"> YES </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> NO </button>
                      </div>
                    </div>
              </div>
        </div>


<!-- modalViewTR -->
        <div id = "modalViewTR" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Termination Request </h4>
                      </div>
                      <div class="modal-body">
                            <p> &emsp; You sent a request to terminate your tenancy last <label id="dateTerminate"></label>. Do you wish to cancel this request?</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class="btn btn-danger" id="SubmitCancelTerminate" data-id="<?php if($check_termination -> {'success'} == 'true'){ echo $check_termination -> {'rental_id'}; } ?>" data-dismiss="modal"> CANCEL REQUEST </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
        </div>


<!-- modalViewCR -->
        <div id = "modalViewCR" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Change Room Request </h4>
                      </div>
                      <div class="modal-body">
                            <p> &emsp; You sent a request to transfer from <label id="c_current_room"></label> to <label id="c_requested_room"></label> last <label id="c_date_requested"></label>. Do you wish to cancel this request?</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class="btn btn-danger" id="SubmitCancelRequestChange" data-id="<?php if($check_change_room -> {'success'} == 'true'){ echo $check_change_room -> {'rental_id'}; } ?>" data-dismiss="modal"> CANCEL REQUEST </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"> CLOSE </button>
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
            $('#dataTables-example').DataTable({
                responsive: true
            });

            $(document).on('click', '#btnViewTR', function(){
                var room_view_terminate_request = 'selected';
                var rental_id = $(this).attr('data-id');

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        room_view_terminate_request_data: room_view_terminate_request,
                        rental_id_view_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#dateTerminate').html(data.date_requested);
                            $('#modalViewTR').modal('show');
                            // $('#modalConfirmTerminationRequest').modal('show');
                            // alert('rental_id ' + data.rental_id);
                            // alert('user id '+ data.user_id);
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

            $(document).on('click', '#btnViewCR', function(){
                var room_view_change_room_request = 'selected';
                var rental_id = $(this).attr('data-id');

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        room_view_change_room_request_data: room_view_change_room_request,
                        rental_id_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#c_current_room').html(data.current_room);
                            $('#c_requested_room').html(data.requested_room);
                            $('#c_date_requested').html(data.date_requested);
                            $('#modalViewCR').modal('show');
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

            $(document).on('click', '.room', function(){
                var room_id = $(this).attr('data-id');
                var user_id = <?php echo $_SESSION['user_id']; ?>;
                var room_check = 'selected';

                $.ajax({
                    url: 'functions/room_function.php',
                    method: 'POST',
                    data: {
                        room_check_data: room_check,
                        room_id_data: room_id,
                        user_id_data: user_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            if(data.status == "occupied"){
                                $('#modalOccupiedRoom').modal('show');
                            }
                            else if (data.status == "vacant"){
                                $("#v_room_picture").html(data.room_picture);
                                $("#v_room_id").html(data.room_id);
                                $("#v_room_name").html(data.room_name);
                                $("#v_rent_rate").html(data.rent_rate);
                                $("#v_room_description").html(data.room_description);
                                $("#SubmitTransfer").attr('data-id', data.room_id);
                                $('#modalVacantRoom').modal('show');
                            }
                            else if (data.status == "my_room"){
                                $("#m_name").html(data.name);
                                $("#m_birth_date").html(data.birth_date);
                                $("#m_gender").html(data.gender);
                                $("#m_contact_no").html(data.contact_no);
                                $("#m_email").html(data.email);
                                $("#SubmitTerminate").attr('data-id', room_id);
                                $('#modalMyRoom').modal('show');
                            }
                            // var table = $('#table-contents').DataTable();
                        //     table.row('#'+tenant_id).remove().draw();
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

            $(document).on('click', '#SubmitTransfer', function(){
                var room_id = $(this).attr('data-id');
                var user_id = <?php echo $_SESSION['user_id']; ?>;
                var room_transfer_request = 'selected';

                $.ajax({
                    url: 'functions/insert_function.php',
                    method: 'POST',
                    data: {
                        room_transfer_request_data: room_transfer_request,
                        room_id_data: room_id,
                        user_id_data: user_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            if(data.request == "made"){
                                $('#old_room').html(data.old_room_name);
                                $('#new_room').html(data.new_room_name);
                                $('#SubmitNewTransfer').attr('data-id', room_id);
                                $('#modalConfirmRemovalExistingRequest').modal('show');
                            }
                            else if(data.request == "none"){
                                alert(data.message);
                            }
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

            $(document).on('click', '#SubmitNewTransfer', function(){
                var room_id = $(this).attr('data-id');
                var user_id = <?php echo $_SESSION['user_id']; ?>;
                var room_new_transfer_request = 'selected';

                $.ajax({
                    url: 'functions/update_function.php',
                    method: 'POST',
                    data: {
                        room_new_transfer_request_data: room_new_transfer_request,
                        room_id_data: room_id,
                        user_id_data: user_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            if(data.request == "made"){
                                alert(data.message);
                            }
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

            $(document).on('click', '#SubmitTerminate', function(){
                var room_confirm_terminate_request = 'selected';

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        room_confirm_terminate_request_data: room_confirm_terminate_request
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#SubmitConfirmTerminate').attr('data-id', room_id);
                            $('#modalConfirmTerminationRequest').modal('show');
                            // alert('rental_id ' + data.rental_id);
                            // alert('user id '+ data.user_id);
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

            $(document).on('click', '#SubmitConfirmTerminate', function(){
                var room_id = $(this).attr('data-id');
                var user_id = <?php echo $_SESSION['user_id']; ?>;
                var room_terminate_request = 'selected';

                $.ajax({
                    url: 'functions/insert_function.php',
                    method: 'POST',
                    data: {
                        room_terminate_request_data: room_terminate_request,
                        room_id_data: room_id,
                        user_id_data: user_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            alert(data.message);
                            $("#btnViewTR").removeAttr("disabled");
                            $('#btnViewTR').attr('data-id', data.rental_id);
                            // $('#modalConfirmTerminationRequest').modal('show');
                            // alert('rental_id ' + data.rental_id);
                            // alert('user id '+ data.user_id);
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

            $(document).on('click', '#SubmitCancelTerminate', function(){
                var rental_id = $(this).attr('data-id');
                var room_cancel_terminate_request = 'selected';

                $.ajax({
                    url: 'functions/delete_function.php',
                    method: 'POST',
                    data: {
                        room_cancel_terminate_request_data: room_cancel_terminate_request,
                        rental_id_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            alert(data.message);
                            $("#btnViewTR").attr("disabled", true);
                            // $('#modalConfirmTerminationRequest').modal('show');
                            // alert('rental_id ' + data.rental_id);
                            // alert('user id '+ data.user_id);
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

            $(document).on('click', '#SubmitCancelRequestChange', function(){
                var rental_id = $(this).attr('data-id');
                var room_cancel_change_room_request = 'selected';

                $.ajax({
                    url: 'functions/delete_function.php',
                    method: 'POST',
                    data: {
                        room_cancel_change_room_request_data: room_cancel_change_room_request,
                        rental_id_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            alert(data.message);
                            $("#btnViewCR").attr("disabled", true);
                            // $('#modalConfirmTerminationRequest').modal('show');
                            // alert('rental_id ' + data.rental_id);
                            // alert('user id '+ data.user_id);
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
