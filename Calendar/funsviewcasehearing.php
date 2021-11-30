
<?php

include '../Database/Dp.php';
date_default_timezone_set('Asia/Kolkata');


if(isset($_POST['addupload'])){
    
   
//    echo "<pre>";
//    print_r($_FILES);
//    print_r($_POST);
//    echo "</pre>";
    
   $cdate= date('d-m-Y');
   
    $caseId= mysqli_real_escape_string($con,$_POST['addupload']);
    $Title= mysqli_real_escape_string($con,$_POST['ATitle']);
    $Desc= mysqli_real_escape_string($con,$_POST['ADesc']);
    $Eid = mysqli_real_escape_string($con,$_POST['Eventid']);
     $Eeid = mysqli_real_escape_string($con,$_POST['EventExtraid']);
    
    
    $sql= "INSERT INTO CourtOrders(Case_id,Eid,Eeid,OTitle, ODesc, ODate) VALUES ('$caseId','$Eid','$Eeid','$Title','$Desc','$cdate')";
    //echo $sql;
        if ($con->query($sql) === TRUE) {
            
            $update= "UPDATE EventExtra SET OTitle='$Title',ODesc='$Desc',ODate='$cdate' WHERE Sr_no = '$Eeid'";
                    if ($con->query($update) === TRUE) {
                       echo "updated";
                    }else{
                          echo "Error: ----->" . $update . "<br>" . $con->error; 
                    }
        }else{
              echo "Error: ----->" . $sql . "<br>" . $con->error; 
        }
        
        
          $fpath= "Tempdata/";
  if(isset($_FILES['file'])){
      
          $file_dir =$fpath;
     $fileName = basename($_FILES['file']['name']); 
      $fileSize= basename($_FILES['file']['size']);
      $targetFilePaths = $file_dir . $fileName; 
      
       if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePaths)){
          
     
          $q="Update EventExtra SET Ofile= '$fileName' WHERE Sr_no = '$Eeid' ";
           if ($con->query($q) === TRUE) {
   //    echo "<strong style='color:green'>Uploaded Successfully...</strong>";
               echo "uploaded";
   }else{
       echo "Error: ----->" .$q . "<br>" . $con->error;
   }

      }
      else{
          echo "file Can't upload";
      }  
      
  }
//     $sql="SELECT *, CourtOrders.Sr_no as Csr FROM Client_CaseDb,CourtOrders WHERE CourtOrders.Case_id = Client_CaseDb.Sr_no AND Case_Name = '$caseName' ";
//                                       echo $sql;
    die();
}





