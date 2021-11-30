<?php
include 'UploadCase/Dp.php';

ini_set('session.save_path', 'session');
session_start();
  $sessionV = $_SESSION['username'];
  $tsr= $_SESSION['Tsr'];

  
  if(isset($_POST['delcid'])){
     
      $delq="DELETE FROM Compilation WHERE Sr_no = {$_POST['delcid']}";
     // echo $delq;
      if(mysqli_query($con, $delq)){
 $dels="DELETE FROM Compilation_temp  WHERE Comiplationid = {$_POST['delcid']}";
 if(mysqli_query($con, $dels)){
   echo " Delete Succesfully";
}
else{
    echo "<h3> can't Delect </h3>";
}
          
}
else{
    echo "<h3> can't Delect </h3>";
}
      
      
      die();
  }
  
  
if(isset($_POST['SaveArray'])){
  
//    echo "<pre>";
//    print_r($_POST['SaveArray']);
//    echo "</pre>";
    
    $tableDatas = stripcslashes($_POST['SaveArray']);
    $FileName = json_decode($_POST['Fname']);
$PdfPaths = json_decode($_POST['Pdf']);
 $cid= json_decode($_POST['Cid']);

// Decode the JSON array
$tableDatas = json_decode($tableDatas,TRUE);
    
    
     foreach($tableDatas as $row) {
         
         echo "<pre>";
    print_r($row);
    echo "</pre>";
         
   $checks="SELECT * from Compilation_temp  Where Title  ='{$row['Title']}'  AND Comiplationid = '{$cid}'";
    //echo $checks;
  $check=mysqli_num_rows(mysqli_query($con,$checks));
  //echo $checks;
if($check>0){
  // echo "<br> This DATA is already present";
   
   $updates= "Update Compilation_temp SET Bid= {$row['Bid']}, FTitle = '{$row['Ftitle']}', compileBy ='$tsr' WHERE Title ='{$row['Title']}' AND Comiplationid = '{$cid}' ";
   echo $updates;
   
   if ($con->query($updates) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
 
   
// }
}
else{
 
    $tempPath="PdfManager/{$row['Title']}.pdf";
        $sql ="INSERT into Compilation_temp (Comiplationid,Bid,DOC,Title,FTitle,compileBy,stpg,edpg,Tpg,temp_path) 
  VALUE('$cid','{$row['Bid']}','{$row['date']}','{$row['Title']}','{$row['Ftitle']}','$tsr','{$row['Start']}','{$row['end']}','{$row['total']}','$tempPath')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
 echo 'Added Successfully';
}
else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    
}
    
    
    
     }
    
    
    
    die();
};

 if(isset($_POST['compids'])){
     $cids  = json_decode($_POST['compids']);
     

                                        $sr = 1;
                                       $sql = "SELECT * FROM Compilation_temp, BreifTimeline_data WHERE BreifTimeline_data.Sr_no = Compilation_temp.Bid AND Compilation_temp.Comiplationid = {$cids} ORDER BY STR_TO_DATE(DOC, '%d/%m/%Y' ) ASC";
                                       // $sql="SELECT * FROM Compilation_temp WHERE Comiplationid = {$cids} ORDER BY STR_TO_DATE(DOC, '%d/%m/%Y' ) ASC";
                                       //echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                echo "<pre>";
                                                print_r($row);
                                                echo "</pre>";
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
<!--                                                  
                           <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
<td scope="row" class="p-3 text-center"><?php echo $row['DOC']?></td>
<!--<td scope="row"><?php echo $row['Title']?></td>-->
<td class="p-3 text-nowrap text-center" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Mpg']?>)"data-toggle="tooltip" data-placement="top" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,30); ?></td>
<td class="p-3 d-none" scope="row"><?php echo $row['stpg']?></td>
<td class="p-3 d-none" scope="row"><?php echo $row['edpg']?></td>
<td class=" p-3 text-center" scope="row"><?php echo $row['Tpg']?></td>
<td class=" p-3 text-center" scope="row"><?php echo $row['Bid']?></td>
<td><a class='nav-link text-danger text-center btn_remove'>Rem</a></td>


                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        die();
 }
                                        ?>     
     
                                                
          <?php
          
 if(isset($_POST['newdata'])){
     $cids  = json_decode($_POST['newdata']);
     

                                        $sr = 1;
                                       
                                        $sql="SELECT * FROM Compilation_tempData WHERE Cid = {$cids}";
                                       //echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
<!--                                                  
                           <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
<td scope="row" class="Dates p-3 text-center"><?php echo $row['Doc']?></td>
<!--<td scope="row"><?php echo $row['Title']?></td>-->
<td class="p-3 Titles text-nowrap text-center" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Mpg']?>)"data-toggle="tooltip" data-placement="top" title="<?php echo $row['FTitle']?>"><?php echo substr($row['Title'],0,30); ?></td>
<td class="p-3 d-none" scope="row"><?php echo $row['Spg']?></td>
<td class="p-3 d-none" scope="row"><?php echo $row['Epg']?></td>
<td class="Totals p-3 text-center" scope="row"><?php echo $row['Tpg']?></td>
<td class="d-none" scope="row"><?php echo $row['Bid']?></td>
<td class="Removes"><a class='nav-link text-danger text-center btn_remove'>Rem</a></td>
<td class="d-none"><?php echo $row['FTitle'];?></td>


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
 
 
 $LT = json_decode($_POST['Lt']);
 $LS = json_decode($_POST['Ls']);
 $LF = json_decode($_POST['Lf']);
 $LPY = json_decode($_POST['Lpy']);
 $LC = json_decode($_POST['Lc']);
 $LA = json_decode($_POST['La']);
 
 
 
// echo $LC;
 echo $LS;
 
 echo $LT;
 
 
 
 if($LC =="UPPERCASE"){
     $LT = strtoupper($LT);
  
 }
 if($LC =="lowercase"){
     $LT = strtolower($LT);
    
 }
 if($LC =="First capital"){
     $LT = ucfirst($LT);
 
 }
 if($LC =="All First Capital"){
     $LT = ucwords($LT);
    
 }
 
 
 echo $LT;
 
 
 
 echo $PL;
$datas = $_POST['data'];

//echo "<pre>";
//print_r($datas);
//echo "</pre>";




$tableData = stripcslashes($_POST['data']);

// Decode the JSON array
$tableData = json_decode($tableData,TRUE);



// now $tableData can be accessed like a PHP array

$TitleCheck = $tableData[0]['Title'];
echo $TitleCheck;
echo "==========================";


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
    $n=1;
    
   $x = ord('A');
  // $y ='';
//         for ($x = ord('A'); $x <= ord('B'); $x++){
   
   // $p=0; 
    $f=1;
   
   $delete = "TRUNCATE TABLE Compilation_tempData";
   if ($con->query($delete) === TRUE) {
  echo "Delete successfully";
} else {
  echo "Error in Deleting records: " . $con->error;
}
   
   
 foreach($tableData as $row) {

     
     
     
     echo "<pre>";
     print_r($row);
     echo "</pre>";
     
//     $row['Start'];
//     $row['end'];
     
   
     
     
     
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
        $pdf->SetFontSize($LF);
        
        $fontname = TCPDF_FONTS::addTTFfont('PdfsM/verdana/Verdana Bold.ttf', 'TrueTypeUnicode', '', 96);

$pdf->SetFont ($fontname, 'B', $font_size , '', 'default', true );
//$pdf -> SetY(5);  
        $pdf->SetFillColor(255,255,255);
        
            $pdf->SetY($LPY);
            $pdf->Cell(40);
            if($LA=='true'){
                
                if($LS == 'A,B'){
                 if($y >= '65'){
                      $pdf->Cell(40,10,$LT.' '.chr($x).chr($y),0, 1, 1, 'C',true);
                 }else{
                      $pdf->Cell(40,10,$LT.' '.chr($x),0, 1, 1, 'C',true);
                 }
                     
                    
                 } elseif($LS=='1,2,3') {
                     echo "inside Number --< $n >--";
                 $pdf->Cell(40,10,$LT.' '.$n,0, 1, 1, 'C',true);
//                 $n++;
             } elseif($LS=='A-1') {
                     
                 $pdf->Cell(40,10,$LT.' A-'.$n,0, 1, 1, 'C',true);
             }elseif($LS=='R-1') {
                     
                 $pdf->Cell(50,10,$LT.' R-'.$n,0, 1, 1, 'C',true);
             }elseif($LS=='RJ-1') {
                     
                 $pdf->Cell(60,10,$LT.' RJ-'.$n,0, 1, 1, 'C',true);
             }elseif($LS=='SRJ-1') {
                     
                 $pdf->Cell(40,10,$LT.' SRJ-'.$n,0, 1, 1, 'C',true);
             }

//              $n++;  
                 // $x++;
                
            }else{
                
            
             if($pageNo == $row['Start']){
                  
                 echo "--->".$LS;
                 
                 if($LS == 'A,B'){
                     
                     $pdf->Cell(40,10,$LT.' '.chr($x),0, 1, 1, 'C',true);
                     $x++;
                 }
                 elseif($LS=='1,2,3') {
                   
                     echo "inside Number --< $n>--";
                 $pdf->Cell(40,10,$LT.' '.$n,0, 1, 1, 'C',true);
                  $n++;
                   //$pdf->Cell(60,10,$LT.' '.$n,0, 1, 1, 'C',true);
             } elseif($LS=='A-1') {
                     
                 $pdf->Cell(40,10,$LT.' A-'.$n,0, 1, 1, 'C',true);
                  $n++;
             }elseif($LS=='R-1') {
                     
                 $pdf->Cell(40,10,$LT.' R-'.$n,0, 1, 1, 'C',true);
                  $n++;
             }elseif($LS=='RJ-1') {
                     
                 $pdf->Cell(40,10,$LT.' RJ-'.$n,0, 1, 1, 'C',true);
                  $n++;
             }elseif($LS=='SRJ-1') {
                     
                 $pdf->Cell(60,10,$LT.' SRJ-'.$n,0, 1, 1, 'C',true);
                  $n++;
             }
             
             else{
                 
             }
            
              //  $pdf->Cell(50,10,$LT.' '.$n,0, 1, 1, 'C',true);
            }else{
               
            }
            }
            if($p == 0){
                
            }else{
                $p++;
                
            }
            $f++;
            
            
   // $n++;
   // $x++;
   
    echo "---->x value.$x";
    $y++;
     if($x >= 91){
        echo '-------!!!!!!!!!!! x at 91';
        $x = ord('A');
        $y = ord('A');
        
       // break;
        
    }
  
    
    
   
        
    } //For Loop Ends 
   
//    $n++;
//    $x++;
    
    $file = $row['Title'].'.pdf';
    echo $file;
//$pdf->Output(__DIR__."//Splited//".$file, 'F');
$pdf->Output(__DIR__."/PdfManager/".$file, 'F');
//$data = $pdf->Output(__DIR__."/ClientCaseData/$ClientN/$CaseN/".$file, 'F');


//$finaloutpath ="ClientCaseData/$ClientN/$CaseN/$file";
$tempPath = "PdfManager/$file";
//echo $data;
echo "saved in Dir Outputs";

$path = $tempPath;



// echo($path);
// $totoalPages=countPages($path);
 $pdftext = file_get_contents($path);
 $pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
 
 echo "<Page = $pages >";
 echo '-----> p = '.$p."--> F  $f ";
echo $tableData[0]['Title'];


 array_push($pdfarrays,$tempPath);
 
 
  $checks="SELECT * from Compilation_temp  Where Title  ='{$row['Title']}' AND Comiplationid = '{$cid}'";
   // echo $checks;
  $check=mysqli_num_rows(mysqli_query($con,$checks));
 
 // $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Compilation_temp  Where Title  ='{$row['Title']}'"));
if($check>0){
 //  echo "<br> This DATA is already present";
    if($TitleCheck == $row['Title']) {
$a=1;
echo "=== Inside $TitleCheck ";

$update = "UPDATE Compilation_temp SET Mpg = '$a' Bid ='{$row['Bid']}',FTitle='{$row['Ftitle']}',compileBy ='$tsr'  WHERE Title = '{$row['Title']}' AND Comiplationid = '{$cid}' ";

if ($con->query($update) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}

 $tsql=  $sql ="INSERT into Compilation_tempData (Doc,Title,FTitle,cid,Bid,Mpg,Spg,Epg,Tpg,Path) 
  VALUE('{$row['date']}','{$row['Title']}','{$row['Ftitle']}','$cid','{$row['Bid']}','$a','{$row['Start']}','{$row['end']}','{$row['total']}','$tempPath')";
    if ($con->query($tsql) === TRUE) {
 echo ' T-SQL Added Successfully';
}
else {

  echo " T-SQL Error: ----->" . $tsql . "<br>" . $con->error;
}
$s = $p;
echo $p.'  -- ';
echo $s.'---';






}else{
   $p= $f - $pages;
     $tsql=  $sql ="INSERT into Compilation_tempData (Doc,Title,FTitle,cid,Bid,Mpg,Spg,Epg,Tpg,Path) 
  VALUE('{$row['date']}','{$row['Title']}','{$row['Ftitle']}','$cid','{$row['Bid']}','$p','{$row['Start']}','{$row['end']}','{$row['total']}','$tempPath')";
    if ($con->query($tsql) === TRUE) {
 echo ' T-SQL Added Successfully';
}
else {

  echo " T-SQL Error: ----->" . $tsql . "<br>" . $con->error;
}
    
}
//   $update = "UPDATE Compilation_temp SET Mpg = '$p' WHERE Title = '{$row['Title']}' AND Comiplationid = '{$cid}' ";
//if ($con->query($update) === TRUE) {
//  echo "Record updated successfully";
//} else {
//  echo "Error updating record: " . $con->error;
//}
   
// }
}
else{
    $tsql=  $sql ="INSERT into Compilation_tempData (Doc,Title,FTitle,cid,Mpg,Spg,Epg,Tpg,Path) 
  VALUE('{$row['date']}','{$row['Title']}','{$row['Ftitle']}','$cid','$p','{$row['Start']}','{$row['end']}','{$row['total']}','$tempPath')";
    if ($con->query($tsql) === TRUE) {
 echo ' T-SQL Added Successfully';
}
else {

  echo " T-SQL Error: ----->" . $tsql . "<br>" . $con->error;
}

        $sql ="INSERT into Compilation_temp (Comiplationid,DOC,Title,Mpg,stpg,edpg,Tpg,temp_path) 
  VALUE('$cid','{$row['date']}','{$row['Title']}','$p','{$row['Start']}','{$row['end']}','{$row['total']}','$tempPath')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
 echo 'Added Successfully';
}
else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    
}

