<?php
include 'UploadCase/Dp.php';
date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['esumbit'])){
//     echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    $srid= mysqli_real_escape_string($con,$_POST['DraftId']);
    $newname= mysqli_real_escape_string($con,$_POST['Etypename']);
    $newcolor= mysqli_real_escape_string($con,$_POST['Etypecolor']);
    $StartTime= mysqli_real_escape_string($con,$_POST['startTime']);
    $EndTime= mysqli_real_escape_string($con,$_POST['endTime']); 
    
    $sql="UPDATE EventTypes SET EventName = '$newname',EventColor='$newcolor',Stime='$StartTime', Etime='$EndTime' WHERE Sr_no = '$srid' ";
    //echo $sql;
    if ($con->query($sql) === TRUE) {
        header('Refresh:0');
    }else{
        echo "Error: ----->" . $sql . "<br>" . $con->error;
    }

    
}
if(isset($_POST['addeventsbtn'])){
    
//         echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
   
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


    //echo $StartTime;
  $finalSdt=  $Sdt.'T'.$StartTime.':00';
  $finalEdt= $Edt.'T'.$EndTime.':00';
    
//    2021-08-14T11:00:00
//    2021-08-23T19:22:00
//    2021-08-23T19:22:
//   $Sdt = date('Y-m-d h:i:s', strtotime($Sdt+$StartTime));
//   $Edt = date('d-m-Y h:i:s', strtotime($Edt));
//   echo '=========<br>';
//   
//   echo $finalSdt;
//   echo "<br>";
//   echo $finalEdt;
//   echo "<br>";
//   
   
//   echo $sql;
//   
   //$lq= "SELECT MAX(Sr_no) FROM Events";
  // $result= mysql_query("SELECT MAX(Sr_no) AS maximum FROM Events");
   //$rows = mysql_fetch_assoc($result); 
   $result = $con->query("SELECT MAX(Sr_no) AS maximum FROM  Events");

while ($row = $result->fetch_assoc()) {
    $Eid= $row['maximum'];
}

$Eid++;
$sql="INSERT INTO Events(ETitle,ETypeId, ETypetxt, ESD, EED) VALUES ('$ETitle','$Eventtypeid','$Eventtypetxt','$finalSdt','$finalEdt') ";

//echo $sql;
     if ($con->query($sql) === TRUE) {
         
if($CourtId != ''){
    $Extra = "INSERT INTO EventExtra(Eid, ClientN, CaseN, CourtN) VALUES ('$Eid','$ClientId','$CaseId','$CourtId')";
//echo $Extra;
if ($con->query($Extra) === TRUE) {
    $update= "UPDATE Events SET Exid= '1' WHERE ETitle =  '$ETitle' ";
    if ($con->query($update) === TRUE) {
        
    }else{
        echo "Error: ----->" . $update . "<br>" . $con->error; 
}//end of update event exid
}else{
   
}
}else{
   echo "Error: ----->" . $Extra . "<br>" . $con->error; 
}
  header("Refresh:0");
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
   
   
//    echo $Sdt;
//     echo '<br>=========<br>';
//    echo $Edt;
            
    
    
}

if(isset($_POST['AddEventType'])){
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    
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
    echo $sql;
    if ($con->query($sql) === TRUE) {
 // echo "Add Sucessfully";
  header("Refresh:0");
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    
}
}

?>
  <?php $dates= date('d-m-Y');

                  $times= date('H:i');
          $times1= date("H:i", strtotime("+1 hours"));
                 // echo $times1;
                  
                  ?> 


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
     <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
        
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js" integrity="sha512-94dgCw8xWrVcgkmOc2fwKjO4dqy/X3q7IjFru6MHJKeaAzCvhkVtOS6S+co+RbcZvvPBngLzuVMApmxkuWZGwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
  <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
          <link rel="stylesheet" href="Timeline/timeline.css">
          
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
       
   
    <title>Calendar</title>
    <style>
/*        .fc-right .fc-prev-button, .fc-right .fc-next-button{
    background-color: #b1d583;
    background-image: none;
}*/
.fc button{
 background: #66b2b2;
 text-align:center;
 color: white;
    
}
.fc-widget-header{
/*    background-color:blue;*/
padding:5px;
font-weight: bolder;

}
.fc-toolbar.fc-header-toolbar{
    padding:10px;
    color:white;
    background:#008080;
   margin-bottom: 0em !important;
}

/*.modal{
    position: absolute !important;
 z-index: 10000 !important;
}*/
/*.timepicker { position: relative; z-index: 1000000 !important; }*/
.timepicker{
     z-index: 100000 !important;
}

.datapickers{
    z-index:1900 !important;
}
/*.timepicker {z-index:9999 !important}*/
    </style>
        
  </head>
  <body>
      <input type="hidden" class="datepicker">
      <?php include'Navbars.php';?>
      
      <div class="topnav1 p-0 ">
          <a class="nav_link active p-2" href="calendar.php">View Calendar</a>
              <a class="nav_link ml-1 text-white p-2" href="ViewCaseHearing.php">View Case Hearing</a>
      </div>
      <div class"">
      
      <div class="container-fluid">
          <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 p-0">
                  
                  <div class=" vbg text-center p-2 text-white "> 
                      <div class="row">
                          <div class="col-lg-8"><label id="titleofmonth" class="ml-0 h4 text-white"></label></div>
<!--                          <div class="col-lg-3"><lable class="h4 text-white"></lable></div>-->
                          <div class="col-lg-4"><button class="btn btn-sm ml-5 text-white"data-toggle="modal" data-target="#AddEvents">Add Event</button></div></div>
                      </div>
                 
                      
                     
                       <div class='container-fluid p-0'>
                           <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive "id="dytable">
                               <table class="table table-striped table-bordered table-hover " id='EventsList'>
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
                                        $sr = 1;
                                        
                                        $quariy = $con->query("SELECT Events.Sr_no as Esr, Events.ETitle, EventTypes.EventName FROM Events, EventTypes WHERE ETypeId = EventTypes.Sr_no AND  MONTH(ESD)=MONTH(now())");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {?>
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $sr; ?>" scope="row"><?php echo $sr++;?></th>
                                            <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['EventName']; ?>" scope="row"><?php echo $row['EventName'];?>  </td>
                                             <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['ETitle']; ?>" scope="row"><?php echo $row['ETitle'];?>  </td>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="" scope="row"   onclick="editevents('<?php echo $row['Esr'] ?>')"><a data-toggle="modal" data-target="#EditEvents"  class="text-primary" >Edit</a> </th>
                                          <th class="text-center" data-toggle="tooltip" data-placement="top" title="" scope="row"> <a  class="text-danger">Del</a> </th>
                                              
                                        </tr>
                                        
                                        
                                           <?php    
                                        }}
                                            ?>
                                    </tbody>
                               </table>
                           </div></div>
                      
                  
              </div>
               <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 p-0 ">
                   <div class="calendar">
      </div>
              </div>
          </div>
      </div>
      <div class="modals">
          
          <!--Edit Modal-->
          
