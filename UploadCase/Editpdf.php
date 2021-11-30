<?php

include 'Dp.php';

$SR = json_decode($_POST['Sr']);
$RENAME= json_decode($_POST['Rename']);
$Doc= json_decode($_POST['Date']);

echo $SR;
echo $RENAME;
echo $Doc;

$filePath; $clientName; $caseName;
$query = "SELECT * FROM UploadDocs WHERE Sr_no = {$SR}";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    $filePath=$row['Pdf_Path'];
                    $clientName=$row['Client_Name'];
                    $caseName=$row['Case_Name'];
                     
                             
                }
                
    }
    
      $newpath = "ClientCaseData/$clientName/$caseName/$RENAME";
  $oldname = "../$filePath";
   $newname = "../$newpath";

echo $oldname."<br><br>";
echo $newname;
 
if(rename($oldname, $newname)){
   //echo "Directory has been renamed";
   
    $sql = "UPDATE UploadDocs SET DOE ='$Doc',Pdf_Name='$RENAME', Pdf_Path='$newpath' WHERE Sr_no='$SR'";
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}


}
else {
   echo "Fail to rename directory";
   
       $sql = "UPDATE UploadDocs SET DOE ='$Doc',Pdf_Name='$RENAME', Pdf_Path='$newpath' WHERE Sr_no='$SR'";
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
}
  

?>