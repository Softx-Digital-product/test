<?php
include 'Database/Dp.php';
date_default_timezone_set('Asia/Kolkata');
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
        <link rel="stylesheet" href="assets12/css/sam.css">
          <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
   <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
        <style>
            .swal-wide{
    width:550px !important;
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
        </style>
 
   
    <title>View Case Hearing</title>

        
  </head>
  <body>

      <?php include'Navbars.php';?>
      <div class="topnav1 p-0 ">
          <a class="nav_link  p-2 " href="calendar.php">View Calendar</a>
              <a class="nav_link ml-1 text-white p-2 active" href="#" >View Case Hearing</a>
      </div>
      <div class="continer-fulid vc ">
                
                <div class="row">
                  
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-2 ">
                         <div class="form-group mt-1 mb-1">

                                <select class="CN" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('txt_Client').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Client Name</option>-->
                                    <option value=""disabled selected>Choose Client Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }                           
                                    ?>
                                </select>
                                <input type="hidden" name="ClientName" id="txt_Client" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
                      
                        
                        
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ">
                        
                        
                            <div class="form-group mt-1 mb-1">
                                <!--                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>-->
                                <select class="CN "  style="width:100%;" id="CaseN" placeholder="Please Select Client Name"onchange="document.getElementById('txt_CaseN').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Case Name</option>-->
                                    <option value=""disabled selected>Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="CaseN" id="txt_CaseN" value="null" />
                            </div>
                        
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 ">
                        <div class="">
                            <strong class="dylabel text-white"></strong>
<!--                            <button class="btn btn-primary "  data-toggle="modal" data-target="#AddOrder" >Test</button>-->
                        </div>
                     
                    </div>
            </div>
        </div>


      
      
      <div class="container-fluid" id="dydata">
          <div class="row d-none">
              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 p-0 bg-success text-white">
         <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive "id="dytable">
                               <table class="table table-striped table-bordered table-hover " id='OrderList'>
                                    <thead class="cc text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">Date</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Type" scope="col">Court Name</th> 
                                                 <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title" scope="col">Title</th> 
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title" scope="col">Order Detail</th>  
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title" scope="col">View</th> 
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit Event" scope="col">Edit</th> 
                                                           <th class="text-center" data-toggle="tooltip" data-placement="top" title="Remove Event" scope="col">Del</th> 
                                        </tr>
                                    </thead>
                                    <tbody id='dybody'>
                                    </tbody>
                               </table>
             
         </div>
                  
              </div>
               <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 p-0 bg-primary text-white">
                  viewer
               </div>
          </div>
      </div>                
                
               <div class="modals">
                   <!-- upload  Modal -->
<div class="modal fade" id="AddOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Upload Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
              <form id="Addorders">
                  <input type="hidden" name="addupload" id="addupload" value="1">
                  <input type="hidden" name="Eventid" id="eventid" value="0">
                   <input type="hidden" name="EventExtraid" id="eventextraid" value="0">
                    <div class="form-group">
    <label for="ATitle" class="font-weight-bold">Enter Title</label>
    <input type="text" class="form-control" name="ATitle" id="ATitle"placeholder="Enter title here" required>
    
  </div>
                        <div class="form-group">
    <label for="ADesc" class="font-weight-bold">Enter Description</label>
    <textarea class="form-control" name="ADesc" id="ADesc"  placeholder="Enter Description here.." required > </textarea>

  </div>
            <div class="form-group">
    <label for="AUpload" class="font-weight-bold">Upload Order pdf</label>
    <input type="file" class="form-control" name="file" id="AFile" required>
    

  </div>       
                  <button class="btn btn-sm text-white"> Upload Order</button>
                  <label id="msgadd"></label>
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
<div class="modal fade" id="EditOrder"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid" id="dyedit">
              
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
              $('select').select2();
        $('#mybottomnav').hide();
        $('#CM').removeClass('active');
        $('#cl').addClass('active');
          
          $('#OrderList').DataTable({
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
                searchPlaceholder: "Search Order"
            },
     
      
    });
    
    
    const editor = editorder = (eesr) =>{
        //alert(eesr);
          $.ajax({
                      url:'Calendar/funsviewcasehearing.php',
                     type:"POST",
                     data:{editids:eesr},
                     success : function(res){
                        $("#dyedit").html(res);
                        
                        
                        
          $("#dyeditform").on("submit",function(e){
         e.preventDefault();
         console.log("Editing data:::");
         var formData= new FormData(this);
                  $.ajax({
                      url:'Calendar/funsviewcasehearing.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                    beforeSend: function (e){
                        console.log(e);
  $('#msgedit').html("<strong class='text-warning ml-2'>Uploading...</strong>");
        },
                     success : function(res){
                           console.log(res);
             //  $('#msgedit').html("<strong class='text-success ml-2'>updated Successfully...</strong>"); 
      $("#dyeditform").trigger('reset');
      var category = $("#CaseN").val();
           dytables(category);
      
      },
      });//edit submit ajax
                        
                        
                     });//edit submti function
                     }
                 });//featch the data ajax end;
        
    }
    
    
  function dysr(csr,eesr,esr){
        $('#addupload').val(csr);
        $('#eventextraid').val(eesr);
        $('#eventid').val(esr);
        console.log(csr);
        console.log(eesr);
        console.log(esr);
  }
