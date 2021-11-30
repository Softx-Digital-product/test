<?php
include '../Database/Dp.php';

if(isset($_POST['name'])){
    $Tname= json_decode($_POST['name']);
    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Case_Type Where Case_Type='$Tname'"));
if($check>0){
   echo "<br> This Type is already present";
}
else{

  $sql ="INSERT into Case_Type (Case_Type) VALUE('$Tname')";
if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM Case_Type");
echo " <option value=''disabled selected>Please Choose Case Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
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

$sql = "UPDATE Case_Type SET Case_Type='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM Case_Type");
echo " <option value=''disabled selected>Please Choose Case Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
  
  
} else {
  echo "Error updating record: " . $con->error;
}
    
    die();
}

if(isset($_POST['DelTid'])){
    
    $Cid = json_decode($_POST['DelTid']);
    
$sql="DELETE FROM Case_Type WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
    $fq = mysqli_query($con, "SELECT * FROM Case_Type");
echo " <option value=''disabled selected>Please Choose Case Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
 
}
else{
echo "Error deleting record: " . $con->error;
}
    
    die();
}



?>