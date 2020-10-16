<html>
<head>
<title>R&D Project Status Table</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="RandDProjectTable.php" method="post">
         


<!-- Container for inputing data-->
<h3>R&D Project Status</h3>

<br>

</form>
</body>
</html>

<?php
		//Connect to database
		require_once('./mysqli_connect.php');

	
		//Create MySQL statement
		$sql = "SELECT * FROM randd_process ORDER BY project_name;";
		

		//Select column names from database and create table header row
			$result = mysqli_query($dbc,$sql);
		
		//Create table		
			echo '<table><tr>';
			echo '<th>Project</th>';
			echo '<th>Start Date</th>';
			echo '<th>Proposal Complete</th>';
			echo '<th>Statement Complete</th>';
			echo '<th>Checklist Complete</th>';
			echo '<th>NPI Complete</th>';
			echo '<th>Part Numbers</th></tr>';
			
			while($row = mysqli_fetch_array($result)){
				$project = $row['project_name'];
				$start = $row['start_date'];
				$proposal = $row['proposal_date'];
				$statement = $row['statement_date'];
				$checklist = $row['checklist_date'];
				$npi = $row['npi_date'];
				$parts = $row['part_number'];
				
			
				echo '<tr> 
					 <td>' .$project. '</td>
					 <td>' .$start. '</td>
					 <td>' .$proposal. '</td>
					 <td>' .$statement. '</td>
					 <td>' .$checklist. '</td>
					 <td>' .$npi. '</td>
					 <td>' .$parts. '</td>
					 </tr>';
			}
				
			echo '</table><br>';
		
		//Close database connection
		mysqli_close($dbc);

?>
