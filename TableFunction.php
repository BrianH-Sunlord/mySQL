

<html>
<head>
<title>Table Function</title>
  <link href="//fonts.googleapis.com/css?family=Play:400,300,600" rel="stylesheet" type="tex/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<?php

//This function will create a display table for a database table with a variable number of columns
function createtable ($table_name, $sql) {
		//Select column names from database and create table header row
			require_once('./mysqli_connect.php');
			$column_sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sunlord' AND `TABLE_NAME`='" .$table_name. "'";
			$result = mysqli_query($dbc,$column_sql);
			
		//Make columns an array variable	
			$columns = array();
			
		//Create table header row and fill in column array variable	
			echo '<table><tr>';
				while($row = mysqli_fetch_array($result)){
				echo '<th>'.$row['COLUMN_NAME'].'</th>';
				$columns[] = $row['COLUMN_NAME'];
				}
			echo '</tr>';

		//Pull all data and fill in table	
			//$sql = "SELECT * FROM fr_part_numbers ORDER BY ID";
			$result = mysqli_query($dbc,$sql);
			echo '<tr>';
				
			while($row = mysqli_fetch_array($result)){
				foreach($columns as $column){
				echo '<td>'.$row[$column].'</td>';
				}
			
			echo '<tr>';
			}
			
			echo '</table><br>';
		mysqli_close($dbc);
}
?>
