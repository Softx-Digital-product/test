<?php
include '../Database/Dp.php';

  $second= "SELECT ClientDb.Full_Name, ClientDb.Sr_no AS ClientSr, Client_CaseDb.Sr_no AS CaseSr, Client_CaseDb.Case_Name, CourtDb.Sr_no AS CourtSr, CourtDb.Court_Name, Events.Sr_no AS Esr, Events.ETitle, Events.ETypetxt, Events.ESD, Events.EED
FROM ClientDb, Client_CaseDb, CourtDb, EventExtra,Events
WHERE EventExtra.ClientN = ClientDb.Sr_no
AND EventExtra.CaseN = Client_CaseDb.Sr_no
AND EventExtra.CourtN = CourtDb.Sr_no
AND EventExtra.Eid = Events.Sr_no 
AND Events.Sr_no = ";
  
  
  if(isset($_POST['insertevent'])){
      echo "<pre>";
      print_r($_POST);
      echo "</pre>";
        $ETitle=mysqli_real_escape_string($con,$_POST['title']);
     $Eventtypeid=mysqli_real_escape_string($con,$_POST['DraftId']);
     $Eventtypetxt=mysqli_real_escape_string($con,$_POST['DraftType']);
    $Sdt=mysqli_real_escape_string($con,$_POST['startDate']);
    $Edt=mysqli_real_escape_string($con,$_POST['endDate']);
$StartTime= mysqli_real_escape_string($con,$_POST['startTime']);
$EndTime= mysqli_real_escape_string($con,$_POST['endTime']); 

$ClientId= mysqli_real_escape_string($con,$_POST['ClientId']); 
$CaseId = mysqli_real_escape_string($con,$_POST['CaseId']); 
$CourtId = mysqli_real_escape_string($con,$_POST['CourtId']); 

$Sdt =  date("Y-m-d", strtotime($Sdt));
$Edt = date("Y-m-d", strtotime($Edt));


 $finalSdt=  $Sdt.'T'.$StartTime.':00';
  $finalEdt= $Edt.'T'.$EndTime.':00';
    
   $result = $con->query("SELECT MAX(Sr_no) AS maximum FROM  Events");

while ($row = $result->fetch_assoc()) {
    $Eid= $row['maximum'];
}
$Eid++;
$sql="INSERT INTO Events(ETitle,ETypeId, ETypetxt, ESD, EED) VALUES ('$ETitle','$Eventtypeid','$Eventtypetxt','$finalSdt','$finalEdt') ";

//echo $sql;
//echo $Eid;

if ($con->query($sql) === TRUE) {
      $sql = mysqli_query($con, "SELECT * FROM  Events WHERE ETitle = '$ETitle' AND ETypetxt = '$Eventtypetxt' AND ESD= '$finalSdt'");
                                    while ($row = $sql->fetch_assoc()) {
                                      $Eid= $row['Sr_no'];
                                    }
    
    
   if($CourtId != '' && $Eventtypetxt == 'Hearing'){
         $Extra = "INSERT INTO EventExtra(Eid, ClientN, CaseN, CourtN) VALUES ('$Eid','$ClientId','$CaseId','$CourtId')";
echo $Extra;
if ($con->query($Extra) === TRUE) {
    $update= "UPDATE Events SET Exid= '1' WHERE ETitle =  '$ETitle' ";
    if ($con->query($update) === TRUE) {
        echo  "All Done hearing";
    }else{
        echo "Error: ----->" . $update . "<br>" . $con->error; 
}//end of update event exid
}else{
     echo "Error: ----->" . $Extra . "<br>" . $con->error;
}
  }else{
      echo  "Else part will be run here";
  }
    
    
}else{
      echo "Error: ----->" . $sql . "<br>" . $con->error;
}
  
      die();
  }
  
  
  
  
