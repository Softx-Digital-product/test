<?php 

  include('Database/Dp.php');
  
   ini_set('session.save_path', 'session');
 
session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    
    
}else{
//        
        header("Location:http://apajuris.in/work/index.php");
       die();
}
  if(isset($_GET['v'])  && !empty($_GET['v']))
{
 $cid = $_GET['v'];
 //echo $cid;
   $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE Sr_no = '{$cid}'");
    //print_r($quariy); 
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          $CaseId= $row['CaseId'];
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                            $TotalPage = $row['Pdf_Pages'];
                        }
                        }
          $quariy = $con->query("SELECT * FROM Client_CaseDb WHERE Sr_no = '{$CaseId}'");
 
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                      
                          $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];  
                        }
                        }               
                        
                        
$path="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
$id;

}



if(isset($_POST['pid'])){
    $id=$_Post['id'];
   $cid=$_POST['pid'];
  //echo $cid;
    $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE Sr_no = $cid");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          $CaseId= $row['CaseId'];
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                           $TotalPage = $row['Pdf_Pages'];
            
                        }
                        }
                         $quariy = $con->query("SELECT * FROM Client_CaseDb WHERE Sr_no = '{$CaseId}'");
 
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];  
                        }
                        }
                        
$path="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";

//echo  $path;

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
    <title>Timeline-Panel</title>


<!-- Datatable -->

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


 <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
                <link rel="stylesheet" href="Timeline/timeline.css">
                
                
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
          

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
<script src="ckeditor/ckeditor.js"></script>
  
       <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>


 <style>
     
/*     .vc .btn{
        
     }*/

div.dataTables_filter, div.dataTables_length {
/* margin-top:5px;*/
/* padding-right:20px;*/
  padding-left:20px;

   text-transform: uppercase;

} 

div.dataTables_filter {
     margin-left: -10rem;
/*     margin-right: -1rem;*/
}
     div.dataTables_filter, div.dataTables_length {

 margin-bottom:-15px !important;
 padding-left:30px !important;
/*  padding-left:30px;*/
 background:#006161;
 color:white;
 padding:6px;
   text-transform: uppercase;
   overflow: hidden;

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
         .cc input{
             padding:0px;
             height:-1px;
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
    
}
#timelinebars{
/*                background: teal;*/
           background:#66b2b2;	
                color:white;
               height:40px;
               
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
            #pdf_renderer{ width:99.9%; cursor:pointer;
          ;}
             #link_active{
/*               background:#66b2b2;*/
 background:#40e0d0;
               border-radius: 0 !important;
                
            }
            
              .rowbg{ 
                 border:2px solid #F00;
                border:2px solid red !important;
color:#4285F4;

              }
              h6{
                  color:#7fffd4;
                  font-size: 1rem;
                
              }
              #dycontent{
                  font-size: 20px;
                 
              }
            .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color:#40e0d0;
}
 </style>
  </head>
  <body>
  
            <?php include 'headers.php';
             $Endpgs=array();
            ?>
        
