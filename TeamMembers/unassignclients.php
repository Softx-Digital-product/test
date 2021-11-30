<?php
include '../UploadCase/Dp.php';

if(isset($_POST['clientassgin'])){
    
//    echo "<pre>";
//    print_r($_POST);
//   // print_r($_POST['clientassgin']);
//    echo "</pre>";
    
$Tid= $_POST['Tname'];
    //$Sr= $_POST['Cname'];
            $CNO= mysqli_real_escape_string($con,$_POST['CNO']);
            $clientN= mysqli_real_escape_string($con,$_POST['ClientName']); 
            
        $Tid= mysqli_real_escape_string($con,$_POST['Tid']);
    $Cname = mysqli_real_escape_string($con,$_POST['Csr']);
    $Desc = mysqli_real_escape_string($con,$_POST['note']);
    $sr=$Tid;
    $srsql= "Select * From TeamMembers WHERE Tid = '$Tid'";
    //echo $srsql;
     $sql = mysqli_query($con, $srsql);
     while ($row = $sql->fetch_assoc()) {

               $sr= $row['Sr_no'];                         
     }
    
    $Cupdate ="UPDATE clientAssign SET $CNO = '$clientN' WHERE Tid= '$Tid'";
    //echo $Cupdate;
        if ($con->query($Cupdate) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating in clientassign record: " . $con->error;
}
    $update = "UPDATE ClientDb SET Assign = '$sr' WHERE Sr_no = '$Cname'";
  //  echo  "<br>".$update;
    
    if ($con->query($update) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}

     $check=mysqli_num_rows(mysqli_query($con,"SELECT * from assignteam Where Client_Name='$Cname'"));
if($check>0){
  
  
}else{

$Asql="INSERT INTO `1005138-sahyog`.`assignteam` (`Name`, `Client_Name`, `Case_Name`, `Status`, `Desc`,`AssignNo`) "
        . "VALUES ($sr, $Cname, '0', 'Active', '$Desc','$CNO')";
    // echo $Asql;
    if ($con->query($Asql) === TRUE) {
// echo "Assign Sucessfully Bro";

     header("Refresh:0");
} else {
  echo "Error: ----->" . $Asql . "<br>" . $con->error;
}
}
    
    
}



?>



<!doctype html>
<html lang="en">
    
    <?php include'headercrm.php'?>
    
    <div class="container-fluid p-0">
                 <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='unassigned'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center"style="width:35px" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Type" scope="col">Type</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Name" scope="col">Client Name</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Email ID" scope="col">Email Id</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                        <?php
                                        $sr = 1;
                                        
                                        $quariy = $con->query("SELECT * FROM ClientDb WHERE Assign = 0 ");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                           
//                                                           echo "<pre>";
//                                                           print_r($row);
//                                                           echo "</pre>";
                                                ?>
                                        <tr>
                                                 <td class="text-center" style="width:35px"><?php echo $sr;?></td>
                                                   <td class="text-center text-nowrap" style="width:250px"><?php echo $row['Type']?></td>
                                                   <td class="text-center text-nowrap"><?php echo $row['Full_Name']?></td>
                                                   
                                                   <td class="text-center text-nowrap"><?php echo $row['Email']?></td>
                                                   <td class="text-center text-White"><button  data-toggle="modal" data-target="#AssignClient"  class="btn btn-sm text-white " onclick="AssignClientM('<?php echo $row['Sr_no']?>','<?php echo $row['Full_Name'] ?>')">Assign</button></td>
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
  
    <div class="Modals">
                  
           <!-- Modal -->
