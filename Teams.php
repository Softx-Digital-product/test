<?php
include 'Database/Dp.php';

if(isset($_POST['clientassgin'])){
    
//    echo "<pre>";
//    print_r($_POST);
//   // print_r($_POST['clientassgin']);
//    echo "</pre>";
    
$Tid= $_POST['Tname'];
    //$Sr= $_POST['Cname'];
            $CNO= mysqli_real_escape_string($con,$_POST['CNO']);
            $clientN= mysqli_real_escape_string($con,$_POST['ClientName']); 
            
        $Tid= mysqli_real_escape_string($con,$_POST['Tid']);
    $Cname = mysqli_real_escape_string($con,$_POST['Csr']);
    $Desc = mysqli_real_escape_string($con,$_POST['note']);
    $sr=$Tid;
    $srsql= "Select * From TeamMembers WHERE Tid = '$Tid'";
    //echo $srsql;
     $sql = mysqli_query($con, $srsql);
     while ($row = $sql->fetch_assoc()) {

               $sr= $row['Sr_no'];                         
     }
    
    $Cupdate ="UPDATE clientAssign SET $CNO = '$clientN' WHERE Tid= '$Tid'";
    //echo $Cupdate;
        if ($con->query($Cupdate) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating in clientassign record: " . $con->error;
}
    $update = "UPDATE ClientDb SET Assign = '$sr' WHERE Sr_no = '$Cname'";
  //  echo  "<br>".$update;
    
    if ($con->query($update) === TRUE) {
  //echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}

     $check=mysqli_num_rows(mysqli_query($con,"SELECT * from assignteam Where Client_Name='$Cname'"));
if($check>0){
  
  
}else{

$Asql="INSERT INTO `1005138-sahyog`.`assignteam` (`Name`, `Client_Name`, `Case_Name`, `Status`, `Desc`,`AssignNo`) "
        . "VALUES ($sr, $Cname, '0', 'Active', '$Desc','$CNO')";
    // echo $Asql;
    if ($con->query($Asql) === TRUE) {
// echo "Assign Sucessfully Bro";

     header("Refresh:0");
} else {
  echo "Error: ----->" . $Asql . "<br>" . $con->error;
}
}
    
    
}


if(isset($_POST['AdM'])){
    
 
   $Fname = mysqli_real_escape_string($con,$_POST['fname']);
   $Lname = mysqli_real_escape_string($con,$_POST['lname']);
   $Mail = mysqli_real_escape_string($con,$_POST['mail']);
   $Phone = mysqli_real_escape_string($con,$_POST['phone']);
   $UserName = mysqli_real_escape_string($con,$_POST['username']);
   $Password = mysqli_real_escape_string($con,$_POST['password']);
   $Dob = mysqli_real_escape_string($con,$_POST['dob']);
   $Role = mysqli_real_escape_string($con,$_POST['role']);
   $Pancard = mysqli_real_escape_string($con,$_POST['pancard']);
   $Aadhar= mysqli_real_escape_string($con,$_POST['aadharcard']);
   //Profile idphotos[]
   $Address = mysqli_real_escape_string($con,$_POST['address']); 
   
  $Adocateid = mysqli_real_escape_string($con,$_POST['barid']);
  $Status= mysqli_real_escape_string($con,$_POST['status']);
  
  
  echo (rand(10,100));
$random =(rand(10,100));

 $tid= "$UserName$random";
 
   if (!file_exists("TeamMembers/.$Fname")) {
    mkdir("TeamMembers/$tid", 0777, true);
    //echo 'Folder Created !!!';
  // header("Refresh:0");
}else{
    echo 'Folder Present';
//header("Refresh:0");
}




 




 if(isset($_FILES['file'])){
//     echo "<pre>";
//     print_r($_FILES);
//     echo "</pre>";
    $file_dir ="TeamMembers/$tid/";

 foreach($_FILES['file']['name']as $key=>$val){
      $fileName = basename($_FILES['file']['name'][$key]); 
      $fileSize= basename($_FILES['file']['size'][$key]);
      $targetFilePath = $file_dir . $fileName; 
      if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){
        echo "file Uploaded Successfully Bro";
        
        $check=mysqli_num_rows(mysqli_query($con,"SELECT * from TeamMember_data Where Tid='$tid'"));
if($check>0){
   echo "<br> This DATA is already present";
  
}
else{
        $sqli ="INSERT INTO TeamMember_data(Tid, Path) VALUES ('$tid','$targetFilePath')";
        if ($con->query($sqli) === TRUE) {
 echo "Uploaded  Sucessfully Bro";
 
 
      // header("Refresh:0");
} else {
  echo "Error: ----->" . $sqli . "<br>" . $con->error;
}
}     
      
      }
      else{
          echo "file Can't upload";
      }

        

     }
     
   
}

 if(isset($_FILES['Profile'])){
     
      $file_dir ="TeamMembers/$tid/";
     $fileName = basename($_FILES['Profile']['name']); 
      $fileSize= basename($_FILES['Profile']['size']);
      $targetFilePaths = $file_dir . $fileName; 
      if(move_uploaded_file($_FILES["Profile"]["tmp_name"], $targetFilePaths)){
        echo "file Uploaded Successfully Bro";
      
      }
      else{
          echo "file Can't upload";
      }
     
 }
  $check=mysqli_num_rows(mysqli_query($con,"SELECT * from TeamMember Where Mail_Id='$Mail'"));
if($check>0){
   echo  "<br> This DATA is already present";
  
}
else{
 $sqls= "INSERT INTO TeamMembers(Name, Surname, Mail_Id, Password, Role, Address, Phone, UserName, DOB, PanCard, AadharCard, Advocate_Id, Tid, profile, status) 
        VALUES ('$Fname','$Lname','$Mail','$Password','$Role','$Address','$Phone','$UserName','$Dob','$Pancard','$Aadhar','$Adocateid','$tid','$targetFilePaths','$Status')";
    if ($con->query($sqls) === TRUE) {
 echo "profile uploaded Sucessfully Bro";
 $assginbtn= "0";
// $assginbtn = mysqli_real_escape_string($con,$assignbtn);
 $assignbtn= htmlspecialchars($assginbtn);
 $clientast= "Insert INTO clientAssign (Client1,Client2,Client3,Client4,Client5,Client6,Client7,Client8,Client9,Client10,Tid)"
         . "VALUES ('{$assginbtn}','{$assginbtn}','{$assginbtn}','{$assginbtn}','{$assginbtn}','{$assginbtn}','{$assginbtn}','{$assginbtn}','{$assginbtn}','{$assginbtn}','$tid')";
//echo '-> Query '.$clientast;
         if ($con->query($clientast) === TRUE) {
}else{
    echo "Error: ----->" . $clientast . "<br>" . $con->error;
}
      // header("Refresh:0");
} else {
  echo "Error: ----->" . $sqls . "<br>" . $con->error;
}
}

header("Refresh:0");
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
        <link rel="stylesheet" href="assets12/css/sam.css">
          <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


                    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        
    <title>Team</title>
    
    <style>
        .src{
            width: 35px;
        }
         .btns-active{
  background:#40e0d0;

  color: white;
    
}
    </style>
  </head>
  
  
  <body>
        <?php include 'Navbars.php';
        
        
        
        ?>

          <div class="topnav1">
            <a href="" class="nav__link active" >View Team</a>
            <a href="TeamMembers/CRM.php" class="nav_link ">CRM</a>
            <a href="TeamMembers/ActivityLog.php" class="nav_link">Activity Logs</a>
            <a href="TeamMembers/Analytics.php" class="nav__link" >Analytics</a>
            
    
      </div>
      <div class="vc p-1">
          <button type="button" class="btn text-center btn-sm mt-1 mb-1  text-white btns-active ">View Team Members</button>
          <button type="button" class="btn text-center btn-sm mt-1 mb-1 text-white" data-toggle="modal" data-target="#AddMember">Add Team Member</button>
<!--          <button class="btn btn-sm text-white">Add Team Members</button>-->
<button class="btn btn-sm text-white " data-toggle="modal" data-target="#Unassign" >Unassigned Client</button>
          <button class="btn btn-sm text-white" id="verticaltable" data-toggle="modal" data-target="#AssignClient">Assign Team Member</button>
          <a class="btn btn-sm text-white" href="TeamMembers/inactive.php"  >Inactive Or Left</a>
          <a class="btn btn-sm text-white" href="TeamMembers/teaminfo.php"  >Team Info</a>
       
      </div>
      
      <!--- Nav part end -->
      
      <div class="container-fluid p-0">
          
     
          
        <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='UserList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Full Name</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Email Address" scope="col">Email</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Phone</th>
<!--                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">DOB</th>-->
<!--                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">UserName</th>-->
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="Address"scope="col">Last Seen</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Attendance" scope="col">Attendance</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Activity" scope="col">Activity</th>
                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Name" scope="col">Working on Client</th>
                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Name" scope="col">Working on Case</th>
                                                         
                                                        
<!--                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="view" scope="col">View</th>-->
                                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="Analytics" scope="col">Analytics</th> 
                                                         
                                                         
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>   


                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;
                                        
                                        $quariy = $con->query("SELECT * FROM TeamMembers WHERE Status ='Active' ");
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
<!--                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['DOB']?>"><?php echo $row['DOB']; ?></td>-->
                                                     
<!--                                                      <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Address']?>"><?php echo substr($row['Address'],0,30);?></td>-->
                                                            <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['last_visit']?>"><?php echo date('d-m-Y h:i A', strtotime($row['last_visit']));?></td>
                                                     
<!--                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['status']?>"><?php echo $row['status']; ?></td>-->
                                                       <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $class?>'><?php echo $Attendance ?></button></td>
                                                      <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $aclass?>'><?php echo $status ?></button></td>
                                                      
                                                     <td scope="row"style="" class="text-center"><button type='button' class='btn-bg <?php echo $Lclass?>'><?php echo $activity ?></button></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['ClientN']?>"><?php echo substr($row['ClientN'],0,30);?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['CaseN']?>"><?php echo substr($row['CaseN'],0,30);?></td>
                                                     
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#ViewMember" onclick="viewM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>')">View</a></td>
                                                     -->
                                                     <td scope="row"class="text-center" ><a class="nav_link " href="TeamMembers/Analytics.php">Analytics</a></td>
<!--                                                      <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>','<?php echo $row['Advocate_Id']?>')">Edit</a></td>-->
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>')">Edit</a></td>-->
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link " onclick="" href="EditTeam.php?v=<?php echo $row['Sr_no']?>">Edit</a></td>
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link text-danger" onclick="" href="ClientDb/DelTeamMember.php?v=<?php echo $row['Sr_no']?>&u=<?php echo $row['Tid']?>">Delete</a></td>
                                                 
              
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
          
         
 
      
      <div class="modals">
          
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
          
          
          
           <!-- Modal -->
<div class="modal fade" id="AssignClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-xl modal-dialog modal-dialog-centered">
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
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Team Member</label>

                                <select class="CN" id="TeamN" name="Tid" style="width:100%;" placeholder="Please Select Team Member"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Team Member</option>
                
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM TeamMembers");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Tid'] . ">" . $row['Name']." ".$row['Surname'] . "</option>";
                                    }

                                    ?>
                                </select>
                                <input type="hidden" name="TeamName" id="text_CT" />
                            </div>
                      
                      
                      
                  </div>
                  <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                       <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder">Select Client </label>

                                <select class="CN" id="ClientN" name="Csr" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Choose Client Name</option>
                
                                    <?php
                                    $q= "SELECT * FROM ClientDb WHERE Assign = 0";
                                    $sql = mysqli_query($con, $q);
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name']. "</option>";
                                    }

                                    ?>
                                
                                </select>
                                <input type="hidden" name="ClientName" id="text_CN" />
                            </div>
                  </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                       <div class="form-group mt-1 mb-1">
                              <label class="font-weight-bolder">Assign Client No </label>

                                <select class="CN" id="ClientNO" name="CNO" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CNO').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Assign Client Number</option>
                
                                    <?php
                                    $q= "SELECT * FROM clientAssign WHERE Sr_no =  1 ";
                                    $sql = mysqli_query($con, $q);
                                    while ($row = $sql->fetch_assoc()) {
                                        
                                        if($row['Client1']== '0'){
                                           $row['Client1']= "Client 1";
                                             echo "<option value=" . $row['Sr_no'] . ">".$row['Client1']. "</option>";
                                        }   
                                        if($row['Client2']=='0'){
                                          $row['Client2']= "Client 2";  
                                          echo "<option value=" . $row['Sr_no'] . ">" .$row['Client2']. "</option>";
                                        } if($row['Client3']=='0'){
                                          $row['Client3']= "Client 3";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client3']. "</option>";
                                        } if($row['Client4']=='0'){
                                          $row['Client4']= "Client 4";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client4']. "</option>";
                                        } if($row['Client5']=='0'){
                                          $row['Client5']= "Client 5";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client5']. "</option>";
                                        } if($row['Client6']=='0'){
                                          $row['Client6']= "Client 6";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client6']. "</option>";
                                        } if($row['Client7']=='0'){
                                          $row['Client7']= "Client 7";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client7']. "</option>";
                                        } if($row['Client8']=='0'){
                                          $row['Client8']= "Client 8";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client8']. "</option>";
                                        } if($row['Client9']=='0'){
                                          $row['Client9']= "Client 9"; 
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client9']. "</option>";
                                        } if($row['Client10']=='0'){
                                          $row['Client10']= "Client 10";  
                                            echo "<option value=" . $row['Sr_no'] . ">" .$row['Client10']. "</option>";
                                        }
                                        
                                        else{
                                            
                                         $row['Client1']="Already Assigned";
                                         $row['Client2']="Already Assigned";
                                         
                                        }
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client1']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">" .$row['Client2']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">" .$row['Client3']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">" .$row['Client4']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client5']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client6']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client7']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client8']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client9']. "</option>";
//                                    echo "<option value=" . $row['Sr_no'] . ">".$row['Client10']. "</option>";
                                                    
                                    }

                                    ?>
                                
                                </select>
                                <input type="hidden" name="ClientNo" id="text_CNO" />
                            </div>
                  </div>
              </div>
                  <div class="form-group">
      <label class="font-weight-bolder mt-2">Notes</label>
      <textarea  name="note" class="form-control" placeholder="Notes" rows="3"></textarea>
    </div>
          
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
<div class="modal fade" id="ViewMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-xl modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Viewer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-4 border">
                      <div class="container">
                          <img src="TeamMembers/Raju/rj.jpeg" id="vprofile" class="img-fluid" style='border-radius:50%;height:20rem;width:25rem; vertical-align: middle;'>
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="container">
                          <h2 class="text-center h3">Details</h2>
                          
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >Full Name :</span> <span id="vfullname"></span></lable> <br><br>
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >Mail Id : </span><span id="vmail"></span> </lable> <br><br>
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >Phone Number :</span><span id="vphone"></span> </lable><br><br>
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >UserName : </span> <span id="vusername"></span> </lable><br> <br>
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >Date of Birth :</span> <span id="vdob"></span> </lable><br><br> 
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >PanCard Number : </span> <span id="vpan"></span> </lable><br><br>
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >AadharCard Number :</span> <span id="vaadhar"></span> </lable><br><br>
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >Status  :</span> <span id="vstatus"></span> </lable> &emsp;&emsp;&emsp;&emsp; 
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >Access Level :</span> <span id="vrole"></span> </lable> <br><br>
                          <lable class=" h4 font-weight-normal mt-2"> <span class="font-weight-bolder text-dark" >Address :</span> <span id="vaddress"></span> </lable>
                         
                      </div>
                      
                      
                  </div>
                  
              </div>
              
              
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
            
       <!-- add Member Modal -->
