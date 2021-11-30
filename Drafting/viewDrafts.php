<?php
include '../UploadCase/Dp.php';
ini_set('session.save_path', '../session');

session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    
    
}else{
//        
        header("Location:http://apajuris.in/work/index.php");
       die();
} 


if(isset($_POST['Dupdate'])){
    
//    echo "<pre>";
//    print_r($_POST);
//    echo  "</pre>";
     $Sr = mysqli_real_escape_string($con,$_POST['srno']);
    $Clientid = mysqli_real_escape_string($con,$_POST['ClientId']);
    $Caseid = mysqli_real_escape_string($con,$_POST['CaseId']);
    $Draftid = mysqli_real_escape_string($con,$_POST['DraftId']);
    $Statusid = mysqli_real_escape_string($con,$_POST['StatusId']);
    $Drafttype = mysqli_real_escape_string($con,$_POST['DraftType']);
    $Statusn = mysqli_real_escape_string($con,$_POST['DraftStatus']);
    $DTitle = mysqli_real_escape_string($con,$_POST['DTitle']);
    $DDesc = mysqli_real_escape_string($con,$_POST['DDesc']);
    
    
   $q= "UPDATE Drafting SET ClientId='$Clientid',CaseId='$Caseid',DraftId='$Draftid',StatusId='$Statusid',Dtype='$Drafttype',Status='$Statusn',DTitle='$DTitle',DDesc='$DDesc' WHERE Sr_no = '$Sr'";
  // echo  $q;
   if ($con->query($q) === TRUE) {
       header("Refresh:0");
   }else{
       echo "Error: ----->" .$q . "<br>" . $con->error;
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
    
    
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
 <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="../assets12/css/sam.css">
          <link rel="stylesheet" href="../Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="../ckeditor/ckeditor.js"></script>
    <title>View Drafts</title>
    
    <style>
        
/*        .cc .btn{
        background:teal;
        
    }*/
/*    .vc {
        height:32px;
    }*/
   .active{
        background:#40e0d0;
        padding:8px;
    }
   .modal-xl {
    max-width: 60% !important;
}
    </style>
  </head>
  <body>
      
       <div class="topnav" id="myTopnav">


        <a href="../Cms.php" class="nav__link">DashBoard</a>
        <a href="../Teams.php" class="nav__link" id="TM">Team</a>
         <a href="../task.php" class="nav_link">Task Management</a>
         <a href="../calendar.php" class="nav_link">Calendar</a>
        <a href="../library.php" class="nav__link">Library</a>
        <a href="../knowledge.php" class="nav__link ">Knowledge</a>
        <a href="../Clients.php" id="CM"class="nav__link">Clients </a>
       
        <a href="../Drafting.php"class="nav_link active">Drafting</a>
          <a href="../editor.php" class="nav_link" id='ed'>Editor</a>
               <a href="../Pleadings.php"class="nav_link"id="pl">Pleading</a>
      
<!--        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>-->
        <a href="#" class="nav__link">Control panel</a>
        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>

         <p class="mt-1 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV; ?></p>

<!--        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>-->

    </div>
       <div class="container-fluid vbg">
             <a href="../Drafting.php" class="nav__link text-white  ml-2  mt-2 ">Create Drafts</a>
            <a href="viewDrafts.php" class="nav__link text-white  ml-3  mt-2 active ">View Drafts</a>
             <a href="Draftsplit.php" class="nav__link text-white  ml-3  mt-2 ">Draft Split-View</a>
             <a href="DelDraft.php" class="nav_link text-white ml-3 mt-2 ">Delete Drafts</a>
      </div>

      
      
<!--      <h1 class="text-center text-danger"  >Under Development > <a href='../Drafting.php' class='btn btn-danger'>Back on Drafting</a></h1>-->

      <div class="container-fluid p-0">
          
          <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">
               <table class="table table-striped table-bordered   table-hover " id='UserList'>
                                    <thead class="vbg text-white">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                             <th class="text-center" data-toggle="tooltip" data-placement="top" title="Client Name" scope="col">Client Name</th>
                                              <th class="text-center" data-toggle="tooltip" data-placement="top" title="Case Name" scope="col">Case Name</th>
                                               <th class="text-center" data-toggle="tooltip" data-placement="top" title="Draft Type" scope="col">Draft Type</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top" title="Draft Name" scope="col">Draft Name</th>
                                                 <th class="text-center" data-toggle="tooltip" data-placement="top" title="Lastupdate" scope="col">Last Update</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="Lastupdate" scope="col">Last Edited By</th>
                                                   <th class="text-center" data-toggle="tooltip" data-placement="top" title="Lastupdate" scope="col">Status</th>
                                                  <th class="text-center" data-toggle="tooltip" data-placement="top" title="View" scope="col">View</th>
                                                   <th class="text-center" data-toggle="tooltip" data-placement="top" title="Update Draft" scope="col">Update Draft</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Edit" scope="col">Edit</th>
                                                     <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;

                                  
                                   $sql="SELECT Drafting.Status, Drafting.last_Edtied, Drafting.Sr_no,Drafting.ClientId, Drafting.Times, Drafting.CaseId,Drafting.Dtype,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId  AND Drafting.DelStatus = '0'";
                                        //echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
//                                                   echo "<pre>";
//                                                   print_r($row);
//                                                   echo "</pre>";
                                                ?>
                                                <tr>
                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                                            <td class=" text-nowrap text-center" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Full_Name']?>"><?php echo substr($row['Full_Name'],0,30);?></td>
                                             <td class=" text-nowrap text-center" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_Name']?>"><?php echo substr($row['Case_Name'],0,30);?></td>
                                    <td class=" text-nowrap text-center" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Dtype']?>"><?php echo substr($row['Dtype'],0,30);?></td>
                                    <td class=" text-nowrap text-center " scope="row"style=""data-toggle="tooltip" title="<?php echo $row['DTitle']?>"><?php echo substr($row['DTitle'],0,30);?></td>
<!--                                    <td class=" text-nowrap text-center" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Times']?>"><?php echo substr($row['Times'],0,30);?></td>-->
                                    <td class=" text-nowrap text-center" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Times']?>"><?php echo date('d-m-Y h:i A', strtotime($row['Times']))?></td>
                                    
                                     <td class=" text-nowrap text-center" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['last_Edtied']?>"><?php echo substr($row['last_Edtied'],0,30);?></td>
                                     <td class=" text-nowrap text-center" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Status']?>"><?php echo substr($row['Status'],0,30);?></td>
                                    
                                    <td class=" text-center text-nowrap" scope="row"style="cursor: pointer;"><a class='nav_link ' data-toggle="modal" data-target="#viewContent" onclick="content('<?php echo $row['Sr_no'];?>')" >View</a></td>
                                    <td class=" text-center text-nowrap" scope="row"style="cursor: pointer;"><a class="nav__link "href="../Drafting.php?d=<?php echo $row['Sr_no']?>">Update Draft</a></td>
                                    <td class=" text-center text-nowrap" scope="row"style="cursor: pointer;"><a class="nav__link" data-toggle="modal" data-target="#EditBasic" onclick="editbasic('<?php echo $row['Sr_no'];?>')">Edit</a></td>
                                    <td class=" text-center text-nowrap" scope="row"style="cursor: pointer;"><a class='text-danger' href="function.php?d=<?php echo $row['Sr_no']?>" >Delete</a></td>
                                    
                                    
                                                                
                                                                
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
      
      <div class='Modals'>
          <!-- Modal -->
<div class="modal fade" id="viewContent" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Draft-Content</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class='container-fluid p-0' id='dycontent'>
                <textarea id="editor" name="content" onkeyup="myFunction()"></textarea>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
          
      </div>



<div class='modals'>
        
<!-- Modal -->
<div class="modal fade" id="EditBasic"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-xl modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Draft</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div Class='Container-fluid' id='dyedit'>
              
              
          </div>
          
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="AddDraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <div class="form-group">
                  <label for="Dadd">Draft Title</label>
                  <input type="text" class="form-control" id="Dadd" placeholder="Enter Draft Type">
            </div>
           <button class="btn-sm btn mt-1 mb-1 text-white" id="Daddbtn"> Add Type</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="EditDraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
          
           <label class="font-weight-bold">Select Draft Type</label><br>
              <select style="width:100%" id="Dedit" onchange="document.getElementById('NewDtype').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Draft Type</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM DraftTypes");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DName']."</option>";
}
?>
              </select>
             <input class="form-control mt-3" type="text"  id="NewDtype" placeholder="Edit Draft Type">
             
              <button type="button" id="Deditbtn" class="btn btn-primary mt-2" >Edit Draft Type</button>
          
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Del Draft Modal -->
<div class="modal fade" id="DelDraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
                <label class="font-weight-bold">Select Draft Type</label><br>
              <select class=""style="width:100%" id="DDel">
   <option value="" disabled selected>Please Choose Draft Type</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM DraftTypes");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DName']."</option>";
}
?>
              </select><br>
              <button type="button" id="DDelbtn" class="btn btn-primary mt-2" >Delete Draft Type</button>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>




