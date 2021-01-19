<html>
<head>
<title>Upload Test Report to R&D Vault</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="UploadTestReport.php" method="post" enctype="multipart/form-data">
         
<br>

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="four column">
			<label for="drawing_number">Enter DVRFxxxxx Number:</label>
			<input class="u-full-width" type="text" name="drawing_number" placeholder = "">
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
		<input class="button-success" type="submit" name="submit" value="   Add This Test Report to R&D Vault   " />
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
      $file_tmp =$_FILES['file_to_upload']['tmp_name'];
	  $target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
      $file_ext=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    }
	
	
	//When Add Drawing button is pushed
	if(isset($_POST['submit'])){
		
		//Define variables
		$errors= array();
		$regex = "/^DVRF[0-9]{5}$/" ;
		$extensions= array("xlsx");
		$date = date('Y-M-d');
		
		//Set inputs equal to variables
		$drawing_number = trim($_POST['drawing_number']);
		$entered_by = trim($_POST['entered_by']);
		
		//If file is incorrect file type or else no file chosen
		if(in_array($file_ext,$extensions)=== false){
			$errors[]="No file chosen or else file type is not allowed.";
		}
		
		//If drawing_number is incorrect format
		if (preg_match($regex, $drawing_number)==FALSE) {
					$errors[]="Part number is in incorrect format.";
				}
		
		//Set file name
		$file_name = $drawing_number . " Test Report " . $date;
		

		//Set complete file name with ext and dir
		$file_name_with_dir = $target_dir . $file_name . "." . $file_ext;
		
		
		//Create MySQL insert statement for test_report database
		$sql = "INSERT INTO test_report (drawing_number,  entered_by) 
		VALUES ('$drawing_number','$entered_by');";
		
		
		//If no errors then update to database and upload file
		if(empty($errors)==true){
			
			//Insert to database then close
			require_once('./mysqli_connect.php');
			mysqli_query($dbc,$sql);
			mysqli_close($dbc);
		
			
			//Upload file from temp storage to target directory			
			move_uploaded_file($file_tmp,$file_name_with_dir);
			echo "File uploaded successfully...refreshing...";
			echo '<meta http-equiv="refresh" content="2">';
		
		}else{
			echo "Error!";
			echo '<br>';
			foreach ($errors as $key=>$item){
				echo "$item <br>";
			}
			echo "Wait while we refresh page, you need to start again.....";
			echo '<meta http-equiv="refresh" content="10">';
		}		

		
	}			


?>
