<html>
<head>
<title>Search FR Part Number</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<?php
	//get variable from previous page
	session_start();	
	
	//Allow use of function in another file
	include 'TableFunction.php';
?>

<!-- Assign this php file for action on form-->
<form action="Search_FR.php" method="post">


<br><h3>Search FR Part Number</h3>


<!-- Set up Search Form-->

<!-- Input start freq text box-->
<div class="row">
	<div class="two columns">	  
		  <b><center>Minimum Outer Diameter(mm):</center></b>
	</div> 
	<div class="two columns">	  
		  <b><center>Maximum Outer Diameter (mm):</center></b>
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


<div class="row">
	<!-- Input start freq text box-->
	<div class="two columns">
		  <label for="ferrite_matl">Ferrite Material:</label>
		  <input class="u-full-width" type="text" name="ferrite_matl" placeholder = "">
	</div>

	<!-- Input ODX text box-->
	<div class="two columns">
		  <label for="dielectric_matl">Dielectric Material:</label>
		  <input class="u-full-width" type="text" name="dielectric_matl" placeholder = "">
	</div>
</div>



	<div class="row">
		<div class="two column">
			<!-- Input data using radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Plating:</b></span><br>
					<input type="radio" name="plating" value="All" checked> All<br>
					<input type="radio" name="plating" value="None"> None<br>
					<input type="radio" name="plating" value="Silver"> Silver<br>
					<input type="radio" name="plating" value="Other"> Other<br>
				</label>
			</fieldset>
		</div>


		<div class="two column">
			<!-- Input data with radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Shape:</b></span><br>
					<input type="radio" name="shape" value="All" checked> All<br>
					<input type="radio" name="shape" value="Circular"> Circular<br>
					<input type="radio" name="shape" value="Triangle"> Triangle<br>
					<input type="radio" name="shape" value="Square"> Square<br>
					<input type="radio" name="shape" value="Other"> Other<br>
				</label>
			</fieldset>
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
		
		//plating can be specific or "all"
		$plating = trim($_POST['plating']);
		if ($plating == "All") {
			$platingstring = "(plating = 'None' OR plating ='Silver' OR plating ='Other')";
			} 	else {
				$platingstring = "plating = '" . $plating . "'";
				}


		//shape can be specific or "all"
		$shape = trim($_POST['shape']);
		if ($shape == "All") {
			$shapestring = "(shape = 'Circular' OR shape ='Triangle' OR shape ='Square' OR shape='Other')";
			} 	else {
				$shapestring = "shape = '" . $shape . "'";
				}

		//Ferrite_matl can be blank or be typed in exactly
		$ferrite_matl = trim($_POST['ferrite_matl']);
		if ($ferrite_matl == "") {
			$ferrite_matlstring = "ferrite_matl LIKE '%'";
			$ferrite_matl = "All";
			} 	else {
				$ferrite_matlstring = "ferrite_matl LIKE '" . $ferrite_matl . "%'";
				}				
				
		//dielectric_matl can be blank or begin with the input
		$dielectric_matl = trim($_POST['dielectric_matl']);
		if ($dielectric_matl == "") {
			$dielectric_matlstring = "dielectric_matl LIKE '%'";
			$dielectric_matl = "All";
			} 	else {
				$dielectric_matlstring = "dielectric_matl LIKE '" . $dielectric_matl . "%'";
				}		
			
				
		//diameter can be blank or contain the input
		$diameter_low = trim($_POST['diameter_low']);
		$diameter_high = trim($_POST['diameter_high']);
		$diameterstring = "dielectric_dia BETWEEN " . $diameter_low . " AND " . $diameter_high . " " ;
						



	
		//Create MySQL insert statement
		$sql = "SELECT * FROM " . $_SESSION['part_type'] . " WHERE " . $platingstring . " AND " . $shapestring . " AND " . $ferrite_matlstring . " AND " . $dielectric_matlstring . " AND " . $diameterstring . " ORDER BY part_number DESC;";
		
		
		//Print out filter parameters
		echo "<br><b>Results filtered by:</b><br>";
		echo "Outer diameter between <b>" . $diameter_low . "mm</b> and <b>" . $diameter_high ."mm</b> <br> " ;
		echo "Ferrite material: <b>" . $ferrite_matl . "</b><br>";
		echo "Dielectric material: <b>" . $dielectric_matl . "</b><br>";
		echo "Plating: <b>" . $plating . "</b><br>";
		echo "Shape: <b>" . $shape . "</b><br>";
		
		//Create table using TableFunction
		createtable ($_SESSION['part_type'], $sql);


	}
	



	


?>


