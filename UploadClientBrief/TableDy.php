<?php

include '../Database/Dp.php';


$data= json_decode($_POST['countryId']);


//$data="SecondCase";
 $sr = 1;
if (isset($data) && !empty($data)) {
   // $query = "SELECT * FROM UploadDocs WHERE Case_Name = ".$data;
 //   SELECT * FROM UploadDocs WHERE Case_Name = "SecondCase"
    // $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE Case_Name = '$data'");
        $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE CaseId = '$data'");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>

<tr>
<!--                            <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                               <td class="text-center" scope="row"style=""><?php echo $row['DOU']?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Client_Name']?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_Name'] ?></td>-->
<!--    <td class="text-center" id="srno" scope="row"style=""><input type="text" value="<?php echo $row['Sr_no']?>"></td>-->
                            <td class="text-center"  scope="row"style=""><?php echo $row['Pdf_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Size'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Pages'] ?></td>
<!--                            <td class="text-center" scope="row"style=""><?php echo $row['DOU'] ?></td>-->
<!--                            <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModal" value="<?php echo $row['Pdf_Path']?>"onclick="view('<?php echo $row['Pdf_Path']?>')">View</a></td>-->
<!--                                <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModal" value="<?php echo $row['Pdf_Path']?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>')">View</a></td>
                           <td class="text-center" scope="row"style=""><a  id="editbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#EditModal" value="<?php echo $row['Sr_no']?>"onclick="edit('<?php echo $row['Sr_no']?>','<?php echo $row['Pdf_Name']?>','<?php echo $row['DOE']?>')">Edit</a></td>
                            
                            <td class="text-center" scope="row"style=""><a class="nav_link" href="CaseDb//EditCase.php/?v=<?php echo $row['Sr_no'] ?>">Edit </a></td>
                           <td class="text-center" scope="row"style=""><a href="UploadClientBrief/DelpdfBrief.php/?n=<?php echo $row['Pdf_Path']?>">Delete </a></td>-->
                       


</tr>


<?php
 $sr++;
        }
}else{
    ?>
<tr>
      <td class="text-center"  scope="row"style=""></td>
                            <td class="text-center" scope="row"style="">First Upload Main Brief </td>
                            <td class="text-center" scope="row"style=""></td>
</tr>

<?php
 //   echo "No Data !!!";
}

die();
}

?>