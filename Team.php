<?php
include 'UploadCase/Dp.php';
  header("Location:http://apajuris.in/work/Teams.php");
       die();
$time = time();

   
if(isset($_POST['clientassgin'])){
    $Tname= mysqli_real_escape_string($con,$_POST['Tname']);
    $Cname = mysqli_real_escape_string($con,$_POST['Cname']);
    $Desc = mysqli_real_escape_string($con,$_POST['note']);
    
    $Column =  mysqli_real_escape_string($con,$_POST['ColumnDy']);
    $TidDy = mysqli_real_escape_string($con,$_POST['TidDy']);
    $clientName = mysqli_real_escape_string($con,$_POST['clientName']);
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    
    
//    echo $Tname;
//     echo "<br>".$Cname;
//      echo "<br>".$Desc;
  $Nsql="Update clientAssign SET $Column = '$clientName' WHERE Tid = '$TidDy'";
 
  if ($con->query($Nsql) === TRUE) {
  //echo "Record updated successfully";
      header("Refresh:0");
} else {
  echo "Error: ----->" . $Nsql . "<br>" . $con->error;
}
  
//$Asql="INSERT INTO `1005138-sahyog`.`assignteam` (`Sr_no`, `Name`, `Client_Name`, `Case_Name`, `Status`, `Desc`, `assign`) VALUES (NULL, '$Tname', '$Cname', '0', 'active', '$Desc', CURRENT_TIMESTAMP)";
//    // echo $Asql;
//    if ($con->query($Asql) === TRUE) {
//// echo "Assign Sucessfully Bro";
//
//      header("Refresh:0");
//} else {
//  echo "Error: ----->" . $Asql . "<br>" . $con->error;
//}
            
    
    
    
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
 // echo "Hello <Br><br>";//Raju/
//    echo "<pre>";
//    print_r($_FILES['file']);
//    echo "</pre>";
//      $file_name = $_FILES['file']['name'];
//      $file_size = $_FILES['file']['size'];
//      $file_tmp = $_FILES['file']['tmp_name'];
//      $file_type = $_FILES['file']['type'];

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
 $assginbtn= "<button>Assign</button>";
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
        <style>
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
    
    <title>Team </title>
    
  </head>
  <body>
 
    <div class="topnav" id="myTopnav">


        <a href="Cms.php" class="nav__link">Dashboard</a>
        <a href="Team.php" class="nav__link active">Team</a>
        <a href="#" class="nav__link">Law</a>
        <a href="knowledge.php" class="nav__link ">Knowledge</a>
        <a href="Clients.php" class="nav__link">Clients </a>
        <a href="" class="nav_link">Task Management</a>
           <a href="Drafting.php"class="nav_link">Draft</a>
        <a href="#" class="nav__link">Manage Cme</a>
        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>
        <a href="#" class="nav__link">Control panel</a>




        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>

  <p class="mt-2 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV ?></p>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>
</div> <!-- ===== IONICONS ===== -->
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

<div class="topnav1" id="myTopnav">
            <a href="Clients.php" class="nav__link" ></a>
<!--            <a href="ClientCase.php" class="nav__link">Case</a>       
             <a href="ClientBrief.php" class="nav__link">Upload  Client Brief</a>
             <a href="viewbriefs.php"id="cb" class="nav__link">View Client Brief</a>
             <a  href="PdfManager.php" id="PDFMNav" class="nav__link">PDF Manager</a>-->
           
        </div>

<!--<h1 class="text-center text-warning "> coming soon !!! </h1>-->
 <div class="container-fluid p-0">
       
        <div class="container-fluid vc  ">
             <button class="btn btn-sm text-white" id="ViewTeamlist" onclick="toogle()">View Team Members</button>
             <button type="button" class="btn text-center  btn-primary btn-sm mt-1 mb-1 " data-toggle="modal" data-target="#AddMember">Add Team Member</button>
             <a class="btn text-center  btn-primary btn-sm mt-1 mb-1" href="TeamMembers/Assignclient.php" >Assign client to Team</a>
             <a class="btn text-center  btn-primary btn-sm mt-1 mb-1" href="TeamMembers/Analytics.php" >Analytics</a>
             <button class="btn btn-sm text-white" id="verticaltable" onclick="toogle()">Show Table view</button>
<!--             <button type="button" class="btn text-center  btn-primary btn-sm mt-1 mb-1 " data-toggle="modal" data-target="#AssignClient">Assign client to Team</button>-->
        </div> 
 </div>

<div class="contianer-fluid">
    
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
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="view" scope="col">View</th>  
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>   


                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;
                                        include('ClientDb/Dp.php');
                                        $quariy = $con->query("SELECT * FROM TeamMembers");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                
                                                  $status= 'Offline';
                                                  $class = 'btn-danger';
                                                     if($row['last_login']>$time){
                                                                $status='Online';
                                                                $class='btn-success';
               
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
                                                      <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Address']?>"><?php echo substr($row['Address'],0,60);?></td>
<!--                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['status']?>"><?php echo $row['status']; ?></td>-->
                                                      <td scope="row"style=""><button type='button' class='btn-bg <?php echo $class?>'><?php echo $status ?></button></td>
                                                     <td class="text-center text-nowrap" scope="row" ><a class="nav-link" data-toggle="modal" data-target="#ViewMember" onclick="viewM('<?php echo $row['Sr_no']?>','<?php echo $row['Name']?>','<?php echo $row['Surname']?>','<?php echo $row['Mail_Id']?>','<?php echo $row['Password']?>','<?php echo $row['Role']?>','<?php echo $row['Address']?>'
                                                         ,'<?php echo $row['Phone']?>','<?php echo $row['UserName']?>','<?php echo $row['DOB']?>','<?php echo $row['PanCard']?>','<?php echo $row['AadharCard']?>','<?php echo $row['profile']?>','<?php echo $row['status']?>','<?php echo $row['Tid']?>')">View</a></td>
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
       <div class="container-fluid" id="VList">
                 <h2 class="Text-center text-danger">under process</h2>
                  <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='TaskClient'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Team Member</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Email Address" scope="col">Client 1</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Client 2</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">Client 3</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">Client 4</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="Address"scope="col">Client 5</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Client 6</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Address"scope="col">Client 7</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Client 8</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client 9"scope="col">Client 9</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="client 10" scope="col">Client 10</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="dytables">
<!--                                        <tr>
                                            <td class="text-center" scope="row">1</td>
                                            <td class="text-center" scope="row">Raju Jettappa</td>
                                            <td class="text-center" scope="row">Aditya Pratap</td>
                                            <td class="text-center" scope="row"><button class="btn text-white btn-sm" >Assign</button></td>
                                            <td class="text-center" scope="row"><button class="btn text-white btn-sm" >Assign</button></td>
                                            <td class="text-center" scope="row"><button class="btn text-white btn-sm" >Assign</button></td>
                                            <td class="text-center" scope="row"><button class="btn text-white btn-sm" >Assign</button></td>
                                            <td class="text-center" scope="row"><button class="btn text-white btn-sm" >Assign</button></td>
                                            <td class="text-center" scope="row"><button class="btn text-white btn-sm" >Assign</button></td>
                                            <td class="text-center" scope="row"><button class="btn text-white btn-sm" >Assign</button></td>
                                        </tr>
                                        
                                        
                                        
                                    </tbody>
                                </table></div>-->
                                        <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                        // $sql= "SELECT * TeamMembers.Name,TeamMembers.Surname, assignteam.Status, assignteam.Desc,assignteam.Status,assignteam.assign
//FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
                                         $sql= "SELECT  *, TeamMembers.Name, TeamMembers.Surname From clientAssign,TeamMembers WHERE TeamMembers.Sr_no = clientAssign.Tid";
                                       //echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                         
                                                
                                               
                                                     
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                      <td class="d-none"><?php echo $row['Tid'];?></td>
                                                    <td class="d-none"><?php echo $row[''];?></td>-->
<!--                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" onclick="name('<?php echo $row['Name']?>');" title="<?php echo $row['Name']?>"><?php echo $row['Name']." ".$row['Surname']; ?></td>
                                                    -->
<!--                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Full_Name']?>" onclick="client('<?php echo $row['Full_Name']?>','<?php echo $sr;?>');"><?php echo $row['Full_Name']; ?></td>
                                             <td  id="dycaseN<?php echo $sr;?>" class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Desc']?>"><?php echo $row['Desc']; ?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Desc']?>"><?php echo $row['Desc']; ?></td>-->
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

