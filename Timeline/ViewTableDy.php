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
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                                                    <td class="d-none"><?php echo $row['Client_Name'];?></td>
                                                    <td class="d-none"><?php echo $row['Case_Name'];?></td>
                                                    <td class="text-center text-nowrap" scope="row"style=""><?php echo $row['DOE'] ?></td>
                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip-tip" title="<?php echo $row['Pdf_Name']?>"><?php echo substr($row['Pdf_Name'],0,30);?></td>
                                                    <td class="text-center text-nowrap" scope="row"style=""><?php echo $row['Pdf_Pages'] ?></td>
                                                    <td class="text-center text-nowrap" scope="row"style=""><a id="Createbtn"  href="#LTN"type="button"  class="nav_link"   data-toggle="modal" data-target="#TimelineModal" value="<?php echo $row['Pdf_Path'] ?>"onclick="timelines('<?php echo $row['Pdf_Name'] ?>', 'ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>', '<?php echo $row['Client_Name'] ?>', '<?php echo $row['Case_Name'] ?>', '<?php echo $row['Sr_no'] ?>')">Create</a></td>
                                 <!--<td class="text-center" scope="row"style=""><?php echo $row['DOU'] ?></td>-->
                                 <!--                            <td class="text-center" scope="row"style=""><a  id="Createbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" onclick="timelines('<?php echo $row['Pdf_Path'] ?>')">create</a></td>-->
<!--                                                    <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path'] ?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>')">View</a>-->
                                                       <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path'] ?>"onclick="phpviewer('ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>')">View</a>
                           <!--                           <td class="text-center" scope="row"style=""><a id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path'] ?>"onclick="view('<?php echo $row['Pdf_Name'] ?>','ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>','<?php echo $row['Client_Name'] ?>','<?php echo $row['Case_Name'] ?>','<?php echo $row['Sr_no'] ?>')">View</a>-->

                                                        <a  id="viewmodalbtn" type="button"  class="nav_link text-danger"   data-toggle="modal" data-target="#viewerpopup" value="<?php echo $row['Pdf_Path'] ?>"onclick="viewmodal('ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>')">Pop up</a>
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