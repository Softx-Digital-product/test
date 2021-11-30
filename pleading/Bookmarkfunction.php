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
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-0" id="dydataz">
        
              <ul class="nav nav-pills p-0 vbg" id="">
                
                        <li class="nav-item ">
                            <a id="vp" class="nav-link active timelinelink " data-toggle="pill" href="#VP" >View Pleadings</a>
                        </li>
                         <li class="nav-item">
                             <a id="vb"   class="nav-link timelinelink" data-toggle="pill" href="#VB">View BookMarks</a>
                        </li>
                       </ul>
                   <div class="tab-content p-0" id="pills-tabContent">
                       <div class="tab-pane fade show active p-0" id="VP" role="tabpanel" >
                           <div class="Sidebtns d-none">
          <button class="btn-sm text-white btn">F</button>
          <button class="btn-sm text-white btn">L</button>
          <button class="btn-sm text-white btn">P</button>
          <button class="btn-sm text-white btn">N</button>
          <button class="btn-sm text-white btn">+</button>
          <button class="btn-sm text-white btn">-</button>
          <button class="btn-sm text-white btn">R</button>
          <button class="btn-sm text-white btn">B</button>     
      </div>
                       
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
                                            
                                                   <td class="text-center text-nowrap" style="cursor:pointer;max-width:8rem;overflow:hidden;" scope="row" Onclick="Etpg(<?php echo $rows['Bid'];?>,<?php echo $rows['St_pg'];?>); viewBookMark('<?php echo $rows['Bid'];?>',<?php echo $sr;?>,<?php echo $rows['St_pg'];?>)" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Title']?>"><?php echo $rows['Title'];?></td>
                                                    
                                                   <th class='Removes'  onclick="viewBookMark('<?php echo $rows['Bid'];?>',<?php echo $sr;?>,<?php echo $rows['St_pg'];?>)"style="cursor:pointer;width:6%; "><a class='nav-link text-center text-primary btn_remove' data-Bid-type="<?php echo $rows['Bid'];?>"data-Fsr-type="<?php echo $fsr;?>" >View</a></th>
                                                 
      
                                        </tr>
                                   
                                   <?php
                                   $sr++;
                                        }}
                                   ?>
                           
                                  
                               </tbody>
                           </table>
                           
                       </div>
                       <div class="tab-pane fade   p-0" id="VB" role="tabpanel" >
                           <div class="dybooksmarks">
                          <div class="container-fluid p-0" id="dyBookmarks">
                              <div class="p-0 d-none">
                                  
                                   <table class="table table-striped table-bordered  table-hover p-0 " id=''>
                                    <thead class="vbg text-white">
                                        <tr>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                         <th class="text-center"data-toggle="tooltip" data-placement="top" title="Book Mark"  scope="col">Book-Mark</th>
                                         <th class="text-center"data-toggle="tooltip" data-placement="top" title="Start page"  scope="col">Page</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Edit"  scope="col">Edit</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Delete"  scope="col">Del</th>
                                        
                                    </tr>
                               </thead>
                               <tbody>
<?php
        $sql="SELECT Bookmark.Sr_no as bsr, Bookmark.pg,Bookmark.BName, BreifTimeline_data.St_pg,BreifTimeline_data.Ed_pg,BreifTimeline_data.Title,BreifTimeline_data.Sr_no as Bid,BreifTimeline_data.Date,BreifTimeline_data.Doc_type From Bookmark,BreifTimeline_data WHERE BreifTimeline_data.Sr_no = Bookmark.Bid AND Bookmark.CaseId= '$cid'";
       //echo $sql;
        $quariy = $con->query($sql);
