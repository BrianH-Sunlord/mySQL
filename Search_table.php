<html>
<head>
<title>Create Table</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<?php
	
	//Allow use of function in another file
	include 'TableFunction.php';
	
	//get variable from previous page
	session_start();	
	
	//Create MySQL insert statement
	$sql = "SELECT * FROM " . $_SESSION['part_type'] . " WHERE 1 ORDER BY part_number DESC;";
		
		
	//Create table using TableFunction
	createtable ($_SESSION['part_type'], $sql);
	
?>

<!-- Assign this php file for action on form-->
<form action="Search_table.php" method="post">



</form>
</body>
</html>





