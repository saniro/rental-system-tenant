<?php
	require("../connection/connection.php");

	//t_rooms.php
	if(isset($_POST['room_new_transfer_request_data'])){
		$room_id = $_POST['room_id_data'];
		$user_id = $_POST['user_id_data'];

		if(($room_id != NULL) && ($user_id != NULL)){
			$query_check = "SELECT room_id, room_name FROM room_tbl WHERE room_id = :room_id";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$room_name = $row['room_name'];
				$query_check = "SELECT rental_id FROM rental_tbl WHERE user_id = :user_id AND status = 1";
				$stmt = $con->prepare($query_check);
				$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				$rowCount = $stmt->rowCount();
				if($rowCount > 0){
					$rental_id = $row['rental_id'];
					$query_check = "SELECT request_id, requested_room FROM request_change_room_tbl WHERE user_id = :user_id AND current_rental_id = :rental_id AND status = 2";
					$stmt = $con->prepare($query_check);
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
					$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
					$stmt->execute();
					$row = $stmt->fetch();
					$rowCount = $stmt->rowCount();
					if($rowCount > 0){
						$old_room_id = $row['requested_room'];
						if($old_room_id == $room_id){
							$data = array("success" => "false", "message" => "You have already made a request to transfer in this room.");
							$output = json_encode($data);
							echo $output;
						}
						else{
							$query_update = "UPDATE request_change_room_tbl
											SET status = 3
											WHERE user_id = :user_id AND current_rental_id = :rental_id AND status = 2";
							$stmt = $con->prepare($query_update);
							$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
							$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
							$stmt->execute();

							$query = "INSERT INTO request_change_room_tbl (user_id, current_rental_id, requested_room, date_requested) VALUES (:user_id, :rental_id, :room_id, CURDATE())";
							$stmt = $con->prepare($query);
							$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
							$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
							$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
							$stmt->execute();

							$data = array("success" => "true", "request" => "made", "message" => "A request of changing room to " . $room_name . " has been made.");
							$output = json_encode($data);
							echo $output;
						}
					}
				}
				else{
					$data = array("success" => "false", "message" => "Rental doesn't exist.");
					$output = json_encode($data);
					echo $output;
				}
			}
			else{
				$data = array("success" => "false", "message" => "Room doesn't exist.");
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$output = json_encode($data);
			echo $output;
		}
	}


	if(isset($_POST['tenant_delete_data'])){
		$user_id = $_POST['tenant_id_data'];
		$query = "UPDATE user_tbl 
					SET flag = 0 
					WHERE user_id = :user_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		
		$data = array("success" => "true", "message" => "Account has been deactivated.");
		$output = json_encode($data);
		echo $output;
	}
?>