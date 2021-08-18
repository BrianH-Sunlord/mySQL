<html>
<head>
<title>Display Inventory Below Minimum Requirement</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<!-- Assign this php file for action on form-->
<form action="DisplayInventoryBelowMinimum.php" method="post">

<br><h3>List of All Inventory Below Minimum Requirement</h3><br>

</form>
</body>
</html>

<?php

		//Connect to database
		require_once('./mysqli_connect.php');

	
		//Create MySQL statement
		$sql = "SELECT inventory_min.part_number,min_qty,IFNULL(inventory.qty,0) FROM inventory_min LEFT JOIN inventory
       ON inventory_min.part_number=inventory.part_number WHERE IFNULL(inventory.qty,0) < inventory_min.min_qty ORDER BY inventory_min.part_number ASC;";
		
		//Select column names from database and create table header row
			$result = mysqli_query($dbc,$sql);
		
		//Create table		
			echo '<table><tr>';
			echo '<th>Part Number</th>';
			echo '<th>Minimum Inventory</th>';
			echo '<th>Actual Inventory</th>';
			
			while($row = mysqli_fetch_array($result)){
				$part_number = $row['part_number'];
				$min_qty = $row['min_qty'];
				$qty = $row['IFNULL(inventory.qty,0)'];
			
		
				echo '<tr> 
					 <td>' .$part_number. '</td>
					 <td>' .$min_qty. '</td>
					 <td>' .$qty. '</td>
					 </tr>';
			}
				
			echo '</table><br>';
			
	
		//Close database connection
		mysqli_close($dbc);

?>







