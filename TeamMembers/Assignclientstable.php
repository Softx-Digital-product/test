<?php

include '../UploadCase/Dp.php';
if(isset($_POST['clientassgin'])){
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    $sr= mysqli_real_escape_string($con,$_POST['TidDy']);
    
  //  echo $sr;
    
   $clientName = mysqli_real_escape_string($con,$_POST['clientName']);
       $ClientId = mysqli_real_escape_string($con,$_POST['Cname']);
        $Desc = mysqli_real_escape_string($con,$_POST['note']);
    
    $Column =  mysqli_real_escape_string($con,$_POST['ColumnDy']);
    
    $srsql= "Select * From TeamMembers WHERE Sr_no = '$sr'";
    //echo $srsql; 
    $tid ="";
     $sql = mysqli_query($con, $srsql);
     while ($row = $sql->fetch_assoc()) {

               $tid= $row['Tid'];                         
     }

      $Cupdate="Update clientAssign SET $Column = '$clientName' WHERE Tid = '$tid'";
     // echo $Cupdate;
      if ($con->query($Cupdate) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
      
      
      $ClientDbUpdate= "UPDATE ClientDb SET Assign = '$sr' WHERE Sr_no = '$ClientId'";
    //  echo $ClientDbUpdate;
      if ($con->query($ClientDbUpdate) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
      
      $Asql="INSERT INTO `1005138-sahyog`.`assignteam` (`Name`, `Client_Name`, `Case_Name`, `Status`, `Desc`,`AssignNo`) "
        . "VALUES ($sr, $ClientId, '0', 'Active', '$Desc','$Column')";
      
     // echo $Asql;
       if ($con->query($Asql) === TRUE) {
      header("Refresh:0");
} else {
  echo "Error: ----->" . $Asql . "<br>" . $con->error;
}
      
     
     
     
     Die();
     
}


?>



<!doctype html>
<html lang="en">
    
    <?php include'headercrm.php'?>   
    
   <div class="container-fluid p-0" id="VListed">
          <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">
              <table class="table table-striped table-bordered   table-hover " id='TaskClient'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Team Member" scope="col">Team Member</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 1" scope="col">Client 1</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 2" scope="col">Client 2</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 3" scope="col">Client 3</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 4" scope="col">Client 4</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 5"scope="col">Client 5</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 6" scope="col">Client 6</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 7"scope="col">Client 7</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 8" scope="col">Client 8</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 9"scope="col">Client 9</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 10" scope="col">Client 10</th> 
                                        </tr>
                                        
                                    </thead>
                                    <tbody id="dbody">
                                        <?php
                                        $sr = 1;
                                      
                                   $sql= "SELECT  *, TeamMembers.Name, TeamMembers.Surname From clientAssign,TeamMembers WHERE TeamMembers.Tid = clientAssign.Tid AND TeamMembers.status = 'Active'";
                                       //echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre";
                                               
                                         if($row['Client1']== '0'){
                                             $row['Client1']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } 
                                         if($row['Client2']== '0'){
                                             $row['Client2']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         }
                                          if($row['Client3']== '0'){
                                             $row['Client3']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client4']== '0'){
                                             $row['Client4']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client5']== '0'){
                                             $row['Client5']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin' >Assign</button>";
                                         } if($row['Client6']== '0'){
                                             $row['Client6']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client7']== '0'){
                                             $row['Client7']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client8']== '0'){
                                             $row['Client8']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client9']== '0'){
                                             $row['Client9']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client10']== '0'){
                                             $row['Client10']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         }
                                         else{
                                             
                                         }
                                         
                                              
                                                    
                                                ?>
                                        <tr>
                                             <th class="text-center" scope="row" style=""><?php echo $sr++ ?></th>
                                             <td class="text-center" scope="row"  ><?php echo $row['Name']." ".$row['Surname'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client1')"><?php echo $row['Client1'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client2')"><?php echo $row['Client2'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client3')"><?php echo $row['Client3'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client4')"><?php echo $row['Client4'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client5')"><?php echo $row['Client5'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client6')"><?php echo $row['Client6'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client7')"><?php echo $row['Client7'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client8')"><?php echo $row['Client8'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client9')"><?php echo $row['Client9'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client10')"><?php echo $row['Client10'];?></td>

                                        </tr>

                                     
                                    
                                        <?php 
                                            }
                                        
                                        }
                                        ?>
                                  
                                    </tbody>
                                    
              </table>
                                    
          </div>
      </div>
    
    
    <div class="modals">
           <!-- Modal -->
           
<div class="modal fade" id="Assgin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Client To Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <form action="" method="POST">
                  <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-none">
                      <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Team Member</label>

                                <select class="CN" id="TeamN" name="Tname" style="width:100%;" placeholder="Please Select Team Member"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Team Member</option>
                
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM TeamMembers");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Name']." ".$row['Surname'] . "</option>";
                                    }

                                    ?>
                                </select>
                                <input type="hidden" name="TeamName" id="text_CT" />
                            </div>
                      
                      
                      
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                       <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder">Select Client </label>

                                <select class="CN" id="ClientN" name="Cname" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Client Name</option>
                
                                    <?php 
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb WHERE Assign = 0 ");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name']. "</option>";
                                    }

                                    ?>
                                
                                </select>
                                <input type="hidden" name="clientName" id="text_CN" />
                            </div>
                  </div>
              </div>
                  <div class="form-group">
      <label class="font-weight-bolder mt-2">Notes</label>
      <textarea  name="note" class="form-control" placeholder="Notes" rows="3"></textarea>
    </div>
                  <input type="hidden" name="TidDy" id="TidDy">
                  <input type="hidden" name="ColumnDy" id="ColumnDy">
                  <button type="submit" name="clientassgin" class="btn btn-sm text-white">Assign Client</button> 
              </form>
          </div>
            
              
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
    
    </div>
    
    
    <script>
         $('#vv').removeClass('btns-active');
            $('#at').addClass('btns-active');
            
            $('#TaskClient').DataTable({
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
                searchPlaceholder: "Search Client"
            }
        });
        
           $('select').select2();
            function assigned(sr,col){
        console.log(sr);
        console.log(col);
       
        $('#ColumnDy').val(col);
        $('#TidDy').val(sr);
    }
        </script>
        
        
    
</body>
</html>

    