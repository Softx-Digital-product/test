<?php
include 'UploadCase/Dp.php';

 if(isset($_POST['compids'])){
     $cids  = json_decode($_POST['compids']);
     $cName= json_decode($_POST['Cname']);
     
     

                                        $sr = 1;
//                                        $sql="SELECT * ,BreifTimeline_data.Title as Btitle FROM Compilation_temp, BreifTimeline_data
//WHERE BreifTimeline_data.Sr_no = Compilation_temp.Bid AND Compilation_temp.Comiplationid = {$cids} ";
                                      // $sql = "SELECT * FROM Compilation_temp, BreifTimeline_data WHERE BreifTimeline_data.Sr_no = Compilation_temp.Bid AND Compilation_temp.Comiplationid = {$cids} ORDER BY STR_TO_DATE(DOC, '%d/%m/%Y' ) ASC";
                                        $sql="SELECT * FROM Compilation_temp WHERE Comiplationid = {$cids} ORDER BY STR_TO_DATE(DOC, '%d/%m/%Y' ) ASC";
                                       //echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
<!--                                                  
                           <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
<td scope="row" class="Dates p-1 mt-2 text-center"><?php echo $row['DOC']?></td>
<!--<td scope="row"><?php echo $row['Title']?></td>-->
<td class="Titles p-2 text-nowrap text-center" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['stpg']?>)"data-toggle="tooltip" data-placement="top" title="<?php echo $row['FTitle']?>"><?php echo substr($row['Title'],0,30); ?></td>
<td class="p-2 d-none" scope="row"><?php echo $row['stpg']?></td>
<td class="p-2 d-none" scope="row"><?php echo $row['edpg']?></td>
<td class="Totals p-1 text-center" scope="row"><?php echo $row['Tpg']?></td>
<td class="d-none" scope="row"><?php echo $row['Bid']?></td>
<td class="Removes"><a class=" p-1  nav-link text-danger text-center btn_remove">Rem</a></td>
<td class="d-none"><?php echo $row['FTitle']?></td>


                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        die();
 }
                                        ?>     
     
 
<?php

 if(isset($_POST['compiname']))
        {
        $data= json_decode($_POST['compiname']);
         $client= json_decode($_POST['Client']);
          $case= json_decode($_POST['Case']);
         

//        echo $data;
//        echo $client;
//        echo $case;
          $data=$data.".pdf";
        
      $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Compilation Where Cname='$data'"));
if($check>0){
   echo "<br> This DATA is already present";
 
   
// }
}
else{

  $sql ="INSERT into Compilation (Cname,Client_Name,Case_Name) 
  VALUE('$data','$client','$case')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
  //echo "Add Sucessfully";
    // header("Refresh:0");
     //header("Location:http://apajuris.in/work/viewbriefs.php?v={$sr}");
       //die();
     
}
else {

  //echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
}  
 die();
        }


        


$myArray = json_decode($_POST['array']);
$FileName = json_decode($_POST['Fname']);
$PdfPaths = json_decode($_POST['Pdf']);
 $cid= json_decode($_POST['Cid']);
 
 
 $PL = json_decode($_POST['Pl']);
 $PS = json_decode($_POST['Ps']);
 $PX = json_decode($_POST['Px']);
 $PY = json_decode($_POST['Py']);
 $PE = json_decode($_POST['Pe']);
 $PF = json_decode($_POST['Pf']);
 
 
 echo $PL;
$datas = $_POST['data'];

//echo "<pre>";
//print_r($datas);
//echo "</pre>";




$tableData = stripcslashes($_POST['data']);

// Decode the JSON array
$tableData = json_decode($tableData,TRUE);

// now $tableData can be accessed like a PHP array

//echo $tableData[2]['Title'];

$pdfarrays= array();

set_time_limit(0);
ini_set('memory_limit', '-1');
// Include the main TCPDF library and TCPDI.
require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdf.php');
require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdi.php');

