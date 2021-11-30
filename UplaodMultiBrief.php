<?php

include 'Timeline/Dp.php';
 $Filelists=array();
 echo "!!!! Before Starting !!!!";
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
{
    
//    $clientName =($_POST['cln']);
$caseName= strip_tags($_POST['caseName']);
$SR= strip_tags($_POST['clientName']);
$totalfiles= strip_tags($_POST['totalfiles']);
echo $caseName;


$CN; 
$query = "SELECT * FROM UploadClientBrief WHERE Case_Name = '$caseName'";
echo $query;
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
//                  $clientName=$row['Client_Name'];
//                    $oldpath=$row['Pdf_Path'];
//                    $pdfName=$row['Pdf_Name'];
                        
                     $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                 
                }
    }
    $oldpath="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
     array_push($Filelists,$oldpath);
//echo "-->clientName".$clientName;
//echo $caseName ."<br>";
    
//echo $oldpath;
$Fname = "TempFolder";
  if (!file_exists($Fname)) {
    mkdir($Fname, 0777, true);
    echo "Folder created"; 
    
  }
    else{
     //echo "Can't create Folder";
 }


    $vpb_uploaded_files_location ="$Fname/";
 $vpb_uploaded_files_location=$Fname."/";
 //echo $vpb_uploaded_files_location;
         
     $loca ="$Fname/";
    
    
	$vpb_file_name = strip_tags($_FILES['upload_file']['name']); //File Name
	$vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
	$vpb_file_size = $_FILES['upload_file']['size']; // File Size
	 //This is the directory where uploaded files are saved on your server
	$vpb_final_location = $vpb_uploaded_files_location . $vpb_file_name; //Directory to save file plus the file to be saved
	//Without Validation and does not save filenames in the database
        
        echo "File size ---> ".$vpb_file_size;
	if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
	{
		//Display the file id
		
                $fileName=$vpb_file_name;
                $location=$loca . $vpb_file_name;
                 $fileSize=$vpb_file_size;
                 
                echo "--->".$location;
                
                
                
                
                
                
                $sql ="INSERT into Temp_data (Case_Name,Temp_Path) 
  VALUE('$caseName','$location')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
 echo 'Added Successfully';
}
else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
                





$query = "SELECT * FROM Temp_data WHERE Case_Name = '$caseName'";
////echo $query;
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                 $clientName=$row['Client_Name'];
                    $Temp_Paths=$row['Temp_Path'];
                   $pdfName=$row['Pdf_Name'];
                   
                   
                     array_push($Filelists,$Temp_Paths);
                     
                     
                 
                }
    }
    //array_push($Filelists,$Temp_Paths);
    print_r($Filelists);
               
//               
//               $sql="DELETE FROM Temp_data WHERE Case_Name = '$caseName'";
//if(mysqli_query($con, $sql)){
//
//   echo " Delete Succesfully";
//}
//else{
//    echo "<h3> can't Delect Paths </h3>";
//}

//                
//                   echo $vpb_file_id;   
//                   
//                   
//                      
//        $arraysize = count($Filelists);
//    echo $arraysize;
                    
        }else{
            
        }
        
            $totalfiles++;
    
    echo "total files".$totalfiles;
    $arraysize = count($Filelists);
    $FinalArray = "_!r".$arraysize;
    $FinalTotal = "_!r".$totalfiles;
    
    if($FinalTotal == $FinalArray){
        
        
        
        
         $sql="DELETE FROM Temp_data WHERE Case_Name = '$caseName'";
if(mysqli_query($con, $sql)){

   echo " Delete Succesfully";
}
else{
    echo "<h3> can't Delect Paths </h3>";
}


          echo $FinalArray;
        
    }else{
        echo "!!!!! ----- Can't Run !!!!!"; 
    }
         echo $vpb_file_id;
       
        echo $FinalArray;
   
//                
//                set_time_limit(0);
//ini_set('memory_limit', '-1');
//// Include the main TCPDF library and TCPDI.
//require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdf.php');
//require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdi.php');
//
//$pdf = new TCPDI();

//$files = [
//    $oldpath,
//        $location,
//];
//
//$files= $Filelists;
//
//
//foreach ($files as $file) {
//    $pageCount = $pdf->setSourceFile($file);
// $pdf->setPrintHeader(false);
//    $pdf->setPrintFooter(false);
//    
//     for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
////        for ($pageNo = $Spg; $pageNo <= $Epg; $pageNo++) {
//$tplidx = $pdf->importPage($pageNo, '/BleedBox');
         // $s = $pdf->useTemplate($tplidx, 10, 10, 200);
//          $pageId = $pdf->importPage($pageNo, '/MediaBox');
//            $s = $pdf->useTemplate($pageId, 10, 10, 200);
//		$size = $pdf->getTemplatesize($tplidx);
//		$orientation = ($size['w'] > $size['h']) ? 'L' : 'P';
//        $pdf->AddPage($orientation);
       // $pdf->AddPage();
        //$s = $pdf->useTemplate($tplidx, 10, 10, 200);
