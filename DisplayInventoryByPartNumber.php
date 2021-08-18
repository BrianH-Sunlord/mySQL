<html>
<head>
<title>Display Inventory by Part Number</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<?php
	//Allow use of function in another file
	include 'TableFunction.php';
?>

<!-- Assign this php file for action on form-->
<form action="DisplayInventoryByPartNumber.php" method="post">


<br><h3>Display Inventory by Part Number</h3>


<!-- Set up Search Form-->

<br>

<!-- Dropdown menu pulled from database of inventory-->
<div class="container">		
	<div class="row">
		<div class="four columns">
				<?php	
				require_once('./mysqli_connect.php');
				$sql = "SELECT DISTINCT part_number FROM inventory ORDER BY part_number";
				$result = mysqli_query($dbc,$sql);
				?>
			<label for="part_number">Part Number:</label>
			<select class="u-full-width" name='part_number'>
				<?php
				while ($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['part_number'] . "'>" . $row['part_number'] . "</option>";
				}
				?>
			</select>
		</div>
	</div>
</div>	

<!-- Submit button-->
<div class="row">
	<div class="three columns">
	<input class="button-primary" type="submit" name="submit" value="Enter" />
	</div>
</div>

</form>
</body>
</html>


<?php
		
//If submit button is pushed
	if (isset($_POST['submit']) && $_POST['submit'] !== ""){

		//Set inputs equal to variables
		$part_number = trim($_POST['part_number']);

	
		//Create MySQL insert statement
		$sql = "SELECT * FROM inventory WHERE part_number = '" . $part_number . "' AND qty >0;";
		
		
		//Print out filter parameters
		echo "<br><b>Results filtered by:</b><br>";
		echo "Part Number: <b>" . $part_number . "</b><br>";
		
		//Create table using TableFunction
		
		//Select column names from database and create table header row
			require_once('./mysqli_connect.php');
			$column_sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sunlord' AND `TABLE_NAME`='inventory'";
			$result = mysqli_query($dbc,$column_sql);
			
		//Make columns an array variable	
			$columns = array();
			
		//Create table header row and fill in column array variable	
			echo '<table><tr>';
				while($row = mysqli_fetch_array($result)){
				echo '<th>'.$row['COLUMN_NAME'].'</th>';
				$columns[] = $row['COLUMN_NAME'];
				}
			echo '</tr>';

		//Pull all data and fill in table	
			//$sql = "SELECT * FROM fr_part_numbers ORDER BY ID";
			$result = mysqli_query($dbc,$sql);
			echo '<tr>';
				
			while($row = mysqli_fetch_array($result)){
				foreach($columns as $column){
				echo '<td>'.$row[$column].'</td>';
				}
			
			echo '<tr>';
			}
			
			echo '</table><br>';
		mysqli_close($dbc);
	}
?>


