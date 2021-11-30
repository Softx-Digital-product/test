<?php
ini_set('session.save_path', '../session');
session_start();

  $sessionV = $_SESSION['username'];
  $tsr= $_SESSION['Tsr'];
include '../UploadCase/Dp.php';
date_default_timezone_set("Asia/Calcutta");
$updatetime = date("H:i:s a");
$datum = new DateTime();
$startTime = $datum->format('Y-m-d H:i:s');


if(isset($_POST['knowledgeSr'])){ 
    $sql="SELECT * FROM  knowledge_data WHERE Sr_no = '{$_POST['knowledgeSr']}'";
     $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
<div class=" card ViewContents">
    <div class="card-header">
    <h5 class="mb-2 mt-2"><strong><?php echo $row['K_Title'];?></strong></h5>
    </div>
    <div class="card-body">
       <?php echo $row['K_Content'];?> 
    </div>
    
</div>

                                                <?php
                                               // echo $row['K_Content'];
                                        }}
                                        else{
                                           // echo 'Data Not founded :(';
                                        }
                                        
    
   
    
    die();
}
if(isset($_POST['Tclient'])){
       $Tclient = json_decode($_POST['Tclient']);
          $Tcase = json_decode($_POST['Tcase']);
       
          $sql="UPDATE TeamMembers SET ClientN = '$Tclient', CaseN= '$Tcase' WHERE Sr_no = '$tsr'";
          if(mysqli_query($con, $sql)){
  
}else{
    echo "Error Deleting record: " . $con->error;
}
          
          die();
}

 if(isset($_GET['d'])){
     
    $sr=  mysqli_real_escape_string($con,$_GET['d']); 
//    echo $sr;
    $sql="UPDATE Drafting SET DelStatus ='1' WHERE Sr_no = '$sr'";
//    echo $sql;
if(mysqli_query($con, $sql)){
    header('Location: http://apajuris.in/work/Drafting/viewDrafts.php');
    die();
}else{
    echo "Error Deleting record: " . $con->error;
}
    
    die();
 }
  if(isset($_GET['r'])){
     
    $sr=  mysqli_real_escape_string($con,$_GET['r']); 
//    echo $sr;
    $sql="UPDATE Drafting SET DelStatus ='0' WHERE Sr_no = '$sr'";
//    echo $sql;
if(mysqli_query($con, $sql)){
    header('Location: http://apajuris.in/work/Drafting/viewDrafts.php');
    die();
}else{
    echo "Error Deleting record: " . $con->error;
}
    
    die();
 }

if(isset($_POST['contentid'])){
//    echo $_POST['contentid'];
    $q="SELECT * FROM Drafting WHERE Sr_no= '{$_POST['contentid']}'";
//    echo $q;
     $quariy = $con->query($q);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                echo $row['DContent'];
                                        }}
                                        else{
                                            echo 'Data Not founded :(';
                                        }
    die();
}
if(isset($_POST['uid'])){
    $Content = json_decode($_POST['editors']);
    $Wcount = json_decode($_POST['count']);
    
    $Teamid= 0;
    $q= "SELECT * FROM TeamMembers WHERE Mail_Id = '$sessionV'";
    $quariy = $con->query($q);
    $num = mysqli_num_rows($quariy);
    if ($num >= 0) {
    while ($row = mysqli_fetch_array($quariy)) {
     $Teamid= $row['Sr_no'];
     $FName = $row['Name'];
     $Lname = $row['Surname'];
     $TeamName= "$FName ' '$Lname";
 }}
    
   // echo $Content;
     $sql= "UPDATE Drafting SET DContent = '$Content', Wcount = '$Wcount', Times='$startTime',last_Edtied= '$TeamName' WHERE Sr_no = {$_POST['uid']}";
   // echo $sql;
       if ($con->query($sql) === TRUE) {
           echo "Draft Autosaved at $updatetime ";
           echo "<input type='hidden' class='wcount' value= '$Wcount'>";
       }else{
            echo "Error: ----->" . $sql . "<br>" . $con->error;
       }
    die();
}

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {
    
    $query = "SELECT * FROM Client_CaseDb WHERE Cid = ".$_POST['countryId'];
	$result = $con->query($query);
       echo '<option value="" disabled selected>Choose Case Name</option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Sr_no'].'">'.$row['Case_Name'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
        
        Die();
} 

