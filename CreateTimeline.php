
<?php
include 'Timeline/Dp.php';

if(isset($_POST['pid'])){
    
   $cid=$_POST['pid'];
   
  
    $quariy = $con->query("SELECT * FROM UploadDocs WHERE Sr_no = $cid");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                           $sR= $row['Sr_no'];
                        }
                        }
                        //if (empty($clientName)){
//                        if($clientName === NULL){
//                            $clientName = "Please Choose Client Name";
//                        }
                   $clientName;
                   $caseName;
                  $pdfName;
                  $sR;
$path="ClientCaseData/$clientName/$caseName/$pdfName";
//echo  $path;

}
else{
                         if($clientName === NULL){
                            $clientName = "Please Choose Client Name";
                        }
                        if($caseName === NULL){
                            $caseName = "Please Choose Case Name";
                        }
                        if($pdfName === NULL){
                            $pdfName = "Choose pdf Document";
                        }
                        
                        
                       // echo $clientName;
}




if(isset($_POST['CTsubmit'])){
    $ctdate=$_POST['CTDate'];
    $ctstpg=$_POST['CTstpg'];
    $ctendpg=$_POST['CTendpg'];
    $ctdocType=$_POST['CTDT'];
    $ctcid=$_POST['CTsR'];
    $ctpdf=$_POST['CTpdf'];
    $cttitle=$_POST['CTtitle'];
    $cteditor=$_POST['CTeditor'];
    
    $client_name=$_POST['CTclientN'];
    $case_name=$_POST['CTcaseN'];
    
    
    
    
   // echo $ctcid;
//    echo $cteditor;
    
    
       $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Timeline_data Where Title='$cttitle'"));
if($check>0){
   $msgs="<br> This DATA is already present";
  //echo $msgs;
   
// }
}
else{

  $sql ="INSERT into Timeline_data (Cid,T_date,St_pg,Ed_pg,Doc_type,Pdf_Name,Client_Name,Case_Name,Title,Content) 
  VALUE('$ctcid','$ctdate','$ctstpg','$ctendpg','$ctdocType','$ctpdf','$client_name','$case_name','$cttitle','$cteditor')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
     header("Refresh:0");
     
}
else {
  $msgs =  "Error: ----->" . $sql . "<br>" . $con->error;
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
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


        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
  <script src="ckeditor/ckeditor.js"></script>
  
       <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>

  
  
        <title>TimeLine</title>
        <style>
            
             #timelinebars{
/*                background: teal;*/
           background:#66b2b2;	
                color:white;
                padding-bottom: 1px;
            }
            .cc{
                padding:0px;
            }
          .cc .btn{
    margin-top: 5px;
    background: #008080;
/*    padding:6px;*/
    margin-bottom:5px;
}
         .cc input{
             padding:0px;
             height:-1px;
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
}
 

        </style>

<!--        <style>
             #timelinebars{
                background: teal;
                color:white;
            }
            .timelinelink{
                color:white;
            }
            .timelinelink:hover
            {
                color:white;
                text-decoration: underline;
               
                    
            }   
             #link_active{
               background:#66b2b2;
                
            }
           
         
                 #canvas_container_m {
        width: 99.9%;
        height: 750px;
        overflow: auto;
    }
	#pdf_renderer_m{ width:99.9%; cursor:pointer;}
  
  .couponcode:hover .coupontooltip {
    display: block;
}
        #canvas_container {
        width: 99.9%;
        height: 850px;
        overflow: auto;
    }
	#pdf_renderer{ width:99.9%; cursor:pointer;}
  
  .couponcode:hover .coupontooltip {
    display: block;
}

       
            .tooltip{
                color:white;
                /*          background-color:blue;*/
            }
            .tooltip-inner {
                background-color:  #00ace6;
            }
 
        </style>-->
    </head>
    <body>
