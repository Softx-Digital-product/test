<?php
include 'Dp.php';

if(isset($_POST['submit'])){

//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
     
      $Srid=  mysqli_real_escape_string($con,$_POST['sr']);
        $Kcid=  mysqli_real_escape_string($con,$_POST['CC']);
    $Kscid= mysqli_real_escape_string($con,$_POST['SC']);
    $Ktid= mysqli_real_escape_string($con,$_POST['CT']);
    $Kctext= mysqli_real_escape_string($con,$_POST['CC_text']);
    $Ksctext=mysqli_real_escape_string($con,$_POST['SC_text']);
    $Kttext=mysqli_real_escape_string($con,$_POST['CT_text']);
    $Kdate=mysqli_real_escape_string($con,$_POST['Date']);
    $Ktitle=mysqli_real_escape_string($con,$_POST['title']);
    $Keditor=mysqli_real_escape_string($con,$_POST['editor']);
    
    $sql="UPDATE knowledge_data SET Kcid='$Kcid',Kscid='$Kscid',Ktid='$Ktid',K_Category='$Kctext',K_Sub_Category='$Ksctext',K_Date='$Kdate',K_Type='$Kttext',K_Title='$Ktitle',K_Content='$Keditor' WHERE Sr_no = '$Srid'";
    
    echo $sql;
    if ($con->query($sql) === TRUE) {
 // echo "Record updated successfully";
   header("Location:http://apajuris.in/work/TestingDS.php");
   die();
} else {
  echo "Error updating record: " . $con->error;
//   header("Location:http://apajuris.in/work/TestingDS.php");
}
    
    
};

$id = $_GET['v'];
//$id= 5;
 $KCa; $KSC; $KD; $KT;$KTi; $KC;

	$query = "SELECT * FROM knowledge_data WHERE Sr_no = {$id}";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    $SR=$row['Sr_no'];
// $KCa=$row['K_Category'];
// $KSC= $row['K_Sub_Category'];
// $KD=$row['K_Date'];
// $KT=$row['K_Type'];
// $KTi=$row['K_Title'];
// $KC=$row['K_Content'];
 
  $Kcid= $row['Kcid'];
    $Kscid= $row['Kscid'];
    $Ktid= $row['Ktid'];
    $Kctext= $row['K_Category'];
    $Ksctext=$row['K_Sub_Category'];
    $Kttext=$row['K_Type'];
    $Kdate=$row['K_Date'];
    $Ktitle=$row['K_Title'];
    $Keditor=$row['K_Content'];
 
 //echo $KCa;
 
}
    }

