<?php
	require("../connection/connection.php");
	session_start();

	//t_rooms.php for termination request
	if(isset($_POST['room_cancel_terminate_request_data'])){
		$rental_id = $_POST['rental_id_data'];
		$user_id = $_SESSION['user_id'];
		if($rental_id != NULL){
			$query_check = "SELECT request_terminate_id FROM request_terminate_tbl AS RE WHERE rental_id = :rental_id AND (SELECT user_id FROM rental_tbl AS RL WHERE RL.rental_id = RE.rental_id) = :user_id AND status = 2";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$request_terminate_id = $row['request_terminate_id'];
				$query_update = "UPDATE request_terminate_tbl
								SET status = 3
								WHERE request_terminate_id = :request_terminate_id AND status = 2";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':request_terminate_id', $request_terminate_id, PDO::PARAM_INT);
				$stmt->execute();

				$data = array("success" => "true", "message" => "Termination cancelled.");
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