<!--                                                        <td class="text-center" scope="row"><button class="btn text-white btn-sm "data-toggle="modal" data-target="#Assgin" >Assign</button></td>-->
                                                     
                          
                                                 
              
                                                </tr>
                                                <?php
                                                $sr++;
                                           // }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table></div>
</div>


    
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
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
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
    
    
    
    
    
    <!-- Edit Member Modal -->
<div class="modal fade" id="EditMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-xl modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bolder" id="exampleModalLabel">Edit Team Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="continer-fluid">
 <form action="" method="POST" enctype="multipart/form-data">
                  
                  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UName">Name</label>
      <input type="text" class="form-control" name='ufname'id="UName"  placeholder="First name"autocomplete="off" >
    </div>
    <div class="form-group col-md-6">
      <label for="USurname">Surname</label>
      <input type="text" class="form-control" name='ulname' id="USurname" placeholder="Last name" autocomplete="off" >
    </div>
  </div>
        
                      <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UMail">Email Id</label>
      <input type="email" class="form-control" name="umail"id="UMail" placeholder="Email Address"  autocomplete="off" >
    </div>
    <div class="form-group col-md-6">
      <label for="UPhone">Phone Number</label>
      <input type="Number" class="form-control" name="uphone" id="UPhone" placeholder="Mobile Number" autocomplete="off">
    </div>
  </div>
                  
                          <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UUserName">User Name</label>
      <input type="text" class="form-control" name="uusername"id="UUserName" placeholder="User Name" autocomplete="off">
    </div>
    <div class="form-group col-md-6">
      <label for="UPassword">Password</label>
      <input type="text" class="form-control" name="upassword" id="UPassword"placeholder=" Password" pattern="(?=.*?[#?!@$%^&*-\]\[]" autocomplete="off" required>
    </div>
  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                           <label for="UStatus">Status</label>
                            <select class="form-control" style="width:100%;" name="ustatus" id="UStatus" placeholder="select Access level">
          <option>Active</option>
          <option>Inactive</option>
          <option>Left</option>
        
      </select>
                           
                          
                      </div>
                      
                      <div class="form-group col-md-6">
      <label for="URole">Access Level</label>
      <select class="form-control" style="width:100%;" name="urole"id="URole" placeholder="select Access level">
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
      <label for="UDob">Date of Birth</label>
      <input type="text" class="form-control" name="udob"id="UDob" placeholder="Date of Birth" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="UBarid">Bar Council Registration Number</label>
      <input type="text" class="form-control" name="ubarid"id="UBarid" placeholder="Council Registration Number" autocomplete="off">
    </div>
    
  </div>
                    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UPancard">Pan card</label>
      <input type="text" class="form-control" name="upancard"id="UPancard" placeholder="Enter pan number" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="UAadharcard">Aadhar Card</label>
      <input type="text" class="form-control" name="uaadharcard" id="UAadharcard"placeholder="Enter Aadhaar Number" autocomplete="off" required>
      
    </div>
  </div>
                           <div class="form-row">
    <div class="form-group col-md-6">
        <label >Upload profile photo</label><br>
      <input type="file" class="border p-1"style="width:100%;" name="uprofile" id="UProfile">
    </div>
    <div class="form-group col-md-6">
        <label >Upload Documents</label><br>
        <input type="file" class="border p-1"style="width:100%;" name="ufile[]" id="UIdphotos" multiple>
      
    </div>
  </div>
            <div class="form-group">
      <label for="Address">Address</label>
      <textarea id="UAddress" name="uaddress" class="form-control" placeholder="full address" rows="3"></textarea>
    </div>      
                  
                  
                  
               
                  <button type="submit" class="btn btn-sm text-white" name="EM">Edit Member</button>
                  
              </form>
                   
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
                          
                          <lable class=" h4 font-weight-normal mt-2">Full Name : <span id="vfullname"></span></lable> <br><br>
                          <lable class=" h4 font-weight-normal mt-2"> Mail Id : <span id="vmail"></span> </lable> <br><br>
                          <lable class=" h4 font-weight-normal mt-2"> Phone Number :<span id="vphone"></span> </lable><br><br>
                          <lable class=" h4 font-weight-normal mt-2"> UserName : <span id="vusername"></span> </lable><br> <br>
                          <lable class=" h4 font-weight-normal mt-2"> Date of Birth : <span id="vdob"></span> </lable><br><br> 
                          <lable class=" h4 font-weight-normal mt-2"> PanCard Number : <span id="vpan"></span> </lable><br><br>
                          <lable class=" h4 font-weight-normal mt-2"> AadharCard Number : <span id="vaadhar"></span> </lable><br><br>
                          <lable class=" h4 font-weight-normal mt-2"> Status  : <span id="vstatus"></span> </lable> &emsp;&emsp;&emsp;&emsp; 
                          <lable class=" h4 font-weight-normal mt-2"> Access Level : <span id="vrole"></span> </lable> <br><br>
                          <lable class=" h4 font-weight-normal mt-2"> Address : <span id="vaddress"></span> </lable>
                         
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
    
    
    
