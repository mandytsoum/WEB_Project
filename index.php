<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
  include_once 'header.php';
?>

<section class="index-intro">
	<?php
		if (isset($_SESSION["useruid"])) {
              echo "<p>Hello " . $_SESSION["useruid"] . "</p>";
            }
	?>
	<h1>This Is The WEB Project</h1>
	<p>Blah Blah</p>
	<p>Προφανώς όλα αυτά θα αλλάξουν.</p>
</section>

<section class="index-categories">
  <h2>Some Basic Categories</h2>
  <div class="index-categories-list">
    <div>
      <h3>Upload Δεδομένων</h3>
    </div>
    <div>
      <h3>Διαχείριση Προφίλ</h3>
    </div>
    <div>
      <h3>Οπτικοποίηση Δεδομένων</h3>
    </div>
   </div>
</section>

<?php
  include_once 'footer.php';
?>
