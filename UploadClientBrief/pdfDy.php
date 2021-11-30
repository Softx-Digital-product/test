<?php
// Include the database connection file
include('Dp.php');

if(isset($_POST['contents'])){
    $sr= $_POST['contents'];
//    echo $sr;
    $f= "SELECT * FROM BreifTimeline_data WHERE Sr_no = '$sr' ";
     $quariy= $con->query($f);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
<p>
    <?php echo $row['Content'];?>
</p>
    
    <?php
                                        }}
    
    die();
}

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {
	// Fetch state name base on country id 
//	$query = "SELECT * FROM Client_CaseDb WHERE Client_Name = ".$_POST['countryId'];
    $query = "SELECT * FROM UploadClientBrief WHERE Case_Name= ".$_POST['countryId'];
   // echo $query;
	$result = $con->query($query);
//       echo '<option value="" disabled selected>Choose Pdf Doocuments</option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    echo $row['Sr_no'];
		}
	} else {
	//	echo '<option value="">Data not available</option>';
	}
} 
?>