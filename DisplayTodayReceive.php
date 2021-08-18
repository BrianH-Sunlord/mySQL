<html>
<head>
<title>Display Today's Receipts</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<!-- Assign this php file for action on form-->
<form action="DisplayTodayReceive.php" method="post">

<br><h3>All Items Received Today</h3><br>

</form>
</body>
</html>

<?php

		//Connect to database
		require_once('./mysqli_connect.php');

	
		//Create MySQL statement
		$sql = "SELECT * FROM inventory_transaction WHERE DATE(`date`) = CURDATE() AND qty >0 ORDER BY part_number ASC;";
		
		//Select column names from database and create table header row
			$result = mysqli_query($dbc,$sql);
		
		//Create table		
			echo '<table><tr>';
			echo '<th>Supplier</th>';
			echo '<th>Part Number</th>';
			echo '<th>Rev</th>';
			echo '<th>Qty</th>';
			echo '<th>PO</th>';
			echo '<th>Location</th>';
			echo '<th>Entered By</th>';
			echo '<th>Date</th>';
			echo '<th>Remarks</th>';

			
			while($row = mysqli_fetch_array($result)){
				$supplier = $row['supplier'];
				$part_number = $row['part_number'];
				$rev = $row['rev'];
				$qty = $row['qty'];
				$po = $row['po'];
				$location = $row['location'];
				$entered_by = $row['entered_by'];
				$date = date("M-d-Y",strtotime($row['date']));
				$remark = $row['description'];
				
		
				echo '<tr> 
					 <td>' .$supplier. '</td>
					 <td>' .$part_number. '</td>
					 <td>' .$rev. '</td>
					 <td>' .$qty. '</td>
					 <td>' .$po. '</td>
					 <td>' .$location. '</td>
					 <td>' .$entered_by. '</td>
					 <td>' .$date. '</td>
					 <td>' .$remark. '</td>
					 </tr>';
			}
				
			echo '</table><br>';
			
	
		//Close database connection
		mysqli_close($dbc);

?>







