<?php
	require("functions/filter.php");
	if(!isset($_GET['route'])){
		$_GET['route'] = "";
	}
	session_start();
	switch (filter($_GET['route'])) {
		case '':
			require("view/t_login.php");
			break;
		case 'login':
			require("view/t_login.php");
			break;
		// case 'notifications':
		// 	require("view/t_notifications.php");
		// 	break;
		case 'roomstable':
			require("view/t_roomstable.php");
			break;
		// case 'rooms':
		// 	require("view/t_rooms.php");
		// 	break;
		case 'payments':
			require("view/t_payments.php");
			break;
		case 'paymenthistory':
			require("view/t_paymenthistory.php");
			break;
		case 'requests':
			require("view/t_requests.php");
			break;
		case 'complaints':
			require("view/t_complaints.php");
			break;
		case 'tncs':
			require("view/t_tncs.php");
			break;
		case 'applicants':
			require("view/t_applicants.php");
			break;
		case 'bill_type':
			require("view/t_bill_type.php");
			break;
		case 'register':
			require("view/t_register.php");
			break;
		case 'logout':
			require("view/logout.php");
			break;
		default:
			require("view/t_error404.php");
			break;
	}
?>