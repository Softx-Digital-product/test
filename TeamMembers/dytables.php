<?php

include '../UploadCase/Dp.php';


        if(isset($_POST['ClientName']))
        {
        $data= json_decode($_POST['ClientName']);



        ?>  
    
   <?php
                                        $sr = 1;
//                                         $sql= "SELECT ClientDb.Full_Name, ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status, assignteam.Desc,assignteam.Status,assignteam.assign
//FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no AND ClientDb.Full_Name = '$data'" ;
                                     $sql= "SELECT ClientDb.Sr_no as csr,ClientDb.Full_Name, ClientDb.Email, TeamMembers.Name,TeamMembers.Surname,TeamMembers.Mail_Id, TeamMembers.UserName, assignteam.Status, assignteam.Desc,assignteam.Status,assignteam.assign FROM ClientDb, TeamMembers, assignteam WHERE assignteam.Client_Name = ClientDb.Sr_no AND assignteam.Name = TeamMembers.Sr_no AND TeamMembers.UserName = '$data'";
                                        // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
                                                   // echo $row['assign'];
                                                ?>
<div class="container-fluid text-center mt-0 pt-4 box dyboxs" id="clientN<?php echo $row['csr'];?>"onclick="caseN('<?php echo $row['Full_Name']?>',<?php echo $row['csr'];?>)" >
    <a class="text-center h3 mt-2 mtext " ><?php  echo $row['Full_Name']."<br>"; ?></a><br>
<?php if($sr=='1'){
    ?>
     <script>caseN('<?php echo $row['Full_Name'];?>',<?php echo $row['csr'];?>);</script>
    <?php
}
?>
   
</div>  
                                               
                                                <?php
                                               
                                                if($row['Full_Name'] == ''){
                                                    ?>
<div class="container-fluid text-center mt-0 pt-4 box">
    <a>Not Found</a><br>
</div> 
                                               <?php 
                                                }
                                                $sr++;
                                            }
                                        }else{
  
                                        }
                                        ?>


<?php

//echo "$data";
}
?>


<?php
if(isset($_POST['CaseName']))
{
    $data= json_decode($_POST['CaseName']);
    
    
   // echo $data;
    
 $src= 1;
                                         $sql= "SELECT * from Client_CaseDb WHERE Client_Name = '$data'" ;
                                     // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
                                                   // echo $row['assign'];
                                                
                                            
                                                ?>
<div class="container-fluid text-center mt-0 pt-4 box dybox" id="caseN<?php echo $row['Sr_no'];?>"onclick="caseD('<?php echo $row['Case_Name']?>',<?php echo $row['Sr_no']?>)" >
    <a class="text-center h3 mt-2 mtext" ><?php  echo $row['Case_Name']."<br>"; ?></a><br>
</div> 
<?php
if($src == 1){

?>
  <script>caseD('<?php echo $row['Case_Name'];?>',<?php echo $row['Sr_no'];?>);</script>

    <?php
  
}
  $src++;
?>


<?php
                             
    }
  
 }
}
?>


<?php
if(isset($_POST['CaseDetails']))
{
    $data= json_decode($_POST['CaseDetails']);
    
    
   // echo $data;
    $sr = 1;
                                         $sql= "SELECT * from Client_CaseDb WHERE Case_Name = '$data'" ;
                                      // echo $sql;
                                        $quariy = $con->query($sql);
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                            
                                                  
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                
                                            
                                                ?>
<div class="container-fluid mt-2 cd" >
    <label><span class="font-weight-bold">Client Name : </span> <?php echo $row['Client_Name'];?>  </label><br><br>
    <label><span class="font-weight-bold">Case Name: </span> <?php echo $row['Case_Name'];?>  </label><br><br>
     <label><span class="font-weight-bold">Case Number : </span> <?php echo $row['Case_Number'];?>  </label>&emsp;
<!--     Case_Year-->
    <label><span class="font-weight-bold">Case Status : </span> <?php echo $row['Case_Status'];?>  </label><br><br>
    
    <label><span class="font-weight-bold">Court Name : </span><?php echo $row['Court_Name'];?>  </label><br><br>
    <label><span class="font-weight-bold">Case Type : </span> <?php echo $row['Case_Type'];?>  </label>&emsp;
    <label><span class="font-weight-bold">Case Sub Type : </span> <?php echo $row['Case_SubType'];?>  </label><br><br>
    <label><span class="font-weight-bold">Case_Category : </span> <?php echo $row['Case_Categ'];?>  </label>&emsp;
    <label><span class="font-weight-bold">Case Sub Category : </span> <?php echo $row['Case_SubCateg'];?>  </label><br><br>
    <label><span class="font-weight-bold">Case Description : </span> <?php echo $row['Case_Desc'];?></label><br><br>
</div> 


<?php 
}}}
?>
