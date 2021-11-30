<?php
include '../Database/Dp.php';
date_default_timezone_set('Asia/Kolkata');
ini_set('session.save_path', '../session');
session_start();
$tsr= $_SESSION['Tsr'];

if(isset($_POST['caseId'])){
   
     $cid= mysqli_real_escape_string($con, $_POST['caseId']);
    $CaseName=  mysqli_real_escape_string($con, $_POST['CaseName']);
   
    $UploadId ='';
    $clientName="";
//    echo $CaseName;
//    echo $cid;
 $sqlu="SELECT UploadClientBrief.Sr_no, ClientDb.Full_Name as Client_Name, Client_CaseDb.Case_Name as Case_Name, UploadClientBrief.Pdf_Name,UploadClientBrief.Pdf_Size,UploadClientBrief.Pdf_Pages,UploadClientBrief.DOU FROM UploadClientBrief,Client_CaseDb,ClientDb WHERE UploadClientBrief.CaseId = Client_CaseDb.Sr_no AND Client_CaseDb.Cid= ClientDb.Sr_no AND UploadClientBrief.CaseId = '{$cid}'";
//echo $sqlu;
    $quariy = $con->query($sqlu);
     $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                            $UploadId = $row['Sr_no'];
                           $clientName= $row['Client_Name'];
                           $CaseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                      
                        }
                        }
                        
$source ="ClientCaseData/$clientName/$CaseName/ClientBrief/$pdfName";
    
    
    ?>

<div class="container-fluid p-0">
    <div class="row">
         
          <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 p-0">
               <div class="container-fluid p-0 " id="dyflags">
                   <div class="container-fluid p-0 ">
                       <ul class="nav nav-pills p-0 cc" id="">
                
                        <li class="nav-item ">
                            <a id="vt" class="nav-link active timelinelink " data-toggle="pill" href="#VT" >Timeline List</a>
                        </li>
                         <li class="nav-item">
                             <a id="vd"   class="nav-link timelinelink" data-toggle="pill" href="#VD">View Details</a>
                        </li>
                       </ul>
                   <div class="tab-content" id="pills-tabContent">
                       <div class="tab-pane fade show active p-0" id="VT" role="tabpanel" >
                            <div class="accordion p-0" id="accordionExamples">
                     
                    <?php 
                    $sr=1;
                 //   $sqls="SELECT FlagsAccordion.FlagId as FlagSr, Flags.FlagName FROM FlagsAccordion,Flags WHERE Flags.Sr_no = FlagsAccordion.Flagid AND CaseId = '$cid '";
//                  $sqls="SELECT *,Sr_no as FlagSr,Doc_type as FlagName FROM BreifTimeline_data WHERE Case_Name = '$CaseName' ";
                   $sqls ="SELECT Document_type.Sr_no as FlagSr, Document_type.Document_name as FlagName FROM Document_type,BreifTimeline_data WHERE BreifTimeline_data.Doc_type = Document_name AND Case_Name = '$CaseName' Group By(FlagName)";
