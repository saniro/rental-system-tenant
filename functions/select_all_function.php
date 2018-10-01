<?php
	function user_profile($user_id){
		require("./connection/connection.php");
		$query = "SELECT email, last_name, first_name, middle_name, birth_date, gender, contact_no, profile_picture FROM user_tbl WHERE user_id = :user_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetch();
		//$results = array("email" => $row['email'], "last_name" => $row['last_name'], "first_name" => $row['middle_name'], "birth_date" => $row['birth_date'], "gender" => $row['gender'], "contact_no" => $row['contact_no'], "profile_picture" => $row['profile_picture']);
		$results = json_encode($results);
		return $results;
	}

	function room_check($room_id, $user_id){
		require("./connection/connection.php");
		$query = "SELECT rental_id FROM rental_tbl WHERE room_id = :room_id AND status = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
		$stmt->execute();
		//$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		if($rowCount > 0){
			$query = "SELECT rental_id FROM rental_tbl WHERE room_id = :room_id AND user_id = :user_id";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$results = array("status" => "occupied", "who" => "mine");
				$results = json_encode($results);
				return $results;
			}
			else{
				$results = array("status" => "occupied", "who" => "someone");
				$results = json_encode($results);
				return $results;
			}
		}
		else{
			$results = array("status" => "vacant");
			$results = json_encode($results);
			return $results;
		}
		//return $rowCount;
	}

	function complaint_list(){
		require("./connection/connection.php");
		$query = "SELECT complaint_id, message, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, (CASE WHEN status = 1 THEN 'Not yet read' WHEN status = 2 THEN 'Read' END) AS status FROM complaint_tbl WHERE user_id = 2 AND flag = 1";
		$stmt = $con->prepare($query);
		//$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$results = json_encode($results);
		return $results;
	}

	//t_rooms.php
	function check_termination(){
		require("./connection/connection.php");
		$user_id = $_SESSION['user_id'];
		$query = "SELECT rental_id FROM rental_tbl WHERE user_id = :user_id AND status = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$rowCount = $stmt->rowCount();
		if($rowCount > 0){
			$rental_id = $row['rental_id'];
			$query = "SELECT request_terminate_id FROM request_terminate_tbl WHERE rental_id = :rental_id AND status = 2";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$data = array("success" => "true", "status" => "okay", "message" => "", "rental_id" => $rental_id);
				$results = json_encode($data);
				return $results;
			}
			else{
				$data = array("success" => "true", "status" => "not", "message" => "disabled");
				$results = json_encode($data);
				return $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
			$results = json_encode($data);
			return $results;
		}
	}

	//t_rooms.php
	function check_change_room(){
		require("./connection/connection.php");
		$user_id = $_SESSION['user_id'];
		$query = "SELECT rental_id FROM rental_tbl WHERE user_id = :user_id AND status = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		$rowCount = $stmt->rowCount();
		if($rowCount > 0){
			$rental_id = $row['rental_id'];
			$query = "SELECT request_id FROM request_change_room_tbl WHERE current_rental_id = :rental_id AND status = 2";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$data = array("success" => "true", "status" => "okay", "message" => "", "rental_id" => $rental_id);
				$results = json_encode($data);
				return $results;
			}
			else{
				$data = array("success" => "true", "status" => "not", "message" => "disabled");
				$results = json_encode($data);
				return $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
			$results = json_encode($data);
			return $results;
		}
	}
?>