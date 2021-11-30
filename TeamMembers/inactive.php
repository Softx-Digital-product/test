<?php
include '../UploadCase/Dp.php';

$time = time();

 ini_set('session.save_path', '../session');
session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
//    echo  $_SESSION['role'];
    
    
}else{
//        
        header("Location:http://apajuris.in/work/index.php");
       die();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
 <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="../assets12/css/sam.css">
          <link rel="stylesheet" href="../Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <title>Inactive Team-Member</title>
     <style>
        
          .btns-active{
  background:#40e0d0;

  color: white;
    
}
/*        .cc .btn{
        background:teal;
        
    }*/
/*    .vc {
        height:32px;
    }*/
   .active{
        background:#40e0d0;
        padding:8px;
    }
   .modal-xl {
    max-width: 60% !important;
}
    </style>
  </head>
  <body>
      
       <div class="topnav" id="myTopnav">


        <a href="../Cms.php" class="nav__link">DashBoard</a>
        <a href="../Teams.php" class="nav__link active" id="TM">Team</a>
         <a href="../task.php" class="nav_link">Task Management</a>
         <a href="../calendar.php" class="nav_link">Calendar</a>
        <a href="../library.php" class="nav__link">Library</a>
        <a href="../knowledge.php" class="nav__link ">Knowledge</a>
        <a href="../Clients.php" id="CM"class="nav__link">Clients </a>
        <a href="../Drafting.php"class="nav_link ">Drafting</a>
               <a href="../Pleadings.php"class="nav_link"id="pl">Pleading</a>
      
<!--        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>-->
        <a href="#" class="nav__link">Control panel</a>
        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>

         <p class="mt-1 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV; ?></p>

<!--        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>-->

    </div>
      <div class="topnav1">
          <a href="../Teams.php" class="nav__link active" >View Team</a>
            <a href="CRM.php" class="nav_link ">CRM</a>
            <a href="Analytics.php" class="nav__link" >Analytics</a>
            
    
      </div>
     <div class="vc p-1">
         <a href="../Teams.php" class="btn text-center btn-sm mt-1 mb-1  text-white">View Team Members</a>
<!--          <button type="button" class="btn text-center btn-sm mt-1 mb-1 text-white" data-toggle="modal" data-target="#AddMember">Add Team Member</button>-->
          <a href='../Teams.php' class="btn btn-sm text-white">Add Team Members</a>
          <a class="btn btn-sm text-white " href='../Team.php' data-toggle="modal" data-target="#Unassign" >Unassigned Client</a>
<a class="btn btn-sm text-white" href='../Teams.php'id="verticaltable" data-toggle="modal" data-target="#AssignClient">Assign Team Member</a>
          <a class="btn btn-sm text-white btns-active" href="inactive.php"  >Inactive Or Left</a>
          <a class="btn btn-sm text-white" href="teaminfo.php"  >Team Info</a>
       
      </div>
     
      <div class='container-fluid p-0'>
           <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='UserList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Full Name</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Email Address" scope="col">Email</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Phone</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">DOB</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">UserName</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="Address"scope="col">Address</th>
<!--                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Attendance" scope="col">Attendance</th>-->
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th><!--
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Activity" scope="col">Activity</th>
-->                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="view" scope="col">View</th><!--
                                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="Analytics" scope="col">Analytics</th> -->
                                                         
                                                         
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>   


                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;
                                        
                                        $quariy = $con->query("SELECT * FROM TeamMembers WHERE status != 'Active' ");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                
                                                  $status= 'Idle';
                                                  $class = 'btn-danger';
                                                 $aclass= 'btn-warning text-white';
                                                 $Lclass='btn-info';
                                                  $Attendance = 'Offline';
                                                  $activity= 'offline';
                                                     if($row['last_login']>$time){
                                                               
                                                                $class='btn-success';
                                                                $Attendance='Online';
                                                                 $activity= $row['Active_on'];
                                                                $Lclass='btn-success';
               
                                                           }
                                                       if($row['Attendance']>$time){
                                                            $status='Working';
                                                            $aclass='btn-success';
                                                       }
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                      <td class="d-none"><?php echo $row['Name'];?></td>
                                                    <td class="d-none"><?php echo $row['Mail_Id'];?></td>-->
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Name']?>"><?php echo $row['Name']." ".$row['Surname']; ?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Mail_Id']?>"><?php echo substr($row['Mail_Id'],0,50);?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Phone']?>"><?php echo $row['Phone']; ?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['DOB']?>"><?php echo $row['DOB']; ?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['UserName']?>"><?php echo $row['UserName']; ?></td>
                                                      <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Address']?>"><?php echo substr($row['Address'],0,30);?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['status']?>"><?php echo $row['status']; ?></td>
<!--                                                       <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $class?>'><?php echo $Attendance ?></button></td>
                                                      <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $aclass?>'><?php echo $status ?></button></td>
                                                      
                                                     <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $Lclass?>'><?php echo $activity ?></button></td>
                                                     -->
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#ViewMember" onclick="viewM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>','<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>')">View</a></td>
                                                     
<!--                                                     <td scope="row"class="text-center" ><a class="nav_link " href="TeamMembers/Analytics.php">Analytics</a></td>-->
                                                
                           
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link " onclick="" href="../EditTeam.php?v=<?php echo $row['Sr_no']?>">Edit</a></td>
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link text-danger" onclick="" href="../ClientDb/DelTeamMember.php?S=<?php echo $row['Sr_no']?>">Delete</a></td>
                                                 
              
                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

      </div>
          
      </div>
    
    
      <script>
          
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
          </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>