<div class="modal fade" id="EditEvents"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="Container-fluid" id="dycontents">
              
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

          
          <!-- Modal -->
<div class="modal fade" id="AddEvents" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered
       ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Events</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
<!--              <form id="addevents" method="POST" action="">-->
  <form id="addevents">
                   <div id="title-group" class="form-group">
                                <label class="control-label" for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title of Event" required>
                                <!-- errors will go here -->
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
                       <select class="form-control CN"  name="DraftId" style="width:100%;" id='DType' onchange="document.getElementById('Mtype').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please choose Event Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM EventTypes");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['EventName'] . "</option>";
                                    }
                                    ?>
                                </select>
                       <input class="form-control mt-3" type="hidden" name="DraftType"  id="Mtype" >   
                       
                       </div>
                  
<!--                         <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
   Same Date Event
  </label>
</div>-->
<div class="dyfileds">
    
</div>
                
                  <div class="row">
               
                      <div id="startdate-group" class="form-group col-lg-6">
                                <label class="control-label" for="startDate">Start Date</label>
                                <input type="text" class="form-control datepicker " id="startDate" name="startDate" value="<?php echo $dates; ?>"required>
                                
                                <!-- errors will go here -->
                            </div>

                            <div id="enddate-group" class="form-group col-lg-6">
                                <label class="control-label" for="endDate">End Date</label>
                                <input type="text" class="form-control datepicker" id="endDate" name="endDate" value="<?php echo $dates; ?>" required>
                                <!-- errors will go here -->
                            </div>
                  </div>
                  
                   <div class="row">
                      <div id="starttime-group" class="form-group col-lg-6">
                                <label class="control-label" for="startDate">Start Time</label>
                                <input type="time" class="form-control timepicker" id="startTime" name="startTime" value="<?php echo $times; ?>"required>
                                
                                <!-- errors will go here -->
                            </div>

                            <div id="endtime-group" class="form-group col-lg-6">
                                <label class="control-label" for="endDate">End Time</label>
                                <input type="time" class="form-control timepicker " id="endTime" name="endTime" value="<?php echo $times1; ?>" required>
                                
                                <!-- errors will go here -->
                            </div>
                  </div>

