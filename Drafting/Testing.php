<?php
include '../UploadCase/Dp.php';
ini_set('session.save_path', '../session');
session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    
}else{
        header("Location:http://apajuris.in/work/index.php");
       die();
} 
 $Dtitle ="Please Choose Draft Name"; $ClientName="Please Choose Client Name"; $CaseName="Please Choose Case Name"; $clientid; $caseid; $Dcontent;
 
 
 if(isset($_POST['filesubmit'])){
     
     
//     echo "<pre>";
//     print_r($_FILES);
//     echo "</pre>";
     
      $sr = mysqli_real_escape_string($con,$_POST['srid']);  
      $sql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $sr";
    $quariy = $con->query($sql);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {

    $clientid= $row['ClientId'];
    $caseid= $row['CaseId'];
    $Dcontent= $row['DContent'];
    $Dtitle= $row['DTitle'];
    $ClientName= $row['Full_Name'];
    $CaseName= $row['Case_Name'];
 
                        }
                        
    $fpath= "../ClientCaseData/$ClientName/$CaseName/Drafts";
 if (!file_exists($fpath)) {
   $ds= mkdir($fpath, 0777,true);
    
   // echo 'folder created';
   }else{
     
      // echo 'folder Already presents';
   }
 
      $fpath= "../ClientCaseData/$ClientName/$CaseName/Drafts/";
  if(isset($_FILES['file'])){
     
      $file_dir =$fpath;
     $fileName = basename($_FILES['file']['name']); 
      $fileSize= basename($_FILES['file']['size']);
      $targetFilePaths = $file_dir . $fileName; 
   //  echo $targetFilePaths;
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePaths)){
          $q="Update Drafting SET FinalDoc= '$targetFilePaths' WHERE Sr_no = '$sr' ";
           if ($con->query($q) === TRUE) {
       
   }else{
       echo "Error: ----->" .$q . "<br>" . $con->error;
   }
        //echo "file Uploaded Successfully Bro";
        
      
      }
      else{
          echo "file Can't upload";
      }
  }
 }
 }
