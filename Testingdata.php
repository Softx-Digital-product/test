
<?php
include 'KnowledgeDb/Dp.php';
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
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    

    

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

        
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
      <script src="ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
     <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        
    <script>
       
        
         $(document).ready(function () {
 $('select').select2();
      });
        </script>
    <title>View Knowledge</title>
  </head>
  <style>
      
      #content{
    font-size: 20px;
    height:1100px;
    overflow:auto;
/*    border-right: 2px solid black;*/
   
}

      .common{
          width:8%;
      }
      .sr{
          width:1%;
      }
      .dates{
          width:15%;
      }
     .tooltip{
          color:white;
/*          background-color:blue;*/
      }
      .tooltip-inner {
    background-color:  #00ace6;
}
      
/*     div.dataTables_filter, div.dataTables_length {
 margin-top:20px;
 padding-right:20px;
  padding-left:10px;

   text-transform: uppercase;

} 

div.dataTables_filter {
   
     margin-left: -29rem;
     margin-right: 1rem;
}
div.dataTables_wrapper{
    
}
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: .5em;
    display: inline-block;
    width: 24rem !important;
    margin-left: -1rem;
    
    margin-right: 5rem !important;
}
div.dataTables_filter input{
    width:2rem !important;
}
input {
    width:100px !important;
    
}
.dataTables_filter input { width: 150px }*/


select{
    width:100px;
}
body{
    font-family:verdana;
}
  </style>
  <body>
      

<div class="topnav" id="myTopnav">


        <a href="Cms.php" class="nav__link" id="ds">DashBoard</a>
        <a href="Team.php" class="nav__link" id="TM">Team</a>
        <a href="Task.php" class="nav_link">Task Management</a>
        <a href="calendar.php" class="nav_link " id="cl">Calendar</a>
        <a href="library.php" class="nav__link">Library</a>
        <a href="knowledge.php" class="nav__link active "id="kn">Knowledge</a>
        <a href="Clients.php" id="CM"class="nav__link ">Clients </a>
        
        <a href="Drafting.php"class="nav_link" id='df'>Drafting</a>
               <a href="Pleadings.php"class="nav_link"id="pl">Pleading</a>
<!--        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>-->
        <a href="#" class="nav__link">Control panel</a>




        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>

         <p class="mt-2 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV ?></p>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>

       <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
         <div class="topnav1" id="myTopnav">
             <a href="knowledge.php" class="nav__link" >Add Knowledge</a></li>
         <a href="TestingDS.php" class="nav__link active">View Knowledge</a></li>
         </div>
        
 

    
    <div class="container-fluid">
  <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 p-0">
        <div class="container-fluid p-0">
<!--<input type="text" class="form-control-sm ml-6" id="search" placeholder="Search Bar" >-->
           
<div class="tables  table-bordered  table-responsive p-0 dytable">
  <table class="table table-striped  table-hover" id="Mytable">
<!--               <input type="hidden" class="form-control mt-5" id="search" placeholder="Search Bar" >-->
  <thead class="vbg text-white"> 
    <tr>
      <th class="text-center" scope="col">SRN</th>
      <th scope="col" style="display:none">Category</th>
