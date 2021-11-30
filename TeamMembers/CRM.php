 <?php
include '../UploadCase/Dp.php';
 header("Location:http://apajuris.in/work/TeamMembers/crms.php");
       die();
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
      border: 2px solid red;
}
  </style>
  
  <body>
       <div class="topnav" id="myTopnav">


        <a href="../Cms.php" class="nav__link">DashBoard</a>
        <a href="../Teams.php" class="nav__link active" id="TM">Team</a>
         <a href="../task.php" class="nav_link">Task Management</a>
         <a href="../calendar.php" class="nav_link">Calendar</a>
        <a href="../library.php" class="nav__link">Library</a>
        <a href="../knowledge.php" class="nav__link ">Knowledge</a>
        <a href="../Clients.php" id="CM"class="nav__link">Clients </a>
       
        <a href="../Drafting.php"class="nav_link">Drafting</a>
          <a href="../editor.php" class="nav_link" id='ed'>Editor</a>
             <a href="../Pleadings.php"class="nav_link"id="pl">Pleading</a>
<!--        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>-->
        <a href="#" class="nav__link">Control panel</a>
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
<!--                         <h2 class="text-center mb-1 mt-2 ">SRN</h2>-->
                        
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
                         <div class="container-fluid mt-0 pt-4 box" id="dyuser<?php echo $row['UserName']; ?>">
                             
                                            <a class="text-center pt-3 mtext" id="test<?php echo $row['UserName']?>"  onclick="client('<?php echo $row['UserName']?>')"  ><?php  echo $row['Name'].' '.$row['Surname']."<br>"; ?></a>
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
      
      
       <div class="container-fluid p-0 d-none" id="VLists">
<!--                 <h2 class="Text-center text-danger">under process</h2>-->
                 
                 <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='UserList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Name</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Email Address" scope="col">UserName</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Client Name</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">Client Email</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">Notes</th>
                                                
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Assign " scope="col">Assign on</th>
<!--                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="view" scope="col">View</th>  -->
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Unassign</th>   


                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;
                                         $sql= "SELECT ClientDb.Full_Name, assignteam.AssignNo,ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status,assignteam.Sr_no,assignteam.Client_Name, assignteam.Desc,assignteam.Status,assignteam.assign
FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name  = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
                                      //echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
