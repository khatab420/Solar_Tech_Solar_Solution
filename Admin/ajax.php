
<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="admin.css?verssion=8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

      <link href="../style.css?verssion=5" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<!-- show customer history -->
<table class="table table-borderless align-center  table-hover text-center " style="text-align: center;" class="card">
                    <thead>
</thead>
                        <tbody class="text-center">
<?php 
 if(isset($_POST['customers'])){
     include('DBConnection.php');
    $customerIno =$_POST['customers'];
    $sql = "SELECT * FROM `customer` WHERE customer_name LIKE '%$customerIno%'";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
        echo '<tr>
                <td>آی ډی</td>
                <td>نوم</td>
                <td>پلار نوم</td>
                <td>ایمل</td>
                <td>انځور</td>
                <td>نور معلومات<td>

        </tr>   ';
        while($row = $result->fetch_assoc()){
                       
            echo'<tr><td>'.$row["customer_id"].'</td>
                     <td>'.$row["customer_name"].'</td>
                     <td>'.$row["customer_f_name"].'</td>
                     <td>'.$row["customer_email"].'</td>
                     <td><img src="'.$row["cutomer_image"].'"></td>

                     <td><button class="btn btn-primary more" data-id='.$row["customer_id"].' data-bs-toggle="collapse" data-bs-target="#more">نور</button></td>
                   
            </tr>';
        }
    }
    else{
        echo "The customer not found";
    }
 }
 ?>
 
                  
      <script type="text/javascript">
     $(document).ready(function(){
                $('.more').click(function(){
                  var more = $(this).data('id');
                  $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    data: {more: more},
                    success: function(response){
                      $('#more').html(response);
                     //alert(more);
                   //  $('userifo').hide();
                   $('')
                    }
                  });
                
                });
              });
</script>              
                      
                    </tbody>
                  </table>
                  <div id="more" class="collapse card text-end d-flex justify-content-center" style="width:100%">
                        
                        
                  
                   
                  </div> 
 <?php 
 if (isset($_POST["more"])) {
        $moreInfo = $_POST["more"];
        include('DBConnection.php');
        $sql ="SELECT * FROM `customer` WHERE customer_id='$moreInfo'";
        $result = $conn->query($sql);
        $addres1 = "";
        $addres2 = "";
        $addres3 = "";
        $addres4 ="";
        if ($result->num_rows>0) {
             $sql2="SELECT * FROM `location` INNER JOIN province on location.location_province = province.province_id INNER JOIN district ON location.location_district = district.district_id INNER JOIN customer ON location.location_id = customer.customer_address WHERE customer.customer_id ='$moreInfo';";

             $result2 = $conn->query($sql2);
            if ($result2->num_rows>0) {
                while($row = $result2->fetch_assoc()){
                        $addres1=$row["location_name"];
                        $addres2=$row["province_name"];
                        $addres3=$row["district_name"];
                }
            }
            while($row = $result->fetch_assoc()){

                 echo '  <img src="'.$row["cutomer_image"].'" alt="Card image"style="max-height:250px; width:400px">
                         <div class="card-body" style="width:100%; backgroud-color:#fff">
                           <h4 class="card-title" style="padding:5px">نوم:'.$row["customer_name"].'</h4>
                        <p class="card-text "> <span  class="fa fa-map-marker" style="font-size:20px;color:red; padding:5px"> <i></i></span> ادرس:'.$addres1.','.$addres2.','.$addres3.'</p>
                     
                          
                         </div>';
             }
            }
            else{
             echo "OPPS!";
            }
        $sql3="SELECT * FROM `mobile_numbers` WHERE customer_id='$moreInfo'";
        $result3 = $conn->query($sql3);
                             
            if ($result3->num_rows>0) {
                 echo "<p><span  > <i class='fa fa-phone' style='font-size:20px;color:green; padding:5px'></i></span>اړیکې  </p>";
                while($row = $result3->fetch_assoc()){
                    echo'<p style="padding:5px">'. $row["mobile_number"].'</p>

                    ';
                }
                echo '
                    <div class="btn-group">
                     <a href="admin.php?editeprofiles='.$_POST['more'].'" type="button" class="btn btn-primary">Edite Profiles</a>
                     <a href="admin.php?deleteprofiles='.$_POST['more'].'" type="button" class="btn btn-danger">Delete</a>

                    
                    </div>
               ';

            }else{
                  echo "No mobile Numbers Availble";
            }
 }

 ?>
<?php 
    if (isset($_POST['customerhistory'])) {
        $customer = $_POST['customerhistory'];
        include('DBConnection.php');
        $sql="SELECT * FROM customer WHERE customer_name LIKE '%$customer%'";
        $customerName ="";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            echo '<table class="table table-borderless hiden">
    <thead>
      <tr id="userifo">
        <th>نوم</th>
        <th>د پلار نوم</th>
        <th>ایمل</th>
        <td>تاریچه</td>
        <td>عملیات</td>
      </tr>
    </thead>
    <tbody>';
            while($row = $result->fetch_assoc()){
                 $customerName = $row["customer_name"];
               //  define('USERNAME',$customerName);
                echo '  
                <tr><td>'.$row["customer_name"].'</td>
                      <td>'.$row["customer_f_name"].'</td>
                      <td>'.$row["customer_email"].'</td>
                      <td> <button class="btn customer" type="checkbox" data-id='.$row["customer_id"].'>قرض</button></td>
                      <td> <button class="btn bi bi-trash customer" type="checkbox" data-id='.$row["customer_id"].'></button>
                     <button class="btn bi bi-pencil customer" type="checkbox" data-id='.$row["customer_id"].'</button></td>

                </tr>';
            }
        }
    }

 ?>

