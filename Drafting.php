<?php
include 'Database/Dp.php';

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
                        
    $fpath= "ClientCaseData/$ClientName/$CaseName/Drafts";
 if (!file_exists($fpath)) {
   $ds= mkdir($fpath, 0777,true);
    
   // echo 'folder created';
   }else{
     
      // echo 'folder Already presents';
   }
 
      $fpath= "ClientCaseData/$ClientName/$CaseName/Drafts/";
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
 
 
 
 if(isset($_GET['d'])){
    $sr=  mysqli_real_escape_string($con,$_GET['d']); 
     
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
                        }
//    echo $sr;
    
    
 }
  if(isset($_POST['Loadtxt'])){
       $sr = mysqli_real_escape_string($con,$_POST['usrno']); 
       $usql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $sr";
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
                     $fpath= "ClientCaseData/$ClientName/$CaseName/Drafts";
                     $Dcontent = file_get_contents("$fpath/$Dtitle.txt");
                     
                    }else{
                        echo "File Not Founded !!! :( <br> Please Contact to Developer :) ";
                    }

      
  }
 if(isset($_POST['Savetotxt'])){
     $sr = mysqli_real_escape_string($con,$_POST['usrno']);  
      $content = $_REQUEST['content'];
    // echo $sr;
       $usql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $sr";
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
                    $fpath= "ClientCaseData/$ClientName/$CaseName/Drafts";
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

//echo "<script> alert('Saved Successfully...')</script>";
//echo "<a href='$fpath/$Dtitle.txt'>txt file Created</a>";
                    
                    
                        }
                    else{
                        
                    }
                        
                        
 }
 if(isset($_POST['loadbackup'])){
      $sr = mysqli_real_escape_string($con,$_POST['usrno']); 
      
//      echo $sr;
      $q= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name,DraftBackup.Dcontentbackup FROM DraftBackup, Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND  DraftBackup.Rdid = Drafting.Sr_no  AND Drafting.Sr_no = '$sr'";
      
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
 if(isset($_POST['savebtn'])){

    $content = $_REQUEST['content'];
  //  $content = mysqli_real_escape_string($con,$_POST['content']);
    $sr = mysqli_real_escape_string($con,$_POST['usrno']); 
   
    $sql= "UPDATE Drafting SET DContent = '$content' WHERE Sr_no = $sr";
   // echo $sql;
       if ($con->query($sql) === TRUE) {
          //header("Refresh:0");
            $usql= "SELECT Drafting.Sr_no,Drafting.ClientId, Drafting.CaseId,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = $sr";
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
if(isset($_POST['DraftSr'])){
    $sr= $_POST['DraftSr'];
    
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
                        }
    
  //Die();  
}

if (isset($_POST['DCreate'])) {
//    echo "<pre>";
//print_r($_POST);
//echo "</pre>";
 $ClientId= mysqli_real_escape_string($con,$_POST['ClientId']);
 $CaseId= mysqli_real_escape_string($con,$_POST['CaseId']);
   $Draftid = mysqli_real_escape_string($con,$_POST['DraftId']);
    $Statusid = mysqli_real_escape_string($con,$_POST['StatusId']);
 $DraftType= mysqli_real_escape_string($con,$_POST['DraftType']);
 $DraftStatus= mysqli_real_escape_string($con,$_POST['DraftStatus']);
 $DTitle= mysqli_real_escape_string($con,$_POST['DTitle']);
 $DDesc= mysqli_real_escape_string($con,$_POST['DDesc']);
 
  $Deadline= mysqli_real_escape_string($con,$_POST['Deadline']);
    $Assgin= mysqli_real_escape_string($con,$_POST['AssignId']);
 $old_date_timestamp = strtotime($Deadline);
$Deadline = date('d-m-Y h:i A', $old_date_timestamp);   
 //echo $new_date;
// $DDesc = str_replace("\r\n",'', $DDesc);

 
 $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Drafting Where DTitle='$DTitle'"));
if($check>0){
   echo "<br> This Draft is already present";
}
else{
         $sql="INSERT INTO `Drafting`(`ClientId`, `CaseId`,`DraftId`,`StatusId`, `Dtype`, `Status`, `DTitle`,`DDesc`,`Wcount`,`Assign`,`Deadline`) VALUES ('$ClientId','$CaseId','$Draftid','$Statusid','$DraftType','$DraftStatus','$DTitle','$DDesc','0','$Assgin','$Deadline')";
         
        // echo $Sql;
        if ($con->query($sql) === TRUE) {
 //ssecho "Created Sucessfully Bro";
            
//              $clientid= $ClientId;
//    $caseid= $CaseId;
//    $Dcontent= '';
//    $Dtitle= $DTitle;
//    $ClientName= $row['Full_Name'];
//    $CaseName= $row['Case_Name'];
            
     // header("Refresh:0");
      
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
}     

 
 
 
 //echo $sql;
 

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
        
<!--        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>-->
    <script src="https://cdn.tiny.cloud/1/lqwnsl0fpvnupe7ln7qpn22a8owzllgc8nhnutgqizu34pco/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!--<script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>-->
  <script src="ckeditor/ckeditor.js"></script>

    <title>Drafting</title>
    <style>
           .ck-editor__editable {
    min-height: 600px;
   
}
.cc .btn{
        background:teal;
        
    }
    .vc {
        height:32px;
    }
    /*    body.document-editor {
        width: 32.8cm;
        background:red;
        }*/
   .active{
        background:#40e0d0;
        padding:8px;
    }
    </style>
  </head>
  <body>
      
      <?php include 'Navbars.php';?>
      <div class="container-fluid vbg">
             <a href="Drafting.php" class="nav__link text-white  ml-2  mt-2 active ">Create Drafts</a>
             <a href="Drafting/viewDrafts.php" class="nav__link text-white  ml-2  mt-2 ">View Drafts</a>
             <a href="Drafting/Draftsplit.php" class="nav__link text-white  ml-2  mt-2 ">Draft Split-View</a>
           
      </div>

<!--<button class="btn btn-primary mt-2 btn-bg ml-2" data-toggle="modal" data-target="#UploadModal" >Uplaod Files</button>-->
  
<div class="container-fluid cc ">
    
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
            
             <div class="form-group mt-1 ml-1 mb-1 ">
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
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ">
              <div class="form-group mt-1 mb-1">
<!--                                <select class="form-control mt-1"  style="width:100%;" id="Casenamed" placeholder="Please Select Client Name"onchange="document.getElementById('text_Casenamed').value = this.options[this.selectedIndex].text">-->
                  
                                 <select class="form-control CN"  style="width:100%;" id="Casenamed" placeholder="Please Select Client Name">
                                    <option value=""disabled selected><?php echo $CaseName;?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
<!--                                <input type="hidden" name="CaseN" id="text_casenamed" value="<?php echo $row['Case_Name']; ?>" />-->
                            </div>
        </div>
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ">
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
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ">
            <button class="btn btn-sm text-white  ml-4 mt-1 mb-1 text-center" data-toggle="modal" data-target="#CreateDraft" >Create Draft</button>
        </div>
    </div>
</div> 




      
<!--    <h1 class="text-center text-warning">Under Development</h1>-->
    <div class="container-fluid  mt-1 border">
        <form id='editordy'>
<!--        <div class="alert alert-dismissible fade show" id="alert" role="alert">
  <strong>Auto Saved</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>-->
            <input type="hidden"  id="clientid" value="<?php echo $clientid;?>"/> 
            <input type="hidden" name="usrno"id="usrno" value="<?php echo $sr;?>"/>
            <textarea id="editor" name="content" onkeyup="myFunction()"><?php echo $Dcontent?></textarea>
             <div class=" ml-4 mt-0 alert p-0">
            <button class="btn btn-sm float-left text-white mt-1 " name="savebtn" id="savebtn">Save</button>
            <button class="btn btn-sm float-left text-white mt-1 ml-2" name="loadbackup" id="loadbackupbtn">Load from backup</button>
            <button class="btn btn-sm float-left text-white mt-1 ml-2" name="Savetotxt" id="savetotext">Save to text</button>
            <button class="btn btn-sm float-left text-white mt-1 ml-2" name="Loadtxt" id='loadtxt'>Load From text</button>  
            <a class="btn btn-sm  float-left text-white  ml-2 mt-1 text-center" data-toggle="modal" data-target="#uploaddraft" >Upload Final Draft</a>
                 <label > <strong class="ml-3 mt-1 TotalWords pt-1" > </strong></label> 
                <label > <strong class="ml-4 mt-1 alertTxt" > </strong></label> 
               
            </div>
        </form>
    </div>
    
    
    
    
    <div class='modals'>
        
<!-- Modal -->
<div class="modal fade" id="CreateDraft"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-xl modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Draft</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div Class='Container-fluid'>
              <form action="" method="POST">
                  
            
              <div class='row'>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                             <label for="DClient">Select Client</label>
                                <select class="CN form-control" name="ClientId" id="DClient" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_ClName').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
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
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                   <div class="form-group">
                             <label for="DCase">Select Client</label>
                        <select class="form-control CN" name="CaseId" style="width:100%;" id='DCase' placeholder="Please Select Client Name">
                                    <option value=""disabled selected>Please Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                       
                  </div>
                  </div>

              </div>
              <div class='row'>
                 
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                   <div class="form-group">
                       <label for="DType">Select Draft Type</label> 
                        <a class="ml-1" data-toggle="modal" data-target="#AddDraft">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDraft">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelDraft">
                                                    (Delete)
                                                </a>
                       <select class="form-control CN"  name="DraftId" style="width:100%;" id='DType' onchange="document.getElementById('Mtype').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Draft Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM DraftTypes");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DName'] . "</option>";
                                    }
                                    ?>
                                </select>
                       <input class="form-control mt-3" type="hidden" name="DraftType" id="Mtype" >   
                       
                       </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                       <div class="form-group">
                  <label for="Dstatus">Select Status</label>
                   <a class="ml-1" data-toggle="modal" data-target="#AddStatus">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditStatus">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelStatus">
                                                    (Delete)
                                                </a>
                       <select class="form-control CN" name="StatusId" style="width:100%;" id='Dstatus'onchange="document.getElementById('Mstatus').value = this.options[this.selectedIndex].text">

                                    <option value=""disabled selected>Please Choose Status</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM DStatus");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DStatus'] . "</option>";
                                    }
                                    ?>
                                </select>
                  <input class="form-control mt-3" type="hidden" name="DraftStatus" id="Mstatus">
                  
                       </div>
                  </div>

              </div>
                  
              <div class="form-group">
                  <label for="DTitle">Draft Title</label>
                  <input type="text" class="form-control" name="DTitle" id="DTitle" placeholder="Enter Draft Title">
  </div>
                  <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                  <label for="AssignId">Assign To</label>
                
                       <select class="form-control CN" name="AssignId" style="width:100%;" id='AssginId'onchange="document.getElementById('Assigntext').value = this.options[this.selectedIndex].text">

                                    <option value=""disabled selected>Assgin To Team - Member</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM TeamMembers");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Name'] ." ".$row['Surname']. "</option>";
                                    }
                                    ?>
                                </select>
                  <input class="form-control mt-3" type="hidden" name="Assigntext" id="Assigntext">
                  
                       </div>
                      </div>
                      
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <label>DeadLine</label>
                          <input type="datetime-local" class="form-control" name="Deadline" placeholder="choose deadline">
                          
                      </div>
                  </div>
                  
                    <div class="form-group">
                  <label for="DDesc">Draft Description</label>
                   <textarea class="form-control" name="DDesc" id="DDesc" rows="3"></textarea>
                   
                  
  </div>
                  
                  <button class="btn btn-sm mt-2 text-white" name="DCreate"> Create </button>
                  
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
<div class="modal fade" id="AddDraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <div class="form-group">
                  <label for="Dadd">Draft Title</label>
                  <input type="text" class="form-control" id="Dadd" placeholder="Enter Draft Type">
            </div>
           <button class="btn-sm btn mt-1 mb-1 text-white" id="Daddbtn"> Add Type</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="EditDraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
          
           <label class="font-weight-bold">Select Draft Type</label><br>
              <select style="width:100%" id="Dedit" onchange="document.getElementById('NewDtype').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Draft Type</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM DraftTypes");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DName']."</option>";
}
?>
              </select>
             <input class="form-control mt-3" type="text"  id="NewDtype" placeholder="Edit Draft Type">
             
              <button type="button" id="Deditbtn" class="btn btn-primary mt-2" >Edit Draft Type</button>
          
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Del Draft Modal -->
<div class="modal fade" id="DelDraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
                <label class="font-weight-bold">Select Draft Type</label><br>
              <select class=""style="width:100%" id="DDel">
   <option value="" disabled selected>Please Choose Draft Type</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM DraftTypes");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DName']."</option>";
}
?>
              </select><br>
              <button type="button" id="DDelbtn" class="btn btn-primary mt-2" >Delete Draft Type</button>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>




