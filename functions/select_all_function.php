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

	function all_tenants(){
		require("./connection/connection.php");
		$query = "SELECT user_id, concat(last_name,  ', ', first_name, ' ', middle_name) AS name, email, contact_no, (SELECT room_name FROM room_tbl WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.user_id = UR.user_id)) AS room_name FROM user_tbl AS UR WHERE user_type = 0 AND flag = 1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		$results = json_encode($results);
		return $results;
	}

	function all_payments(){
		require("./connection/connection.php");
		$query = "SELECT m_rent_id, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = (SELECT user_id FROM rental_tbl AS RL WHERE RL.rental_id = MT.rental_id)) AS user_name, (SELECT contact_no FROM user_tbl AS UR WHERE UR.user_id = (SELECT user_id FROM rental_tbl AS RL WHERE RL.rental_id = MT.rental_id)) AS contact_no, (SELECT room_name FROM room_tbl AS RM WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.rental_id = MT.rental_id)) AS room_name, payables, due_date FROM monthly_rent_tbl AS MT";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		$results = json_encode($results);
		return $results;
	}
?>