//                                                   echo "<pre>";
//                                                   print_r($row);
//                                                   echo "</pre>";
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                      <td class="d-none"><?php echo $row['Name'];?></td>
                                                    <td class="d-none"><?php echo $row['Mail_Id'];?></td>-->
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Name']?>"><?php echo $row['Name']." ".$row['Surname']; ?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['UserName']?>"><?php echo substr($row['UserName'],0,50);?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Full_Name']?>"><?php echo $row['Full_Name']; ?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Email']?>"><?php echo $row['Email']; ?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Desc']?>"><?php echo $row['Desc']; ?></td>
                                                      <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Status']?>"><?php echo substr($row['Status'],0,30);?></td>
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['status']?>"><?php echo $row['assign']; ?></td>
                                                     
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#ViewMember" onclick="viewM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>')">View</a></td>-->
<!--                                                      <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>','<?php echo $row['Advocate_Id']?>')">Edit</a></td>-->
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>')">Edit</a></td>-->
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link "  data-toggle="modal" data-target="#AssignEdit" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']." ".$row['Surname']; ?>','<?php echo $row['Desc']?>','<?php echo $row['Full_Name']?>','<?php echo $row['Status']?>')" href="EditTeam.php?v=<?php echo $row['Sr_no']?>">Edit</a></td>
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link text-danger" onclick="" href="functions.php?U=<?php echo $row['Sr_no']?>&C=<?php echo $row['Client_Name']?>&A=<?php echo $row['AssignNo']?>">Unassign</a></td>
              
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
      <div class="container-fluid p-0 d-none" id="VListed">
          <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">
              <table class="table table-striped table-bordered   table-hover " id='TaskClient'>
                                    <thead class="vbg text-white">
                                        <tr>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Team Member" scope="col">Team Member</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 1" scope="col">Client 1</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 2" scope="col">Client 2</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 3" scope="col">Client 3</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 4" scope="col">Client 4</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 5"scope="col">Client 5</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 6" scope="col">Client 6</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 7"scope="col">Client 7</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 8" scope="col">Client 8</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 9"scope="col">Client 9</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 10" scope="col">Client 10</th> 
                                        </tr>
                                        
                                    </thead>
                                    <tbody id="dbody">
                                        <?php
                                        $sr = 1;
                                      
                                   $sql= "SELECT  *, TeamMembers.Name, TeamMembers.Surname From clientAssign,TeamMembers WHERE TeamMembers.Tid = clientAssign.Tid";
                                       //echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                               
                                         if($row['Client1']== '0'){
                                             $row['Client1']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } 
                                         if($row['Client2']== '0'){
                                             $row['Client2']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         }
                                          if($row['Client3']== '0'){
                                             $row['Client3']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client4']== '0'){
                                             $row['Client4']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client5']== '0'){
                                             $row['Client5']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin' >Assign</button>";
                                         } if($row['Client6']== '0'){
                                             $row['Client6']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client7']== '0'){
                                             $row['Client7']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client8']== '0'){
                                             $row['Client8']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client9']== '0'){
                                             $row['Client9']= "<button class='btn btn-sm text-white' data-toggle='modal' data-target='#Assgin'>Assign</button>";
                                         } if($row['Client10']== '0'){
                                             $row['Client10']= "<button class='btn btn-sm text-white'>Assign</button>";
                                         }
                                         else{
                                             
                                         }
                                         
                                              
                                                    
                                                ?>
                                        <tr>
                                             <th class="text-center" scope="row" style=""><?php echo $sr++ ?></th>
                                             <td class="text-center" scope="row"  ><?php echo $row['Name']." ".$row['Surname'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client1')"><?php echo $row['Client1'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client2')"><?php echo $row['Client2'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client3')"><?php echo $row['Client3'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client4')"><?php echo $row['Client4'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client5')"><?php echo $row['Client5'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client6')"><?php echo $row['Client6'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client7')"><?php echo $row['Client7'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client8')"><?php echo $row['Client8'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client9')"><?php echo $row['Client9'];?></td>
                                                    <td class="text-center" scope="row" onclick="assigned('<?php echo $row['Sr_no'];?>','Client10')"><?php echo $row['Client10'];?></td>

                                        </tr>

                                     
                                    
                                        <?php 
                                            }
                                        
                                        }
                                        ?>
                                  
                                    </tbody>
                                    
              </table>
                                    
          </div>
      </div>
      
                 
                 
<!--                 <?php  
                 $no=1;
    $username = '';
    $Clients = '';
//    $Client3 = '';
    
     $sql= "Select *,TeamMembers.Sr_no,ClientDb.Full_Name From assignteam,TeamMembers,ClientDb WHERE assignteam.Name = TeamMembers.Sr_no AND assignteam.Client_Name = ClientDb.Sr_no;";
 //  echo  $sql;
       $quariy = $con->query($sql);
    while ($row = mysqli_fetch_assoc($quariy)) {
//        echo "<pre>";
//        print_r($row);
//        echo "</pre>";
        
        $no .= "<td>$no</td>";
         $username.= "<td>" . $row['UserName'] . "</td>";
        $Clients .= "<td>" . $row['Full_Name'] . "</td>";
        //$Client3.= "<td>".$row['Desc']."</td>";
        $no++;
        
        
        
    }
?>
 

<table border="1" align="center">
<thead>
    <tr>
        <th>No.</th>
        <?php// echo $no; ?>
        <?php echo $username;?>
        <?php echo $Clients;?>
        
    </tr>
    <tr>
        <th>Client 1</th>
        <?php// echo $Client1; ?>
    </tr>
    <tr>
        <th>Client 2</th>
        <?php //echo $Client2; ?>
    </tr>
    <tr>
        <th>Client 3</th>
        <?php// echo $Client3; ?>
    </tr>