if(isset($_POST['DraftSr'])){
    $srno= $_POST['DraftSr'];
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    
   $sql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $srno";
    $quariy = $con->query($sql);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {

    $clientid= $row['ClientId'];
    $caseid= $row['CaseId'];
    $Dcontent= $row['DContent'];
    $Dtitle= $row['DTitle'];
    $ClientName= $row['Full_Name'];
    $CaseName= $row['Case_Name'];
                        
                        }
                        }
    
  //Die();  
}
if(isset($_POST['savebtn'])){

    $content = $_REQUEST['content'];
  //  $content = mysqli_real_escape_string($con,$_POST['content']);
    $srno = mysqli_real_escape_string($con,$_POST['usrno']); 
   
    $sql= "UPDATE Drafting SET DContent = '$content' WHERE Sr_no = $srno";
   // echo $sql;
       if ($con->query($sql) === TRUE) {
          //header("Refresh:0");
            $usql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $srno";
    $quariy = $con->query($usql);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                       
    $clientid= $row['ClientId'];
    $caseid= $row['CaseId'];
    $Dcontent= $row['DContent'];
    $Dtitle= $row['DTitle'];
    $ClientName= $row['Full_Name'];
    $CaseName= $row['Case_Name'];
                         
                        }
                        
$check=mysqli_num_rows(mysqli_query($con,"SELECT * from DraftBackup Where Rdid ='$sr'"));
if($check>0){
 //  echo "<br> updating in backup";
   $updatebackup= "UPDATE DraftBackup SET Dcontentbackup = '$content' WHERE Rdid= '$sr'";
   if ($con->query($updatebackup) === TRUE) {
       
   }else{
       echo "Error: ----->" .$updatebackup . "<br>" . $con->error;
   }
}
else{
 //   echo "<br> Creating a backup";
    $createbackup= "INSERT INTO DraftBackup(Rdid, Dcontentbackup ) VALUES ('$sr','$content')";
     if ($con->query($createbackup) === TRUE) {
} else {
  echo "Error: ----->" . $createbackup . "<br>" . $con->error;
}
}
                        }
          
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

 }
 if(isset($_POST['loadbackup'])){
      $srno = mysqli_real_escape_string($con,$_POST['usrno']); 
      
//      echo $sr;
      $q= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name,DraftBackup.Dcontentbackup FROM DraftBackup, Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND  DraftBackup.Rdid = Drafting.Sr_no  AND Drafting.Sr_no = '$srno'";
      
          $quariy = $con->query($q);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                         $clientid= $row['ClientId'];
    $caseid= $row['CaseId'];
    $Dcontent= $row['Dcontentbackup'];
    $Dtitle= $row['DTitle'];
    $ClientName= $row['Full_Name'];
    $CaseName= $row['Case_Name'];
                        }
                    }
      
 }
 if(isset($_POST['Savetotxt'])){
     $srno = mysqli_real_escape_string($con,$_POST['usrno']);  
      $content = $_REQUEST['content'];
     //echo $sr;
       $usql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $srno";
//       echo $usql;
    $quariy = $con->query($usql);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {                
    $clientid= $row['ClientId'];
    $caseid= $row['CaseId'];
    $Dcontent= $row['DContent'];
    $Dtitle= $row['DTitle'];
    $ClientName= $row['Full_Name'];
    $CaseName= $row['Case_Name'];
                         
//    $txtfile= html_entity_decode($Dcontent);
//     $txtfile= strip_tags($Dcontent);
    
  function rm_special_char($str) {
$finalval = str_replace( array("#", "'", ";","/","?","$","*","\\","<",">"), '', $str);
return $finalval;
}
 $Dtitle= rm_special_char($Dtitle);
 
                    }
                    $fpath= "../ClientCaseData/$ClientName/$CaseName/Drafts";
                     if (!file_exists($fpath)) {
   $ds= mkdir($fpath, 0777,true);
    
   // echo 'folder created';
   }else{
     
      // echo 'folder Already presents';
   } 
$myfile = fopen("$fpath/$Dtitle.txt", "w") or die("Unable to open file!");
$txt = $content;
fwrite($myfile, $txt);
fclose($myfile);

$fileContent = file_get_contents("$fpath/$Dtitle.txt");

//echo $fileContent;

                    
                    
                        }
                    else{
                        
                    }
                        
                        
 }
 if(isset($_POST['Loadtxt'])){
       $srno = mysqli_real_escape_string($con,$_POST['usrno']); 
       $usql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $srno";
    $quariy = $con->query($usql);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                       
    $clientid= $row['ClientId'];
    $caseid= $row['CaseId'];
//    $Dcontent= $row['DContent'];
    $Dtitle= $row['DTitle'];
    $ClientName= $row['Full_Name'];
    $CaseName= $row['Case_Name'];
                         
//    $txtfile= html_entity_decode($Dcontent);
//     $txtfile= strip_tags($Dcontent);
     function rm_special_char($str) {
$finalval = str_replace( array("#", "'", ";","/","?","$","*","\\","<",">"), '', $str);
return $finalval;
}
 $Dtitle= rm_special_char($Dtitle);
 
                    }
                     $fpath= "../ClientCaseData/$ClientName/$CaseName/Drafts";
                     $Dcontent = file_get_contents("$fpath/$Dtitle.txt");
                     
                    }else{
                        echo "File Not Founded !!! :( <br> Please Contact to Developer :) ";
                    }

      
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



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
 <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="../assets12/css/sam.css">
          <link rel="stylesheet" href="../Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

                <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        
           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="../ckeditor/ckeditor.js"></script>
       <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>

    <title>Draft-Split View</title>
     <style>
        
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
.tab-content>.active{
    background:White;
}
       .cc input{
             padding:0px;
             height:-1px;
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
    
}
.cc{
              height:40px;
            }
            .cc .btn{
    margin-top: 5px;
    background: #008080;
/*    padding:6px;*/
    margin-bottom:5px;
}
  .rowbg{ 
                 border:2px solid #F00;
                border:2px solid red !important;
color:#4285F4;

              }
              .Dydates{
                  width:12px;
              }
              .pg{
                  width:10px;
              }
              .popover-body {
    padding: .5rem .75rem;
    color: #212529;
    font-size: x-large;
}
.Dytitle{
    width:45%;
}
.ViewContents{
    font-size: 25px;
    height:1100px;
    overflow:auto;
/*    border-right: 2px solid black;*/
   
}
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color:#40e0d0;
}
    </style>
  </head>
  <body>
      
       <div class="topnav" id="myTopnav">


        <a href="../Cms.php" class="nav__link">DashBoard</a>
        <a href="../Teams.php" class="nav__link" id="TM">Team</a>
         <a href="../task.php" class="nav_link">Task Management</a>
         <a href="../calendar.php" class="nav_link">Calendar</a>
        <a href="../library.php" class="nav__link">Library</a>
        <a href="../knowledge.php" class="nav__link ">Knowledge</a>
        <a href="../Clients.php" id="CM"class="nav__link">Clients </a>
        <a href="../Drafting.php"class="nav_link active">Drafting</a>
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
       <div class="container-fluid vbg">
             <a href="../Drafting.php" class="nav__link text-white  ml-2  mt-2 ">Create Drafts</a>
            <a href="viewDrafts.php" class="nav__link text-white  ml-3  mt-2 ">View Drafts</a>
             <a href="Draftsplit.php" class="nav__link text-white  ml-3  mt-2 active">Draft Split-View</a>
             <a href="DelDraft.php" class="nav_link text-white ml-2 mt-3 ">Delete Drafts</a>
      </div>

<!--  <h1 class="text-center text-warning">Under Construction </h1>-->
<div class="container-fluid cc">
     <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 p-1">
            
             <div class="form-group  ml-1 mb-1 ">
