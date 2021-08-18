<html>
<head>
<title>Display Suppliers</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<br><h3>List of Suppliers</h3><br>

<?php
	
	//Allow use of function in another file
	include 'TableFunction.php';
	

	//Create MySQL insert statement
	$sql = "SELECT * FROM inventory_supplier ORDER BY name ASC;";
		
		
	//Create table using TableFunction
	createtable ('inventory_supplier', $sql);
	
?>

<!-- Assign this php file for action on form-->
<form action="DisplaySuppliers.php" method="post">



</form>
</body>
</html>





