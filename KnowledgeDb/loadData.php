<?php

include 'Dp.php';

$CID = json_decode($_POST['id']);

//$CID=1;
//echo $CID;

$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg WHERE Cid= '$CID'");

//$stmt= $con->prepare("SELECT * FROM knowledge_subcateg WHERE Cid= '$CID'");
//
//$stmt->execute();
//$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo json_encode($data);
//    
$str="";
    
while($row= mysqli_fetch_all($sql)){
    $str .="<option value='{$row['Sr_no']}'>{$row['Sub_Category']}</option>";
    $str= $row;
}
echo $str;
        
      //  echo json_encode($str);


?>