<!--                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>-->
                               
                                <select class="CN form-control" id="Clientname" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_ClName').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected><?php echo $ClientName;?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="text_ClName" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
            
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
              <div class="form-group mt-1 mb-1">
<!--                                <select class="form-control mt-1"  style="width:100%;" id="Casenamed" placeholder="Please Select Client Name"onchange="document.getElementById('text_Casenamed').value = this.options[this.selectedIndex].text">-->
                  
                                 <select class="form-control CN"  style="width:100%;" id="Casenamed" placeholder="Please Select case Name" onchange="document.getElementById('caseName_text').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected><?php echo $CaseName;?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="CaseN" id="caseName_text" value="<?php echo $row['Case_Name']; ?>" />
                            </div>
        </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
              <div class="form-group mt-1 mb-1">
<!--                                <select class="form-control mt-1"  style="width:100%;" id="Casenamed" placeholder="Please Select Client Name"onchange="document.getElementById('text_Casenamed').value = this.options[this.selectedIndex].text">-->
                                 <select class="form-control DF" name="DraftId" style="width:100%;" id="DraftDy" placeholder="Please Select Draft">
                                    <option value=""disabled selected><?php echo $Dtitle;?></option>
                                    <?php
                                   
                                    $sql = mysqli_query($con, "SELECT * FROM Drafting");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DTitle'] . "</option>";
                                    }
                                    ?>
                                </select>
<!--                                <input type="hidden" name="CaseN" id="text_casenamed" value="<?php echo $row['Case_Name']; ?>" />-->
                            </div>
        </div>
     
    </div>
</div>
  <div class="container-fluid ">
      <div class="row">
          <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 p-0 ">
             
             <ul class="nav nav-pills p-0 vbg" id="">
                        
                       

                        <li class="nav-item ">
                            <a id="vt" class="nav-link active timelinelink " data-toggle="pill" href="#VT" >View TimeLine</a>
                        </li>
                         <li class="nav-item">
                             <a id="vd"   class="nav-link timelinelink" data-toggle="pill" href="#VD">View Document</a>
                        </li>
                        <li class="nav-item">
                             <a id="vk"  class="nav-link timelinelink" data-toggle="pill" href="#VK">Knowledge </a>
                        </li>
                        <li class="nav-item">
                            <a id="vs"   class="nav-link timelinelink" data-toggle="pill" href="#VS">View Knowledge </a>
                        </li>
                        
      
                    </ul>
   <div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active p-0" id="VT" role="tabpanel" >
       <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>




                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
//                                        echo  " Hello Tis".$cid;
//                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid={$cid} ORDER BY STR_TO_DATE(Date, '%d/%m/%Y' ) ASC");
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Case_Name = '$CaseName' ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                       //echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                              $cid= $row['Cid'];
                                              $pdfName=$row['Pdf_Name'];
                                                ?>
<!--                                              <script> console.log("<?php echo $pdfName; ?>");</script>-->
                                                    <tr id="row<?php echo $sr;?>">
<!--                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>-->                                                 
                                                   <td class="Dydates text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
                                                       
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Doc_type'] ?></td>-->
                                                                    <td class="text-center text-nowrap d-none" scope="row"style="" data-toggle="tooltip"  title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,20); ?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Title'] ?></td>-->
                                                                    <td class=" text-nowrap" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,55); ?></td>
                                                                    <?php $row['Content'] = strip_tags($row['Content']);?>
<!--                                                                     <td class=" text-nowrap" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Content']?>"><?php echo substr($row['Content'],0,25); ?></td>-->
                                <th class="Dydates text-center text-nowrap"  data-toggle="popover"  data-placement="top" data-content="<?php echo $row['Content']; ?>"><a class="nav-link viewdata">View</a> </th>
<!--                                                                       <td class=" text-nowrap overflow-auto" scope="row" data-toggle="tooltip" title="<?php echo $row['Content']?>"><?php echo rtrim(substr($row['Content'],0,30));?></td>-->
                                                                       
                                                     <th class=" pg text-center" scope="row" style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)">
<!--                                                     <a class="nav_link no " onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><?php echo $row['St_pg'] ?></a>-->
                                                         <a class="nav_link no " ><?php echo $row['St_pg'] ?></a>
                                                    </th>
                                                 
              <th class="pg text-center" scope="row"style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)">
<!--                  <a class="nav_link no" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)"><?php echo $row['Ed_pg'] ?></a>-->
                  <a class="nav_link no"><?php echo $row['Ed_pg'] ?></a>                                 
              </th>

           
             
<!--                <td class="text-nowrap" scope="row"   data-toggle="modal" data-target="#DescsModal"data-toggle="tooltip-top" title="<?php echo $row['Content']?>" onclick="DescB(<?php echo $row['Sr_no']?>)"><?php echo trim(substr($row['Content'],0,20))?></td>-->
                
