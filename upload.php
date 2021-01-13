<?php
  include_once 'header.php';
?>

	<section class="upload-form">
		<h2>Upload HAR Files</h2>
		<div class="upload-form-form">
			<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
				<input type="file" name="file">
				<button type="submit" name="submit">UPLOAD</button>
			</form>
		</div>	
		<br>
	</section>
	

<?php
  include_once 'footer.php';
?>