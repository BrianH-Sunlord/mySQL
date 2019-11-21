<html>
<head>
<title>Search DVRFxxxxx Part Number</title>
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
?>

<!-- Assign this php file for action on form-->
<form action="SearchDVRFnumber.php" method="post">


<br><h3>Search DVRF Part Number</h3>


<!-- Set up Search Form-->

<!-- Input start freq text box-->
<div class="row">
	<div class="two columns">	  
		  <b><center>Start Frequency (MHz):</center></b>
	</div> 
	<div class="two columns">	  
		  <b><center>Stop Frequency (MHz):</center></b>
	</div>
</div> 

<div class="row">
	<div class="one columns">	  
		  <input class="u-full-width" type="text" name="start_freq_low" value = 0>
	</div>
	<div class="one columns">
		  <input class="u-full-width" type="text" name="start_freq_high" value = 100000>
	</div>
	<div class="one columns">	  
		  <input class="u-full-width" type="text" name="stop_freq_low" value = 0>
	</div>
	<div class="one columns">
		  <input class="u-full-width" type="text" name="stop_freq_high" value = 100000>
	</div>

</div>

<div class="row">
	<div class="two columns">
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Type:</b></span><br>
			<input type="radio" name="type1" value="All" checked> All<br>
			<input type="radio" name="type1" value="Circulator"> Circulator<br>
			<input type="radio" name="type1" value="Isolator"> Isolator<br>
			<input type="radio" name="type1" value="Attenuator"> Attenuator<br>
		</label>
		</fieldset>
	</div>

<!-- Radio Button box-->
	<div class="two columns">
		<fieldset>
		<label>
			<span class="label-body"><b>Configuration:</b></span><br>
			<input type="radio" name="config" value="All" checked> All<br>
			<input type="radio" name="config" value="Pin"> Pin<br>
			<input type="radio" name="config" value="Tab"> Tab<br>
			<input type="radio" name="config" value="Connector"> Connector<br>
		</label>
		</fieldset>
	</div>
</div>

<br>

<div class="row">
	<div class="one columns">
		<fieldset>
		<label>
			<span class="label-body"><b>Junction Qty:</b></span><br>
			<input type="radio" name="junction" value="All" checked> All<br>
			<input type="radio" name="junction" value="1"> 1<br>
			<input type="radio" name="junction" value="2"> 2<br>
		</label>
		</fieldset>
	</div>

	
	<div class="one columns">	
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Rotation:</b></span><br>
			<input type="radio" name="rotation" value="All" checked> All<br>
			<input type="radio" name="rotation" value="CW"> CW<br>
			<input type="radio" name="rotation" value="CCW"> CCW<br>
		</label>
		</fieldset>	
	</div>


	<div class="one columns">	
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Platform:</b></span><br>
			<input type="radio" name="platform" value="All" checked> All<br>	
			<input type="radio" name="platform" value="SMT"> SMT<br>
			<input type="radio" name="platform" value="Drop in"> Drop in<br>
		</label>
		</fieldset>	
	</div>
	</div>



<div class="row">
	<!-- Input start freq text box-->
	<div class="two columns">
		  <label for="size">Junction size:</label>
		  <input class="u-full-width" type="text" name="size" placeholder = "Type in size in mm">
	</div>

	<!-- Input ODX text box-->
	<div class="two columns">
		  <label for="od">OD drawing number:</label>
		  <input class="u-full-width" type="text" name="od" placeholder = "Type OD-xx-xxxxx">
	</div>
</div>


