<?php
include '../UploadCase/Dp.php';


if(isset($_POST['tids'])){
    //echo $_POST['tids'];
    $q="SELECT * FROM TeamMembers WHERE Sr_no = '{$_POST['tids']}'";
    $sql = mysqli_query($con, $q);
     while ($row = $sql->fetch_assoc()) {
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
         ?>
<div class="card">
    <div class="card-header bg-info">
        <h5 class="float-right text-white">~ <?php echo $row['Name'].' '.$row['Surname']; ?></h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 border">
                  <img src="../<?php echo $row['profile'];?>" id="vprofile" class="img-fluid" style='border-radius:50%;height:20rem;width:20rem; vertical-align: middle;'>
            </div
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12border">
                <div class="Container-fluid mt-3 ml-2">
                    <label><span class="font-weight-bolder">Full Name : </span> <?php echo $row['Name']." ".$row['Surname']; ?> </label><br><br>
                    <label><span class="font-weight-bolder">Email Id : </span> <?php echo $row['Mail_Id']; ?> </label><br><br>
                    <label><span class="font-weight-bolder">Phone Number: </span> <?php echo $row['Phone']; ?> </label><br><br>
                    <label><span class="font-weight-bolder">UserName: </span> <?php echo $row['UserName']; ?> </label><br><br>
                    <label><span class="font-weight-bolder">Password: </span> <?php echo $row['Password']; ?> </label><br><br>
                    <label><span class="font-weight-bolder">Date of Birth: </span> <?php echo $row['DOB']; ?> </label><br><br>
                    <label><span class="font-weight-bolder">Aadharcard: </span> <?php echo $row['AadharCard']; ?> </label>&nbsp;&nbsp;&nbsp;
                    <label><span class="font-weight-bolder">Pancard: </span> <?php echo $row['PanCard']; ?> </label><br><br>
                    <label><span class="font-weight-bolder">Status: </span> <?php echo $row['status']; ?> </label>&nbsp;&nbsp;&nbsp;
                    <label><span class="font-weight-bolder">Role: </span> <?php echo $row['Role']; ?> </label><br><br>

                    
                </div>
<!--                <table>
                    <tr><td> Full Name :</td><td><?php echo $row['Name']." ".$row['Surname']; ?></td></tr>
                    <tr><td> Email id :</td><td><?php echo $row['Mail_Id'];?></td></tr>
                </table>-->
            </div>
        </div>
    </div>
</div>
       <?php  
     }
 die();   
}
if(isset($_GET['U'])){
    $column = $_GET['A'];
    $sr= $_GET['U'];
    $cn= $_GET['C'];
    
    $Tid= $_GET['Tid'];
//    echo $ClientName."<br>";
//    
//   echo  $column;
//    
    
//    echo $cn; 
//    echo $sr;
//    
    
    $Clientassgin= "UPDATE clientAssign SET $column = 0 WHERE Tid = '$Tid'";
    echo $Clientassgin."<Br>";
       if ($con->query($Clientassgin) === TRUE) {
           
} else {
 echo "Error: ----->" . $Clientassgin . "<br>" . $con->error;
}
    
    $update = "UPDATE ClientDb SET Assign = '0' WHERE Sr_no = '$cn'";
    echo "<br>".$update;
    if ($con->query($update) === TRUE) {
$Dsql="DELETE FROM assignteam WHERE Sr_no = '$sr' ";
echo $Dsql;
if ($con->query($Dsql) === TRUE) {
  echo "Record deleted successfully";
   header("Location:http://apajuris.in/work/TeamMembers/AssignClientTable.php");
    die();
} else {
  echo "Error deleting record: " . $con->error;
}
} 
else {
  echo "Error updating record: " . $con->error;
}
   
    
    
    
    
    
    Die();
    
    
       }
        

if (isset($_POST['Tid'])) {

	// Fetch state name base on country id
//	$query = "SELECT * FROM Client_CaseDb WHERE Client_Name = ".$_POST['countryId'];

                                    $q= "SELECT * FROM clientAssign WHERE Tid = ".$_POST['Tid'];
                                    echo $q;
                                    
                                    $sql = mysqli_query($con, $q);
                                    while ($row = $sql->fetch_assoc()) {
//                                        echo "<pre>";
//                                        print_r($row);
//                                        echo "</pre>";
                                        
                                        if($row['Client1']== '0'){
                                           $row['Client1']= "Client 1";
                                           $row['Sr_no'] = "Client1";
                                             echo "<option value=" . $row['Sr_no'] . ">".$row['Client1']. "</option>";
                                        }   
                                        if($row['Client2']=='0'){
                                          $row['Client2']= "Client 2"; 
                                          $row['Sr_no'] = "Client2";
                                          echo "<option value=" . $row['Sr_no'] . ">" .$row['Client2']. "</option>";
                                        } if($row['Client3']=='0'){
                                          $row['Client3']= "Client 3";  
                                          $row['Sr_no'] = "Client3";
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client3']. "</option>";
                                        } if($row['Client4']=='0'){
                                          $row['Client4']= "Client 4";
                                          $row['Sr_no'] = "Client4";
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client4']. "</option>";
                                        } if($row['Client5']=='0'){
                                          $row['Client5']= "Client 5"; 
                                          $row['Sr_no'] = "Client5";
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client5']. "</option>";
                                        } if($row['Client6']=='0'){
                                          $row['Client6']= "Client 6";
                                          $row['Sr_no'] = "Client6";
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client6']. "</option>";
                                        } if($row['Client7']=='0'){
                                          $row['Client7']= "Client 7";
                                          $row['Sr_no'] = "Client7";
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client7']. "</option>";
                                        } if($row['Client8']=='0'){
                                          $row['Client8']= "Client 8";  
                                          $row['Sr_no'] = "Client8";
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client8']. "</option>";
                                        } if($row['Client9']=='0'){
                                          $row['Client9']= "Client 9";
                                          $row['Sr_no'] = "Client9";
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client9']. "</option>";
                                        } if($row['Client10']=='0'){
                                          $row['Client10']= "Client 10";
                                          $row['Sr_no'] = "Client10";
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
                                    
                                      Die();

	}
        
      



       


?>