<!--      <th scope="col"style="display:none">title</th>-->
          <th class="text-center" scope="col" style="display:none">content</th>
         <th class="text-center" scope="col">Title</th>
       <th  class="text-center d-none" scope="col">Date</th>
       <th class="text-center" scope="col">Edit</th>
      <th class="text-center" scope="col">View</th>
       <th class="text-center"  scope="col">Delete</th> 
    </tr>
 </thead> 
  <tbody id="tbody">
      <tr>
  <?php
  
    

  $sr=1;
            $quariy = $con->query("SELECT * FROM knowledge_data"); 
            $num = mysqli_num_rows($quariy);
            if($num>=0){
             while ( $row = mysqli_fetch_array($quariy) ) {
               ?>
      <th class="text-center sr" scope="row""><?php echo $sr?></th>
       <td scope="row"style="display:none"><?php echo $row['K_Category']?></td>
<!--       <td scope="row"style="display:none"id="Ctitle"  data-toggle="tooltip" title="<?php echo $row['K_Title']?>"><?php echo $row['K_Title']?></td>-->
       <td scope="row"style="display:none"><?php echo $row['K_Content']?></td>
     <td class="text-center title" scope="row"style="" class="text-nowrap" data-toggle="tooltip" title="<?php echo $row['K_Title']?>" onclick="view('<?php echo $row['Sr_no']?>')"><?php echo substr($row['K_Title'],0,40);?></td>
<!--        <td scope="row"style=""><?php echo $row['K_Title']?></td>-->
     <?php  $row['K_Date'] = date('d-m-Y', strtotime($row['K_Date']));?>
     <td class="text-center dates d-none" scope="row"style=""><?php echo $row['K_Date']?></td>
<!--      <td class="text-center common" scope="row"style=""><a href="KnowledgeDb/EditFKD.php?v=<?php echo $row['Sr_no']?>"class="nav_link ">Edit</a></td>-->
      <td class="text-center common" scope="row"style="cursor:pointer;" onclick="editfun('<?php echo $row['Sr_no'];?>')"><a class="nav_link ">Edit</a></td>
      
<!--      <td class="text-center" scope="row"style=""><a href="knowledge.php?v=<?php echo $row['Sr_no']?>"class="nav_link ">Edit</a></td>-->
      
           <td class="text-center common" scope="row"style="cursor:pointer" onclick="view('<?php echo $row['Sr_no']?>')";><a  id="viewbtn"   class="nav_link" value="<?php echo $row['Sr_no']?>" >View</a>
               
      <td  class="text-center common" scope="row"style="cursor:pointer;"><a onclick="del('<?php echo $row['Sr_no'];?>')"class="nav_link text-danger text-center">Delete</a></td>
      

       </tr>
    <?php
     $sr++;
}
     }
     

?>
            
  </table>
        </div>
            
        </div>
    </div>


     
 
    <div class="col-lg-7 col-md-7 col-sm-12 p-0">
   
    <div class='container-fluid'>
        <div  class='mt-2 dycontents'id='content' >
            
        </div>
<!--        <label  class="mt-5 shadow p-1 mb-5 bg-white rounded"id="content"></label>-->
        
        
    </div>
    
    
    </div>
  </div>
