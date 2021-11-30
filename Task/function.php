<?php
include '../Database/Dp.php';

date_default_timezone_set('Asia/Kolkata');
ini_set('session.save_path', '../session');

session_start();
$tsr= $_SESSION['Tsr'];

$Date = date("d-m-Y H:i:s");

if(isset($_GET['r'])){
     $Id=  mysqli_real_escape_string($con,$_GET['r']);  
   $delupdate= "UPDATE  Tasks SET DelStatus = '0' WHERE  Sr_no = '$Id'";
      if ($con->query($delupdate) === TRUE) {
        //  echo "DelStatus of Sr_no = $Id";
           $logsql="INSERT INTO kanbanlogs(TaskId,Changeby, State, Action, Dates) VALUES ('$Id','$tsr','0','Restored','$Date')";
            if ($con->query($logsql) === TRUE) {
                echo "log added successfully";
                header('Location: http://apajuris.in/work/Task.php');
                die();
            }else{
                echo "Error: ----->" .$logsql . "<br>" . $con->error;
            }
          
          
        }else{
            echo "Error: ----->" .$delupdate . "<br>" . $con->error;
        }
    
    die();
}



if(isset($_POST['EditTasks'])){
    $Id=  mysqli_real_escape_string($con,$_POST['EditTasks']);  
    $sql="SELECT Tasks.Sr_no as Tasksr, Tasks.Status_Id, Tasks.Client_Id, Tasks.Case_Id, Tasks.TaskType_Id, Tasks.AssignTo_Id, Tasks.Task_Name, DStatus.DStatus as Status, ClientDb.Full_Name, Client_CaseDb.Case_Name, Task_Type.Task_Name as TaskTypeN, Task_Type.Task_Color, TeamMembers.Name as FTeamN, TeamMembers.Surname as LTeamN, Tasks.SDate, Tasks.EDate, Tasks.TaskDesc 
FROM Tasks, DStatus, ClientDb, Client_CaseDb, Task_Type, TeamMembers
WHERE 
Tasks.Status_Id = DStatus.Sr_no  AND 
Tasks.Client_Id = ClientDb.Sr_no  AND
Tasks.Case_Id = Client_CaseDb.Sr_no AND 
Tasks.TaskType_Id = Task_Type.Sr_no AND 
Tasks.AssignTo_Id = TeamMembers.Sr_no AND 
Tasks.Sr_no = '$Id'";
    
      $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($rows);
//                                                echo "</pre>";
//                                                
                                                $rows['SDate']= date("d-m-Y", strtotime($rows['SDate']));
                                                $rows['EDate']=date("d-m-Y", strtotime($rows['EDate']));
                                                ?>
<div class="container-fluid p-0">
    <form id="DyEditTaskData">
         <div class="row">
                      <div class="col-lg-6 col-sm-12">
                              <div class="form-group">
                                  <input type="hidden" name="editmainId" value="<?php echo $Id; ?>">
    <label for="TaskName" class="font-weight-bold">Task Name</label>
    <input type="text" class="form-control" placeholder="Enter Task Name " name="ETaskName" id="ETaskName" value="<?php echo $rows['Task_Name'];?>">
  </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                               <div class="form-group  ">
                                 <label class="font-weight-bolder" for="StatusId">Select Status</label>
                                <select class="CN form-control" name="EStatusId" id="EStatusId" style="width:100%;"onchange="document.getElementById('EText_StatusN').value = this.options[this.selectedIndex].text">
                                    <option value="<?php echo $rows['Status_Id'];?>"selected><?php echo $rows['Status'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM DStatus");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DStatus'] . "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="EText_StatusN" value="" />
                            </div>
                      </div>
                      
                  </div>
        <div class="row">
                      <div class="col-lg-6 col-sm-12">
                            <div class="form-group  ">
                                 <label class="font-weight-bolder" for="EClientId">Select Client Name</label>
                                <select class="CN form-control" name="EClientId" id="EClientId" style="width:100%;"onchange="document.getElementById('EText_ClientN').value = this.options[this.selectedIndex].text">
                                    <option value="<?php echo $rows['Client_Id'];?>"selected><?php echo $rows['Full_Name'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="EText_ClientN" value="" />
                            </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                           <div class="form-group mt-1 mb-1">
                                <label class="font-weight-bolder" for="ECaseId">Select Case Name</label>
                                 <select class="form-control CN" name="ECaseId"  style="width:100%;" id="ECaseId" onchange="document.getElementById('EText_CaseNs').value = this.options[this.selectedIndex].text">
                                    <option value="<?php echo $rows['Case_Id'];?>" selected><?php echo $rows['Case_Name'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="Text_CaseN" id="EText_CaseNs" value="" />
                            </div>
                      </div>
                  </div>
         <div class="row">
                      <div class="col-lg-6 col-sm-12">
                            <div class="form-group  ">
                                 <label class="font-weight-bolder" for="ETaskTypeId">Select Task Type</label>
                                 <a class="ml-1" data-toggle="modal" data-target="#AddTaskType">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditTaskType">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteTaskType">
                                                    (Delete)
                                                </a>
                                <select class="CN form-control" id="ETaskTypeId" name="ETaskId" style="width:100%;"onchange="document.getElementById('EText_TaksType').value = this.options[this.selectedIndex].text">
                                    <option value="<?php echo $rows['TaskType_Id'];?>"selected><?php echo $rows['TaskTypeN'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Task_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Task_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="EText_TaksType" value="" />
                            </div> 
                      </div>
                      <div class="col-lg-6 col-sm-12">
                          <div class="form-group  ">
                                 <label class="font-weight-bolder" for="ETeamId">Assign To Team Member</label>
                                <select class="CN form-control"  name="ETeamId" id="ETeamId" style="width:100%;"onchange="document.getElementById('EText_TeamN').value = this.options[this.selectedIndex].text">
                                    <option value="<?php echo $rows['AssignTo_Id'];?>" selected><?php echo $rows['FTeamN'].' '.$rows['LTeamN'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM TeamMembers WHERE Status = 'Active'");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Name'] .' '.$row['Surname']. "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="EText_TeamN" value="" />
                            </div> 
                      </div>
                  </div>
        
        <div class="row">
                      <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
    <label for="TaskName" class="font-weight-bold">Start Date</label>
    <input type="text" class="form-control datepicker" id="ESdate" name="ESdate" value="<?php echo $rows['SDate']; ?>">
                            </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
    <label for="TaskName" class="font-weight-bold">End Date</label>
    <input type="text" class="form-control datepicker" id="EEdate" name="EEdate" value="<?php echo $rows['EDate']; ?>">
                            </div>
                      </div>
                  </div>
        
               <div class="form-group">
    <label for="TaskName" class="font-weight-bold">Task Description</label>
    <textarea class="form-control" rows="4" placeholder="Enter Task Description" id="ETaskDesc" name="ETaskDesc"><?php echo $rows['TaskDesc'];?></textarea>
  </div>
                  <button class="btn-sm btn text-white">Update</button>
    </form>
</div>
                                                
                                        <?php        
                                        }}
    
    
    die();
    
}




if(isset($_POST['DelTaskId'])){
    $Id=  mysqli_real_escape_string($con,$_POST['DelTaskId']);  
    $delupdate= "UPDATE  Tasks SET DelStatus = '1' WHERE  Sr_no = '$Id'";
      if ($con->query($delupdate) === TRUE) {
          echo "DelStatus of Sr_no = $Id";
           $logsql="INSERT INTO kanbanlogs(TaskId,Changeby, State, Action, Dates) VALUES ('$Id','$tsr','0','Deleted','$Date')";
            if ($con->query($logsql) === TRUE) {
                echo "log added successfully";
            }else{
                echo "Error: ----->" .$logsql . "<br>" . $con->error;
            }
          
          
        }else{
            echo "Error: ----->" .$delupdate . "<br>" . $con->error;
        }
    
    die();
}



if(isset($_POST['table'])){
    
    ?>
   
                                        <?php 
                                        
                                        $sr=1;
                                        $sql="SELECT Tasks.Sr_no as Tasksr, Tasks.Task_Name, DStatus.DStatus as Status, ClientDb.Full_Name, Client_CaseDb.Case_Name, Task_Type.Task_Name as TaskTypeN, Task_Type.Task_Color, TeamMembers.Name as FTeamN, TeamMembers.Surname as LTeamN, Tasks.SDate, Tasks.EDate, Tasks.TaskDesc 
FROM Tasks, DStatus, ClientDb, Client_CaseDb, Task_Type, TeamMembers
WHERE 
Tasks.Status_Id = DStatus.Sr_no  AND 
Tasks.Client_Id = ClientDb.Sr_no  AND
Tasks.Case_Id = Client_CaseDb.Sr_no AND 
Tasks.TaskType_Id = Task_Type.Sr_no AND 
Tasks.AssignTo_Id = TeamMembers.Sr_no  AND 
Tasks.DelStatus = '0'";
                                        
                                          $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                              
                                                  $Sdate= date('d-m-Y', strtotime($row['SDate']));
                                                 $Edate = date('d-m-Y', strtotime($row['EDate']));
                                                ?>
                                       
                                       
                          <tr>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $sr?>"><?php echo $sr++ ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $Sdate;?>"><?php echo $Sdate; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Full_Name'];?>"><?php echo $row['Full_Name']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_Name'];?>"><?php echo substr($row['Case_Name'],0,45) ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['TaskTypeN'];?>"><?php echo $row['TaskTypeN']; ?></td>
                                              <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Task_Name'];?>"><?php echo substr($row['Task_Name'],0,40)?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['FTeamN']?>"><?php echo $row['FTeamN']." ".$row['LTeamN']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $Edate;?>"><?php echo $Edate;?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Status'];?>"><?php echo $row['Status']; ?></td>
                                             <th class="text-center text-nowrap"  scope="row"style="cursor:pointer"data-toggle="modal" data-target="#ViewTasks" onclick="Viewtask('<?php echo $row['Tasksr']; ?>')"><a class="text-primary"> View</a></th>
                                             <th class="text-center text-nowrap"  scope="row"style="cursor:pointer"data-toggle="modal" data-target="#EditTasks" onclick="Edittask('<?php echo $row['Tasksr']; ?>')"><a class="text-primary">Edit</a></th>
                                             <th class="text-center text-nowrap"  scope="row"style="cursor:pointer" onclick="Deltask('<?php echo $row['Tasksr']; ?>')"><a class="text-danger"> Delete</a></th>
                                             
                                              
                                    
                                        
                                        </tr>
                                         <?php
                                            }
                                        }
                                                
                                        
                                 
    die();
}



