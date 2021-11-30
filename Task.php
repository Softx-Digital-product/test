<?php 
include 'Database/Dp.php';
date_default_timezone_set('Asia/Kolkata');
$dates= date('d-m-Y');
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

     <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
          <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
          <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
   <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>        
          
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    div.dataTables_wrapper div.dataTables_filter input {
/*    margin-left: .5em;*/
    display: inline-block;
    width: 40rem !important;

}
</style>
    
    <title>Task Management</title>
  </head>
  <body>
      <?php include 'Navbars.php';?>
   <div class="topnav1 p-0 ">
       <a class="nav_link  p-2 active " href="Task.php">View Tasks</a>
              <a class="nav_link ml-1 text-white p-2 "data-toggle="modal" data-target="#CreateTask" href="#" >Create  Task</a>
              <a class="nav_link ml-1 text-white p-2 " href="Task/KanBan.php" >Kan-Ban</a>
              <a class="nav_link ml-1 text-white p-2 " href="Task/kanbanlogs.php" >Kan-Ban Logs</a>
                <a class="nav_link ml-1 text-white p-2 " href="#" >Performance</a>
                <a class="nav_link ml-1 text-white p-2 " href="Task/restoretask.php" >Deleted Task</a>
                <a class="nav_link ml-1 text-white p-2 " href="Task/Apt.php" >Aditya Pratap Tasks</a>
      </div>

      <div class="Container-fluid p-0">
            <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='TaskList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date" scope="col">Date</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Name" scope="col">Client</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Case Name" scope="col">Case</th>
                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Task Type" scope="col">Task Type </th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Task Name" scope="col">Task Name</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Assigned Team-member" scope="col">Assign To</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Deadline" scope="col">Deadline</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="View" scope="col">View</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody class="dytables">
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
Tasks.DelStatus = '0' ORDER BY Tasks.Sr_no desc";
                                        
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
                                                
                                        ?>
                                    </tbody>
                                </table>
            </div>
          
      </div>
      
      
      <?php include 'Task/Modals.php';
 include 'Drafting/modals.php';
      
      ?>
      
      
      <script>
        
          document.getElementById("Daddbtn").addEventListener("click",AddDraftTypes);
        function AddDraftTypes(){
             let DTN=  document.getElementById("Dadd").value;
           
             if(DTN != ''){
                 
                     $.ajax({
                            url:"Drafting/Dyfunctions.php",
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
                            url:"Drafting/Dyfunctions.php",
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
                            url:"Drafting/Dyfunctions.php",
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
                            url:"Drafting/Dyfunctions.php",
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
                            url:"Drafting/Dyfunctions.php",
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
                            url:"Drafting/Dyfunctions.php",
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
      
      <script>
          $("select").select2();
              $("#EditTaskId").on("change",function(){
        var editId= $('#EditTaskId').val();
        console.log(editId);
         $.ajax({
                    url:'Task/function.php',
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
                      url:'Task/function.php',
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
                      url:'Task/function.php',
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
                      url:'Task/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                      success : function(res){
                          console.log(res);
                          $("#DyAddTask").trigger('reset');
                          $('#CreateTask').modal('toggle');
                           dytables();
                     }
             
             });
    });
          
     
          
          </script>
      
      
      
      <script>
          
                $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

          function Viewtask(sr){
//              alert(sr);
  $.ajax({
                    url:'Task/kanbanfunction.php',
                     type:"POST",
                     data:{VewTaskId:sr},
                     success:function(res){
                         console.log(res);

              $('.dyviewTasks').html(res);
              
              
    }
    });
          }
          function Deltask(sr){
             swal({
  title: "Are you sure?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      
       $.ajax({
                    url:'Task/function.php',
                     type:"POST",
                     data:{DelTaskId:sr},
                     success:function(res){
                         console.log(res);
                         dytables ()
                           swal("Deleted Successfully", {
      icon: "success",
    });
                     }
                 });
      
      
      
  
  } else {
   
  }
});
          }
         
          
        
        function dytables (){
               $.ajax({
                    url:'Task/function.php',
                     type:"POST",
                     data:{table:1},
                     success:function(res){
                       //  console.log(res);
                         $('.dytables').html(res);
        
                         
                     }
                 });
        }
         $('#TaskList').DataTable({
        "bFilter": true,
        "bInfo": true,
       // "bSort":false,
//        "bSortable":false,
        "paging":   true,
        "responsive": true,
        "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
        "ordering": true,
         language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search  Tasks"
            },
            
            
     
      
    });
          
                                    $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
          
            $('#mybottomnav').hide();
        $('#CM').removeClass('active');
        $('#taskm').addClass('active');
        
         
        
          
           
           
           
           
          </script>
          
          
          <script>
                $("#ClientId").on("change", function () {
                    var clientId = $("#ClientId").val();
                        $.ajax({
//                        url: "UploadCase/CaseNameDy.php",
                            url:"Calendar/function.php",
                        type: "POST",
                        cache: false,
                       // data: {countryId: cid},
                        data: {clientdids: clientId},
                        success: function (data) {
                            console.log(data);
                            $("#CaseId").html(data);

                        }
                    });
                    
    });
    
      
                    
  
   
              
               
               
                
              
              </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

   
   <script>
    
       
       </script>
    <script>
        
        
 
       function updateUserStatused(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){
    }
  });

}
setInterval(function(){
updateUserStatused();
},3000);
  
        function updateActivity(){
            var activeon = 'Task Management';
  $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
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