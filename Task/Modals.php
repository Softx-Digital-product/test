
<?php
//include '../UploadCase/Dp.php';
date_default_timezone_set('Asia/Kolkata');
$dates= date('d-m-Y');
?>
          
<div class="Modals">
    
 
          <!-- Modal -->
<div class="modal fade" id="CreateTask" " aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid" id="dycreate">
              <form id="DyAddTask">
                  <div class="row">
                      <div class="col-lg-6 col-sm-12">
                              <div class="form-group">
    <label for="TaskName" class="font-weight-bold">Task Name</label>
    <input type="text" class="form-control" placeholder="Enter Task Name " name="TaskName" id="TaskName" required>
  </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                               <div class="form-group  ">
                                 <label class="font-weight-bolder" for="StatusId">Select Status</label>
<!--                                   <a class="ml-1" data-toggle="modal" data-target="#AddStatus">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditStatus">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteStatus">
                                                    (Delete)
                                                </a>-->
                                <select class="CN form-control" name="StatusId" id="StatusId" style="width:100%;"onchange="document.getElementById('Text_StatusN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose  Status</option>
                                    <option value="0">Backlog</option>
                                    <option value="1">In-Process</option>
                                    <option value="2">Review</option>
                                    <option value="3">Approved</option>
                                    <option value="4">Paper-Book</option>
                                    <option value="5">Delivered</option>
                                    <?php
//                                    $sql = mysqli_query($con, "SELECT * FROM DStatus");
//                                    while ($row = $sql->fetch_assoc()) {
//                                       // echo "<option value=" . $row['Sr_no'] . ">" . $row['DStatus'] . "</option>";
//                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="Text_StatusN" value="" />
                            </div>
                      </div>
                      
                  </div>
   
                  <div class="row">
                      <div class="col-lg-6 col-sm-12">
                            <div class="form-group  ">
                                 <label class="font-weight-bolder" for="ClientId">Select Client Name</label>
                                <select class="CN form-control" name="ClientId" id="ClientId" style="width:100%;"onchange="document.getElementById('Text_ClientN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="Text_ClientN" value="" />
                            </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                           <div class="form-group mt-1 mb-1">
                                <label class="font-weight-bolder" for="CaseId">Select Case Name</label>
                                 <select class="form-control CN" name="CaseId"  style="width:100%;" id="CaseId" onchange="document.getElementById('Text_CaseN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="Text_CaseN" id="Text_CaseN" value="" />
                            </div>
                      </div>
                  </div>
                  
                  <div class="row">
                      <div class="col-lg-6 col-sm-12">
                            <div class="form-group  ">
                                 <label class="font-weight-bolder" for="TaskTypeId">Select Task Type</label>
                                 <a class="ml-1" data-toggle="modal" data-target="#AddTaskType">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditTaskType">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteTaskType">
                                                    (Delete)
                                                </a>
                                <select class="CN form-control" id="TaskTypeId" name="TaskId" style="width:100%;"onchange="document.getElementById('Text_TaksType').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Task Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Task_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Task_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="Text_TaksType" value="" />
                            </div> 
                      </div>
                      <div class="col-lg-6 col-sm-12">
                          <div class="form-group  ">
                                 <label class="font-weight-bolder" for="TeamId">Assign To Team Member</label>
                                <select class="CN form-control"  name="TeamId" id="TeamId" style="width:100%;"onchange="document.getElementById('Text_TeamN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Task Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM TeamMembers WHERE Status = 'Active'");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Name'] .' '.$row['Surname']. "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" id="Text_TeamN" value="" />
                            </div> 
                      </div>
                  </div>
                  <div class="Drafttype d-none" id="dyDrafttype">
                     <div class="form-group  ">
                                 <label class="font-weight-bolder" for="DraftTypeId">Select Draft Type</label>
                                   <a class="ml-1" data-toggle="modal" data-target="#AddDraftType">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDraftType">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteDraftType">
                                                    (Delete)
                                                </a>
                                <select class="CN form-control"  name="DraftTypeId" id="DrafTypeId" style="width:100%;"onchange="document.getElementById('Text_DraftTypeN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Draft Type</option>
                                    <?php
                                  $sql = mysqli_query($con, "SELECT * FROM DraftTypes");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DName'] . "</option>";
                                    }

                                  ?>
                                </select>
                                <input type="hidden" name="Text_DraftTypeN"  id="Text_DraftTypeN" value="" />
                            </div> 
                  </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
    <label for="TaskName" class="font-weight-bold">Start Date</label>
    <input type="text" class="form-control datepicker" id="Sdate" name="Sdate" value="<?php echo $dates; ?>">
                            </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
    <label for="TaskName" class="font-weight-bold">End Date</label>
    <input type="text" class="form-control datepicker" id="Edate" name="Edate" value="<?php echo $dates; ?>">
                            </div>
                      </div>
                  </div>
                  <div class="form-group">
    <label for="TaskName" class="font-weight-bold">Task Description</label>
    <textarea class="form-control" rows="4" placeholder="Enter Task Description" id="TaskDesc" name="TaskDesc"></textarea>
  </div>
                  <button class="btn-sm btn text-white">Submit</button>
              </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
          
          
          
          
          <!-- Add Task Type -->
          <div class="modal fade" id="AddTaskType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Task Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="AddTaskTypeData">
               <div class="form-group">
    <label for="Taskname" class="font-weight-bold">Task Name</label>
    <input type="text" class="form-control" name="taskName" id="TaskName" placeholder="Enter Task Name">
  </div>
              <div class="form-group">
    <label for="Taskname" class="font-weight-bold">Task Color</label>
    <input type="color" class="form-control" name="taskColor" id="TaskColor" placeholder="" value="#FFA500">
  </div>
              <button id="AddTaskType" class="btn btn-sm text-White">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
             <label id="addmsg"></label>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      
          <!--Edit Task Type-->
          <div class="modal fade" id="EditTaskType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Task Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="EditTaskTypeData">
                  <label for="EditTaskId" class="font-weight-bold" >Select Task To Edit</label>
              <select class="CN form-control" name="editTaskTypeId" id="EditTaskId" style="width:100%;">
                                    <option value=""disabled selected>Please Choose Task Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Task_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Task_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
              <div class="dyeditoption">
                  
              </div>
          </form>
      </div>
      <div class="modal-footer">
             <label id="editmsg" class="float-left"></label>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
          
          <!--Delete Task Type-->
          
          <div class="modal fade" id="DeleteTaskType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Task Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="DeleteTaskTypeData">
             <label for="DeleteTaskId" class="font-weight-bold" >Select Task To Delete</label>
              <select class="CN form-control"  name="deltaskId" id="DeleteTaskId" style="width:100%;">
                                    <option value=""disabled selected>Please Choose Task Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Task_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Task_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
             <button class="btn btn-sm text-white mt-3">Delete Task Type</button>
          </form>
      </div>
      <div class="modal-footer">
          <label id="delmsg" class="float-left"></label>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="ViewTaskData" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
