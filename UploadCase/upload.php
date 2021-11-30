<?php
include 'Dp.php';
//
//$file_dir ="ClientCaseData/$clientName/$caseName/";
//    
//    //  $file_name = $_FILES['file']['name'];
//    //  $file_size = $_FILES['file']['size'];
//    //  $file_tmp = $_FILES['file']['tmp_name'];
//    //  $file_type = $_FILES['file']['type'];
//
//
//     foreach($_FILES['file']['name']as $key=>$val){
//      $fileName = basename($_FILES['file']['name'][$key]); 
//      $fileSize= basename($_FILES['file']['size'][$key]);
//      $targetFilePath = $file_dir . $fileName; 
//      if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){
//       // echo "file Uploaded Successfully Bro";
//        $check=mysqli_num_rows(mysqli_query($con,"SELECT * from UploadDocs WHERE Pdf_Name='$fileName'"));
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
//      
//        
//
//      
////  $sql ="INSERT into pdf_manager (Pdf_Name,Pdf_path,Pdf_Size,Pdf_Pages) 
////  VALUES('$fileName','$targetFilePath','$fileSize',$pages)";
//  
//  $sql="INSERT INTO UploadDocs (Client_Name,Case_Name,Pdf_Name,Pdf_Size,Pdf_Pages,Pdf_Path,DOU)
//           VALUES('$clientName','$caseName','$fileName','$fileSize','$pages','$targetFilePath','$date')";
//           
//     
//if ($con->query($sql) === TRUE) {
// // echo "Saved Sucessfully Bro";
//       header("Refresh:0");
//} else {
//  echo "Error: ----->" . $sql . "<br>" . $con->error;
//}
//
//}
//
//      }
//
//        
//
//     }
//    }

    
//}

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
{
    
//    $clientName =($_POST['cln']);
$caseName= strip_tags($_POST['caseName']);
$SR= strip_tags($_POST['clientName']);

echo $SR;

$CN; 
$query = "SELECT * FROM ClientDb WHERE Sr_no = $SR";
echo $query;
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                  
                    $CN=$row['Full_Name'];
                 
                }
    }
//echo $clientName;
//echo $caseName ."<br>";
//echo $CN;




    $vpb_uploaded_files_location ="../ClientCaseData/$CN/$caseName/";
     $loca ="ClientCaseData/$CN/$caseName/";
    
    
	$vpb_file_name = strip_tags($_FILES['upload_file']['name']); //File Name
	$vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
	$vpb_file_size = $_FILES['upload_file']['size']; // File Size
	 //This is the directory where uploaded files are saved on your server
	$vpb_final_location = $vpb_uploaded_files_location . $vpb_file_name; //Directory to save file plus the file to be saved
	//Without Validation and does not save filenames in the database
        
        
	if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
	{
		//Display the file id
		echo $vpb_file_id;
               // echo "Uploaded ";
                $fileName=$vpb_file_name;
                $location=$loca . $vpb_file_name;
                $targetFilePath=$vpb_final_location;
                $fileSize=$vpb_file_size;
                echo $location;
                
                 $check=mysqli_num_rows(mysqli_query($con,"SELECT * from UploadDocs WHERE Pdf_Name='$fileName'"));
        if($check>0){
          $msgs="<br> Pdf is already present";
        // echo $msgs;
      }
      else{
        
          
          if($fileSize >= 1073741824){
                  $fileSize = number_format($fileSize / 1073741824, 2).' GB';
          }
          elseif ($fileSize >= 1048576) {
          $fileSize = number_format($fileSize / 1048576, 2).' MB';
         
      }
      elseif($fileSize >= 1024){
           $fileSize = number_format($fileSize / 1024, 2).' KB';
      }
       elseif($fileSize >= 1){
           $fileSize = $fileSize.'byte';
      }else{
          $fileSize= '0 byte';
      }
          
          
       
        //echo $fileSize;
        
        
        
        
        
        $path = $targetFilePath;
       // echo($path);
       // $totoalPages=countPages($path);
        $pdftext = file_get_contents($path);
        $pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        //echo $pages;
       $date =date("d/m/Y");
      
        
                  
  $sql="INSERT INTO UploadDocs (Client_Name,Case_Name,Pdf_Name,Pdf_Size,Pdf_Pages,Pdf_Path,DOU)
           VALUES('$CN','$caseName','$fileName','$fileSize','$pages','$location','$date')";
           
     
if ($con->query($sql) === TRUE) {
 echo "Saved Sucessfully Bro";
//       header("Refresh:0");
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

}
	}
	else
	{
		//Display general system error
		echo 'general_system_errors';
	}

}
?>