if(isset($_POST['dyorder'])){
    
     $caseName= mysqli_real_escape_string($con,$_POST['dyorder']);
    ?>
          <div class="row">
              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 p-0">
         <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive "id="dytable">
                               <table class="table table-striped table-bordered table-hover " id='OrderList'>
                                    <thead class="cc text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">Date</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Type" scope="col">Court Name</th> 
                                                 <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title" scope="col">Title</th> 
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title" scope="col">Order Detail</th>  
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Event Title"  scope="col">upload/View</th> 
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit Event" scope="col">Edit</th> 
                                                           <th class="text-center" data-toggle="tooltip" data-placement="top" title="Remove Event" scope="col">Del</th> 
                                        </tr>
                                    </thead>
                                    <tbody id='dybody'>
                                        
                                        <?php 
                                         $sr = 1;
                                             //  $sql="SELECT *, CourtOrders.Sr_no as Csr FROM Client_CaseDb,CourtOrders WHERE CourtOrders.Case_id = Client_CaseDb.Sr_no AND Client_CaseDb.Sr_no = '$caseName' ";
//                                       echo $sql;
                                       // $sql="SELECT * FROM Client_CaseDb WHERE Case_Name = '$caseName'";
                                 //      $sql=" SELECT * FROM Events,EventExtra WHERE Events.Sr_no = EventExtra.Eid  AND EventExtra.CaseN = '37';";
//                                        echo $sql;
                                            //   $sql="SELECT *,Client_CaseDb.Sr_no as csr, Events.Sr_no as Eventsr   FROM Events,EventExtra,Client_CaseDb WHERE Events.Sr_no = EventExtra.Eid AND Client_CaseDb.Sr_no = EventExtra.CaseN  AND EventExtra.CaseN = '$caseName'";
                                        $sql= "SELECT * , EventExtra.Sr_no AS EEsr, Events.Sr_no AS Esr, Client_CaseDb.Sr_no AS csr, Events.Sr_no AS Eventsr
FROM Events , EventExtra, Client_CaseDb
WHERE Events.Sr_no = EventExtra.Eid
AND Client_CaseDb.Sr_no = EventExtra.CaseN 
AND EventExtra.CaseN = '$caseName'";
                                      //  echo $sql;
//                                         $sql="SELECT * , EventExtra.Sr_no AS EEsr, Events.Sr_no AS Esr, Client_CaseDb.Sr_no AS csr, CourtOrders.Sr_no AS COsr, Events.Sr_no AS Eventsr
//FROM EVENTS , EventExtra, CourtOrders, Client_CaseDb
//WHERE CourtOrders.Eid = EventExtra.Eid
//AND Events.Sr_no = EventExtra.Eid
//AND Client_CaseDb.Sr_no = EventExtra.CaseN
//AND EventExtra.CaseN = '$caseName'";
                                      //   echo $sql;
                                         $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
//                                                
?>
                                        <tr>
                                              <th class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo date('d-m-Y', strtotime($row['ESD'])) ?>" scope="row"><?php echo date('d-m-Y', strtotime($row['ESD'])) ?></th>
                                              <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Court_Name']; ?>" scope="row"><?php echo $row['Court_Name'];?></td>
                                             
<!--                                              <th class="text-center" onclick="dysr('<?php echo $row['csr'];?>','<?php echo $row['EEsr'];?>','<?php echo $row['Esr'];?>')" data-toggle="modal" data-target="#AddOrder" scope="row"><a class="text-primary  ">Add/Upload Order</a></th>
                                              -->
                                              
                                              <?php
                                                            if($row['OTitle'] != ''){
                             ?>      <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['OTitle']; ?>" scope="row"><?php echo $row['OTitle'];?></td>
                                              <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $row['ODesc']; ?>" scope="row"><?php echo $row['ODesc'];?></td>
                                        <th class="text-center" onclick="viewpdf('<?php echo $row['Ofile'];?>')"  scope="row"><a class="text-primary  "style="cursor: pointer;">View</a></th>
                                        <?php
                                                    }else{
                                                        ?>
                                         <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $sr; ?>" scope="row"><?php echo "Title";?></td>
                                              <td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $sr; ?>" scope="row"><?php echo "Order Details";?></td>
                                        <th class="text-center" onclick="dysr('<?php echo $row['csr'];?>','<?php echo $row['EEsr'];?>','<?php echo $row['Esr'];?>')" data-toggle="modal" data-target="#AddOrder" scope="row"><a class="text-primary  ">Add/Upload Order</a></th>
                                                        <?php
                                                    }
                                                
                                                ?>
                                              
                                        <th class="text-center" data-toggle="modal" data-target="#EditOrder" onclick="editorder('<?php echo $row['EEsr']; ?>')" scope="row"><a class="text-primary "style="cursor: pointer;">Edit</a></th>
                                               <th class="text-center"  onclick="delorder('<?php echo $row['EEsr']; ?>')"  title="<?php echo $sr; ?>" scope="row"><a class="text-danger" style="cursor: pointer;">Delete</a></th>
                                              
                                        </tr>
                                        <?php }}else{
                                            echo "No Data Founded !!!";
                                        }
                                        
?>
                                    </tbody>
                               </table>
             
         </div>
                  
              </div>
               <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 p-0" id="dypdf">
                    <div id="my_pdf_viewer" class=" ">
        
                    	<div id="navigation_controls" class="text-center cc ">
                          
                            <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                             <input class=" text-center" id="current_page" value="1" type="number"/>
                           
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
                               <input class=" text-center" id="current_page1" value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                               <button class="btn btn-primary btn-sm" id="reload1">Refresh</button>
                        </div>
     
					</div> 
                  
                   
             
               </div>
          </div>
   <?php 
    die();
}





