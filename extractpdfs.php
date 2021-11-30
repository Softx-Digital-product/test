<?php 
include 'UploadCase/Dp.php';


//$pdfName= $_POST[''];
 $Fpath = $_POST['Path'];
 $Fname= $_POST['Fname'];
 $Spg=$_POST['Start'];
 $Epg= $_POST['End'];
$ClientN=$_POST['Client'];
$CaseN=$_POST['Case'];
$Date=$_POST['Date'];




echo $Fpath;
echo $Fname;
echo $Spg;
echo $Epg;
echo $ClientN;
echo $CaseN;
echo $Date;



set_time_limit(0);
ini_set('memory_limit', '-1');
// Include the main TCPDF library and TCPDI.
require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdf.php');
require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdi.php');

$pdf = new TCPDI();

//$finalpath="../".$Fpath;
//echo $finalpath;
$pageCount = $pdf->setSourceFile($Fpath);

  for ($pageNo = $Spg; $pageNo <= $Epg; $pageNo++) {
        $tplidx = $pdf->importPage($pageNo, '/BleedBox');
		$size = $pdf->getTemplatesize($tplidx);
		$orientation = ($size['w'] > $size['h']) ? 'L' : 'P';
        $pdf->AddPage($orientation);
        $s = $pdf->useTemplate($tplidx, 10, 10, 200);
    }


$file = $Fname.'.pdf';
    echo $file;
//$pdf->Output(__DIR__."//Splited//".$file, 'F');
$pdf->Output(__DIR__."/ClientCaseData/$ClientN/$CaseN/".$file, 'F');
//$data = $pdf->Output(__DIR__."/ClientCaseData/$ClientN/$CaseN/".$file, 'F');


$finaloutpath ="ClientCaseData/$ClientN/$CaseN/$file";
//echo $data;
echo "saved in Dir Outputs";


  $path = $finaloutpath;
       echo($path);
       // $totoalPages=countPages($path);
        $pdftext = file_get_contents($path);
        $pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        echo $pages;
        
        $fileSize = filesize($path);
        
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

        
        echo $fileSize;

        
        $sql="INSERT INTO UploadDocs (DOE,Client_Name,Case_Name,Pdf_Name,Pdf_Size,Pdf_Pages,Pdf_Path,DOU)
           VALUES('$Date','$ClientN','$CaseN','$file','$fileSize','$pages','$path','$Date')";
           
     
if ($con->query($sql) === TRUE) {
  echo "Saved Sucessfully Bro";
     //  header("Refresh:0");
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}




?>