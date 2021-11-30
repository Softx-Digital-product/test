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
      <div calss="container-fluid bg-white p-0" >
          <div class="row">
              <div class="col-lg-2 p-0">
                  <div class="tables p-0">
                                                      <table class="table table-striped table-bordered   table-hover " id='TeamList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Team Member Name" scope="col">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodys">
                                        <?php
                                        $sql="SELECT * FROM TeamMembers";
                                         $quariy = $con->query($sql);
                                 
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                        ?>
                                        <tr>
                                            <td class="text-center text-nowrap"  onclick="viewTasks('<?php echo $row['Sr_no'];?>')" scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Name']?>"><?php echo $row['Name']." ".$row['Surname']; ?></td>
                                        </tr>
                                        <?php
                                        }}
                                        ?>
                                    </tbody>
                                                      </table>
                  </div>
              </div>
              <div class="col-lg-2 p-0">
                  <div class="tasktable p-0">
                      <table class="table table-striped table-bordered   table-hover " id='TaskList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Tasks</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodys">
                                        
                                    </tbody>
                      </table>
                  
                  </div>
              </div>
              <div class="col-lg-2 p-0 bg-warning">
                  <div class="Inprocess">
                          <table class="table table-striped table-bordered   table-hover " id='ProcessList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">In Process</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodys">
                                        
                                    </tbody>
                                    
                          </table>
                      
                  </div>
              </div>
              <div class="col-lg-2 p-0  bg-secondary">
                  <div class="Review">
                          <table class="table table-striped table-bordered   table-hover " id='ReviewkList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Review</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodys">
                                        
                                    </tbody>
                          </table>
                      
                  </div>
                  
              </div>
              <div class="col-lg-2 p-0 bg-primary">
                <div class="Approved">
                          <table class="table table-striped table-bordered   table-hover " id='ApprovedList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Approved</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodys">
                                  
                                        
                                    </tbody>
                                        
                                   
                          </table>
                      
                  </div>
                  
              </div>
              <div class="col-lg-2 p-0  bg-success">
                  
                  <div class="Delivered">
                          <table class="table table-striped table-bordered   table-hover " id='DelieveredList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tasks" scope="col">Delivered</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbodys">
                                        
                                    </tbody>
                          </table>
                      
                  </div>
                  
              </div>
          </div>
      </div>
      
      
      
      <script>
          
          
 
  


                                          
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




                 
                   