<div class="modal fade" id="AddMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-xl modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bolder" id="exampleModalLabel">Add Team Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="continer-fluid">
              <form action="" method="POST" enctype="multipart/form-data">
                  
                  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Name">Name</label>
      <input type="text" class="form-control" name='fname'id="Name"  placeholder="First name"autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="Surname">Surname</label>
      <input type="text" class="form-control" name='lname' id="Surname" placeholder="Last name" autocomplete="off" required>
    </div>
  </div>
        
                      <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Mail">Email Id</label>
      <input type="email" class="form-control" name="mail"id="Mail" placeholder="Email Address"  autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="Phone">Phone Number</label>
      <input type="Number" class="form-control" name="phone" id="Phone" placeholder="Mobile Number" autocomplete="off" required>
    </div>
  </div>
                  
                          <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UserName">User Name</label>
      <input type="text" class="form-control" name="username"id="UserName" placeholder="User Name" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="Password">Password</label>
      <input type="password" class="form-control" name="password" id="Password"placeholder=" Password" pattern="(?=.*?[#?!@$%^&*-\]\[]" autocomplete="off" required>
    </div>
  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                           <label for="">Status</label>
                            <select class="form-control" style="width:100%;" name="status" placeholder="select Access level">
          <option>Active</option>
          <option>Inactive</option>
          <option>Left</option>
        
      </select>
                           
                          
                      </div>
                      
                      <div class="form-group col-md-6">
      <label for="">Access Level</label>
      <select class="form-control" style="width:100%;" name="role" placeholder="select Access level">
          <option>Admin</option>
          <option>Account</option>
          <option>Drafter</option>
          <option>Manager</option>
          <option>Translator</option>
          <option>Super Admin</option>
          <option>Support Staff</option>
          
 
      </select>
    </div>
                      
                  </div> 
                     <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Dob">Date of Birth</label>
      <input type="text" class="form-control" name="dob"id="Dob" placeholder="Date of Birth" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="Barid">Bar Council Registration Number</label>
      <input type="text" class="form-control" name="barid"id="Barid" placeholder="Council Registration Number" autocomplete="off">
    </div>
    
  </div>
                    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Pancard">Pan card</label>
      <input type="text" class="form-control" name="pancard"id="Pancard" placeholder="Enter pan number" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="Aadharcard">Aadhar Card</label>
      <input type="text" class="form-control" name="aadharcard" id="Aadharcard"placeholder="Enter Aadhaar Number" autocomplete="off" required>
      
    </div>
  </div>
                           <div class="form-row">
    <div class="form-group col-md-6">
        <label >Upload profile photo</label><br>
      <input type="file" class="border p-1"style="width:100%;" name="Profile" id="Profile">
    </div>
    <div class="form-group col-md-6">
        <label >Upload Documents</label><br>
        <input type="file" class="border p-1"style="width:100%;" name="file[]" id="Idphotos" multiple>
      
    </div>
  </div>
            <div class="form-group">
      <label for="Address">Address</label>
      <textarea id="Address" name="address" class="form-control" placeholder="full address" rows="3"></textarea>
    </div>      
                  
                  
                  
               
                  <button type="submit" class="btn btn-sm text-white" name="AdM">Add Team Member</button>
                  
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
<div class="modal fade" id="Inactives"  aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-xl modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inactive or Left Team Members</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='UserLists'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Full Name</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Email Address" scope="col">Email</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Phone</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">DOB</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">UserName</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="Address"scope="col">Address</th>

                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Activity" scope="col">Status</th>
                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="view" scope="col">View</th>
