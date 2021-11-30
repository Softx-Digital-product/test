<?php 
include '../Database/Dp.php';

date_default_timezone_set('Asia/Kolkata');
ini_set('session.save_path', '../session');
session_start();
$tsr= $_SESSION['Tsr'];


if(isset($_POST['caseId'])){
    
 
    
       $cid= mysqli_real_escape_string($con, $_POST['caseId']);
       
    $CaseName=  mysqli_real_escape_string($con, $_POST['CaseName']);

    $sqlu="SELECT UploadClientBrief.Sr_no, ClientDb.Full_Name as Client_Name, Client_CaseDb.Case_Name as Case_Name, UploadClientBrief.Pdf_Name,UploadClientBrief.Pdf_Size,UploadClientBrief.Pdf_Pages,UploadClientBrief.DOU FROM UploadClientBrief,Client_CaseDb,ClientDb WHERE UploadClientBrief.CaseId = Client_CaseDb.Sr_no AND Client_CaseDb.Cid= ClientDb.Sr_no AND UploadClientBrief.CaseId = '{$cid}'";
//echo $sqlu;
      $quariy = $con->query($sqlu);
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                           $pdfSr= $row['Sr_no'];
                      
                        }
                        }
                        
$source ="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";

    
    
    ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 p-0">
                <ul class="nav nav-pills p-0 vbg" id="">
                
                        <li class="nav-item ">
                            <a id="vt" class="nav-link active timelinelink " data-toggle="pill" href="#VT" >Timeline List</a>
                        </li>
                         <li class="nav-item">
                             <a id="vd"   class="nav-link timelinelink" data-toggle="pill" href="#VD">View Details</a>
                        </li>
                       </ul>
                   <div class="tab-content p-0" id="pills-tabContent">
                       <div class="tab-pane fade show active p-0" id="VT" role="tabpanel" >
                       
                            <table class="table table-striped table-bordered  table-hover p-0 " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                         <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">Title</th>
                                        <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">View</th>
                                    </tr>
                               </thead>
                               <tbody>
                                   
                                   <?php 
                                   $sr=1;  
                                   $bsql="SELECT * From Pleading,BreifTimeline_data WHERE BreifTimeline_data.Sr_no = Pleading.Bid AND CaseId ='$cid'";
                                  //echo $bsql;
                                   $quariy= $con->query($bsql);
                                    $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariy)) {
                                                ?>
                                <tr class="copy_"<?php echo $rows['Title'];?>"table-striped'>
                                              <td class="text-center text-nowrap d-none" scope="row"style="cursor:pointer; width:6%" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Date']?>"><?php echo $rows['Date']?></td>
                                              <td class="text-center text-nowrap d-none" scope="row"style="cursor:pointer;max-width:1rem;overflow: hidden" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Doc_type']?>"><?php echo $rows['Doc_type']?></td>
                                            
                                                   <td class="text-center text-nowrap" style="cursor:pointer;max-width:8rem;overflow:hidden;" scope="row" Onclick='Etpg(0,<?php echo $rows['St_pg'];?>)' data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Title']?>"><?php echo $rows['Title'];?></td>
                                                    
                                                   <th class='Removes'  onclick="Briefdata('<?php echo $rows['Sr_no'];?>',<?php echo $sr;?>,<?php echo $rows['St_pg'];?>)"style="cursor:pointer;width:6%; "><a class='nav-link text-center text-primary btn_remove' data-Bid-type="<?php echo $rows['Bid'];?>"data-Fsr-type="<?php echo $fsr;?>" >View</a></th>
                                                 
      
                                        </tr>
                                   
                                   <?php
                                   $sr++;
                                        }}
                                   ?>
                           
                                  
                               </tbody>
                           </table>
                           
                       </div>
                       <div class="tab-pane fade   p-0" id="VD" role="tabpanel" >
                           <div class="container-fluid p-0" id="dyTimelineDetails">
                               
                              
                           </div>
                       </div>
                   </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 p-0">
                <div id="my_pdf_viewer" class=" ">
                    	<div id="navigation_controls" class="text-center vbg">
                              <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                             <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                            <input id="current_page" class="from-conrol-sm"value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                           
                           
                        </div> 
                  <div class="loaderinfo  mb-1  mt-5 border-left">  </div>
                  
                    	<div id="canvas_container" class="mt-1 mb-1 border-left">
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
    <div id="navigation_controls" class="text-center vbg">
                             <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next1">Next</button>
                            
                            <input id="current_page1" value="1" type="number"/>
                            
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                           
                              
                        </div>
     
					</div>
        </div>
    </div>
</div>
<script>
    
   
    
    function Etpg(id,pageno)
		{
                    $('.loaderinfo').html("<div class='container text-center loader mt-5'><img src='images/loader.gif' class='text-center mt-5'/></div>");
     
//$('#Timelist tr').removeClass("rowbg");
//$('#Timelist tr').removeClass("no");
//        $('#row'+id).addClass("rowbg");
//        $('#row'+id).addClass("no");
        
//$('tr','#row'+id).addClass("rowbg");
			var desiredPage = pageno;
			if(desiredPage >= 1  && desiredPage <= myState.pdf._pdfInfo.numPages) {
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
       cache: true,
       enableHandToolOnLoad: true
    }
   
var source ="<?php echo $source;?>";

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

       pdfjsLib.getDocument("<?php echo $source;?>").then((pdf) => {
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
  
    
             
        
   // }
</script>
    <?php
    die();
} 




?>