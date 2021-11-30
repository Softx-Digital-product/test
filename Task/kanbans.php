<?php
include '../UploadCase/Dp.php';
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
              <a class="nav_link ml-1 text-white p-2 "data-toggle="modal" data-target="#CreateTask" href="#" >Create  Task</a>
              <a class="nav_link ml-1 text-white p-2  active" href="KanBan.php" >Kan-Ban</a>
               <a class="nav_link ml-1 text-white p-2 " href="kanbanlogs.php" >Kan-Ban Logs</a>
                <a class="nav_link ml-1 text-white p-2 " href="#" >Performance</a>
      </div>
      <h2 class="text-center text-warning">under process</h2>
      
      <div class="container-fluid ">
          <div class="row">
              <div class="col-lg-2 bg-dark">
                  <div class="row">
                      <div class="col-lg-2 bg-info border p-0">
                            <div class="container-fluid m-0  vhead p-3 ">
                                <h2 class="text-white">SRN</h2>
                             </div>
                             <?php
                                        $sr = 1;
                                         $sql= "select * from TeamMembers";
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
                 <div class="col-lg-10 bg-info border p-0">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Team Members</h2>
                         </div>
                     <?php
                                        $sr = 1;
                                         $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                                            <div class="container-fluid mt-0 pt-3 box" style="cursor:pointer" onclick="ViewTasks('<?php echo $row['Sr_no']?>')"  id="dyuser">
                             
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
              <div class="col-lg-10  " id="dydata">
                  <div class="row">
                      <div class="col-lg-2 bg-success border p-0 ">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Backlogs</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 bg-success border p-0 ">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">In Process</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 bg-success border p-0">
                          <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Review</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 bg-success border p-0 ">
                          <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Approved</h2>
                         </div>
                      </div>
                         <div class="col-lg-2 bg-success border p-0">
                           <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Paper Book</h2>
                         </div>
                      </div>
                        <div class="col-lg-2 bg-success border p-0 ">
                            
                             <div class="container-fluid m-0 text-center vhead p-3 ">
                             <h2 class="text-white">Delivered</h2>
                         </div>
                            
                      </div>
                  </div>
              </div>
          </div>
          
          
      </div>
  


      <?php include 'Modals.php';?>

          
     

      <script>
    
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
        
function ViewTasks(sr){
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
           
             $("select").on("change",function(){
//            var state = $("#Processid").val(); 
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
        
           $("select").on("change",function(){
//            var state = $("#Processid").val(); 
            var selected = $(this).find('option:selected');
            var Id = selected.data('foo'); 
               var state = $(this).children("option:selected").val();
            console.log("-->"+state);
            
            console.log(state);
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