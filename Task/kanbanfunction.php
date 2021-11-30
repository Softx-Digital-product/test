<?php
include '../Database/Dp.php';

if(isset($_POST['VewTaskId'])){
     $Id=  mysqli_real_escape_string($con,$_POST['VewTaskId']);  
     
     
       $sql="SELECT Tasks.Sr_no as Tasksr, Tasks.Task_Name, DStatus.DStatus as Status, ClientDb.Full_Name, Client_CaseDb.Case_Name, Task_Type.Task_Name as TaskTypeN, Task_Type.Task_Color, TeamMembers.Name as FTeamN, TeamMembers.Surname as LTeamN, Tasks.SDate, Tasks.EDate, Tasks.TaskDesc 
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
                                            while ($row = mysqli_fetch_array($quariy)) {
                                              
                                                  $Sdate= date('d-m-Y', strtotime($row['SDate']));
                                                 $Edate = date('d-m-Y', strtotime($row['EDate']));
//                                                 echo "<pre>";
//                                                 print_r($row);
//                                                 echo "</pre>";
                                                 
                                                 ?>
<div class="card">
    <div class="card-header font-weight-bolder">
        Viewing Task Details 
    </div>
    <div class="card-body">
        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Task Name :- </span> <?php echo $row['Task_Name'];?></label><br><br>
        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Client Name :- </span> <?php echo $row['Full_Name'];?></label><br><br>
        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Case Name :- </span> <?php echo $row['Case_Name'];?></label><br><br>
<!--        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Task Name :- </span> <?php echo $row['Task_Name'];?></label><br><br>-->
        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Task Type :- </span> <?php echo $row['TaskTypeN'];?></label><br><br>
        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Assigned To  :- </span> <?php echo $row['FTeamN'].' '.$row['LTeamN'];?></label><br><br>
        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Start Date :- </span> <?php echo $Sdate;?></label> 
        <label class="h6 mt-2 ml-5" style="font-size:22px";> <span class="font-weight-bold">Deadline :- </span> <?php echo $Edate;?></label><br><br>
        <label class="h6 mt-2" style="font-size:22px";> <span class="font-weight-bold">Task Description :- </span> <?php echo $row['TaskDesc'];?></label><br><br>
   
    </div>
</div>
     
    
    <?php
                                        }}
    die();
}


if(isset($_POST['viewtables'])){
      $Id=  mysqli_real_escape_string($con,$_POST['viewtables']);  
?>
    
       <?php
                                $sql="SELECT * FROM Tasks WHERE AssignTo_Id = '$Id'";
                                         $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                        ?>
                                        <tr>
                                            <td class="text-center text-nowrap"  onclick="viewdetails('<?php echo $row['Sr_no'];?>')" scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Task_Name']?>"><?php echo $row['Task_Name']?></td>
                                        </tr>
                                        <?php
                                        }}
                                        
    
    
    die();
}
if(isset($_POST['TeamId'])){
    
    $Id=  mysqli_real_escape_string($con,$_POST['TeamId']);  
    
    ?>
<table class="table table-striped table-bordered   table-hover " id='TaskList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Tasks</th>
                                        </tr>
                                    </thead>
                                   <tbody class="tbodys">
                                        <?php
                                $sql="SELECT * FROM Tasks WHERE AssignTo_Id = '$Id'";
                                         $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                        ?>
                                        <tr>
                                            <td class="text-center text-nowrap"  onclick="viewdetails('<?php echo $row['Sr_no'];?>')" scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Task_Name']?>"><?php echo $row['Task_Name']?></td>
                                        </tr>
                                        <?php
                                        }}
                                        ?>
                                    </tbody>
                                                      </table>
<?php
    
    
    die();
}
?>