if (isset($_POST['caseId']) && !empty($_POST['caseId'])) {
    
    $query = "SELECT * FROM Drafting WHERE CaseId = ".$_POST['caseId'];
	$result = $con->query($query);
       echo '<option value="" disabled selected>Please Select Draft</option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Sr_no'].'">'.$row['DTitle'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
        
        Die();
}
if (isset($_POST['caseN']) && !empty($_POST['caseN'])) {
    
    $DraftName =json_decode($_POST['DraftN']);
    
    $query="SELECT Client_CaseDb.Sr_no as Cid, Drafting.Sr_no,Drafting.DTitle From Client_CaseDb, Drafting WHERE Client_CaseDb.Sr_no = Drafting.CaseId AND Client_CaseDb.Case_Name= {$_POST['caseN']}";
    
   // $query = "SELECT * FROM Drafting WHERE CaseId = ".$_POST['caseId'];
	$result = $con->query($query);
      echo "<option disabled selected>$DraftName</option>";
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    
			echo '<option value="'.$row['Sr_no'].'">'.$row['DTitle'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
        
        Die();
}

if (isset($_POST['Dtype'])) {

    $Dname = json_decode($_POST['Dtype']);

    $check = mysqli_num_rows(mysqli_query($con, "SELECT * from DraftTypes Where DName='$Dname'"));
    if ($check > 0) {
        echo "Already present";
    } else {

        $sql = "INSERT into DraftTypes (DName) 
  VALUE('$Dname')";

        if ($con->query($sql) === TRUE) {
            echo "Saved Sucessfully Bro";
        } else {
            $msgs = "Error: ----->" . $sql . "<br>" . $con->error;
            echo "Error: ----->" . $sql . "<br>" . $con->error;
        }
    }

    Die();
}


if (isset($_POST['srEdit'])) {
    
    $sr = json_decode($_POST['srEdit']);
    $rename = json_decode($_POST['rename']);
 
    $sql = "UPDATE DraftTypes SET DName='$rename' WHERE Sr_no='$sr'";
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
    die();
}


if (isset($_POST['Did'])) {
 $sr = json_decode($_POST['Did']);
    $sql="DELETE FROM DraftTypes WHERE Sr_no = '$sr'";
if(mysqli_query($con, $sql)){
   echo " Delete Succesfully";
}
else{
    echo "<h3> can't Delect </h3>";
}
    Die();
}



if (isset($_POST['Sstatus'])) {

    $Sname = json_decode($_POST['Sstatus']);
    $check = mysqli_num_rows(mysqli_query($con, "SELECT * from DStatus Where DStatus='$Sname'"));
    if ($check > 0) {
        echo "Already present";
    } else {
        $sql = "INSERT into DStatus (DStatus) VALUE('$Sname')";
        if ($con->query($sql) === TRUE) {
            echo "Saved Sucessfully Bro";
        } else {
            $msgs = "Error: ----->" . $sql . "<br>" . $con->error;
            echo "Error: ----->" . $sql . "<br>" . $con->error;
        }
    }

    Die();
}

if (isset($_POST['SrStatus'])) {
    
    $sr = json_decode($_POST['SrStatus']);
    $rename = json_decode($_POST['StatusN']);
 
    $sql = "UPDATE DStatus SET DStatus='$rename' WHERE Sr_no='$sr'";
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $con->error;
}
    die();
}



if (isset($_POST['Sid'])) {
 $sr = json_decode($_POST['Sid']);
    $sql="DELETE FROM DStatus WHERE Sr_no = '$sr'";
if(mysqli_query($con, $sql)){
   echo " Delete Succesfully";
}
else{
    echo "<h3> can't Remove </h3>";
}
    Die();
}





// View Drafts 