</div>
    

<script>
    
    function assigned(sr,col){
        console.log(sr);
        console.log(col);
       
        $('#ColumnDy').val(col);
        $('#TidDy').val(sr);
    }
    
    
    
     let Dp = document.getElementById("vprofile");
    $("#Dob").datepicker({ dateFormat: 'dd/mm/yy',});
    $('select').select2();
    function editM(sr,name,surname,mail,pass,role,address,phone,username,dob,pan,aadhar,profile,status,tid,aid){
       
        $('#UName').val(name);
        $('#USurname').val(surname);
        $('#UMail').val(mail);
        $('#UPhone').val(phone);
          $('#UUserName').val(username);
            $('#UPassword').val(pass);
              $('#UStatus').val(status);
                $('#URole').val(role);
                  $('#UDob').val(dob);
                    $('#UBarid').val(aid);
                      $('#UPancard').val(pan);
                        $('#UAadharcard').val(aadhar);
                          $('#UAddress').val(address);
//        $('#upassword').val(pass);
//        $('#sr').val(sr);
$("#URole").find(role).attr("selected", "selected");

$('#UStatus option:contains(Left)');
    }
    function viewM(sr,name,surname,mail,pass,role,address,phone,username,dob,pan,aadhar,profile,status,tid){
//    console.log(tid);
//    console.log(status);
//    console.log(profile);
//    console.log(aadhar);
//    console.log(pan);
//    console.log(dob);
//    console.log(phone);
//    console.log(address);
//    console.log(role);
//    console.log(pass);
//    console.log(mail);
//    console.log(surname);
//    console.log(name);
//    console.log(sr);
//    console.log(username);
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
    
    
  
    //$("#vprofile").attr("src", profile);
    //$('#vprofile img').attr("src","TeamMembers/Raju/rj.jpeg");
   
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
        
        </script>

    <script>
       
        
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
  },5000);
        </script>