//     echo $quariy;
          $Sr =1;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($rows = mysqli_fetch_array($quariy)) {
                            ?>
                 
                                <tr class="copy_"<?php echo $rows['Title'];?>"table-striped'>
                                              <td class="text-center text-nowrap d-none" scope="row"style="cursor:pointer; width:6%" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Date']?>"><?php echo $rows['Date']?></td>
                                              <td class="text-center text-nowrap d-none" scope="row"style="cursor:pointer;max-width:1rem;overflow: hidden" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Doc_type']?>"><?php echo $rows['Doc_type']?></td>
                                            
                                                   <td class="text-center text-nowrap" style="cursor:pointer;max-width:8rem;overflow:hidden;" onclick="EdtDel('<?php echo $rows['bsr'];?>')"  scope="row"data-toggle="tooltip" data-placement="top" title="<?php echo $rows['BName']?>"><?php echo $rows['BName'];?></td>
                                                    
                                                   <th class='Removes'  style="cursor:pointer;width:3%; "><a class='nav-link text-center text-primary btn_remove' Onclick='Etpg(<?php echo $rows['Bid'];?>,<?php echo $rows['pg'];?>)' ><?php echo $rows['pg']?></a></th>
                                                   <th class='d-none'  style="cursor:pointer;width:3%; "><a class='nav-link text-center text-primary 'onclick='Edit(<?php echo $rows['bsr'];?>)'>Edit</a></th>
                                                   <th class='d-none'  style="cursor:pointer;width:3%; "><a class='nav-link text-center text-danger 'onclick='Del(<?php echo $rows['bsr'];?>)'>Del</a></th>
                                                 
      
                                        </tr>
                                   
<?php
                        }
$Sr++;
                    }
                    ?>
                               </tbody>
  </table>
                                  
                              </div>
                              
                             
                           </div>
                       </div>
                       </div>
                   </div>
        
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 p-0" id="viewers">
            
            
             <div id="my_pdf_viewer" class=" ">
                 
                    	<div id="navigation_controls" class="text-center cc mb-2">
                              <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                             <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                            <input id="current_page" class="from-conrol-sm"value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                             <button class="btn btn-primary btn-sm" onclick="getpage()"data-toggle="modal" data-target="#bmmodals"  id="BookMark">Create Book-Mark</button>
<button class="btn-sm text-white btn Bp"onclick="subbookmarks()"data-toggle="modal" data-target="#AddSubBM">Sub Book-mark</button>     
<button class="btn btn-sm text-white" onclick="fullscreen()"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>
<button class="btn btn-sm text-white" onclick="TabMode()"><i class="fa fa-window-restore" aria-hidden="true"></i></i></button>
                           
                        </div> 
                  <div class="loaderinfo  mb-1  mt-5 border-left">  </div>
                  
                    	<div id="canvas_container" class="mt-1 mb-1 border-left">
                            <div class="RSidebtns d-none">
          <button class="btn-sm text-white btn Fp">F</button>
          <button class="btn-sm text-white btn Lp">L</button>
          <button class="btn-sm text-white btn Pp">P</button>
          <button class="btn-sm text-white btn Np">N</button>
          <button class="btn-sm text-white btn Plp ">+</button>
          <button class="btn-sm text-white btn Nlp">-</button>
          <button class="btn-sm text-white btn Rp">R</button>
          <button class="btn-sm text-white btn Bp"onclick="getpage()"data-toggle="modal" data-target="#bmmodals">B</button>
          <button class="btn-sm text-white btn Bp"onclick="subbookmarks()"data-toggle="modal" data-target="#AddSubBM">SB</button> 
      </div>
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
                                  <button class="btn btn-primary btn-sm" onclick="getpage()"data-toggle="modal" data-target="#bmmodals"  id="BookMark">Create Book-Mark</button>
                         <button class="btn-sm text-white btn Bp"onclick="subbookmarks()"data-toggle="modal" data-target="#AddSubBM">Sub Book-mark</button> 
<button class="btn btn-sm text-white" onclick="fullscreen()"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>
<button class="btn btn-sm text-white" onclick="TabMode()"><i class="fa fa-window-restore" aria-hidden="true"></i></i></button>
                        
                              
                        </div>
     
					</div>
        </div>
    </div>