else{
    echo "<h3> No Record</h3>";
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../ckeditor/ckeditor.js"></script>

<!--<script src="../Ckeditor5/build/ckeditor.js"></script>-->
    
<style>
   
    textarea{
       font-family: verdana; 
    }
    
</style>
    <title>Update Knowledge</title>
  </head>
  <body>
      
      <div class="container border mt-4 shadow p-3 mb-5 bg-white rounded">
          <div class="row">
              <div class="col-lg-6 col-lg-6 col-sm-12">
                   <a href="../TestingDS.php" class="btn btn-primary mt-1 md-3"><- Back</a>
              </div>
              <div class="col-lg-6 col-lg-6 col-sm-12">
          <h3 class="mt-1 md-2 text-right text-uppercase"> Update Knowledge </h3>
              </div>
               
          </div>
          <form class="form-box "action="" method="POST">
              <div class="row">
    <div class="col-lg-6  col-md-6 col-sm-12">
        <label class="font-weight-bold mt-1">Select Category</label>
        <select  class="form-control lg-6 md-6 sm-12" name="CC"  id="Category" placeholder="Choose Category..." onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text">
           <option value="<?php echo $Kcid?>" selected><?php echo $Kctext ?></option>

       <?php 
include 'Dp.php';
$sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
?>
</select>
          <input type="hidden" name="CC_text" id="text_content" value="<?php echo $Kctext ?>" />
    </div>
                  
                  <!--Sub Category-->
    <div class="col-lg-6 col-md-6 col-sm-12">
          <label class="font-weight-bold mt-1">Select Sub Category</label>
     <select class="form-control" id="SubCategory" name="SC" placeholder="Choose Sub Category..." onchange="document.getElementById('text_SC').value=this.options[this.selectedIndex].text">
    <option value="<?php echo $Kscid?>"selected><?php echo $Ksctext?></option>
      
    <?php 
    
    $id = "<script>document.writeln(Category);</script>";


$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
?>
  </select>
                   <input type="hidden" name="SC_text" id="text_SC" value="<?php echo $Ksctext ?>" />
    </div>
  </div>
            <!--Date Section-->
            <div class="row">
    <div class="col-lg-6  col-md-6 col-sm-12">
        <label class="font-weight-bold mt-2">Select Date</label>
        <input type="text" class="form-control"  id="date"name="Date" value="<?php echo $Kdate?>" placeholder="Select Date">
        
    </div>
    <div class="col-lg-6  col-md-6 col-sm-12">
        <div class="lg-4 md-6 sm-12">
        <label class="font-weight-bold mt-2">Select Type</label>
            <!-- Type -->
            <select  class="form-control" name="CT" id="type" placeholder="Choose Type."onchange="document.getElementById('text_CT').value=this.options[this.selectedIndex].text">
    <option value="<?php echo $Ktid?>" selected><?php echo $Kttext?></option>
    <?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
  </select>
             <input type="hidden" name="CT_text" id="text_CT" value="<?php echo $Kttext ?>" />
    </div>
    </div>
  </div>
            
            <div class="title" lg-12 md-12 sm-12>
                <label class="font-weight-bold mt-1">Enter Title</label>
                    
                <textarea class="form-control" placeholder="Title"name="title" aria-label="With textarea"><?php echo $Ktitle?></textarea>
                
            </div>
            
            
          <div class="Editor">
                <label class="font-weight-bold mt-2">Knowledge Content</label>
                    
                <textarea class="form-control"id="editor"  name="editor"  aria-label="With textarea"><?php echo $Keditor; ?></textarea>
                <input type="hidden" name="sr" value="<?php echo $SR?>">
                
            </div> 
            <button class="btn btn-primary mt-2 " name="submit" type="submit">Submit</button>
            <a href="../TestingDS.php" class="btn btn-primary mt-2">Back</a>
            
            </form>
          
          
      </div>
      
      <script>
          
              $(document).ready(function () {

                $('select').select2();
                 
    
                 
                 
                 
                $("#date").datepicker({ dateFormat: 'dd/mm/yy',});
 $("#Category").on("change",function(){
     var category = $("#Category").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"TestingData.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){

          $("#SubCategory").html(data);
        }
      });
 });

   CKEDITOR.instances['editor'].setData();
   //CKEDITOR['editor'].getData();
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
//     readOnly:true,
     line_height:"1;1.5;2;2.5;3;4",
    
    });
   
          
          
          </script>
              <script>
                            CKEDITOR.instances['editor'].on('contentDom', function() {
    CKEDITOR.instances['editor'].document.on('keyup', function(event) {
//        alert(CKEDITOR.instances.editor.getData());
        console.log(CKEDITOR.instances.editor.getData());
        
          $.ajax({
    type:'post',
    url:'../Status/updateStatus.php',
    data: {status:1},
    success:function(){

    }
  });
  
  var matches = CKEDITOR.instances.editor.getData().replace(/<[^<|>]+?>|&nbsp;/gi,' ').match(/\b/g);
           //var count = 0;
    if(matches) {
        count = matches.length/2;
    }
        console.log(count);
        $.ajax({
    type:'post',
    url:'../Status/updateStatus.php',
    //data: {TWords:count},
    data: {TWords:1},
     success: function(result) { 
        console.log("====> "+result);
        $('.wcount').val(result);
    }
  });
        
        
    });
});
          
                </script>
    
     <script>
       function updateUserStatused(){
  $.ajax({
    url:'../Status/updateStatus.php',
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
            var activeon = 'Update knowledge';
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