</thead>
      
          
       
         
 -->
 
 <div class="modals">
     
     
     <!-- Modal -->
<div class="modal fade" id="Assgin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Client To Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <form action="" method="POST">
                  <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-none">
                      <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Team Member</label>

                                <select class="CN" id="TeamN" name="Tname" style="width:100%;" placeholder="Please Select Team Member"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Team Member</option>
                
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM TeamMembers");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Name']." ".$row['Surname'] . "</option>";
                                    }

                                    ?>
                                </select>
                                <input type="hidden" name="TeamName" id="text_CT" />
                            </div>
                      
                      
                      
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                       <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder">Select Client </label>

                                <select class="CN" id="ClientN" name="Cname" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Client Name</option>
                
                                    <?php 
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb WHERE Assign = 0 ");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name']. "</option>";
                                    }

                                    ?>
                                
                                </select>
                                <input type="hidden" name="clientName" id="text_CN" />
                            </div>
                  </div>
              </div>
                  <div class="form-group">
      <label class="font-weight-bolder mt-2">Notes</label>
      <textarea  name="note" class="form-control" placeholder="Notes" rows="3"></textarea>
    </div>
                  <input type="hidden" name="TidDy" id="TidDy">
                  <input type="hidden" name="ColumnDy" id="ColumnDy">
                  <button type="submit" name="clientassgin" class="btn btn-sm text-white">Assign Client</button> 
              </form>
          </div>
            
              
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
    
     
     <!-- Modal -->
<div class="modal fade" id="Unassign" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-xl modal-dialog   ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Unassigned Clients </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
                 <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='unassigned'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center"style="width:15px" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Type" scope="col">Type</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Name" scope="col">Client Name</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                        <?php
                                        $sr = 1;
                                        
                                        $quariy = $con->query("SELECT * FROM ClientDb WHERE Assign = 0 ");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                           
//                                                           echo "<pre>";
//                                                           print_r($row);
//                                                           echo "</pre>";
                                                ?>
                                        <tr>
                                                 <td class="text-center" style="width:10px"><?php echo $sr;?></td>
                                                   <td class="text-center text-nowrap" style="width:30px"><?php echo $row['Type']?></td>
                                                   <td class="text-center text-nowrap"><?php echo $row['Full_Name']?></td>
                                                   <td class="text-center text-White"><button  data-toggle="modal" data-target="#AssignClient"  class="btn btn-sm text-white " onclick="AssignClientM('<?php echo $row['Sr_no']?>','<?php echo $row['Full_Name'] ?>')">Assign</button></td>
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
 
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
          
     
 </div>
      
      
      
      
      
   
     
      <script>
         
         $("#VLists").hide();
         $('#VListed').hide();
      
        
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
              client('Rjweb');
         function client(name){
             
//             $("#dyuser"+name).addClass('rowbg');

   //$('#test'+name).addClass("Selected");
   
//   $("#dyuser").addClass('Selected');
    
    console.log(name);
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "dytables.php", 
       data: {ClientName:clientName},
      success: function(res) { 
        console.log(res);
       // dyclientN
        $('#dyclientN').html(res);
        
        
        caseN('Aditya Pratap');
//        $('#dycaseN'+sr).html(res);
     // location.reload();
 } 
        
});  
    
}
function caseN(name){
    console.log(name);
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "dytables.php", 
       data: {CaseName:clientName},
      success: function(res) { 
        console.log(res);
       // dyclientN
        $('#dycaseN').html(res);
//        $('#dycaseN'+sr).html(res);
     // location.reload();
     caseD('Aditya Pratap vs Audi Mumbai South');
 } 
       
});  
    
}


function caseD(name){
    console.log(name);
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "dytables.php", 
       data: {CaseDetails:clientName},
      success: function(res) { 
        console.log(res);
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
