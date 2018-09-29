<?php
	require("../connection/connection.php");

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
?>