<div class="row">
	<!-- Input start freq text box-->
	<div class="two columns">
		  <label for="customer">Customer:</label>
		  <input class="u-full-width" type="text" name="customer" placeholder = "Name starts with">
	</div>

	<!-- Input start freq text box-->
	<div class="two columns">
		  <label for="customer_p_n">Customer part number:</label>
		  <input class="u-full-width" type="text" name="customer_p_n" placeholder = "Contains these characters">
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
		

		//junctions can be specific or "all"
		$junction = trim($_POST['junction']);
		if ($junction == "All") {
			$junctionstring = "(junction = '1' OR junction ='2')";
			} 	else {
				$junctionstring = "junction = '" . $junction . "'";
				}
		
		//type can be specific or "all"
		$type1 = trim($_POST['type1']);
		if ($type1 == "All") {
			$typestring = "(type = 'Circulator' OR type ='Isolator' OR type ='Attenuator')";
			} 	else {
				$typestring = "type = '" . $type1 . "'";
				}

		//config can be specific or "all"
		$config = trim($_POST['config']);
		if ($config == "All") {
			$configstring = "(config = 'Pin' OR config ='Tab' OR config ='Connector')";
			} 	else {
				$configstring = "config = '" . $config . "'";
				}
				
		//rotation can be specific or "all"
		$rotation = trim($_POST['rotation']);
		if ($rotation == "All") {
			$rotationstring = "(rotation = 'CW' OR rotation ='CCW')";
			} 	else {
				$rotationstring = "rotation = '" . $rotation . "'";
				}				

		//platform can be specific or "all"
		$platform = trim($_POST['platform']);
		if ($platform == "All") {
			$platformstring = "(platform = 'SMT' OR platform ='Drop in')";
			} 	else {
				$platformstring = "platform = '" . $platform . "'";
				}	

		//size of junction can be blank or begins with the input
		$size = trim($_POST['size']);
		if ($size == "") {
			$sizestring = "size LIKE '%'";
			$size = "All";
			} 	else {
				$sizestring = "size LIKE '" . $size . "%'";
				}		

		//ODX can be blank or be typed in exactly
		$od = trim($_POST['od']);
		if ($od == "") {
			$odstring = "od LIKE '%'";
			$od = "All";
			} 	else {
				$odstring = "od = '" . $od . "'";
				}				
				
		//customer can be blank or begin with the input
		$customer = trim($_POST['customer']);
		if ($customer == "") {
			$customerstring = "customer LIKE '%'";
			$customer = "All";
			} 	else {
				$customerstring = "customer LIKE '" . $customer . "%'";
				}		

		//customer P/N can be blank or contain the input
		$customer_p_n = trim($_POST['customer_p_n']);
		if ($customer_p_n == "") {
			$customer_p_nstring = "customer_part_number LIKE '%' ";
			$customer_p_n = "All";
			} 	else {
				$customer_p_nstring = "customer_part_number LIKE '%" . $customer_p_n . "%'";
				}				
				
		//start_freq can be blank or contain the input
		$start_freq_low = trim($_POST['start_freq_low']);
		$start_freq_high = trim($_POST['start_freq_high']);
		$start_freqstring = "start_freq BETWEEN " . $start_freq_low . " AND " . $start_freq_high ." " ;
						

		//stop_freq can be blank or contain the input
		$stop_freq_low = trim($_POST['stop_freq_low']);
		$stop_freq_high = trim($_POST['stop_freq_high']);
		$stop_freqstring = "stop_freq BETWEEN " . $stop_freq_low . " AND " . $stop_freq_high ." " ;		

	
		//Create MySQL insert statement
		$sql = "SELECT * FROM dvrf_part_number WHERE " . $junctionstring . " AND " . $typestring . " AND " . $configstring . " AND " . $rotationstring . " AND " . $platformstring . " AND " . $sizestring . " AND " . $odstring . " AND " . $customerstring . " AND " . $customer_p_nstring . " AND " . $start_freqstring . " AND " . $stop_freqstring .  " ORDER BY part_number DESC;";
		
		
		//Print out filter parameters
		echo "<br><b>Results filtered by:</b><br>";
		echo "Start frequency between <b>" . $start_freq_low . "MHz</b> and <b>" . $start_freq_high ."MHz</b> <br> " ;
		echo "Stop frequency between <b>" . $stop_freq_low . "MHz</b> and <b>" . $stop_freq_high ."MHz</b> <br>" ;
		echo "Type: <b>" . $type1 . "</b><br>";
		echo "Configuration: <b>" . $config . "</b><br>";
		echo "Junctions: <b>" . $junction . "</b><br>";
		echo "Rotation: <b>" . $rotation . "</b><br>";
		echo "Platform: <b>" . $platform . "</b><br>";
		echo "Junction size: <b>" . $size . "</b><br>";
		echo "OD drawing: <b>" . $od . "</b><br>";
		echo "Customer starts with: <b>" . $customer . "</b><br>";
		echo "Customer P/N contains: <b>" . $customer_p_n . "</b><br>";
		
		//Create table using TableFunction
		createtable ("dvrf_part_number", $sql);


	}
	



	


?>