<input type="hidden" name="insertevent" value="none">
              
                  <button id="addeventbtn" name="addeventsbtn" class="btn-sm btn text-white"> Add Event</button>
                  <div class="dytimes">
                      
                  </div>
              </form>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
          
        <!-- Add Modal -->
<div class="modal fade" id="AddEvent"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <form id="AddEventTypeajax">
               <div id="title-group" class="form-group">
                                <label class="control-label" for="EventType">Enter Event Type</label>
                                <input type="text" class="form-control" name="EventType"id="EventType" placeholder="Enter Event Type" required>
                               
                            </div>
               <div id="edit-color-group" class="form-group">
                                <label class="control-label" for="editColor">Event Color</label>
                                <input type="color" class="form-control colorpicker" id="editColor" name="EventColor" value="#6453e9" required>
                          
                            </div>
                  <div class="row">
                      <div id="starttime-group" class="form-group col-lg-6">
                                <label class="control-label" for="startDate">Start Time</label>
                                <input type="time" class="form-control timepicker" id="EventstartTime" name="startTime" value="<?php echo $times; ?>"required>
                                
                                <!-- errors will go here -->
                            </div>

                            <div id="endtime-group" class="form-group col-lg-6">
                                <label class="control-label" for="endDate">End Time</label>
                                <input type="time" class="form-control timepicker " id="EventendTime" name="endTime" value="<?php echo $times1; ?>" required>
                                
                                <!-- errors will go here -->
                            </div>
                  </div>
                  <button class='btn-sm text-white btn' name='AddEventType'>Add Event Type</button>
                   <label > <strong class="ml-4 mt-1 alertTxt" > </strong></label> 
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
<div class="modal fade" id="EditEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Event Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class='container-fluid'>
              <form id="EditEventTypeajax" >
              <div class="form-group">
                       <label for="EType">Select Event Type</label>              
                       <select class="form-control CN"  name="DraftId" style="width:100%;" id='EType' onchange="document.getElementById('Etypetxt').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected> Choose Event Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM EventTypes");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['EventName'] . "</option>";
                                    }
                                    ?>
                       </select><br>
                      
                       <input class="form-control mt-3" type="hidden"  id="Etypetxt" >   
                       
                       </div>
              <div class='dycontent'>
                  <input class='form-control' type="text" name='Etypename' id='Etype' placeholder="Enter Event Name"/><br>
                  <input class='form-control' type='color' name='Etypecolor' />
                  
              </div>
                  <button class=' mt-2 btn btn-sm text-white' name='esumbit'>Edit Event Type</button>
                   <label > <strong class="ml-4 mt-1 alertTxt" > </strong></label> 
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
<div class="modal fade" id="DelEvent" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Event Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
               <form id="DelEventTypeajax" >
                   <div class="form-group">
                       <label for="DType">Select Event Type</label>              
                       <select class="form-control CN"  name="EventDelId" style="width:100%;" id='DElType'>
                                    <option value=""disabled selected>Please choose Event Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM EventTypes");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['EventName'] . "</option>";
                                    }
                                    ?>
                       </select><br>
                      
