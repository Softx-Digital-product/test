<?php
include 'Dp.php';
$id = $_GET['n'];

echo  $id;

   
   $path = "../$id";
if (!unlink($path)) { 
    
    echo ("$path cannot be deleted due to an error"); 
} 
else { 
    echo ("$path has been deleted"); 
    
    $sql="DELETE FROM UploadDocs WHERE Pdf_Path = '$id'";
if(mysqli_query($con, $sql)){
  
   echo " Delete Succesfully";
     header("Location:http://apajuris.in/work/uploadcasedoc.php");
    die();
   
} else{
    echo "<h3> can't Delect pdf </h3>";
}
  
}

mysqli_close($con);
?>