</div>
    
        
        
        
        
          <script>
           
              
               $("#date").datepicker({ dateFormat: 'dd/mm/yy',});
  
              
               $(document).ready(function () {
                   
                   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
                   
//                   $(function() {
//    $( '#Ctitle' ).tooltip({ content: $('#Ctitle').html() });
//    ;
//});

              

                   
    });
    
    
    
 del = (sr)=>{
    
     swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this knowledge Data!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      
     $.ajax({
   url: "KnowledgeDb/function.php", 
   type:"POST",
   cache:false,
   data:{DelKId:sr},
   success:function(res){
         $('.dytable').html(res);
                         
        $('#Mytable').DataTable({

        "bFilter": true,
        "bInfo": true,
        "lengthMenu":[
            [10,25,50,-1],
            [10,25,50,"All"]
        ],
        responsive:true,
        language:{
            "search": "_INPUT_",
            
           searchPlaceholder:"Search Knowledge",
   
        }
    });
       
   }
     });
       swal("Your Knowledge Data has been deleted!", {
      icon: "success",
   
    });
  } else {
  
  }
});
     
 }
 
          
    editfun = (sr) => {
 console.log(sr);
 
 $.ajax({
   url: "KnowledgeDb/function.php", 
   type:"POST",
   cache:false,
   data:{EditKId:sr},
   success:function(res){
       console.log(res);
           $('#content').removeAttr('id');
            $('.dycontents').html(res);
          $("#date").datepicker({ dateFormat: 'dd/mm/yy',});
        $('select').select2();
        
        
         $("#Category").on("change",function(){
             
     var category = $("#Category").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"KnowledgeDb/TestingData.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
                
          $("#SubCategory").html(data);
        } 
    });
 }); 
        CKEDITOR.replace('editor',{
      contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', 'css/smallckeditor.css' ],
                        
                        bodyClass: 'document-editor',
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
    
//    $("#updatekdata").on("submit",function(e){
//         e.preventDefault();
//                 var formData= new FormData(this);
//                 
//                 console.log(formData);
//    });
//    
//var form = $('form')[0]; 
//console.log(form);
$('#updatekdata').click(function(e){
     e.preventDefault();
     var categroyid= $('#Category').val();
     var txtCategory = $('#text_content').val();
     var SubCategoryid = $('#SubCategory').val();
     var txtSc = $('#text_SC').val();
     var date= $('#date').val();
     var typeid= $('#type').val();
     var txttype= $('#text_CT').val();
     var title= $('#titles').val();
     var sr= $('#sr').val();
     
      var desc = CKEDITOR.instances['editor'].getData();
           var editors=JSON.stringify(desc);
     
//     var formData = new FormData(form);
     //var formData= new FormData('#formdyk');
    // console.log(formData);
    $.ajax({
                     url: "KnowledgeDb/function.php", 
                     type:"POST",
                     data:{updatekdata:1,srid:sr,catid:categroyid,txtcate:txtCategory,scid:SubCategoryid,txtsc:txtSc,date:date,typeid:typeid, txtype:txttype,title:title,editor:editors},
                     beforeSend: function () {
          $('.alertTxt').html("<strong style='color:#ff7f50;'>Updating...</strong>");
        },
                     success:function(res){
                         console.log(res);
                         $('.dytable').html(res);
                         
        $('#Mytable').DataTable({

        "bFilter": true,
        "bInfo": true,
        "lengthMenu":[
            [10,25,50,-1],
            [10,25,50,"All"]
        ],
        responsive:true,
        language:{
            "search": "_INPUT_",
            
           searchPlaceholder:"Search Knowledge",
   
        }
    });
     view(sr);
                     }
                     
        });
     
//     console.log(e);
//     console.log(formData);
});
//    
   }//end of success block
   
   
 });//end of ajax block
 
 
  
  
}




         
     
              
              function view(no){
                  console.log(no);
                  $(".dycontents").attr('id', 'content');
                   $.ajax({
        url :"KnowledgeDb/ViewKD.php",
        type:"POST",
        cache:false,
        data:{countryId:no},
        success:function(data){
            console.log(data);
           //$('#content').removeAttr('id');
            $('#content').html(data);
            
           
        }
      });
              };
              
        $(document).ready(function() {
 //$('select').select2();
//              $(document).ready(function(){
//   
//    $("#viewbtn").click(function(){
//         //$("#viewbtn").on("change",function(){
//      var Id = $(this).val();
//      $.ajax({
//        url :"KnowledgeDb/ViewKD.php",
//        type:"POST",
//        cache:false,
//        data:{countryId:Id},
//        success:function(data){
//            console.log(data);
//        }
//      });
//    });
//    });
//    
            
            
            
    $Tdata = $('#Mytable').DataTable({
//        "pagingType":"full_numbers",
        "bFilter": true,
        "bInfo": true,
        "lengthMenu":[
            [10,25,50,-1],
            [10,25,50,"All"]
        ],
        responsive:true,
        language:{
            "search": "_INPUT_",
            
           searchPlaceholder:"Search Knowledge",
    
        }
//        search: {
//            "addClass":"form-control input-lg col-xs-12"
//        }
    });
    
//    $('#search').keyup(function(){
//      $Tdata.search($(this).val()).draw() ;
//});
});
    
    </script>
 
    

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
 <script>
       function updateUserStatused(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){
    }
  });

}
setInterval(function(){
updateUserStatused();
},3000);
    </script>
                 <script>
        function updateActivity(){
            var activeon = 'View Knowledge';
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
         
  </body>
</html>