<!--        <h1 class="text-center text-danger"> This page is under process !!! </h1>-->
          <?php
          if(isset($_POST['pid']) || isset($_GET['v'])){
                                        $sr = 1;
                                        //echo  " Hello Tis".$cid;
//                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid={$cid} ORDER BY STR_TO_DATE(Date, '%d/%m/%Y' ) ASC");
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid ={$cid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                
                                                array_push($Endpgs,$row['Ed_pg']);
                                            }
                                            }
          }
                                                ?>

        <?php
       // echo "<pre>";
        rsort($Endpgs);
        //print_r($Endpgs);
        
       
        //echo "</pre>";
        
       // echo $Endpgs[0];
        
       // echo $TotalPage;
        ?>
   <form method="POST" id="php" action="">
                                <input type="hidden" name="pid" id="path">
                               <input type="hidden" name="id" id="id">
                            </form>
 <?php
  if(isset($_POST['pid']) || isset($_GET['v'])){
              ?>
          
      <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <ul class="nav nav-pills p-0 cc" id="uldy">

                        <li class="nav-item ">
                            <a id="vt" class="nav-link active timelinelink " data-toggle="pill" href="#VT" >View TimeLine Entry</a>
                        </li>
                         <li class="nav-item">
                             <a id="ct"   class="nav-link timelinelink" data-toggle="pill" href="#CT">Create Timeline Entry</a>
                        </li>
                        <li class="nav-item d-none">
                             <a id="ut"   class="nav-link timelinelink" data-toggle="pill" href="#UT">Update Timeline Entry</a>
                        </li>
                        <li>
                         <?php
                          //  echo $TotalPage;
                           if(isset($_POST['pid']) || isset($_GET['v'])){
                                
//                                print_r($Endpgs);
                                if($Endpgs[0] == $TotalPage){
                                    
                                    echo "<div class='dycounts'><h6 id='all' class='mt-1 p-1 text-center font-weight-bold text-bold'>[ All Timeline Entry is Created!]</h6>]</div>";
                                }
                                
                                elseif(empty($Endpgs)){
                                    
                                    echo "<div class='dycounts'><h6 id='zero' class='mt-1 p-1 text-center font-weight-bold'>[ 1 to $TotalPage Timeline Entry is Not Yet Created! ]</h6></div>";
                                }
                                elseif($Endpgs[0] > $TotalPage) {
                                 echo "<div class='dycounts'><h6 id='wrong' class='mt-1 p-1 text-center font-weight-bold text-bold'>[ $Endpgs[0] is wrong page Number!]</h6>]</div>";
                            }
                                else{
                                   $ep= $Endpgs[0];
                                   $ep++;
                                     echo "<div class='dycounts'><h6 id='remain' class='mt-1 p-1 text-center font-weight-bold'>[ $ep to $TotalPage Timeline Entry is not yet Created! ]</h6></div>";
                                }
                                
                           
                            }
                            
                            ?> 
                            
                        </li>
                     

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active p-0" id="VT" role="tabpanel"  >
                              <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>
                            
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit"  scope="col">EDT</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Delete"  scope="col">DEL</th>



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
//                                        echo  " Hello Tis".$cid;
//                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid={$cid} ORDER BY STR_TO_DATE(Date, '%d/%m/%Y' ) ASC");
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid ={$cid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
<!--                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>-->                                                 
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Doc_type'] ?></td>-->
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip"  title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,20); ?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Title'] ?></td>-->
                                                                    <td class=" text-nowrap" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,35); ?></td>
                                                                    <?php $row['Content'] = strip_tags($row['Content']);?>
<!--                                                                     <td class=" text-nowrap" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Content']?>"><?php echo substr($row['Content'],0,25); ?></td>-->
                                            <th class="text-center text-nowrap" scope="row"style="cursor: pointer;"  data-toggle="modal" data-target="#viewcontent"onclick="dyfunction(<?php echo $row['Sr_no'];?>,<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><a class='nav_link text-center '>View</a></th>
<!--                                                                       <td class=" text-nowrap overflow-auto" scope="row" data-toggle="tooltip" title="<?php echo $row['Content']?>"><?php echo rtrim(substr($row['Content'],0,30));?></td>-->
                                                                       
                                                     <th class="text-center" scope="row" style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)">
<!--                                                     <a class="nav_link no " onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><?php echo $row['St_pg'] ?></a>-->
                                                         <a class="nav_link no " ><?php echo $row['St_pg'] ?></a>
                                                    </th>
                                                 
              <th class="text-center" scope="row"style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)">
<!--                  <a class="nav_link no" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)"><?php echo $row['Ed_pg'] ?></a>-->
                  <a class="nav_link no"><?php echo $row['Ed_pg'] ?></a>                                 
              </th>

           
             
<!--                <td class="text-nowrap" scope="row"   data-toggle="modal" data-target="#DescsModal"data-toggle="tooltip-top" title="<?php echo $row['Content']?>" onclick="DescB(<?php echo $row['Sr_no']?>)"><?php echo trim(substr($row['Content'],0,20))?></td>-->
                
