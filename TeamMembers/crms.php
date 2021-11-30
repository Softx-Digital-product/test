 <?php
include '../UploadCase/Dp.php';

$time = time();

 ini_set('session.save_path', '../session');
session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    
    
}else{
//        
        header("Location:http://apajuris.in/work/index.php");
       die();
}


if(isset($_POST['clientassgin'])){
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    $sr= mysqli_real_escape_string($con,$_POST['TidDy']);
    
   $clientName = mysqli_real_escape_string($con,$_POST['clientName']);
       $ClientId = mysqli_real_escape_string($con,$_POST['Cname']);
        $Desc = mysqli_real_escape_string($con,$_POST['note']);
    
    $Column =  mysqli_real_escape_string($con,$_POST['ColumnDy']);
    
    $srsql= "Select * From TeamMembers WHERE Sr_no = '$sr'";
    //echo $srsql; 
    $tid ="";
     $sql = mysqli_query($con, $srsql);
     while ($row = $sql->fetch_assoc()) {

               $tid= $row['Tid'];                         
     }

      $Cupdate="Update clientAssign SET $Column = '$clientName' WHERE Tid = '$tid'";
      //echo $Cupdate;
      if ($con->query($Cupdate) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
      
      
      $ClientDbUpdate= "UPDATE ClientDb SET Assign = '$sr' WHERE Sr_no = '$ClientId'";
      //echo $ClientDbUpdate;
      if ($con->query($ClientDbUpdate) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
      
      $Asql="INSERT INTO `1005138-sahyog`.`assignteam` (`Name`, `Client_Name`, `Case_Name`, `Status`, `Desc`,`AssignNo`) "
        . "VALUES ($sr, $ClientId, '0', 'Active', '$Desc','$Column')";
      
//      echo $Asql;
       if ($con->query($Asql) === TRUE) {
      header("Refresh:0");
} else {
  echo "Error: ----->" . $Asql . "<br>" . $con->error;
}
      
     
     
     
     Die();
     
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="../assets12/css/sam.css">
          <link rel="stylesheet" href="../Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


                    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        
    <title>CRM</title>
     
    
  </head>
 
  <style>
      .Selected{
        background: #40e0d0;
      }
      .btns-active{
  background:#40e0d0;

  color: white;
    
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
            
            .box:nth-of-type(odd) {
background-color:#98D7C2;

}
    
.box:nth-of-type(even) {
background-color:#fff;
}
.mtext {
    cursor: pointer;
}
.rowbg{
      border: 3px solid red;
}
box{
    cursor: pointer;
}
  </style>
  
  <body>
       <div class="topnav" id="myTopnav">


        <a href="../Cms.php" class="nav__link">DashBoard</a>
        <a href="../Teams.php" class="nav__link active" id="TM">Team</a>
        <a href="../Task.php" class="nav_link">Task Management</a>
         <a href="../calendar.php" class="nav_link">Calendar</a>
        <a href="../library.php" class="nav__link">Library</a>
        <a href="../knowledge.php" class="nav__link ">Knowledge</a>
        <a href="../Clients.php" id="CM"class="nav__link">Clients </a>
       
        <a href="../Drafting.php"class="nav_link">Drafting</a>
          <a href="../editor.php" class="nav_link" id='ed'>Editor</a>
             <a href="../Pleadings.php"class="nav_link"id="pl">Pleading</a>
<!--        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>-->
            <a href="Training.php" class="nav_link"id="tr">Training</a>
        <a href="control.php" class="nav__link">Control panel</a>
        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>

         <p class="mt-1 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV ?></p>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>
 
          <div class="topnav1">
            <a href="../Team.php" class="nav__link ">View Team</a>
            <a href="" class="nav_link active">CRM</a>
            <a href="ActivityLog.php" class="nav_link">Activity Logs</a>
            <a href="Analytics.php" class="nav__link" >Analytics</a>
           
      </div>
      <div class="vc p-1">
<!--          <button class="btn btn-sm  text-White btns-active" id="vv">Vertical View</button>
          <button class="btn btn-sm text-white"id="tv">Table View- Assign Client</button>
          <button class="btn btn-sm text-white" id="at">Assign To Client - Table view</button>-->

 <a class="btn btn-sm text-white btns-active" id="vv" >Vertical View</a>
          <a  href="AssignClientTable.php" class="btn btn-sm text-white"id="tv">Table View- Assign Client</a>
          <a href="Assignclientstable.php" class="btn btn-sm text-white" id="at">Assign To Client - Table view</a>

          <a href="unassignclients.php" class="btn btn-sm text-white">Unassigned Client</a>
       
      </div>
      
      <!--- Nav part end -->
      
      <div class="container-fluid p-0">
              <div class="container-fluid " id="VList">
<!--                 <h2 class="Text-center text-danger">under process</h2>-->
                 <div class="row">
                     <div class="col-md-1 text-center border p-0">
                          <div class="contianer-fluid vhead  pt-2 ">
                             <h2 class="text-center  mt-2 text-white">SRN</h2>
                             <br>
                         </div>
                         <div class="container-fluid box">
                             
                         </div>
                                <?php
                                        $sr = 1;
                                         $sql= "select * from TeamMembers WHERE status ='Active' ";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                 ?>
                                                <div class="container-fluid mt-0 pt-4 box">
                                                    <a class="text-center mt-2 mtext" ><?php  echo $sr."<br>"; ?></a><br>
                                            <a class="text-center h3 mt-2" ><?php  $row['Name'].' '.$row['Surname']."<br>"; ?></a>
                                         
                         </div> 
                            
                                               
                                        <?php
                                          $sr++;
                                        }
                                      
                                            }
                                            ?>
                         
                     </div>
                 
                     <div class="col-md-2 text-center border p-0">
                          <div class="contianer-fluid vhead  pt-2 ">
                             <h2 class="text-center mb-2 mt-2 text-white">Team </h2>
                             <br>
                         </div>
                         <div class="container-fluid box">
                             
                         </div>

                         
                          <?php
                                        $sr = 1;
//                                         $sql= "SELECT ClientDb.Full_Name, ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status, assignteam.Desc,assignteam.Status,assignteam.assign
//FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
//$sql ="SELECT ClientDb.Full_Name,TeamMembers.Name, TeamMembers.Surname, TeamMembers.UserName FROM ClientDb,TeamMembers, assignteam WHERE ClientDb.Sr_no = assignteam.Client_Name AND TeamMembers.Sr_no = assignteam.Name  GROUP BY  TeamMembers.UserName   ;
// ";       
                                        $sql="SELECT * FROM TeamMembers WHERE status ='Active'";
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
                         <div class="container-fluid mt-0 pt-4 box " id="dyuser<?php echo $row['Sr_no']; ?>" onclick="client('<?php echo $row['UserName'];?>',<?php echo $row['Sr_no'];?>)">
                             
                                            <a class="text-center pt-3 mtext" id="test<?php echo $row['UserName']?>"    ><?php  echo $row['Name'].' '.$row['Surname']."<br>"; ?></a>
                                            <br>
                         </div>  
                                        <?php
                                          $sr++;
                                        }
                                      
                                            }
                                            ?>
                         
                     </div>
                     <div class="col-md-2 border p-0">
                         <div class="contianer-fluid vhead  pt-2 ">
                             <h2 class="text-center mb-2 mt-2 text-white">Client Name </h2>
                             <br>
                         </div>
                         
                         <div class="container-fluid p-0 " id="dyclientN">
                             
                         </div>
                     </div>
                     <div class="col-md-3 border p-0 ">
                         <div class="contianer-fluid vhead pt-2 ">
                             <h2 class="text-center mb-2 mt-2 text-white">Case Name </h2>
                             <br>
                         </div>
                          <div class="container-fluid p-0 box" id="dycaseN">
                             
                         </div>
                     </div>
                     <div class="col-md-4 border p-0">
                          <div class="contianer-fluid vhead  pt-2 ">
                             <h2 class="text-center mb-2 mt-2 text-white">Case Details</h2>
                             <br>
                         </div>
                          <div class="container-fluid" id="dydetailsN">
                             
                         </div>
                     </div>
                 </div>
             </div>
      </div>
      

      <script>
 
        
         $('select').select2();
            function assigned(sr,col){
        console.log(sr);
        console.log(col);
       
        $('#ColumnDy').val(col);
        $('#TidDy').val(sr);
    }
    
          $('#UserList').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Team Member"
            }
        });
        
            $('#unassigned').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Client"
            }
        });
          
             
          $("#tv").click(function(){
              $('#vv').removeClass('btns-active');
              $('#at').removeClass('btns-active');
              $('#tv').addClass('btns-active');
             console.log('Hello inside tv');
             
              $("#VList").hide();
             $("#VLists").show();
             $("#VListed").hide();
             $('div.dataTables_wrapper').show();
            
         });
         $("#vv").click(function(){
             console.log('Hello inside vv');
               $('#tv').removeClass('btns-active');
               $('#at').removeClass('btns-active');
              $('#vv').addClass('btns-active');
              $("#VLists").hide();
             $("#VList").show();
             $('#VListed').hide();
             $('div.dataTables_wrapper').hide();
            
         });
         
         $("#at").click(function(){
             console.log('Hello inside at');
               $('#tv').removeClass('btns-active');
               $('#vv').removeClass('btns-active');
              $('#at').addClass('btns-active');
              $("#VLists").hide();
             $("#VList").hide();
             $('#VListed').show();
             $('div.dataTables_wrapper').hide();
            
         });
         
         
