<!doctype html>
<html lang="en">
    
    <?php include'headercrm.php'?>
    
    
      <div class="container-fluid p-0" id="VLists">
<!--                 <h2 class="Text-center text-danger">under process</h2>-->
                 
                 <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='UserList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Name</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Email Address" scope="col">UserName</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Client Name</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">Client Email</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">Notes</th>
                                                
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Assign " scope="col">Assign on</th>
<!--                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="view" scope="col">View</th>  -->
<!--                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>   -->
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Unassign</th>   


                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;
//                                         $sql= "SELECT ClientDb.Full_Name, assignteam.AssignNo,ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status,assignteam.Sr_no,assignteam.Client_Name, assignteam.Desc,assignteam.Status,assignteam.assign
//FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name  = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
//                                    
                                   $sql="SELECT ClientDb.Full_Name, assignteam.AssignNo,ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName,TeamMembers.Tid, assignteam.Status,assignteam.Sr_no,assignteam.Client_Name, assignteam.Desc,assignteam.Status,assignteam.assign
FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name  = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
                                        //echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
//                                                   echo "<pre>";
//                                                   print_r($row);
//                                                   echo "</pre>";
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                      <td class="d-none"><?php echo $row['Name'];?></td>
                                                    <td class="d-none"><?php echo $row['Mail_Id'];?></td>-->
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Name']?>"><?php echo $row['Name']." ".$row['Surname']; ?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['UserName']?>"><?php echo substr($row['UserName'],0,50);?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Full_Name']?>"><?php echo $row['Full_Name']; ?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Email']?>"><?php echo $row['Email']; ?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Desc']?>"><?php echo substr($row['Desc'],0,40)?></td>
                                                      <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Status']?>"><?php echo substr($row['Status'],0,30);?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['status']?>"><?php echo $row['assign']; ?></td>
                                                     
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#ViewMember" onclick="viewM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>')">View</a></td>-->
<!--                                                      <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>','<?php echo $row['Advocate_Id']?>')">Edit</a></td>-->
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>')">Edit</a></td>-->
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link "  data-toggle="modal" data-target="#AssignEdit" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']." ".$row['Surname']; ?>','<?php echo $row['Desc']?>','<?php echo $row['Full_Name']?>','<?php echo $row['Status']?>')">Edit</a></td>-->
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link text-danger" onclick="" href="functions.php?U=<?php echo $row['Sr_no']?>&C=<?php echo $row['Client_Name']?>&A=<?php echo $row['AssignNo']?>&Tid=<?php echo $row['Tid']?>">Unassign</a></td>
              
                                                </tr>                                                 

                                                <?php
                                                $sr++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
          

      </div>
                 
                 
                 
                                 </div>
    
    <script>
         $('#vv').removeClass('btns-active');
            $('#tv').addClass('btns-active');
            
                                      $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
            
            $('#UserList').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Team Member"
            }
        });
        
        </script>
</body>
</html>