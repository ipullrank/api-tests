<pre>
<?php 
	include_once "csv-handlers.php";

	$csv = csv_to_array("example.csv");

	print_r($csv);
	
	makeCSV($csv,"test.csv");

?>