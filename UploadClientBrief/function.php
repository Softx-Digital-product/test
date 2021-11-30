<?php
include 'Dp.php';

if(isset($_POST['total'])){
       $cid= mysqli_real_escape_string($con,$_POST['Srid']);
     $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE Sr_no = '{$cid}'");
    //print_r($quariy); 
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          $sr=$row['Sr_no'];
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                            $TotalPage = $row['Pdf_Pages'];
                        }
                        }
                        
                         $sr = 1;
                         $Endpgs=array();
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid ={$cid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                
                                                array_push($Endpgs,$row['Ed_pg']);
                                            }
                                            
                                              rsort($Endpgs);
                                            }
                                            
                                              // print_r($Endpgs);
                                if($Endpgs[0] == $TotalPage){
                                    
                                    echo "<div class='dycounts'><h6 id='all' class='mt-1 p-1 text-center font-weight-bold text-bold'>[ All Timeline Entry is Created!]</h6>]</div>";
                                }
                                
                                elseif(empty($Endpgs)){
                                    
                                    echo "<div class='dycounts'><h6 id='zero' class='mt-1 p-1 text-center font-weight-bold'>[ 1 to $TotalPage Timeline Entry is Not Yet Created! ]</h6></div>";
                                }
                                elseif($Endpgs[0] > $TotalPage) {
                                 echo "<div class='dycounts'><h6 id='wrong' class='mt-1 p-1 text-center font-weight-bold text-bold'>[ $Endpgs[0] is wrong page Number!]</h6>]</div>";
                            }
                                else{
                                   $ep= $Endpgs[0];
                                   $ep++;
                                     echo "<div class='dycounts'><h6 id='remain' class='mt-1 p-1 text-center font-weight-bold'>[ $ep to $TotalPage Timeline Entry is not yet Created! ]</h6></div>";
                                }
                        
                        
                        
   
     
//        echo $_POST['total'];
        
        die();
    }


if(isset($_POST['usrno'])){
    
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
      $cid= mysqli_real_escape_string($con,$_POST['cid']);
     
     $usrno= mysqli_real_escape_string($con,$_POST['usrno']);
      $editor = json_decode($_POST['editors']);
      $doctype= mysqli_real_escape_string($con,$_POST['Doctype']); 
      $dates = mysqli_real_escape_string($con,$_POST['date']);
      $sp= mysqli_real_escape_string($con,$_POST['sp']);
      $ep= mysqli_real_escape_string($con,$_POST['ep']);
      $title= mysqli_real_escape_string($con,$_POST['title']);
      
      $updateq= "UPDATE BreifTimeline_data SET St_pg = '$sp',Ed_pg= '$ep', Doc_type= '$doctype',Title = '$title', Content = '$editor',Date= '$dates' WHERE Sr_no = '$usrno' ";
     if ($con->query($updateq) === TRUE) {
         ?>
 <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>
                            
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit"  scope="col">EDT</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Delete"  scope="col">DEL</th>



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid ={$cid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
                                               
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
                                               
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip"  title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,20); ?></td>
                      
                                                                    <td class=" text-nowrap" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,35); ?></td>
                                                                    <?php $row['Content'] = strip_tags($row['Content']);?>

                                            <th class="text-center text-nowrap" scope="row"style="cursor: pointer;"  data-toggle="modal" data-target="#viewcontent"onclick="dyfunction(<?php echo $row['Sr_no'];?>,<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><a class='nav_link text-center '>View</a></th>

                                                                       
                                                     <th class="text-center" scope="row" style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)">

                                                         <a class="nav_link no " ><?php echo $row['St_pg'] ?></a>
                                                    </th>
                                                 
              <th class="text-center" scope="row"style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)">

                  <a class="nav_link no"><?php echo $row['Ed_pg'] ?></a>                                 
              </th>

                    <th class="text-center" scope="row"style="cursor: pointer;"><a class="nav-link" onclick="Edit(<?php echo $sr;?>,<?php echo $row['Sr_no'];?>,<?php echo $row['St_pg'];?>)">Edit</a>

                            </th>
                             <th class="text-center" scope="row"style="cursor: pointer;">
                                <a class="nav-link text-danger" onclick="Del(<?php echo $row['Sr_no'];?>,<?php echo $cid;?>)">Del</a>
                            </th>

                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

<?php
        
} else {
  echo "Error updating record: " . $con->error;
  
}
     
    
    die();
}