<!--        <h5 class="modal-title" id="exampleModalLabel">View Task Details</h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="dyview">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ViewTasks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="dyviewTasks">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="EditTasks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="dyeditTask">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>








<script>
    
    
    $("#TaskTypeId").on("change", function () {
             
                     var value = $("#TaskTypeId option:selected");
//                alert(value.text());                    
                
        var eventtext = value.text();
                  if(eventtext == "Drafting"){
                            $("#dyDrafttype").removeClass('d-none')

                        }else{
                            $("#dyDrafttype").addClass('d-none')
                        }
                    });
    $("select").select2();
    
     $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy'});
           let date;
           $('#Sdate').on("change",function(){
             date=  $("#Sdate").val();
               $('#Edate').val(date);
               
           });
    
     function Edittask(sr){
         
          $.ajax({
                    url:'Task/function.php',
                     type:"POST",
                     data:{EditTasks:sr},
                    beforeSend: function () {
          $('.dyeditTask').html("<strong class='text-center' style='color:#ff7f50;'>Loading..</strong>");
        },
                     success : function(res){
                         $('.dyeditTask').html(res);
                         $('select').select2();
                          $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy'});
                            $("#EClientId").on("change", function () {
                    var clientId = $("#EClientId").val();
                        $.ajax({
//                        url: "UploadCase/CaseNameDy.php",
                            url:"Calendar/function.php",
                        type: "POST",
                        cache: false,
                       // data: {countryId: cid},
                        data: {clientdids: clientId},
                        success: function (data) {
                            console.log(data);
                            $("#ECaseId").html(data);

                        }
                    });
                    
    });
         $('#DyEditTaskData').on("submit",function(e){
     e.preventDefault();
          var formData= new FormData(this);
               $.ajax({
                      url:'Task/function.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                      success : function(res){
                          //console.log(res);
                          $("#DyEditTaskDate").trigger('reset');
                          $('#EditTasks').modal('toggle');
                           dytables();
                     }
             
             });
    });
    
    
    
    
    
    
                     } //1 ajax success ending
  });// calling ajax ending
  
  }// Edit task function ending
    
    $('#DeleteTaskTypeData').on("submit",function(e){
     e.preventDefault();
     var DeleteId= $('#DeleteTaskId').val();
     //alert(DeleteId);
      $.ajax({
                    url:'Task/function.php',
                     type:"POST",
                     data:{deleteTT:DeleteId},
                    beforeSend: function () {
          $('#delmsg').html("<strong style='color:#ff7f50;'>Deleting...</strong>");
        },
                     success : function(res){
                            $('#delmsg').html("<strong style='color:#green;'>Delete Successfully...</strong>");
                           $('#TaskTypeId').html(res);
                           $('#EditTaskId').html(res);
                           $('#DeleteTaskId').html(res);
                           $('#DeleteTaskType').modal('toggle');
                           $('#delmsg').html("");
                            $("#DeleteTaskTypeData").trigger('reset');
                           
                        
                        }
                 });
 });
 

          
          
       
        
    
    </script>