<!--        <div class="topnav" id="myTopnav">


            <a href="Cms.php" class="nav__link">Timeline</a>
            <a href="#" class="nav__link">Team</a>
            <a href="#" class="nav__link">Law</a>
            <a href="knowledge.php" class="nav__link ">Knowledge</a>
            <a href="Clients.php" class="nav__link active">Clients </a>
            <a href="calendere1.php" class="nav_link">Task Management</a>
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

        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

        <div class="topnav1" id="myTopnav">
            <a href="Clients.php" class="nav__link" >Client</a>
            <a href="ClientCase.php" class="nav__link">Case</a>
            <a href="uploadcasedoc.php" class="nav__link">Upload Case Documents</a>
            <a href="Timelines.php" class="nav__link active">TimeLine</a>
            <a href="ViewDoc.php" class="nav__link">View Case Documents</a>
            <a href="" class="nav__link">PDF Manager</a>
                     <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                                          <i class="fa fa-bars"></i>
                                         </a>

        </div>
        <div class="fluid">


            <div class="container mt-2">

                    <form method="POST" action="" enctype="multipart/form-data">
                <div class="container mt-2">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>

                                <select class="form-control" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
                                    <option value=""disabled selected><?php echo $clientName ?></option>
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
//                                    
                                    ?>
                                </select>
                                <input type="hidden" name="ClientName" id="text_CT" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <div class="form-group">
                                                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>
                                <select class="form-control mt-1"  style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Case Name</option>
                                    <option value=""disabled selected><?php echo $caseName?></option>
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



                    </div>

                </div>

            </div>
            <hr class="bg-secondary mt-0">-->
<?php include 'timelineheaader.php';?>


<!--        </div>-->
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">

                    <!--            <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                 <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                  <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                   <button class="btn btn-primary btn-md" id="VD">View Documents</button>-->

                    <ul class="nav nav-pills" id="timelinebars">
                        <li class="nav-item">
                            <a class="nav-link timelinelink"  href="Timelines.php" >View Documents</a>
                        </li>
                        <li class="nav-item">
                            <a id="link_active" class="nav-link active timelinelink" data-toggle="pill" href="#TLN" >Create TimeLine</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link timelinelink" href="viewtimeline.php" >View TimeLine</a>
                        </li>
                        <!--                    <li class="nav_item">
                        
                                               <a href="" class="nav-link" data-toggle="tab" href="#VD" >View Documents</a>
                                           </li>-->


                    </ul>
<!--                    <hr class="bg-secondary">-->
                    <div class="tab-content" >

<!--                        <div class="tab-pane" id="VD">

                       Hello
                        </div>-->
                        
                        <div class="tab-pane fade show active" id="TLN">
                           
                            <div class="container-fluid p-2 mt-2">
                                <form method="POST" action="">
                                    
                                                                    <div class="row p-0">
                                     
                                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Choose Document</label>
                                                <select class="form-control" style="width:100%;" name="Cidpdf" id="pdfct" placeholder="Choose UdploadDocs Type.."onchange="document.getElementById('text_CTPDF').value=this.options[this.selectedIndex].text">
