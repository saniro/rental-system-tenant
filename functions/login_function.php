<?php
	session_start();
	require("../connection/connection.php");
	if(isset($_POST['login_data'])){
		$email = $_POST['email_data'];
		$password = $_POST['password_data'];

		if(($email != NULL) || ($password != NULL)){
			$query = "SELECT user_id, email, password, profile_picture, first_name FROM user_tbl WHERE email = :email AND password = :password AND user_type = 0 AND flag = 1";
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
				$_SESSION["user_id"] = $row['user_id'];
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