<!--              <td class="text-center" scope="row"style=""><a class="btn btn-sm" onclick="Timelview('<?php echo $row['Cid']?>')">View</a></td>-->
<!--                    <td class="text-center" scope="row"style="cursor: pointer;"><a class="nav_link" onclick="phpviewer('<?php echo $row['Cid']?>','<?php echo $sr;?>')">View</a></td>-->
<!--                            <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
                    <th class="text-center" scope="row"style="cursor: pointer;"><a class="nav-link" onclick="Edit(<?php echo $sr;?>,<?php echo $row['Sr_no'];?>,<?php echo $row['St_pg'];?>)">Edit</a>
                                  
                            </th>
                             <th class="text-center" scope="row"style="cursor: pointer;">
                                 <a class="nav-link text-danger" onclick="Del(<?php echo $row['Sr_no'];?>,<?php echo $cid?>)">Del</a>
                            </th>

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
                          <div class="tab-pane fade  p-0" id="CT" role="tabpanel" >
                              <div class="container-fluid " id="dydata">
                                   <form  id="CTEDY">
                           
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-2">
                                         <div class="form-group">
                                                <label class="font-weight-bold">Document Type</label>
                                                <a class="ml-1" data-toggle="modal" data-target="#AddDocTy">
                                                    (Add)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDocTy">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelDocTy">
                                                    (Del)
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
                                        
                                        <input type="hidden" name="CTpdf" id="text_CTPDF" value="<?php echo $pdfName ?>" />
                                        
                                        
                                    </div>
                                    
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Date</label>
                                                <input class="form-control" placeholder="Date" name="CTDate" id="CTDate" value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Start page</label>
                                                <input  type="number" id="CTstpg" class="form-control"name="CTstpg" placeholder="eg. 1" id="CTstpg">
                                            </div>
                                        </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">End page</label>
                                                <input class="form-control" id="CTendpg" type="number" name="CTendpg" placeholder="eg. 4" id="CTendpg">
                                            </div>
                                        </div>
                                    
                                    
                                </div>

                                  <div class="form-group">
                                                <label class="font-weight-bold">Enter Title</label>
                                                <input class="form-control" required id="CTtitle"name="CTtitle" placeholder="Title" onkeyup="myFunction()">
                                            </div>
                                    
                                     <div class="form-group">
                                                <label class="font-weight-bold">Enter Content</label>
                                                <textarea class="form-control"id="editor" name="CTeditor"  aria-label="With textarea"></textarea>
               
                                            </div>
                                    <div class="form-group">
 
                                        <button  name="CTsubmit" id="CTsubmit" class="btn btn-primary"> Submit</button>
                                    </div>
                                    
                                    <input type="hidden" name="CTclientN" id="CTclientN" value="<?php  echo $clientName; ?>">
                                     <input type="hidden" name="CTcaseN" id="CTcaseN" value="<?php  echo $caseName; ?>">
                                      <input type="hidden" name="CTsR" id="CTsR" value="<?php  echo $cid; ?>">
                                     
                                     
                                </form>
                              </div>
                     
                        </div>
                        <div class="tab-pane fade  p-0" id="UT" role="tabpanel" >
                            <div class="container-fluid" id="Dydata">
                                
                            </div>
                        </div>
                    </div>
                    

                   

                    </div>

                <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                     <div id="my_pdf_viewer" class="">
                    	<div id="navigation_controls" class="text-center cc">
                            <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                             <input id="current_page" value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                            <button class="btn btn-primary btn-sm" id="reload">Refresh</button>
                        </div> 
<!--                           <hr class="bg-secondary mt-4">-->
                           <div class="loaderinfo  mb-1  mt-5 border-left">  </div>
                    	<div id="canvas_container" class="mt-1 mb-1">
                           
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
                           
<!--                              <hr class="bg-secondary">-->
    <div id="navigation_controls" class="text-center cc">
        <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                         <button class="btn btn-primary btn-sm"id="go_next1">Next</button>
                               <input id="current_page1" value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                               <button class="btn btn-primary btn-sm" id="reload1">Refresh</button>
                        </div>
     
					</div>  
                </div>
            </div>
        </div>
              <?php
          }
              ?>

<!--<div class="modals">
     Modal 
<div class="modal fade" id="viewcontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-xl modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Content</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
              <div class="card-body">
                  <div class="container-fluid" id="dycontent">
                      
                  </div>
              </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
</div>-->
      <?php include'UploadClientBrief/modals.php';?>
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
    </script>
