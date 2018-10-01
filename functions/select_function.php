<?php
	require("../connection/connection.php");
	session_start();
	//t_rooms.php for termination request
	if(isset($_POST['room_confirm_terminate_request_data'])){
		$room_id = $_POST['room_id_data'];
		$user_id = $_POST['user_id_data'];

		if(($room_id != NULL) OR ($user_id != NULL)){
			$query_check = "SELECT rental_id FROM rental_tbl WHERE user_id = :user_id AND room_id = :room_id AND status = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$rental_id = $row['rental_id'];
				$query_check = "SELECT request_terminate_id FROM request_terminate_tbl WHERE rental_id = :rental_id AND status = 2";
				$stmt = $con->prepare($query_check);
				$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
				$stmt->execute();
				$rowCount = $stmt->rowCount();
				if($rowCount > 0){
					$data = array("success" => "false", "message" => "You have already made a request for termination. Please wait for further announcement.");
					$results = json_encode($data);
					echo $results;
				}
				else{
					$data = array("success" => "true", "rental_id" => $rental_id, "user_id" => $user_id);
					$results = json_encode($data);
					echo $results;
				}
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//t_rooms.php for view termination request
	if(isset($_POST['room_view_terminate_request_data'])){
		$rental_id = $_POST['rental_id_view_data'];
		$user_id = $_SESSION['user_id'];

		if(($rental_id != NULL) OR ($user_id != NULL)){
			$query_check = "SELECT request_terminate_id FROM request_terminate_tbl AS RE WHERE rental_id = :rental_id AND (SELECT user_id FROM rental_tbl AS RL WHERE RL.rental_id = RE.rental_id) = :user_id AND status = 2";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$request_terminate_id = $row['request_terminate_id'];
				$query = "SELECT DATE_FORMAT(date_requested, '%M %d, %Y') AS date_requested FROM request_terminate_tbl WHERE request_terminate_id = :request_terminate_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':request_terminate_id', $request_terminate_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "date_requested" => $row['date_requested']);
				$results = json_encode($data);
				echo $results;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//t_rooms.php for view change room request
	if(isset($_POST['room_view_change_room_request_data'])){
		$rental_id = $_POST['rental_id_data'];
		$user_id = $_SESSION['user_id'];

		if(($rental_id != NULL) OR ($user_id != NULL)){
			$query_check = "SELECT request_id FROM request_change_room_tbl AS REM WHERE current_rental_id = :rental_id AND (SELECT user_id FROM rental_tbl AS RL WHERE RL.rental_id = REM.current_rental_id) = :user_id AND status = 2";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$request_id = $row['request_id'];
				$query = "SELECT DATE_FORMAT(date_requested, '%M %d, %Y') AS date_requested, (SELECT room_name FROM room_tbl AS RM WHERE RM.room_id = REM.requested_room) AS requested_room, (SELECT room_name FROM room_tbl WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.rental_id = REM.current_rental_id)) AS current_room FROM request_change_room_tbl AS REM WHERE request_id = :request_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "date_requested" => $row['date_requested'], "requested_room" => $row['requested_room'], "current_room" => $row['current_room']);
				$results = json_encode($data);
				echo $results;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//t_complaints.php view complaint cancellation
	if(isset($_POST['view_complaint_data'])){
		$complaint_id = $_POST['complaint_id_data'];
		$user_id = $_SESSION['user_id'];

		if(($complaint_id != NULL) OR ($user_id != NULL)){
			$query_check = "SELECT complaint_id FROM complaint_tbl WHERE complaint_id = :complaint_id AND user_id = :user_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT complaint_id, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, message FROM complaint_tbl AS REM WHERE complaint_id = :complaint_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "complaint_id" => $row['complaint_id'], "message_date" => $row['message_date'], "message" => $row['message']);
				$results = json_encode($data);
				echo $results;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//t_complaints.php view complaint cancellation
	if(isset($_POST['view_complaint_details_data'])){
		$complaint_id = $_POST['complaint_id_data'];
		$user_id = $_SESSION['user_id'];

		if(($complaint_id != NULL) OR ($user_id != NULL)){
			$query_check = "SELECT complaint_id FROM complaint_tbl WHERE complaint_id = :complaint_id AND user_id = :user_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT complaint_id, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, message, (CASE WHEN status = 1 THEN 'Not yet read' WHEN status = 2 THEN 'Read' END) AS status, response, DATE_FORMAT(response_date, '%M %d, %Y') AS response_date FROM complaint_tbl AS REM WHERE complaint_id = :complaint_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "complaint_id" => $row['complaint_id'], "message_date" => $row['message_date'], "message" => $row['message'], "status" => $row['status'], "response" => $row['response'], "response_date" => $row['response_date']);
				$results = json_encode($data);
				echo $results;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}
?>