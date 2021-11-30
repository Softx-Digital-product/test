<?php include 'Database/Dp.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
           <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    <title>Sorting</title>
    <style>
        .tooltip { 
    pointer-events: none;
}
        *{
            padding:0px;
            margin:0px;
           box-sizing: border-box;
        }
                              div.dataTables_wrapper div.dataTables_filter input {
width:200px;
   
    overflow: hidden !important;
   
}
        #canvas_container {
        width: 99.9%;
        height: 900px;
        overflow: auto;
    }
    #pdf_renderer{ width:99.9%; cursor:pointer;}

cc{
    height:50px;
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
.cc selete{
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
        
    </style>
  </head>
  <body>
      <?php include 'timelineheaader.php';?>
    
      
      <div class="container-fluid " id="dycontents">
          <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
<!--              Timelines-->
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
<!--              Flags-->
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
<!--              Pdf Viewer-->
          </div>
      </div>
      </div>
      
      
      
      
      <?php include 'Sorting/Modals.php';?>
      

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script> 
    var casesId; var dbriefs;
    $('#sorting').addClass('active');
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
                             var caseN = $("#CaseName").val();
                     var selected = $(this).find('option:selected');
       var ClientIds = selected.data('foo'); 
       
                      var category = $("#CaseName").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
          $.ajax({
                        url: "UploadClientBrief/pdfDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                            beforeSend: function () {
          $('#dycontents').html("<div class='container text-center'><img src='images/loadings.gif' class='text-center mt-5'/></div>");
        },
                        success: function (data) {
                            console.log("srno:- "+ data);
                        casesId= data;
                            $.ajax({
                        url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {CaseName: caseN,dataid:data,ClientIds:ClientIds},
                        success: function (res) {
                          //  console.log(data);
                          $("#dycontents").html(res);
                          $('select').select2();
                          
                          $(function() {
                               console.log("sorting First");
  $("#accordionExamples").sortable();
  $("#accordionExamples").disableSelection();

  $('#accordionExamples').on('show.bs.collapse', function(event) {
    console.log(event);
    var elem = $(event.target).parent().detach();
    $('#accordionExamples').prepend(elem);
  })
});
                          
                          
                               $(".Addbtn").on("click",function(){
                                   
var Asr = $(this).attr("data-animal-type");
//show(Asr);
console.log(Asr);
dbriefs= Asr;
  console.log("========== 1st Adding Department=========");
   let myTab = document.getElementById('WTable'+Asr);
       console.log(myTab);
  //let index = document.getElementById(1).cellIndex; 
  
var check = new Array();

for (let i = 1; i < myTab.rows.length; i++) { 
            const objCells = myTab.rows.item(i).cells; 
         //   console.log(objCells);
            for (let j = 2; j <= 2; j++) { 
//                console.log(objCells.item(j));
           // lists.push("PDFFiles/"+[objCells.item(j).innerHTML]); 
           check.push([objCells.item(j).innerHTML]); 

            } 
                  
}
console.log(check);
   
   
    
    var column1 = $(this).closest('tr').children()[0].textContent;
    console.log("col=1 "+column1);
  var column2 = $(this).closest('tr').children()[1].textContent;
  console.log("col=2 "+column2);
  var column3 = $(this).closest('tr').children()[2].textContent;
  console.log("col=3 "+column3);
  var column4 = $(this).closest('tr').children()[3].textContent;
    console.log("col=4 "+column4);
    var startpg = column4;
      var column5 = $(this).closest('tr').children()[4].textContent;
    console.log("col=5 "+column5);
     var traimTitle = column5.substring(0,50);
     
   var column6 = $(this).closest('tr').children()[5].textContent;
  console.log("col=6"+column6);
 
  

  var checker = "false";
  for(var i=0; i<check.length; i++){
//      console.log(check[i]);
    var name = check[i];
    if(name == column5){
         //if(name == short6){
      result = 'Exist';
      alert('already added!!!');
      checker = "true";
      break;
    }
  }
  console.log(checker);
if(checker == "false"){  
    
 if($("#WTable"+Asr+".copy_"+column3).length==0)
  {
//      $("#WTable"+Asr).append("<tr class='copy_"+column3+" table-striped'><td scope='row'class='text-center Dates d-none'>" + column1 + "</td><td class='text-center d-none'data-toggle='tooltip' data-placement='top'  title='"+column2+"'  Onclick='Etpg(0,"+startpg.trim()+")'>" + column2 +"</td><td class='d-none'>"+startpg.trim()+"</td><td class='d-none'>"+startpg.trim()+"</td><td class='text-center Totals'  style='cursor:pointer;width:80%'>" + column3 +"</td><td class='d-none'>"+column5+"</td><td class='Removes'><a class='nav-link text-center text-danger btn_remove' data-Bid-type="+column6+">Rem</a></td><td class='d-none'>"+column6+"</td></tr>");
  $("#WTable"+Asr).append("<tr class='copy_"+column3+" table-striped'><td scope='row'class='text-center Dates style='width:8%;'>" + column1 + "</td><td class='text-center Totals text-nowrap' data-toggle='tooltip' data-placement='top'  title='"+column5+"' style='cursor:pointer;max-width:8rem;overflow:hidden' Onclick='Etpg(0,"+column4.trim()+")'>" + column5 +"</td><td class='d-none'>"+column5+"</td><td class='Removes'><a class='nav-link text-center text-danger btn_remove' data-Bid-type="+column6+">Rem</a></td><td class='d-none'>"+column6+"</td></tr>");
        
        
          var caseNo = $("#CaseName").val();
        var clientNo = $("#ClientN").val();
        var flagNo = $('#FlagId').val();
//      
        $.ajax({
                        url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {flagNo:Asr,clientNo:clientNo,caseNo:data,BriefSrno:column6},
                        success: function (res) {
                            console.log(res);
                        }
                    });
  
//    $("#Mytable2").append("<tr class='copy_"+column3+"'><td scope='row'>" + column1 + "</td><td>" + column2 +"</td><td>" + column3 +"</td><td class='text-center'>" + column4 +"</td><td><a class='nav-link text-danger btn_remove'>Remove</a></td></tr>");
  }
  else
  {
//     var value = parseInt($("#WTable<?php echo $sr;?> .copy_"+column1+" input").val()) + 1;
//     $("#WTable<?php echo $sr; ?> .copy_"+column1+" input").val(value);
  }
  }else{
  console.log("checker is true");
  }
});
                     
                     
$("body").on("click",".btn_remove", function() {
    $(this).parent().parent().remove();
    var Bid = $(this).attr("data-Bid-type");
    var flagId= $(this).attr("data-Fsr-type");
       var caseNo = $("#CaseName").val();
        var clientNo = $("#ClientN").val();
        var flagNo = $('#FlagId').val();
        
        

        console.log(flagId);
         $.ajax({
                        url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {RflagNo:flagId,RclientNo:clientNo,RcaseNo:data,RBriefSrno:Bid},
                        success: function (res) {
                            console.log(res);
                        }
                    });

});
                          
                          
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
                         $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
                     
                     


                  

   $("#FlagId").on("change", function () {
               var flagId =  $('#FlagId').val();
             console.log(flagId);
             console.log(data);
//            alert('Under process');
 $.ajax({
                        url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {CaseId: data,flagId:flagId},
                        success: function (res) {
                           console.log(res);
//                          $("#dyflags").append(res);
                              $('#accordionExamples').append(res);
                        var dybtn=   $('#dybtn'+flagId).val();
                        console.log(dybtn);
                       $('.dymenu').append(dybtn);
                       
                        $(function() {
                            console.log("sortting");
  $("#accordionExample").sortable();
  $("#accordionExample").disableSelection();

  $('#accordionExample').on('show.bs.collapse', function(event) {
    console.log(event);
    var elem = $(event.target).parent().detach();
    $('#accordionExample').prepend(elem);
  })
});
                            $(".Addbtn").on("click",function(){


var Asr = $(this).attr("data-animal-type");
//show(Asr);
console.log(Asr);
  
   let myTab = document.getElementById('WTable'+Asr);
       console.log(myTab);
  //let index = document.getElementById(1).cellIndex; 
  
var check = new Array();

for (let i = 1; i < myTab.rows.length; i++) { 
            const objCells = myTab.rows.item(i).cells; 
         //   console.log(objCells);
            for (let j = 3; j <= 3; j++) { 
//                console.log(objCells.item(j));
           // lists.push("PDFFiles/"+[objCells.item(j).innerHTML]); 
           check.push([objCells.item(j).innerHTML]); 

            } 
                  
}
console.log(check);
   
   
    
    var column1 = $(this).closest('tr').children()[0].textContent;
    console.log("col=1 "+column1);
  var column2 = $(this).closest('tr').children()[1].textContent;
  console.log("col=2 "+column2);
  var column3 = $(this).closest('tr').children()[2].textContent;
  console.log("col=3 "+column3);
  var column4 = $(this).closest('tr').children()[3].textContent;
    console.log("col=4 "+column4);
    var startpg = column4;
      var column5 = $(this).closest('tr').children()[4].textContent;
    console.log("col=5 "+column5);
     var traimTitle = column5.substring(0,50);
     
   var column6 = $(this).closest('tr').children()[5].textContent;
  console.log("col=6 "+column6);
 
  

  var checker = "false";
  for(var i=0; i<check.length; i++){
//      console.log(check[i]);
    var name = check[i];
    if(name == column6){
         //if(name == short6){
      result = 'Exist';
      alert('already added!!!');
      checker = "true";
      break;
    }
  }
  console.log(checker);
if(checker == "false"){  
    
 if($("#WTable"+Asr+".copy_"+column3).length==0)
  {
      $("#WTable"+Asr).append("<tr class='copy_"+column3+" table-striped'><td scope='row'class='text-center Dates 'style='width:8%'>" + column1 + "</td><td class='text-center Totals' data-toggle='tooltip' data-placement='top'  title='"+column5+"' style='cursor:pointer;max-width:8rem;overflow:hidden;' Onclick='Etpg(0,"+column4.trim()+")'>" +traimTitle +"</td><td class='d-none'>"+column5+"</td><td class='Removes'><a class='nav-link text-center text-danger btn_remove' data-Bid-type="+column6+">Rem</a></td><td class='d-none'>"+column6+"</td></tr>");
        var caseNo = $("#CaseName").val();
        var clientNo = $("#ClientN").val();
        var flagNo = $('#FlagId').val();
//      
        $.ajax({
                        url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {flagNo:flagNo,clientNo:clientNo,caseNo:data,BriefSrno:column6},
                        success: function (res) {
                            console.log(res);
                        }
                    });
  
//    $("#Mytable2").append("<tr class='copy_"+column3+"'><td scope='row'>" + column1 + "</td><td>" + column2 +"</td><td>" + column3 +"</td><td class='text-center'>" + column4 +"</td><td><a class='nav-link text-danger btn_remove'>Remove</a></td></tr>");
  }
  else
  {
//     var value = parseInt($("#WTable<?php echo $sr;?> .copy_"+column1+" input").val()) + 1;
//     $("#WTable<?php echo $sr; ?> .copy_"+column1+" input").val(value);
  }
  }else{
  console.log("checker is true");
  }
});
                     
                     
$("body").on("click",".btn_remove", function() {
    $(this).parent().parent().remove();
    var Bid = $(this).attr("data-Bid-type");
       var caseNo = $("#CaseName").val();
        var clientNo = $("#ClientN").val();
        var flagNo = $('#FlagId').val();
        
         $.ajax({
                        url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {RflagNo:flagNo,RclientNo:clientNo,RcaseNo:data,RBriefSrno:Bid},
                        success: function (res) {
                            console.log(res);
                        }
                    });

});
 
       var caseNo = $("#CaseName").val();
        var clientNo = $("#ClientN").val();
        var flagNo = $('#FlagId').val();
$.ajax({
    url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {AflagNo:flagNo,AclientNo:clientNo,AcaseNo:data},
                        success: function (res) {
                            console.log(res);
                        }
                    });

                      }
                  });
                  
                  
                  });
                  
                  $('#EFlagbtn').click(function(){
               var eid = $('#EditFlagId').val(); 
              let ename= $("#EFlagText").val();
                  if(eid != null){
                      //alert(eid+" "+Ename);
                      $.ajax({
    url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {Eid:eid,Ename:ename},
                        success: function (res) {
                            console.log(res);
                            $("#EFlagText").val("");
                            $("#EditFlags").modal('toggle');
                            
                             swal(ename+" Flag has been Edited successfully!", {
      icon: "success",
    });
    $("#CaseName").trigger("change");

    
    
                        }
                    });
                     
                  }else{
                      swal("Error!", "Please Choose Flag From Dropdown", "error");
                  }
                  
                  
                  
    });
     $('#DFlagbtn').click(function(){
            var did = $('#EditFlagId').val();
              let dname= $("#EFlagText").val();
               if(did != null){
                                  swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this "+dname+" Flag",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  
  if (willDelete) {
      
        $.ajax({
    url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {Did:did,Dname:dname},
                        success: function (res) {
                            console.log(res);
   swal(dname+" Flag has been deleted!", {
      icon: "success",
    });
                        }
                    });
    
  } else {

  }
});
        }else{
            swal("Error!", "Please Choose Flag From Dropdown", "error");
        }
   
                  
    });
                  
                  
                        }//dycontents
                    });
                    
                    
                       
                            
    }
    });



                    
                });
                
             

function Remove(sr){
//alert("Under process"+sr);
  $('#Caccordion'+sr).remove();
  $('#dybtns'+sr).remove();
     var clientNo = $("#ClientN").val();
        var flagNo = $('#FlagId').val();
        console.log(clientNo);
        console.log(flagNo);
        console.log(casesId);
  $.ajax({
    url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {DAflagNo:sr,DAclientNo:clientNo,DAcaseNo:casesId},
                        success: function (res) {
                            console.log(res);
                        }
                    });
  


}

$('#CFlagbtn').click(function(e){
var flagname= $('#FlagName').val();
//alert(flagname);
if(flagname !=''){
     $.ajax({
                        url: "Sorting/functions.php",
                        type: "POST",
                        cache: false,
                        data: {CreateFlag:flagname},
                        success: function (data) {
                        //    console.log(data);
                          $("#FlagId").html(data);
                          $('#FlagName').val('');
                          $('#CreateFlags').modal('toggle');
                          
                      }
                  });
    }else{
        alert('Please Enter A  Valid Value :( ');
    }
 


});

</script>

<script>
    
   
            //Testing;
    </script>
    
        
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
            var activeon = 'Sorting';
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