<?php
                           if(isset($_POST['pid']) || isset($_GET['v'])){
  
                           ?> 
<script>
    
var cname = "<?php echo $clientName?>";
        var casename= "<?php echo $caseName?>";
        
             var clientn= JSON.stringify(cname);
      var casen=JSON.stringify(casename);
      $.ajax({ 
     type: "POST", 
    url:'Drafting/function.php',
    data: {Tclient:clientn,Tcase:casen},
    success:function(result){
       // alert(result);
        
    }
      });
      
      
       var cname = "<?php echo $clientName?>";
        var casename= "<?php echo $caseName?>";
        
         // console.log(cname);
           if(cname==" "){
                console.log("inside if");
           }else{
               console.log("inside else");
               console.log(cname);
               
                var Cname = JSON.stringify(cname);
                var CaseN = JSON.stringify(casename);
                    $.ajax({
                        url: "UploadCase/CaseNameDy.php",
                        type: "POST",
                        cache: false,
                        data: {Cname: Cname,Case:CaseN},
                        success: function (data) {
                            console.log(data);
                            $("#CaseName").html(data);

                        }
                    });
               
           }
  
</script>
<script>

 
   //CKEDITOR.replace('UEditor');
   
      CKEDITOR.replace('editor',{
//                          
//                        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', 'css/Ckeditor.css' ],
//                        
//                        bodyClass: 'document-editor',
      height: 600,
     
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
    
    </script>
  
<script>
    
            
function Etpg(id,pageno)
		{
$('#Timelist tr').removeClass("rowbg");
$('#Timelist tr').removeClass("no");
        $('#row'+id).addClass("rowbg");
        $('#row'+id).addClass("no");
        
//$('tr','#row'+id).addClass("rowbg");
			var desiredPage = pageno;
			if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
	document.getElementById("current_page").value = desiredPage;
	document.getElementById("current_page1").value = desiredPage;
                        render();
                }
				console.log(id+"  "+pageno);
				//$('#sampleTable tr').removeClass("rowbg");
				//$('#row'+id).addClass("rowbg");
    }
         $('.loaderinfo').html("<div class='container text-center loader mt-5'><img src='images/loader.gif' class='text-center mt-5'/></div>");
     //  viewpdfdata('<?php echo $source; ?>');
   //  const viewdatapdf = viewpdfdata = (source) =>{
//    function viewpdfdata(soruce){
        
        var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1,
       cache: true
    }
   
var source ="<?php echo $path;?>";
console.log(source);
//  pdfjsLib.getDocument({ url: source }, false, null, function(progress) {
//	var percent_loaded = (progress.loaded/progress.total)*100;
//        console.log(percent_loaded);
//}).then(function(pdf_doc) {
//	render();
//        console.log(pdf_doc);
//}).catch(function(error) {
//	// error
//        console.log(error);
//});

       pdfjsLib.getDocument("<?php echo $path;?>").then((pdf) => {
       myState.pdf = pdf;
        pdfDoc = pdf;
        
	   render();
           //myState.showPreviousViewOnLoad = false;
       
        finaltotal = pdf.numPages;
        console.log(pdf.numPages);
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
		 
//		page.render({
//			canvasContext: ctx,
//			viewport: viewport,
//                                                        
//		});

var renderContext = {
      canvasContext: ctx,
      viewport: viewport,
    };

var renderTask = page.render(renderContext);
    renderTask.promise.then(function (e) {  
        console.log(e);
      console.log('Page rendered');
        $('.loaderinfo').addClass('d-none'); 
    });
		
 		 

    });
   
}
        
        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null  || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page") .value = myState.currentPage;
            document.getElementById("current_page1") .value = myState.currentPage;
            render();
        });
        
        document.getElementById('go_previous1') .addEventListener('click', (e) => {
            if(myState.pdf == null   || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page") .value = myState.currentPage;
            document.getElementById("current_page1").value = myState.currentPage;		
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

        document.getElementById('go_next1').addEventListener('click', (e) => {
            if(myState.pdf == null  || myState.currentPage >= myState.pdf ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page1").value = myState.currentPage;
            document.getElementById("current_page") .value = myState.currentPage;
            render();
        });
        
        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage =  document.getElementById('current_page') .valueAsNumber;             
                if(desiredPage >= 1   && desiredPage <= myState.pdf ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page") .value = desiredPage;
	document.getElementById("current_page1") .value = desiredPage;
                        render();
                }
            }
        });
		
document.getElementById('current_page1') .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = document.getElementById('current_page1') .valueAsNumber;                  
                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page").value = desiredPage;
	document.getElementById("current_page1") .value = desiredPage;
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
		
		
		
		document.getElementById('zoom_out') .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
    $("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		
        
        document.getElementById('zoom_out1').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            $("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		
		var deg = 90;
		document.getElementById('rotate_page') .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		
        document.getElementById('rotate_page1').addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
    $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
            deg = deg + 90; 
        });




document.getElementById("Firstpg").addEventListener("click", Firstpg0);
    function Firstpg0() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
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
    
               document.getElementById("Lastpg").addEventListener("click", Lastpg0);
    function Lastpg0() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
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
  
      
        </script>
        
        <script>
            $(document).ready(function() {
                        
                         $('#Timelist').DataTable({
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
           searchPlaceholder:"Search Timeline",
    
        }
    });
    
    
                   });
                   
    
                    </script>
                                <script>
                            CKEDITOR.instances['editor'].on('contentDom', function() {
    CKEDITOR.instances['editor'].document.on('keyup', function(event) {
//        alert(CKEDITOR.instances.editor.getData());
        console.log(CKEDITOR.instances.editor.getData());
        
          $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
    data: {status:1},
    success:function(){

    }
  });
        var activeon = 'Create Brief';
  $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
    data: {activity:activeon},
    success:function(){
    }
  });

  
  var matches = CKEDITOR.instances.editor.getData().replace(/<[^<|>]+?>|&nbsp;/gi,' ').match(/\b/g);
           //var count = 0;
    if(matches) {
        count = matches.length/2;
    }
        console.log(count);
        $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
    //data: {TWords:count},
    data: {TWords:1},
     success: function(result) { 
        console.log("====> "+result);
        $('.wcount').val(result);
    }
  });
        
        
    });
});