//        $s = $pdf->useTemplate($tplidx);
//    }
//}

// //$file = uniqid().'.pdf';

//$file = $pdfName;
//echo $file;
//    

//$pdf->Output(__DIR__."/TempFolder/".$file, 'F');
//ClientCaseData/$CN/$caseName/$Fname/
//        
//        $pdf->Output(__DIR__."/ClientCaseData/$clientName/$caseName/ClientBrief/".$file, 'F');
//echo "saved in Dir Outputs";

//$finaloutpath= "ClientCaseData/$clientName/$caseName/ClientBrief/".$file;
// $path = $finaloutpath;
//       echo($path);
//       // $totoalPages=countPages($path);
//        $pdftext = file_get_contents($path);
//        $pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
//        echo $pages;
//        
//        $fileSize = filesize($path);
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
//        echo $fileSize;
//
//        
//      $sql = "UPDATE UploadClientBrief SET Pdf_Size='$fileSize',Pdf_Pages='$pages' WHERE Pdf_Name='$pdfName'";
//                
//     
//if ($con->query($sql) === TRUE) {
//  echo "Saved Sucessfully Bro";
//     //  header("Refresh:0");
//} else {
//  echo "Error: ----->" . $sql . "<br>" . $con->error;
//}
//
//
//
//
//
//
//
//
//
//   $path = "$location";
//if (!unlink($path)) { 
//    
//    echo ("$path cannot be deleted due to an error"); 
//} 
//else { 
//    echo ("$path has been deleted"); 
//    
//}
//    
//
//                
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
      //  echo $vpb_file_id;
        
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



//}

//    echo "--------- End of Code ------------";
//    $totalfiles++;
//    
//    echo "total files".$totalfiles;
//    $arraysize = count($Filelists);
//    echo $arraysize;
//    if($totalfiles == $arraysize){
//        
//        
//                
//                set_time_limit(0);
//ini_set('memory_limit', '-1');
//// Include the main TCPDF library and TCPDI.
//require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdf.php');
//require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdi.php');
//
//$pdf = new TCPDI();
//
////$files = [
////    $oldpath,
////        $location,
////];
//
//$files= $Filelists;
//
//
//foreach ($files as $file) {
//    $pageCount = $pdf->setSourceFile($file);
// $pdf->setPrintHeader(false);
//    $pdf->setPrintFooter(false);
//    
//     for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
//////        for ($pageNo = $Spg; $pageNo <= $Epg; $pageNo++) {
//$tplidx = $pdf->importPage($pageNo, '/BleedBox');
//         // $s = $pdf->useTemplate($tplidx, 10, 10, 200);
////          $pageId = $pdf->importPage($pageNo, '/MediaBox');
////            $s = $pdf->useTemplate($pageId, 10, 10, 200);
//		$size = $pdf->getTemplatesize($tplidx);
//		$orientation = ($size['w'] > $size['h']) ? 'L' : 'P';
//        $pdf->AddPage($orientation);
//       // $pdf->AddPage();
//        //$s = $pdf->useTemplate($tplidx, 10, 10, 200);
//        $s = $pdf->useTemplate($tplidx);
//    }
//}
//
//// //$file = uniqid().'.pdf';
//
//$file = $pdfName;
//echo $file;
//    
//
////$pdf->Output(__DIR__."/TempFolder/".$file, 'F');
////ClientCaseData/$CN/$caseName/$Fname/
//        
//        $pdf->Output(__DIR__."/ClientCaseData/$clientName/$caseName/ClientBrief/".$file, 'F');
//echo "saved in Dir Outputs";
//
//
//$finaloutpath= "ClientCaseData/$clientName/$caseName/ClientBrief/".$file;
// $path = $finaloutpath;
//       echo($path);
//       // $totoalPages=countPages($path);
//        $pdftext = file_get_contents($path);
//        $pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
//        echo $pages;
//        
//        $fileSize = filesize($path);
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
//        echo $fileSize;
//
//        
//      $sql = "UPDATE UploadClientBrief SET Pdf_Size='$fileSize',Pdf_Pages='$pages' WHERE Pdf_Name='$pdfName'";
//                
//     
//if ($con->query($sql) === TRUE) {
//  echo "Saved Sucessfully Bro";
//     //  header("Refresh:0");
//} else {
//  echo "Error: ----->" . $sql . "<br>" . $con->error;
//}
//
//
//
//
//
//
//
//
//
//   $path = "$location";
//if (!unlink($path)) { 
//    
//    echo ("$path cannot be deleted due to an error"); 
//} 
//else { 
//    echo ("$path has been deleted"); 
//    
//}
//    
//
//           echo $vpb_file_id;    
//
//
//
//               $sql="DELETE FROM Temp_data WHERE Case_Name = '$caseName'";
//if(mysqli_query($con, $sql)){
//
//   echo " Delete Succesfully";
//}
//else{
//    echo "<h3> can't Delect Paths </h3>";
//}
//        
//        
//    }else{
//        
//        echo "Can't Work";
//    }
       // }
}
        
?>



