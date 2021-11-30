<?php
// Include the database connection file
include('Dp.php');

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

	// Fetch state name base on country id
	$query = "SELECT * FROM Case_SubType WHERE Cid = ".$_POST['countryId'];
	$result = $con->query($query);
        echo '<option value="" disabled selected>Choose Case Sub Type</option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Sr_no'].'">'.$row['Case_SubType'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
} 
?>

