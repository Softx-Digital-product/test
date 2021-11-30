
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
?>

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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
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
    <title>CRM</title>
     
    
  </head>
 
  <style>
      
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
                   <a href="Training.php" class="nav_link"id="tr">Training</a>
        <a href="control.php" class="nav__link">Control panel</a>
      
<!--        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>-->
        
        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>

         <p class="mt-1  mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV ?></p>

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

<a href="CRM.php"class="btn btn-sm text-white btns-active" id="vv" >Vertical View</a>
          <a  href="AssignClientTable.php" class="btn btn-sm text-white"id="tv"> Assign Client- List View</a>
          <a href="Assignclientstable.php" class="btn btn-sm text-white" id="at">Assign To Client - Table view</a>

          <a class="btn btn-sm text-white " id='us' href="unassignclients.php" >Unassigned Client</a>
       
      </div>
      
      <!--- Nav part end -->