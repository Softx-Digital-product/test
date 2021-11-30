<?php

include 'Dp.php';


$data= json_decode($_POST['id']);

$clientName;
$caseName;
$pdfName;

//echo $data;
//$data=50;
//$data="SecondCase";

if (isset($data) && !empty($data)) {
   // $query = "SELECT * FROM UploadDocs WHERE Case_Name = ".$data;
 //   SELECT * FROM UploadDocs WHERE Case_Name = "SecondCase"
     $quariy = $con->query("SELECT * FROM UploadDocs WHERE Sr_no = $data");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                        }
                        }
                        
echo "ClientCaseData/$clientName/$caseName/$pdfName";

}
else{
    echo "no record founded !!!";
}
//echo "ClientCaseData/$clientName/$caseName/$pdfName";


?>