<div class="modal fade" id="AddStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <div class="form-group">
                  <label for="Sadd">Status Title</label>
                  <input type="text" class="form-control" id="Sadd" placeholder="Enter Status">
            </div>
           <button class="btn-sm btn mt-1 mb-1 text-white" id="Saddbtn"> Add Status</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="EditStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
          
           <label class="font-weight-bold">Select Status</label><br>
              <select style="width:100%" id="Sedit" onchange="document.getElementById('NewStatus').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Status</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM DStatus");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DStatus']."</option>";
}
?>
              </select>
             <input class="form-control mt-3" type="text"  id="NewStatus" placeholder="Edit Status">
             
              <button type="button" id="Seditbtn" class="btn btn-primary mt-2" >Edit Status</button>
          
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Del Draft Modal -->
<div class="modal fade" id="DelStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
                <label class="font-weight-bold">Select Status</label><br>
              <select class=""style="width:100%" id="SDel">
   <option value="" disabled selected>Please Choose Status</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM DStatus");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DStatus']."</option>";
}
?>
              </select><br>
              <button type="button" id="SDelbtn" class="btn btn-primary mt-2" >Delete Status</button>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>




<div class="modal fade" id="uploaddraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Final Draft</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
<!--           <form action="" method="POST" enctype="multipart/form-data">-->
<form id="uploadfinaldraft">
               <div class="form-group">
                  <label for="Ufile">Upload Final Draft</label>
                  <input type="file" class="form-control" id="Ufile" name="file">
                  <input type="hidden" name="client" value="<?php echo $ClientName;?>">
                  <input type="hidden" name="case" value="<?php echo $CaseName;?>">
                  <input type="hidden" name="srid" value="<?php echo $sr;?>">
            </div>
                <button class="btn-sm btn mt-1 mb-1 text-white" name="filesubmit" id="fileupload">Upload file</button>
           </form>
           
