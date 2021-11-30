<?php

include 'Dp.php';


$data= json_decode($_POST['countryId']);


//$data="SecondCase";
 $sr = 1;
if (isset($data) && !empty($data)) {
   // $query = "SELECT * FROM UploadDocs WHERE Case_Name = ".$data;
 //   SELECT * FROM UploadDocs WHERE Case_Name = "SecondCase"
     $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Case_Name = '$data'");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>
                                 <tr id="row<?php echo $sr;?>">
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Date'] ?></td>-->
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Doc_type'] ?></td>-->
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,10); ?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Title'] ?></td>-->
                                                                    <td class=" text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,15); ?></td>
                                                    <td class="text-center" scope="row"style="cursor: pointer;">
                                                    <a class="nav_link" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><?php echo $row['St_pg'] ?></a>
                                                    </td>
                                                 
              <td class="text-center" scope="row"style="cursor: pointer;">
                  <a class="nav_link" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)"><?php echo $row['Ed_pg'] ?></a>
                                                   
              </td>
<!--              <td class="text-center" scope="row"style=""><a class="btn btn-sm" onclick="Timelview('<?php echo $row['Cid']?>')">View</a></td>-->
                    <td class="text-center" scope="row"style="cursor: pointer;"><a class="nav_link" onclick="phpviewer('<?php echo $row['Cid']?>','<?php echo $sr;?>')">View</a></td>
<!--                            <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
                    <td class="text-center" scope="row"style=""><a class="nav-link"  href="UploadClientBrief/UpdatetimelineBrief.php?v=<?php echo $row['Sr_no']?>"onclick="">Edit</a>
                                    <a class="nav-link text-danger" href="UploadClientBrief/DelTimelineBrief.php?v=<?php echo $row['Sr_no']?>">Delete</a>
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