if(isset($_POST['Delsr'])){
   $cid = $_POST['Csr'];
    $srid= $_POST['Delsr'];
    $sql="DELETE FROM BreifTimeline_data WHERE Sr_no = '$srid'";
//echo $sql;
if(mysqli_query($con, $sql)){
    ?>
       <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>
                            
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit"  scope="col">EDT</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Delete"  scope="col">DEL</th>



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid ={$cid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
                                               
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
                                               
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip"  title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,20); ?></td>
                      
                                                                    <td class=" text-nowrap" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,35); ?></td>
                                                                    <?php $row['Content'] = strip_tags($row['Content']);?>

                                            <th class="text-center text-nowrap" scope="row"style="cursor: pointer;"  data-toggle="modal" data-target="#viewcontent"onclick="dyfunction(<?php echo $row['Sr_no'];?>,<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><a class='nav_link text-center '>View</a></th>

                                                                       
                                                     <th class="text-center" scope="row" style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)">

                                                         <a class="nav_link no " ><?php echo $row['St_pg'] ?></a>
                                                    </th>
                                                 
              <th class="text-center" scope="row"style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)">

                  <a class="nav_link no"><?php echo $row['Ed_pg'] ?></a>                                 
              </th>

                      <th class="text-center" scope="row"style="cursor: pointer;"><a class="nav-link" onclick="Edit(<?php echo $sr;?>,<?php echo $row['Sr_no'];?>,<?php echo $row['St_pg'];?>)">Edit</a>

                            </th>
                             <th class="text-center" scope="row"style="cursor: pointer;">
                                <a class="nav-link text-danger" onclick="Del(<?php echo $row['Sr_no'];?>,<?php echo $cid;?>)">Del</a>
                            </th>

                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
    
   <?php
}
else{
    echo "<h3> can't Delect Timeline</h3>";
}
 die();    
}





if(isset($_POST['Editsr'])){
    
    $srid= $_POST['Editsr'];
    $sql="SELECT * FROM BreifTimeline_data WHERE Sr_no = $srid";
      $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
//    echo "<pre>";
//    print_r($row);
//    echo "</pre>";
    ?>

 <form class="mt-2" id="dyform">
          <div class="row">
                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Date</label>
                                                <input class="form-control" placeholder="Date" name="UDate" id="UDate"value="<?php echo $row['Date'];?>">
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Start page</label>
                                                <input class="form-control" type="number" name="USTpg"id="ustpg" placeholder="eg. 1" value="<?php echo $row['St_pg'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">End page</label>
                                                <input class="form-control" type="number" id="uetpg"name="UETpg"placeholder="eg. 4" value="<?php echo $row['Ed_pg'];?>">
                                            </div>
                                        </div>
         
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type</label>
                                                <a class="ml-1" data-toggle="modal" data-target="#AddDocTy">
                                                    (Add)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDocTy">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelDocTy">
                                                    (Del)
                                                </a>
                                                <select class="form-control" style="width:100%;" id="UTdy" placeholder="Choose Document Type.." onchange="document.getElementById('text_UDT').value=this.options[this.selectedIndex].text">
                                                    <option value="" disabled selected><?php echo $row['Doc_type'];?></option>

                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM Document_type");
                                                    while ($rows = $sql->fetch_assoc()) {
                                                        echo "<option value=" . $rows['Sr_no'] . ">" . $rows['Document_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                
                                                     
                              
                                                   <input type="hidden" name="UTDy" id="text_UDT" value="<?php echo $row['Doc_type'];?>" />
                                                   
                                            </div>
                                        </div>
                 </div>
                          <div class="form-group">
                            <label class="font-weight-bold">Enter Title</label>
                                                <input class="form-control" id="UTtitle" name="UTitle"  value="<?php echo $row['Title'];?>"/>
                                            </div>
                                    
                                     <div class="form-group">
                                                <label class="font-weight-bold">Enter Content</label>
                                                <textarea class="form-control" id="Ueditor" required name="UEditor" ><?php echo $row['Content'];?></textarea>
               
                                            </div>
                                    <div class="form-group">
                                        <input type="hidden" id="cid"name="cid"  value="<?php echo $row['Cid'];?>">
                                        <input type="hidden" id="sr" name="sr"value="<?php echo $row['Sr_no'];?>"/>
                                        
                                        <button type="submit" name="USubmit" id="UTsubmit" class="btn btn-primary">Update</button>
                                    </div>
                 
                 
                 
             </form>
<?php
                                            }                }
    die();
    
}
//if(isset ($_POST['uids'])){
//      echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    
//    
//    
//       $ctdate= mysqli_real_escape_string($con,$_POST['date']);
//   $ctstpg= mysqli_real_escape_string($con,$_POST['sp']);
//   $ctendpg= mysqli_real_escape_string($con,$_POST['ep']);
//   $ctdocType= mysqli_real_escape_string($con,$_POST['Doctype']);
//   $ctcid= mysqli_real_escape_string($con,$_POST['uids']);
//   $ctpdf= mysqli_real_escape_string($con,$_POST['pdf']);
//   $cttitle= mysqli_real_escape_string($con,$_POST['title']);
//  //  $cteditor=mysqli_real_escape_string($con,$_POST['editors']);
//   // $cteditor=mysqli_real_escape_string($con,$_POST['CTeditor']);
//    $client_name=mysqli_real_escape_string($con,$_POST['client']);
//    $case_name = mysqli_real_escape_string($con,$_POST['case']);
//    
//    $cteditor = json_decode($_POST['editors']);
//    //
//    //echo $cteditor;
//    
//      $sql ="INSERT into BreifTimeline_data (Cid,St_pg,Ed_pg,Doc_type,Client_Name,Case_Name,Pdf_Name,Title,Content,Date) 
//  VALUE('$ctcid','$ctstpg','$ctendpg','$ctdocType','$client_name','$case_name','$ctpdf','$cttitle','$cteditor','$ctdate')";
//    echo $sql;
//    
//    die();
//}

