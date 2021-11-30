<?php
// Include the database connection file
include('Dp.php');

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

	// Fetch state name base on country id
//	$query = "SELECT * FROM Client_CaseDb WHERE Client_Name = ".$_POST['countryId'];
    $query = "SELECT * FROM Client_CaseDb WHERE Cid = ".$_POST['countryId'];
	$result = $con->query($query);
       echo '<option value="" disabled selected>Choose Case Name</option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Case_Name'].'">'.$row['Case_Name'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
} 
?>