if(isset($_POST['editTaskTypeId'])){
//editTaskTypeId
       echo "<pre>";
    print_r($_POST);
    echo "</pre>";
      $Id=  mysqli_real_escape_string($con,$_POST['editTaskTypeId']);  
    
      $TN=   mysqli_real_escape_string($con,$_POST['taskName']);  
      $TC=   mysqli_real_escape_string($con,$_POST['taskColor']);  
      
      $sql="UPDATE Task_Type SET  Task_Name='$TN',Task_Color='$TC' WHERE Sr_no = '$Id'";
        if ($con->query($sql) === TRUE) {
                $fq = mysqli_query($con, "SELECT * FROM Task_Type");
      echo " <option value='' disabled selected>Please Choose Task Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Task_Name'] . "</option>";
                                    }
        }else{
            echo "Error: ----->" .$sql . "<br>" . $con->error;
        }
        
    
    
    
    die();
}




if(isset($_POST['deleteTT'])){
        $Id=  mysqli_real_escape_string($con,$_POST['deleteTT']);  
    $sql="DELETE FROM Task_Type WHERE Sr_no = '$Id'";
     if ($con->query($sql) === TRUE) {
           $fq = mysqli_query($con, "SELECT * FROM Task_Type");
      echo " <option value='' disabled selected>Please Choose Task Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Task_Name'] . "</option>";
                                    }
     }else{
          echo "Error: ----->" .$sql . "<br>" . $con->error;
     }
    die();
}
if(isset($_POST['taskName'])){
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    
    $taskName=  mysqli_real_escape_string($con,$_POST['taskName']);  
    $taskColor= mysqli_real_escape_string($con, $_POST['taskColor']);
    
    $sql="INSERT INTO Task_Type( Task_Name, Task_Color) VALUES ('$taskName','$taskColor')";
    //echo $sql;
       if ($con->query($sql) === TRUE) {
      $fq = mysqli_query($con, "SELECT * FROM Task_Type");
      echo " <option value='' disabled selected>Please Choose Task Type</option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['Task_Name'] . "</option>";
                                    }
   }else{
       echo "Error: ----->" .$sql . "<br>" . $con->error;
   }
   
    
    
    die();
}


