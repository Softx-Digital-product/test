<?php
include '../Database/Dp.php';


if(isset($_POST['name'])){
   //Add Court Function
    
    $CourtName = json_decode($_POST['name']);
     
    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from CourtDb Where Court_Name ='$CourtName'"));
if($check>0){
   echo "<br> This Type is already present";
}
else{

  $sql ="INSERT into CourtDb (Court_Name) VALUE('$CourtName')";
     
if ($con->query($sql) === TRUE) {

$fq = mysqli_query($con, "SELECT * FROM CourtDb");
echo " <option value=''disabled selected>Please Choose Court</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
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
    
$sql = "UPDATE CourtDb SET Court_Name ='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM CourtDb");
 echo " <option value=''disabled selected>Please Choose Court</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    
} else {
  echo "Error updating record: " . $con->error;
}
    die();
}





if(isset($_POST['id'])){
    
    $Cid = json_decode($_POST['id']);
    
    
$sql="DELETE FROM CourtDb WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
     $fq = mysqli_query($con, "SELECT * FROM CourtDb");
     echo " <option value=''disabled selected>Please Choose Court</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
  
}
else{
    echo "<h3> can't Delect user </h3>";
}
    die();
}

?>