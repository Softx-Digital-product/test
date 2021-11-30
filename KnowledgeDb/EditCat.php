<?php

include 'Dp.php';

$Cid = json_decode($_POST['id']);
$Rename= json_decode($_POST['rename']);

echo $Cid;
echo $Rename;

//$Cid=9;
//$Rename="Tax Laws";


$sql = "UPDATE knowledge_categ SET Category='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}

$con->close();

?>
