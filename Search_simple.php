<html>
<head>
<title>Search Simple Part Number</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<?php
	//connect to the database
	//require_once('./mysqli_connect.php');
	
	//Allow use of function in another file
	include 'TableFunction.php';
	
	//get variable from previous page
	session_start();
?>

<!-- Assign this php file for action on form-->
<form action="Search_simple.php" method="post">


<br><h3>Search Part Number</h3>

<div class="row">
	<!-- Input start freq text box-->
	<div class="four columns">
		  <label for="description">Enter search term:</label>
		  <input class="u-full-width" type="text" name="description" placeholder = "">
	</div>

</div>


	

<!-- Submit button-->
<div class="row">
	<div class="three columns">
	<input class="button-primary" type="submit" name="submit" value="Submit" />
	</div>
</div>

</form>
</body>
</html>


<?php
		
//If submit button is pushed
	if (isset($_POST['submit']) && $_POST['submit'] !== ""){

		//Set inputs equal to variables
		
			
		//description can be blank or begin with the input
		$description = trim($_POST['description']);
		if ($description == "") {
			$descriptionstring = "description LIKE '%'";
			$description = "All";
			} 	else {
				$descriptionstring = "description LIKE '" . $description . "%'";
				}		

	
		//Create MySQL insert statement
		$sql = "SELECT * FROM " . $_SESSION['part_type'] . " WHERE " . $descriptionstring . " ORDER BY part_number DESC;";
		
		
		//Print out filter parameters
		echo "<br><b>Results filtered by:</b><br>";
		echo "Search term: <b>" . $description . "</b><br>";

		
		//Create table using TableFunction
		createtable ($_SESSION['part_type'], $sql);


	}
	



	


?>


