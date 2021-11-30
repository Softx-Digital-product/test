<?php

include 'Dp.php';

$SR = json_decode($_POST['id']);
$RENAME= json_decode($_POST['Rname']);


echo $SR;
echo $RENAME;


$filePath; $clientName; $caseName;
$query = "SELECT * FROM UploadClientBrief WHERE Sr_no = {$SR}";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    $filePath=$row['Pdf_Path'];
                    $clientName=$row['Client_Name'];
                    $caseName=$row['Case_Name'];
                    
                     
                             
                }
                
    }
    
      $newpath = "ClientCaseData/$clientName/$caseName/ClientBrief/$RENAME";
  $oldname = "../$filePath";
   $newname = "../$newpath";

echo $oldname."<br><br>";
echo $newname;
 
if(rename($oldname, $newname)){
   //echo "Directory has been renamed";
   
    $sql = "UPDATE UploadClientBrief SET Pdf_Name='$RENAME', Pdf_Path='$newpath' WHERE Sr_no='$SR'";
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
  
           $check=mysqli_num_rows(mysqli_query($con,"SELECT * from BreifTimeline_data Where Cid='$SR'"));
           echo $check;
if($check>0){
    

 $sql = "UPDATE from BreifTimeline_data SET Pdf_Name='$RENAME' WHERE Cid='$SR'";
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";

// }
} else {
  echo "Error updating BriefTimline record: " . $con->error;
}
}
else{
    echo "Error in Checking record: " . $con->error;
}

} else {
  echo "Error updating record: " . $con->error;
}


}
else {
   echo "Fail to rename directory";
   
//       $sql = "UPDATE UploadDocs SET DOE ='$Doc',Pdf_Name='$RENAME', Pdf_Path='$newpath' WHERE Sr_no='$SR'";
//if ($con->query($sql) === TRUE) {
//  echo "Record updated successfully";
//} else {
//  echo "Error updating record: " . $con->error;
//}
}
  

?>