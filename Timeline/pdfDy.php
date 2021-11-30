<?php

include 'Dp.php';


$data= json_decode($_POST['countryId']);
//if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

$query = ("SELECT * FROM UploadDocs WHERE Case_Name = '$data'");
	$result = $con->query($query);
       echo '<option value="" disabled selected>Choose Pdf Docuement</option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Sr_no'].'">'.$row['Pdf_Name'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
        
//}

?>