<!--                                                    <option value="" disabled selected>Choose Pdf Document</option>-->
                                                        <option value=""disabled selected><?php echo $pdfName ?></option>
                                                        
                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM UploadDocs");
                                                    while ($row = $sql->fetch_assoc()) {
//                                                        echo "<option value=".'ClientCaseData/'.$row['Client_Name'].'/'.$row['Client_Name'].'/'.$row['Pdf_Name'].">" . $row['Pdf_Name'] . "</option>";
                                                    
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Pdf_Name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                <input type="hidden" name="CTpdf" id="text_CTPDF" value="<?php echo $pdfName ?>" />
                                            </div>
                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type</label>
                                                <a class="ml-1" data-toggle="modal" data-target="#AddDocTy">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDocTy">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelDocTy">
                                                    (Delete)
                                                </a>
                                                <select class="form-control" style="width:100%;"  id="Ctdy" placeholder="Choose Document Type.."onchange="document.getElementById('text_CTDT').value=this.options[this.selectedIndex].text">
                                                    <option value="" disabled selected>Choose Document Type</option>

                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM Document_type");
                                                    while ($row = $sql->fetch_assoc()) {
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                <input type="hidden" name="CTDT" id="text_CTDT" value="" />
                                            </div>
                                        </div>
                                                                        
                                </div>
                                <div class="row">
                                    
                                    <div class="col-xl-4 col-lg-4 col-md-3 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Choose Date</label>
                                                <input class="form-control" placeholder="Date" name="CTDate" id="CTDate" value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Start page</label>
                                                <input  type="number" class="form-control"name="CTstpg" placeholder="eg. 1" id="CTstpg">
                                            </div>
                                        </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">End page</label>
                                                <input class="form-control"  type="number" name="CTendpg" placeholder="eg. 4" id="CTendpg">
                                            </div>
                                        </div>
                                    
                                    
                                </div>

                                  <div class="form-group">
                                                <label class="font-weight-bold">Enter Title</label>
                                                <input class="form-control" id="CTtitle"name="CTtitle" placeholder="Title">
                                            </div>
                                    
                                     <div class="form-group">
                                                <label class="font-weight-bold">Enter Content</label>
                                                <textarea class="form-control"id="CTeditor" required name="CTeditor"  aria-label="With textarea"></textarea>
               
                                            </div>
                                    <div class="form-group">
                                        
                                        
                                        <button type="submit" name="CTsubmit" id="CTsubmit" class="btn btn-primary"> Submit</button>
                                    </div>
                                    
                                    <input type="hidden" name="CTclientN" id="CTcCTclientNlientN" value="<?php  echo $clientName; ?>">
                                     <input type="hidden" name="CTcaseN" id="CTcaseN" value="<?php  echo $caseName; ?>">
                                      <input type="hidden" name="CTsR" id="CTsR" value="<?php  echo $sR; ?>">
                                     
                                     
                                </form>
                            </div>
                            
                           <form method="POST" id="php" action="">
                                <input type="hidden" name="pid" id="path">
                            
                            </form>  
                            
                        </div>
                        <div class="tab-pane" id="VT">
                            
                            <div class="tables p-0 col-lg-12 col-md-12 col-sm-12">

                                <table class="table table-striped table-bordered table-responsive  table-hover " id='Timelist'>
                                    <thead class="text-light vbg">
                                        <tr>
                                            <th class="text-center " data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">Start</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">End</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="View"  scope="col">View</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit/Delete"  scope="col">EDT/DEL</th>



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                        include('ClientDb/Dp.php');
                                        $quariy = $con->query("SELECT * FROM Timeline_data");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                                                    <td class="text-center " scope="row"style=""><?php echo $row['T_date'] ?></td>
                                                    <td class="text-center " scope="row"style=""><?php echo $row['Title'] ?></td>
                                                    <td class="text-center " scope="row"style="">
                                                    <a class="btn btn-sm" onclick="Etpg(<?php echo $row['Cid']?>,<?php echo $row['St_pg']?>)"><?php echo $row['St_pg'] ?></a>
                                                    </td>
                                                 
              <td class="text-center" scope="row"style="">
                  <a class="btn btn-sm" onclick="Etpg(<?php echo $row['Cid']?>,<?php echo $row['Ed_pg']?>)"><?php echo $row['Ed_pg'] ?></a>
                                                   
              </td>
<!--              <td class="text-center" scope="row"style=""><a class="btn btn-sm" onclick="Timelview('<?php echo $row['Cid']?>')">View</a></td>-->
                    <td class="text-center" scope="row"style=""><a class="btn btn-sm" onclick="phpviewer('<?php echo $row['Cid']?>')">View</a></td>
                            <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>
                            <a class="nav-link text-danger" onclick="">Delete</a>
                            </td>

                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>


                            
                            
      
                            </div><!--VT-->
                   
                        </div>

                    </div>


                </div> <!--container left End-->
                
                
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                     <div id="my_pdf_viewer" class="">
                    	<div id="navigation_controls" class="text-center cc">
                            <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                             <input id="current_page" class="text-center form-control-sm" value="1" type="number"/>
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                            <button class="btn btn-primary btn-sm" id="reload">Refresh</button>
                        </div> 
<!--                           <hr class="bg-secondary">-->
                          
                    	<div id="canvas_container" class="mt-1 mb-1">
                           
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
                           
<!--                              <hr class="bg-secondary">-->
    <div id="navigation_controls" class="text-center cc">
        <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                         <button class="btn btn-primary btn-sm"id="go_next1">Next</button>
                               <input id="current_page1" class="text-center form-control-sm" value="1" type="number"/>
                            
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                               <button class="btn btn-primary btn-sm" id="reload1">Refresh</button>
                        </div>
     
					</div>  
                </div>
            </div>
        </div>




        <div class="modals">
            
 
                
                
                <!-- Add Modal -->
<div class="modal fade" id="AddDocTy"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Add Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="container-fluid">
              
               <div class="form-group">
                <label class="font-weight-bold">Enter Type</label>
               <input class="form-control" name="Type" id="Docty" placeholder="Enter DocumentType">
               
               <button id="addty" class="btn btn-primary mt-2"> Add Doc Type</button>
               
                </div>  
              
           
          </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                
                              <!-- Edit Modal -->
<div class="modal fade" id="EditDocTy" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <label class="font-weight-bold">Select Document Type</label><br>
          <select  class="form-control" style="width:100%;" id="editty" placeholder="Choose Docuement Type..">
   <option value="" disabled selected>Choose Document Type</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM Document_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Document_name']."</option>";
}
?>
</select>
             <input class="form-control mt-3" type="text"  id="Renamety" placeholder=" Edit Document ">
             
              <button type="button" id="EditTy" class="btn btn-primary mt-2" >Edit Document</button>
          
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                                              <!--Delete Modal -->
<div class="modal fade" id="DelDocTy" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <label class="font-weight-bold">Select Document Type</label><br>
              <select  class="form-control" style="width:100%;" id="DeleteTy" placeholder="Choose Document Type..">
   <option value="" disabled selected>Choose Document Category</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM Document_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Document_name']."</option>";
}
?>
</select>
              <button type="button" id="DelTy" class="btn btn-primary mt-2" >Delete Type</button>
        
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

                                              
                              
                                              
                                              
            </div>




            <script>
                
               function phpviewer(link){
                   console.log(link);
                   $('#path').val(link);
                   
                   document.getElementById("php").submit();
                   
               };
                
                
                
                
                //document.getElementById('reload').contentWindow.location.reload();
                     document.getElementById("reload").addEventListener("click",refresh);
        function refresh(){
            console.log("Refresh me");
            location.reload();
        }
    document.getElementById("reload1").addEventListener("click",refreshbtn);
        function refreshbtn(){
            console.log("Refresh me");
            location.reload();
        }
    
                function timelines(name, path, clientN, caseN, sr) {
                    console.log(path);
                    console.log(sr);
                    console.log(name);
                    
                     document.getElementById('pdfnamelabel').innerHTML = name;
                    
                    $("#pdfname").val(name);
                    $("#sr").val(sr);
                    
                    $("#viewpdfmodal").val(path);
                    
                    
                    
                    
                    
                  //  $('#Ttitle').val(path);
                    // $(#VT).tab('show');


                }
                ;
                
                