<div class="modal fade" id="AddStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <div class="form-group">
                  <label for="Sadd">Status Title</label>
                  <input type="text" class="form-control" id="Sadd" placeholder="Enter Status">
            </div>
           <button class="btn-sm btn mt-1 mb-1 text-white" id="Saddbtn"> Add Status</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="EditStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
          
           <label class="font-weight-bold">Select Status</label><br>
              <select style="width:100%" id="Sedit" onchange="document.getElementById('NewStatus').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Status</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM DStatus");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DStatus']."</option>";
}
?>
              </select>
             <input class="form-control mt-3" type="text"  id="NewStatus" placeholder="Edit Status">
             
              <button type="button" id="Seditbtn" class="btn btn-primary mt-2" >Edit Status</button>
          
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Del Draft Modal -->
<div class="modal fade" id="DelStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
                <label class="font-weight-bold">Select Status</label><br>
              <select class=""style="width:100%" id="SDel">
   <option value="" disabled selected>Please Choose Status</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM DStatus");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DStatus']."</option>";
}
?>
              </select><br>
              <button type="button" id="SDelbtn" class="btn btn-primary mt-2" >Delete Status</button>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>




<div class="modal fade" id="uploaddraft" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <div class="form-group">
               <h5 class="text-center"> This modal is under development </h5>
                  <label for="Sadd">Upload Final Draft</label>
                  <input type="file" class="form-control" id="Sadd" placeholder="">
            </div>