<!--                       <input class="form-control mt-3" type="hidden" name="DraftType" id="Etype" >   -->
                       
                       </div>
                  <button class="btn-sm btn text-white" name="delEvent">Delete Event</button>
                   <label > <strong class="ml-4 mt-1 alertTxt" > </strong></label> 
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
<div class="modal fade" id="viewDataModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Event View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="dyeventinfo">
              
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="viewedit()" id="editviewbtm">Edit</button>
           <button type="button" class="btn btn-secondary" onclick="viewdel()" id="editviewbtm">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
          <?php include "Calendar/Modals.php";?>
          
          
      </div>
      <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>     
      <script>
          
         $('#AddEvent').on('shown.bs.modal', function() {
             $('.datepickers'),datepicker({
                 format:"dd/mm/yyyy",
             autoclose:true,
             todayHighlight: true,
             container: "#AddEvent modal-body" 
             });
             
             
});
 //$(".colorpicker").colorpicker();
                 $('#DType').on("change",function(){
                     var value = $("#DType option:selected");
//                alert(value.text());                    
                
        var eventtext = value.text();
                  if(eventtext == "Hearing"){
//                      alert(eventtext);
   $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {dydatas:1,eventType:eventtext},
    success:function(res){
        console.log(res);
        
        $('.dyfileds').html(res);
         $('#dydetails').removeClass('d-none');
          $('select').select2();
          
          $("#ClientId").on("change",function(){
     var category= $("#ClientId").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"Calendar/function.php",
        type:"POST",
        cache:false,
        data:{clientdids:cid},
        success:function(data){
            console.log(data);
            $("#CaseId").html(data);
            
             $("#CaseId").on("change",function(){
           var selected = $(this).find('option:selected');
       var extra = selected.data('foo'); 
    // alert(extra);
    $("#CourtId").val(extra).change();
    });
          
        }
      });
 });
 
 
          
    }
    });
                      
                  }else{
                     $('#dydetails').addClass('d-none');
                      console.log(eventtext);
                  } 

//                    

 

                  
                     
                 });
          </script>
     <script>
            //AddEventTypeajax / DelEventTypeajax /EditEventTypeajax
             var source = "Calendar/load.php";
            $("#AddEventTypeajax").on("submit",function(e){
         e.preventDefault();
         //alert("updating by ajax");
          var formData= new FormData(this);
                  $.ajax({
                      url:'Calendar/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
//                     beforeSend: function () {
//          $('.alertTxt').html("<strong style='color:#ff7f50;'>Adding..</strong>");
//        },
                     success : function(res){
                           console.log(res);
                           $('#DType').html(res);
      $('#DelType').html(res);
      $('#EType').html(res);
      $("#AddEventTypeajax").trigger('reset');
//       $('.alertTxt').html("<strong style='color:green;'>Added Successfully..</strong>");
       
                   $('.calendar').fullCalendar( 'removeEventSource', source );
$('.calendar').fullCalendar( 'addEventSource', source );
      $('#AddEvent').modal('toggle');
                     }
                 });
                 });
                 
                  $("#DelEventTypeajax").on("submit",function(e){
         e.preventDefault();
         var formData= new FormData(this);
                  $.ajax({
                      url:'Calendar/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
//                     beforeSend: function () {
//          $('.alertTxt').html("<strong style='color:#ff7f50;'>Adding..</strong>");
//        },
                     success : function(res){
                           console.log(res);
       $('#DType').html(res);
      $('#DelType').html(res);
      $('#EType').html(res);
      
//       $('.alertTxt').html("<strong style='color:green;'>Added Successfully..</strong>");
                   $('.calendar').fullCalendar( 'removeEventSource', source );
$('.calendar').fullCalendar( 'addEventSource', source );
      $('#DelEvent').modal('toggle');
                     }
                 });
         
    });
    
    
    
     $("#EditEventTypeajax").on("submit",function(e){
         e.preventDefault();
          var formData= new FormData(this);
                  $.ajax({
                      url:'Calendar/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                     success : function(res){
                           console.log(res);
                      
       $('#DType').html(res);
      $('#DelType').html(res);
      $('#EType').html(res);
      $('select').change(function(){
    $('select').prop('selectedIndex',0);
       $("#EditEventTypeajax").trigger('reset');
});
                   $('.calendar').fullCalendar( 'removeEventSource', source );
$('.calendar').fullCalendar( 'addEventSource', source );
      $('#EditEvent').modal('toggle');
                     }
                 });
         
    });
                
                
            
                
                
                
                
            </script>     
          
          
      <script>
           $("#DType").on("change", function () {
               var etypeid= $("#DType").val();
             $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {Eventtypeid:etypeid},
    success:function(res){
//        alert(res);
$('.dytimes').html(res);

var dyst= $('#dysartttime').val();
var dyet= $('#dyendtime').val();
$('#startTime').val(dyst);
$('#endTime').val(dyet);
    }
  });
               
           });
          
          
             $("#startDate").on("change", function () {
                var stdate=  $('#startDate').val();
                //alert(stdate);
                $('#endDate').val(stdate);
             });
          
          
          
          
     
         
          