$pdf = new TCPDI();

  $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
// $pdf->SetAutoPageBreak(TRUE, 40);
//  $pdf->setPrintFooter(TRUE);
    
 foreach($tableData as $row) {
     
     
     
     echo "<pre>";
     print_r($row);
     echo "</pre>";
     
     
//set_time_limit(0);
//ini_set('memory_limit', '-1');
//// Include the main TCPDF library and TCPDI.
//require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdf.php');
//require_once('PdfsM/fpdi_working/vendor/setasign/tcpdf/tcpdi.php');

$pdf = new TCPDI();
     
 
      $pageCount = $pdf->setSourceFile($PdfPaths);

  for ($pageNo = $row['Start']; $pageNo <= $row['end']; $pageNo++) {
        $tplidx = $pdf->importPage($pageNo, '/BleedBox'); 
	 $size = $pdf->getTemplatesize($tplidx);
		$orientation = ($size['w'] > $size['h']) ? 'L' : 'P';
        $pdf->AddPage($orientation);
       // $pdf->AddPage();
        //$s = $pdf->useTemplate($tplidx, 10, 10, 200);
        $s = $pdf->useTemplate($tplidx);
       
        
    }
    $file = $row['Title'].'.pdf';
    echo $file;
//$pdf->Output(__DIR__."//Splited//".$file, 'F');
$pdf->Output(__DIR__."/PdfManager/".$file, 'F');
//$data = $pdf->Output(__DIR__."/ClientCaseData/$ClientN/$CaseN/".$file, 'F');


//$finaloutpath ="ClientCaseData/$ClientN/$CaseN/$file";
$tempPath = "PdfManager/$file";
//echo $data;
echo "saved in Dir Outputs";

 array_push($pdfarrays,$tempPath);

 
  $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Compilation_temp  Where Title  ='{$row['Title']}'"));
if($check>0){
   echo "<br> This DATA is already present";
 
   
// }
}
else{

        $sql ="INSERT into Compilation_temp (Comiplationid,DOC,Title,FTitle,compileBy,stpg,edpg,Tpg,temp_path) 
  VALUE('$cid','{$row['date']}','{$row['Title']}','coming','$tsr','{$row['Start']}','{$row['end']}','{$row['total']}','$tempPath')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
 echo 'Added Successfully';
}
else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    
}
     
//      $query .= 
//                "INSERT INTO Compilation_temp (Comiplationid,DOC,Title,stpg,edpg) VALUES 
//                ('".$cid."','".$row["date"]."', '".$row["Title"]."', 
//                '".$row["Start"]."','".$row["end"]."'); ";
     // $titles= $row['Title'];
      
      
      
 }
 
 //echo $query;
 
