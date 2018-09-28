<?php
	require("../connection/connection.php");

	if(isset($_POST['room_check_data'])){
		$room_id = $_POST['room_id_data'];
		$user_id = $_POST['user_id_data'];
		$query_check = "SELECT room_id FROM room_tbl WHERE room_id = :room_id";
		$stmt = $con->prepare($query_check);
		$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
		$stmt->execute();
		// $result = $stmt->fetch();
		$rowCount = $stmt->rowCount();
		if ($rowCount > 0){
			$query_check = "SELECT rental_id, room_id, status FROM rental_tbl WHERE room_id = :room_id AND status = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->execute();
			$results = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT rental_id status FROM rental_tbl WHERE room_id = :room_id AND user_id = :user_id AND status = 1";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$results = $stmt->fetch();
				$rowCount = $stmt->rowCount();

				if($rowCount > 0){
					$query = "SELECT concat(last_name, ', ', first_name, ' ', middle_name) AS name, DATE_FORMAT(birth_date, '%M %d, %Y') AS birth_date, (CASE WHEN gender = 1 THEN 'Male' WHEN gender = 0 THEN 'Female' END) AS gender, contact_no, email FROM user_tbl WHERE user_id = :user_id AND flag = 1";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
					$stmt->execute();
					$results = $stmt->fetch();
					$rowCount = $stmt->rowCount();

					$data = array("success" => "true", "status" => "my_room", "name" => $results['name'], "birth_date" => $results['birth_date'], "gender" => $results['gender'], "contact_no" => $results['contact_no'], "email" => $results['email']);
					$result = json_encode($data);
					echo $result;
				}
				else{
					$data = array("success" => "true", "status" => "occupied");
					$result = json_encode($data);
					echo $result;
				}
			}
			else{
				$query = "SELECT room_id, room_name, rent_rate, room_description, room_picture FROM room_tbl WHERE room_id = :room_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$room_results = $stmt->fetch();

				$data = array("success" => "true", "status" => "vacant", "room_id" => $room_results['room_id'], "room_name" => $room_results['room_name'], "rent_rate" => $room_results['rent_rate'], "room_description" => $room_results['room_description'], "room_picture" => $room_results['room_picture']);
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Room doesn't exist.");
			$results = json_encode($data);
			echo $results;
		}
	}
?>