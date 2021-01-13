<?php

if (isset($_POST['submit'])) {

  // We grab the core file
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];
  // We could also have shortened this by writing:
  // $fileName = $file['name'];
  // Since we grabbed the core file at the start...


  // Here we get the file extension of the uploaded file
  $fileExt = explode('.', $fileName);	//explode the name of its extension
  $fileActualExt = strtolower(end($fileExt));	//string to lower case, second piece of data which is the extension

  // Here WE decide which file types we will allow
  $allowed = array('har', 'json');


  // Now we check if the file is an allowed file type
  if (in_array($fileActualExt, $allowed)) {	//if the extension is in the array
    // Here we check for upload errors
    if ($fileError === 0) {
      // Here we check for file size
      if ($fileSize < 1000000000) {
        // Here we create a new name for the file starting from 0
		$fileNewName = -1;
		for($i=0;$i<=20;$i++){
			if($fileNewName!==$i){
				$fileNameNew = $i . "." . $fileActualExt;
				break;
			}
		}
        // Here we create the path the file should get uploaded to
        $fileDestination = '../uploads/' . $fileNameNew;
        // Now we upload the file!
        move_uploaded_file($fileTmpName, $fileDestination);
        // And send the user back to the upload page
        header("Location: ../upload.php?upload=success");
      }
      else {
        echo "Your file is too big!";
      }
    }
    else {
      echo "There was an error uploading your file!";
    }
  }
  else {
    echo "You cannot upload files of this type!";
  }

}
