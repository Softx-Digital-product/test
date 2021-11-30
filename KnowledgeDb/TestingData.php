<?php
// Include the database connection file
include('Dp.php');

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

	// Fetch state name base on country id
	$query = "SELECT * FROM knowledge_subcateg WHERE Cid = ".$_POST['countryId'];
	$result = $con->query($query);
       echo '<option value="" disabled selected>Choose Sub-Category</option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Sr_no'].'">'.$row['Sub_Category'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
} 
?>