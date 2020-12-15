<?php

if (isset($_POST["submit"])) {	//the user accessed this page properly

  // First we get the form data from the URL
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputSignup($fname, $lname, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=emptyinput");
		exit(); 	//makes sure the script stops
  }
	// Proper username chosen
  if (invalidUid($uid) !== false) {
    header("location: ../signup.php?error=invaliduid");
		exit();
  }
  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: ../signup.php?error=invalidemail");
		exit();
  }
  // Proper password chosen
  if (shortPwd($pwd) !== false) {
    header("location: ../signup.php?error=shortpassword");
		exit();
  }
   if (noCapPwd($pwd) !== false) {
    header("location: ../signup.php?error=noCappassword");
		exit();
  }
   if (noNumPwd($pwd) !== false) {
    header("location: ../signup.php?error=noNumpassword");
		exit();
  }
   if (noCharPwd($pwd) !== false) {
    header("location: ../signup.php?error=noCharpassword");
		exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
		exit();
  }
  // Is the username taken already
  if (uidExists($conn, $username) !== false) {
    header("location: ../signup.php?error=usernametaken");
		exit();
  }


  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $fname, $lname, $email, $username, $pwd);

} 
else {
	header("location: ../signup.php");
    exit();
}