if(isset($_POST['clientdids'])){

//        $clientid= mysqli_real_escape_string($con,$_POST['clientdids']);
        
   //     echo $clientid;
$query = "SELECT *,Client_CaseDb.Sr_no as CaseSr,CourtDb.Sr_no as Csr  FROM Client_CaseDb,CourtDb WHERE Cid = {$_POST['clientdids']} AND CourtDb.Court_Name =  Client_CaseDb.Court_Name";
//echo $query;	
$result = $con->query($query);
       echo '<option value="" disabled selected>Choose Case </option>';
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    
			echo '<option data-foo="'.$row['Csr'].'" value="'.$row['CaseSr'].'">'.$row['Case_Name'].'</option>';
		}
	} else {
		echo '<option value="">Data not available</option>';
	}
    die();
}
if(isset($_POST['dydatas'])){
   ?> 
<div class="container-fluid p-0">
<div class="row" id="dydetails">
    <div class="col-lg-4 col-sm-12">
        <label for="ClientId">Client Name</label>              
        <select class="form-control CN"  name="ClientId" style="width:100%;"  id='ClientId'>
                                    <option value=""disabled selected>Choose Client Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }
                                    ?>
                       </select>
        
    </div>
     <div class="col-lg-4 col-sm-12">
          <label for="CaseId">Case Name</label>              
                       <select class="form-control CN"  name="CaseId" style="width:100%;" id='CaseId'>
                                    <option value=""disabled selected>Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                       </select>
    </div>
     <div class="col-lg-4 col-sm-12">
        <label for="CaseId">Court Name</label> 
                            <a class="nav_link text-primary" data-toggle="modal" data-target="#AddCourt">  
                        (Add)
                    </a><a class=" nav_link ml-1 text-primary" data-toggle="modal" data-target="#EditCourt">
                        (Edit)
                    </a><a class=" nav_link  ml-1 text-primary" data-toggle="modal" data-target="#DeleteCourt">
                        (Del)
                    </a>
                       <select class="form-control CN"  name="CourtId" style="width:100%;" id='CourtId'>
                                    <option value=""disabled selected>Choose Court Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    ?>
                       </select>
     </div>
</div><br>
</div>
<?php
    die();
}



// Edit Event type Data

if(isset($_POST['DraftId'])){
    $srid= mysqli_real_escape_string($con,$_POST['DraftId']);
    $newname= mysqli_real_escape_string($con,$_POST['Etypename']);
    $newcolor= mysqli_real_escape_string($con,$_POST['Etypecolor']);
    $StartTime= mysqli_real_escape_string($con,$_POST['startTime']);
    $EndTime= mysqli_real_escape_string($con,$_POST['endTime']); 
    
    
    $sql="UPDATE EventTypes SET EventName = '$newname',EventColor='$newcolor',Stime='$StartTime', Etime='$EndTime' WHERE Sr_no = '$srid' ";
    //echo $sql;
    if ($con->query($sql) === TRUE) {
           $fq = mysqli_query($con, "SELECT * FROM EventTypes");
                                    while ($row = $fq->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['EventName'] . "</option>";
                                    }
    }else{
        echo "Error: ----->" . $sql . "<br>" . $con->error;
    }
    
    die();
}

