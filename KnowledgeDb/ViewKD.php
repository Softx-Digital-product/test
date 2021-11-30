<?php
// Include the database connection file
include('Dp.php');

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

   // echo $_POST['countryId'];
	// Fetch state name base on country id
	$query = "SELECT * FROM knowledge_data WHERE Sr_no = ".$_POST['countryId'];
	$result = $con->query($query);
        
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
//                        echo '<Strong> Category : </Strong>'.$row['K_Category'],'&nbsp;&nbsp;';
//                        echo '<Strong> Sub_Category : </Strong>'.$row['K_Sub_Category'],'<br><br>';
//                        echo '<Strong> Type : </Strong>'.$row['K_Type'],'&nbsp;&nbsp;';
//                        echo '<Strong> Date : </Strong>'.$row['K_Date'],'<br><br>';
//                        
//                        echo '<Strong> Title : </Strong>'.$row['K_Title'],'<br><br>';
//
//			echo '<Strong> Content : </Strong>'.$row['K_Content'],'<br>';
                    
                    
                    ?>
<div class="cc p-1 mt-0"><button id="copybtn" data-clipboard-action="copy" 4 data-clipboard-target="#ititle" class=" ml-2 btn btn-sm text-white">copy to clipboard </button></div>
<div class='container-fluid p-0'>
     
    <div class='card'>
        <div class='card-header'>
<!--           <h6><strong><label id="Ktitle"><?php echo $row['K_Title']; ?></label></strong></h6>-->
            <textarea class='' style='width:100%;' readonly id='ititle' value=''><?php echo $row['K_Title']; ?></textarea>
        </div>
        <div class='card-body'>
            <Strong> Category : </Strong><?php echo $row['K_Category'];?>&nbsp;&nbsp;
            <Strong> Sub_Category : </Strong><?php echo $row['K_Sub_Category'];?><br><br>
            <Strong> Type : </Strong><?php echo $row['K_Type'];?>&nbsp;&nbsp;
            <Strong> Date : </Strong><?php echo $row['K_Date'];?><br><br>
            
            <strong> Content : </strong><p id="kcontent" > <?php echo $row['K_Content'];?></p><br>
<!--             <input class='d-none' id='icontent' value="<?php echo $row['K_Content']; ?>"/>-->
        </div>
    </div>
</div>

<?php
                        
		}
	} else {
		echo "Data not availables";
	}
} 
?>