<!--                                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="Analytics" scope="col">Analytics</th> -->
                                                         
                                                         
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>   


                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;
                                        
                                 $quariy = $con->query("SELECT * FROM TeamMembers WHERE status = 'Active'");
                                 
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

                                                     
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#ViewMember" onclick="viewM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>')">View</a></td>
                                                     
<!--                                                     <td scope="row"class="text-center" ><a class="nav_link " href="TeamMembers/Analytics.php">Analytics</a></td>-->
<!--                                                      <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>','<?php echo $row['Advocate_Id']?>')">Edit</a></td>-->
<!--                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#EditMember" onclick="editM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>')">Edit</a></td>-->
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link " onclick="" href="EditTeam.php?v=<?php echo $row['Sr_no']?>">Edit</a></td>
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link text-danger" onclick="" href="ClientDb/DelTeamMember.php?v=<?php echo $row['Sr_no']?>">Delete</a></td>
                                                 
              
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
           
           function AssignClientM(sr,clientName){
               console.log(sr);
               console.log(clientName);
               
                          
             //   $('#ClientN').val(sr);
                $("#ClientN").val(sr).change();
              
              
           }
           
           
           
     
     
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
    
      <script>
           $('#CM').removeClass('active');
        $('#TM').addClass('active');
        $('#mybottomnav').addClass('d-none');
                            $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
      </script>
      
      
          <script>
        
            function updateUserStatus(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){

    }
  });

}
setInterval(function(){
updateUserStatus();
},3000);
              function getStatus(){
  $.ajax({
    url:'Status/getStatus.php',
    success:function(result){
     // console.log(result);
   $('#dytable').html(result);
    }

  });
  }
  setInterval(function(){
  getStatus();
  },4000);
        </script>
        
        <script>
            
             let Dp = document.getElementById("vprofile");
             
            function viewM(sr,name,surname,mail,pass,role,address,phone,username,dob,pan,aadhar,profile,status,tid){

    Dp.src=(profile);
    
    $('#vfullname').text(name+" "+surname);
    $('#vmail').text(mail);
    $('#vphone').text(phone);
    $('#vpan').text(pan);
    $('#vaadhar').text(aadhar);
    $('#vstatus').text(status);
    $('#vaddress').text(address);
    $('#vdob').text(dob);
    $('#vrole').text(role);
    $('#vusername').text(username);
    

    }
    
    $('select').select2();
    
    
    
             $("#TeamN").on("change", function () {
                    var category = $("#TeamN").val();

                    console.log(category);

                    var tid = JSON.stringify(category);
                    $.ajax({
                        url: "TeamMembers/functions.php",
                        type: "POST",
                        cache: false,
                        data: {Tid: tid},
                        success: function (data) {
                            console.log(data);
                            $("#ClientNO").html(data);

                        }
                    });
                });
    
            </script>
            <script>
        function updateActivity(){
            var activeon = 'Teams';
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
       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>
