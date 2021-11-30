<?php 




 include('../ClientDb/Dp.php');

if(isset($_POST['method']) && !empty($_POST['method'])) {
    
    
$Name = json_decode($_POST['name']);
$method= json_decode($_POST['method']);

//       $method= $_POST['method'];
//    $Name= $_POST['name'];
    echo $Name;
    echo $method;
    
    
    switch($method) {
        case 'AddCourt' : AddCourt($Name);break;
        case 'RemCourt' : RemCourt($id);break;
        // ...etc...
    }
}

function AddCourt($Name){
    echo "Function -> .$Name";
    
$check=mysqli_num_rows(mysqli_query($con,"SELECT * FROM CourtDb WHERE Court_Name='$Name'"));
echo $check;
if($check>0){
   $msgs="<br> This Type is already present";
  echo $msgs;
   
// }
}
else{

  $sql ="INSERT into CourtDb (Court_Name) 
  VALUE('$Name')";
     
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
  
 

  //echo $_SESSION["mail"];
 
  echo "Saved Sucessfully Bro";
  
} else {
  $msgs =  "Error: ----->" . $sql . "<br>" . $con->error;
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
}

}

function RemCourt($id){
    echo "Function -> .$id"; 
}

?>