<!--              <td class="text-center" scope="row"style=""><a class="btn btn-sm" onclick="Timelview('<?php echo $row['Cid']?>')">View</a></td>-->
<!--                    <td class="text-center" scope="row"style="cursor: pointer;"><a class="nav_link" onclick="phpviewer('<?php echo $row['Cid']?>','<?php echo $sr;?>')">View</a></td>-->
<!--                            <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
<!--                    <td class="text-center" scope="row"style=""><a class="nav-link"  href="UploadClientBrief/UpdatetimelineBrief.php?v=<?php echo $row['Sr_no']?>"onclick="">Edt</a>
                                    <a class="nav-link text-danger" href="UploadClientBrief/DelTimelineBrief.php?v=<?php echo $row['Sr_no']?>">Delete</a>
                            </td>
                             <td class="text-center" scope="row"style="">
                                    <a class="nav-link text-danger" href="UploadClientBrief/DelTimelineBrief.php?v=<?php echo $row['Sr_no']?>&c=<?php echo $cid?>">Del</a>
                            </td>-->

                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        $path= "../ClientCaseData/$ClientName/$CaseName/ClientBrief/$pdfName";
                                        ?>
                                    </tbody>
                                </table>


                            
                            
      
                            </div><!--VT-->
  
  
  
  </div>
  <div class="tab-pane fade p-0" id="VD" role="tabpanel">
    <div id="my_pdf_viewer" class="">
        
                    	<div id="navigation_controls" class="text-center cc">
                             <button class="btn btn-primary btn-sm float-left ml-2" id="back">Back</button>
                            <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                             <input class=" text-center" id="current_page" value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                            <button class="btn btn-primary btn-sm" id="reload">Refresh</button>
                        </div> 
<!--                           <hr class="bg-secondary mt-4">-->
                          
                    	<div id="canvas_container" class="mt-1 mb-1">
                           
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
                           
<!--                              <hr class="bg-secondary">-->
    <div id="navigation_controls" class="text-center cc">
        <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                         <button class="btn btn-primary btn-sm"id="go_next1">Next</button>
                               <input class=" text-center" id="current_page1" value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                               <button class="btn btn-primary btn-sm" id="reload1">Refresh</button>
                        </div>
     
					</div> 
  
  
  </div>
  <div class="tab-pane fade p-0" id="VK" role="tabpanel">
      
      <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive ">

                                <table class="table table-striped table-bordered p-0 table-hover " id='knowledgelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Sr No"  scope="col" style="width:10%" >SRN</th>
<!--                                                 <th  class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col" style="width:20%">Date</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of knowledge"  scope="col" style="width:50%">Title</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="View knowledge"  scope="col">View</th>
<!--                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit Knowledge"  scope="col">Edit</th>-->
                                               
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $sr = 1;
//                                        echo  " Hello Tis".$cid;
//                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid={$cid} ORDER BY STR_TO_DATE(Date, '%d/%m/%Y' ) ASC");
                                        $sql="SELECT * FROM knowledge_data ";
                                       //echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                        <tr>
                                            <th style="width:10%" class="Dydates text-center"><?php echo $sr++;?></th>
<!--                                            <td class="text-center text-nowrap d-none"><?php echo date('d-m-Y', strtotime($row['K_Date']));?></td>-->
<!--                                            <th><?php echo $row['K_Title'];?></th>-->
                                        <td style="width:30%;"  class="text-nowrap Dytitle "   data-toggle="tooltip" title="<?php echo $row['K_Title']?>"><?php echo substr($row['K_Title'],0,70); ?></td>
<!--                                            <th class="text-center " onclick="ViewContent(<?php echo $sr;?>)"id='viewcont<?php echo $sr;?>' data-toggle="popover"  data-placement="top" data-content="<?php echo $row['Content']; ?>"><a class="nav_link" >View</a></th>-->
                                         <?php $row['K_Content'] = strip_tags($row['K_Content']);?>
<!--                                        <th class="Dydates text-center" data-toggle="popover"  data-placement="top" data-content="<?php echo $row['K_Content']; ?>"><a class="nav_link">View</a></th>-->
                                            <th class="Dydates text-center" id="view" onclick="ViewContents(<?php echo $row['Sr_no']; ?>)" ><a  class="Dydates nav_link">View</a></th>
                                  
<!--                                            <th class="text-center"><a class="nav__link">Edit</a></th>-->
                                        </tr>
                                        
                                        <?php
                                        }}
                                        ?>
                                       
                                        
                                    </tbody>
                                </table>
                                            </div>
  
  </div>
  <div class="tab-pane fade" id="VS" role="tabpanel">
      <button class="btn btn-sm text-white"id="kback">Back</button>
<div class="continer-fluid mt-1 border-right" id="viewdata">
    
  



      </div>
      
              
          </div> 
              
</div>
              
                       
          
          <div class="collapse" id="Testing">
  <div class="card card-body">
      <button id='viewtable' class="btn btn-sm text-white"> View Table</button>
    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
  </div>
</div>
              
              
              
          </div>
         
          <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 p-0">
<!--              <textarea id="editor"><?php echo $Dcontent?></textarea>-->
                 <div class="container-fluid  mt-1 border">
        <form id='editordy'>
