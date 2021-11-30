<?php
include 'Dp.php';

if(isset($_GET['v'])){
$id = $_GET['v'];

            $TUser= mysqli_real_escape_string($con,$_GET['u']);
//echo  $id;
$sql="Update TeamMembers SET status ='Inactive' WHERE Sr_no = '$id'";
if(mysqli_query($con, $sql)){
 

//   echo " Delete Succesfully";

    $unassgin = "UPDATE ClientDb SET Assign = '0' WHERE  Assign= '$id'";
    if(mysqli_query($con, $unassgin)){
        
          $colum="UPDATE clientAssign SET Client1='0',Client2='0',Client3='0',Client4='0',Client5='0',Client6='0',Client7='0',Client8='0',Client9='0',Client10='10' WHERE Tid = '$TUser' "; 
               if(mysqli_query($con, $colum)){
                   echo "Removing all Clinets";
                   $Dsql="DELETE FROM assignteam WHERE name = '$id' ";
echo $Dsql;
if ($con->query($Dsql) === TRUE) {
    echo "All Done";
}else{
      echo "ERROR===> ".$Dsql. "<br>".$con->error;
}
               }else{
                   echo "ERROR===> ".$colum. "<br>".$con->error;
               }
    }else{
        echo "Error: ----->" . $unassign . "<br>" . $con->error;
    }
 
    header("Location:http://apajuris.in/work/Team.php");
    die();
}
else{
    echo "<h3> can't Delect user </h3>";
}

die();
}
?>

<?php 
if(isset($_GET['S'])){
    $id= $_GET['S'];
    $sql="Update TeamMembers SET status ='Active' WHERE Sr_no = '$id'";
if(mysqli_query($con, $sql)){
 

   echo " Delete Succesfully";

   
    header("Location:http://apajuris.in/work/Team.php");
    die();
}
else{
    echo "<h3> can't Delect user </h3>";
}
    
}

?>
