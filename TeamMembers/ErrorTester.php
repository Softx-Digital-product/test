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
        //header("Location:http://apajuris.in/work/index.php");
       die();
}
   
   
   
if(isset($_POST['clientassgin'])){
    $Tname= mysqli_real_escape_string($con,$_POST['Tname']);
    $Cname = mysqli_real_escape_string($con,$_POST['Cname']);
    $Desc = mysqli_real_escape_string($con,$_POST['note']);
    
//    echo $Tname;
//     echo "<br>".$Cname;
//      echo "<br>".$Desc;
  
$Asql="INSERT INTO `1005138-sahyog`.`assignteam` (`Sr_no`, `Name`, `Client_Name`, `Case_Name`, `Status`, `Desc`, `assign`) VALUES (NULL, '$Tname', '$Cname', '0', 'active', '$Desc', CURRENT_TIMESTAMP)";
    // echo $Asql;
    if ($con->query($Asql) === TRUE) {
// echo "Assign Sucessfully Bro";

      header("Refresh:0");
} else {
  echo "Error: ----->" . $Asql . "<br>" . $con->error;
}
            
   
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
        <link rel="stylesheet" href="../assets12/css/sam.css">
          <link rel="stylesheet" href="../Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


                    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
    
        <style>
            .cd label{
                font-family: verdana;
                font-size: 16px;
            }
        </style>
    <title>Team-assgin</title>
  </head>
  <body>
 
    <div class="topnav" id="myTopnav">


        <a href="../Cms.php" class="nav__link">Dashboard</a>
        <a href="../Team.php" class="nav__link active">Team</a>
        <a href="#" class="nav__link">Law</a>
        <a href="../knowledge.php" class="nav__link ">Knowledge</a>
        <a href="../Clients.php" class="nav__link">Clients </a>
        <a href="" class="nav_link">Task Management</a>
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

<!--<h1 class="text-center text-warning "> coming soon !!! </h1>-->
 <div class="container-fluid p-0">
       
        <div class="container-fluid vc  ">
             <a class="btn text-center  btn-primary btn-sm mt-1 mb-1" href="../Team.php" >View Team Members</a>
<!--             <a class="btn text-center  btn-primary btn-sm mt-1 mb-1 " data-toggle="modal" data-target="#AssignClient" >Assign client to Team</a>-->
             <button type="button" class="btn text-center  btn-primary btn-sm mt-1 mb-1 " data-toggle="modal" data-target="#AssignClient">Assign client to Team</button>
             <button class="btn btn-sm text-white" id="verticaltable" onclick="toogle()">Vertical view</button>
        </div> 
 </div>

<div class="contianer-fluid">
    
      <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='UserList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Name</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Email Address" scope="col">UserName</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Client Name</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">Client Email</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">Description</th>
                                                
                                                        <th class="text-center" data-toggle="tooltip" data-placement="top" title="Status" scope="col">Status</th>
                                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Assign " scope="col">Assign on</th>
                                                         <th class="text-center" data-toggle="tooltip" data-placement="top" title="view" scope="col">View</th>  
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>   
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>   


                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;
                                         $sql= "SELECT ClientDb.Full_Name, ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status, assignteam.Desc,assignteam.Status,assignteam.assign
FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
                                                   // echo $row['assign'];
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
         <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered   table-hover " id='VLisst'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Full Name" scope="col">Name</th>   
                                            
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Phone Number" scope="col">Client Name</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Date of Birth" scope="col">Case Name</th>
                                                      <th class="text-center" data-toggle="tooltip" data-placement="top" title="UserName" scope="col">Description</th>
                                                
                                                   


                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                         $sql= "SELECT ClientDb.Full_Name, ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status, assignteam.Desc,assignteam.Status,assignteam.assign
FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
                                                   // echo $row['assign'];
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                      <td class="d-none"><?php echo $row['Name'];?></td>
                                                    <td class="d-none"><?php echo $row['Mail_Id'];?></td>-->
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" onclick="name('<?php echo $row['Name']?>');" title="<?php echo $row['Name']?>"><?php echo $row['Name']." ".$row['Surname']; ?></td>
                                                    
                                                    <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Full_Name']?>" onclick="client('<?php echo $row['Full_Name']?>','<?php echo $sr;?>');"><?php echo $row['Full_Name']; ?></td>
                                             <td  id="dycaseN<?php echo $sr;?>" class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Desc']?>"><?php echo $row['Desc']; ?></td>
                                                     <td class="text-center text-nowrap"  scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['Desc']?>"><?php echo $row['Desc']; ?></td>
                                                  
                                                     
                          
                                                 
              
                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
    
            
             <div class="container-fluid" id="VList">
                 <h2 class="Text-center text-danger">under process</h2>
                 <div class="row">
                     <div class="col-md-1 text-center border">
                         <h2 class="text-center mb-1 mt-2 ">SRN</h2>
                         <hr>
                                <?php
                                        $sr = 1;
                                         $sql= "select * from TeamMembers";
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                 ?>
                                              
                            <a class="text-center h3 mt-2" ><?php  echo $sr."<br>"; ?></a>
                                            <a class="text-center h3 mt-2" ><?php  $row['Name'].' '.$row['Surname']."<br>"; ?></a>
                                            <hr>
                                               
                                        <?php
                                          $sr++;
                                        }
                                      
                                            }
                                            ?>
                         
                     </div>
                 
                     <div class="col-md-2 text-center border">
                         <h2  class="text-center mb-2 mt-2">Team </h2>
                         <hr>
                          <?php
                                        $sr = 1;
