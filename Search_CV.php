<html>
<head>
<title>Search CV Part Number</title>
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
<form action="Search_CV.php" method="post">


<br><h3>Search Part Number</h3>


<!-- Set up Search Form-->

<!-- Input start freq text box-->
<div class="row">
	<div class="two columns">	  
		  <b><center>Minimum Diameter (mm):</center></b>
	</div> 
	<div class="two columns">	  
		  <b><center>Maximum Diameter (mm):</center></b>
	</div>
</div> 

<div class="row">
	<div class="two columns">	  
		  <input class="u-full-width" type="text" name="diameter_low" value = 0>
	</div>
	<div class="two columns">
		  <input class="u-full-width" type="text" name="diameter_high" value = 100>
	</div>

</div>

<br>

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
				
		//diameter_low can be blank or contain the input
		$diameter_low = trim($_POST['diameter_low']);
		$diameter_high = trim($_POST['diameter_high']);
		$diameterstring = "diameter BETWEEN " . $diameter_low . " AND " . $diameter_high ." " ;
						


		//Create MySQL insert statement
		$sql = "SELECT * FROM " . $_SESSION['part_type'] . " WHERE " . $diameterstring .  " ORDER BY part_number DESC;";
		
		
		//Print out filter parameters
		echo "<br><b>Results filtered by:</b><br>";
		echo "Diameter between <b>" . $diameter_low . "mm</b> and <b>" . $diameter_high ."mm</b> <br> " ;

		
		//Create table using TableFunction
		createtable ($_SESSION['part_type'], $sql);


	}
	



	


?>