//if(mysqli_multi_query($con, $query)) {
//                echo '<h3>Inserted Data</h3><br />';
//}
 
 
 
 echo "<pre>";
 print_r($pdfarrays);
 echo "</pre>";
 
 
 $files= $pdfarrays;
 $pdf = new TCPDI();
 
   $sr =$PS;
 foreach ($files as $file) {
     
    $pageCount = $pdf->setSourceFile($file);
 $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

     for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    
////        for ($pageNo = $Spg; $pageNo <= $Epg; $pageNo++) {
$tplidx = $pdf->importPage($pageNo, '/BleedBox');
         // $s = $pdf->useTemplate($tplidx, 10, 10, 200);
//          $pageId = $pdf->importPage($pageNo, '/MediaBox');
//            $s = $pdf->useTemplate($pageId, 10, 10, 200);
		$size = $pdf->getTemplatesize($tplidx);
		$orientation = ($size['w'] > $size['h']) ? 'L' : 'P';
        $pdf->AddPage($orientation);
       // $pdf->AddPage();
        //$s = $pdf->useTemplate($tplidx, 10, 10, 200);
        $s = $pdf->useTemplate($tplidx);
        //$font_size = $pdf->pixelsToUnits('30');
        $pdf->SetFontSize($PF);
//$pdf->addTTFFont('PdfsM/verdana/verdana.ttf');
        $fontname = TCPDF_FONTS::addTTFfont('PdfsM/verdana/verdana.ttf', 'TrueTypeUnicode', '', 96);


$pdf->SetFont ($fontname, 'B', $font_size , '', 'default', true );
//$pdf->SetFont ('helvetica', 'B', $font_size , '', 'default', true );
//        $pdf->SetY(10);
//        $pdf->SetX(180);
         $pdf->SetY($PY);
        $pdf->SetX($PX);
        $pdf->SetFillColor(255,255,255);
       // $pdf->SetFont('Verdana', 'B', 16);
       // $pdf->Cell(20,10,$PL.$pdf->pageNo(),0, 1, 1, 'C',true);
       
//        echo $sr;
        // $pdf->Cell(15,10,$PL.$sr,0, 1, 1, 'C',true);
        
       // echo 'exclude--> '.$PE;
        if($PE == 'true'){
            if($pdf->pageNo() == 1){
//                $sr="";
//                $PL="";
//                $pdf->Cell(0,0,$PL.$sr,0, 1, 1, 'C',true);
            }else{
              
                $pdf->Cell(20,10,$PL.$sr,0, 1, 1, 'C',true);
            }
            
        }else{
             $pdf->Cell(20,10,$PL.$sr,0, 1, 1, 'C',true);
        }
       
        
        $sr++;
        //echo $sr;
    }
     }
 

// //$file = uniqid().'.pdf';

$file = $FileName;
echo $file;
    
$pdf->Output(__DIR__."/PdfManager/".$file, 'F');
        
       // $pdf->Output(__DIR__."/ClientCaseData/$clientName/$caseName/ClientBrief/".$file, 'F');
echo "saved in Dir Outputs";
 
echo "==================================================";
//$Finalarray = split("\ ", $myArray); 

//$chunks = array_chunk($myArray, 3);
//foreach ($chunks as $chunk) {
//  // Build your insert string
//    echo "-->".$chunk;
//    //print_r($chunk);
//    $insertString  = 'INSERT INTO myTable(col1, col2, col3, col4) VALUES ';
//    
//}
function mysqli_real_escape_function($val){
//    echo "<pre>";
//    print_r($val);
//    echo "</pre>";
    return $val;
}
$insertString  = 'INSERT INTO Compilation_temp(Title, stpg, edpg) VALUES (';
$chunks = array_chunk($myArray, 3);

foreach ($chunks as $chunk) {
  foreach($chunk as $val){
    foreach($val as $val1){
          echo "-->".$val1;
           $insertString .= ' '. implode(',', array_map(null,$val)) . ',';
    }
  }
   // $newArray= array_map(null,$chunks);
//     $insertString .= ' (' . implode(',', array_map(null, $chunk)) . '),';
    //$insertString .= ' (' . implode(',', array_map('recursive_escape',$chunk)) . ',';
//     $arr = array_map(function($el){ return $el['tag_id']; }, $newArray);
//$str = implode(',', $newArray[2]);
     $str = implode(',', array_map(function($el){ return $el['tag_id']; }, $chunks));
}

$insertString = substr($insertString, 0, -1);

//    echo "<pre>";
//    print_r($chunks);
//    echo "</pre>";
//echo $chunks[0][0][0];
//foreach ($chunks as $val) {
//    foreach($val as $val2){
//        foreach($val2 as $val3){
//            echo $val3."<br>";
//            
//        }
//    }
//    
//}
//    
$sql= "$insertString);";
echo $sql;

echo $PdfPaths;
echo "<br>";
echo $FileName;
echo "<pre>";
//print_r(array_chunk($myArray,3,true));
//print_r($myArray);
echo "</pre>";

?>