//                                         $sql= "SELECT ClientDb.Full_Name, ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status, assignteam.Desc,assignteam.Status,assignteam.assign
//FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no";
$sql ="SELECT ClientDb.Full_Name,TeamMembers.Name, TeamMembers.Surname, TeamMembers.UserName FROM ClientDb,TeamMembers, assignteam WHERE ClientDb.Sr_no = assignteam.Client_Name AND TeamMembers.Sr_no = assignteam.Name  GROUP BY  TeamMembers.UserName   ;
 ";
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
                         <div class="container-fluid mt-2">
                                            <a class="text-center h3 mt-2" onclick="client('<?php echo $row['UserName']?>')"  ><?php  echo $row['Name'].' '.$row['Surname']."<br>"; ?></a>
                                            <hr>
                         </div>  
                                        <?php
                                          $sr++;
                                        }
                                      
                                            }
                                            ?>
                         
                     </div>
                     <div class="col-md-2 border">
                         <h2 class="text-center mb-2 mt-2">Client Name </h2>
                         <hr>
                         <div class="container-fluid" id="dyclientN">
                             
                         </div>
                     </div>
                     <div class="col-md-3 border">
                         <h2 class="text-center mb-2 mt-2" >Case Name </h2>
                         <hr>
                          <div class="container-fluid" id="dycaseN">
                             
                         </div>
                     </div>
                     <div class="col-md-4 border">
                         <h2 class="text-center mb-2 mt-2" >Case Details </h2>
                         <hr>
                          <div class="container-fluid" id="dydetailsN">
                             
                         </div>
                     </div>
                 </div>
             </div>
      
    
    
</div>


    
<div class="modals">
    
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
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
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
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
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
                                <input type="hidden" name="TeamName" id="text_CN" />
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
    
    
</div>
    

<script>
//      $("#verticaltable").click(function(){
//    $("#VList").toggle();
//    $("#UserList").hide();
//    
//
//    });


function client(name){
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
    var clicked=false;
    function toogle(){
        if(!clicked){
            clicked =true;
             $("#VList").show();
               $("#UserList").hide();
               console.log("user hide")
            
        }else{
            clicked=false;
              $("#VList").hide();
            $("#UserList").show();
            console.log("user show");
        }
    }
    
    
   $("#VList").hide();
   $("#VLisst").hide(); 
     let Dp = document.getElementById("vprofile");
    $("#Dob").datepicker({ dateFormat: 'dd/mm/yy',});
    $('select').select2();
    
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
   // Dp.src=(profile);
    

   
    }
    
    
    $('#UserLists').DataTable({
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