document.getElementById("addty").addEventListener("click", AddDocTy);
function AddDocTy(){
  var Cname= document.getElementById("Docty").value;
console.log(Cname);
var cname= JSON.stringify(Cname);

$.ajax({ 
     type: "POST", 
      url: "Timeline/AddDocTy.php", 
       data: {name:cname},
      success: function(res) { 
        console.log(res);
        location.reload();
  } 
        
});

};

 document.getElementById("EditTy").addEventListener("click", editSC);
function editSC(){
      var Cid=document.getElementById('editty').value;
      var Rename=document.getElementById('Renamety').value;
      console.log(Cid);
      console.log(Rename);
      var cid= JSON.stringify(Cid);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/EditDocTy.php", 
       data: {id:cid,rename:renames},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});
};

 document.getElementById("DelTy").addEventListener("click", DelT);
function DelT(){
      var Cid=document.getElementById('DeleteTy').value;
      console.log(Cid);
      var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/DelDocTy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});  
};




            </script>



            <script>
                
                
                
                
                
                 $("#Date").datepicker({ dateFormat: 'dd/mm/yy',});
                     $("#CTDate").datepicker({ dateFormat: 'dd/mm/yy',});
                //document.getElementById("Createbtn").addEventListener("click",ext);

                //    $('#Createbtn a').on('click', function (event) {
                //  event.preventDefault()
                //  $(#VC).tab('show')
                //})




                $('select').select2();


                $("#ClientN").on("change", function () {
                    var category = $("#ClientN").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "UploadCase/CaseNameDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CaseName").html(data);

                        }
                    });
                });

                $("#CaseName").on("change", function () {
                    var category = $("#CaseName").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "Timeline/pdfDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#pdfct").html(data);

                        }
                    });
                });



