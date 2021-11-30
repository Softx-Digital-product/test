
<?php
include 'Timeline/Dp.php';

if(isset($_POST['pid'])){
    $id=$_Post['id'];
   $cid=$_POST['pid'];
  //echo $cid;
    $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid = $cid");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                        }
                        }
                        
$path="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
$id;
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

  
  
        <title>Brief TimeLine</title>


        <style>
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

             div.dataTables_wrapper div.dataTables_filter input {
width:300px;
   
    overflow: hidden !important;
   
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
  #link_active{
/*               background:#66b2b2;*/
 background:#40e0d0;
               border-radius: 0 !important;
                
            }
            
              .rowbg{ border:2px solid red !important;}
        </style>
      
    </head>
    <body>

            <?php include 'timelineheaader.php';?>
        

        <div class="container-fluid p-0">


            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">

                    <!--            <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                 <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                  <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                   <button class="btn btn-primary btn-md" id="VD">View Documents</button>-->

                    <ul class="nav nav-pills p-0" id="timelinebars">
                        
                       

                        <li class="nav-item ml-2">
                            <a id="link_active" class="nav-link active timelinelink " data-toggle="pill" href="#VT" >View TimeLine</a>
                        </li>
                         <li class="nav-item">
                             <a  class="nav-link timelinelink" href="CreateTimelineBrief.php" >Create Timeline Brief</a>
                        </li>
                        <!--                    <li class="nav_item">
                                               <a href="" class="nav-link" data-toggle="tab" href="#VD" >View Documents</a>
                                           </li>-->


                    </ul>
<!--                    <hr class="bg-secondary">-->
                    <div class="tab-content" >

                        <div class="tab-pane fade" id="VD">

                          

                            <form method="POST" id="php" action="">
                                <input type="text" name="pid" id="path">
                               <input type="text" name="id" id="id">
                            </form>
                            <form method="POST" id="Descs" action="">
                                <input type="text" name="ids" id="ids">
                               
                            </form>
                                
                            

                        </div>
                        <div class="tab-pane fade" id="TLN">
                        
                        </div>
                        
                        <div class="tab-pane fade show active" id="VT">
                            
                           <?php
                           if(isset($_POST['pid'])){
                                    
                           ?> 
                           
                           
                       
                            <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">Start</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">End</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit/Delete"  scope="col">EDT/DEL</th>



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                        include('ClientDb/Dp.php');
                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data where Cid='$cid'");
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Date'] ?></td>-->
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip-top" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Doc_type'] ?></td>-->
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip-top" title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,10); ?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Title'] ?></td>-->
                                                                    <td class=" text-nowrap" scope="row"style="" data-toggle="tooltip-top" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,15); ?></td>
                                                    <td class="text-center" scope="row"style="cursor: pointer;">
                                                    <a class="nav_link" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><?php echo $row['St_pg'] ?></a>
                                                    </td>
                                                 
              <td class="text-center" scope="row"style="cursor: pointer;">
                  <a class="nav_link" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)"><?php echo $row['Ed_pg'] ?></a>
                                                   
              </td>

              <td class="text-nowrap" scope="row" data-toggle="tooltip-top" title="<?php echo $row['Content']?>"><?php echo trim(substr($row['Content'],0,20))?></td>
             
<!--                <td class="text-nowrap" scope="row"   data-toggle="modal" data-target="#DescsModal"data-toggle="tooltip-top" title="<?php echo $row['Content']?>" onclick="DescB(<?php echo $row['Sr_no']?>)"><?php echo trim(substr($row['Content'],0,20))?></td>-->
                
<!--              <td class="text-center" scope="row"style=""><a class="btn btn-sm" onclick="Timelview('<?php echo $row['Cid']?>')">View</a></td>-->
<!--                    <td class="text-center" scope="row"style="cursor: pointer;"><a class="nav_link" onclick="phpviewer('<?php echo $row['Cid']?>','<?php echo $sr;?>')">View</a></td>-->
<!--                            <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
                    <td class="text-center" scope="row"style=""><a class="nav-link"  href="UploadClientBrief/UpdatetimelineBrief.php?v=<?php echo $row['Sr_no']?>"onclick="">Edit</a>
                                    <a class="nav-link text-danger" href="UploadClientBrief/DelTimelineBrief.php?v=<?php echo $row['Sr_no']?>">Delete</a>
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
                            
                            <?php
                           }
                            ?>
                   
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
                             <input id="current_page" value="1" type="number"/>
                           
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




        <div class="modals">
            
            <!-- Modal -->
<div class="modal fade" id="DescModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Brief Content</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?php
        if(isset($_POST['ids'])){
    $ids=$_Post['ids'];
 
  //echo $ids;
    $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Sr_no = $ids");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                         
                           $contents= $row['Content'];
                        }
                        }
                        
          }
          ?>
          

          <p id="BriefDesc"><?php $contents?></p>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  
      </div>
    </div>
  </div>
</div>
            
        </div>




            <script>
//                function DescB(data){
//                    console.log(data);
//                    
//                    $("#ids").val(data);
//                 
////                    $("#Descs").submit();
//                    document.getElementById("Descs").submit();
//                }
               function phpviewer(link,id){
                   console.log(link);
                   $('#path').val(link);
                    $('#id').val(id);
                   $('#row'+id).addClass("rowbg"); 
                   document.getElementById("php").submit();
                   
               };
                
                
//                 $('#row'+id).addClass("rowbg"); 
                
                //document.getElementById('reload').contentWindow.location.reload();
//                     document.getElementById("reload").addEventListener("click",refresh);
//        function refresh(){
//            console.log("Refresh me");
//            location.reload();
//        }
//    document.getElementById("reload1").addEventListener("click",refreshbtn);
//        function refreshbtn(){
//            console.log("Refresh me");
//            location.reload();
//        }
//    
            
                


            </script>



            <script>
//                
                $("#tl").removeClass("active");
                $("#cb").addClass("active");
                
                
                
              
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
                        url: "UploadClientBrief/pdfDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#pdfct").html(data);
                              var Cid = $("#pdfct").val();
                                console.log(Cid);
     
                            $("#path").val(data);
                             $("#php").submit();
                        }
                    });
                });
                
                
                
                
                

//$("#dytables").hide();

// var row = table.row('#row1');
//                    console.log(row);
                
                //     $('#someTab').tab('show')

                $(document).ready(function () {

                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    });
                });
                
                 

            </script>
            
            
            <script>
                
                
            
function Etpg(id,pageno)
		{
$('#Timelist tr').removeClass("rowbg");
        $('#row'+id).addClass("rowbg");
        
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

  
//
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
        
$('#Timelists').DataTable({
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
                   
                    //tr.addClass('rowbg');
//                     $("#row1").addClass('rowbg');
                    
                });
                </script>
                


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>



    </body>
</html>