<!--        <div class="alert alert-dismissible fade show" id="alert" role="alert">
  <strong>Auto Saved</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>-->
            <input type="hidden" value="<?php echo $clientid;?>"/> 
            <input type="hidden" name="usrno"id="usrno" value="<?php echo $srno;?>"/>
            <textarea id="editor" name="content" onkeyup="myFunction()"><?php echo $Dcontent?></textarea>
             <div class=" ml-4 mt-0 alert p-0">
            <button class="btn btn-sm float-left text-white mt-1 " name="savebtn" id="savebtn">Save</button>
            <button class="btn btn-sm float-left text-white mt-1 ml-2" name="loadbackup" id="loadbackupbtn">Load from backup</button>
            <button class="btn btn-sm float-left text-white mt-1 ml-2" name="Savetotxt" id="savetotext">Save to text</button>
            <button class="btn btn-sm float-left text-white mt-1 ml-2" name="Loadtxt" id='loadtxt'>Load From text</button>  
<!--            <a class="btn btn-sm  float-left text-white  ml-2 mt-1 text-center" data-toggle="modal" data-target="#uploaddraft" >Upload Final Draft</a>-->
                 <label > <strong class="ml-3 mt-1 TotalWords pt-1" > </strong></label> 
                <label > <strong class="ml-4 mt-1 alertTxt" > </strong></label> 
               
            </div>
        </form>
    </div>
          </div>
      </div>
  </div>

    
<form id="php" action="" method="POST">
        <input  type="hidden" name="DraftSr"id="DraftSr" value="<?php echo $srno;?>">
        <input type="hidden" name="casesr "id="casesr">
        <input type="hidden" name="pdfct" id="pdfct">
<!--        <input type="text" name="caseName"id="caseName_text">-->
    </form>

<div class="modals">
    
    <!-- Modal -->
<div class="modal fade" id="Finalupload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </div>

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

  $(function(){
       $('[data-toggle="popover"]').popover({
           html:true,
            
       });
    });
    
    $('body').on('click', function (e) {
    $('[data-toggle=popover]').each(function () {
        // hide any open popovers when the anywhere else in the body is clicked
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});
  
    </script>
<script>
     

    function show(sr){
//        alert(sr);
        $('.collapse').removeClass('show');
       $('#'+sr).addClass('show');
    }
      
//$('.collapse').collapse();
 
 function ViewContent(id){
     $("#viewcont"+id).click(function(){
         $('#VK').hide();
     });
 }
     
     $("#viewtable").click(function(){
         $('#VK').show();
     });
            
    $("Select").select2();
    $("#Clientname").on("change",function(){
     var category = $("#Clientname").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"function.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
            $("#Casenamed").html(data);
          
        }
      });
 });
 
  $("#Casenamed").on("change",function(){
     var category = $("#Casenamed").val();
     
     console.log(category);
     $("#casesr").val(category);
     var cid= JSON.stringify(category);
      $.ajax({
        url :"function.php",
        type:"POST",
        cache:false,
        data:{caseId:cid},
        success:function(data){
            console.log(data);
           $("#DraftDy").html(data);
          
        }
      });
 });
         $("#DraftDy").on("change",function(){
            var Sr = $("#DraftDy").val(); 
//            alert(Sr);
            $('#DraftSr').val(Sr);
            
            $('#php').submit();
              
     
             
         });