</div>
<script>
    var clientName= $('#ClientN option:selected');
    var cname = clientName.text();
                    var caseName=$("#CaseName option:selected");
                    var casename= caseName.text();
   
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
    
    
    
    
  
    $(".Fp").click(function(){
  $("#Firstpg").click();
});
 $(".Lp").click(function(){
  $("#Lastpg").click();
});
 $(".Pp").click(function(){
  $("#go_previous").click();
});
 $(".Np").click(function(){
  $("#go_next").click();
});
 $(".Plp").click(function(){
  $("#zoom_in").click();
});
 $(".Nlp").click(function(){
  $("#zoom_out").click();
});
 $(".Rp").click(function(){
  $("#rotate_page").click();
});


    
    function getpage(){
       var page=  $('#current_page').val();
         $('#pdfpageNo').val(page);
    }
   
    
    function Etpg(id,pageno)
		{
                  //  viewBookMark(id,0,pageno);
                    
                    $('#bids').val(id);
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
            myState.zoom += 0.5;
            render();
        });
		document.getElementById('zoom_in1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			
			$("#pdf_renderer").css("width", "auto");
            myState.zoom += 0.5;
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




if(isset($_POST['bookMarkN'])){
     $clientid= mysqli_real_escape_string($con, $_POST['client']);
      $caseid= mysqli_real_escape_string($con, $_POST['case']);
       $bookMarkN= mysqli_real_escape_string($con, $_POST['bookMarkN']);
        $spage= mysqli_real_escape_string($con, $_POST['sPage']);
         $bid= mysqli_real_escape_string($con, $_POST['bid']);
     echo "<pre>";
     print_r($_POST);
     echo "</pre>";
      $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Bookmark Where BName ='$bookMarkN'"));
if($check>0){
   echo "<br> This DATA is already present";
}
else{
     $sql="INSERT INTO Bookmark(ClientId, CaseId, Bid,BName,pg, CreatedBy) VALUES ('$clientid','$caseid','$bid','$bookMarkN','$spage','$tsr')";
       echo $sql;
     if ($con->query($sql) === TRUE) {
            echo "ADDED SUCCESSFULLY";
        } else{
             echo "Error: ----->" . $sql . "<br>" . $con->error;
        }
}

        
    die();
}



if(isset($_POST['vbid'])){
        $bid= mysqli_real_escape_string($con, $_POST['vbid']);
        ?>
<!--     <table class="table table-striped table-bordered  table-hover p-0 " id='bookmtable'>
                                    <thead class="vbg text-white">
                                        <tr>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                         <th class="text-center"data-toggle="tooltip" data-placement="top" title="Book Mark"  scope="col">Book-Mark Title</th>
                                         <th class="text-center"data-toggle="tooltip" data-placement="top" title="Start page"  scope="col">Page</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Edit"  scope="col">Edit</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Delete"  scope="col">Del</th>
                                        
                                    </tr>
                               </thead>
                               <tbody>-->
<div class="accordion p-0 " id="accordionExample">
<?php
        $sql="SELECT Bookmark.Sr_no as bsr,Bookmark.pg, Bookmark.BName, BreifTimeline_data.St_pg,BreifTimeline_data.Ed_pg,BreifTimeline_data.Title,BreifTimeline_data.Sr_no as Bid,BreifTimeline_data.Date,BreifTimeline_data.Doc_type From Bookmark,BreifTimeline_data WHERE BreifTimeline_data.Sr_no = Bookmark.Bid AND Bookmark.Bid= '$bid' ORDER BY  Bookmark.pg ";
     // echo $sql;
        $quariy = $con->query($sql);
          $Sr =1;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($rows = mysqli_fetch_array($quariy)) {
                            ?>
                 
<!--                                <tr class=""table-striped'>
                                              <td class="text-center text-nowrap d-none" scope="row"style="cursor:pointer; width:6%" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Date']?>"><?php echo $rows['Date']?></td>
                                              <td class="text-center text-nowrap d-none" scope="row"style="cursor:pointer;max-width:1rem;overflow: hidden" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Doc_type']?>"><?php echo $rows['Doc_type']?></td>
                                            
                                                   <td class="text-center text-nowrap" style="cursor:pointer;max-width:8rem;overflow:hidden;"ondblclick="EdtDel(<?php echo $rows['bsr'];?>)"scope="row" Onclick='Etpg(<?php echo $rows['Bid'];?>,<?php echo $rows['pg'];?>)' data-toggle="tooltip" data-placement="top" title="<?php echo $rows['BName']?>"><?php echo $rows['BName'];?></td>
                                                    
                                                   <th class='Removes'  style="cursor:pointer;width:3%; "><a class='nav-link text-center text-primary btn_remove' Onclick='Etpg(<?php echo $rows['Bid'];?>,<?php echo $rows['pg'];?>)' ><?php echo $rows['pg']?></a></th>
                                                   <th class='d-none'  style="cursor:pointer;width:3%; "><a class='nav-link text-center text-primary 'onclick='Edit(<?php echo $rows['bsr'];?>)'>Edit</a></th>
                                                   <th class='d-none'  style="cursor:pointer;width:3%; "><a class='nav-link text-center text-danger 'onclick='Del(<?php echo $rows['bsr'];?>)'>Del</a></th>
                                                 
      
                                        </tr>-->
                                   <div class="card p-0" id="Caccordion<?php echo $rows['bsr'];?>">
    <div class="card-header p-0" id="headingOne">
      <h2 class="mb-0 p-0">
          <div class="row cc p-0">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                  <button class="btn  btn-block text-white text-center accbtn " id="acc<?php echo $rows['bsr'];?>" type="button" onclick="show(<?php echo $rows['bsr'];?>); Etpg(<?php echo $rows['Bid'];?>,<?php echo $rows['pg'];?>);" ondblclick="EdtDel(<?php echo $rows['bsr'];?>)"  data-toggle="collapse" data-target="#<?php echo $Sr; ?>" aria-expanded="true" aria-controls="collapseOne">
           <?php echo $rows['BName'];?>
        </button>
              </div>
              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 d-none">
                  <button class="btn bg-danger text-white text-center" type="button" Onclick='Etpg(<?php echo $rows['Bid'];?>,<?php echo $rows['pg'];?>)' data-toggle="collapse" data-target="#<?php echo $Sr; ?>" aria-expanded="true" aria-controls="collapseOne">
            <?php echo $rows['pg'];?>
        </button>
              </div>
          </div>
       
      </h2>
    </div>
                                        <div id="coll<?php echo $rows['bsr'];?>" class="collapse " data-parent="#accordionExample">
      <div class="card-body p-0">
          <div class="container-fluid p-0">
                 <table class="table table-striped table-bordered  table-hover p-0  bookmtables">
<!--                                    <thead class="vbg text-white">
                                        <tr>
                                           <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Sub BookMark"  scope="col">BookMark Title</th>
                                        <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Remove"  scope="col">Del</th>
                                        
                                        </tr>
                  </thead>-->
                  <?php
                  $sqls="SELECT * FROM SubBookMarks WHERE Mid= '{$rows['bsr']}'";
                  $quariys = $con->query($sqls);
          $Srs =1;
                    $num = mysqli_num_rows($quariys);
            //      echo $num;
                    if ($num >= 0) {
                        while ($rown = mysqli_fetch_array($quariys)) {
                  ?>
                  <tr>
                      <td  class="text-center " data-toggle="tooltip" data-placement="top" tilte="" scope="row" Onclick='Etpg(<?php echo $rown['Bid'];?>,<?php echo $rown['pgno'];?>)' ><?php echo $rown['SubTitle'];?></td>
                      <th  class="text-center " style="width:10%;" data-toggle="tooltip" data-placement="top" tilte="" scope="row"><a class="text-danger text-center "onclick="DelSubBM(<?php echo $rown['Sr_no'] ?>)"style="cursor:pointer;">Del</a></th>
                  </tr>
                  
                  <?php
                    }}
                  ?>
                  
                  
                  
              </table>
          </div>
      </div>
                                        </div>
         
                                       </div>
<?php
                        }
$Sr++;
                    }
                    ?>
</div>
<!--                               </tbody>
  </table>-->
                             
                                        <?php
                
        die();
}


