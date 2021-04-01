<html>
<head>
<title>Fill Bill of Materials Table</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="FillBOMtable.php" method="post">




<!-- Container for inputing data-->
		<div class="container">
				<div class="six column">
					<label for="dvrf_number">DVRF Number:</label>
				<input class="u-full-width" type="text" name="dvrf_number" placeholder = "DVRFxxxxx">
				</div>
		</div>'		
		
<!-- Container for inputing data-->
<div class="container">
		<div class="three column">
						<label for="part_number">Part Number:</label>
			<input class="u-full-width" type="text" name="part_number" placeholder = "">
		</div>
		
		<div class="one column">
						<label for="qty">Qty:</label>
			<input class="u-full-width" type="text" name="qty" value = 1>
		</div>

		<div class="two column">
			<!-- Input data using radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Type:</b></span><br>
					<input type="radio" name="type" value="long" checked> AA-xx-xxxx<br>
					<input type="radio" name="type" value="short"> AA-xxxx<br>
					<input type="radio" name="type" value="testfile"> Test File<br>
				</label>
			</fieldset>
		</div>

</div>

<br>

<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="six columns">
		<input class="button-success" type="submit" name="submit" value="Add to Bill of Materials" />
		</div>
	</div>	
</div>

</form>
</body>
</html>

<?php
	
	//If submit button is pushed
	if(isset($_POST['submit'])){
		
		//Set inputs equal to variables
		$type = trim($_POST['type']);
		$part_number = trim($_POST['part_number']);
		$qty = trim($_POST['qty']);
		$dvrf_number = trim($_POST['dvrf_number']);
		
		// Set up error and regex arrays
		$errors= array();
		$regex = array("/^[A-Z]{2}-[0-9]{1,2}-[0-9]{4}$/" , "/^[A-Z]{2}-[0-9]{4}$/" , "/^DVRF[0-9]{5}$/");
		
		//Check DVRF number is in correct format
		if(preg_match($regex[2], $dvrf_number)==FALSE){
			$errors[]="DVRF part number not in correct format.";
		}
		
		
		//Switch Case statement to select by type
		switch ($type) {
			case "long":
				$i=0;
				if (preg_match($regex[$i], $part_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}
			break;
		
			case "short":
				$i=1;
				if (preg_match($regex[$i], $part_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}			
			break;
			
			case "testfile":
				$i=2;
				if (preg_match($regex[$i], $part_number)==FALSE) {
					$errors[]="Part number format does not match Type selected.";
				}		
		}
	
		//If no errors then update to database and upload file
		if(empty($errors)==true){
	
		//Create MySQL insert statement
		$sql = "INSERT INTO bom_table (dvrf_number, part_number, type, qty) 
		VALUES ('$dvrf_number', '$part_number','$type','$qty');";
	
		//Insert to database then close
		require_once('./mysqli_connect.php');
		$result = mysqli_query($dbc,$sql);
		//mysqli_close($dbc);;

		//Confirm new record inserted 
        if ($sql) {
				echo "Added to BOM successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="2">';
		} else {
				echo "Error: ";
				}
		
		//header('Location: AddNewPartNumberCoverPage.php');

		//Query SQL database 
		$sql = "SELECT part_number, type, qty FROM bom_table WHERE dvrf_number = '" . $dvrf_number . "' ORDER BY id ASC";
		
		//Pull from table database
		require_once('./mysqli_connect.php');
		$result = mysqli_query($dbc,$sql);
		mysqli_close($dbc);
		
		//Display dvrf number
		echo '<h3>' . $dvrf_number . '</h3>';
		
		
		//Create table		
			echo '<table><tr>';
			echo '<th>Part Number</th>';
			echo '<th>Type</th>';
			echo '<th>Qty</th></tr>';
			
			while($row = mysqli_fetch_array($result)){
				$part_number = $row['part_number'];
				$type = $row['type'];
				$qty = $row['qty'];
				
		
				echo '<tr> 
					 <td>' .$part_number. '</td>
					 <td>' .$type. '</td>
					 <td>' .$qty. '</td>
					 </tr>';
			}
				
			echo '</table><br>';
			
		}else{
			echo "<h3>Error!</h3>";
			echo '<br>';
			foreach ($errors as $key=>$item){
				echo "$item <br>";
			}
			echo "<h3>Wait while we refresh page, you need to start again.....</h3>";
			echo '<meta http-equiv="refresh" content="10">';	
		}		
	}

?>
