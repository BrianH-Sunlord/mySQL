<html>
<head>
<title>Bill of Materials: Where Used</title>

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
<form action="BOMwhereused.php" method="post">

<h3>Bill of Materials: Where Used</h3>

<br>

<!-- Container for inputing data-->
<div class="container">
		<div class="three column">
						<label for="part_number">Part Number:</label>
			<input class="u-full-width" type="text" name="part_number" placeholder = "">
		</div>
		

		<div class="three column">
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
		<div class="four columns">
		<input class="button-success" type="submit" name="submit" value="Display BOM" />
		</div>
	</div>	
</div>


<?php

	//If submit button is pushed
	if(isset($_POST['submit'])){
		
		//Set inputs equal to variables
		$part_number = trim($_POST['part_number']);
		$type = trim($_POST['type']);		
		
		//Query SQL database 
		$sql = "SELECT dvrf_number FROM bom_table WHERE part_number = '" . $part_number . "' AND  type = '" . $type . "' ORDER BY dvrf_number ASC";
		
		//Add to bom_hit_counter to keep record of how often it is used
		$sqlB = "INSERT INTO bom_hit_counter (part_number) VALUES ('$part_number');";
		
		//Pull from table database
		require_once('./mysqli_connect.php');
		$result = mysqli_query($dbc,$sql);
		$resultB = mysqli_query($dbc,$sqlB);
		mysqli_close($dbc);
		
		//Display dvrf number
		echo '<h3>' . $part_number . ' Used In:</h3>';
		
		
		//Create table		
			echo '<table><tr>';
			//echo '<th>DVRF Number</th></tr>';
			
			while($row = mysqli_fetch_array($result)){
				$dvrf_number = $row['dvrf_number'];
				
		
				echo '<tr> 
					 <td>' .$dvrf_number. '</td>
					 </tr>';
			}
				
			echo '</table><br>';
		

	}

?>
