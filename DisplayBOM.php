<html>
<head>
<title>Display Bill of Materials</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  
</head>


<body>

<?php

	//get variable from previous page
	session_start();
?>
<!-- Assign this php file to perform action on form-->
<form action="DisplayBOM.php" method="post">

<h3>Display Bill of Materials</h3>

<br>

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="four column">
						<label for="dvrf_number">DVRFxxxxx:</label>
			<input class="u-full-width" type="text" name="dvrf_number" placeholder = "DVRFxxxxx">
		</div>
	</div>
</div>

<br>

<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="four columns">
		<input class="button-success" type="submit" name="submit" value="Display BOM" />
		</div>
	</div>	
</div>

<?php

	//If submit button is pushed
	if(isset($_POST['submit'])){
		
		//Set inputs equal to variables
		$dvrf_number = trim($_POST['dvrf_number']);
		
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
