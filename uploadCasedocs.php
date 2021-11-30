
<?php 
   
include 'UploadCase/Dp.php';

if(isset($_POST['submit'])){
  
    $clientName=$_POST['ClientName'];
    $caseName=$_POST['CaseN'];
    
  //  echo $clientName;
    
    
if(isset($_FILES['file'])){
//     echo "<pre>";
//     print_r($_FILES);
//     echo "</pre>";
    $file_dir ="ClientCaseData/$clientName/$caseName/";
    
    //  $file_name = $_FILES['file']['name'];
    //  $file_size = $_FILES['file']['size'];
    //  $file_tmp = $_FILES['file']['tmp_name'];
    //  $file_type = $_FILES['file']['type'];


     foreach($_FILES['file']['name']as $key=>$val){
      $fileName = basename($_FILES['file']['name'][$key]); 
      $fileSize= basename($_FILES['file']['size'][$key]);
      $targetFilePath = $file_dir . $fileName; 
      if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){
       // echo "file Uploaded Successfully Bro";
        $check=mysqli_num_rows(mysqli_query($con,"SELECT * from UploadDocs WHERE Pdf_Name='$fileName'"));
        if($check>0){
          $msgs="<br> Pdf is already present";
        // echo $msgs;
      }
      else{
        
          
          if($fileSize >= 1073741824){
                  $fileSize = number_format($fileSize / 1073741824, 2).' GB';
          }
          elseif ($fileSize >= 1048576) {
          $fileSize = number_format($fileSize / 1048576, 2).' MB';
         
      }
      elseif($fileSize >= 1024){
           $fileSize = number_format($fileSize / 1024, 2).' KB';
      }
       elseif($fileSize >= 1){
           $fileSize = $fileSize.'byte';
      }else{
          $fileSize= '0 byte';
      }
          
          
       
        //echo $fileSize;
        
        
        
        
        
        $path = $targetFilePath;
       // echo($path);
       // $totoalPages=countPages($path);
        $pdftext = file_get_contents($path);
        $pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        //echo $pages;
       $date =date("d/m/Y");
      
        

      
//  $sql ="INSERT into pdf_manager (Pdf_Name,Pdf_path,Pdf_Size,Pdf_Pages) 
//  VALUES('$fileName','$targetFilePath','$fileSize',$pages)";
  
  $sql="INSERT INTO UploadDocs (Client_Name,Case_Name,Pdf_Name,Pdf_Size,Pdf_Pages,Pdf_Path,DOU)
           VALUES('$clientName','$caseName','$fileName','$fileSize','$pages','$targetFilePath','$date')";
           
     
if ($con->query($sql) === TRUE) {
 // echo "Saved Sucessfully Bro";
       header("Refresh:0");
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

}

      }

        

     }
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


        <!-- Datatable -->

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />


        

        <!--Datepicker-->

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> 
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.5/pdfobject.min.js"></script>
    
     <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>

    </head>
    <title>Upload Case Document</title>
    <style>
         div.dataTables_filter, div.dataTables_length {
            margin-top:2px;
            /* padding-right:20px;*/
            padding-left:20px;

            text-transform: uppercase;

        } 

        div.dataTables_filter {
            margin-left: -10rem;
            /*     margin-right: -1rem;*/
        }
        div.dataTables_wrapper div.dataTables_filter input {
            /*    margin-left: .5em;*/
            display: inline-block;
            width: 40rem !important;

        }
        #pdf_view { height:850px;};
    </style>
  </head>
  <body>
      
    <div class="topnav" id="myTopnav">


        <a href="Cms.php" class="nav__link">Timeline</a>
        <a href="#" class="nav__link">Team</a>
        <a href="#" class="nav__link">Law</a>
        <a href="knowledge.php" class="nav__link ">Knowledge</a>
        <a href="Clients.php" class="nav__link active">Clients </a>
        <a href="" class="nav_link">Task Management</a>
        <a href="#" class="nav__link">Manage Cme</a>
        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>
        <a href="#" class="nav__link">Control panel</a>




        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>



        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>
</div> <!-- ===== IONICONS ===== -->
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

<div class="topnav1 mt-2" id="myTopnav">
    <a href="Clients.php" class="nav__link" >Client</a>
    <a href="ClientCase.php" class="nav__link ">Case</a>
    <a href="uploadcasedoc.php" class="nav__link active">Upload Case Documents</a>
    <a href="Timelines.php" class="nav__link">TimeLine</a>
    <a href="ViewDoc.php" class="nav__link">View Case Documents</a>
    <a href="" class="nav__link">PDF Manager</a>
    <!--         <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                                  <i class="fa fa-bars"></i>
                                 </a>-->

</div>


<div class="container mt-2">
    
    <form method="POST" action="" enctype="multipart/form-data">
    <div class="container mt-2">
        
        <div class="row">
            
    <div class="col-lg-3 col-md-3 col-sm-12">
     <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>
                                <!--<a class="" data-toggle="modal" data-target="#AddType">  
                                  (Add Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#EditType">
                                  (Edit Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteType">
                                    (Delete Type)
                                </a>-->
                                <select class="form-control"  id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }
//                                    
//                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
//                                    while ($row = $sql->fetch_assoc()) {
//                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Client_Name'] . "</option>";
//                                    }
//                                    ?>
                                </select>
                                <input type="hidden" name="ClientName" id="text_CT" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
    </div>
 <div class="col-lg-3 col-md-3 col-sm-12">
     
         <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>
                                <!--<a class="" data-toggle="modal" data-target="#AddType">  
                                  (Add Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#EditType">
                                  (Edit Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteType">
                                    (Delete Type)
                                </a>-->
                                <select class="form-control mt-1" required style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="CaseN" id="text_CN" value="<?php echo $row['Case_Name']; ?>" />
                            </div>
    </div>
     
            <div class="col-lg-6 col-md-6 col-sm-12">
                
                    <label class="font-weight-bolder"> Choose Document</label><br>
                    <div class="continer">
<!--                      <input type="file" class="form-control-sm " name="file[]" id="fileToUpload" multiple required>-->
                 <input type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#UploadModal" value="Upload Pdf" name="submit">
                 
                    </div>
               
    </div>
               
    </div>
   
  </div>
    </form>
    </div>

<hr class="mt-5 bg-dark">
    

<div class="container-fluid">
    
    <div class="table">

        <table class="table table-striped table-bordered table-responsive  table-hover " id='UserList'>
            <thead class="thead-dark">
                <tr>
                    <th class="text-center"scope="col">SRN</th>
                    <th class="text-center" scope="col">Client Name</th>
                    <th class="text-center" scope="col">Case Name</th>
                    <th class="text-center" scope="col">PDF Name</th>
                    <th class="text-center" scope="col">Size</th>
                    <th class="text-center" scope="col">Pages</th>
                    <th class="text-center" scope="col">Upload Date</th>
                    <th class="text-center" scope="col">View</th>
                     <th class="text-center" scope="col">Edit</th>
                    <th class="text-center" scope="col">DEL</th>
                    

                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $sr = 1;
                    include('ClientDb/Dp.php');
                    $quariy = $con->query("SELECT * FROM UploadDocs");
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>
                            <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                            <td class="text-center" scope="row"style=""><?php echo $row['Client_Name']?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Case_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Name'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Size'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Pages'] ?></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['DOU'] ?></td>
                            <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModal" value="<?php echo $row['Pdf_Path']?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>')">View</a></td>
                           <td class="text-center" scope="row"style=""><a  id="editbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#EditModal" value="<?php echo $row['Sr_no']?>"onclick="edit('<?php echo $row['Sr_no']?>','<?php echo $row['Pdf_Name']?>')">Edit</a></td>
                            
<!--                            <td class="text-center" scope="row"style=""><a class="nav_link" href="CaseDb//EditCase.php/?v=<?php echo $row['Sr_no'] ?>">Edit </a></td>-->
                           <td class="text-center" scope="row"style=""><a href="UploadCase/Delpdf.php/?n=<?php echo $row['Pdf_Path']?>">Delete </a></td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pdf - Viewer</h5>
        <button type="button" class="close" id="VR1"data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
<!--               <div id="pdf_view"  class="pdfobject-container border">
    </div>-->
      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
  <button id="prev" class="btn btn-primary btn-sm">Previous</button>
  <button id="next" class="btn btn-primary btn-sm">Next</button>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
</div>

<canvas id="the-canvas" class="col-lg-12 col-md-12 col-sm-12 mt-2"></canvas>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="VR2" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
    
    
    <!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rename File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <label class="font-weight-bold">Please Rename your File</label>
              <input type="text" id="rename" class="form-control" placeholder="Type Here..." value="">
               <input type="hidden" id="sr" class="form-control"  value="">
               <button id="renamebtn" class="btn btn-primary mt-2"> Rename</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
    
        <!-- Modal -->
<div class="modal fade" id="UploadModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uplaod Docs..</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
<!--               <div id="pdf_view"  class="pdfobject-container border">-->

<!--        <div>
  <button id="prev" class="btn btn-primary btn-sm">Previous</button>
  <button id="next" class="btn btn-primary btn-sm">Next</button>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
</div>

<canvas id="the-canvas" class="col-lg-12 col-md-12 col-sm-12"></canvas>-->
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
    
    document.getElementById("VR1").addEventListener("click",Refresh);
        function Refresh(){
            console.log("Refresh me");
            location.reload();
        }
    document.getElementById("VR2").addEventListener("click",Refreshbtn);
        function Refreshbtn(){
            console.log("Refresh me");
            location.reload();
        }
    
    document.getElementById("renamebtn").addEventListener("click", RenamePdf);
    function RenamePdf() {
        
         var Sr = document.getElementById('sr').value;
         var Rename=document.getElementById('rename').value;
        console.log(Sr);
        console.log(Rename);
        var rename=JSON.stringify(Rename);
        var sr = JSON.stringify(Sr);
        $.ajax({
            type: "POST",
            url: "UploadCase/Editpdf.php",
            data: {Sr: sr, Rename:rename},
            success: function (res) {
                console.log(res);
                location.reload();
            }

        });
        
    };
    
     $('#UserList').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Document"
            }
        });
        
       
    
   
   // var editbtn= document.getElementById("editbtn").value;
    
   function edit(sr,file){
       console.log(file);
       console.log(sr);
       $("#rename").val(file);
       $('#sr').val(sr);
      
   }
    
      var viewbtn = document.getElementById("viewbtn").value;
//const pdf_view = document.getElementById("pdf_view");

function view(link){
   // viewbtn.textContent = link;
console.log(link);
   // PDFObject.embed(link,"#pdf_view");    
    
    
    
    var url = link;

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
//    scale = 2.8,
    scale = 2.8,
    
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale: scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);
    
    
    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});
    
}
    
    
     $("#ClientN").on("change",function(){
     var category = $("#ClientN").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"UploadCase/CaseNameDy.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
            $("#CaseName").html(data);
          
        }
      });
 });
    
     $('select').select2();
    </script>
    
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
  </body>
</html>