if(isset($_POST['editdy'])){
    
    $id=  mysqli_real_escape_string($con,$_POST['editdy']);  
    
   $sql="SELECT * FROM Task_Type Where Sr_no = '$id'";
    $fq = mysqli_query($con,$sql);
     while ($row = $fq->fetch_assoc()) {
         ?>
<div class="form-group" mt-2   >
  <label for="Taskname" class="font-weight-bold" >Task Name</label>
    <input type="text" class="form-control" name="taskName" id="ETaskName" Value="<?php echo $row['Task_Name'];?>">
  </div>
              <div class="form-group">
    <label for="Taskname" class="font-weight-bold" >Task Color</label>
    <input type="color" class="form-control" name="taskColor" id="ETaskColor" placeholder="" value="<?php echo $row['Task_Color']?>">
  </div>
<button class="btn btn-sm text-white" type="submit">Edit Task Type</button>
<?php
     }
   
    die();
}



if(isset($_POST['TaskName'])){
    
    $TaskName=  mysqli_real_escape_string($con,$_POST['TaskName']);  
    $StatusId= mysqli_real_escape_string($con, $_POST['StatusId']);
    $ClientId= mysqli_real_escape_string($con,$_POST['ClientId']);  
     $CaseId= mysqli_real_escape_string($con,$_POST['CaseId']);  
     $TaskTypeId= mysqli_real_escape_string($con,$_POST['TaskId']);  
     $TeamId= mysqli_real_escape_string($con,$_POST['TeamId']);  
      $SDate= mysqli_real_escape_string($con,$_POST['Sdate']);  
      $EDate= mysqli_real_escape_string($con,$_POST['Edate']);  
      $TaskDesc=  mysqli_real_escape_string($con,$_POST['TaskDesc']);     
      $DraftTypeN= mysqli_real_escape_string($con, $_POST['Text_DraftTypeN']);
       $DraftId  = mysqli_real_escape_string($con,$_POST['DraftTypeId']);  
    
                $SDate=date('Y-m-d h:i:s', strtotime($SDate));
                $EDate=date('Y-m-d h:i:s', strtotime($EDate));

                if($TaskTypeId == '9'){
                      $draftsql="INSERT INTO Drafting(ClientId, CaseId, DraftId, StatusId, Dtype, Status, DTitle, DContent, Wcount, Assign, Deadline, last_Edtied, DDesc) VALUES"
                        . " ('$ClientId','$CaseId','$DraftId','0','$DraftTypeN','Active','$TaskName','','0','$TeamId','$EDate',' ','$TaskDesc')";
                             if ($con->query($draftsql) === TRUE) {
                                 echo "Draft Created Successfully";
                             } else {
                                   echo "Error: ----->" .$draftsql . "<br>" . $con->error;
                             }
                }else{
                    echo "Not A Drafting Task";
                }
    
      
      $sql="INSERT INTO Tasks(Task_Name,Status_Id,Client_Id, Case_Id, TaskType_Id, AssignTo_Id, SDate, EDate, TaskDesc) "
              . "VALUES ('$TaskName','$StatusId','$ClientId','$CaseId','$TaskTypeId','$TeamId','$SDate','$EDate','$TaskDesc')";
      
       if ($con->query($sql) === TRUE) {
           echo "Added Successfully";
           
           $last_id = $con->insert_id;
           
           $logsql="INSERT INTO kanbanlogs(TaskId,Changeby, State, Action, Dates) VALUES ('$last_id','$tsr','$StatusId','Created','$Date')";
            if ($con->query($logsql) === TRUE) {
                echo "log added successfully";
          
            }else{
                echo "Error: ----->" .$logsql . "<br>" . $con->error;
            }
           
           
           
       }else{
            echo "Error: ----->" .$sql . "<br>" . $con->error;
       }
      
    

    
    
    die();
}







