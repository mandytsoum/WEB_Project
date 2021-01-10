<?php
  include_once 'header.php';
?>

<section class="index-intro">
	<h1>This Is The WEB Project Team</h1>
	<p>Blah Blah</p>
	<p>Here we introduce ourselves.</p>
</section>

<section class="contact-form">
		<h2>Contact Us</h2>
		<div class="contact-form-form">
			<form action="includes/contact.inc.php" method="post">
				<input type="text" name="name" placeholder="Full Name...">
				<input type="text" name="email" placeholder="Email...">
				<input type="text" name="subject" placeholder="Subject...">
				<textarea name="message" placeholder="Type your message..."></textarea>
				<button type="submit" name="submit">Send Message</button>
			</form>
		</div>	
</section>


<?php
  include_once 'footer.php';
?>