//           $(function () {
//  $('[data-toggle="tooltip"]').tooltip();
//});
          //  $('#EventsList').DataTable({
$('#EventsLists').DataTable({
//        "pagingType":"full_numbers",
        "bFilter": true,
        "bInfo": true,
        "sort":false,
        "lengthMenu":[
            [15,25,50,-1],
            [15,25,50,"All"]
        ],
        responsive:true,
        language:{
          //"search": "_INPUT_",
           searchPlaceholder:"Search Event",
    
        }
    });
    
    

    
          </script>
<script type="text/javascript">
     $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy',});
    
    
//   $(".colorpicker").colorpicker();
//  $(function () {
//    $('.datetimepicker').datepicker({
//      controlType: 'select',
//        changeMonth: true,
//        changeYear: true,
//        dateFormat: "dd-mm-yy",
//        timeFormat: 'HH:mm:ss',
//        yearRange: "1900:+10",
//        showOn:'focus',
//        firstDay: 1
//    });
//  });
 </script>
   
    
    <script>
      $('select').select2();
        $('#mybottomnav').hide();
        $('#CM').removeClass('active');
        $('#cl').addClass('active');
        
        
        
//$('body').on('click', '.datetimepicker', function() {
//    $(this).not('.hasDateTimePicker').datetimepicker({
//        controlType: 'select',
//        changeMonth: true,
//        changeYear: true,
//        dateFormat: "dd-mm-yy",
//        timeFormat: 'HH:mm:ss',
//        yearRange: "1900:+10",
//        showOn:'focus',
//        firstDay: 1
//    }).focus();
//});
        
        var Month = 0 ;
        var count = 1;
        var checker = 1;
        var show = 0;
        $(document).ready(function() {
         
            var calendar = $('.calendar').fullCalendar({
                 timeZone: 'Asia/Calcutta',
                 themeSystem: 'bootstrap',
                 editable:false,
                 
//                 events_source: 'Calendar/load.php',
//    header:{
//     left:'prev,next today',
//     center:'title',
//     right:'year,month,agendaWeek,agendaDay'
//    },



    selectable:true,
    selectHelper:true,
  
    select:function(start,end,allDay){
       $('#AddEvents').modal('toggle');
//       var edate = $.fullCalendar.formatDate(start,'Y-MM-DD');
//        var sdate = $.fullCalendar.formatDate(start,'Y-MM-DD');
         var edate = $.fullCalendar.formatDate(start,'DD-MM-Y');
        var sdate = $.fullCalendar.formatDate(start,'DD-MM-Y');
       //alert(sdate);
       $('#endDate').val(edate);
       $('#startDate').val(sdate);
//       console.log(sdate);
//       console.log(start);
//       console.log(allDay);
//       console.log(end);
    },
  
//eventSources:[{
//    events:'Calendar/load.php',     
//}],


   eventRender: function(event, element) {
                 //$(element).tooltip({title: event.loc ,placement:'bottom' });  
                 $(element).tooltip({title: event.title,container: "body"});                   
            },	



events:'Calendar/load.php',

eventClick: function(event) {
     console.log(event);
        if (event.title) {
            
               viewdatainfo(event.id);
      // alert(event.title);
//        return false;
    }
    },
    
//    function getMonth(){
//  var date = $(".calendar").fullCalendar('getDate');
//  var month_int = date.getMonth();
//  //you now have the visible month as an integer from 0-11
//},
    
//    document.getElementById('my-button').addEventListener('click', function() {
//  var date = calendar.getDate();
//  alert("The current date of the calendar is " + date.toISOString());
//}),
   
//   eventClick: function(info) {
//    info.jsEvent.preventDefault(); // don't let the browser navigate
//
//    if (info.event.url) {
//     alert(hello);
//    }
//  },  


//
//eventSources: [
//                    {
//                        events: [
//                            {
//                                title: 'Testing 1',
//                                start: '2021-07-13',
//                                end: '2021-07-16',
////                                allDay: false,
//                                color: 'green',
//                              textColor: 'white',
//                                backgroundColor: 'green'
//                            },
//                            {
//                                title: 'Testing',
//                                start: '2021-07-10',
//                                color: '#ff7538',
//                                textColor: 'white',
//                                backgroundColor: '#ff7538'
//                            }
//                        ],
//                    }
//                ],




 header: {
                    right: 'month,agendaWeek,timelineCustom,agendaDay,prev,today,next',
                    left: 'title',
                },
                  //events:'Calendar/load.php',
                fixedWeekCount: false,
                contentHeight: 650,
                views: {
                    timelineCustom: {
                        type: 'timeline',
                        buttonText: 'Year',
                        dateIncrement: { years: 1 },
                        slotDuration: { months: 1 },
                        visibleRange: function (currentDate) {
                            return {
                                start: currentDate.clone().startOf('year'),
                                end: currentDate.clone().endOf("year")
                            };
                        }
                    }
                },
   
               
                
//                dayRender: function( date, cell ) {
                                dayRender:  function month() {
                                    
                     //var nextMonth = $('.calendar').fullCalendar('getView');
                     
//  console.log(nextMonth);
  
                   var date= $(".calendar").fullCalendar('getDate').month();
//     var date = $(".calendar").fullCalendar('getDate');
//  var month_int = date.getMonth;

date++;
  console.log(date);
  console.log(count);
  
 
 
 if(checker != date){
     count = 1;
 }
 
 checker = date;
  
  
     
    Month = $('.calendar').fullCalendar('getView');
    //alert(Month.title);
  console.log(Month.title);
  $('#titleofmonth').text("All Events of : "+Month.title);
  
  Month= date;
  
   console.log(count);
  if(date != ''){
  $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {month:date},
    success:function(res){
       // console.log(res);
        $('#dytable').html(res);
 
     function showtooltip(){
        
 $(  function () {
     show = 1;
  // $('[data-toggle="tooltip"]').tooltip();
  //console.log("READY TOOLTIP");
}); 
}
if(show == 0){
   setInterval(function(){
showtooltip();
},5000); 
}


        
         $('#EventsList').DataTable({
//        "pagingType":"full_numbers",
//        "bFilter": true,
        //    "bInfo": true,
//            "lengthMenu": [
//                [15, 25, 50, -1],
//                [15, 25, 50, "All"]
//            ],
//            "responsive": true,
//            language: {
//                //"search": "_INPUT_",
//                searchPlaceholder: "Search Document"
//            }
        "bFilter": true,
        "bInfo": true,
       // "bSort":false,
//        "bSortable":false,
        "paging":   true,
        "responsive": true,
        "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
        "ordering": true,
         language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Events\n\
                "
            },
//        "info":    false ,
     
      
    });
        
        
//  
 },
   })
       }else{
           console.log('soon');
       }
        count++;
 },

//                 $('.fc-prev-button').click(function(e){
//                               console.log(e);
//                               alert('month change');
//                           }),
//                          
 

            });
            // console.log(datacal);
             console.log(calendar);
        });
        function editevents(sr){
       // alert(sr);
       var monthnum = Month;
       console.log(monthnum);
    $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {Eids:sr},
    success:function(res){
        $("#dycontents").html(res);
          $('select').select2();
     
        
         $("#ClientId").on("change",function(){
     var category= $("#ClientId").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"Calendar/function.php",
//url: "UploadCase/CaseNameDy.php",
        type:"POST",
        cache:false,
        data:{clientdids:cid},  
         //  data:{countryId:cid},
        success:function(data){
         //console.log(data);
            $("#CaseId").html(data);
          
        }
      });
 });
 
        
        
        
        
        $('#EditEType').on("change",function(){
     //         alert("hearing slected");
               var value = $("#EditEType option:selected");
//                alert(value.text());                    
                
        var eventtext = value.text();
                  if(eventtext == "Hearing"){
                    //  alert(eventtext);
   $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {dydatas:1,eventType:eventtext},
    success:function(res){
        //console.log(res);
        
        $('.Dydatess').html(res);
        
         $('#dydetails').removeClass('d-none');
          $('select').select2();
          
          $("#ClientId").on("change",function(){
     var category= $("#ClientId").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"Calendar/function.php",
//url: "UploadCase/CaseNameDy.php",
        type:"POST",
        cache:false,
        data:{clientdids:cid},  
         //  data:{countryId:cid},
        success:function(data){
         //console.log(data);
            $("#CaseId").html(data);
          
        }
      });
 });
 
 
          
    }
    });
                      
                  }else{
                     $('#dydetails').addClass('d-none');
                      console.log(eventtext);
                  } 

          });
        
        
        
        
        //submit updated form here

