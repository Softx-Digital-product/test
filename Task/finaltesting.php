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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
          .box:nth-of-type(odd) {
background-color:#98D7C2;

}

.box:nth-of-type(even) {
background-color:#fff;
}
.mtext {
    cursor: pointer;
}
 .cd label{
                font-family: verdana;
                font-size: 16px;
                color:black;
            }
            .vhead{
                background: #008080;

            }
            .border h2{
                font-size: 16px;
                color:black;
            }
            .border a{
                font-size: 16px;
                color:black;
            }
            .test{
                color:white;
                background: #008080;

            }
            #srno{
                width:20% ! important;
            }
            .rowbg{
                border: 3px solid red;
            }
            .block {
    z-index: 2;
    position: relative;
}
    </style>

    <title>Task- Kan-Ban</title>
  </head>
  <body>
       <?php include 'Innerheader.php';?>
        <div class="topnav1 p-0 ">
          <a class="nav_link  p-2  " href="../Task.php">View Tasks</a>
              <a class="nav_link ml-1 text-white p-2 d-none"data-toggle="modal" data-target="#CreateTask" href="#" >Create  Task</a>
              <a class="nav_link ml-1 text-white p-2 " href="../Task.php" >Create  Task</a>

              <a class="nav_link ml-1 text-white p-2  active" href="KanBan.php" >Kan-Ban</a>
               <a class="nav_link ml-1 text-white p-2 " href="kanbanlogs.php" >Kan-Ban Logs</a>
                <a class="nav_link ml-1 text-white p-2 " href="#" >Performance</a>
                <a class="nav_link ml-1 text-white p-2 " href="restoretask.php" >Deleted Task</a>
                <a class="nav_link ml-1 text-white p-2 " href="Apt.php" >Aditya Pratap Tasks</a>
      </div>
     
      
      <div class="container-fluid ">
          <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-2 ">
                  <div class="row">
                      <div class="col-lg-2 col-md-2 col-sm-2 border p-0">
                            <div class="container-fluid m-0  vhead p-3 ">
                                <h2 class="text-white">SRN</h2>
                             </div>
                             <?php
                                        $sr = 1;
                                         $sql= "select * from TeamMembers WHERE  status = 'Active'";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                                                <div class="container-fluid mt-0 pt-3 box">
                                                    <a class="text-center mt-2 mtext" ><?php  echo $sr; ?></a><br><br>
                                     
                         </div> 
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                      </div>
                 <div class="col-lg-10 col-md-10 col-sm-10 bg-info border p-0">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Team Members</h2>
                         </div>
                     <?php
                                        $sr = 1;
                                         $sql= "select * from TeamMembers where status = 'Active'";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                                            <div class="container-fluid mt-0 pt-3 box boxs " style="cursor:pointer" onclick="ViewTasks('<?php echo $row['Sr_no']?>')"  id="dyuser<?php echo $row['Sr_no']?>">
                             
                                            <a class="text-center pt-3 mtext" id="test<?php echo $row['Sr_no']?>" ><?php  echo $row['Name'].' '.$row['Surname']."<br>"; ?></a>
                                            <br>
                         </div>  
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                      </div>
                  </div>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-10 " id="dydata">
                  <div class="row">
                      <div class="col-lg-2 col-md-2 col-sm-2 bg-success border p-0 ">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Backlogs</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2 bg-success border p-0 ">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">In Process</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2 bg-success border p-0">
                          <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Review</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2 bg-success border p-0 ">
                          <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Approved</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 col-md-2 col-sm-2 bg-success border p-0">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Paper Book</h2>
                         </div>
                      </div>
                        <div class="col-lg-2 col-md-2 col-sm-2  bg-success border p-0 ">
                            
                             <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Delivered</h2>
                         </div>
                            
                      </div>
                  </div>
              </div>
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

      <script>
          $("#ClientId").on("change", function () {
                    var clientId = $("#ClientId").val();
                        $.ajax({
//                        url: "UploadCase/CaseNameDy.php",
                            url:"../Calendar/function.php",
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
          
    $('select').select2();
       function Back(state,sr,teamId){
          // alert(state);
          
           if(state == '0'){
          alert('Your Task is At the Starting Point');
       }else{
           
               if(state == '2'){
                  state =0;
              }
               else{
                   state--;
               }
               
              // alert("Else"+state);
                $.ajax({
                url:'dytables.php',
                type:"POST",
                data:{State:state,Srid:sr},
                success:function(res){
                    console.log(res);
                    dydataes(teamId);
                }
            });
           }
          
       }  
       function Forw(state,sr,teamId){
         //  alert(state);
           if(state == '0'){
               state = state+2;
                 $.ajax({
                url:'dytables.php',
                type:"POST",
                data:{State:state,Srid:sr},
                success:function(res){
                    console.log(res);
                    dydataes(teamId);
                }
            });
           //    alert(state);
           }else if(state == '6'){
               alert('Task Has Been Completed!!!');
           }
           
           else{
               state++;
              // alert("Else"+state);
                $.ajax({
                url:'dytables.php',
                type:"POST",
                data:{State:state,Srid:sr},
                success:function(res){
                    console.log(res);
                    dydataes(teamId);
                }
            });
           }
           
       }
     ViewTasks(5);
function ViewTasks(sr){
       $(".boxs").removeClass("rowbg");
    $("#dyuser"+sr).addClass('rowbg');
  //  alert(sr);
          console.log("clicked "+sr);
                 $.ajax({
                    url:'dytables.php',
                     type:"POST",
                     data:{Tasks:sr},
                     success:function(res){
                                //    console.log(res);
                        $('#dydata').html(res);
                         $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
       $("select").on("change",function(){
//            var state = $("#backlogid").val(); 
            var selected = $(this).find('option:selected');
            var Id = selected.data('foo'); 
            var state = $(this).children("option:selected").val();
            console.log("-->"+state);
//            console.log(state);
            console.log(Id);
            
            $.ajax({
                url:'dytables.php',
                type:"POST",
                data:{State:state,Srid:Id},
                success:function(res){
                    console.log(res);
                    dydataes(sr);
                }
            });
           
    });
           
//             $("select").on("change",function(){
////            var state = $("#Processid").val(); 
//            var selected = $(this).find('option:selected');
//            var Id = selected.data('foo'); 
//               var state = $(this).children("option:selected").val();
//            console.log("-->"+state);
////            console.log(state);
//            console.log(Id);
//            
//            $.ajax({
//                url:'dytables.php',
//                type:"POST",
//                data:{State:state,Srid:Id},
//                success:function(res){
//                    console.log(res);
//                    dydataes(sr);
//                }
//            });
//            
//            
//            
//            
//            
//        });
       
       
       
                     }
                 });
    
}

dydataes = (sr)=>{
      $.ajax({
                    url:'dytables.php',
                     type:"POST",
                     data:{Tasks:sr},
                     success:function(res){
                               //  console.log(res);
                        $('#dydata').html(res);
                         $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});


 $("select").on("change",function(){
//            var state = $("#backlogid").val(); 
          
            var selected = $(this).find('option:selected');
            var Id = selected.data('foo'); 
   var state = $(this).children("option:selected").val();
            console.log("DT -->"+state);
            
            console.log(Id);
            
            $.ajax({
                url:'dytables.php',
                type:"POST",
                data:{State:state,Srid:Id},
                success:function(res){
                    console.log(res);
                    dydataes(sr);
                }
            });
        });
        
//           $("select").on("change",function(){
////            var state = $("#Processid").val(); 
//            var selected = $(this).find('option:selected');
//            var Id = selected.data('foo'); 
//               var state = $(this).children("option:selected").val();
//            console.log("-->"+state);
//            
//            console.log(state);
//            console.log(Id);
//            
//            $.ajax({
//                url:'dytables.php',
//                type:"POST",
//                data:{State:state,Srid:Id},
//                success:function(res){
//                    console.log(res);
//                    dydataes(sr);
//                }
//            });
//        });
        
        
        
                     }
                 });
                 
                 
                 
                 
}


const viewdetails = ViewDetails= (sr)=>{
      $.ajax({
                    url:'kanbanfunction.php',
                     type:"POST",
                     data:{VewTaskId:sr},
                     success:function(res){
//                         console.log(res);
              $('#ViewTaskData').modal('toggle');
              $('.dyview').html(res);
              
                     }
                 });
             }
      </script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

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
            var activeon = 'KanBan';
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