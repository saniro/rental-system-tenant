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
?>