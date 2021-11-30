<?php

include '../Database/Dp.php';

if(isset($_POST['Subc'])){

$Cid = json_decode($_POST['id']);
$subC= json_decode($_POST['Subc']);


  $sql ="INSERT into knowledge_subcateg (Cid,Sub_Category) 
  VALUES('$Cid','$subC')";
     
if ($con->query($sql) === TRUE) {

     $fq = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
     echo " <option value=''disabled selected>Please Choose Sub Category </option>";
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
  
} else {
  
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    die();
}

if(isset($_POST['rename'])){
    
    $Cid = json_decode($_POST['id']);
$Rename= json_decode($_POST['rename']);


$sql = "UPDATE knowledge_subcateg SET Sub_Category='$Rename' WHERE Sr_no='$Cid'";
if ($con->query($sql) === TRUE) {
 
     $fq = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
        echo " <option value=''disabled selected>Please Choose Sub Category </option>";
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
} else {
  echo "Error updating record: " . $con->error;
}

    
    die();
}

if(isset($_POST['DelSid'])){
    $Cid = json_decode($_POST['DelSid']);

$sql="DELETE FROM knowledge_subcateg WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
     $fq = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
        echo " <option value=''disabled selected>Please Choose Sub Category </option>";
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
}
else{
    echo "Error Deleting record: " . $con->error;
}
    
    die();
}
?>