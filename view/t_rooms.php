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
                    <h1 class="page-header">Rooms</h1>
                    <div class="floordivider"></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="floortitle">First Floor</h4>
                                        <button class="room leftcorner">Room 01</button>
                                        <button class="room">Room 02</button>
                                        <button class="room">Room 03</button>
                                        <button class="room">Room 04</button>
                                        <br>
                                </div>
                            </div>

                            <div class="floordivider"><br></div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="floortitle">Second Floor</h4>
                                        <button class="room leftcorner">Room 05</button>
                                        <button class="room">Room 06</button>
                                        <button class="room occupied">Room 07</button>
                                        <button class="room">Room 08</button>
                                        <br>
                                </div>
                            </div>

                            <div class="floordivider"><br></div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="floortitle">Third Floor</h4>
                                        <button class="room leftcorner occupied">Room 09</button>
                                        <button class="room">Room 10</button>
                                        <button class="room">Room 11</button>
                                        <button class="room">Room 12</button>
                                        <br>
                                </div>
                            </div>

                            <div class="floordivider"><br></div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="floortitle">Fourth Floor</h4>
                                        <button class="room leftcorner">Room 13</button>
                                        <button class="room">Room 14</button>
                                        <button class="room mine">Room 15</button>
                                        <button class="room">Room 16</button>
                                        <br>
                                </div>
                            </div>

                            <div class="floordivider"><br></div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="floortitle">Fifth Floor</h4>
                                        <button class="room leftcorner">Room 17</button>
                                        <button class="room">Room 18</button>
                                        <button class="room">Room 19</button>
                                        <button class="room">Room 20</button>
                                        <br>
                                </div>
                            </div>
                          </div>

                            <div class="floordivider"><br></div>


        
            
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


        $(document).on('click', '.room', function(){

        var roomCondition = 'vacantRoom';

            if (roomCondition === "occupiedRoom") {
                $('#modalOccupiedRoom').modal('show');
            }
            else if (roomCondition === "myRoom") {
                $('#modalMyRoom').modal('show');
            }
            else if (roomCondition === "vacantRoom") {
                $('#modalVacantRoom').modal('show');
            }
        });

        $('[data-toggle="tooltip"]').tooltip();

    });

    </script>
  

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
                            <p> &emsp; <label>This room is not yet occupied.</label> <br><br> &emsp; Click <label>OCCUPY</label> to send application to occupy this room under your account. You will be considered as a tenant of this room and be responsible for payments afterwards.<br><br> &emsp; Click <label>TRANSFER</label> to send request of change room. If approved by the admin,  tranferring of stuffs must be done the next day after approval.</p>
                      </div>
                      <div class = "modal-footer">
                        <button type ="button" class = "btn btn-primary" data-dismiss = "modal"> OCCUPY </button>
                        <button type ="button" class = "btn btn-success" data-dismiss = "modal"> TRANSFER </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
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
                            <table>
                            <tr>
                                <td> First Name: </td>
                                <td><label>Dessuh</label></td>
                            </tr>
                            <tr>
                                <td> Middle Name: </td>
                                <td><label>Remollenuh</label></td>
                            </tr>
                            <tr>
                                <td> Last Name: </td>
                                <td><label>Albuh</label></td>
                            </tr>
                            <tr>
                                <td> Birthdate: </td>
                                <td><label>Nov 14 1998</label> </td>
                            </tr>
                            <tr>
                                <td> Gender: </td>
                                <td><label>Male</label></td>
                            </tr>
                            <tr>
                                <td> Contact No: </td>
                                <td><label>09469612795</label></td>
                            </tr>
                            <tr>
                                <td> Email: </td>
                                <td><label>dessaalba08@gmail.com</label></td>
                            </tr>
                        </table>
                      </form>
                      <br>
                       <label style="color:red;">PLEASE BE INFORMED:</label> 
                        <label style="color:gray;">&emsp; Clicking terminate button will send termination request to the administrator. It will only be terminated if the admin approves the request after reviewing your payment records.</label>
                      <br>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-danger" data-dismiss = "modal">TERMINATE </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
            </div>

</body>

</html>
