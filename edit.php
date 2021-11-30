<?php 
include 'KnowledgeDb/Dp.php';
date_default_timezone_set('Asia/Kolkata');
$dates= date('d-m-Y');
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

         <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
   <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

     <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
          <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
             
          
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    
    <title>Task Management</title>
  </head>
  <body>
      <?php include 'Navbars.php';?>
   <div class="topnav1 p-0 ">
          <a class="nav_link  p-2 active " href="viewTask">View Tasks</a>
              <a class="nav_link ml-1 text-white p-2 "data-toggle="modal" data-target="#CreateTask" href="#" >Create  Task</a>
               <a class="nav_link ml-1 text-white p-2 " href="#" >Kan-Ban</a>
                <a class="nav_link ml-1 text-white p-2 " href="#" >Performance</a>
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
                                    <tbody>
                                        <?php 
                                        
                                        $sr=1;
                                        $sql="SELECT Tasks.Sr_no as Tasksr, Tasks.Task_Name, DStatus.DStatus as Status, ClientDb.Full_Name, Client_CaseDb.Case_Name, Task_Type.Task_Name as TaskTypeN, Task_Type.Task_Color, TeamMembers.Name as FTeamN, TeamMembers.Surname as LTeamN, Tasks.SDate, Tasks.EDate, Tasks.TaskDesc 
FROM Tasks, DStatus, ClientDb, Client_CaseDb, Task_Type, TeamMembers
WHERE 
Tasks.Status_Id = DStatus.Sr_no  AND 
Tasks.Client_Id = ClientDb.Sr_no  AND
Tasks.Case_Id = Client_CaseDb.Sr_no AND 
Tasks.TaskType_Id = Task_Type.Sr_no AND 
Tasks.AssignTo_Id = TeamMembers.Sr_no";
                                        
                                          $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                              
                                                  $Sdate= date('d-m-Y', strtotime($row['SDate']));
                                                 $Edate = date('d-m-Y', strtotime($row['EDate']));
                                                ?>
                                       
                                        <tr>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $sr?>"><?php echo $sr ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $Sdate;?>"><?php echo $Sdate; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Full_Name'];?>"><?php echo $row['Full_Name']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Case_Name'];?>"><?php echo $row['Case_Name']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['TaskTypeN'];?>"><?php echo $row['TaskTypeN']; ?></td>
                                              <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Task_Name'];?>"><?php echo $row['Task_Name']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['FTeamN']?>"><?php echo $row['FTeamN']." ".$row['LTeamN']; ?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $Edate;?>"><?php echo $Edate;?></td>
                                             <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Status'];?>"><?php echo $row['Status']; ?></td>
                                              <th class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row[''];?>"><a class="text-primary"> View</a></th>
                                              <th class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row[''];?>"><a class="text-primary">Edit</a></th>
                                              <th class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row[''];?>"><a class="text-danger"> Delete</a></th>
                                             
                                              
                                        </tr>
                                         <?php
                                            }
                                        }
                                                
                                        ?>
                                    </tbody>
                                </table>
            </div>
          
      </div>
      
      
      <?php include 'Task/Modals.php';?>
      
      
      
      
      <script>
          
          
        
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
                searchPlaceholder: "Search Event"
            },
     
      
    });
          
          
            $('#mybottomnav').hide();
        $('#CM').removeClass('active');
        $('#taskm').addClass('active');
        
        
        $("select").select2();
           $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy'});
           let date;
           $('#Sdate').on("change",function(){
             date=  $("#Sdate").val();
               $('#Edate').val(date);
               
           });
           
           
           
           
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