$("#UpdateEvents").on("submit",function(e){
         e.preventDefault();
         //alert("updating by ajax");
          var formData= new FormData(this);
                  $.ajax({
                      url:'Calendar/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                    // beforeSend: function () {
//                           $('#uploaddraft').modal('toggle');
//          $('.alertTxt').html("<strong style='color:#ff7f50;'>Upload Final Draft..</strong>");
//        },
                
                     success : function(data){
                         console.log("+++++++++++++++++");
                   console.log(data);
                   
                   console.log("+++++++++++++++++");
                   var source = "Calendar/load.php";
                   $('.calendar').fullCalendar( 'removeEventSource', source )
$('.calendar').fullCalendar( 'addEventSource', source );
//$('.calendar').fullCalendar ('removeEvents',source);
$('#EditEvents').modal('toggle');
//var date = 8;
 $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {month:monthnum},
    success:function(res){
       // console.log(res);
        $('#dytable').html(res);
        
         $('#EventsList').DataTable({
//        "pagingType":"full_numbers",
        "bFilter": false,
        "bInfo": false,
       // "bSort":false,
//        "bSortable":false,
        "paging":   false,
//        "ordering": false,
//        "info":    false ,
     
      
    });
    }
    });
    }
                  });
                         
         
     });
        
    }
    });
    }
    
    
    
    
        /// Add Event with ajax-<
                
                
                $("#addevents").on("submit",function(e){
         e.preventDefault();
         //alert('working on Ajax please');
        // addeventbtn
         $('#addeventbtn').prop('disabled',true);
              var formData= new FormData(this);
               $.ajax({
                      url:'Calendar/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                     success : function(res){
                           console.log(res);
                           
                                      var source = "Calendar/load.php";
                   $('.calendar').fullCalendar( 'removeEventSource', source )
$('.calendar').fullCalendar( 'addEventSource', source );
//$('.calendar').fullCalendar ('removeEvents',source);
$('#AddEvents').modal('toggle');
 $("#addevents").trigger('reset');
$('#addeventbtn').prop('disabled',false);
//var date = 8;
 var monthnum = Month;
 $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {month:monthnum},
    success:function(res){
       // console.log(res);
        $('#dytable').html(res);
        
 $('#EventsList').DataTable({
        "bFilter": true,
        "bInfo": true,
       // "bSort":false,
//        "bSortable":false,
        "paging":   true,
        "responsive": true,
        "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
        "ordering": true,
         language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Event"
            },
     
      
    });
    }
    });
                       }
                   });
              
        
     });
    
        </script>
        
        
         <script>
            $("#EType").on("change", function () {
             var etypeid = $('#EType').val();
             $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {Eventid:etypeid},
    success:function(res){
//        alert(res);
$('.dycontent').html(res);
    }
  });
  
  $('.fc-prev-button').click(function() {
  var moment = $('.calendar').fullCalendar('getDate');
  alert("The current date of the calendar is " + moment.format());
});
             
             
              
                           });
                          
                          const viewinfo = viewdatainfo = (sr)=>{
                              //alert(sr);dyeventinfo
                              console.log(sr);
                              $("#viewDataModal").modal('show');
                              $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {vieweventid:sr},
    success:function(res){
//        alert(res);
$('.dyeventinfo').html(res);


    }
  });
                              
                              
                              
                          };
                          
                          function viewedit(){
    var id = $('#srnos').val();
    editevents(id);
    //alert(id);
    $('#EditEvents').modal('show');
     $("#viewDataModal").modal('hide');
    
}
const dels= viewdel = ()=>{
     var id = $('#srnos').val();
    delEvent(id);
    //alert(id);
     $("#viewDataModal").modal('hide');
}
                          
                           const del = delEvent = (sr)=>{
                               //alert(sr);
                               
                               
                               
                               swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this Event!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      var monthnumber = Month;
       $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {Deleventid:sr},
    success:function(res){
//        alert(res);
console.log(res);

 $.ajax({
    type:'post',
    url:'Calendar/function.php',
    data: {month:monthnumber},
    success:function(res){
        console.log(res);
        $('#dytable').html(res);
         var source = "Calendar/load.php";
                   $('.calendar').fullCalendar( 'removeEventSource', source )
$('.calendar').fullCalendar( 'addEventSource', source );

 $('#EventsList').DataTable({
        "bFilter": true,
        "bInfo": true,
       // "bSort":false,
//        "bSortable":false,
        "paging":   true,
        "responsive": true,
        "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
        "ordering": true,
         language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Event"
            },
     
      
    });

    }
    });
swal("Event Deleted Successfully", {
      icon: "success",
    });
    }
  });
  
    
  } else {
//    swal("Your imaginary file is safe!");
  }
});
                            
                           }
                     
                           
                           function dytable(month){
                             var  monthnumber= month;
                                $.ajax({
    type:'POST',
    url:'Calendar/function.php',
    data: {month:monthnumber},
    success:function(res){
        console.log(res);
        $('#dytable').html(res);
        
    }
    });
                           }
                           
                           </script>
                           
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>                       
                  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            var activeon = 'Calendar';
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
                
        
        <script>
             document.getElementById("addT").addEventListener("click", ADDCourt);
            function ADDCourt() {
                var tname = document.getElementById("Tname").value;
                console.log(tname);
                var Tname = JSON.stringify(tname);
//var AddCourt= JSON.stringify('AddCourt');
                $.ajax({
                    type: "POST",
                    url: "CaseDb/FunctionsCourt.php",
                    data: {name: Tname},
                    success: function (res) {
                        console.log(res);
                        $('#CourtId').html(res);
                        $('#DeleteT').html(res);
                        $('#editTC').html(res);
                        $('#AddCourt').modal('toggle');
                        //location.reload();
                    }

                });

            };
            
            document.getElementById("EditT").addEventListener("click", editT);
            function editT() {
                var Cid = document.getElementById('editTC').value;
                var Rename = document.getElementById('RenameT').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                     url: "CaseDb/FunctionsCourt.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                      $('#CourtId').html(res);
                        $('#DeleteT').html(res);
                        $('#editTC').html(res);
                        $('#EditCourt').modal('toggle');
                    }

                });
            };
            
            document.getElementById("DelT").addEventListener("click", DelT);
            function DelT() {
                var Cid = document.getElementById('DeleteT').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "CaseDb/FunctionsCourt.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                         $('#CourtId').html(res);
                        $('#DeleteT').html(res);
                        $('#editTC').html(res);
                        $('#DeleteCourt').modal('toggle');
                    }

                });
            }
            

            
            
            </script>

  </body>
</html>