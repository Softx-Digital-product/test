<?php
include 'Dp.php';

if(isset($_POST['knowledgeT'])){
    
   $Srid = mysqli_real_escape_string($con,$_POST['knowledgeT']);
    //    KnowledgeDb/Knowledgedata
//    echo "<pre>";
//    print_r($_FILES);
//    echo "</pre>";
//     echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    
     $fpath= "Knowledgedata/";
     if(isset($_FILES['file'])){
     
      $file_dir =$fpath;
     $fileName = basename($_FILES['file']['name']); 
      $fileSize= basename($_FILES['file']['size']);
      $targetFilePaths = $file_dir . $fileName; 
   //  echo $targetFilePaths;
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePaths)){
          
        
          $q="Update knowledge_data SET Uploadlink = '$fileName' WHERE Sr_no = '$Srid' ";
           if ($con->query($q) === TRUE) {
       echo "<strong style='color:green'>Uploaded Successfully...</strong>";
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

if(isset($_POST['DelKId'])){
    
     $id = mysqli_real_escape_string($con,$_POST['DelKId']);   
     $sql="DELETE FROM knowledge_data WHERE Sr_no = {$id}";
    if(mysqli_query($con, $sql)){
        
?>
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

      <td class="text-center common" scope="row"style="cursor:pointer;" onclick="editfun('<?php echo $row['Sr_no'];?>')"><a class="nav_link ">Edit</a></td>

           <td class="text-center common" scope="row"style="cursor:pointer" onclick="view('<?php echo $row['Sr_no']?>')";><a  id="viewbtn"   class="nav_link" value="<?php echo $row['Sr_no']?>" >View</a>
      <td  class="text-center common" scope="row"style="cursor:pointer;"><a onclick="del('<?php echo $row['Sr_no'];?>')"class="nav_link text-danger text-center">Delete</a></td>
      

       </tr>
    <?php
     $sr++;
}
     }
    
?>
            
  </table>

<?php

    }
    else{
        echo "<h3> can't Delect KD </h3>";
    }
    
   
    
    
};

if(isset($_POST['ACname'])){
   
    $Cname= json_decode($_POST['ACname']);
    
    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from knowledge_categ Where Category='$Cname'"));
if($check>0){
// data is present;
}
else{

  $sql ="INSERT into knowledge_categ (Category) 
  VALUE('$Cname')";
     
if ($con->query($sql) === TRUE) {

$fq = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
//  echo "Saved Sucessfully Bro";
  
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

}
    
    die();
}


if(isset($_POST['DelCid'])){
    
    $Cid = json_decode($_POST['DelCid']);

$sql="DELETE FROM knowledge_categ WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
$fq = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}

}
else{
    echo "<h3> can't Delect user </h3>";
}
    
}




if(isset($_POST['EditCid'])){ 
    
    $Cid = json_decode($_POST['EditCid']);
$Rename= json_decode($_POST['ECrename']);

$sql = "UPDATE knowledge_categ SET Category='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {

    $fq = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
    
} else {
  echo "Error updating record: " . $con->error;
}

    
    die();
}






// Sub Categorys


if(isset($_POST['Acid'])){
    
    $Cid = json_decode($_POST['Acid']);
$subC= json_decode($_POST['SubcName']);


$check=mysqli_num_rows(mysqli_query($con,"SELECT * from knowledge_subcateg where Sub_Category='$subC'"));
if($check>0){
   // sub category is already present;
}
else{
  $sql ="INSERT into knowledge_subcateg (Cid,Sub_Category) 
  VALUES('$Cid','$subC')";
     
if ($con->query($sql) === TRUE) {

  $fq = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
  
} else {
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
 
}
die();
}


if(isset($_POST['ESid'])){
 $Cid = json_decode($_POST['ESid']);
$Rename= json_decode($_POST['rename']);
   
    $sql = "UPDATE knowledge_subcateg SET Sub_Category='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {

     $fq = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
  
} else {
  echo "Error updating record: " . $con->error;
}

    
    die();
}


