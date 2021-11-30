<?php
include '../Database/Dp.php';

date_default_timezone_set('Asia/Kolkata');
ini_set('session.save_path', '../session');

session_start();
$tsr= $_SESSION['Tsr'];

$Date = date("d-m-Y H:i:s");
if(isset($_POST['Tasks'])){
    
     $Id=  mysqli_real_escape_string($con,$_POST['Tasks']);  
     $sql1= "SELECT * FROM Tasks WHERE State = 0   AND AssignTo_Id = $Id AND DelStatus =0";
     $sql2= "SELECT * FROM Tasks WHERE State = 2  AND AssignTo_Id = $Id  AND DelStatus =0";
     $sql3= "SELECT * FROM Tasks WHERE State = 3  AND AssignTo_Id = $Id  AND DelStatus =0";
     $sql4= "SELECT * FROM Tasks WHERE State = 4  AND AssignTo_Id = $Id  AND DelStatus =0";
     $sql5= "SELECT * FROM Tasks WHERE State = 5  AND AssignTo_Id = $Id  AND DelStatus =0";
     $sql6= "SELECT * FROM Tasks WHERE State = 6  AND AssignTo_Id = $Id  AND DelStatus =0";
     
     ?>
    <div class="row">
                      <div class="col-lg-2 col-md-2 col-sm-2  border p-0 ">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Backlogs</h2>
                         </div>
                          <?php
                                        $sr = 1;
                                       //  $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql1);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                                            <div class="container-fluid m-0 box p-2 bg-secondary text-white" style="cursor:pointer;overflow: hidden;" ondblclick="ViewDetails('<?php echo $row['Sr_no']?>')"  id="dyuser">
                                                <a class="text-center  mtext text-white text-nowrap"  data-toggle="tooltip" data-placement="top" title="<?php echo $row['Task_Name'];?>" id="test<?php echo $row['Sr_no']?>" style="max-width:3rem; overflow: hidden;" ><?php echo substr($row['Task_Name'],0,90)?></a><br>
                                                
                                                <div class="row ">
                                                    <div class="col-lg-2">
                                                        <a onclick="Back(0,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-8">
                                                           <select class="backlogs custom-select custom-select-sm " id="backlogid"style="width: 100%;cursor:pointer;;cursor:pointer;">
                                                             <option value=""disabled selected>Change Status</option>
                                                     <option data-foo="<?php echo $row['Sr_no'];?>" value="0">Backlogs</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>"value="2">In Process</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>" value ="3">Review</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="4">Approved</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="5">Paper book</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="6">Delivered</option>
                                                </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a onclick="Forw(0,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)">  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                    </div>
                                                    
                                                    
</div>
                                             
                         </div>  
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2  border p-0 ">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">In Process</h2>
                         </div>
                             <?php
                                        $sr = 1;
                                       //  $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql2);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                             <div class="container-fluid m-0 box p-2 bg-primary text-white" style="cursor:pointer;overflow: hidden;" ondblclick="ViewDetails('<?php echo $row['Sr_no']?>')"  id="dyuser">
                                                <a class="text-center  mtext mb-1 text-white text-nowrap"  data-toggle="tooltip" data-placement="top" title="<?php echo $row['Task_Name'];?>" id="test<?php echo $row['Sr_no']?>" style="max-width:3rem; overflow: hidden;"><?php echo substr($row['Task_Name'],0,90)?></a><br>
                                                
                                                <div class="row ">
                                                    <div class="col-lg-2">
                                                        <a onclick="Back(2,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-8">
                                                           <select class="custom-select custom-select-sm proccess" id="Processid"style="width: 100%;cursor:pointer;">
                                                           <option value=""disabled selected>Change Status</option>
                                                               <option data-foo="<?php echo $row['Sr_no'];?>" value="0">Backlogs</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>"value="2">In Process</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>" value ="3">Review</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="4">Approved</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="5">Paper book</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="6">Delivered</option>
                                                </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a onclick="Forw(2,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                    </div>
                                                    
                                                    
</div>
                                             
                         </div>  
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                             
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2 border p-0">
                          <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Review</h2>
                         </div>
                              <?php
                                        $sr = 1;
                                       //  $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql3);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                             <div class="container-fluid m-0 box p-2 bg-warning" style="cursor:pointer;overflow: hidden;" ondblclick="ViewDetails('<?php echo $row['Sr_no']?>')"  id="dyuser">
                                                <a class="text-center  mtext mb-1 text-nowrap"  data-toggle="tooltip" data-placement="top" title="<?php echo $row['Task_Name'];?>" id="test<?php echo $row['Sr_no']?>"  style="max-width: 3rem; overflow: hidden;"><?php echo substr($row['Task_Name'],0,90)?></a><br>
                                                
                                                <div class="row ">
                                                    <div class="col-lg-2">
                                                        <a onclick="Back(3,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-8">
                                                           <select class="custom-select custom-select-sm reveiw" id="Reviewid"style="width: 100%;cursor:pointer;">
                                                           <option value=""disabled selected>Change Status</option>
                                                               <option data-foo="<?php echo $row['Sr_no'];?>" value="0">Backlogs</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>"value="2">In Process</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>" value ="3">Review</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="4">Approved</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="5">Paper book</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="6">Delivered</option>
                                                </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a onclick="Forw(3,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                    </div>
                                                    
                                                    
</div>
                                             
                         </div>  
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                             
                             
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2  border p-0 ">
                          <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Approved</h2>
                         </div>
                              <?php
                                        $sr = 1;
                                       //  $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql4);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                             <div class="container-fluid m-0 box p-2  text-white" style="cursor:pointer;background-color:#66b2b2;overflow: hidden;" ondblclick="ViewDetails('<?php echo $row['Sr_no']?>')"  id="dyuser">
                                                <a class="text-center  mtext mb-1 text-white text-nowrap"  data-toggle="tooltip" data-placement="top" title="<?php echo $row['Task_Name'];?>" id="test<?php echo $row['Sr_no']?>" style="max-width:3rem; overflow: hidden;" ><?php echo substr($row['Task_Name'],0,90)?></a><br>
                                                
                                                <div class="row ">
                                                    <div class="col-lg-2">
                                                        <a onclick="Back(4,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-8">
                                                           <select class="custom-select custom-select-sm approved" id="Approvedid"style="width: 100%;cursor:pointer;">
                                                           <option value=""disabled selected>Change Status</option>
                                                               <option data-foo="<?php echo $row['Sr_no'];?>" value="0">Backlogs</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>"value="2">In Process</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>" value ="3">Review</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="4">Approved</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="5">Paper book</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="6">Delivered</option>
                                                </select>
                                                       
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a onclick="Forw(4,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                    </div>
                                                    
                                                    
</div>
                                             
                         </div>  
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2 border p-0">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Paper Book</h2>
                         </div>
                              <?php
                                        $sr = 1;
                                       //  $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql5);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                             <div class="container-fluid m-0 box p-2 bg-info text-white" style="cursor:pointer;overflow: hidden;" ondblclick="ViewDetails('<?php echo $row['Sr_no']?>')"  id="dyuser">
                                                <a class="text-center  mtext mb-1 text-white text-nowrap"  data-toggle="tooltip" data-placement="top" title="<?php echo $row['Task_Name'];?>" id="test<?php echo $row['Sr_no']?>" style=" overflow: hidden;" ><?php echo substr($row['Task_Name'],0,90)?></a><br>
                                                
                                                <div class="row ">
                                                    <div class="col-lg-2">
                                                        <a onclick="Back(5,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-8">
                                                           <select class="custom-select custom-select-sm paper" id="Paperid"style="width: 100%;cursor:pointer;">
                                                           <option value=""disabled selected>Change Status</option>
                                                               <option data-foo="<?php echo $row['Sr_no'];?>" value="0">Backlogs</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>"value="2">In Process</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>" value ="3">Review</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="4">Approved</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="5">Paper book</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="6">Delivered</option>
                                                </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a onclick="Forw(5,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                    </div>
                                                    
                                                    
</div>
                                             
                         </div>  
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                      </div>
                        <div class="col-lg-2  col-md-2 col-sm-2 border p-0 ">
                            
                             <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Delivered</h2>
                         </div>
                             <?php
                                        $sr = 1;
                                       //  $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql6);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                             <div class="container-fluid m-0 box p-2 bg-success text-white" style="cursor:pointer; overflow: hidden;" ondblclick="ViewDetails('<?php echo $row['Sr_no']?>')"  id="dyuser">
                                                <a class="text-center  mtext mb-1 text-white text-nowrap"  data-toggle="tooltip" data-placement="top" title="<?php echo $row['Task_Name'];?>" id="test<?php echo $row['Sr_no']?>" style="max-width:3rem; overflow: hidden;" ><?php echo substr($row['Task_Name'],0,30)?></a><br>
                                                
                                                <div class="row ">
                                                    <div class="col-lg-2">
                                                        <a onclick="Back(6,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-8">
                                                           <select class="custom-select custom-select-sm delivered " id="Deliveredid"style="width: 100%;cursor:pointer;;cursor:pointer;">
                                                           <option value=""disabled selected>Change Status</option>
                                                               <option data-foo="<?php echo $row['Sr_no'];?>" value="0">Backlogs</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>"value="2">In Process</option>
                                                    <option   data-foo="<?php echo $row['Sr_no'];?>" value ="3">Review</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="4">Approved</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="5">Paper book</option>
                                                     <option  data-foo="<?php echo $row['Sr_no'];?>"  value="6">Delivered</option>
                                                </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a onclick="Forw(6,<?php echo  $row['Sr_no'];?>,<?php echo  $row['AssignTo_Id'];?>)"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                    </div>
                                                    
                                                    
</div>
                                             
                         </div>  
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                      </div>
                  </div>

    <?php
    
    die();
}




