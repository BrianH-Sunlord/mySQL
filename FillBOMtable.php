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
				<input class="u-full-width" type="text" name="dvrf_number" value = "DVRFxxxxx">
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
			<input class="u-full-width" type="text" name="qty" placeholder = "">
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
				echo '<meta http-equiv="refresh" content="4">';
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
	}

?>
