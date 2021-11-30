<?php
include 'Dp.php';

if(isset($_GET['n'])){
    $srno= $_GET['n'];
    
    $q="SELECT * FROM UploadClientBrief WHERE Sr_no = '$srno'  ";
    $sql = mysqli_query($con, $q);
     while ($row = $sql->fetch_assoc()) {
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
         $clientName=$row['Client_Name'];
         $caseName= $row['Case_Name'];
         $PdfName= $row['Pdf_Name'];
     }
     $Fpath="../ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
     
 if (!unlink($Fpath)) { 
    
    echo ("$Fpath cannot be deleted due to an error"); 
} 
else { 
    echo ("$Fpath has been deleted"); 
}
$sql="DELETE FROM UploadClientBrief WHERE Sr_no = '$srno'";
if(mysqli_query($con, $sql)){
  
   echo " Delete Succesfully";
     header("Location:http://apajuris.in/work/ClientBrief.php");
     die();
   
} else{
    echo "<h3> can't Delect pdf </h3>";
}
     
    
    die();
}

//
//$id = $_GET['n'];
//
//echo  $id;
//
//   
//   $path = "../$id";
//if (!unlink($path)) { 
//    
//    echo ("$path cannot be deleted due to an error"); 
//} 
//else { 
//    echo ("$path has been deleted"); 
//    
//    $sql="DELETE FROM UploadClientBrief WHERE Pdf_Path = '$id'";
//if(mysqli_query($con, $sql)){
//  
//   echo " Delete Succesfully";
//     header("Location:http://apajuris.in/work/ClientBrief.php");
//     die();
//   
//} else{
//    echo "<h3> can't Delect pdf </h3>";
//}
//  
//}
//
//mysqli_close($con);
?>