if(isset ($_POST['uids'])){
//      echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    
    
    
       $ctdate= mysqli_real_escape_string($con,$_POST['date']);
   $ctstpg= mysqli_real_escape_string($con,$_POST['sp']);
   $ctendpg= mysqli_real_escape_string($con,$_POST['ep']);
   $ctdocType= mysqli_real_escape_string($con,$_POST['Doctype']);
   $ctcid= mysqli_real_escape_string($con,$_POST['uids']);
   $ctpdf= mysqli_real_escape_string($con,$_POST['pdf']);
   $cttitle= mysqli_real_escape_string($con,$_POST['title']);
  //  $cteditor=mysqli_real_escape_string($con,$_POST['editors']);
   // $cteditor=mysqli_real_escape_string($con,$_POST['CTeditor']);
    $client_name=mysqli_real_escape_string($con,$_POST['client']);
    $case_name = mysqli_real_escape_string($con,$_POST['case']);
    
    $cteditor = json_decode($_POST['editors']);
    //
    //echo $cteditor;
    
      $sql ="INSERT into BreifTimeline_data (Cid,St_pg,Ed_pg,Doc_type,Client_Name,Case_Name,Pdf_Name,Title,Content,Date) 
  VALUE('$ctcid','$ctstpg','$ctendpg','$ctdocType','$client_name','$case_name','$ctpdf','$cttitle','$cteditor','$ctdate')";
    //echo $sql;
if ($con->query($sql) === TRUE) {
     ?>
   <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>
                            
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit"  scope="col">EDT</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Delete"  scope="col">DEL</th>



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid ={$ctcid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
                                               
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
                                               
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip"  title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,20); ?></td>
                      
                                                                    <td class=" text-nowrap" scope="row"style="" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,35); ?></td>
                                                                    <?php $row['Content'] = strip_tags($row['Content']);?>

                                            <th class="text-center text-nowrap" scope="row"style="cursor: pointer;"  data-toggle="modal" data-target="#viewcontent"onclick="dyfunction(<?php echo $row['Sr_no'];?>,<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><a class='nav_link text-center '>View</a></th>

                                                                       
                                                     <th class="text-center" scope="row" style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)">

                                                         <a class="nav_link no " ><?php echo $row['St_pg'] ?></a>
                                                    </th>
                                                 
              <th class="text-center" scope="row"style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)">

                  <a class="nav_link no"><?php echo $row['Ed_pg'] ?></a>                                 
              </th>

                     <th class="text-center" scope="row"style="cursor: pointer;"><a class="nav-link" onclick="Edit(<?php echo $sr;?>,<?php echo $row['Sr_no'];?>,<?php echo $row['St_pg'];?>)">Edit</a>

                            </th>
                             <th class="text-center" scope="row"style="cursor: pointer;">
                                <a class="nav-link text-danger" onclick="Del('<?php echo $row['Sr_no'];?>')">Del</a>
                            </th>

                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
