<html>
<head>
<title>Add New R&D Project</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  
  <!-- Get date picker -->  
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
			$("#date1").datepicker({
				dateFormat: "yy-mm-dd"
						});	
			$("#date2").datepicker({
				dateFormat: "yy-mm-dd"
						});
			$("#date3").datepicker({
				dateFormat: "yy-mm-dd"
						});
			$("#date4").datepicker({
				dateFormat: "yy-mm-dd"
						});						
        });
		

    </script>
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewRandDProject.php" method="post">

<h3>Add New R&D Project</h3>

<br>

<!-- Input text-->
<div class="container">	
		<div class="five column">
						<label for="project_name">Project Name:</label>
			<input class="u-full-width" type="text" name="project_name" placeholder = "">
		</div>
</div>

<!-- Input text-->
<div class="container">	
		<div class="five column">
						<label for="description">Description:</label>
						
			<textarea class="u-full-width" name="description"></textarea>
		</div>
</div>

<!-- Input text-->
<div class="container">	
		<div class="five column">
						<label for="part_number">Part number(s):</label>
						
			<textarea class="u-full-width" placeholder = "DVRFxxxxx" name="part_number"></textarea>
		</div>
</div>

<!-- Input text-->
<div class="container">	
		<div class="five column">
						<label for="customer">Customer:</label>
			<input class="u-full-width" type="text" name="customer" placeholder = "">
		</div>
</div>

<!-- Input date-->
<div class="container">
	<div class="row">
		<div class="three column">
			    <label for="datepicker">Proposal date:</label>
                <input type="text" name="proposal_date" id="date1" autocomplete="off" />
        </div>	

		<div class="three column">
			    <label for="datepicker">Statement date:</label>
                <input type="text" name="statement_date" id="date2" autocomplete="off" />
        </div>
	</div>	
</div>

<!-- Input date-->
<div class="container">
	<div class="row">
		<div class="three column">
			    <label for="datepicker">Checklist date:</label>
                <input type="text" name="checklist_date" id="date3" autocomplete="off" />
        </div>

		<div class="three column">
			    <label for="datepicker">NPI date:</label>
                <input type="text" name="npi_date" id="date4" autocomplete="off" />
        </div>
	</div>	
</div>

	
<!-- Input text-->
<div class="container">	
		<div class="five column">
						<label for="status">Current Status:</label>
						
			<textarea class="u-full-width" name="status"></textarea>
		</div>
</div>


<br>

	

<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="five columns">
		<input class="button-success" type="submit" name="submit" value="Submit" />
		</div>
	</div>	
</div>

</form>
</body>
</html>

<?php
	
	//If submit button is pushed
	if(isset($_POST['submit'])){
		
		//Set inputs equal to variables
		$project_name = trim($_POST['project_name']);
		$description = trim($_POST['description']);
		$part_number = trim($_POST['part_number']);
		$customer = trim($_POST['customer']);
		$proposal_date = trim($_POST['proposal_date']);
		$statement_date = trim($_POST['statement_date']);
		$checklist_date = trim($_POST['checklist_date']);
		$npi_date = trim($_POST['npi_date']);
		$status = trim($_POST['status']);
		
		
	
	
		//Create MySQL insert statement
		$sql = "INSERT INTO randd_process (project_name,  description, part_number, customer, proposal_date, statement_date, checklist_date, npi_date, status) 
		VALUES ('$project_name','$description' , '$part_number', '$customer', '$proposal_date' , '$statement_date','$checklist_date', '$npi_date','$status');";
		
	
		//Insert to database then close
		require_once('./mysqli_connect.php');
		mysqli_query($dbc,$sql);
		mysqli_close($dbc);



		//Confirm new record inserted 
        if ($sql) {
				echo "R&D Project added successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="3">';
		} else {
				echo "Error: ";
				}
			
	}

?>
