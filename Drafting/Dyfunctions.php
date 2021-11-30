
<?php
include '../Database/Dp.php';


if(isset($_POST['StatusN'])){
    
       $StatusName=  mysqli_real_escape_string($con,$_POST['StatusN']);  
      
       $sql = "INSERT INTO DStatus(DStatus) VALUES ('$StatusName')";
        if ($con->query($sql) === TRUE) {
                $fq = mysqli_query($con, "SELECT * FROM DStatus");
      echo " <option value='' disabled selected>Please Choose Status </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['DStatus'] . "</option>";
                                    }
        }else{
            echo "Error: ----->" .$sql . "<br>" . $con->error;
        }

    die();
}



if(isset($_POST['EditStatusId'])){
    
      $StatusId=  mysqli_real_escape_string($con,$_POST['EditStatusId']);  
       $NewName=  mysqli_real_escape_string($con,$_POST['StatusNs']);  
       
       $sql="UPDATE DStatus SET DStatus='$NewName' WHERE Sr_no = '$StatusId'";
          if ($con->query($sql) === TRUE) {
                     $fq = mysqli_query($con, "SELECT * FROM DStatus");
      echo " <option value='' disabled selected>Please Choose Status </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['DStatus'] . "</option>";
                                    }
          }else{
              echo "Error--->".$sql."<br>".$con->error;
          }
    
    die();
    
}



if(isset($_POST['DelStatusId'])){
          $StatusId=  mysqli_real_escape_string($con,$_POST['DelStatusId']);  
          
          $sql="DELETE FROM DStatus WHERE Sr_no = '$StatusId'";
             if ($con->query($sql) === TRUE) {
                     $fq = mysqli_query($con, "SELECT * FROM DStatus");
      echo " <option value='' disabled selected>Please Choose Status </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['DStatus'] . "</option>";
                                    }
          }else{
              echo "Error--->".$sql."<br>".$con->error;
          }
          
    
    die();
}

if(isset($_POST['DtypeAdd'])){
     
    $DTname= mysqli_real_escape_string($con, $_POST['DtypeAdd']);
    
    $sql="INSERT INTO DraftTypes(DName) VALUES ('$DTname')";
    if ($con->query($sql) === TRUE) {
                $fq = mysqli_query($con, "SELECT * FROM DraftTypes ");
      echo " <option value='' disabled selected>Please Choose Draft Types </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['DName'] . "</option>";
                                    }
        }else{
            echo "Error: ----->" .$sql . "<br>" . $con->error;
        }
    die();
}


if(isset($_POST['DtypeEditId'])){
      $DTId= mysqli_real_escape_string($con, $_POST['DtypeEditId']);
      $NewDTname= mysqli_real_escape_string($con, $_POST['DtypeEdit']);
      
             $sql="UPDATE DraftTypes SET DName='$NewDTname' WHERE Sr_no = '$DTId'";
          if ($con->query($sql) === TRUE) {
                     $fq = mysqli_query($con, "SELECT * FROM DraftTypes");
      echo " <option value='' disabled selected>Please Choose Draft Type </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['DName'] . "</option>";
                                    }
          }else{
              echo "Error--->".$sql."<br>".$con->error;
          }

    die();
    
}


if(isset($_POST['DtypeDelId'])){
    
        $DTId= mysqli_real_escape_string($con, $_POST['DtypeDelId']);
        
         $sql="DELETE FROM DraftTypes WHERE Sr_no = '$DTId'";
             if ($con->query($sql) === TRUE) {
                     $fq = mysqli_query($con, "SELECT * FROM DraftTypes");
      echo " <option value='' disabled selected>Please Choose Draft Type </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['DName'] . "</option>";
                                    }
          }else{
              echo "Error--->".$sql."<br>".$con->error;
          }
    
        
    die();
}


?>