//    const dysrno =  dysr =( sr)=>{
//        $('#addupload').val(sr);
//        console.log(sr);
//    }
            
  //  Addorders
  
  
          $("#Addorders").on("submit",function(e){
         e.preventDefault();
         
         var formData= new FormData(this);
                  $.ajax({
                      url:'Calendar/funsviewcasehearing.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                    beforeSend: function (e){
                        console.log(e);
  $('#msgadd').html("<strong class='text-warning ml-2'>Uploading...</strong>");
        },
                     success : function(res){
                           console.log(res);
               $('#msgadd').html("<strong class='text-success ml-2'>Added Successfully...</strong>"); 
      $("#Addorders").trigger('reset');
        $('#msgadd').html(""); 
      $('#AddOrder').modal('toggle');
        var category = $("#CaseN").val();
           dytables(category);
  }
          });
          
          });
    
    
          
          $("#ClientN").on("change", function () {
                    var category = $("#ClientN").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
//                        url: "UploadCase/CaseNameDy.php",
                            url:"Calendar/function.php",
                        type: "POST",
                        cache: false,
                       // data: {countryId: cid},
                        data: {clientdids: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CaseN").html(data);

                        }
                    });
                });
                $("#CaseN").on("change", function () {
                    var category = $("#CaseN").val();
//                     var value = $("#CaseN option:selected");
                    var  value= $('#CaseN :selected').text();
//                    console.log(value);
                    var caseName= $('#txt_CaseN').val();
                    
                    var clientName= $('#txt_Client').val();
                    console.log(caseName);
                    
                   
                    $('.dylabel').text("Showing Dates For "+clientName+", Case Name : "+value);
                   // console.log(category);
                    
                   // var cid = JSON.stringify(category);
                   
                    dytables(category);
                    
                    
                    
                });
                
                
                function dytables(name){
                    
                      $.ajax({
                        url: "Calendar/funsviewcasehearing.php",
                        type: "POST",
                        cache: false,
                        data: {dyorder: name},
                        success: function (data) {
                                    //  console.log(data);
                            $("#dydata").html(data);
                             $('#OrderList').DataTable({
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
                searchPlaceholder: "Search Order"
            }
    });

                        }
                    });
                }
     
     
     
    const viewpdfs = viewpdf = (eesr) =>{
        
   //   alert("id = "+eesr + " pdf Viewer is under process" );
        
     //  viewpdfdata(eesr);
    $.ajax({
                        url: "Calendar/funsviewcasehearing.php",
                        type: "POST",
                        cache: false,
                        data: {viewpdfs: eesr},
                        success: function (data) {
                            console.log(data);
                            $('#dypdf').html(data);
                        }
                    });
           
        
    };
    
    
    const deleteorder= delorder= (eeid) =>{
      //  alert(eeid);
      
      swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this Hearing  data!",
  icon: "warning",
  html:true,
  buttons: true,
  dangerMode: true,
  customClass: 'swal-wide',
})
.then((willDelete) => {
  if (willDelete) {
         $.ajax({
                        url: "Calendar/funsviewcasehearing.php",
                        type: "POST",
                        cache: false,
                        data: {deleteorderid: eeid},
                        success: function (data) {
                            console.log(data);
                                var category = $("#CaseN").val();
           dytables(category);
                              swal("Deleted Successfully !!!", {
      icon: "success",
      customClass: 'swal-wide',
    });
                        }
                        });
  
  } else {
    //swal("Your imaginary file is safe!");
  }
});
    }
    </script>
    <script>
    
    
    
    
    
       
        </script>
  
   
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>                       
                  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
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
            var activeon = 'Case Hearing';
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
                
        
 

  </body>
</html>