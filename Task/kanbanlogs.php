<?php
include '../Database/Dp.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="../assets12/css/sam.css">
          <link rel="stylesheet" href="../Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
          <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        <style>
            div.dataTables_wrapper div.dataTables_filter input {
            /*    margin-left: .5em;*/
            display: inline-block;
            width: 40rem !important;

        }
        </style>
    <title>Task- Kan-Ban</title>
  </head>
  <body>
       <?php include 'Innerheader.php';?>
        <div class="topnav1 p-0 ">
          <a class="nav_link  p-2  " href="../Task.php">View Tasks</a>
              <a class="nav_link ml-1 text-white p-2 "data-toggle="modal" data-target="#CreateTask" href="#" >Create  Task</a>
              <a class="nav_link ml-1 text-white p-2  " href="KanBan.php" >Kan-Ban</a>
               <a class="nav_link ml-1 text-white p-2 active" href="kanbanlogs.php" >Kan-Ban Logs</a>
                <a class="nav_link ml-1 text-white p-2 " href="#" >Performance</a>
                <a class="nav_link ml-1 text-white p-2 " href="restoretask.php" >Deleted Task</a>
                    <a class="nav_link ml-1 text-white p-2 " href="Apt.php" >Aditya Pratap Tasks</a>
      </div>
<!--      <h2 class="text-center text-warning">under process</h2>-->
      <div class="container-fluid p-0">
          <div class="tables p-0">
             <table class="table table-striped table-bordered   table-hover p-0 " id='LogsList'>
                                    <thead class="vbg text-white p-0">
                                        <tr>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Task Name" scope="col">Task Name</th>
                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="Task Type" scope="col">Task Type</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Action" scope="col">Action</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Change By" scope="col">Change By</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date" scope="col">Date </th>
                                           <th class="text-center" data-toggle="tooltip" data-placement="top" title="Time" scope="col">Time </th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="View in Details" scope="col">View</th>
                                        </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $sr=1;
                      $sql="SELECT Tasks.Sr_no as Tasksr, Tasks.Task_Name, DStatus.DStatus as Status, ClientDb.Full_Name, Client_CaseDb.Case_Name, Task_Type.Task_Name as TaskTypeN, Task_Type.Task_Color, TeamMembers.Name as FTeamN, TeamMembers.Surname as LTeamN, Tasks.SDate, Tasks.EDate, Tasks.TaskDesc, kanbanlogs.Sr_no as klsr, kanbanlogs.State, kanbanlogs.Action,kanbanlogs.Dates as LogTimes
FROM Tasks, DStatus, ClientDb, Client_CaseDb, Task_Type, TeamMembers, kanbanlogs
WHERE 
kanbanlogs.TaskId = Tasks.Sr_no AND
kanbanlogs.Changeby = TeamMembers.Sr_no AND
Tasks.Status_Id = DStatus.Sr_no  AND 
Tasks.Client_Id = ClientDb.Sr_no  AND
Tasks.Case_Id = Client_CaseDb.Sr_no AND 
Tasks.TaskType_Id = Task_Type.Sr_no  ORDER BY kanbanlogs.Sr_no desc";
                            $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                       $dates = date("d-m-Y",strtotime($row['LogTimes']));
                                          $times = date("h:i:s A",strtotime($row['LogTimes']));
                                       