// echo '-----> p = '.$p."   ";
 
   if($LA=='true'){
    $n++;
    $x++;
    
    
   }
   //$p++;
    }// Foreach loop ends 
  
 
 echo "================================== Starting of Merging =======================================";
 
// echo "<pre>";
// print_r($pdfarrays);
// echo "</pre>";
 
 
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
//$pdf->addTTFFont('PdfsM/verdana/Verdana Bold.ttf');
        //$fontname = TCPDF_FONTS::addTTFfont('PdfsM/verdana/verdana.ttf', 'TrueTypeUnicode', '', 96);
$fontname = TCPDF_FONTS::addTTFfont('PdfsM/verdana/Verdana Bold.ttf', 'TrueTypeUnicode', '', 96);

$pdf->SetFont ($fontname, 'B', $font_size , '', 'default', true );
//$pdf->SetFont ('helvetica', 'B', $font_size , '', 'default', true );
//        $pdf->SetY(10);
//        $pdf->SetX(180);
//         $pdf->SetY($PY);
//        $pdf->SetX($PX);


$pdf -> SetY(5);  
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
                 
               // $pdf->Cell(20,10,$PL.$sr,0, 1, 1, 'C',true);
//                  $pdf->SetY($LPY);
//            $pdf->Cell(80);
//            $pdf->Cell(50,10,$LT,0, 1, 1, 'C',true);
         $pdf->SetY($PY);
         $pdf->SetX($PX);
             $pdf->Cell(30,10,$PL.$sr,0, 1, 1, 'C',true);
                
            }
            
        }else{
//            $pdf->SetY($LPY);
//            $pdf->Cell(80);
//            $pdf->Cell(50,10,$LT,0, 1, 1, 'C',true);
         $pdf->SetY($PY);
         $pdf->SetX($PX);
             $pdf->Cell(30,10,$PL.$sr,0, 1, 1, 'C',true);
            //  $pdf->Cell(0,0,$PL.$sr,0, 1, 1, 'C',true);
             
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