//           $("#Casenamed").on("change", function () {
//                   var categorys = $("#caseName_text").val();
//
//                    console.log(categorys);
////                    alert(categorys);
//
//                    var cids = JSON.stringify(categorys);
//                    $.ajax({
//                        url: "../UploadClientBrief/pdfDy.php",
//                        type: "POST",
//                        cache: false,
//                        data: {countryId: cids},
//                        success: function (data) {
//                            console.log("srno:- "+ data);
//                            $("#pdfct").val(data);
////                              var Cid = $("#pdfct").val();
////                                console.log(Cid);
//     
//                            $("#path").val(data);
//                               var Cid = $("#path").val();
//                               console.log(Cid);
//                            
//                        }
//                    });
//                });
//                
    
    
    </script>
    
    
    <?php 
      if(isset($_POST['DraftSr']) || isset($_POST['savebtn']) || isset($_POST['loadbackup']) || isset($_POST['Savetotxt']) || isset($_POST['Loadtxt']) || isset($_POST['filesubmit']) || isset($_GET['d']) ) {
        ?>
    <script>
        var cname = "<?php echo $ClientName?>";
        var casename= "<?php echo $CaseName?>";
        var Draftname= "<?php echo $Dtitle?>";
        
         // console.log(cname);
           if(cname==" "){
                console.log("inside if");
           }else{
               console.log("inside else");
               console.log(cname);
               console.log(casename);
                var Cname = JSON.stringify(cname);
                var CaseN = JSON.stringify(casename);
                    $.ajax({
                        url: "../UploadCase/CaseNameDy.php",
                        type: "POST",
                        cache: false,
                        data: {Cname: Cname,Case:CaseN},
                        success: function (data) {
                            console.log(data);
                            $("#Casenamed").html(data);

                        }
                    });
             
        var CaseN = JSON.stringify(casename);
        var draftN= JSON.stringify(Draftname);
      $.ajax({
        url :"function.php",
        type:"POST",
        cache:false,
        data:{caseN:CaseN,DraftN:draftN},
        success:function(data){
            console.log(data);
           $("#DraftDy").html(data);
          
        }
      });
               
           }
         $(document).ready(function() {
            $('#Timelist').DataTable({
//        "pagingType":"full_numbers",
        "bFilter": true,
        "bInfo": true,
        "lengthMenu":[
            [15,25,50,-1],
            [15,25,50,"All"]
        ],
        "bProcessing": true,
"bDeferRender": true,
        responsive:true,
      
        language:{
          //"search": "_INPUT_",
           searchPlaceholder:"Search Timeline",
    
        },
//drawCallback: function() {
//    $('[data-toggle="popover"]').popover();
//  }, 
 
    });
    });
    
    
//const rows = $("#Timelist").dataTable().fnGetNodes();
//$(rows).find('[data-toggle="popover"]').popover({ html: true,});
     
//     $('#Timelist tbody').on('click','.viewdata',function(){
//        alert('hey'); 
//     });
//               $(function(){
//       $('[data-toggle="popover"]').popover({
//           html:true,
//            
//       });
//    });
//    
//    $('body').on('click', function (e) {
//    $('[data-toggle=popover]').each(function () {
//        // hide any open popovers when the anywhere else in the body is clicked
//        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
//            $(this).popover('hide');
//        }
//    });
//});
//  
           
        </script>
     <?php   
    }
    ?>
        <script>
          
            CKEDITOR.replace('editor',{
                          
                        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', '../css/Ckeditor.css' ],
                        
                        bodyClass: 'document-editor',
      height: 1100,
     
      extraPlugins:'texttransform',
      font_names:'Arial;Times New Roman; Verdana',
      
      
      toolbar: [
			{ name: 'document', items: [  'zoom' ] },
			{ name: 'clipboard', items: [ 'Undo', 'Redo'  ] },
			{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			{ name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
			{ name: 'links', items: [ 'Link', 'Unlink' ] },
			{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                        { name: 'texttransform', items: [ 'TransformTextToUppercase', 'TransformTextToLowercase', 'TransformTextCapitalize', 'TransformTextSwitcher' ] },
                        
			{ name: 'insert', items: [  'Table','lineheight' ] },
			{ name: 'tools', items: [ 'Maximize','find'] },
			//{ name: 'editing', items: [ '','find','selection' ] },
                        { name: 'editing', items: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                        
		],
                
                language:'en',
                
                
                          toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
//       

        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
//      {
//            name: 'document', 
//            groups: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] ,
//        },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
//		{ name: 'forms', groups: [ 'forms' ] },
//        {
//          "name": "insert",
//          "groups": ["insert"]
//        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
        name: 'styles',
        groups: [ 'styles' ] 
    },
    
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] }
		
        
      ],
   
            
     
      
      extraPlugins:'lineheight',
     //extraPlugins: 'texttransform',
     //readOnly:true,
     line_height:"1;1.5;2;2.5;3;4",
      // Remove the redundant buttons from toolbar groups defined above.
     // removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
     
    });
   
        //  $(".document-editor").css({"width": "18.2cm"});
          
          </script>
   
              
<script>

   function ViewContents(sr){
//       alert(sr);
 $.ajax({
        url :"function.php",
        type:"POST",
        cache:false,
        data:{knowledgeSr:sr},
        success:function(data){
            console.log(data);
            
            $('#viewdata').html(data);
             $('#vs').trigger('click');
            //alert(data);
                    // $("#DraftDy").html(data);
          
        }
      });


   }
   document.getElementById("kback").addEventListener("click", KBack);
   function KBack(){
        $('#vk').trigger('click');
   }
    document.getElementById("back").addEventListener("click", Back);
   function Back(){
//       $("#vd").removeClass('active');
//       $('#vt').addClass('active');
//        $('#VT').tab('show');
         $('#vt').trigger('click');
        
         //$('.nav-tabs a[href="#VT"]').tab('show');
    }
    
//     $('#Timelist tr').removeClass("no");        
//            
function Etpg(id,pageno)
		{   
                    $('#vd').trigger('click');

//$('#Timelist tr').removeClass("rowbg");
//$('#Timelist tr').removeClass("no");
//        $('#row'+id).addClass("rowbg");
//        $('#row'+id).addClass("no");
        
//$('tr','#row'+id).addClass("rowbg");
			var desiredPage = pageno;
			if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
						document.getElementById("current_page")
                                .value = desiredPage;
								document.getElementById("current_page1")
                                .value = desiredPage;
                        render();
                }
				
				console.log(id+"  "+pageno);
				//$('#sampleTable tr').removeClass("rowbg");
				//$('#row'+id).addClass("rowbg");
			
		}
          
          
         
         var link= "<?php echo $path;?>";
