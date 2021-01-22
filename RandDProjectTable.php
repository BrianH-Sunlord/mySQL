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
		$sql = "SELECT id, project_name, description, customer, IF(proposal_date,DATE_FORMAT(proposal_date, '%d/%m/%Y'),NULL), IF(statement_date,DATE_FORMAT(statement_date, '%d/%m/%Y'),NULL), IF(checklist_date,DATE_FORMAT(checklist_date, '%d/%m/%Y'),NULL), IF(npi_date,DATE_FORMAT(npi_date, '%d/%m/%Y'),NULL), status FROM randd_process;";
		
		//Select column names from database and create table header row
			$result = mysqli_query($dbc,$sql);
		
		//Create table		
			echo '<table><tr>';
			echo '<th>Project</th>';
			echo '<th>Description</th>';
			echo '<th>Customer</th>';
			echo '<th>Proposal Complete</th>';
			echo '<th>Statement Complete</th>';
			echo '<th>Checklist Complete</th>';
			echo '<th>NPI Complete</th>';
			echo '<th>Current Status</th>';
			echo '<th>Link</th></tr>';
			
			while($row = mysqli_fetch_array($result)){
				$id = $row['id'];
				$project = $row['project_name'];
				$description = $row['description'];
				$customer = $row['customer'];
				$proposal = $row["IF(proposal_date,DATE_FORMAT(proposal_date, '%d/%m/%Y'),NULL)"];
				$statement = $row["IF(statement_date,DATE_FORMAT(statement_date, '%d/%m/%Y'),NULL)"];
				$checklist = $row["IF(checklist_date,DATE_FORMAT(checklist_date, '%d/%m/%Y'),NULL)"];
				$npi = $row["IF(npi_date,DATE_FORMAT(npi_date, '%d/%m/%Y'),NULL)"];
				$status = $row['status'];
				
		
				echo '<tr> 
					 <td>' .$project. '</td>
					 <td>' .$description. '</td>
					 <td>' .$customer. '</td>
					 <td>' .$proposal. '</td>
					 <td>' .$statement. '</td>
					 <td>' .$checklist. '</td>
					 <td>' .$npi. '</td>
					 <td>' .$status. '</td>
					 <td> <a href="editranddproject.php?id=' . $id . ' ">Update</a></td>
					 </tr>';
			}
				
			echo '</table><br>';
			
		//Add link to Add R&D Project page	
		echo '<br><a href="AddNewRandDProject.php">Add New R&D Project</a>';
		
		//Close database connection
		mysqli_close($dbc);

?>