<div class="modal fade" id="AssignClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-xl modal-dialog modal-dialog-centered">
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
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Team Member</label>

                                <select class="CN" id="TeamN" name="Tid" style="width:100%;" placeholder="Please Select Team Member"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Team Member</option>
                
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM TeamMembers");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Tid'] . ">" . $row['Name']." ".$row['Surname'] . "</option>";
                                    }

                                    ?>
                                </select>
                                <input type="hidden" name="TeamName" id="text_CT" />
                            </div>
                      
                      
                      
                  </div>
                  <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                       <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder">Select Client </label>

                                <select class="CN" id="ClientN" name="Csr" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Client Name</option>
                
                                    <?php
                                    $q= "SELECT * FROM ClientDb WHERE Assign = 0";
                                    $sql = mysqli_query($con, $q);
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name']. "</option>";
                                    }

                                    ?>
                                
                                </select>
                                <input type="hidden" name="ClientName" id="text_CN" />
                            </div>
                  </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                       <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder">Assign Client No </label>

                                <select class="CN" id="ClientNO" name="CNO" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CNO').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Assign Client Number</option>
                
                                    <?php
                                    $q= "SELECT * FROM clientAssign WHERE Sr_no =  1 ";
                                    $sql = mysqli_query($con, $q);
                                    while ($row = $sql->fetch_assoc()) {
                                        
                                        if($row['Client1']== '0'){
                                           $row['Client1']= "Client 1";
                                             echo "<option value=" . $row['Sr_no'] . ">".$row['Client1']. "</option>";
                                        }   
                                        if($row['Client2']=='0'){
                                          $row['Client2']= "Client 2";  
                                          echo "<option value=" . $row['Sr_no'] . ">" .$row['Client2']. "</option>";
                                        } if($row['Client3']=='0'){
                                          $row['Client3']= "Client 3";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client3']. "</option>";
                                        } if($row['Client4']=='0'){
                                          $row['Client4']= "Client 4";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client4']. "</option>";
                                        } if($row['Client5']=='0'){
                                          $row['Client5']= "Client 5";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client5']. "</option>";
                                        } if($row['Client6']=='0'){
                                          $row['Client6']= "Client 6";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client6']. "</option>";
                                        } if($row['Client7']=='0'){
                                          $row['Client7']= "Client 7";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client7']. "</option>";
                                        } if($row['Client8']=='0'){
                                          $row['Client8']= "Client 8";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client8']. "</option>";
                                        } if($row['Client9']=='0'){
                                          $row['Client9']= "Client 9"; 
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client9']. "</option>";
                                        } if($row['Client10']=='0'){
                                          $row['Client10']= "Client 10";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client10']. "</option>";
                                        }
                                        
                                        else{
                                            
                                         $row['Client1']="Already Assigned";
                                         $row['Client2']="Already Assigned";
                                         
                                        }
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client1']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">" .$row['Client2']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">" .$row['Client3']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">" .$row['Client4']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client5']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client6']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client7']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client8']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client9']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client10']. "</option>";
                                                    
                                    }

                                    ?>
                                
                                </select>
                                <input type="hidden" name="ClientNo" id="text_CNO" />
                            </div>
                  </div>
              </div>
                  <div class="form-group">
      <label class="font-weight-bolder mt-2">Notes</label>
      <textarea  name="note" class="form-control" placeholder="Notes" rows="3"></textarea>
    </div>
          
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
    
    </body>
        
        <script>
            $('#vv').removeClass('btns-active');
            $('#us').addClass('btns-active');
            
            
             $('#unassigned').DataTable({
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
    function AssignClientM(sr,clientName){
               console.log(sr);
               console.log(clientName);
               
                          
             //   $('#ClientN').val(sr);
                $("#ClientN").val(sr).change();
              
              
           }
           
    
    
             $("#TeamN").on("change", function () {
                    var category = $("#TeamN").val();

                    console.log(category);

                    var tid = JSON.stringify(category);
                    $.ajax({
                        url: "functions.php",
                        type: "POST",
                        cache: false,
                        data: {Tid: tid},
                        success: function (data) {
                            console.log(data);
                            $("#ClientNO").html(data);

                        }
                    });
                });
          
            
            
            </script>
</html>