if(isset($_POST['EBsr'])){
    $srno=  mysqli_real_escape_string($con, $_POST['EBsr']);
     $sql="SELECT * From Bookmark Where Sr_no = '$srno'";
    // echo $sql;
        $quariy = $con->query($sql);
//     echo $quariy;
          $Sr =1;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($rows = mysqli_fetch_array($quariy)) {
                            ?>
<div class="container-fluid">
    <form>
         <div class="form-group">
    <label for="exampleInputEmail1">Book Mark Title</label>
    <input type="text" class="form-control" id="BmTitle" value="<?php echo $rows['BName'] ?>">
    <input type="hidden" id="bidno" value="<?php echo $rows['Bid'];?>">
    
  </div>
         </form>
        <div class="container-fluid p-0 my-3">
             <button class="btn btn-md text-white "onclick="Editbtn(<?php echo $rows['Sr_no'] ?>)">Edit BookMark</button>
     <button class="btn btn-md text-white "onclick="Delbtn(<?php echo $rows['Sr_no'] ?>)">Delete BookMark</button>
        </div>
   
   
    
</div>
                     <?php       
                        }
                    }

    die();
}


if(isset($_POST['ReName'])){
    $bname = mysqli_real_escape_string($con, $_POST['ReName']);
    $sr= mysqli_real_escape_string($con, $_POST['EditBSr']);
    
    $sql="UPDATE Bookmark SET BName = '$bname' WHERE Sr_no = $sr";
     if ($con->query($sql) === TRUE) {
           // echo "Updated SUCCESSFULLY";
        } else{
             echo "Error: ----->" . $sql . "<br>" . $con->error;
        }
    die();
}

