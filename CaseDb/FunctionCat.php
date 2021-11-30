<?php
include '../Database/Dp.php';

if(isset($_POST['name'])){
    
    $Cname= json_decode($_POST['name']);
    
    $sql ="INSERT into knowledge_categ (Category) 
  VALUE('$Cname')";
     
if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM knowledge_categ");
echo " <option value=''disabled selected>Please Choose Case Category</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Category'] . "</option>";
                                    }
  
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    die();
}

if(isset($_POST['rename'])){
    
    $Cid = json_decode($_POST['id']);
$Rename= json_decode($_POST['rename']);


$sql = "UPDATE knowledge_categ SET Category='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM knowledge_categ");
echo " <option value=''disabled selected>Please Choose Case Category</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Category'] . "</option>";
                                    }
                                    
} else {
  echo "Error updating record: " . $con->error;
}

    die();
}

if(isset($_POST['DelCid'])){
    
    $Cid = json_decode($_POST['DelCid']);
    $sql="DELETE FROM knowledge_categ WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
     $fq = mysqli_query($con, "SELECT * FROM knowledge_categ");
echo " <option value=''disabled selected>Please Choose Case Category</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Category'] . "</option>";
                                    }
}
else{
    echo "Error Deleting record: " . $con->error;
}
    die();
}
?>