if(isset($_POST['editmainId'])){
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
  
    $ETaskId= mysqli_real_escape_string($con, $_POST['editmainId']);
     $TaskName=  mysqli_real_escape_string($con,$_POST['ETaskName']);  
    $StatusId= mysqli_real_escape_string($con, $_POST['EStatusId']);
    $ClientId= mysqli_real_escape_string($con,$_POST['EClientId']);  
     $CaseId= mysqli_real_escape_string($con,$_POST['ECaseId']);  
     $TaskTypeId= mysqli_real_escape_string($con,$_POST['ETaskId']);  
     $TeamId= mysqli_real_escape_string($con,$_POST['ETeamId']);  
      $SDate= mysqli_real_escape_string($con,$_POST['ESdate']);  
      $EDate= mysqli_real_escape_string($con,$_POST['EEdate']);  
      $TaskDesc=  mysqli_real_escape_string($con,$_POST['ETaskDesc']);     
    
    $update= "UPDATE Tasks SET Task_Name='$TaskName',Status_Id='$StatusId',Client_Id='$ClientId',Case_Id='$CaseId',"
            . "TaskType_Id='$TaskTypeId',AssignTo_Id='$TeamId',SDate='$SDate',EDate='$EDate',TaskDesc='$TaskDesc'  WHERE Sr_no = '$ETaskId' ";
    
    //echo $update;
     if ($con->query($update) === TRUE) {
           echo "updated Successfully";
           
           
           
           $logsql="INSERT INTO kanbanlogs(TaskId,Changeby, State, Action, Dates) VALUES ('$ETaskId','$tsr','0','Edited','$Date')";
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