<!--          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>


    </div>
    
    
    
    
<!--     <script>
      tinymce.init({
        selector: '#editor',
        height : "580"
      });
    </script>-->
    <form id="php" action="" method="POST">
        <input  type="hidden" name="DraftSr"id="DraftSr">
    </form>
    
   
    
    <script>
         $('.topnav1').addClass('d-none');
        $('#CM').removeClass('active');
        $('#df').addClass('active');
       
      
        $('select').select2();
        
        
        
        
        
        
         $("#DClient").on("change",function(){
             var category = $("#DClient").val();
             var cid= JSON.stringify(category);
      $.ajax({
        url :"Drafting/function.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
            $("#DCase").html(data);
          
        }
      });
      
         });
           $("#Clientname").on("change",function(){
     var category = $("#Clientname").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"Drafting/function.php",
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
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"Drafting/function.php",
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
    
             
                

        </script>
        
        
        <script>
             document.getElementById("Daddbtn").addEventListener("click", addD);
            function addD() {
                var Dtype=$('#Dadd').val();
                //alert(Dtype);
                var dtype = JSON.stringify(Dtype);

                $.ajax({
                    type: "POST",
                    url: "Drafting/function.php",
                    data: {Dtype: dtype},
                    success: function (res) {
                        console.log(res);
                        //alert(res);
                        location.reload();
                    }

                });

            }
                
                document.getElementById("Deditbtn").addEventListener("click", editD);
            function editD() {
                
                   var sr=document.getElementById('Dedit').value;
      var Rename=document.getElementById('NewDtype').value;
      console.log(sr);
      console.log(Rename);
      var cid= JSON.stringify(sr);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "Drafting/function.php", 
       data: {srEdit:cid,rename:renames},
      success: function(res) { 
        console.log(res);
       // alert(res);
      location.reload();
 } 
       
});
                
            }
            
           
               document.getElementById("DDelbtn").addEventListener("click", DelD);
            function DelD() {
                var did= $('#DDel').val();
                var Did = JSON.stringify(did);

                $.ajax({
                    type: "POST",
                    url: "Drafting/function.php",
                    data: {Did: Did},
                    success: function (res) {
                        console.log(res);
                       // alert(res);
                        location.reload();
                    }

                });  
            }
            
             document.getElementById("Saddbtn").addEventListener("click", addS);
            function addS() {
                var Sstatus=$('#Sadd').val();
                 //alert('Add Status '+Sstatus);
                 var Ss = JSON.stringify(Sstatus);

                $.ajax({
                    type: "POST",
                    url: "Drafting/function.php",
                    data: {Sstatus:Ss },
                    success: function (res) {
                        console.log(res);
                        //alert(res);
                        location.reload();
                    }

                });
                 
            }
                document.getElementById("Seditbtn").addEventListener("click", editS);
            function editS() {
                var sr=document.getElementById('Sedit').value;
      var Rename=document.getElementById('NewStatus').value;
      var cid= JSON.stringify(sr);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "Drafting/function.php", 
       data: {SrStatus:cid,StatusN:renames},
      success: function(res) { 
        console.log(res);
        //alert(res);
      location.reload();
 } 
       
});       
    }
            
            
            document.getElementById("SDelbtn").addEventListener("click", DelS);
            function DelS() {
                
                var did= $('#SDel').val();
                   //alert('Delete Status '+did);
                   var Did = JSON.stringify(did);

                $.ajax({
                    type: "POST",
                    url: "Drafting/function.php",
                    data: {Sid: Did},
                    success: function (res) {
                        console.log(res);
                            //alert(res);
                     location.reload();
                    }

                });
                
            }
            
            </script>
            
            
                 <script>
                     
                    //  config.extraPlugins = 'zoom';
                     
                     CKEDITOR.replace('editor',{
                          
                        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', 'css/Ckeditor.css' ],
                        
                        bodyClass: 'document-editor',
      height: 800,
     
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
   

//CKEDITOR.on( 'instanceReady', function( ev ) {
//     ev.editor.setData('<span style="font-family:Verdana, Verdana, sans-serif;">&shy;</span>');
//});
        var e = CKEDITOR.instances['editor'];
e.on( 'keyup', function() {
    console.log(e.getData());
});

var editorInstance = CKEDITOR.instances['editor'];
          CKEDITOR.on(editorInstance, function(e) {
    e.editor.on('change', function (event) {
        console.log('inside editor');
    });
}); 
CKEDITOR.on('key', function (e)
{
    var event = document.createEvent("KeyboardEvent"); // or KeysEvent
    var charCode = e.data.keyCode; // at the moment this is wrong, keyCode needs to be properly converted to charCode
   event.initKeyEvent("keypress",true,true,null,false,false,false,false,0,charCode);
   var x = document.getElementById('editor');
   console.log(x);
   x.dispatchEvent(event);
}); 

$('#alert').hide();
     
    </script>
   
     
         <?php 
    if(isset($_POST['DraftSr']) || isset($_POST['savebtn']) || isset($_POST['loadbackup']) || isset($_POST['Savetotxt']) || isset($_POST['Loadtxt']) || isset($_POST['filesubmit']) || isset($_GET['d']) ) {
     ?>  
  <script>
      var cname = "<?php echo $ClientName?>";
        var casename= "<?php echo $CaseName?>";
       var Draftname= "<?php echo $Dtitle?>";
        
             var clientn= JSON.stringify(cname);
      var casen=JSON.stringify(casename);
      $.ajax({ 
     type: "POST", 
    url:'Drafting/function.php',
    data: {Tclient:clientn,Tcase:casen},
    success:function(result){
//        alert(result);
        
    }
      });
  
        
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
                        url: "UploadCase/CaseNameDy.php",
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
        url :"Drafting/function.php",
       type:"POST",
        cache:false,
        data:{caseN:CaseN,DraftN:draftN},
        success:function(data){
            console.log(data);
           $("#DraftDy").html(data);
          
        }
      });
      
               
           }
      </script>
         <script>
            function myFunction(){
                console.log('inside myfunction');
                   var x = document.getElementsByName("editor");
                   var editor= x.value;
                   console.log(editor);
                   
             }
             
     
     
             
             
      function autosave(){
      //    console.log(editor);
      
      var editorInstance = CKEDITOR.instances['editor'];
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
      $.ajax({ 
     type: "POST", 
    url:'Drafting/function.php',
    data: {uid:ids,editors:editors,count:count},
    success:function(result){
         $('.alertTxt').show();
    console.log(result);
    //  alert(result);
    $('.alertTxt').html(result);
   
//       setTimeout(function () {
//            $('.alertTxt').hide();
//        }, 3000);

  
   }

  });
  }
  
  setInterval(function(){
  autosave();
  
  },3000);