if(isset($_POST['EventDelId'])){
    $srid= mysqli_real_escape_string($con,$_POST['EventDelId']);
    $sql="DELETE FROM EventTypes WHERE Sr_no = '$srid' ";
    if ($con->query($sql) === TRUE) {
       $fq = mysqli_query($con, "SELECT * FROM EventTypes");
                                    while ($row = $fq->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['EventName'] . "</option>";
                                    }
    }else{
        echo "Error: ----->" . $sql . "<br>" . $con->error;
    }
}
if(isset($_POST['EventType'])){
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    $EventName=mysqli_real_escape_string($con,$_POST['EventType']);
    $EventColor= mysqli_real_escape_string($con, $_POST['EventColor']);
    $StartTime= mysqli_real_escape_string($con, $_POST['startTime']);
    $EndTime = mysqli_real_escape_string($con, $_POST['endTime']);
    

$check=mysqli_num_rows(mysqli_query($con,"SELECT * from EventTypes Where EventColor='$EventColor'"));
if($check>0){
echo 'Already present';
} 
else{
    $sql="INSERT INTO EventTypes(EventName, EventColor,Stime,Etime) VALUES ('$EventName','$EventColor','$StartTime','$EndTime')";
   // echo $sql;
    if ($con->query($sql) === TRUE) {
$fq = mysqli_query($con, "SELECT * FROM EventTypes");
                                    while ($row = $fq->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['EventName'] . "</option>";
                                    }
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    
}
    die();
}

function listtables() {
  ?>
    <table class="table table-striped  table-hover " id='EventsList'>
                                    <thead class="cc text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Type" scope="col">Type</th> 
                                                 <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title" scope="col">Title</th> 
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit Event" scope="col">Edit</th> 
                                                           <th class="text-center" data-toggle="tooltip" data-placement="top" title="Remove Event" scope="col">Del</th> 
                                        </tr>
                                    </thead>
                                    <tbody id='dybody'>
    <?php
    $monthnum = date('m');
  
                                        $sr = 1;
                                     $sql= "SELECT * FROM Events WHERE MONTH(ESD) = 8";
                                     echo $sql;
//                                        $quariy = $con->query($sql);
//                                        $num = mysqli_num_rows($quariy);
//                                        if ($num >= 0) {
//                                            while ($row = mysqli_fetch_array($quariy)) {
                                     $sql = mysqli_query($con, $sql);
                                            while ($row = $sql->fetch_assoc()) {
                                                 print_r($row);
                                     ?>
                                         
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $sr; ?>" scope="row"><?php echo $sr++;?></th>
                                            <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['EventName']; ?>" scope="row"><?php echo $row['ETypetxt'];?>  </td>
                                             <td class="text-center" data-toggle="modal" data-target="#viewDataModal"  data-toggle="tooltip" data-placement="top" title="<?php echo $row['ETitle']; ?>" scope="row"><?php echo substr($row['ETitle'],0,30);?>  </td>
                                             <th class="text-center" style='cursor:pointer'data-toggle="tooltip" data-placement="top" title="" scope="row"   onclick="editevents('<?php echo $row['Sr_no'] ?>')"><a data-toggle="modal" data-target="#EditEvents"  class="text-primary" >Edit</a> </th>
                                             <th class="text-center"  style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="" onclick="delEvent('<?php echo $row['Sr_no']; ?>')" scope="row"> <a  class="text-danger">Del</a> </th>
                                              
                                        </tr>
                                        
                                        
                                           <?php    
                                        }
                                            ?>
                                        <?php
}

// Basic 



if(isset($_POST['Eventtypeid'])){
    $sql="SELECT * FROM EventTypes WHERE Sr_no = '{$_POST['Eventtypeid']}'";
     $sql = mysqli_query($con, $sql);
     while ($row = $sql->fetch_assoc()) {
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
         ?>
<input class="d-none "id="dysartttime" value="<?php echo $row['Stime'];?>" >
<input class="d-none "id="dyendtime" value="<?php echo $row['Etime'];?>">       


<?php
     }
    
    
    die();
}
if(isset($_POST['Eventid'])){
    
 $sql="SELECT * FROM EventTypes WHERE Sr_no = '{$_POST['Eventid']}'";
 $sql = mysqli_query($con, $sql);
     while ($row = $sql->fetch_assoc()) {
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
         ?>
<div>
                  <input class='form-control' type="text" name='Etypename' id='Etype' value='<?php echo $row['EventName']?>'/><br>
                  <input class='form-control' type='color' name='Etypecolor' value='<?php echo $row['EventColor'];?>' />
                   <div class="row">
                      <div id="starttime-group" class="form-group col-lg-6">
                                <label class="control-label">Start Time</label>
                                <input type="time" class="form-control timepicker" id="EventEdStartTime" name="startTime" value="<?php echo $row['Stime']; ?>"required>
                                
                                <!-- errors will go here -->
                            </div>

                            <div id="endtime-group" class="form-group col-lg-6">
                                <label class="control-label" >End Time</label>
                                <input type="time" class="form-control timepicker " id="EventEdEndTime" name="endTime" value="<?php echo $row['Etime']; ?>" required>
                                
                                <!-- errors will go here -->
                            </div>
                  </div>
</div>

<?php
     }
     die();
}





if(isset($_POST['Eids'])){
   
    $srid= mysqli_real_escape_string($con,$_POST['Eids']);
 
//     $sql="SELECT * FROM Events WHERE Sr_no = '$srid'";
    $sql="SELECT *, Events.Sr_no as Esr From Events, EventTypes Where EventTypes.Sr_no = Events.ETypeId AND Events.Sr_no = '$srid'";
    
 $sql = mysqli_query($con, $sql);
     while ($row = $sql->fetch_assoc()) {
         $Exids= $row['Exid'];
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
         
         $sdate= $row['ESD'];
               $edate= $row['EED'];
               
             $SDate= date('d-m-Y', strtotime($sdate));
             $EDate = date('d-m-Y', strtotime($edate));
             $STime= date('H:i', strtotime($sdate));
             $ETime= date('H:i', strtotime($edate));
    ?>
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h5><strong>Editing :- <?php echo $row['ETitle'];?></strong></h5>
</div>
        <div class="card-body">
             <form id="UpdateEvents">
                 <input type='hidden' name='mainid' id="mainid" value="<?php echo $row['Esr'];?>">
                   <div id="title-group" class="form-group">
                                <label class="control-label" for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title of Event" value="<?php echo $row['ETitle'];?>" id="Etitle" required>
                            </div>
          <div class="form-group">
                       <label for="DType">Select Event Type</label> 
                        <a class="ml-1 nav_link text-primary" data-toggle="modal" data-target="#AddEvent">
                                                    (ADD)
                                                </a><a class="ml-2 nav_link text-primary" data-toggle="modal" data-target="#EditEvent">
                                                   (EDIT)
                                                </a><a class="ml-2 nav_link text-primary" data-toggle="modal" data-target="#DelEvent">
                                                   (DELETE)
                                                </a>
                       <select class="form-control CN"  name="EventTypeId" style="width:100%;" id='EditEType' onchange="document.getElementById('EditEventType').value = this.options[this.selectedIndex].text">
                                    <option value="<?php echo $row['ETypeId'];?>"selected><?php echo $row['ETypetxt'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM EventTypes");
                                    while ($rows = $sql->fetch_assoc()) {
                                        echo "<option value=" . $rows['Sr_no'] . ">" . $rows['EventName'] . "</option>";
                                    }
                                    ?>
                                </select>
                       <input class="form-control mt-3" type="hidden" name="EventTypetxt" value="<?php echo $row['ETypetxt'];?>" id="EditEventType" >   
                       
                       </div>
                 <div class="Dydatess"></div>
                 
                 <?php if($Exids != 0){
                 $fquery= "$second '$srid'";
                                                   $sqls = mysqli_query($con, $fquery);
                                                    while ($rows = $sqls->fetch_assoc()) {
//                                                        echo "<pre>";
//                                                        print_r($rows);
//                                                        echo "</pre>";
                                                        ?>
                 
                                  <div class="row" id="dydetails">
    <div class="col-lg-4 col-sm-12">
        <label for="ClientId">Client Name</label>              
        <select class="form-control CN"  name="ClientId" style="width:100%;"  id='ClientId'>
                                    <option value="<?php echo $rows['ClientSr']; ?>"selected><?php echo $rows['Full_Name'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($rowc = $sql->fetch_assoc()) {
                                        echo "<option value=" . $rowc['Sr_no'] . ">" . $rowc['Full_Name'] . "</option>";
                                    }
                                    ?>
                       </select>
        
    </div>
     <div class="col-lg-4 col-sm-12">
          <label for="CaseId">Case Name</label>              
                       <select class="form-control CN"  name="CaseId" style="width:100%;" id='CaseId'>
                                    <option value="<?php echo $rows['CaseSr']; ?>"selected><?php echo $rows['Case_Name']; ?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($rowc = $sql->fetch_assoc()) {
                                        echo "<option value=" . $rowc['Sr_no'] . ">" . $rowc['Case_Name'] . "</option>";
                                    }
                                    ?>
                       </select>
    </div>
     <div class="col-lg-4 col-sm-12">
        <label for="CaseId">Court Name</label> 
                            <a class="nav_link text-primary" data-toggle="modal" data-target="#AddCourt">  
                        (Add)
                    </a><a class=" nav_link ml-1 text-primary" data-toggle="modal" data-target="#EditCourt">
                        (Edit)
                    </a><a class=" nav_link  ml-1 text-primary" data-toggle="modal" data-target="#DeleteCourt">
                        (Del)
                    </a>
                       <select class="form-control CN"  name="CourtId" style="width:100%;" id='CourtId'>
                                    <option value="<?php echo $rows['CourtSr'];?>"selected><?php echo $rows['Court_Name'];?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($rowc = $sql->fetch_assoc()) {
                                        echo "<option value=" . $rowc['Sr_no'] . ">" . $rowc['Court_Name'] . "</option>";
                                    }
                                    ?>
                       </select>
     </div>
                                  </div><br>
                                                
                                                <?php
                                                    }
                                               }else{
                                                
                                               } ?>
          <?php 
//             echo "<pre>";
//               print_r($row);
//               echo "</pre>";
               
               $sdate= $row['ESD'];
               $edate= $row['EED'];
            
               
//               echo "===>$sdate";
//               echo "<br>===>$edate";
//              $Sdate= list($date, $time) = explode("T", $sdate);
//              $Edate= list($date, $time) = explode("T", $edate);
//              $Sdate=(explode("T",$str));
              //print_r($Sdata);
             $SDate= date('Y-m-d', strtotime($sdate));
             $EDate = date('Y-m-d', strtotime($edate));
//              $sdate= $Sdate[1];
//              $edate= $Edate[1];
              //echo $sdate;
             $STime= date('H:i', strtotime($sdate));
             $ETime= date('H:i', strtotime($edate));
//               echo "---->";
//             echo $STime;
//             echo $ETime;
               
               ?>
         <div class="row">
              
                      <div id="startdate-group" class="form-group col-lg-6">
                                <label class="control-label" for="startDate">Start Date</label>
                                <input type="date" class="form-control datepickers "  min="2000-01-02" id="EStartDate" name="startDate" value="<?php echo $SDate; ?>"required>
                                
                                <!-- errors will go here -->
                            </div>

                            <div id="enddate-group" class="form-group col-lg-6">
                                <label class="control-label" for="endDate">End Date</label>
                                <input type="date" class="form-control datepickers" id="EEndDate" name="endDate" value="<?php echo $EDate; ?>" required>
                                <!-- errors will go here -->
                            </div>
                  </div>
            <div class="row">
                      <div id="starttime-group" class="form-group col-lg-6">
                                <label class="control-label" for="startDate">Start Time</label>
                                <input type="time" class="form-control timepicker" id="startTime" name="startTime" value="<?php echo $STime; ?>"required>
                                
                                <!-- errors will go here -->
                            </div>

                            <div id="endtime-group" class="form-group col-lg-6">
                                <label class="control-label" for="endDate">End Time</label>
                                <input type="time" class="form-control timepicker " id="endTime" name="endTime" value="<?php echo $ETime; ?>" required>
                                
                                <!-- errors will go here -->
                            </div>
                
                  </div>
         
         
         <button type="submit" class="btn-sm text-white btn" id="editEventdata">Update</button>
         
         
     </form>
            
        </div>
    </div>
    
</div>
<?php
     }
die();    
}



if(isset($_POST['month'])){
    
    $monthnum= $_POST['month'];
    
     $sql= "SELECT * FROM Events WHERE MONTH(ESD) = $monthnum";
     ?>

<table class="table table-striped table-bordered  table-hover " id='EventsList'>
                                    <thead class="cc text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">Date</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Type" scope="col">Type</th> 
                                                 <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title" scope="col">Title</th> 
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit Event" scope="col">Edit</th> 
                                                           <th class="text-center" data-toggle="tooltip" data-placement="top" title="Remove Event" scope="col">Del</th> 
                                        </tr>
                                    </thead>
                                    <tbody id='dybody'>
    <?php
                                        $sr = 1;
                                        
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                 $sdate= $row['ESD'];
              $Sdate= list($date, $time) = explode("T", $sdate);
  
//              $Sdate=(explode("T",$str));
              //print_r($Sdata);
             $SDate= date('d-m-Y', strtotime($sdate));
                                                ?>
                                        <tr>
                                            <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $SDate; ?>" scope="row"><?php echo $SDate;?></td>
                                            <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['ETypetxt']; ?>" scope="row"><?php echo $row['ETypetxt'];?> </td>
                                            
                                             <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['ETitle'];?>" data-toggle="modal" data-target="#viewDataModal" onclick="viewdatainfo('<?php echo $row['Sr_no'];?>')" scope="row"><?php echo substr($row['ETitle'],0,30);?>  </td>
                                             
                                             <th class="text-center" style='cursor:pointer'data-toggle="tooltip" data-placement="top" title="" scope="row"   onclick="editevents('<?php echo $row['Sr_no'] ?>')"><a data-toggle="modal" data-target="#EditEvents"  class="text-primary" >Edit</a> </th>
                                             <th class="text-center"  style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="" onclick="delEvent('<?php echo $row['Sr_no']; ?>')" scope="row"> <a  class="text-danger">Del</a> </th>
                                              
                                        </tr>
                                        
                                        
                                           <?php    
                                        }}
                                            ?>
                                        <?php
     
     die();
}



if(isset($_POST['Deleventid'])){
    
   $srid= mysqli_real_escape_string($con,$_POST['Deleventid']);
   
    $sql="DELETE FROM Events WHERE Sr_no = '$srid' ";
    echo $sql;
    if ($con->query($sql) === TRUE) {
       
    }else{
        echo "Error: ----->" . $sql . "<br>" . $con->error;
    }
    
    
    die();
}

if(isset($_POST['mainid'])){
    // Edit Events;
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    $Esrno=mysqli_real_escape_string($con,$_POST['mainid']);
    $ETitle=mysqli_real_escape_string($con,$_POST['title']);
     $Eventtypeid=mysqli_real_escape_string($con,$_POST['EventTypeId']);
     $Eventtypetxt=mysqli_real_escape_string($con,$_POST['EventTypetxt']);
    $Sdt=mysqli_real_escape_string($con,$_POST['startDate']);
    $Edt=mysqli_real_escape_string($con,$_POST['endDate']);
$StartTime= mysqli_real_escape_string($con,$_POST['startTime']);
$EndTime= mysqli_real_escape_string($con,$_POST['endTime']); 

$clientid=  mysqli_real_escape_string($con,$_POST['ClientId']);
$caseid=  mysqli_real_escape_string($con,$_POST['CaseId']);
$courtid =  mysqli_real_escape_string($con,$_POST['CourtId']);



 $finalSdt=  $Sdt.'T'.$StartTime.':00';
  $finalEdt= $Edt.'T'.$EndTime.':00';
  
$sql= "UPDATE Events SET `ETitle`= '$ETitle',`ETypeId`='$Eventtypeid',`ETypetxt`='$Eventtypetxt',`ESD`='$finalSdt',`EED`='$finalEdt' WHERE Sr_no = '$Esrno'";
//echo $sql;
 if ($con->query($sql) === TRUE) {
    
     if($courtid != '' && $Eventtypetxt == 'Hearing'){
    
    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from EventExtra Where Eid ='$Esrno'"));
if($check>0){
 $extraupdate=  "UPDATE EventExtra SET ClientN = '$clientid', CaseN = '$caseid', CourtN = '$courtid' WHERE Eid = '$Esrno'";
 
  if ($con->query($extraupdate) === TRUE) {
      echo "Update in EventExtra";
      $update= "UPDATE Events SET Exid= '1' WHERE ETitle =  '$ETitle' ";
    if ($con->query($update) === TRUE) {
        // Events Exid updated to 1 successfully
        echo "Exid = 1";
    }else{
        echo "Error: ----->" . $update . "<br>" . $con->error; 
}//end of update event exid
      
  }else{
      echo "Error: ----->" . $extraupdate . "<br>" . $con->error; 
  }
 
}
else{
//  echo "Insert  will run";  
  $Extra = "INSERT INTO EventExtra(Eid, ClientN, CaseN, CourtN) VALUES ('$Esrno','$clientid','$caseid','$courtid')";
  if ($con->query($Extra) === TRUE) {
       echo "Inserted into Event Extra";
      $update= "UPDATE Events SET Exid= '1' WHERE ETitle =  '$ETitle' ";
    if ($con->query($update) === TRUE) {
        // Events Exid updated to 1 successfully
        echo "Exid = 1";
    }else{
        echo "Error: ----->" . $update . "<br>" . $con->error; 
}//end of update event exid

  }else{
      echo "Error: ----->" . $Extra . "<br>" . $con->error; 
  }
  
}
}else{
   $update= "UPDATE Events SET Exid= '0' WHERE ETitle =  '$ETitle' ";
    if ($con->query($update) === TRUE) {
        // Events Exid updated to 1 successfully
       echo "Exid = 0";
    }else{
        echo "Error: ----->" . $update . "<br>" . $con->error; 
}//end of update event exid
    
}
    
    
    }else{
        echo "Error: ----->" . $sql . "<br>" . $con->error;
    }
    
    die();
}



if(isset($_POST['vieweventid'])){
    
    $Srno=mysqli_real_escape_string($con,$_POST['vieweventid']);
  
    
     $sql="SELECT *, Events.Sr_no as Esr From Events, EventTypes Where EventTypes.Sr_no = Events.ETypeId AND Events.Sr_no = '$Srno'";
 
     $second= "SELECT ClientDb.Full_Name, ClientDb.Sr_no AS ClientSr, Client_CaseDb.Sr_no AS CaseSr, Client_CaseDb.Case_Name, CourtDb.Sr_no AS CourtSr, CourtDb.Court_Name, Events.Sr_no AS Esr, Events.ETitle, Events.ETypetxt, Events.ESD, Events.EED
FROM ClientDb, Client_CaseDb, CourtDb, EventExtra,Events
WHERE EventExtra.ClientN = ClientDb.Sr_no
AND EventExtra.CaseN = Client_CaseDb.Sr_no
AND EventExtra.CourtN = CourtDb.Sr_no
AND EventExtra.Eid = Events.Sr_no 
AND Events.Sr_no = '$Srno'";
 $sql = mysqli_query($con, $sql);
     while ($row = $sql->fetch_assoc()) {
         $Exid = $row['Exid'];
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";

          $sdate= $row['ESD'];
               $edate= $row['EED'];
               
             $SDate= date('d-m-Y', strtotime($sdate));
             $EDate = date('d-m-Y', strtotime($edate));
             $STime= date('H:i A', strtotime($sdate));
             $ETime= date('H:i A', strtotime($edate));
         
            
         ?>
                                    <div class="card">
                                        <div class="card-header">
                                            
<!--                                            <h5><Strong>Event Title : <?php echo $row['ETitle']; ?></Strong></h5>-->
                                             <h5><Strong>Event Information</Strong></h5>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" id="srnos" value="<?php echo $Srno;?>">
                                        <label class="font-weight-bolder"><strong> Title :</strong>
                                                <?php echo $row['ETitle']; ?> </label><br><br>
                                       <label class="font-weight-bolder"><strong> Event Type :</strong>
                                                <?php echo $row['EventName']; ?> </label><br><br>
                                               <?php if($Exid != 0){
                                                   
                                                   $sqls = mysqli_query($con, $second);
                                                    while ($rows = $sqls->fetch_assoc()) {
//                                                        echo "<pre>";
//                                                        print_r($rows);
//                                                        echo "</pre>";
                                                        ?>
                                    <label class="font-weight-bolder"><strong> Client Name :</strong>
                                                <?php echo $rows['Full_Name']; ?> </label><br><br>
                                    <label class="font-weight-bolder"><strong> Case Name :</strong>
                                                <?php echo $rows['Case_Name']; ?> </label><br><br>
                                    <label class="font-weight-bolder"><strong> Court Name :</strong>
                                                <?php echo $rows['Court_Name']; ?> </label><br><br>
                                                
                                                <?php
                                                    }
                                               } ?>
                                                
                                       <label class="font-weight-bolder"><strong> Start Date:</strong>
                                                <?php echo $SDate; ?> </label>
                                            <label class="font-weight-bolder ml-4"><strong>End Date :</strong>
                                                <?php echo $EDate; ?> </label><br><br>
                                      <label class="font-weight-bolder"><strong> Start Time :</strong>
                                                <?php echo "$STime"; ?> </label>
                                            <label class="font-weight-bolder ml-4"><strong>&nbsp;End Time :</strong>
                                                <?php echo "$ETime"; ?> </label><br><br>                
                                                
                                                
                                        </div>
                                    </div>                          
                                        
  <?php
     }

    die();
}


?>