</tbody>
</table>
<style type="text/css">
    .customer{
        background-color: #1b7c80;
        color: white;
        border-radius: 4%;
    }
    .bi-trash .customer{
        background-color: e;
    }
</style>
 
<?php
    if (isset($_POST['customerid'])) {
           $customerid = $_POST['customerid'];
          include('DBConnection.php');
        // show the loan information releted customer
        $sql ="SELECT * FROM `loan` WHERE customer_id=$customerid";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            // the mobile numbers releted to the customer in and custome r 

               $sql2 = "SELECT customer_name FROM customer WHERE customer_id='$customerid'";
        $result2 = $conn->query($sql2);
        $customerName = $result2->fetch_assoc();
   
        echo'  <table class="table table-borderless text-center">
    <thead>
      <tr id="userio" class="shidden">
        <th>قرض مقدار</th>
        <th>اداینه</th>
       
        <td>ټوټل اداینه</td>
       
      </tr>
    </thead>
    <tbody><p class="text-center" style="color:#c55">'.$customerName["customer_name"].'</p>' ;
            while($row = $result->fetch_assoc()){
                  echo '<tr>
                          
                        <td>'.$row["loan_quantity"].'</td>
                        <td>'.$row["paid_quantity"].'</td>
                        <td>'.$row["total_paid"].'</td>

                        </tr>';
            }
        }
        else{
            echo'   <div class="alert alert-info alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>معلومات!</strong>نوموړی مشتری پوروړی نه دی.
  </div>';
        }
    }
    echo '</tbody>
</table>';
    if (isset($customerid)) {

         $sql3="SELECT * FROM `customer_buy_goods` WHERE customer_id ='$customerid'";
    $result3 = $conn->query($sql3);
    if ($result3->num_rows>0) {

        echo '  <table class="table table-borderless text-center table-striped">
    <thead class=" table-primary"><p class="text-center" style="color:green">اخستل شوی محصولات </p>';
                    echo '<tr>
                          
        <th>محضول</th>
        <th>پولی واخد</th>
        <th>قمت</th>
        <th>د محصول آی ډی</th>
        <th>تاریخ</th>
       
        <td>مقدار</td>
       
      </tr> </thead>
    <tbody>';
        $goods_id ="";
        $currency_id ="";
        while($row = $result3->fetch_assoc()){
             $goods_id  = $row["goods_id"];
             $currency_id = $row["currency_id"];
            
        }
        $sql5 = "SELECT * FROM goods WHERE goods_id='$goods_id'";
        $goods_name ="";
        $result5 = $conn->query($sql5);
        if ($result5->num_rows>0) {
            while($row = $result5->fetch_assoc()){
                $goods_name = $row["goods_name"];
            }
        }
        $sql6 ="SELECT * FROM `currency` WHERE currency_id ='$currency_id'";
        $result6 = $conn->query($sql6);
        $currency_name="";
        if ($result6->num_rows>0) {
            while($row = $result6->fetch_assoc()){
                $currency_name = $row["currency_name"];
            }
        }
        $sql4 ="SELECT * FROM `customer_buy_goods` INNER JOIN goods ON customer_buy_goods.goods_id=goods.goods_id WHERE customer_buy_goods.customer_id='$customerid'";
        $result4= $conn->query($sql4);
        if ($result4->num_rows>0) {
            while($row = $result4->fetch_assoc()){
                echo '<tr>  
                <td>'.$row["goods_name"].'</td>
                   <td>'.$currency_name.'</td>
                   <td>'.$row["price"].'</td>
                   <td>'.$row["goods_id"].'</td>
                   <td>'.$row["buy_date"].'</td>
                   <td>'.$row["quantity"].'</td>
                  </tr>'; 
            }
        }
    }
    }
   echo'</tbody>
      </table>';
  ?>


<!-- get customer id to show the history of customer  -->
<script type="text/javascript">
     $(document).ready(function(){
                $('.customer').click(function(){
                  var customerid = $(this).data('id');
                  $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    data: {customerid: customerid},
                    success: function(response){
                      $('#customerhistory').html(response);
                     // alert(id);
                     $('#userifo').hide();
                    }
                  });
                
                });
              });