$('#Timelist').DataTable({
                    //        "pagingType":"full_numbers",
                    "bFilter": true,
                    "bInfo": true,
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "responsive": true,
                    language: {
                        //"search": "_INPUT_",
                        searchPlaceholder: "Search Document"
                    }
                });

                $('#UserList').DataTable({
                    //        "pagingType":"full_numbers",
                    "bFilter": true,
                    "bInfo": true,
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "responsive": true,
                    language: {
                        //"search": "_INPUT_",
                        searchPlaceholder: "Search Document"
                    }
                });

                //     $('#someTab').tab('show')

                $(document).ready(function () {

                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    });
                });
                
                 
CKEDITOR.replace('CTeditor',{
     height: 480,
                          toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
//          "name": "document",
//          "groups": ["mode"]
        },
        //{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		//{ name: 'forms', groups: [ 'forms' ] },
        {
          "name": "insert",
          "groups": ["insert"]
        },
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
		{ name: 'others', groups: [ 'others' ] },
		
        
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });               


                
CKEDITOR.replace('editor',{
                          toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
//          "name": "document",
//          "groups": ["mode"]
        },
        //{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		//{ name: 'forms', groups: [ 'forms' ] },
        {
          "name": "insert",
          "groups": ["insert"]
        },
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
		{ name: 'others', groups: [ 'others' ] },
		
        
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });
            </script>
            
            
            <script>
                
                
                
function Etpg(id,pageno)
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
				
				
				$('#sampleTable tr').removeClass("rowbg");
				$('#row'+id).addClass("rowbg");
			
		}
          
          
         
         var link= "<?php echo $path;?>";
         
         if(link === null){
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
    pdfjsLib.getDocument("<?php echo $path;?>").then((pdf) => {
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
		
		
		
		
		document.getElementById('go_next')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage > myState.pdf
                                               ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page")
                    .value = myState.currentPage;
			document.getElementById("current_page1")
                    .value = myState.currentPage;		
            render();
        });
		document.getElementById('go_next1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage > myState.pdf
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
				
				
				$('#sampleTable tr').removeClass("rowbg");
				$('#row'+id).addClass("rowbg");
			
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

  

//document.getElementById("viewpdfmodal").addEventListener("click", viewpdf);
//function viewpdf(){
//    
//    var link=document.getElementById('viewpdfmodal').value;
//    viewmodal(link);
//    
//    
//    
//}

 $("#pdfct").on("change", function () {
     var Cid = $("#pdfct").val();
       console.log(Cid);
     
     $("#path").val(Cid);
     $("#php").submit();
     // document.getElementById("#php").submit();
     
  
     
                  
   
//      var cid= JSON.stringify(Cid);
//      $.ajax({ 
//     type: "POST", 
//      url: "Timeline/ViewerDy.php", 
//       data: {id:cid},
//      success: function(res) { 
//        console.log(res);
//   view(res);
 //}
     //});
 
 
        });
        
        function Timelview(Cid){
            console.log(Cid);
             var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/ViewerDy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
   view(res);
      }
  });
            
        }
        
        function Stpg(Cid,stpg){
            console.log(Cid);
            console.log(stpg);
            var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/ViewerDy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
   view(res);
      }
  });
   
    $("#current_page").val(stpg);
        $("#current_page1").val(stpg);
        
        
//        stpg = 2;
        console.log(stpg);
        myState.currentPage = stpg;
        
          render();
            
            
        }
        
        
                function Etpgs(Cid,etpg){
            console.log(Cid);
            console.log(etpg);
            var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/ViewerDy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
   view(res);
      }
  });
    // $("#current_page").val(etpg);
  // jump(etpg);
    $("#current_page").val(etpg);
        $("#current_page1").val(etpg);
        
        
        myState.currentPage = etpg;
        
          render();
              $("#current_page").val(etpg);
        $("#current_page1").val(etpg);
            
            
        }
                </script>
                


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>



    </body>
</html>