<input type="hidden" class="lastpage" value="<?php echo $ctendpg;?>"/>
    <?php
}
else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

    
    
    
    
    die();
    
}




//
//if(isset($_POST['CTclientN'])){
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
// 
//    $cteditor = json_decode($_POST['CTeditor']);
//    
//    $ctdate= mysqli_real_escape_string($con,$_POST['CTDate']);
//   $ctstpg= mysqli_real_escape_string($con,$_POST['CTstpg']);
//   $ctendpg= mysqli_real_escape_string($con,$_POST['CTendpg']);
//   $ctdocType= mysqli_real_escape_string($con,$_POST['CTDT']);
//   $ctcid= mysqli_real_escape_string($con,$_POST['CTsR']);
//   $ctpdf= mysqli_real_escape_string($con,$_POST['CTpdf']);
//   $cttitle= mysqli_real_escape_string($con,$_POST['CTtitle']);
//   // $cteditor=mysqli_real_escape_string($con,$_POST['CTeditor']);
//    $client_name=mysqli_real_escape_string($con,$_POST['CTclientN']);
//    $case_name = mysqli_real_escape_string($con,$_POST['CTcaseN']);
//    
   $cteditor= json_decode($cteditor);
//    ?>
 
     <?php
//     $sql ="INSERT into BreifTimeline_data (Cid,St_pg,Ed_pg,Doc_type,Client_Name,Case_Name,Pdf_Name,Title,Content,Date) 
//  VALUE('$ctcid','$ctstpg','$ctendpg','$ctdocType','$client_name','$case_name','$ctpdf','$cttitle','$cteditor','$ctdate')";
//    // echo $sql;
//if ($con->query($sql) === TRUE) {
//     ?>
   <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>
                            
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Edit"  scope="col">EDT</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Delete"  scope="col">DEL</th>



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        //<?php
//                                        $sr = 1;
//                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid ={$ctcid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
//                                      // echo $sql;
//                                        $quariy= $con->query($sql);
//                                   
//                                        $num = mysqli_num_rows($quariy);
//                                        if ($num >= 0) {
//                                            while ($row = mysqli_fetch_array($quariy)) {
//                                                ?>
                                              
                                                    <tr id="row//<?php echo $sr;?>">
                                               
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="//<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
                                               
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip"  title="//<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,20); ?></td>
                      
                                                                    <td class=" text-nowrap" scope="row"style="" onclick="Etpg(//<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,35); ?></td>
                                                                    //<?php $row['Content'] = strip_tags($row['Content']);?>

                                            <td class="text-center text-nowrap" scope="row"style=""  data-toggle="modal" data-target="#viewcontent"onclick="dyfunction(//<?php echo $row['Sr_no'];?>,<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><a class='nav_link text-center '>View</a></td>

                                                                       
                                                     <td class="text-center" scope="row" style="cursor: pointer;" onclick="Etpg(//<?php echo $sr;?>,<?php echo $row['St_pg']?>)">

                                                         <a class="nav_link no " >//<?php echo $row['St_pg'] ?></a>
                                                    </td>
                                                 
              <td class="text-center" scope="row"style="cursor: pointer;" onclick="Etpg(//<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)">

                  <a class="nav_link no">//<?php echo $row['Ed_pg'] ?></a>                                 
              </td>

                    <td class="text-center" scope="row"style=""><a class="nav-link"  href="UploadClientBrief/UpdatetimelineBrief.php?v=//<?php echo $row['Sr_no']?>"onclick="">Edit</a>

                            </td>
                             <td class="text-center" scope="row"style="">
                                    <a class="nav-link text-danger" href="UploadClientBrief/DelTimelineBrief.php?v=//<?php echo $row['Sr_no']?>&c=<?php echo $cid?>">Del</a>
                            </td>

                                                </tr>
                                                //<?php
//                                                $sr++;
//                                            }
//                                        }
//                                        ?>
                                    </tbody>
                                </table>
                            </div>
<input type="hidden" class="lastpage" value="<?php echo $ctendpg;?>"/>
    //<?php
//}
//else {
//
//  echo "Error: ----->" . $sql . "<br>" . $con->error;
//}
//
//    
//    
//    
//    
//    die();
//}
    
    
    
?>
  