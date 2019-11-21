


		<?php
$myHost = "localhost"; // use your real host name
$myUserName = "root";   // use your real login user name
$myPassword = "October27!";   // use your real login password
$myDataBaseName = "sunlord"; // use your real database name

$dbc = mysqli_connect( "$myHost", "$myUserName", "$myPassword", "$myDataBaseName" );

if( !$dbc ) // == null if creation of connection object failed
{ 
    // report the error to the user, then exit program
    die("connection object not created: ".mysqli_error($dbc));
}

if( mysqli_connect_errno() )  // returns false if no error occurred
{ 
    // report the error to the user, then exit program
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
		?>
		