function myFunction(){
//      var x = document.getElementById("CTtitle");
      var x= $("#CTtitle").val();
          $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
    data: {status:1},
    success:function(){

    }
  });
        // console.log(x);
      }
      
function dyfunction(Srno,sr,pg){
    Etpg(sr,pg);
 console.log(Srno);
//  var Srno= JSON.stringify(Srno);
$.ajax({
    type:'post',
    url:'UploadClientBrief/pdfDy.php',
    data: {contents:Srno},
    success: function(res) { 
        console.log(res);
        $('#dycontent').html(res);

      }
  });

    
};
          
          function Edit(rowid,sr,pg){
              rowid = parseInt(rowid);
            pg=  parseInt(pg);
              Etpg(rowid,pg);
              //alert(sr);
             $.ajax({
    type:'post',
    url:'UploadClientBrief/function.php',
    data: {Editsr:sr},
    success: function(res) { 
        console.log(res);
      // $('#editor').removeAttr('id');
        $('#Dydata').html(res);
         $("#UDate").datepicker({ dateFormat: 'dd/mm/yy',});
        $('select').select2();
        CKEDITOR.replace('Ueditor',{

      height: 600,
     
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

        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },


        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },

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
 
    });
  $('#ut').trigger('click');
  
  
     $('#UTsubmit').click(function(e){
             e.preventDefault();
             //alert('under process working on database');
            var date= $('#UDate').val();
            var stpg = $('#ustpg').val();
            var etpg= $('#uetpg').val();
            var dtypetxt= $('#text_UDT').val();
            var title= $('#UTtitle').val();
            var cid = $('#cid').val();
            var srno= $('#sr').val();
             var desc = CKEDITOR.instances['Ueditor'].getData();
            var editors=JSON.stringify(desc);
             
             
              $.ajax({
                  url:'UploadClientBrief/function.php',
                  type:'POST',
                data: {usrno:srno,Doctype:dtypetxt,date:date,sp:stpg,ep:etpg,title:title,editors:editors,cid:cid},
                 success:function(data){
                    // alert(data);
//                     console.log(data);
                              $('#VT').html(data);
                        $('#vt').trigger('click');
                         $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
        $('#Timelist').DataTable({
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
           searchPlaceholder:"Search Timeline",
    
        }
    });
                     
                 }//success function end here
                 
             });//ajax 2 end here
                                              
                                          
             
             
                               });//update button function
  
      }//ajax success
  });// ajax 1 end
              
          }// function end;
          
          function Del(sr,cid){
              
              //alert(sr+'----'+cid);
             $.ajax({
    type:'post',
    url:'UploadClientBrief/function.php',
    data: {Delsr:sr,Csr:cid},
    success: function(res) { 
                console.log(res);
        $('#VT').html(res);
       $('#vt').trigger('click');
       
 var srid= $('#CTsR').val();
         srid=  parseInt(srid);
         var totals= finaltotal;
         $.ajax({
             url:'UploadClientBrief/function.php',
            type:'POST',
            data: {total:totals,Srid:srid},
             success:function(data){
             $('.dycounts').html(data);
             // alert(data);
              }
                });//ajax end
 $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
        $('#Timelist').DataTable({
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
           searchPlaceholder:"Search Timeline",
    
        }
    });

      }
  });
          }
  
                </script>
                    
                    <script>
                                
                                
                                $('#CTsubmit').click(function(e){
                                   e.preventDefault();
                                   var uid= $('#CTsR').val();
                                   uid=  parseInt(uid);
                                   console.log(uid);
                                   var txttype= $('#text_CTDT').val();
                                   var txtpdf= $('#text_CTPDF').val();
                                   var ctdate= $('#CTDate').val();
                                   var ctst= $('#CTstpg').val();
                                   var ctend= $('#CTendpg').val();
                                   var cttitle=$('#CTtitle').val();
                                   var clientN= $('#CTclientN').val();
                                   var caseN= $('#CTcaseN').val();
                                  
                                   
                                   
                                    var desc = CKEDITOR.instances['editor'].getData();
                                     var editors=JSON.stringify(desc);
                                    // console.log(editors);
                                    $.ajax({
                                        url:'UploadClientBrief/function.php',
                                        type:'POST',
                                       //data:$('#CTEDY').serialize()+ "&editors="+editors+"&CTsR="+uid,
                                       data: {uids:uid,Doctype:txttype,pdf:txtpdf,date:ctdate,sp:ctst,ep:ctend,title:cttitle,client:clientN,case:caseN,editors:editors},
                                          success:function(data){
                                              $("#CTEDY").trigger('reset');
                                              CKEDITOR.instances['editor'].setData('');
                                            console.log(data);
                                            $('#VT').html(data);
                                             $('#vt').trigger('click');
                                             
                                              $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
                                                     $('#Timelist').DataTable({
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
           searchPlaceholder:"Search Timeline",
    
        }
    });
    
      var srid= $('#CTsR').val();
         srid=  parseInt(srid);
         var totals= finaltotal;
         $.ajax({
             url:'UploadClientBrief/function.php',
            type:'POST',
            data: {total:totals,Srid:srid},
             success:function(data){
             $('.dycounts').html(data);
             // alert(data);
              }
                });//ajax end
			
                         var lp= $('.lastpage').val();
                         lp=  parseInt(lp);
                          Etpg(0,lp);
		}//ajax success 1
                
      
                                    });//main ajax end
                                    
                                });//main function end
                                </script>
<?php } ?>
<script>
            $("#cb").addClass('active');
$('select').select2();
 $("#Date").datepicker({ dateFormat: 'dd/mm/yy',});
$("#CTDate").datepicker({ dateFormat: 'dd/mm/yy',});
 

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
                        url: "UploadClientBrief/pdfDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log("srno:- "+ data);
                            $("#pdfct").html(data);
//                              var Cid = $("#pdfct").val();
//                                console.log(Cid);
     
                            $("#path").val(data);
                               var Cid = $("#path").val();
                               console.log(Cid);
                             $("#php").submit();
                        }
                    });
                });
                
                
//                function deltimeline(sr){
//                    alert(sr);
//                    
//                }
                

</script>
<script>
        function updateUserStatus(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){

    }
  });

}
setInterval(function(){
updateUserStatus();
},3000);
                         
                    
 </script> 
 <script>
        function updateActivity(){
            var activeon = 'View Brief';
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