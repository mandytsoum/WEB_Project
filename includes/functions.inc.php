<?php

// Check for empty input signup
function emptyInputSignup($fname, $lname, $email, $username, $pwd, $pwdRepeat) {
	$result;
	if (empty($fname) || empty($lname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid username
function invalidUid($username) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

//Check if password is short
function shortPwd($pwd) {
	$result;
	$pwd = trim($_POST['pwd']);
	if ((strlen($pwd)) < 8){	//password needs to be at least 8 characters
		$result = true;
	}
	else {
		$result = false;
	}
}
//Check if password has at least one capital letter
function noCapPwd($pwd) {
	$result;
	if (!preg_match('/[A-Z]+/', $pwd)){ 	//password needs to contain at least one capital letter
		$result = true;
	}
	else {
		$result = false;
	}
}
//Check if password has at least one number digit
function noNumPwd($pwd) {
	$result;
	if (!preg_match('/[0-9]+/', $pwd)){	//password needs to contain at least one number
		$result = true;
	}
	else {
		$result = false;
	}
}
//Check if password has at least one other character
function noCharPwd($pwd) {
	$result;
	if (!preg_match('/[!@#\$%\^&\*]+/', $pwd)){	//password needs to contain at least one of the following: !, @, #, $, %, ^, &. *
		$result = true;
	}
	else {
		$result = false;
	}
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat) {
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username) {
	$sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {	//if there is an error in the statement
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {	//associative array
		return $row;	//multiple purposes
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $fname, $lname, $email, $username, $pwd) {
	$sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);	//connection to the database
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	
	//hashing the password
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $username, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../signup.php?error=none");	//no errors
	exit();
}

// Check for empty input login
function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);

	//error handler
	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	//check the hashed password
	$pwdHashed = $uidExists["password"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["user_number"];
		$_SESSION["useruid"] = $uidExists["username"];
		header("location: ../index.php?error=none");
		exit();
	}
}