//         var link = "../ClientCaseData/Aditya Pratap/Aditya Pratap vs Audi Mumbai South/ClientBrief/javascript_tutorials.pdf";
         console.log(link);
         if(link == null){
            console.log("no data founded"); 
         }
         else{
             
         
    //function view(link){

// location.reload();
 cache: false;
   
   // viewbtn.textContent = link;
//console.log(link);
   // PDFObject.embed(link,"#pdf_view");    
     $("#current_page").val('1');
     $("#current_page1").val('1');
	
   var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1
//        cache: false
    }
	//console.log(link);
   // pdfjsLib.getDocument("<?php echo $path;?>").then((pdf) => {
          pdfjsLib.getDocument(link).then((pdf) => {
       myState.pdf = pdf;
        pdfDoc = pdf;
	   render();
           //myState.showPreviousViewOnLoad = false;
           
 });
 


function render() {
	
    myState.pdf.getPage(myState.currentPage).then((page) => {
 
        var canvas = document.getElementById("pdf_renderer");
		var ctx = canvas.getContext('2d'); 
		var viewport = page.getViewport(myState.zoom);
		canvas.width = viewport.width;
		canvas.height = viewport.height;
//                canvas.scale =3.8;
//		canvas.showPreviousViewOnLoad = false;
		 
		page.render({
			canvasContext: ctx,
			viewport: viewport
		});
		
 		 
 
    });
}


		document.getElementById('go_previous')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page")
                    .value = myState.currentPage;
			document.getElementById("current_page1")
                    .value = myState.currentPage;
            render();
        });
		document.getElementById('go_previous1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page")
                    .value = myState.currentPage;
			document.getElementById("current_page1")
                    .value = myState.currentPage;		
            render();
        });
		
		
		
		
		document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage >= myState.pdf._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
                document.getElementById("current_page").value = myState.currentPage;
			document.getElementById("current_page1").value = myState.currentPage;		
            render();
        });
		document.getElementById('go_next1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage >= myState.pdf
                                               ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page1")
                    .value = myState.currentPage;
			document.getElementById("current_page")
                    .value = myState.currentPage;
            render();
        });
		
		
		
		document.getElementById('current_page')
        .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                        document.getElementById('current_page')
                                .valueAsNumber;
                                 
                if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page")
                                .value = desiredPage;
						document.getElementById("current_page1")
                                .value = desiredPage;
                        render();
                }
            }
        });
		
		document.getElementById('current_page1')
        .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                        document.getElementById('current_page1')
                                .valueAsNumber;
                                 
                if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page")
                                .value = desiredPage;
						document.getElementById("current_page1")
                                .value = desiredPage;
                        render();
                }
            }
        });
		
		document.getElementById('zoom_in')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			
			$("#pdf_renderer").css("width", "auto");
            myState.zoom += 0.1;
            render();
        });
		document.getElementById('zoom_in1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			
			$("#pdf_renderer").css("width", "auto");
            myState.zoom += 0.1;
            render();
        });
		
		
		
		document.getElementById('zoom_out')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			$("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		document.getElementById('zoom_out1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			$("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		
		var deg = 90;
		document.getElementById('rotate_page')
        .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		document.getElementById('rotate_page1')
        .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		
		function pdfpage(pageno,id)
		{
			var desiredPage = pageno;
			if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
						document.getElementById("current_page")
                                .value = desiredPage;
								document.getElementById("current_page1")
                                .value = desiredPage;
                        render();
                }
				
				
//				$('#sampleTable tr').removeClass("rowbg");
//				$('#row'+id).addClass("rowbg");
			
		}
                
    
                 function jump(pg) { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pg);
        $("#current_page1").val(pg);
        
        
        myState.currentPage = pg;
        
          render();
    }

document.getElementById("Firstpg").addEventListener("click", Firstpg0);
    function Firstpg0() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("Lastpg").addEventListener("click", Lastpg0);
    function Lastpg0() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }
     document.getElementById("Firstpg1").addEventListener("click", Firstpgv);
    function Firstpgv() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("Lastpg1").addEventListener("click", Lastpgv);
    function Lastpgv() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }


    

         }
              
              </script>
    
    