//                echo $sqls;
                   $quariys= $con->query($sqls);
                                   
                                        $num = mysqli_num_rows($quariys);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariys)) {
                                                $fsr= $row['FlagSr'];
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                ?>
                    
                                             <div class="card p-0" id="Caccordion<?php echo $row['FlagSr'];?>">
    <div class="card-header p-0 cc" id="<?php echo $row['FlagSr'];?>">
      <h2 class="mb-0">
          <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                  <button class="btn  btn-block text-white text-center" type="button" onclick="show(<?php echo $row['FlagSr'];?>)" data-toggle="collapse" data-target="#<?php echo $row['FlagSr']; ?>" aria-expanded="true" aria-controls="collapseOne">
           <?php echo $row['FlagName'];?>
        </button>
              </div>
<!--              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                  <button class="btn-danger text-white text-center  btn " style="background: #C70039 " onclick="Remove(<?php echo $row['FlagSr'];?>)">remove</button>
              </div>-->
          </div>
        
          
      </h2>
    </div>

    <div id="coll<?php echo $row['FlagSr'];?>" class="collapse " data-parent="#accordionExamples">
      <div class="card-body p-0">
         
          <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive ">

                                <table class="table table-striped table-bordered  table-hover p-0 " id="WTable<?php echo $row['FlagSr'];?>">
                                    <thead class="vbg text-white text-center">
<!--                                        <tr>
                                    Under process
                                        </tr>-->
                                    </thead>
                                    <tbody >
                                                  <?php
//                                       $tsql="SELECT * From Flagslists,BreifTimeline_data WHERE Flagslists.Bid= BreifTimeline_data.Sr_no AND Flagslists.CaseId= '$cid' AND Flagslists.FlagId ={$row['FlagSr']}";
                                 //     $tsql="SELECT * FROM BreifTimeline_data WHERE Case_Name ='$CaseName' AND Doc_type = '{$row['FlagName']}'; ";
                                      $tsql="SELECT * FROM BreifTimeline_data WHERE Cid ='$UploadId' AND Doc_type = '{$row['FlagName']}'; ";
              
//                                                  
//                                                                                  echo $tsql;
                                       $quariy= $con->query($tsql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($rows);
//                                                echo "</pre>";
                                                ?>
                                       <tr class="copy_"<?php echo $rows['Title'];?>"table-striped'>
                                              <td class="text-center text-nowrap" scope="row"style="cursor:pointer; width:6%" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Date']?>"><?php echo $rows['Date']?></td>
                                              <?php // echo substr($rows['Title'],0,50); ?>
                                                   <td class="text-center text-nowrap" style="cursor:pointer;max-width:8rem;overflow:hidden;" scope="row" Onclick='Etpg(0,<?php echo $rows['St_pg'];?>)' data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Title']?>"><?php echo $rows['Title'];?></td>
                                                    <td scope="row" class="text-center d-none"><?php echo $rows['Title']?></td>
                                                   <th class='Removes'  onclick="Briefdata('<?php echo $rows['Sr_no'];?>',<?php echo $sr;?>,<?php echo $rows['St_pg'];?>)"style="cursor:pointer;width:6%; "><a class='nav-link text-center text-primary btn_remove' data-Bid-type="<?php echo $rows['Bid'];?>"data-Fsr-type="<?php echo $fsr;?>" >View</a></th>
                                                   <td class='d-none'><?php echo $rows['Bid'];?></td>
      
                                        </tr>
                                                
                                                <?php
                                            }
                                            }
                                       ?>
                                     
                                    </tbody>
                                </table>
              </div>
      </div>
    </div>
  </div>
                 
                     <?php
              
                                 $sr++;               
                                        }}
                    ?>
      
  
    </div>
                       </div>
                       <div class="tab-pane fade   p-0" id="VD" role="tabpanel" >
                           <div class="container-fluid p-0" id="dyTimelineDetails">
                               <button class="btn btn-sm text-white">Back</button>
                              
                           </div>
                       </div>
                   </div>
                   </div>
          
             </div>
          </div>
          <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 p-0 ">
             <div id="my_pdf_viewer" class=" ">
                    	<div id="navigation_controls" class="text-center cc">
                              <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                             <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                            <input id="current_page" class="from-conrol-sm"value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                            <a class="btn btn-primary btn-sm " herf="" download id="Download">D</a>
                           
                        </div> 
                  <div class="loaderinfo  mb-1  mt-5 border-left">  </div>
                  
                    	<div id="canvas_container" class="mt-1 mb-1 border-left">
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
    <div id="navigation_controls" class="text-center cc">
                             <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next1">Next</button>
                            
                            <input id="current_page1" value="1" type="number"/>
                            
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                            <a class="btn btn-primary btn-sm " href="" download id="Download1">D</a>
                              
                        </div>
     
					</div>
          </div>
      </div>
</div>
<script>
    
    function show(sr){
        //alert(sr);
//        $('.collapse').removeClass('show');
//        $("#coll"+sr).addClass("show");

if ( $("#coll"+sr).hasClass("show") ) {  
//      $('.collapse').removeClass('show');
    $('#coll'+sr).removeClass('show');
     
//     console.log("yes Exists");
     
    }else{
//           console.log("Not Exists");
   $('.collapse').removeClass('show');
         $("#coll"+sr).addClass("show");
         
    }
  
   
    }
    
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


if(isset($_POST['BreifId'])){
    $bid= mysqli_real_escape_string($con, $_POST['BreifId']);
    
//    $sql="SELECT FROM BreifTimeline_data WHERE Sr_no = '$bid'  ";
//    echo $sql;
    $sql="SELECT UploadClientBrief.Sr_no, ClientDb.Full_Name as Client_Name, Client_CaseDb.Case_Name as Case_Name, UploadClientBrief.Pdf_Name, BreifTimeline_data.Doc_type, BreifTimeline_data.Title, BreifTimeline_data.Content, BreifTimeline_data.Date
 FROM UploadClientBrief,Client_CaseDb,ClientDb,BreifTimeline_data
WHERE
 UploadClientBrief.CaseId = Client_CaseDb.Sr_no AND 
Client_CaseDb.Cid= ClientDb.Sr_no AND 
UploadClientBrief.Sr_no = BreifTimeline_data.Cid  AND
BreifTimeline_data.Sr_no = '$bid' ";
    
//    echo $sql;
        $quariys= $con->query($sql);
                                        $num = mysqli_num_rows($quariys);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariys)) {
                                                
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
    
    ?>
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <label class="font-weight-bolder"><?php  echo $row['Title'] ;?></label>
        </div>
        <div class="card-body">
            <label class="font-weight-bolder">Client Name : <span class="font-weight-normal"><?php echo $row['Client_Name'];?></span></label><br><br>
            <label class="font-weight-bolder">Case Name : <span class="font-weight-normal"><?php echo $row['Case_Name'];?></span></label><br><br>
          <label class="font-weight-bolder">Document Type : <span class="font-weight-normal"><?php echo $row['Doc_type'];?></span></label> &nbsp; &nbsp;&nbsp;
          <label class="font-weight-bolder">Date : <span class="font-weight-normal"><?php echo $row['Date'];?></span></label><br><br>
          <label class="font-weight-bolder">Content  : <span class="font-weight-normal"><?php echo $row['Content'];?></span></label><br>
    
        </div>
        <div class="card-footer">
            <button class="btn text-white btn-lg" onclick="Back();">Back</button>
        </div>
    </div>
    
</div>
    
    <?php
                                            }
                                        }
    die();
}

?>