<?php
	session_start();
	require("../connection/connection.php");
	if(isset($_POST['login_data'])){
		$email = $_POST['email_data'];
		$password = $_POST['password_data'];

		if(($email != NULL) || ($password != NULL)){
			$query = "SELECT user_id, email, password, profile_picture, first_name, (SELECT room_id FROM rental_tbl AS RL WHERE RL.user_id = UR.user_id AND status = 1) AS room_id, (SELECT rental_id FROM rental_tbl AS RL WHERE RL.user_id = UR.user_id AND status = 1) AS rental_id, (SELECT apartment_id FROM room_tbl WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.user_id = UR.user_id AND status = 1)) AS apartment_id FROM user_tbl AS UR WHERE email = :email AND password = :password AND user_type = 0 AND flag = 1";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();

			if($rowCount == 0){
				$data = array("success" => "false", "message" => "Wrong email or password.");
				$output = json_encode($data);
				echo $output;
			}
			else{
				$_SESSION["user_apartment_id"] = $row['apartment_id'];
				$_SESSION["rental_id"] = $row['rental_id'];
				$_SESSION["room_id"] = $row['room_id'];
				$_SESSION["user_id"] = $row['user_id'];

				$query = "SELECT apartment_name FROM apartment_tbl WHERE apartment_id = :apartment_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':apartment_id', $_SESSION["user_apartment_id"], PDO::PARAM_INT);
				$stmt->execute();
				$rowApartment = $stmt->fetch();

				$_SESSION["apartment_name"] = $rowApartment['apartment_name'];
				
				$data = array("success" => "true", "first_name" => $row['first_name']);
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Email or Password cannot be null.");
			$output = json_encode($data);
			echo $output;
		}
	}
?>