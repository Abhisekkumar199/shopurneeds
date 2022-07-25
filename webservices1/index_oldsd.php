<?php
if (isset($_GET['tag']) && $_GET['tag'] != '') {
	$tag = $_GET['tag'];
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$response = array("tag" => $tag, "success" => 0, "error" => 0);
	if ($tag == 'login') {
		$email = $_GET['email'];
		$password = $_GET['password'];
		$user = $db->getUserByEmailAndPassword($email, $password);
		if ($user != false) {
			$response["success"] = 1;
			$response["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["billing_mobile"];
				$response["user"]["created_at"] = $user["adddate"];
			echo json_encode($response);
		} else {
			$response["error"] = 1;
			$response["error_msg"] = "Incorrect email or password!";
			echo json_encode($response);
		}
	} else if ($tag == 'register') {
		$fname = $_GET['first_name'];
				$lname = $_GET['last_name'];
		$email = $_GET['email'];
		$password = $_GET['password'];
		$mobile = $_GET['mobile_no'];

		if ($db->isUserExisted($email)) {
			$response["error"] = 2;
			$response["error_msg"] = "User already existed";
			echo json_encode($response);
		} else {
			$user = $db->storeUser($fname,$lname,$mobile, $email, $password);
			if ($user) {
				$response["success"] = 1;
				$response["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["billing_mobile"];
				$response["user"]["created_at"] = $user["adddate"];
				echo json_encode($response);
			} else {
				$response["error"] = 1;
				$response["error_msg"] = "Error occurred in Registration";
				echo json_encode($response);
			}
		}
	} else {
		echo "Invalid Request";
	}
} else {
	echo "Access Denied Deepak";
}
?>