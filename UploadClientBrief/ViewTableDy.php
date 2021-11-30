<?php

include 'Dp.php';


$data= json_decode($_POST['countryId']);


//$data="SecondCase";
 $sr = 1;
if (isset($data) && !empty($data)) {
   // $query = "SELECT * FROM UploadDocs WHERE Case_Name = ".$data;
 //   SELECT * FROM UploadDocs WHERE Case_Name = "SecondCase"
    $sql="SELECT UploadClientBrief.Sr_no, ClientDb.Full_Name as Client_Name, Client_CaseDb.Case_Name as Case_Name, UploadClientBrief.Pdf_Name,UploadClientBrief.Pdf_Size,UploadClientBrief.Pdf_Pages,UploadClientBrief.DOU FROM UploadClientBrief,Client_CaseDb,ClientDb WHERE UploadClientBrief.CaseId = Client_CaseDb.Sr_no AND Client_CaseDb.Cid= ClientDb.Sr_no AND CaseId = '$data'";
     $quariy = $con->query($sql);
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>

 <tr id="row<?php echo $sr;?>">
                            <th class="text-center " scope="row" style=""><?php echo $sr ?></th>
                               <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['DOU']?>"><?php echo substr($row['DOU'],0,30);?></td>
                            <td class=" text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Client_Name']?>"><?php echo substr($row['Client_Name'],0,40);?></td>
                            <td class=" text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_Name']?>"><?php echo substr($row['Case_Name'],0,40); ?></td>
                            <td class=" text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Pdf_Name']?>"><?php echo substr($row['Pdf_Name'],0,40);?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Pdf_Size']?>"><?php echo substr($row['Pdf_Size'],0,30); ?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Pdf_Pages']?>"><?php echo substr($row['Pdf_Pages'],0,30); ?></td>
<!--                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['DOU']?>"><?php echo $row['DOU'] ?></td>-->
<!--                            <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModal" value="<?php echo $row['Pdf_Path']?>"onclick="view('<?php echo $row['Pdf_Path']?>')">View</a></td>-->
                                <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModal" value="<?php echo $row['Pdf_Path']?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/ClientBrief/<?php echo $row['Pdf_Name']?>','<?php echo $sr;?>')">View</a></td>
                           <td class="text-center" scope="row"style=""><a  id="editbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#EditModal" value="<?php echo $row['Sr_no']?>"onclick="edit('<?php echo $row['Sr_no']?>','<?php echo $row['Pdf_Name']?>','<?php echo $row['DOE']?>')">Edit</a></td>
                            
<!--                            <td class="text-center" scope="row"style=""><a class="nav_link" href="CaseDb//EditCase.php/?v=<?php echo $row['Sr_no'] ?>">Edit </a></td>-->
                           <td class="text-center" scope="row"style=""><a class="text-danger" href="UploadClientBrief/DelpdfBrief.php/?n=<?php echo $row['Pdf_Path']?>">Delete </a></td>
                        </tr>


<?php
 $sr++;
        }
}else{
    echo "No Data !!!";
}
}

?>