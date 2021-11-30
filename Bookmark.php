<?php include 'Database/Dp.php';


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

 
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
           <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
          <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

          <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
   <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>    
        
         <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <style>
       .Sidebtns{
            position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
       }
       .Sidebtns button{
            padding:12px;
               margin:5px;
           display: block;
  text-align: center;
  transition: all 0.3s ease;
  
       }
       .RSidebtns{
           border:2px solid black;
           background-color: rgba(0, 128, 128, 0.2);
            position: fixed;
  top: 48%;
  right:2%;

  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
       }
         .RSidebtns button{
               padding:15px;
               margin:5px;
           display: block;
  text-align: center;
  transition: all 0.3s ease;
  background: #0f5353;
         }
        
        .tooltip { 
    pointer-events: none;
}

.vbg{
    height:40px;
}
.cc{
    background-color: #008080;
}
          .cc .btn{
             
    margin-top: 2px;
    background: #0f5353;
/*    padding:6px;*/
    margin-bottom:5px;
}
         .cc  input{
             padding:0px;
             height:-1px;
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
}
.vbg selete{
       padding:0px;
/*             height:-1px;*/
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
}
.form-group{
     margin-top: 5px;
    margin-bottom: 0px;
} 
 .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color:#40e0d0;
}

.dybooksmarks{
  overflow:auto;
}

#dyBookmarks{
        overflow: auto;
    height: 750px;
}

</style>
    
    <title>Book-Mark</title>
    
  </head>
  <body>
       <?php include 'Navbars.php';?>
      <div class="topnav1">
          <a id="cp" href="Pleadings.php" class="nav__link  ">Create Pleadings</a>
          <a id="vp" href="viewPleading.php" class="nav_link">View Pleadings</a>
          <a id="book" href="Bookmark.php" class="nav_link active ">Bookmark</a>
            <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group mt-2 mb-1">
                                <!--                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>-->

                                <select class="CN" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Client Name</option>-->
                                    <option value=""disabled selected>Please Choose Client </option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=".$row['Sr_no'].">" . $row['Full_Name'] . "</option>";
                                    }

                                    ?>
                                </select>
                                <input type="hidden" name="ClientName" id="text_CT" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">

                            <div class="form-group mt-2 mb-1">
                                <!--                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>-->
                                <select class="CN"  style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Case Name</option>-->
                                    <option value=""disabled selected>Please Choose Case</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="CaseN" id="text_CN" value="<?php echo $row['Case_Name']; ?>" />
                            </div>
                        </div>



                    </div>
      </div>
      
     <div class="container-fluid" id="dycontents">
          
      </div>
      <input type="hidden" id="BMSNo" >
      
  <?php 
      include 'pleading/Modals.php';
      if(isset($_GET['c']) && isset($_GET['v']) ){
      $clientid= mysqli_real_escape_string($con, $_GET['c']);
        $caseid= mysqli_real_escape_string($con, $_GET['v']);
?>
<script>
    $( document ).ready(function() {
   $("#cp").attr("href", "Pleadings.php?c="+<?php echo $clientid;?>+"&v="+<?php echo $caseid;?>);
   $('#ClientN').val(<?php echo $clientid?>);
   $("#ClientN").trigger("change");

   $('#CaseName').val('<?php echo $caseid?>');
   $("#CaseName").trigger("change");
});
    </script>
<?php
}
      ?>
