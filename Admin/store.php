<?php 
require_once('DBConnection.php');
$sql="SELECT * FROM `district` WHERE province_id=".$_POST["provID"];
$outpot ='';
$result=$conn->query($sql);
if ($result->num_rows>0) {
	$i=0;

while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
 			
        }
        //echo $outpot;
    }
    else{
         echo"<option> No Disrrice available Please Add frirt</option>";
        }
 ?>