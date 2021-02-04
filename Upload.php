<html>
<head>
<title>Upload File to R&D Vault</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="Upload.php" method="post" enctype="multipart/form-data">
         
<br>

<!-- Container for inputing data-->
<div class="container">	
	<div class="four columns">
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Select type:</b></span><br>
			<input type="radio" name="type" value="long" checked> AA-BB-XXXX<br>
			<input type="radio" name="type" value="short"> AA-XXXX<br>
			<input type="radio" name="type" value="datasheet"> Datasheet<br>
			<input type="radio" name="type" value="testfile"> Test File<br>
		</label>
		</fieldset>
	</div>
</div>

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="two column">
						<label for="drawing_number">Drawing Number or DVRFxxxxx:</label>
			<input class="u-full-width" type="text" name="drawing_number" placeholder = "">
		</div>

		<div class="two column">
			  <label for="rev">Revision:</label>
			  <br>
			  <input class="u-full-width" type="text" name="rev" placeholder = "letters only">
		</div>
	</div>
	

</div>

<br>


<!-- Dropdown menu pulled from database of names-->
<div class="container">		
	<div class="row">
		<div class="four columns">
				<?php	
				require_once('./mysqli_connect.php');
				$sql = "SELECT name FROM name ORDER BY name";
				$result = mysqli_query($dbc,$sql);
				?>
			<label for="entered_by">Entered by:</label>
			<select class="u-full-width" name='entered_by'>
				<?php
				while ($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
				}
				?>
			</select>
		</div>
	</div>
</div>		

<br>

<div class="container">	
	<div class="row">
		<div class="six columns">
		<input class="button-success" type="file" name="file_to_upload" value="Choose File"/>
		</div>
	</div>		
</div>

<br>

<!-- Submit button-->
<div class="container">	
		
	<div class="row">
		<div class="six columns">
		<input class="button-success" type="submit" name="submit" value="   Add This Drawing to R&D Vault   " />
		</div>
	</div>	

</div>

</form>
</body>
</html>

<?php
//Target path
$target_dir = "d://docvault/";  //change to d://docvault/ for shared drive

	// When selecting Upload file
	if(isset($_FILES['file_to_upload'])){
      $original_file_name = $_FILES['file_to_upload']['name'];
      //$file_size =$_FILES['file_to_upload']['size'];
      $file_tmp =$_FILES['file_to_upload']['tmp_name'];
      //$file_type=$_FILES['file_to_upload']['type'];
	  $target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
      $file_ext=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    }
	
	
	//When Add Drawing button is pushed
	if(isset($_POST['submit'])){
		
		//Define variables
		$errors= array();
		$rev_regex = "/^[A-Z]{1}$/";
		$regex = array("/^[A-Z]{2}-[0-9]{1,2}-[0-9]{4}$/" , "/^[A-Z]{2}-[0-9]{4}$/" , "/^DVRF[0-9]{5}$/" , "/^DVRF[0-9]{5}$/");
		$name_text = array(" rev ", " rev ", " Datasheet rev ", " Test File rev ");
		$extensions= array("dwg","docx","xlsx");
		
		//Set inputs equal to variables
		$drawing_number = trim($_POST['drawing_number']);
		$rev = trim($_POST['rev']);
		$entered_by = trim($_POST['entered_by']);
		$type = trim($_POST['type']);
		
		//If file is incorrect file type or else no file chosen
		if(in_array($file_ext,$extensions)=== false){
			$errors[]="No file chosen or else file type is not allowed.";
		}
		
		//If revision not inputted or is not a single letter
		if (preg_match($rev_regex, $rev)==FALSE) {
			$errors[]="Revision needs to be a single CAPITAL letter.";
		}
		

		//Switch Case statement to select by type
		switch ($type) {
			case "long":
				$i=0;
				if (preg_match($regex[$i], $drawing_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}
			break;
		
			case "short":
				$i=1;
				if (preg_match($regex[$i], $drawing_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}			
			break;
			
			case "datasheet":
				$i=2;
				if (preg_match($regex[$i], $drawing_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}			
			break;
			
			case "testfile":
				$i=3;
				if (preg_match($regex[$i], $drawing_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}			
			break;
		}
		
		//Set file name
		$file_name = $drawing_number . $name_text[$i] . $rev;
		

		//Set complete file name with ext and dir
		$file_name_with_dir = $target_dir . $file_name . "." . $file_ext;
		
		
		//Checks if drawing number+type is already in database
		$sql = "SELECT EXISTS(SELECT * FROM drawing_number WHERE drawing_number.drawing_number = '" . $drawing_number . "' AND drawing_number.type = '" . $type . "');";
		require_once('./mysqli_connect.php');
		$result = mysqli_query($dbc,$sql);
		$status = $result->fetch_array()[0] ?? '';
		
		//If in database, get latest revision
		if ($status == 1) {

			// Gets all revisions of drawing from drawing-number database
			$sqlA = "SELECT rev FROM drawing_number WHERE drawing_number= '" . $drawing_number . "' AND type= '" . $type . "'GROUP BY rev;";
			require_once('./mysqli_connect.php');
			$resultA = mysqli_query($dbc,$sqlA);
			
			//Selects latest revision
			while ($row = mysqli_fetch_array($resultA)) {
				$lastRev = $row['rev'];
				$old_rev = (string)$lastRev;
			}
		//If not in database, set old revision to <A
		} else {
			$old_rev = "?";
		}		
		
		//Error if old rev and new rev match
		if (ord($old_rev) == ord($rev)) {
			$errors[]="This revision is already in database";
			} 

		//Error if old rev higher than new rev
		if (ord($old_rev) > ord($rev)) {
			$errors[]="There is a later revision in the database";
			} 			
	
		
		
		//Create MySQL insert statement for upload database
		$sql1 = "INSERT INTO upload (drawing_number,  rev, type, entered_by) 
		VALUES ('$drawing_number','$rev' , '$type', '$entered_by');";
		
		//Create MySQL insert statement for drawing_number database
		$sql2 = "INSERT INTO drawing_number (drawing_number,  rev, type, entered_by) 
		VALUES ('$drawing_number','$rev' , '$type', '$entered_by');";
		
		
		//If no errors then update to database and upload file
		if(empty($errors)==true){
			
			//Insert to database then close
			require_once('./mysqli_connect.php');
			mysqli_query($dbc,$sql1);
			mysqli_query($dbc,$sql2);
			mysqli_close($dbc);
		
			
			//Upload file from temp storage to target directory			
			move_uploaded_file($file_tmp,$file_name_with_dir);
			echo "<h1>File uploaded successfully!...refreshing...</h1>";
			echo '<meta http-equiv="refresh" content="10">';
		
		}else{
			echo '<h1>Error!</h1>';
			foreach ($errors as $key=>$item){
				echo "$item <br>";
			}
			echo '<h3>Wait while we refresh page, you need to start again.....</h3>';
			echo '<meta http-equiv="refresh" content="10">';
		}		

		
	}			


?>