<!--           <button class="btn-sm btn mt-1 mb-1 text-white" id="Saddbtn"> Add Status</button>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>


    </div>
      
<script>
      $('select').select2();
    
         $("#DClient").on("change",function(){
             var category = $("#DClient").val();
             var cid= JSON.stringify(category);
      $.ajax({
        url :"function.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
            $("#DCase").html(data);
          
        }
      });
         });
 
  $("#Casenamed").on("change",function(){
     var category = $("#Casenamed").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"function.php",
        type:"POST",
        cache:false,
        data:{caseId:cid},
        success:function(data){
            console.log(data);
           $("#DraftDy").html(data);
          
        }
      });
 });
  </script>
      <script>
          
          CKEDITOR.replace('editor',{
                          
                        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', '../css/smallckeditor.css' ],
                        
                        bodyClass: 'document-editor',
      height: 800,
     
      
      font_names:'Arial;Times New Roman; Verdana',
      
      
      toolbar: [
			{ name: 'document', items: [  'zoom' ] },
			{ name: 'clipboard', items: [ 'Undo', 'Redo'  ] },
			{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			{ name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
//			{ name: 'links', items: [ 'Link', 'Unlink' ] },
//			{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
			{ name: 'insert', items: [  'Table','lineheight' ] },
			{ name: 'tools', items: [ 'Maximize','find'] },
			//{ name: 'editing', items: [ '','find','selection' ] },
                        { name: 'editing', items: [ 'find', 'selection', 'spellchecker', 'editing' ] }
		],
                
                
                
                
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
      extraPlugins:'zoom',
      extraPlugins:'lineheight',
     readOnly:true,
     line_height:"1;1.5;2;2.5;3;4",
    
    });
   
          
          
          </script>
          
      
      <script>
           $('#UserList').DataTable({
//        "pagingType":"full_numbers",
        "bFilter": true,
        "bInfo": true,
        "lengthMenu":[
            [15,25,50,-1],
            [15,25,50,"All"]
        ],
        responsive:true,
        language:{
          //"search": "_INPUT_",
           searchPlaceholder:"Search Drafts",
    
        }
    });
    
    function editbasic(sr){
//        alert(sr);
$.ajax({
    type:'post',
    url:'function.php',
    data: {editid:sr},
   success:function(data){
            //console.log(data);
           $("#dyedit").html(data);
          //alert(data);
            $('select').select2();
            $("#DClient").on("change",function(){
             var category = $("#DClient").val();
             var cid= JSON.stringify(category);
      $.ajax({
        url :"function.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
           // console.log(data);
            $("#DCase").html(data);
          
        }
      });
         });
         document.getElementById("Daddbtn").addEventListener("click", addD);
            function addD() {
                var Dtype=$('#Dadd').val();
                //alert(Dtype);
                var dtype = JSON.stringify(Dtype);

                $.ajax({
                    type: "POST",
                    url: "function.php",
                    data: {Dtype: dtype},
                    success: function (res) {
                        console.log(res);
                        //alert(res);
                        location.reload();
                    }

                });

            }
                
                document.getElementById("Deditbtn").addEventListener("click", editD);
            function editD() {
                
                   var sr=document.getElementById('Dedit').value;
      var Rename=document.getElementById('NewDtype').value;
      console.log(sr);
      console.log(Rename);
      var cid= JSON.stringify(sr);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "function.php", 
       data: {srEdit:cid,rename:renames},
      success: function(res) { 
        console.log(res);
       // alert(res);
      location.reload();
 } 
       
});
                
            }
            
           
               document.getElementById("DDelbtn").addEventListener("click", DelD);
            function DelD() {
                var did= $('#DDel').val();
                var Did = JSON.stringify(did);

                $.ajax({
                    type: "POST",
                    url: "function.php",
                    data: {Did: Did},
                    success: function (res) {
                        console.log(res);
                       // alert(res);
                        location.reload();
                    }

                });  
            }
            
             document.getElementById("Saddbtn").addEventListener("click", addS);
            function addS() {
                var Sstatus=$('#Sadd').val();
                 //alert('Add Status '+Sstatus);
                 var Ss = JSON.stringify(Sstatus);

                $.ajax({
                    type: "POST",
                    url: "function.php",
                    data: {Sstatus:Ss },
                    success: function (res) {
                        console.log(res);
                        //alert(res);
                        location.reload();
                    }

                });
                 
            }
                document.getElementById("Seditbtn").addEventListener("click", editS);
            function editS() {
                var sr=document.getElementById('Sedit').value;
      var Rename=document.getElementById('NewStatus').value;
      var cid= JSON.stringify(sr);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "function.php", 
       data: {SrStatus:cid,StatusN:renames},
      success: function(res) { 
        console.log(res);
        //alert(res);
      location.reload();
 } 
       
});       
    }
            
            
            document.getElementById("SDelbtn").addEventListener("click", DelS);
            function DelS() {
                
                var did= $('#SDel').val();
                   //alert('Delete Status '+did);
                   var Did = JSON.stringify(did);

                $.ajax({
                    type: "POST",
                    url: "function.php",
                    data: {Sid: Did},
                    success: function (res) {
                        console.log(res);
                            //alert(res);
                     location.reload();
                    }

                });
            }
         
         
         
          
        }//success body
  });//ending of ajax


    }
    
    
          function content(sr){
  $.ajax({
    type:'post',
    url:'function.php',
    data: {contentid:sr},
   success:function(data){
            //console.log(data);
          // $("#editor").html(data);
          CKEDITOR.instances['editor'].setData(data);
           
          
        }
  });

          }
</script>

<script>
        function updateUserStatus(){
  $.ajax({
    url:'../Status/updateStatus.php',
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
            var activeon = 'View Drafts';
  $.ajax({
    type:'post',
    url:'../Status/updateStatus.php',
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