<?php

include 'Dp.php';


$data= json_decode($_POST['countryId']);


//$data="SecondCase";
 $sr = 1;
if (isset($data) && !empty($data)) {
   // $query = "SELECT * FROM UploadDocs WHERE Case_Name = ".$data;
 //   SELECT * FROM UploadDocs WHERE Case_Name = "SecondCase"
     $quariy = $con->query("SELECT * FROM UploadDocs WHERE Case_Name = '$data'");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>
<tr>
<!--<th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Size'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Pages'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['DOU'] ?></td>
                            <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path']?>"onclick="view('<?php echo $row['Pdf_Path']?>')">View</a></td>
                         <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path']?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>')">View</a>
                          <a  id="viewmodalbtn" type="button"  class="nav_link text-danger"   data-toggle="modal" data-target="#viewerpopup" value="<?php echo $row['Pdf_Path']?>"onclick="viewmodal('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>')">Pop up</a>
                         </td>-->
    
     <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                            <td class="text-center" scope="row"style=""><?php echo $row['DOE'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><a id="extbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#extModal" value="<?php echo $row['Pdf_Path']?>"onclick="ext('<?php echo $row['Pdf_Name']?>','ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>','<?php echo $row['Client_Name']?>','<?php echo $row['Case_Name']?>','<?php echo $row['Sr_no']?>')">Extract</a></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Pages'] ?></td>
<!--                            <td class="text-center" scope="row"style=""><?php echo $row['DOU'] ?></td>-->
<!--                            <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path']?>"onclick="view('<?php echo $row['Pdf_Path']?>')">View</a></td>-->
                         <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path']?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>')">View</a>
                         <a  id="viewmodalbtn" type="button"  class="nav_link text-danger"   data-toggle="modal" data-target="#viewerpopup" value="<?php echo $row['Pdf_Path']?>"onclick="viewmodal('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>')">Pop up</a>
                         </td>
                        </tr>


<?php
 $sr++;
        }
}else{
    echo "No Data !!!";
}
}

?>