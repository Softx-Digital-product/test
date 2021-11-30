<?php
include '../UploadCase/Dp.php';
ini_set('session.save_path', '../session');
session_start();
 $Dtitle ="Please Choose Draft Name"; $ClientName="Please Choose Client Name"; $CaseName="Please Choose Case Name"; $clientid; $caseid; $Dcontent;
 
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    
}else{
        header("Location:http://apajuris.in/work/index.php");
       die();
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

    <title>Delete Drafts</title>
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
            <a href="viewDrafts.php" class="nav__link text-white  ml-3  mt-2 ">View Drafts</a>
             <a href="Draftsplit.php" class="nav__link text-white  ml-3  mt-2 ">Draft Split-View</a>
             <a href="DelDraft.php" class="nav_link text-white ml-3 mt-2 active">Delete Drafts</a>
      </div>
      
     
      
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
                                                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Restore Draft" scope="col">Restore</th>
<!--                                                     <th class="text-center" data-toggle="tooltip" data-placement="top" title="Delete" scope="col">Delete</th>-->
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="dytable">

                                        <?php
                                        $sr = 1;

                                  
                                   $sql="SELECT Drafting.Status, Drafting.last_Edtied, Drafting.Sr_no,Drafting.ClientId, Drafting.Times, Drafting.CaseId,Drafting.Dtype,Drafting.DTitle,Drafting.DContent, ClientDb.Full_Name, Client_CaseDb.Case_Name FROM Drafting,ClientDb,Client_CaseDb WHERE ClientDb.Sr_no = Drafting.ClientId AND Client_CaseDb.Sr_no = Drafting.CaseId  AND Drafting.DelStatus = '1'";
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
                                    
                                    <td class=" text-center text-nowrap" scope="row"style=""><a class='nav_link ' data-toggle="modal" data-target="#viewContent" onclick="content('<?php echo $row['Sr_no'];?>')" >View</a></td>
                                    <td class=" text-center text-nowrap" scope="row"style=""><a class="nav__link "href="../Drafting.php?d=<?php echo $row['Sr_no']?>">Update Draft</a></td>
<td class=" text-center text-nowrap" scope="row"style=""><a class='text-success' href="function.php?r=<?php echo $row['Sr_no']?>" >Restore</a></td>
<!--                                    <td class=" text-center text-nowrap" scope="row"style=""><a class='text-danger' href="function.php?d=<?php echo $row['Sr_no']?>" >Delete</a></td>-->
                                    
                                    
                                                                
                                                                
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
      
      
      
      <script>
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
            var activeon = 'Deleted Draft';
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
        <script>
          
          CKEDITOR.replace('editor',{
                          
                        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', '../css/Ckeditor.css' ],
                        
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
 
       
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
  </body>
</html>