<?php
$location ="http://apajuris.in/work/TestingDS.php";
include 'Dp.php';
$id = $_GET['v'];

    $sql="DELETE FROM knowledge_data WHERE Sr_no = {$id}";
    if(mysqli_query($con, $sql)){

        //header("Location: http://localhost/Inventorymanagement/pdf.php");
      header("Location:" .$location);
       echo " Delete Succesfully";
    }
    else{
        echo "<h3> can't Delect KD </h3>";
    }
    mysqli_close($con);
    ?>