if(isset($_POST['DelBSr'])){
    $sr= mysqli_real_escape_string($con, $_POST['DelBSr']);
    
    $sql="DELETE FROM Bookmark WHERE Sr_no = '$sr'";
    if($con->query($sql)===True){
        echo "Delete successfully";
    }else{
        echo "ERROR=>".$sql."<br>".$con->error;
    }
    die();
}


if(isset($_POST['subBook'])){
    $CaseId = mysqli_real_escape_string($con, $_POST['subBook']);
    ?>
      
                   <div class="form-group">
                       <label for="selectbookmark">Select BookMark</label><br>
    <select classs="w-100 " id="selectbookmark" style="width:100%" >
        <option value="" selected>Please Choose BookMark </option>
                                    <?php
                                  
                                    $sql = mysqli_query($con, "SELECT * FROM Bookmark WHERE CaseId = '$CaseId'");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['BName'] . "</option>";
                                    }
                                    ?>
</select>
  </div>
                  <div class="form-group mt-2">
                      <label class="font-weight-bolder" >Sub Book-Mark Title</label>
                      <input  type="text" class="form-control"  placeholder="Enter Sub-BookMark Title" id="sbmn" />
                  </div>
                  
                  <div class="form-group mt-3">
                      <button class="btn btn-md text-white" id="subCreatebtn">Create SubBookMark</button>
          </div>
             

<?php

die();
}

if(isset($_POST['SubBookM'])){
    
    $bookMId = mysqli_real_escape_string($con, $_POST['bookMid']);
    $SubBookM = mysqli_real_escape_string($con, $_POST['SubBookM']);
    $ClinetId = mysqli_real_escape_string($con, $_POST['bclientId']);
    $CaseId = mysqli_real_escape_string($con, $_POST['bcaseId']);
    $PageNo = mysqli_real_escape_string($con, $_POST['Pageno']);
    $bids =  mysqli_real_escape_string($con, $_POST['bbids']);

    
    
    
    $sql="INSERT INTO SubBookMarks(Mid, Bid, ClinetId, CaseId, SubTitle, pgno,Status,CreatedBy) VALUES ('$bookMId','$bids','$ClinetId','$CaseId','$SubBookM','$PageNo',0,'$tsr')";

    if ($con->query($sql) === TRUE) {
           echo "Added Successfully";
        } else{
             echo "Error: ----->" . $sql . "<br>" . $con->error;
        }
  
    
    
    
    die();
}


if(isset($_POST['delsbm'])){
     $SbSr = mysqli_real_escape_string($con, $_POST['delsbm']);
     
     $sql="DELETE FROM SubBookMarks WHERE Sr_no = '$SbSr'";
        if ($con->query($sql) === TRUE) {
          echo "Deleted Successfully";
        } else{
             echo "Error: ----->" . $sql . "<br>" . $con->error;
        }
     
    
    die();
}

?>