if(isset($_POST['editids'])){
    $editId= mysqli_real_escape_string($con,$_POST['editids']);
    $sql="SELECT * FROM EventExtra WHERE Sr_no = '$editId'";
    //echo  $sql;
       $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                             
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                
                                                ?>
<form id="dyeditform">
                  <input type="hidden" name="caseid" id="caseid" value="<?php echo $row['CaseN']; ?>">
                  <input type="hidden" name="Eventid" id="eventid" value="<?php echo $row['Eid']; ?>">
                   <input type="hidden" name="EventExtraid" id="eventextraid" value="<?php echo $row['Sr_no']; ?>">
                    <div class="form-group">
    <label for="ATitle" class="font-weight-bold">Enter Title</label>
    <input type="text" class="form-control" name="ETitle" id="ETitle"placeholder="Enter title here" value="<?php echo $row['OTitle']; ?>" required>
    
  </div>
                        <div class="form-group">
    <label for="ADesc" class="font-weight-bold">Enter Description</label>
    <textarea class="form-control" name="EDesc" id="EDesc"  placeholder="Enter Description here.." required ><?php echo $row['ODesc']; ?></textarea>

  </div>
            <div class="form-group">
    <label for="AUpload" class="font-weight-bold">Upload Order Pdf</label>
    <input type="file" class="form-control" name="file" id="EFile" >
    

  </div>       
                  <button class="btn btn-sm text-white"> Edit Order</button>
                  <label id="msgedit"></label>
              </form>


<?php
                                        }}
                                        
    
    die();
}


if(isset($_POST['EventExtraid'])){
        $caseid= mysqli_real_escape_string($con,$_POST['caseid']);
         $Eventid= mysqli_real_escape_string($con,$_POST['Eventid']);
         $EventExtraid= mysqli_real_escape_string($con,$_POST['EventExtraid']);
         $ETitle= mysqli_real_escape_string($con,$_POST['ETitle']);
         $EDesc= mysqli_real_escape_string($con,$_POST['EDesc']);
         
        
         $sql="UPDATE CourtOrders SET Case_id='$caseid',Eid='$Eventid',Eeid='$EventExtraid',OTitle='$ETitle',ODesc='$EDesc'  WHERE Eeid = '$EventExtraid'";
         
            if ($con->query($sql) === TRUE) {
            
            $update= "UPDATE EventExtra SET OTitle='$ETitle',ODesc='$EDesc' WHERE Sr_no = '$EventExtraid'";
                    if ($con->query($update) === TRUE) {
                       echo "updated";
                    }else{
                          echo "Error: ----->" . $update . "<br>" . $con->error; 
                    }
        }else{
              echo "Error: ----->" . $sql . "<br>" . $con->error; 
        }
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
  $fpath= "Tempdata/";
  if(isset($_FILES['file'])){
      
          $file_dir =$fpath;
     $fileName = basename($_FILES['file']['name']); 
      $fileSize= basename($_FILES['file']['size']);
      $targetFilePaths = $file_dir . $fileName; 
      
       if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePaths)){
          
          $q="Update EventExtra SET Ofile= '$fileName' WHERE Sr_no = '$EventExtraid' ";
           if ($con->query($q) === TRUE) {
   //    echo "<strong style='color:green'>Uploaded Successfully...</strong>";
               echo "uploaded";
   }else{
       echo "Error: ----->" .$q . "<br>" . $con->error;
   }

      }
      else{
          echo "file Can't upload";
      }  
      
  }
    die();
}



if(isset($_POST['deleteorderid'])){
    $id= mysqli_real_escape_string($con,$_POST['deleteorderid']);
  

        $update= "UPDATE EventExtra SET OTitle='',ODesc=''  WHERE Sr_no = '$id'";
                    if ($con->query($update) === TRUE) {
                       echo "updated";
                    }else{
                          echo "Error: ----->" . $update . "<br>" . $con->error; 
                    }
    
//    echo $id;
    die();
}



if(isset($_POST['viewpdfs'])){
    $soruce = mysqli_real_escape_string($con,$_POST['viewpdfs']);
   $source= "Calendar/Tempdata/$soruce";
   //  echo $source;
    
    ?>
<div id="my_pdf_viewer" class=" ">
   
        
                    	<div id="navigation_controls" class="text-center cc ">
                          
                            <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                             <input class=" text-center" id="current_page" value="1" type="number"/>
                           
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
                               <input class=" text-center" id="current_page1" value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                               <button class="btn btn-primary btn-sm" id="reload1">Refresh</button>
                        </div>
     
					</div> 

<script>
  //  viewpdfdata('<?php echo $source; ?>');
   //  const viewdatapdf = viewpdfdata = (source) =>{
//    function viewpdfdata(soruce){
        
        var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1,
       cache: true
    }
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
		 
		page.render({
			canvasContext: ctx,
			viewport: viewport
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

