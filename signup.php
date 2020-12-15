<?php
  include_once 'header.php';
?>

	<section class="signup-form">
		<h2>Sign Up</h2>
		<div class="signup-form-form">
			<form action="includes/signup.inc.php" method="post">
				<input type="text" name="fname" placeholder="First Name...">
				<input type="text" name="lname" placeholder="Last Name...">
				<input type="text" name="email" placeholder="Email...">
				<input type="text" name="uid" placeholder="Username...">
				<input type="password" name="pwd" placeholder="Password...">
				<input type="password" name="pwdrepeat" placeholder="Repeat Password...">
				<button type="submit" name="submit">Sign Up</button>

			</form>
		</div>	
		<br>
		
		<?php
		//Error Messages
		if(isset($_GET["error"])) {
			if($_GET["error"] == "emptyinput") {
				echo "<p>Fill in all fields!</p>";
			}
			else if ($_GET["error"] == "invaliduid") {
				echo "<p>Choose a proper username!</p>";
			}
			else if ($_GET["error"] == "invalidemail") {
				echo "<p>Choose a proper email!</p>";
			}
			else if ($_GET["error"] == "shortpassword") {
				echo "<p>Password should be at least 8 characters long!</p>";
			}
			else if ($_GET["error"] == "noCappassword") {
				echo "<p>Password should contain at least one capital leter!</p>";
			}
			else if ($_GET["error"] == "noNumpassword") {
				echo "<p>Password should contain at least one number digit!</p>";
			}
			else if ($_GET["error"] == "noCharpassword") {
				echo "<p>Password should contain at least one of the following characters: !, @, #, $, %, ^, &, *.</p>";
			}
			
			else if ($_GET["error"] == "passwordsdontmatch") {
				echo "<p>The two passwords don't match!</p>";
			}
			else if ($_GET["error"] == "stmtfailed") {
				echo "<p>Something went wrong, please try again!</p>";
			}
			else if ($_GET["error"] == "usernametaken") {
				echo "<p>This username already exists!</p>";
			}
			else if ($_GET["error"] == "none") {
				echo "<p>You have signed up!</p>";
			}
		}
		?>
	</section>
	


<?php
  include_once 'footer.php';
?>
