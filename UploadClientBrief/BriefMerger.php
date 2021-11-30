<?php

include 'Dp.php';

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
{
    
//    $clientName =($_POST['cln']);
$caseName= strip_tags($_POST['caseName']);
$SR= strip_tags($_POST['clientName']);

echo $caseName;


$CN; 
$query = "SELECT * FROM UploadClientBrief WHERE Case_Name = '$caseName'";
//echo $query;
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                  
                    $oldpath=$row['Pdf_Path'];
                 
                }
    }
//echo $clientName;
//echo $caseName ."<br>";
    
echo $oldpath;
$Fname = "TempFolder";
  if (!file_exists($Fname)) {
    mkdir($Fname, 0777, true);
    echo "Folder created"; 
    
  }
    else{
     echo "Can't create Folder";
 }

//

//      $path= "../ClientCaseData/$CN/$caseName/";
//      $fpath= $path.$Fname;
//    //echo $fpath;
//// if (!file_exists("../ClientData/$CN/$caseName/.$Fname")) {
////    mkdir("../ClientData/$CN/$caseName/.$Fname", 0777, true);
////    echo "Folder created";
//      
//  if (!file_exists($fpath)) {
//    mkdir($fpath, 0777, true);
//    //echo "Folder created";  
//    
//    
//    
//     
//    
//    
// }
// else{
    // echo "Can't create Folder";
 //}
//    $vpb_uploaded_files_location ="../ClientCaseData/$CN/$caseName/$Fname/";
 $vpb_uploaded_files_location=$fpath."/";
 //echo $vpb_uploaded_files_location;
         
     $loca ="ClientCaseData/$CN/$caseName/$Fname/";
    
    
	$vpb_file_name = strip_tags($_FILES['upload_file']['name']); //File Name
	$vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
	$vpb_file_size = $_FILES['upload_file']['size']; // File Size
	 //This is the directory where uploaded files are saved on your server
	$vpb_final_location = $vpb_uploaded_files_location . $vpb_file_name; //Directory to save file plus the file to be saved
	//Without Validation and does not save filenames in the database
        
        
//	if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
//	{
//		//Display the file id
////		echo $vpb_file_id;
//                
//                
//                //echo "files= $vpb_file_id";
//               // echo "Uploaded ";
//               
//                $fileName=$vpb_file_name;
//                $location=$loca . $vpb_file_name;
//                $targetFilePath=$vpb_final_location;
//                $fileSize=$vpb_file_size;
//              //  echo $location;
//                
//                 $check=mysqli_num_rows(mysqli_query($con,"SELECT * from UploadDocs WHERE Pdf_Name='$fileName'"));
//        if($check>0){
//          $msgs="<br> Pdf is already present";
//        // echo $msgs;
//      }
//      else{
//        
//          
//          if($fileSize >= 1073741824){
//                  $fileSize = number_format($fileSize / 1073741824, 2).' GB';
//          }
//          elseif ($fileSize >= 1048576) {
//          $fileSize = number_format($fileSize / 1048576, 2).' MB';
//         
//      }
//      elseif($fileSize >= 1024){
//           $fileSize = number_format($fileSize / 1024, 2).' KB';
//      }
//       elseif($fileSize >= 1){
//           $fileSize = $fileSize.'byte';
//      }else{
//          $fileSize= '0 byte';
//      }
//          
//          
//       
//        //echo $fileSize;
//        
//        
//        
//        
//        
//        $path = $targetFilePath;
//       // echo($path);
//       // $totoalPages=countPages($path);
//        $pdftext = file_get_contents($path);
//        $pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
//        //echo $pages;
//       $date =date("d/m/Y");
      
       //echo $fileName;
        echo $vpb_file_id;
        
//                  
//  $sql="INSERT INTO UploadClientBrief (DOU,Client_Name,Case_Name,Folder_Name,Pdf_Name,Pdf_Size,Pdf_Pages,Pdf_Path)
//           VALUES('$date','$CN','$caseName','$Fname','$fileName','$fileSize','$pages','$location')";
//           
//  //$vpb_file_id=$fileName;
//     
//if ($con->query($sql) === TRUE) {
// echo "Saved Sucessfully Bro";
//
////       header("Refresh:0");
//} else {
//  echo "Error: ----->" . $sql . "<br>" . $con->error;
//}
//
//}
//	}
//	else
//	{
//		//Display general system error
//		echo 'general_system_errors';
//	}



}
       // }
//}
        
?>



