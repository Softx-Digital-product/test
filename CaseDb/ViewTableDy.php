<?php

include 'Dp.php';


$data= json_decode($_POST['countryId']);


//$data="SecondCase";
 $sr = 1;
if (isset($data) && !empty($data)) {
   // $query = "SELECT * FROM UploadDocs WHERE Case_Name = ".$data;
 //   SELECT * FROM UploadDocs WHERE Case_Name = "SecondCase"
     $quariy = $con->query("SELECT * FROM Client_CaseDb WHERE Cid = $data");
   // echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>
<tr>
 <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                            <td class="text-center" scope="row"style=""><?php echo $row['Client_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Court_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_Type'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_SubType'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_Number'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_Year'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_Desc'] ?></td>

                            <td class="text-center" scope="row"style=""><a class="nav_link" href="CaseDb//EditCase.php/?v=<?php echo $row['Sr_no'] ?>">Edit </a></td>
                      <!--      <td class="text-center"  scope="row"style=""><a id="editbtn" class="nav_link" data-toggle="modal" data-target="#EditClient" onclick="data('<?php echo $row['Full_Name'] ?>','<?php echo $row['Type'] ?>','<?php echo $row['Mobile'] ?>','<?php echo $row['Email'] ?>','<?php echo $row['Address'] ?>','<?php echo $row['Sr_no'] ?>');">Edit</a>-->
                            <td class="text-center" scope="row"style=""><a href="CaseDb/DelCase.php/?n=<?php echo $row['Case_Path']?>">Delete </a></td>
       
                         
                        </tr>


<?php
 $sr++;
        }
}else{
    echo "No Data !!!";
}
}

?>