//                           `            $time = date("h:i:s A ",$row['']);
switch ($row['State']) {
  case "0":
    $row['State'] ="Backlog";
      $class= "btn-secondary text-white btn-bg ";
      
    break;
  case "2":
    $row['State'] ="In Process";
       $class= "btn-primary btn-bg ";
    break;
  case "3":
     $row['State'] ="Review";
       $class= "btn-warning  btn-bg ";
    break;
 case "4":
     $row['State'] ="Approved";
      $class= ".btn-sm btn text-white ";
    break;
 case "5":
     $row['State'] ="Paper Book";
      $class= "btn-info btn-bg ";
    break;
 case "6":
     $row['State'] ="Delivered";
      $class= "btn-success btn-bg ";
    break;
  default:
    $row['State'] ="ERROR";
      $class= "btn-danger btn-bg ";
}
                                           
                                                ?>
                                       
                                        <tr>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $sr?>"><?php echo $sr++ ?></td>
                                          
                                             <td class="text-nowrap"  scope="row"style="width:10%"data-toggle="tooltip-top" title="<?php echo $row['Task_Name'];?>"><?php echo substr($row['Task_Name'],0,30) ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['TaskTypeN'];?>"><?php echo $row['TaskTypeN']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['State'];?>"><button type='button' class='<?php echo $class?>'><?php echo $row['State'] ?></button></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Action'];?>"><?php echo $row['Action']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['FTeamN'];?>"><?php echo $row['FTeamN'].' '.$row['LTeamN']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $dates;?>"><?php echo $dates ?></td>
                                              <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $times;?>"><?php echo $times; ?></td>
                                             <th class="text-center text-nowrap text-primary" data-toggle="modal" data-target="#ViewTasks"   scope="row"style="cursor:pointer" onclick="Viewtask('<?php echo $row['Tasksr']; ?>')">View</th>
                                        </tr>
                                                 <?php
                                            }
                                        }
                      ?>
                      
                  </tbody>
              </table>
          </div>
          
      </div>
  


      <?php include 'Modals.php';
       include '../Drafting/modals.php';
      
      ?>


 <script>
        
          document.getElementById("Daddbtn").addEventListener("click",AddDraftTypes);
        function AddDraftTypes(){
             let DTN=  document.getElementById("Dadd").value;
           
             if(DTN != ''){
                 
                     $.ajax({
                            url:"../Drafting/Dyfunctions.php",
                        type: "POST",
                        cache: false,
                        data: {DtypeAdd:DTN},
                        success: function (data) {
                            console.log(data);
                            $('#DrafTypeId').html(data);
                            $('#Dedit').html(data);
                            $('#DDel').html(data);
                            $('#AddDraftType').modal('toggle');
                            
                        }
                    });
                  
             }else{
                 alert('Enter a Valid Value ');
             }
             
          }
          
          
          $('#Deditbtn').click(function(e){
              var id= $('#Dedit').val();
              var DNN= $('#NewDtype').val();
              console.log(DNN+id);
              if(DNN !='' && id !=''){
                  
                  $.ajax({
                            url:"../Drafting/Dyfunctions.php",
                        type: "POST",
                        cache: false,
                        data: {DtypeEdit:DNN,DtypeEditId:id},
                        success: function (data) {
                            console.log(data);
                            $('#DrafTypeId').html(data);
                            $('#Dedit').html(data);
                            $('#DDel').html(data);
                            $('#EditDraftType').modal('toggle');
                            
                        }
                    });
                  
                  
              }else{
                  alert('Something Went Wrong pLease Try Again !!!');
              }
          });
          
          
          
          $("#DDelbtn").click(function(e){
              var id=$("#DDel").val();
              if(id !=""){
                    $.ajax({
                            url:"../Drafting/Dyfunctions.php",
                        type: "POST",
                        cache: false,
                        data: {DtypeDelId:id},
                        success: function (data) {
                            console.log(data);
                            $('#DrafTypeId').html(data);
                            $('#Dedit').html(data);
                            $('#DDel').html(data);
                            $('#DeleteDraftType').modal('toggle');
                            
                        }
                    });
              }else{
                  alert("Please Select Draft");
              }
              
          });
          
          
            // Status department
      
     // 1 add Status
     
     $('#Saddbtn').click(function(e){
         
         var StatusName = $('#Sadd').val();
         if(StatusName != ''){
              $.ajax({
                            url:"../Drafting/Dyfunctions.php",
                        type: "POST",
                        cache: false,
                        data: {StatusN:StatusName},
                        success: function (data) {
                            console.log(data);
                            $('#StatusId').html(data);
                            $('#Sedit').html(data);
                            $('#Sdel').html(data);
                            $('#AddStatus').modal('toggle');
                            
                        }
                    });
                
             
         }else{
             alert('Please Enter Value in Filed');
         }
     });
       
       //2 edit Status
       
       $('#Seditbtn').click(function(e){
         var statusid =   $('#Sedit').val();
         var StatusName = $('#NewStatus').val();
         
           if(StatusName != ''){
              $.ajax({
                            url:"../Drafting/Dyfunctions.php",
                        type: "POST",
                        cache: false,
                        data: {StatusNs:StatusName,EditStatusId:statusid},
                        success: function (data) {
                            console.log(data);
                             $('#StatusId').html(data);
                            $('#Sedit').html(data);
                            $('#Sdel').html(data);
                            $('#EditStatus').modal('toggle');
                            
                        }
                    });

         }else{
             alert('Please Enter Value in Filed');
         }
       });
       //3 Delete
       $('#SDelbtn').click(function(e){
           var statusid =   $('#SDel').val();
                $.ajax({
                            url:"../Drafting/Dyfunctions.php",
                        type: "POST",
                        cache: false,
                        data: {DelStatusId:statusid},
                        success: function (data) {
                            console.log(data);
                             $('#StatusId').html(data);
                            $('#Sedit').html(data);
                            $('#Sdel').html(data);
                            $('#DeleteStatus').modal('toggle');
                            
                        }
                    });
       });
          
          
          
          </script>
    

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
   <script>
          $('select').select2();
                                    $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
          
            function Viewtask(sr){
//              alert(sr);
  $.ajax({
                    url:'kanbanfunction.php',
                     type:"POST",
                     data:{VewTaskId:sr},
                     success:function(res){
                         console.log(res);

              $('.dyviewTasks').html(res);
              
              
    }
    });
          }
          
          
       $('#LogsList').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            
            "responsive": true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Logs"
            }
        });
       </script>
       
       
       <script>
   
       $("#EditTaskId").on("change",function(){
        var editId= $('#EditTaskId').val();
        console.log(editId);
         $.ajax({
                    url:'function.php',
                     type:"POST",
                     data:{editdy:editId},
                     success:function(res){
                         console.log(res);
                         $('.dyeditoption').html(res);
                     }
                 });
                     
                     
        
    });
   
    //EditTaskTypeData
    
   // AddTaskTypeData
    $("#AddTaskTypeData").on("submit",function(e){
         e.preventDefault();
          var formData= new FormData(this);
                  $.ajax({
                      url:'function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                   beforeSend: function () {
          $('#addmsg').html("<strong style='color:#ff7f50;'>Adding...</strong>");
        },
                     success : function(res){
                            $('#addmsg').html("<strong style='color:#green;'>Added Successfully...</strong>");
                           $('#TaskTypeId').html(res);
                           $('#EditTaskId').html(res);
                           $('#DeleteTaskId').html(res);
                           $('#AddTaskType').modal('toggle');
                           $('#addmsg').html("");
                            $("#AddTaskTypeData").trigger('reset');
                     }
                 });
    });
    
    
    $('#EditTaskTypeData').on("submit",function(e){
     e.preventDefault();
          var formData= new FormData(this);
          
               $.ajax({
                      url:'function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                   beforeSend: function () {
          $('#editmsg').html("<strong style='color:#ff7f50;'>Updting...</strong>");
        },
                     success : function(res){
                            $('#editmsg').html("<strong style='color:#green;'>Updated Successfully...</strong>");
                           $('#TaskTypeId').html(res);
                           $('#EditTaskId').html(res);
                           $('#DeleteTaskId').html(res);
                           
                          $('#editmsg').html("");
                            $("#EditTaskTypeData").trigger('reset');
                           $('#EditTaskType').modal('toggle');
                           
                     }
                 });
    
    });
    
    
    
    
        
    $('#DyAddTask').on("submit",function(e){
     e.preventDefault();
          var formData= new FormData(this);
               $.ajax({
                      url:'function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                      success : function(res){
                          console.log(res);
                          $("#DyAddTask").trigger('reset');
                          $('#CreateTask').modal('toggle');
                         
                     }
             
             });
    });
          
          
   
   </script>
       
       <script>
           
       function updateUserStatused(){
  $.ajax({
    url:'../Status/updateStatus.php',
    success:function(){
    }
  });

}
setInterval(function(){
updateUserStatused();
},3000);

        function updateActivity(){
            var activeon = 'KanBan log';
  $.ajax({
    type:'post',
    url:'../Status/updateStatus.php',
    data: {activity:activeon},
    success:function(){
    }
  });
}
setInterval(function(){
updateActivity();
},3000);
        </script>
  </body>
</html>