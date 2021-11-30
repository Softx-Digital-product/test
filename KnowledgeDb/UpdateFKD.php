<?php
include('Dp.php');
$SR=$_POST['sr'];
$Date = $_POST['Date'];
$cc = $_POST['CC_text'];
$ct =$_POST['CT_text'];
$cs= $_POST['SC_text'];
$kc= $_POST['editor'];
$Title= $_POST['title'];

//s
//echo $SR;
//echo $cc;
//echo $Date;
//echo $Title;
//echo $kc;


$sql = "UPDATE knowledge_data SET K_Category='$cc', K_Sub_Category='$cs', K_Date='$Date', K_Type='$ct',K_Title='$Title', K_Content='$kc' WHERE Sr_no='$SR'";
//echo $sql;
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
   header("Location:http://apajuris.in/work/TestingDS.php");
} else {
  echo "Error updating record: " . $con->error;
   header("Location:http://apajuris.in/work/TestingDS.php");
}

$con->close();



?>