<script>
    function client(name){
    
//   $('#test'+name).addClass("test ");
   
    
    console.log(name);
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "TeamMembers/dytables.php", 
       data: {ClientName:clientName},
      success: function(res) { 
        console.log(res);
       // dyclientN
        $('#dyclientN').html(res);
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
      url: "TeamMembers/dytables.php", 
       data: {CaseName:clientName},
      success: function(res) { 
        console.log(res);
       // dyclientN
        $('#dycaseN').html(res);
//        $('#dycaseN'+sr).html(res);
     // location.reload();
 } 
       
});  
    
}
function caseD(name){
    console.log(name);
     var clientName= JSON.stringify(name);
      $.ajax({ 
     type: "POST", 
      url: "TeamMembers/dytables.php", 
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

       
        $("#ViewTeamlist").click(function(){
    $(".ViewTeamlist").toggle();
    $("#VList").hide();
   $("#VLisst").hide();
    $('#UserList').attr("id", "Lists");
    $('div.dataTables_wrapper').show();
     $("#Lists").show();
   

    });
     $("#verticaltable").click(function(){
    $(".verticaltable").toggle();
     $('#UserList').attr("id", "Lists");
             $("#VList").show();
               $("#Lists").hide();
               $('div.dataTables_wrapper').hide();
    $("#VList").show();
   $("#VLisst").show(); 

    });
//    var clicked=false;
//    function toogle(){
//        
//        if(!clicked){
//            clicked =true;
//            $('#UserList').attr("id", "Lists");
//             $("#VList").show();
//               $("#Lists").hide();
//               $('div.dataTables_wrapper').hide();
//               $('#verticaltable').text('Show Table view');
//               console.log("user hide");
//            
//        }else{
//            clicked=false;
//              $("#VList").hide();
//              $('div.dataTables_wrapper').show();
//               $('#verticaltable').text('Show Vertical view');
//               $('#UserList').attr("id", "Lists");
//            $("#Lists").show();
//            console.log("user show");
//        }
//    }
    
    
   $("#VList").hide();
   $("#VLisst").hide(); 
    </script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>