if(isset($_POST['editid'])){
//    echo $_POST['contentid'];
    $q="SELECT Drafting.Status,Drafting.DraftId,Drafting.StatusId, Drafting.last_Edtied, Drafting.DDesc, Drafting.Sr_no,Drafting.ClientId, Drafting.Times, Drafting.CaseId,Drafting.Dtype,Drafting.DTitle, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId AND Drafting.Sr_no = '{$_POST['editid']}'";
//    echo $q;
     $quariy = $con->query($q);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariy)) {
                                               // echo $row['DContent'];
//                                                echo "<pre>";
//                                                print_r($rows);
//                                                echo "</pre>";
//                                                
                                                ?>
 <div Class='Container-fluid' id='dyedit'>
              <form action="" method="POST">
                  
                  <input type="hidden" name="srno" value="<?php echo $_POST['editid'];?>">
              <div class='row'>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                             <label for="DClient">Select Client</label>
                                <select class="CN form-control" name="ClientId" id="DClient" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_ClName').value = this.options[this.selectedIndex].text">
                                    <option value="<?php echo $rows['ClientId']?>"selected><?php echo $rows['Full_Name'] ?></option>
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
                                    <option value="<?php echo $rows['CaseId']; ?>" selected><?php echo $rows['Case_Name']; ?></option>
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
                                    <option value="<?php echo $rows['DraftId']?>"selected><?php echo $rows['Dtype'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM DraftTypes");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DName'] . "</option>";
                                    }
                                    ?>
                                </select>
                       <input class="form-control mt-3" type="hidden" value='<?php echo $rows['Dtype'];?>' name="DraftType" id="Mtype" >   
                       
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

                                    <option value="<?php echo $rows['StatusId'];?>" selected><?php echo $rows['Status'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM DStatus");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DStatus'] . "</option>";
                                    }
                                    ?>
                                </select>
                  <input class="form-control mt-3" type="hidden" value='<?php echo $rows['Status'];?>' name="DraftStatus" id="Mstatus">
                  
                       </div>
                  </div>

              </div>
              <div class="form-group">
                  <label for="DTitle">Draft Title</label>
                  <input type="text" class="form-control" name="DTitle" id="DTitle" value='<?php echo $rows['DTitle']?>'>
  </div>
                  
                    <div class="form-group">
                  <label for="DDesc">Draft Description</label>
                   <textarea class="form-control" name="DDesc" id="DDesc" rows="3"><?php echo $rows['DDesc']; ?></textarea>
                   
                  
  </div>
                  
                  <button class="btn btn-sm mt-2 text-white" name="Dupdate"> Update </button>
                  
                </form>
          </div>


<?php
                                                
                                        }}
                                        else{
                                            echo 'Data Not founded :(';
                                        }
    die();
}





if(isset($_POST['SaveBackup'])){
    
    //Drafting Backup in second database
    
     $sr= mysqli_real_escape_string($con,$_POST['SaveBackup']);
      $content= json_decode($_POST['Content']);
//      echo $content;
   $sql= "UPDATE Drafting SET DContent = '$content' WHERE Sr_no = $sr";
//    echo $sql;
    if ($con->query($sql) === TRUE) {
        
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
 //   echo "<br> Creating a backup
 //   
    $createbackup= "INSERT INTO DraftBackup(Rdid, Dcontentbackup ) VALUES ('$sr','$content')";
     if ($con->query($createbackup) === TRUE) {
} else {
  echo "Error: ----->" . $createbackup . "<br>" . $con->error;
}
}
          echo "<Strong style='color:green'>Saved Successfully</strong>";
          
} else {
  echo "Error updating record: " . $con->error;
}
    
    
    
    
    
    die();
}

if(isset($_POST['LoadBackup'])){
     $sr= mysqli_real_escape_string($con,$_POST['LoadBackup']);
     $q= "SELECT * FROM `DraftBackup` WHERE Rdid = '$sr'";
          $quariy = $con->query($q);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            echo $row['Dcontentbackup'];
                    }}
                        
    
    die();
}




if(isset($_POST['SaveTxt'])){

      $sr = mysqli_real_escape_string($con,$_POST['SaveTxt']);  
      $content= json_decode($_POST['Content']);
      
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

 
}
echo "<Strong style='color:green'>Saved Successfully</strong>";

    die();
}



if(isset($_POST['LoadTxtBackup'])){
    
      $sr = mysqli_real_escape_string($con,$_POST['LoadTxtBackup']); 
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
                     $fpath= "../ClientCaseData/$ClientName/$CaseName/Drafts";
                     $Dcontent = file_get_contents("$fpath/$Dtitle.txt");
                     echo $Dcontent;
                    }else{
                        echo "File Not Founded !!! :( <br> Please Contact to Developer :) ";
                    }
    
    die();
}



if (isset($_FILES['file'])) {  
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
          
          $targetFilePaths= "ClientCaseData/$ClientName/$CaseName/Drafts/$fileName";
          $q="Update Drafting SET FinalDoc= '$targetFilePaths' WHERE Sr_no = '$sr' ";
           if ($con->query($q) === TRUE) {
       echo "<strong style='color:green'>Uploaded Successfully...</strong>";
   }else{
       echo "Error: ----->" .$q . "<br>" . $con->error;
   }

      
      }
      else{
          echo "file Can't upload";
      }
  }
 
   
   
    die();
}

?>