<script>
   $('#createbm').click(function(e){
                                   e.preventDefault();
                              var bName= $('#bookMarkN').val();
                              var sPage = $('#pdfpageNo').val();
                          var bid = $('#bids').val();
                          var clientId=$('#ClientN').val();
                          var caseId= $('#CaseName').val();
                              
//                              console.log(bName);
//                              console.log(sPage);
//                              console.log(bid);
//                              console.log(clientId);
//                              console.log(caseId);
                              if(bName != ""){
                                   $.ajax({
                                        url:'pleading/Bookmarkfunction.php',
                                        type:'POST',
                                       //data:$('#CTEDY').serialize()+ "&editors="+editors+"&CTsR="+uid,
                                       data: {bookMarkN:bName,sPage:sPage,bid:bid,client:clientId,case:caseId},
                                          success:function(data){
                                              console.log(data);
                                              $("#bookmarkform").trigger('reset');
                                              $("#bmmodals").modal('toggle');
                                               viewBookMark(bid,0,sPage);
                                              
                                          }
                                      });
                              }else{
                                  alert("Please Enter BookMark Name");
                              }
                                
                                          
                            
    });
    
    </script>
      <script>
                  function show(sr){
                      $("#BMSNo").val(sr);
                      $('#selectbookmark').val(sr);
                      $(".accbtn").removeClass("bg-warning");
                      $("#acc"+sr).addClass("bg-warning");
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
              
              
       //    $('#mybottomnav').addClass('d-none');
              $('#mybottomnav').remove();
//        $('.topnav1').addClass('d-none');
        $('#CM').removeClass('active');
        $('#pl').addClass('active');
        
          $( document ).ready(function() {
               $('select').select2();
          });
          
          function fullscreen(){
          if ($("#myTopnav").hasClass("d-none")) {
               
  $("#myTopnav").removeClass('d-none')
  $(".topnav1").removeClass('d-none');
}else{
     $("#myTopnav").addClass('d-none',500);
     
     $(".topnav1").addClass('d-none',500);
     
}
          }
          TabMode= () =>{
               if ($(".RSidebtns").hasClass("d-none")) {
                   $(".RSidebtns").removeClass("d-none");
               }else{
                   $(".RSidebtns").addClass("d-none");
               }
          }
      </script>
      <script>
          function EdtDel(bsr){
           //   alert(bsr);
            $('#EditDelM').modal('toggle');  
            console.log(bsr);
            
            $.ajax({
                url:"pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {EBsr: bsr},
                        success: function (data) {
                            console.log(data);
                            $('#editBM').html(data);
                        }
            });
          }
          function Editbtn(sr){
             // alert('Edit Under Development');
             var name = $('#BmTitle').val();
             var page = $("#current_page").val();
             var bidno = $("#bidno").val();
             
                 $.ajax({
                url:"pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {ReName: name,EditBSr:sr},
                        success: function (data) {
                            console.log(data);
                          //   $("#CaseName").trigger("change");
                           // $('#editBM').html(data);
                           $('#EditDelM').modal('toggle');
                           viewBookMark(bidno,0,page);
                        }
            });
             
          }
             function Delbtn(sr){
                 var page = $("#current_page").val();
             var bidno = $("#bidno").val();
            
             
               $.ajax({
                url:"pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {DelBSr:sr},
                        success: function (data) {
                            console.log(data);
                                  //   $("#CaseName").trigger("change");
                           // $('#editBM').html(data);
                           $('#EditDelM').modal('toggle');
                            viewBookMark(bidno,0,page);
                           
                        }
            });
              
          }
          const viewbook = viewBookMark= (bid,sr,stpg)=>{
             // alert(bid+sr+stpg);
//              console.log(bid);
//              console.log(sr);
//              console.log(stpg);
           //     Etpg(sr,stpg);
                $.ajax({
                     url:"pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {vbid: bid},
                        beforeSend: function () {
          $('#dyBookmarks').html("<strong classs='text-center font-weight-bolder h4'style='color:#ff7f50;'>Loading...</strong>");
        },
                        success: function (data) {
                            $('#dyBookmarks').html(data);
                          //  bookmtable
                          $('.bookmtable').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            
            "responsive": true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search BookMarks"
            }
        });
        
        $(function() {
                               
  $("#accordionExample").sortable();
  $("#accordionExample").disableSelection();

  $('#accordionExample').on('show.bs.collapse', function(event) {
    console.log(event);
    var elem = $(event.target).parent().detach();
    $('#accordionExample').prepend(elem);
  })
});
                            
                        }
                });
                
              $('#vb').trigger('click');
          }
          
      function shpleading(){
//          alert("Hiding pleadings");
//           $('#pleadings').toggle(1000);
           $("#pleadings").toggleClass("d-none");
           //$('#bookmarks').toggleClass('col-xl-4 col-lg-4 col-md-4 col-sm-4 p-0'); 
//           console.log($('#pleadings').is(':visible'));
if ( $("#pleadings").hasClass("d-none") ) {  
$('#viewers').addClass('col-xl-9 col-lg-9 col-md-9 col-sm-9').removeClass('col-xl-6 col-lg-6 col-md-6 col-sm-6');
}else{
    $('#viewers').addClass('col-xl-6 col-lg-6 col-md-6 col-sm-6').removeClass('col-xl-9 col-lg-9 col-md-9 col-sm-9');
}
       
        
      }
      </script>
      <script>
          $("#ClientN").on("change", function () {
                    var category = $("#ClientN").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
//                        url: "UploadCase/CaseNameDy.php",
                        url:"Calendar/function.php",
                        type: "POST",
                        cache: false,
                        data: {clientdids: cid},
                        success: function (data) {
                            $("#CaseName").html(data);
                            <?php
                                if(isset($_GET['c']) && isset($_GET['v']) ){
                                   ?>
                                                  $('#CaseName').val('<?php echo $caseid?>');
   $("#CaseName").trigger("change");  
                                                   <?php
                                }
                            
                            ?>
                        }
                    });
                });
                $("#CaseName").on("change",function(){
                    
                    var caseId= $('#CaseName').val();
                    var caseName=$("#CaseName option:selected");
                    var caseName= caseName.text();
                
              $('#dycontents').html("<div class='container text-center'><img src='images/loadings.gif' class='text-center mt-5'/></div>");
                 
                   $.ajax({
                        url: "pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {CaseName: caseName,caseId:caseId},
                        success: function (res) {
                            $('#dycontents').html(res);
                              $( document ).ready(function() {
                            
                           $('#Timelist').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            
            "responsive": true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Timeline"
            }
        });
    
});
//$( document ).ready(function() {
// $(function () {
//  $('[data-toggle="tooltip"]').tooltip();
//});
//});
                 
                        }
                    });
                });
                        
                        
                        
                  function subbookmarks(){
                      
                      var caseId= $('#CaseName').val();
                    $.ajax({
                     url:"pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {subBook: caseId},
                        success: function (data) {
                            console.log(data);
                            $("#dysubbookmark").html(data);
                            $('select').select2();
                             var sr= $("#BMSNo").val();
                             
                 $('#selectbookmark').val(sr);
                 $('#selectbookmark').select2().trigger('change');
                     
                            
                        
                            $("#subCreatebtn").click(function(){
                                var bid = $('#bids').val();
                                  var bookMid =   $("#selectbookmark").val();
                            var subName = $("#sbmn").val();
                            var clientId= $("#ClientN").val();
                           var page=$("#current_page").val();
                            
                            if(bookMid != null ){
                                
                                 $.ajax({
                     url:"pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {bbids:bid,bookMid: bookMid,SubBookM:subName,bclientId:clientId,bcaseId:caseId,Pageno:page},
                        success: function (res) {
                    //        alert(res);
                            $("#sbmn").val("");
                            $("#AddSubBM").modal("toggle");
                            viewBookMark(bid,1,page)
                            
                        }
                    });
                                
                                
                        }else{
                           alert("Please Select BookMark");
                        }
                 
});
                        }
                    });
                      
    }
     DelSubBM =(sr) =>{
           var bid = $('#bids').val();
            var page=$("#current_page").val();
        swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this Sub Book Mark !",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      
          $.ajax({
                     url:"pleading/Bookmarkfunction.php",
                        type: "POST",
                        cache: false,
                        data: {delsbm:sr},
                        success: function (res) {
                             viewBookMark(bid,1,page)
                            swal("Deleted Successfully !", {
      icon: "success",
    });
    
                        }
                    });
  
  } 
});
    }
                        
        
  
        
        
          </script>
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
        function updateActivity(){
            var activeon = 'BookMarks';
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