function updateUserStatus(){
  $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
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


},1000);

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
    url:'Drafting/function.php',
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
    url:'Drafting/function.php',
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
    url:'Drafting/function.php',
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
    url:'Drafting/function.php',
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
         
         
         $("#uploadfinaldraft").on("submit",function(e){
         e.preventDefault();
                 var formData= new FormData(this);
                  
                  $.ajax({
                     url:'Drafting/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                     beforeSend: function () {
                           $('#uploaddraft').modal('toggle');
          $('.alertTxt').html("<strong style='color:#ff7f50;'>Upload Final Draft..</strong>");
        },
                
                     success : function(data){
                    $('.alertTxt').html(data);
    }
                  });
                         
    });
        
     
     
    </script>




 <script>
     document.addEventListener("keydown", function(e) {
  if ((window.navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)  && e.keyCode == 83) {
    e.preventDefault();
//    alert('pressed');
//    $('#editordy').submit();
    $('#savebtn').click();
    // Process the event here (such as click on submit button)
  }
}, false);
    </script>
    <?php
    }
    ?>




<script>
       function updateUserStatused(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){
    }
  });

}
setInterval(function(){
updateUserStatused();
},3000);
    </script>
    
    <script>
        function updateActivity(){
            var activeon = 'Drafting';
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
