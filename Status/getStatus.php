<?php 


ini_set('session.save_path', '../session');
session_start();

include '../UploadCase/Dp.php';

$umail= $_SESSION['username'];

$time = time();

//$sql= mysqli_query($con,"Select * from users_db");



?>
<tr>
     <?php
                                        $sr = 1;
                                        
                                        $quariy = $con->query("SELECT * FROM TeamMembers WHERE status = 'Active'");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                
                                                  $status= 'Idle';
                                                  $class = 'btn-danger';
                                                 $aclass= 'btn-warning text-white';
                                                 $Lclass='btn-info';
                                                  $Attendance = 'Offline';
                                                  $activity= 'offline';
                                                     if($row['last_login']>$time){
                                                               
                                                                $class='btn-success';
                                                                $Attendance='Online';
                                                                 $activity= $row['Active_on'];
                                                                $Lclass='btn-success';
               
                                                           }
                                                       if($row['Attendance']>$time){
                                                            $status='Working';
                                                            $aclass='btn-success';
                                                       }
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                      <td class="d-none"><?php echo $row['Name'];?></td>
                                                    <td class="d-none"><?php echo $row['Mail_Id'];?></td>-->
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Name']?>"><?php echo $row['Name']." ".$row['Surname']; ?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Mail_Id']?>"><?php echo substr($row['Mail_Id'],0,50);?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Phone']?>"><?php echo $row['Phone']; ?></td>
<!--                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['DOB']?>"><?php echo $row['DOB']; ?></td>-->
<!--                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['UserName']?>"><?php echo $row['UserName']; ?></td>-->
<!--                                                      <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Address']?>"><?php echo substr($row['Address'],0,30);?></td>-->
                                                                       <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['last_visit']?>"><?php echo date('d-m-Y h:i A', strtotime($row['last_visit']));?></td>
<!--                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['status']?>"><?php echo $row['status']; ?></td>-->
                                                       <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $class?>'><?php echo $Attendance ?></button></td>
                                                      <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $aclass?>'><?php echo $status ?></button></td>
                                                      
                                                     <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $Lclass?>'><?php echo $activity ?></button></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['ClientN']?>"><?php echo substr($row['ClientN'],0,30);?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['CaseN']?>"><?php echo substr($row['CaseN'],0,30);?></td>
                                                     
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#ViewMember" onclick="viewM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>')">View</a></td>
                                                     -->
                                                     <td scope="row"class="text-center" ><a class="nav_link " href="TeamMembers/Analytics.php">Analytics</a></td>
<!--                                                      <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>','<?php echo $row['Advocate_Id']?>')">Edit</a></td>-->
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>')">Edit</a></td>-->
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link " onclick="" href="EditTeam.php?v=<?php echo $row['Sr_no']?>">Edit</a></td>
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link text-danger" onclick="" href="ClientDb/DelTeamMember.php?v=<?php echo $row['Sr_no']?>">Delete</a></td>
                                                 
              
                                                </tr>

      
     
    <?php
    $sr++;
}
     }
?>
    
   