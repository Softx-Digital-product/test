<?php

include '../Database/Dp.php';

if(isset($_POST['Subc'])){
    
    
$Cid = json_decode($_POST['id']);
$subC= json_decode($_POST['Subc']);

$check=mysqli_num_rows(mysqli_query($con,"SELECT * from Case_SubType where Case_SubType='$subC'"));
if($check>0){
   echo "<br> This Sub Category is already present";
}
else{

  $sql ="INSERT into Case_SubType  (Cid,Case_SubType) VALUES('$Cid','$subC')";
    
if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM Case_SubType");
echo " <option value=''disabled selected>Please Choose Case Sub Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }

} else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

}
    
    die();
}


if(isset($_POST['rename'])){
    
$Cid = json_decode($_POST['id']);
$Rename= json_decode($_POST['rename']);

$sql = "UPDATE Case_SubType SET Case_SubType='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM Case_SubType");
echo " <option value=''disabled selected>Please Choose Case Sub Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }
} else {
  echo "Error updating record: " . $con->error;
}

    
    die();
}

if(isset($_POST['id'])){
    
$Cid = json_decode($_POST['id']);

$sql="DELETE FROM Case_SubType WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
 $fq = mysqli_query($con, "SELECT * FROM Case_SubType");
echo " <option value=''disabled selected>Please Choose Case Sub Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }
}
else{
     echo "Error Deleting record: " . $con->error;
}
    die();
}
?>