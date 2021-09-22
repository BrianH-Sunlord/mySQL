<html>
<head>
<title>Add New Part Number</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewpartnumbercoverpage.php" method="post">

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
			<option value="HW">Hardware (HW)</options>
			<option value="TF">Test Fixture (TF)</options>
			<option value="PA">Pill Assembly Fixture (PA)</options>
			<option value="FF">Form Fixture (FF)</options>
			<option value="SF">Stack Fixture (SF)</options>
			<option value="CF">Cover Fixture (CF)</options>
			<option value="MF">Misc Fixture (MF)</options>
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

<!-- Select size code-->	
<div class="container">	
	<div class="row">
		<div class="four columns">
		
			<fieldset>
				<label>
					<span class="label-body"><b>Select Size Code (dia):</b></span><br></label>
					<select name="size_code">
					<option value="">  </options>
					<option value="5">5</options>					
					<option value="7">7</options>
					<option value="8">8</options>					
					<option value="9">9</options>					
					<option value="10">10</options>
					<option value="12">12</options>
					<option value="15">15</options>
					<option value="20">20</options>
					<option value="25">25</options>
					<option value="32">32</options>
					<option value="38">38</options>
					<option value="00">other</options>
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
		$_SESSION['size_code'] = trim($_POST['size_code']);
		
		switch ($_SESSION['part_type']) {
			case "OD":
				header('Location: AddNewPartNumber_OD.php');
				break;
			case "PF":
				header('Location: AddNewPartNumber_PF.php');
				break;				
			case "TM":
				header('Location: AddNewPartNumber_TM.php');
				break;	
			case "CR":
				header('Location: AddNewPartNumber_CR.php');
				break;
			case "HS":
				header('Location: AddNewPartNumber_HS.php');
				break;	
			case "PC":
				header('Location: AddNewPartNumber_PC.php');
				break;				
			case "FR":
				header('Location: AddNewPartNumber_FR.php');
				break;
			case ("HW"):
				header('Location: AddNewPartNumber_simple.php');
				break;	
			case ("TF"):
				header('Location: AddNewPartNumber_TF.php');
				break;				
			case ("MC"):
				header('Location: AddNewPartNumber_CV.php');
				break;
			case ("CV"):
				header('Location: AddNewPartNumber_CV.php');
				break;
			case ("TC"):
				header('Location: AddNewPartNumber_CV.php');
				break;
			case ("PP"):
				header('Location: AddNewPartNumber_CV.php');
				break;
			case ("MS"):
				header('Location: AddNewPartNumber_CV.php');
				break;
			case ("GP"):
				header('Location: AddNewPartNumber_CV.php');
				break;
			case ("RC"):
				header('Location: AddNewPartNumber_CV.php');
				break;
			case ("MAN"):
				header('Location: AddNewPartNumber_simple.php');
				break;
			case ("TEST"):
				header('Location: AddNewPartNumber_simple.php');
				break;
			case ("INSP"):
				header('Location: AddNewPartNumber_simple.php');
				break;
			case ("REL"):
				header('Location: AddNewPartNumber_REL.php');
				break;				
			case ("AD"):
				header('Location: AddNewPartNumber_simple.php');
				break;
			case ("PROJ"):
				header('Location: AddNewPartNumber_simple.php');
				break;				
			case ("OT"):
				header('Location: AddNewPartNumber_simple.php');
				break;
			case ("PA"):
				header('Location: AddNewPartNumber_PA.php');
				break;	
			case ("PK"):
				header('Location: AddNewPartNumber_PK.php');
				break;				
			case ("FF"):
				header('Location: AddNewPartNumber_simplewithcode.php');
				break;
			case ("SF"):
				header('Location: AddNewPartNumber_simplewithcode.php');
				break;
			case ("CF"):
				header('Location: AddNewPartNumber_simplewithcode.php');
				break;
			case ("MF"):
				header('Location: AddNewPartNumber_simplewithcode.php');
				break;	
			case ("RF"):
				header('Location: AddNewPartNumber_simple.php');
				break;				

		}
		

	}

?>
