<?php 
include '../UploadCase/Dp.php';


header('Location: http://apajuris.in/work/Task/finaltesting.php');
die();
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
    </style>
    
    <title>Task- Kan-Ban</title>
  </head>
  <body>
       <?php include 'Innerheader.php';?>
        <div class="topnav1 p-0 ">
          <a class="nav_link  p-2  " href="../Task.php">View Tasks</a>
              <a class="nav_link ml-1 text-white p-2 "data-toggle="modal" data-target="#CreateTask" href="#" >Create  Task</a>
              <a class="nav_link ml-1 text-white p-2  active" href="KanBan.php" >Kan-Ban</a>
                <a class="nav_link ml-1 text-white p-2 " href="#" >Performance</a>
      </div>
      <h2 class="text-center text-warning">under process</h2>
      <div calss="container-fluid p-0" >
          <div class="row">
              <div class="col-xl-3 p-0">
                  <div class="row">
                      <div class="col-md-3 text-center border p-0">
                          <div class="contianer-fluid vhead  pt-2 p-3  ">
                             <h2 class="text-center  font-weight-bolder text-white">SRN</h2>
                             
                         </div>
                         <div class="container-fluid box">
                             
                         </div>
<!--                         <h2 class="text-center mb-1 mt-2 ">SRN</h2>-->
                        
                                <?php
                                        $sr = 1;
                                         $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                 ?>
                                                <div class="container-fluid mt-0 pt-4 box">
                                                    <a class="text-center mt-2 mtext" ><?php  echo $sr."<br>"; ?></a><br>
                                            <a class="text-center h3 mt-2" ><?php  $row['Name'].' '.$row['Surname']."<br>"; ?></a>
                                         
                         </div> 
                            
                                               
                                        <?php
                                          $sr++;
                                        }}
                                            ?>
                         
                     </div>
                      
                        <div class="col-md-9 text-center border p-0">
                          <div class="contianer-fluid m-0 vhead  pt-2 p-3 ">
                             <h2 class="text-center text-white">Team </h2>
                             
                         </div>
                         <div class="container-fluid box">
                             
                         </div>
<!--                         <h2  class="text-center mb-2 mt-2">Team </h2>-->
                         
                          <?php
                                        $sr = 1;
 
                                        $sql="SELECT * FROM TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                 ?>
                                              
<!--                            <a class="text-center h3 mt-2" ><?php // echo $sr."<br>"; ?></a>-->
                         <div class="container-fluid mt-0 pt-4 box" style="cursor:pointer" onclick="ViewTasks('<?php echo $row['Sr_no']?>')"  id="dyuser">
                             
                                            <a class="text-center pt-3 mtext" id="test<?php echo $row['Sr_no']?>"    ><?php  echo $row['Name'].' '.$row['Surname']."<br>"; ?></a>
                                            <br>
                         </div>  
                                        <?php
                                          $sr++;
                                        }
                                      
                                            }
                                            ?>
              </div>
                  </div>
                   
                  
             
                   </div>
              <div class="col-xl-9">
                  <div class="tables">
                      <table class="table table-striped table-bordered   table-hover " id='KanLists'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">New Tasks</th>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">In Process</th>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Review</th>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Aproved</th>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Delivered</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody class="tbodys">
                                        <tr>
                                            
                                        </tr>
                                    </tbody>
                          </table>
                  </div>
              </div>
                  
              </div>
          </div>

      
      <?php include 'Modals.php';?>
      
      <script>
          
          const viewtask = ViewTasks = (sr)=>{
             // alert("Under Development");
               $.ajax({
                    url:'kanbanfunction.php',
                     type:"POST",
                     data:{viewtables:sr},
                     success:function(res){
                         console.log(res);
                         $('.tbodys').html(res);
                     }
                     
        });
             // alert(sr);
          }
 
  
   function viewdetails (sr){
              console.log("clicked "+sr);
                 $.ajax({
                    url:'kanbanfunction.php',
                     type:"POST",
                     data:{VewTaskId:sr},
                     success:function(res){
                         console.log(res);
              $('#ViewTaskData').modal('toggle');
              $('.dyview').html(res);
              
              
    }
    });
              
    };

      
      const viewtasks= viewTasks = (sr)=>{
         // alert('Under building');
          
            $.ajax({
                    url:'kanbanfunction.php',
                     type:"POST",
                     data:{TeamId:sr},
                     success:function(res){
                         console.log(res);
                         $('.tasktable').html(res);
                         
//                          $(document).ready(function() {
//  var $tabs = $('#ProcessList');
//  $(".tbodys").sortable({
//    cursor:"move",
//    zIndex: 999990
//  }).disableSelection();
//
//});
 $(document).ready(function() {
  var $tabs = $('#ProcessList')
  $("tbody.tbodys").sortable({
    connectWith: ".tbodys",
    items: "> tr:not(:first)",
    appendTo: $tabs,
    helper:"clone",
    zIndex: 999990
  }).disableSelection();
  
  var $tab_items = $(".nav-tabs > li", $tabs).droppable({
    accept: ".tbodys tr",
    hoverClass: "ui-state-hover",
    drop: function( event, ui ) { return false; }
  });
});  



   
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