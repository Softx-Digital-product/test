
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
          <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <title>Training</title>
    <style>
        #dycontents{
            height:100%;
        }
     
        
        .tds{
            width:1000px;
        }
        
    </style>
  </head>
  <body>
           <?php 
           include 'Database/Dp.php';
           include 'Navbars.php';
           include 'Training/Modals.php';
           ?>
       <div class="topnav1">
          <a id="cp" href="#" class="nav__link  active">Training Video Gallery</a>
          <a id="" href="#" class="nav__link " data-toggle="modal" data-target="#UploadTrainingVideo">Upload Training Video </a>
         </div>
      
      
       <h1 class="text-center text-warning d-none"> Under Development</h1>
      <div class="container-fluid" id="dycontents">
       
      </div>
      
      
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script>
             $('#mybottomnav').remove();
             $("#CM").removeClass('active');
                $("#tr").addClass("active");
                
                $('select').select2();
                function allready(){
                     $.ajax({
                    url:"Training/functions.php",
                     cache: false,
                     type:"POST", 
                   data: {status: 1},
                        success: function (data) {
                            console.log(data);
                            $("#dycontents").html(data);
                            
 $('#Vidoeslists').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "sort":true,
            "lengthMenu": [
                [ 5, -1],
                [ 5, "All"]
            ],
            
            responsive: true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Videos"
            },
//        "columnDefs": [
//    { "width": "100%", "targets": 0 }
//  ]
  bAutoWidth: false, 
  aoColumns : [
    { sWidth: '15%' },
  ]
            
            
        });
        
        
                }

                });
                    
                }
                $( document ).ready(function() {
              allready();
              
          
});
               
                
                  $("#VideosMetaData").on("submit",function(e){
         e.preventDefault();
                 var formData= new FormData(this);
                  
                  $.ajax({
                     url:'Training/functions.php',
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                     
                       beforeSend: function () {
                           $('.message').html("<strong class='text-warrning'>Uploading</strong>");
//                         $('.progress').removeClass('d-none');
                          var percentValue = '0%';

    	            $('.progress-bar').width(percentValue);
    	            $('#percent').html(percentValue);
//                           $('#uploaddraft').modal('toggle');
//          $('.alertTxt').html("<strong style='color:#ff7f50;'>Upload Final Draft..</strong>");
        },
//                  uploadProgress: function(event, position, total, percentComplete) {
//            var percentVal = percentComplete + '%';
//            console.log(percentVal);
//            $('.progress-bar').width(percentVal);
//            $('#percent').html(percentVal);
//        },
               
                
                     success : function(data){
                           $('.message').html("<strong class='text-success'>uploaded</strong>");
                         $('#VideosMetaData').trigger('reset');
                         $('#UploadTrainingVideo').modal('toggle');
                 //   $('.alertTxt').html(data);
                 console.log(data);
                 allready();
    }
    
                  });
                         
    });
    
    $("#Category").on("change",function(){
     var category = $("#Category").val();
     
     
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

    
    
    
    function playVidoe(sr,vname){
        var vurl="TrainingVideos/"+vname;
       $('#mainplayer').attr('src', vurl);
        $('#mainplayer').attr('autoplay',true);
        
    }
    function Details(sr){
      //  alert(sr);
     $.ajax({
        url :"Training/functions.php",
        type:"POST",
        cache:false,
        data:{Details:sr},
        success:function(data){

          $("#VideoDetails").html(data);
        }
      });
        $("#VideosData").modal("toggle");
        
        
    }
    
    function TVEdit(sr){
      //  alert("Editing Under Development "+sr);
      
      
        
    }
    function TVDel(sr){
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this  file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      
      $.ajax({
           url :"Training/functions.php",
        type:"POST",
        cache:false,
        data:{TVDel:sr},
        success:function(data){
            allready();
             swal("Deleted Successfully!", {
      icon: "success",
    });
            
    }
                        });
      
   
  } 
});
       
    }
    </script>
    
    
    
    
     <script>
        function updateActivity(){
            var activeon = 'Training';
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