if(isset($_POST['Taskslists']))
{
    $Id=  mysqli_real_escape_string($con,$_POST['Taskslists']);  
    
    $sql="SELECT * FROM Tasks WHERE AssignTo_Id = '$Id'";
                                         $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
<div class="container-fluid p-3 mt-0  box"  ondragstart="drag(event)" draggable="true" onclick="viewdetails('<?php echo $row['Sr_no'];?>')">
    <a class="  "><?php  echo $row['Task_Name']; ?></a>
</div>  

<?php
                                        }}
                                            
    
    die();
}



if(isset($_POST['State'])){
       $Srid=  mysqli_real_escape_string($con,$_POST['Srid']);  
       $State = mysqli_real_escape_string($con, $_POST['State']);
    
       $update = "UPDATE Tasks SET State = '$State' WHERE Sr_no = '$Srid'";
       echo $update;
       if ($con->query($update) === TRUE) {
           echo "State Change successfully to $State of  $Srid";
           
           $logsql="INSERT INTO kanbanlogs(TaskId,Changeby, State, Action, Dates) VALUES ('$Srid','$tsr','$State','Update','$Date')";
            if ($con->query($logsql) === TRUE) {
                echo "log added successfully";
            }else{
                echo "Error: ----->" .$logsql . "<br>" . $con->error;
            }
           
       }else{
           echo "Error: ----->" .$update . "<br>" . $con->error;
       }
       
    
    die();
}





?>
  

    
     
                                    

                                    