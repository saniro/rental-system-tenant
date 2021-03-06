<!-- Navigation -->
<?php
    require("functions/select_all_function.php");
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img style="display:inline-block;margin-right:5px;" src="img/apicon.png" class="fa-fw"><?php echo $_SESSION['apartment_name']; ?></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-bell fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-bell fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="index?route=notifications">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="index?route=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <!-- <input type="text" class="form-control" placeholder="Search..."> -->
                        <!-- <span class="input-group-btn"> -->
                        <!-- <button class="btn btn-default" type="button"> -->
                            <!-- <i class="fa fa-search"></i> -->
                        <!-- </button> -->
                    <!-- </span> -->
                    <?php
                        $user_profile = user_profile($_SESSION['user_id']);
                        $user_profile = json_decode($user_profile);
                    ?>
                    <img style="display:inline-block;margin-right:5px;width:13%;height:8%;" onerror="users/default-profile-picture.png" src="users/default-profile-picture.png" class="fa-fw">
                    <label style="text-align:center;"><?php echo $user_profile -> {'last_name'}; ?>, <?php echo $user_profile -> {'first_name'}; ?></label>
                    </div>
                    <!-- /input-group -->
                </li>
                <!-- <li>
                    <a href="index?route=notifications"><i class="fa fa-bell-o fa-fw"></i> Notifications</a> -->
                    <!-- content: notif pagkafirst open ng account na don't forget to check the terms and policies; if payment recorded by admin reflected to his account; if the house rules(?)/terms and conditions(?)/contract(?) list is updated/changed by the admin ; if may respond na sa complaint niya ; if may respond na sa change room request niya; if may respond na sa new room application niya; if may respond na sa termination request niya -->
                    <!-- possible action: mark as read (deleted ??); -->
                <!-- </li> -->
                <li>
                    <a href="index?route=roomstable"><i class="glyphicon glyphicon-home fa-fw"></i> Rooms</a>
                    <!-- content: map and actions and pop up modals per corresponding action -->
                    <!-- possible actions: apply for another room rental; change room request; request termination?? -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-ruble fa-fw"></i> Payments<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="index?route=payments">Monthly Payment</a>
                        </li>
                        <li>
                            <a href="index?route=paymenthistory">Payment History</a>
                        </li>
                    </ul>
                    <!-- content 1: general details of payment per month with columns for payment for water, electricity, room, and total of those three? MENU TAB -->
                    <!-- content 2: see full payment history regardless of monthly payment???, as in list ng lahat ng nabayad nya with dates; -->
                </li>
                <!-- <li>
                    <a href="index?route=requests"><i class="fa fa-envelope-o fa-fw"></i> Requests</a> -->
                    <!-- possible actions: delete (cancel request); see full details (including admin's respond if availablel add request) -->
                                    <!-- autogenerated ang isang request (change room) meaning si system magcocompose ng message parang sa notif, pero cancellable sempre, yung occupy room under applications tab pa rin ata siya ni admin makikita; meron ding customized na request(add request btn), parang complaints din dating pero request lng sya di reklamo (ex: delay payment? pero rejectable ni admin syempre; ex: regarding tncs)-->
                <!-- </li> -->
                <li>
                    <a href="index?route=complaints"><i class="fa fa-exclamation-triangle fa-fw"></i> Complaints</a>
                    <!-- possible actions: add another complaint; delete (delete copy ng record ng complaint na yun saka cancel complaint); see full details (including admin's respond if available); edit complaint (possible kaya to jairo? edit niya complaint tas notif admin na may nabago sa complaint id #2231 pero uneditable na pag nakapagrespond na si admin ?? kung kumplikado kht wag nlng iinclude to keri lang) -->
                </li>
                <li>
                    <a href="index?route=tncs"><i class="fa fa-list fa-fw"></i> Terms and Conditions</a>
                    <!-- content: house rules baba, taas 'by being part of the house, we imply that you agree to the house rules stated below. In case of disagreement or request, you may file a complaint and wait for the admin's respond.' -->
                    <!-- include sa ncs: 1. No pets are allowed inside the building except for some specific pets such as fishes. Pets such as dogs must be kept outside the building to avoid disturbing the neighborhood. 2. Transferring of room is allowed only upon approval of change room request. Transferring of stuffs must be done the next day after approval. -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>