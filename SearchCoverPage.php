<html>
<head>
<title>Search Piece Part Numbers</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="Searchcoverpage.php" method="post">

	<h3>Search Piece Part Database: </h3>

<br>

<!-- Select part type-->
<div class="container">	
	<div class="row">
		<div class="four column">       
		   <fieldset>
		<label>
			<span class="label-body"><b>Category:</b></span><br>
					</label>
			<select name="part_type">
			<option value="">  </options>
			<option value="AD">Assembly Drawing (AD)</options>
			<option value="CV">Cover (CV)</options>
			<option value="CR">Circuit (CR)</options>
			<option value="GP">Ground Plane (GP)</options>
			<option value="FR">Ferrite (FR)</options>
			<option value="HS">Housing (HS)</options>
			<option value="MC">Magnet, Ceramic (MC)</options>
			<option value="MS">Magnet, SmCo (MS)</options>
			<option value="OT">Other (OT)</options>
			<option value="PF">Pin Frame (PF)</options>
			<option value="PC">PCB (PC)</options>
			<option value="PK">Packaging (PK)</options>
			<option value="PP">Pole Piece (PP)</options>
			<option value="RC">Return, Cover (RC)</options>
			<option value="TC">Temperature Compensator (TC)</options>
			<option value="TM">Termination (TM)</options>
			<option value="TF">Test Fixture (TF)</options>
			<option value="PA">Pill Assembly Fixture (PA)</options>			
			<option value="FF">Form Fixture (FF)</options>			
			<option value="SF">Stack Fixture (SF)</options>			
			<option value="CF">Cover Fixture (CF)</options>			
			<option value="MF">Miscellaneous Fixture (MF)</options>			
			<option value="OD">Outline Drawing (OD)</options>
			<option value="RF">Recommended Footprint (RF)</options>			
			<option value="MAN">Manufacturing Procedures (MAN)</options>
			<option value="TEST">Test Procedures (TEST)</options>
			<option value="INSP">Inspection Procedures (INSP)</options>	
			<option value="REL">Reliability Reports (REL)</options>	
			<option value="PROJ">Projects (PROJ)</options>	
			</select>

		   </fieldset>
		</div>
	</div>
</div>

<br>

<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="four columns">
		<input class="button-success" type="submit" name="submit" value="Select" />
		</div>
	</div>	
</div>

</form>
</body>
</html>

<?php

	//let's start the session
	session_start();

	
	//If submit button is pushed
	if(isset($_POST['submit'])){
		

		//store our posted values in the session variables
		$_SESSION['part_type'] = trim($_POST['part_type']);

		
		switch ($_SESSION['part_type']) {
			case "OD":
				header('Location: Search_table.php');
				break;
			case "PF":
				header('Location: Search_table.php');
				break;				
			case "TM":
				header('Location: Search_table.php');
				break;	
			case "CR":
				header('Location: Search_table.php');
				break;
			case "HS":
				header('Location: Search_table.php');
				break;	
			case "PC":
				header('Location: Search_table.php');
				break;				
			case "FR":
				header('Location: Search_FR.php');
				break;
			case ("TF"):
				header('Location: Search_table.php');
				break;				
			case ("MC"):
				header('Location: Search_CV.php');
				break;
			case ("CV"):
				header('Location: Search_CV.php');
				break;
			case ("RC"):
				header('Location: Search_CV.php');
				break;
			case ("TC"):
				header('Location: Search_CV.php');
				break;
			case ("PP"):
				header('Location: Search_CV.php');
				break;
			case ("PK"):
				header('Location: Search_table.php');
				break;				
			case ("MS"):
				header('Location: Search_CV.php');
				break;
			case ("GP"):
				header('Location: Search_CV.php');
				break;
			case ("MAN"):
				header('Location: Search_simple.php');
				break;
			case ("TEST"):
				header('Location: Search_simple.php');
				break;
			case ("INSP"):
				header('Location: Search_simple.php');
				break;
			case ("REL"):
				header('Location: Search_simple.php');
				break;				
			case ("AD"):
				header('Location: Search_simple.php');
				break;	
			case ("PROJ"):
				header('Location: Search_simple.php');
				break;				
			case ("OT"):
				header('Location: Search_simple.php');
				break;
			case ("PA"):
				header('Location: Search_PA.php');
				break;
			case ("SF"):
				header('Location: Search_simple.php');
				break;
			case ("FF"):
				header('Location: Search_simple.php');
				break;
			case ("CF"):
				header('Location: Search_simple.php');
				break;
			case ("MF"):
				header('Location: Search_simple.php');
				break;	
			case ("RF"):
				header('Location: Search_simple.php');
				break;				

		}
		

	}

?>