if(isset($_POST['DelScid'])){
    $Cid = json_decode($_POST['DelScid']);
    
    $sql="DELETE FROM knowledge_subcateg WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
 $fq = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
 
}
else{
    echo "<h3> can't Delect user </h3>";
}
    
    
    die();
}




// Type 

if(isset($_POST['Tname'])){
   
    $Tname= json_decode($_POST['Tname']);
    
$check=mysqli_num_rows(mysqli_query($con,"SELECT * from knowledge_type Where Type='$Tname'"));
if($check>0){
   //"<br> This Type is already present";
}
else{

  $sql ="INSERT into knowledge_type (Type) VALUE('$Tname')";
     
if ($con->query($sql) === TRUE) {
  
 $fq = mysqli_query($con, "SELECT * FROM knowledge_type");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}

} else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
}
    die();
}


if(isset($_POST['ETid'])){
    
    $Cid = json_decode($_POST['ETid']);
$Rename= json_decode($_POST['rename']);


$sql = "UPDATE knowledge_type SET Type='$Rename' WHERE Sr_no='$Cid'";

if ($con->query($sql) === TRUE) {
    
 $fq = mysqli_query($con, "SELECT * FROM knowledge_type");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}

} else {
  echo "Error updating record: " . $con->error;
}

    die();
}


if(isset($_POST['DelTid'])){
    
    $Cid = json_decode($_POST['DelTid']);

$sql="DELETE FROM knowledge_type WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
  $fq = mysqli_query($con, "SELECT * FROM knowledge_type");
while ($row = $fq->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
}
else{
    echo "<h3> can't Delect Type </h3>";
}
    
    die();
}



// Edit Knowledge Data

if(isset($_POST['EditKId'])){
    
    $id= $_POST['EditKId'];
    
    $query = "SELECT * FROM knowledge_data WHERE Sr_no = {$id}";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($rows = $result->fetch_assoc()) {
                    
//                  echo "<pre>";
//                  print_r($rows);
//                  echo "</pre>";
                   ?>
                    
<div class="card " id="dydata">
    <div class="card-header">
        <strong> Edit Knowledge</strong>
    </div>
    <div class="card-body p-1">
    <form id="formdyk">
              <div class="row">
    <div class="col-lg-6  col-md-6 col-sm-12">
        <label class="font-weight-bold mt-1">Select Category</label>
        <select  class="form-control lg-6 md-6 sm-12" name="CC"  id="Category" placeholder="Choose Category..." onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text">
           <option value="<?php echo $rows['Kcid'];?>" selected><?php echo $rows['K_Category']; ?></option>

       <?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
?>
</select>
          <input type="hidden" name="CC_text" id="text_content" value="<?php echo $rows['K_Category']; ?>" />
    </div>
                  
                  <!--Sub Category-->
    <div class="col-lg-6 col-md-6 col-sm-12">
          <label class="font-weight-bold mt-1">Select Sub Category</label>
     <select class="form-control" id="SubCategory" name="SC" placeholder="Choose Sub Category..." onchange="document.getElementById('text_SC').value=this.options[this.selectedIndex].text">
    <option value="<?php echo $rows['Kscid'];?>"selected><?php echo $rows['K_Sub_Category'];?></option>
      
    <?php 
    
    $id = "<script>document.writeln(Category);</script>";


$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
?>
  </select>
                   <input type="hidden" name="SC_text" id="text_SC" value="<?php echo $rows['K_Sub_Category']?>" />
    </div>
  </div>
            <!--Date Section-->
            <div class="row">
    <div class="col-lg-6  col-md-6 col-sm-12">
        <label class="font-weight-bold mt-2">Select Date</label>
        <input type="text" class="form-control"  id="date" name="Date" value="<?php echo $rows['K_Date'];?>" placeholder="Select Date">
        
    </div>
    <div class="col-lg-6  col-md-6 col-sm-12">
        <div class="lg-4 md-6 sm-12">
        <label class="font-weight-bold mt-2">Select Type</label>
            <!-- Type -->
            <select  class="form-control" name="CT" id="type" placeholder="Choose Type."onchange="document.getElementById('text_CT').value=this.options[this.selectedIndex].text">
    <option value="<?php echo $rows['Ktid'];?>" selected><?php echo $rows['K_Type'];?></option>
    <?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
  </select>
             <input type="hidden" name="CT_text" id="text_CT" value="<?php echo $rows['K_Type']; ?>" />
    </div>
    </div>
  </div>
            
            <div class="title" lg-12 md-12 sm-12>
                <label class="font-weight-bold mt-1">Enter Title</label>
                    
                <textarea class="form-control" placeholder="Title"name="title" id='titles' aria-label="With textarea"><?php echo $rows['K_Title'];?></textarea>
                
            </div>
            
            
          <div class="Editor">
                <label class="font-weight-bold mt-2">Knowledge Content</label>
                    
                <textarea class="form-control"id="editor"  name="editor"  aria-label="With textarea"><?php echo$rows['K_Content'] ?></textarea>
                <input type="hidden" name="sr" id='sr' value="<?php echo $rows['Sr_no']?>">
                
            </div> 
            <div>
            <button class="btn btn-primary mt-2 " name="updatekdata"  type="submit" id="updatekdata" >Update</button> 
            <label class=' mt-2 ml-2 alertTxt'></label>
            </div>
          
            
            </form>
        </div> 
    
    
</div>


                    
                    
                    <?php
                }
                }else{
                    echo "No Record Founded !!!";
                }

    
    die();
}


