<html>
<head>
<title>Download File from R&D Vault</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="Download.php" method="post" enctype="multipart/form-data">
         
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
			<input type="radio" name="type" value="relreport"> REL-XXXX<br>
			<!--<input type="radio" name="type" value="dependent"> Dependent File<br>
			<input type="radio" name="type" value="testreport"> Test Report<br> -->
		</label>
		</fieldset>
	</div>
</div>

<br>

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="three column">
						<label for="drawing_number">Drawing Number or DVRFxxxxx:</label>
			<input class="u-full-width" type="text" name="drawing_number" placeholder = "">
		</div>
	</div>
</div>

<br>


<!-- Dropdown menu pulled from database of names-->
<div class="container">		
	<div class="row">
		<div class="three columns">
				<?php	
				require_once('./mysqli_connect.php');
				$sql = "SELECT name FROM name ORDER BY name";
				$result = mysqli_query($dbc,$sql);
				?>
			<label for="entered_by">Entered by:</label>
			<select class="u-full-width" name='entered_by'>
				<option selected = "selected" value=""> </option>
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

<!-- Submit button-->
<div class="container">	
	
	<div class="row">
		<div class="three columns">
		<input class="button-success" type="submit" name="submit" value="Get latest drawing revision" />
		</div>
	</div>	

</div>

</form>
</body>
</html>

<?php
// Target folder
$target_dir = "d://docvault/"; //change to d://docvault/ for shared drive

	//If submit button is pushed
	if(isset($_POST['submit'])){
	
		//Define variables
		$errors= array();
		$regex = array("/^[A-Z]{2}-[0-9]{1,2}-[0-9]{4}$/" , "/^[A-Z]{2}-[0-9]{4}$/" , "/^DVRF[0-9]{5}$/" , "/^DVRF[0-9]{5}$/" , "/^[A-Z]{3}-[0-9]{4}$/");
		$name_text = array(" rev ", " rev ", " Datasheet rev ", " Test File rev " , " rev ");
		$file_ext = array("dwg" , "dwg" , "docx" , "xlsx" , "pdf");
		$rev = "?";

	 	//Set inputs equal to variables
		$drawing_number = trim($_POST['drawing_number']);
		$type = trim($_POST['type']);
		$entered_by = trim($_POST['entered_by']);

		
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
				$rev = (string)$lastRev;
			}
		//If not in database, give error
		} else {
			$errors[]="File is not in database.";
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

			case "relreport":
				$i=4;
				if (preg_match($regex[$i], $drawing_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}
				
			break;
		}
		
		//Set file name
		$file_name = $drawing_number . $name_text[$i] . $rev;		
		$download_file_with_path = $target_dir . $file_name . "." . $file_ext[$i];

	
		//Create MySQL insert statement for download database
		$sqlB = "INSERT INTO download (drawing_number,  rev, type, entered_by) 
		VALUES ('$drawing_number' , '$rev' , '$type', '$entered_by');";

		//If no errors then update to database and download file
		if(empty($errors)!==true){	

			//Show error messages
			echo "Error!";
			echo '<br>';
			foreach ($errors as $key=>$item){
				echo "$item <br>";
			}
			echo "Wait while we refresh page, you need to start again.....";
			echo '<meta http-equiv="refresh" content="10">';
			die();
		
		} else {
		
			//Insert to database then close
			mysqli_query($dbc,$sqlB);
			mysqli_close($dbc);

						
			//download target file
			header('Content-Description: File Transfer');
			header('Content-Type: ' . mime_content_type($download_file_with_path));
			header('Content-Disposition: inline; filename="'.basename($download_file_with_path).'"');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($download_file_with_path));
			ob_clean();
			flush();
			readfile($download_file_with_path);
			
			die();
	
		}
	}	
?>