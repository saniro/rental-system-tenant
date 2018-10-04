<?php
	require("../connection/connection.php");
	session_start();
	//t_rooms.php
	if(isset($_POST['room_transfer_request_data'])){
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
							$query = "SELECT room_name FROM room_tbl WHERE room_id = :old_room_id";
							$stmt = $con->prepare($query);
							$stmt->bindParam(':old_room_id', $old_room_id, PDO::PARAM_INT);
							$stmt->execute();
							$row = $stmt->fetch();

							$old_room_name = $row['room_name'];
							$data = array("success" => "true", "request" => "made", "old_room_name" => $old_room_name, "new_room_name" => $room_name);
							$output = json_encode($data);
							echo $output;
						}
					}
					else{
						$query = "INSERT INTO request_change_room_tbl (user_id, current_rental_id, requested_room, date_requested) VALUES (:user_id, :rental_id, :room_id, CURDATE())";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
						$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
						$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
						$stmt->execute();

						$data = array("success" => "true", "request" => "none", "message" => "A request of changing room to " . $room_name . " has been made.");
						$output = json_encode($data);
						echo $output;
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

	//t_rooms.php for termination request
	if(isset($_POST['room_terminate_request_data'])){
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
					$query = "INSERT INTO request_terminate_tbl (rental_id, date_requested) VALUES (:rental_id, CURDATE())";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
					$stmt->execute();

					$data = array("success" => "true", "message" => "Termination request sent.", "rental_id" => $rental_id);
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

	//t_complaints send complaint
	if(isset($_POST['complaint_send_data'])){
		$message = $_POST['message_data'];
		$user_id = $_SESSION['user_id'];
		if($message != NULL){
			$query = "INSERT INTO complaint_tbl (user_id, message, message_date) VALUES (:user_id, :message, CURDATE())";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':message', $message, PDO::PARAM_STR);
			$stmt->execute();
			$lastInsertedID = $con->lastInsertId();

			$query = "SELECT complaint_id, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, message, (CASE WHEN status = 1 THEN 'Not yet read' WHEN status = 2 THEN 'Read' END) AS status FROM complaint_tbl WHERE complaint_id = :last_inserted_id";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':last_inserted_id', $lastInsertedID, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$data = array("success" => "true", "message" => "Your complaint has been sent.", "complaint_id" => $lastInsertedID, "message_date" => $row['message_date'], "message_send" => $row['message'], "status" => $row['status'], "buttons" => '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnView" data-id="'.$lastInsertedID.'"><span class="fa fa-file-text-o"></span></button> <button data-toggle="tooltip" title="Cancel Complaint" class="btn btn-danger" id="btnCancel" data-id="'.$lastInsertedID.'"><span class="glyphicon glyphicon-remove"></span></button></center>');
			$results = json_encode($data);
			echo $results;
		}
		else{
			$data = array("success" => "false", "message" => "Message must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}
?>