if(isset($_POST['updatekdata'])){
//    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    
//    
//    
     $Srid = mysqli_real_escape_string($con,$_POST['srid']);    
     $Kcid = mysqli_real_escape_string($con,$_POST['catid']);
     $Kscid = mysqli_real_escape_string($con,$_POST['scid']);
     $Ktid = mysqli_real_escape_string($con,$_POST['typeid']); 
     $Kctext = mysqli_real_escape_string($con,$_POST['txtcate']);
     $Ksctext = mysqli_real_escape_string($con,$_POST['txtsc']);
     $Kttext = mysqli_real_escape_string($con,$_POST['txtype']); 
     $Kdate = mysqli_real_escape_string($con,$_POST['date']);
     $Ktitle = mysqli_real_escape_string($con,$_POST['title']);  
      $Keditor = json_decode($_POST['editor']);
        $sql="UPDATE knowledge_data SET Kcid='$Kcid',Kscid='$Kscid',Ktid='$Ktid',K_Category='$Kctext',K_Sub_Category='$Ksctext',K_Date='$Kdate',K_Type='$Kttext',K_Title='$Ktitle',K_Content='$Keditor' WHERE Sr_no = '$Srid'";
      //  echo $sql;
      if ($con->query($sql) === TRUE) {
?>
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

      <td class="text-center common" scope="row"style="cursor:pointer;" onclick="editfun('<?php echo $row['Sr_no'];?>')"><a class="nav_link ">Edit</a></td>

           <td class="text-center common" scope="row"style="cursor:pointer" onclick="view('<?php echo $row['Sr_no']?>')";><a  id="viewbtn"   class="nav_link" value="<?php echo $row['Sr_no']?>" >View</a>
      <td  class="text-center common" scope="row"style="cursor:pointer;"><a onclick="del('<?php echo $row['Sr_no'];?>')"class="nav_link text-danger text-center">Delete</a></td>
      

       </tr>
    <?php
     $sr++;
}
     }
     

?>
            
  </table>

<?php
} else {
  echo "Error updating record: " . $con->error;

}
    die();
}
?>


