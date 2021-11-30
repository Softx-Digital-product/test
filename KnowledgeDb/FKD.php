<?php
// Include the database connection file
include('Dp.php');
$categ=""; $id="";
if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

   // echo $_POST['countryId'];
	// Fetch state name base on country id
	$query = "SELECT * FROM knowledge_data WHERE Sr_no = ".$_POST['countryId'];
	$result = $con->query($query);
        
        
	if ($result->num_rows > 0) {
            
             while( $row = mysqli_fetch_array($result) ){
      $categ = $row['K_Category'];
      $data = $row['K_Content'];

      $users_arr[] = array("id" => $categ, "name" => $data);
   }
}
// encoding array to json format
echo json_encode($users_arr);

//		while ($row = $result->fetch_assoc()) {
//		echo $row['K_Content'];
//                       $categ=$row['K_Category'];
//                      //echo '<option  id="CData" value="'.$row['Sr_no'].'">'.$row['K_Category'].'</option>';
//                    //echo $categ;
//		
                //}
//                 $querys = "SELECT * FROM knowledge_categ WHERE Category = '$categ'";
//	$results = $con->query($querys);
//        echo '<option value="">'.$categ.'</option>';
//	if ($results->num_rows > 0) {
//		while ($row = $results->fetch_assoc()) {
//			//echo '<option value="'.$row['Sr_no'].'">'.$row['Category'].'</option>';
//		}
//	} else{
//            echo 'No data Found Category';
//        }
                
	}
        else {
		echo "Data not availables";
	}
         
 

?>