<script>
     $('#knowledgelist').DataTable({
//        "pagingType":"full_numbers",
        "bFilter": true,
        "bInfo": true,
        "lengthMenu":[
            [15,25,50,-1],
            [15,25,50,"All"]
        ],
        responsive:true,
        language:{
          //"search": "_INPUT_",
           searchPlaceholder:"Search knowledge",
    
        }
    });
                               
 </script> 
 <script>
        function updateActivity(){
            var activeon = 'Draft Split View';
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
    <?php 
    if(isset($_POST['DraftSr']) || isset($_POST['savebtn']) || isset($_POST['loadbackup']) || isset($_POST['Savetotxt']) || isset($_POST['Loadtxt']) || isset($_POST['filesubmit']) || isset($_GET['d']) ) {
     ?>  
    <script>    
                 var editorInstance = CKEDITOR.instances['editor'];
                function autosave(){
      //    console.log(editor);
      
     
FCKeditor_OnComplete(editorInstance);
fckeditor_word_count(editorInstance);
    function FCKeditor_OnComplete(editorInstance) {
    fckeditor_word_count(editorInstance);
    //editorInstance.Events.AttachEvent('editor',fckeditor_word_count);
   }
var count = 0;
function fckeditor_word_count(editorInstance) {
    var matches = editorInstance.getData().replace(/<[^<|>]+?>|&nbsp;/gi,' ').match(/\b/g);
           //var count = 0;
    if(matches) {
        count = matches.length/2;
    }
    //console.log(count);
    $('.TotalWords').text( count + " Words");
    return count;
    //document.getElementById('word_count').innerHTML = count + " word" + (count == 1 ? "" : "s") + " approx";
}
var matches = editorInstance.getData().replace(/<[^<|>]+?>|&nbsp;/gi,' ').match(/\b/g);
           //var count = 0;
    if(matches) {
        count = matches.length/2;
    }
    

      var desc = CKEDITOR.instances['editor'].getData();
//      console.log(desc);
          var id=$('#usrno').val();
          
//          var editor=$('#editor').val();       
          var ids= JSON.stringify(id);
      var editors=JSON.stringify(desc);
      console.log(ids);
      $.ajax({ 
     type: "POST", 
    url:'../Drafting/function.php',
    data: {uid:ids,editors:editors,count:count},
    success:function(result){
         $('.alertTxt').show();
    console.log(result);
    //  alert(result);
    $('.alertTxt').html(result);
   
//       setTimeout(function () {
//           // $('.alertTxt').hide();
//        }, 3000);

  
   }

  });
  }
  
  setInterval(function(){
  autosave();
  
  },5000);
  
  
  function updateUserStatus(){
  $.ajax({
    type:'post',
    url:'../Status/updateStatus.php',
    data: {status:1},
    success:function(){

    }
  });

}
setInterval(function(){
    var count = 0;
var matches = editorInstance.getData().replace(/<[^<|>]+?>|&nbsp;/gi,' ').match(/\b/g);
           //var count = 0;
    if(matches) {
        count = matches.length/2;
    }
    var dycount= $('.wcount').val();
console.log(count);

    if(count>dycount){
        console.log('inside');
     updateUserStatus();   
    }


},2000);


        
        </script>
        
        
        
        
        
        <script>
                    
                         $('#savebtn').click(function(e){
        e.preventDefault();
             var id=$('#usrno').val();
           var desc = CKEDITOR.instances['editor'].getData();
           var editors=JSON.stringify(desc);
       //alert('SaveBackup');
        $.ajax({
    type:'POST',
    url:'function.php',
    data: {SaveBackup:id,Content:editors},
     beforeSend: function () {
          $('.alertTxt').html("<strong style='color:#ff7f50;'>Saving...</strong>");
        },
    success:function(res){
      $('.alertTxt').html(res);
    }
  });
  }); 
  
  
  $('#loadbackupbtn').click(function(e){
        e.preventDefault();
             var id=$('#usrno').val();
        
        $.ajax({
    type:'POST',
    url:'function.php',
    data: {LoadBackup:id},
     beforeSend: function () {
          $('.alertTxt').html("<strong style='color:#ff7f50;'>Loading From Backup...</strong>");
        },
    success:function(res){
       CKEDITOR.instances['editor'].setData(res);
         $('.alertTxt').html("<strong style='color:green;'>Loaded Successfully...</strong>");
    }
  });
        
     });
  
  
   $('#savetotext').click(function(e){
        e.preventDefault();
         var id=$('#usrno').val();
         var desc = CKEDITOR.instances['editor'].getData();
           var editors=JSON.stringify(desc);
       
        $.ajax({
    type:'POST',
    url:'function.php',
    data: {SaveTxt:id,Content:editors},
     beforeSend: function () {
          $('.alertTxt').html("<strong style='color:#ff7f50;'>Saving to Text...</strong>");
        },
    success:function(res){
         $('.alertTxt').html(res);
    }
  });
    });
     
      $('#loadtxt').click(function(e){ 
         e.preventDefault();
             var id=$('#usrno').val();
        $.ajax({
    type:'POST',
    url:'function.php',
    data: {LoadTxtBackup:id},
     beforeSend: function () {
          $('.alertTxt').html("<strong style='color:#ff7f50;'>Loading From Text Backup...</strong>");
        },
    success:function(res){
       CKEDITOR.instances['editor'].setData(res);
         $('.alertTxt').html("<strong style='color:green;'>Loaded Successfully...</strong>");
    }
  });
         
    });
  
                    
                    
                    </script>
        <?php
        }
        
        ?>
        

 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>