  require_once('DBConnection.php');
if(isset($_POST["id"])){
$sql="SELECT * FROM `district` WHERE province_id=".$_POST["id"];
$outpot ='';
$result=$conn->query($sql);
if ($result->num_rows>0) {
     $i=0;
echo'<option value="">selext</option>';
while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
               
        }
        //echo $outpot;
    }
    else{
         echo"<option> no select a</option>";
        }
    }