<?php
include 'Dp.php';

if(isset($_POST['AddDocTy'])){
    $Tname= json_decode($_POST['AddDocTy']);
    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Document_type Where Document_name ='$Tname'"));
if($check>0){
   echo "<br> This Type is already present";
}
else{
    
  $sql ="INSERT into Document_type (Document_name) VALUE('$Tname')";
if ($con->query($sql) === TRUE) {
    
$fq = mysqli_query($con, "SELECT * FROM Document_type");
      echo " <option value='' disabled selected>Choose Document Type </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                    }

} else {
 echo "Error: ----->" . $sql . "<br>" . $con->error;
}
}
   
    die();
}

if(isset($_POST['EditDocTy'])){
    
    $Cid = json_decode($_POST['EditDocTy']);
$Rename= json_decode($_POST['rename']);

$sql = "UPDATE Document_type SET Document_name='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM Document_type");
      echo " <option value='' disabled selected>Choose Document Type </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                    }
} else {
  echo "Error updating record: " . $con->error;
}


    die();
}
if(isset($_POST['DelDocTy'])){
    
    
    $Cid = json_decode($_POST['DelDocTy']);

$sql="DELETE FROM Document_type WHERE Sr_no = '$Cid'";
if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM Document_type");
      echo " <option value='' disabled selected>Choose Document Type </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                    }
} else {
  echo "Error updating record: " . $con->error;
}
    
    die();
}

?>