//         $("#VLists").hide();
//         $('#VListed').hide();
      
          
              // $('#test'+name).removeClass("Selected");
              client('Rjweb',5);
         function client(name,sr){
             $(".box").removeClass("rowbg");
             $("#dyuser"+sr).addClass("rowbg");

   //$('#test'+name).addClass("Selected");
   
//   $("#dyuser").addClass('Selected');
    
    console.log(name);
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "dytables.php", 
       data: {ClientName:clientName},
      success: function(res) { 
      //  console.log(res);
       // dyclientN
        $('#dyclientN').html(res);
        
        
//        caseN('Aditya Pratap',5);
//        $('#dycaseN'+sr).html(res);
     // location.reload();
 } 
        
});  
    
}
function caseN(name,sr){
    console.log(name+sr);
    $('.dyboxs').removeClass("rowbg");
    $("#clientN"+sr).addClass("rowbg");
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "dytables.php", 
       data: {CaseName:clientName},
      success: function(res) { 
//        console.log(res);
       // dyclientN
        $('#dycaseN').html(res);
//        $('#dycaseN'+sr).html(res);
     // location.reload();
//     caseD('Aditya Pratap vs Audi Mumbai South',37);
 } 
       
});  
    
}


function caseD(name,sr){
    console.log(name+sr);
    
    $('.dybox').removeClass("rowbg");
    
    $("#caseN"+sr).addClass("rowbg");
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "dytables.php", 
       data: {CaseDetails:clientName},
      success: function(res) { 
      //  console.log(res);
       // dyclientN
        $('#dydetailsN').html(res);
//        $('#dycaseN'+sr).html(res);
     // location.reload();
 } 
       
});  
    
}
      </script>
      
      
          <script>
        
            function updateUserStatus(){
  $.ajax({
    url:'../Status/updateStatus.php',
    success:function(){

    }
  });

}
setInterval(function(){
updateUserStatus();
},3000);
            
        </script>
        
        
       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>
    