</script>
 <?php 
      if (isset($_POST['bill'])) {
            $userid = $_POST['bill'];
             require_once('DBConnection.php');
       $sql="SELECT * FROM `customer` WHERE customer_name LIKE '$userid%'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
           while($row = $result->fetch_assoc()){
          
              echo' 
   
   
      <tr>
        <td>'.$row["customer_name"].'</td>
        <td>'.$row["customer_f_name"].'</td>
        <td>'.$row["customer_email"].'</td>
         <td> <input class="userinfo" type="checkbox" data-id='.$row["customer_id"].'></td>
      </tr>
     
       
   
 ';
                                      
                }

         }
      }

     ?>

<?php 
if (isset($_GET['id'])) {
    // if needed do something here
}

require_once('DBConnection.php');
if(isset($_POST["proID"])){
$sql="SELECT * FROM `district` WHERE province_id=".$_POST["proID"];
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
    ?>

    <div class="container-fluid">
<!-- cllapes for cutoemr deatial area........................................................................................................................ -->
        <div class="row">
            <div class="col">
                <div id="demo" class="collapse mt-3">
                    <form action="">
                        <div class="input-group">
                        <input class="fff" type="text" name="seart_text" id="seart_text" lass="form-control" placeholder="Just type User name" style="width:80%">
                        <div class="input-group-append ">
                        <span class=" form-control bg-transparent text-warning">
                        <button name="search-btn" class="from-control btn btn-primary" ><i class="fa fa-search "></i></button>              
                        </span>
                        </div>
                        </div>
                    </form> 
                <div id="searchresult" class="dddd table " >
                        <!-- For ajax value -->
                </div> 
                <div class="fffff">
                    <!-- For ajax value -->                                           
                </div>
                                                                                            
                </div>
<!-- cllapes for cutoemr deatial end area........................................................................................................................ -->            
            </div>
<?php  

  if (isset($_POST['selecte'])) {
        $_SESSION['selecte']=$_POST['selecte'];
        $_SESSION['selecte'];
    }
  try{
if (isset($_POST["id"])) {
                                   
    $userid = $_POST["id"];

  
   
    $storeid=$_SESSION['selecte'];
                                
    echo'  <a href="liveSearch.php?id='.$userid.'&&store_id='.$storeid.'" class="btn btn-primary"name="confirm" value="confirm">Confirm to Sell Bye Select user</a>'; 

                                 //  $sql ="DELETE FROM customer_buy_goods";
                                 //  include('DBConnection.php');
                                 //   $sqll="SET FOREIGN_KEY_CHECKS = 0;";
                                 // $conn->query($sqll);
                                 //  $conn->query($sql);
                                           
}
  } 
  catch(Exception $e){

  }                                       

?>
   
   <script type="text/javascript">
    $(document).ready(function(){
                              
    $('.fff').keyup(function(){
    var inputs = $(this).val();  
    if (inputs !="") {
         $.ajax({
                url:"liveSearch.php",
                method:"POST",
                data:{inputs:inputs},
                success:function(data){
                        $(".dddd").html(data);
                }
                 });
        } 
                });                              
                               
     });


    </script>
                    
                       <div class="col"> 
                         
                        <?php  
                    
                        if (isset( $_POST['userid'])) {
                            $userid = $_POST['userid'];
                            $_SESSION["favcolor"] = $userid;
                            // echo $userid;
                            include('DBConnection.php');
                            $sql ="SELECT * FROM `goods`WHERE goods_id=".$userid;
                            $result = $conn->query($sql);
                            while($row = $result ->fetch_assoc()){
                                $_SESSION['goods_name'] = $row['goods_name'];
                                $_SESSION['category_id'] = $row['category_id'];
                                $_SESSION['goods_id']= $row['goods_id'];
                                $_SESSION['currency']= $row['currency'];
                                $_SESSION['buy_price']= $row['buy_price'];
                                $_SESSION['entry_date']= $row['entry_date'];
                                $_SESSION['unit_id'] = $row["unit_id"];
                                echo '<div class="row">
                                         <img class="card-img-top img-rsponsive" src="'.$row["image"].'" style="width:100%; height:260px; display: inline-block; border-reduced:5px">
                                            <div class ="col">  
            
                                                 <div class="card" style="width:100%">
                                                     <div class =""></div> 
                                                          <div class="card-body text-end">
                                                             <h4 class="card-title"> د محصول په اړه مالومات</h4>
                                                                <ul style="list-style-type:none">
                                                                    <li><span>نوم:</span>' .$row["goods_name"].'</li>
                                                                    <li><span>چزیات:</span>'.$row["goods_discription"].'</li>
                                                                    <li><span>د اخستلو بیه :</span>' .$row["buy_price"].'</li>
                                                                 </ul>
                                                   <a href="#demo" class="btn btn-outline-warning d-flex justify-content-center" data-bs-toggle="collapse" style ="text-align:center;width:100%">Sell</a>
                                                            
                                                            </div>
                                            </div> </div>
                                       </div>


                                       ';
                             }
                         }
    
 ?>                 </div>
     </div> 
 
 </div>  

</body>
   <script type="text/javascript">
                         $(document).ready(function(){
                            $("#seart_text").keyup(function(){
                                var inputs = $(this).val();
                                alert(inputs);
                            });
                         });  
                       </script>
</html>
                            
                            
                            
                            
                          
                   