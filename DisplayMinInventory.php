<html>
<head>
<title>Display Minimum Inventory List</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<br><h3>Minimum Inventory Requirements by Part Number</h3><br>

<?php
	
	//Allow use of function in another file
	include 'TableFunction.php';
	

	//Create MySQL insert statement
	$sql = "SELECT * FROM inventory_min ORDER BY part_number ASC;";
		
		
	//Create table using TableFunction
	createtable ('inventory_min', $sql);
	
?>

<!-- Assign this php file for action on form-->
<form action="DisplayMinInventory.php" method="post">



</form>
</body>
</html>





