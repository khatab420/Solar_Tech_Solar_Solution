<?php 
session_start();
 ?>

<!-- Recently sold products
 -->

 <?php

 function recentlly(){
    $lint =1;
    if (isset($_GET['view'])) {
        $lint = $_GET['view'];
    }
   $sql ="SELECT customer_buy_goods.price, customer_buy_goods.quantity,goods.goods_name,goods.buy_price, (customer_buy_goods.price-goods.buy_price)*customer_buy_goods.quantity AS re FROM goods,customer_buy_goods WHERE customer_buy_goods.goods_id=goods.goods_id ORDER by goods.goods_id DESC LIMIT $lint;";
 include('DBConnection.php');
 $result = $conn->query($sql);
 if ($result->num_rows>0) {
       while($row = $result->fetch_assoc()){
        echo' <tr class="">    
                     <th>'.$row["goods_name"].'</th>
                   
                     <th>'.$row["buy_price"].'</th>
                     <th> '.$row["price"].'</th>
                     <th>'.$row["re"].'</th>
                    
                 </tr>';
       }
   }  
 }


  ?>
<?php 
// create user acounts or serller acounts
    try{
        function createUser(){


        $name = $_POST["name"];
        $user_name  =$_POST["user_name"];
        $userfname  = $_POST["userfname"];
        $user_email =$_POST["user_email"];
        $province   = $_POST["province"];
        $dist       = $_POST["dist"];
        $location   = $_POST["location"];
        $role       = $_POST["role"];
        $mobile     = $_POST["mobile"];
        $mobile1    = $_POST["mobile1"];
        $mobile2    = $_POST["mobile2"];
        $image      = $_FILES["image"];
        $password   = $_POST["password"];
         $uniquesavename=time().uniqid(rand());
  $targetDir = "uploads/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir.$uniquesavename.$fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                

        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    
}
     $sql = "INSERT INTO `seller` (`seller_id`, `seller_name`, `seller_fname`, `seller_user_name`, `seller_password`, `seller_email`, `seller_image`, `seller_address`, `role`) VALUES (NULL,'$name','$userfname ','$user_name',' $password', ' $user_email',' $targetFilePath', '$dist','$role');";
        include('DBConnection.php');
        if ($conn->query($sql)) {
                echo "user created";
        }
        

    }
  }catch(Exception $e){

    }

 ?>
<?php 
if (isset($_POST["provID"])) {
    require_once('DBConnection.php');
$sql="SELECT * FROM `district` WHERE province_id=".$_POST["provID"];
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
function addcustomer(){
   // echo  $filename = $_FILES["uploadfile"]["name"];
$name =$_POST['customoer_name'];
$fname=$_POST['customerfname'];
$email = $_POST['customer_email'];
$location = $_POST['location'];
 require_once('DBConnection.php');


// $sqll="SET FOREIGN_KEY_CHECKS = 0;";
// $conn->query($sqll);
$location = $_POST['location'];
    $dist = $_POST['dist'];
    $province =$_POST['province'];
    $sql2="INSERT INTO `location` (`location_name`, `location_province`, `location_district`) VALUES ( '$location', '$province', '$dist');";
    if (!$conn->query($sql2)) {
        echo "opps!";
    }

    // set the customer address
$sql3 ="SELECT location_id FROM `location` ORDER BY `location_id` DESC LIMIT 1";
$result = $conn->query($sql3);
$id = $result->fetch_assoc();
$locationid=$id["location_id"];
//$conn->query($sql2);
// select image and uploaded it as customer profile image
 $uniquesavename=time().uniqid(rand());
  $targetDir = "uploads/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir.$uniquesavename.$fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                

        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    
}

$sql7 ="INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_f_name`, `customer_email`,`cutomer_image`,`customer_address`) VALUES (NULL, '$name', '$fname', '$email','$targetFilePath','$locationid')";
if(!$conn->query($sql7)){
    echo "opps some wrong";
}
else{
    success();
}
// add mobile numbers
$sql4 ="SELECT customer_id FROM `customer` ORDER BY `customer_id` DESC LIMIT 1";
$result = $conn->query($sql4);
$id = $result->fetch_assoc();
$mobile=$id["customer_id"];
$mobileNO =$_POST['mobile'];
$sql5 ="INSERT INTO `mobile_numbers` (`mobile_number`, `customer_id`) VALUES ('$mobileNO', '$mobile');";
$conn->query($sql5);
    
$mobileNO1 =$_POST['mobile1'];
$sql5 ="INSERT INTO `mobile_numbers` (`mobile_number`, `customer_id`) VALUES ('$mobileNO1', '$mobile');";
$conn->query($sql5);

$mobileNO2 =$_POST['mobile2'];
$sql5 ="INSERT INTO `mobile_numbers` (`mobile_number`, `customer_id`) VALUES ('$mobileNO2', '$mobile');";
$conn->query($sql5);
      //header( "Location: admin.php" ); 


}
if (isset($_POST['submit'])) {
  // setaddress();
    addcustomer();
     
}
// Add category
 function addcate(){
    try {
        include('DBConnection.php');
    $catename =$_POST['category_name'];
    $sql="INSERT INTO `category` (`categ_name`) VALUES ('$catename');";
    if (!$conn->query($sql)) {
        echo'opps!';
    }
    else{
       echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                
               </script>;'; 
    }

    }
    catch(Exception $e){
        echo $e->getMessage();
    }
   
 }
 // add company 
 function addco(){
    try {
        $coname =$_POST['company_name'];
    include('DBConnection.php');
    $sql="INSERT INTO `company` (`comp_name`) VALUES ('$coname');";
    if ($conn->query($sql)) {
         echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                
               </script>;'; 
    }else{
         echo' ("<script LANGUAGE="JavaScript">
                 window.alert("Opps");
                 window.location.href="admin.php";
               </script>");';
    }
    }catch(Exception $e){

    }
   
 }
 // add countery
 function  addcounter(){
    try {
      include('DBConnection.php');
      $countery_name=$_POST['countery_name'];
      $sql="INSERT INTO `country` (`count_name`) VALUES (' $countery_name');";
      if ($conn->query($sql)) {
       echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                
               </script>;'; 
    }
    else{
        echo' <script LANGUAGE="JavaScript">
                 window.alert("Opps");
                 window.location.href="admin.php";
               </script>"'; 
    }
  
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    
 }
 // add currecy
 try {
    function addCurrency(){
        include('DBConnection.php');
        $countery_name = $_POST['currency_name'];
        $currency_sign = $_POST['currency_sign'];
        $sql ="INSERT INTO `currency` (`currency_id`, `currency_name`, `currency_symbol`) VALUES (NULL, '$countery_name', '$currency_sign');";
        if ($conn->query($sql)) {
           echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                
               </script>;'; 
        }
        else{
             echo' ("<script LANGUAGE="JavaScript">
                     window.alert("Opps");
                
                   </script>");';  
        }
    }
 }
 catch(Exception $e){
    echo $e->getMessage();
 }
 function addUnit(){
    try {
         include ('DBConnection.php');
         $unit_name = $_POST['unit_name'];
         $sql="INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES (NULL, '$unit_name');";
         if ($conn->query($sql)) {
            
                  echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                        window.location.href="";
               </script>;'; 
         }
         else{
             echo' ("<script LANGUAGE="JavaScript">
                     window.alert("Opps");
                
                   </script>");'; 
         }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
   
 }
  function addStore(){
    try {
         include ('DBConnection.php');
          $location = $_POST['location_name'];
         $dist = $_POST['district'];
         $province =$_POST['address'];
         $sql2="INSERT INTO `location` (`location_name`, `location_province`, `location_district`) VALUES ( '$location', '$province', '$dist');";
         if (!$conn->query($sql2)) {
           echo "opps!";
        }

            
                  echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                        
               </script>;'; 
         $sql ="SELECT * FROM `location` ORDER BY location_id desc limit 1";
         $id = $conn->query($sql);
         $addres="";
         while($row = $id->fetch_assoc()){
            $addres = $row["location_id"];
         }
         $store_name = $_POST['store_name'];
         //$store_address = $_POST['store_address'];
         $sql="INSERT INTO `store` (`store_id`, `store_name`, `store_address`) VALUES (NULL, '$store_name', '$addres');";
         if ($conn->query($sql)) {
       
         $conn->query($sqll);
          echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                        
               </script>;'; 
         }
         else{
             echo' ("<script LANGUAGE="JavaScript">
                     window.alert("Opps");
                
                   </script>");'; 
         }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
     
 }
    try{
         function laon(){
        if (isset($_POST['loan'])) {
            $loan_quqntity = $_POST["loan_quantity"];
            $paid_quantity = $_POST["paid_quantity"];
            $total_paid    = $_POST["total_paid"];
            $select        = $_SESSION['selecte'];
             include('DBConnection.php');
             $sqll="SET FOREIGN_KEY_CHECKS = 0;";
            $conn->query($sqll);
             $sql = "INSERT INTO `loan` (`loan_id`, `loan_quantity`, `paid_quantity`, `total_paid`, `customer_id`) VALUES (NULL, '$loan_quqntity', '$paid_quantity', '$total_paid', '$select');";
             if ($conn->query($sql)) {
                echo' <script LANGUAGE="JavaScript">
                         swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                      </script>;';
             }
        }
        }
    }catch(Exception $e){

    }
    // Dashboaerd -----------------------------------------------------------------------------------------------------------------//
   
       

 ?>

  
<!DOCTYPE html>
<html>
<head>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="admin.css?verssion=2">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
 <link href="../style.css?verssion=4" rel="stylesheet">

</head>
<body>
<header class="py-3 mb-4 border-bottom shadow">
    <div class="container-fluid align-items-center d-flex">

        
        <div class="flex-grow-1 d-flex align-items-center">
             <div class="flex-shrink-0 dropdown">
                <?php 
                    if (isset($_POST["user_name"])) {
                        $user_name = $_POST["user_name"];
                        $sql="SELECT seller_email from seller WHERE seller_user_name =".$user_name;
                        include('DBConnection.php');
                        $result= $conn->query($sql);
                        if ($result->num_rows) {
                            while($row = $result->fetch_assoc()){
                                echo ' <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://via.placeholder.com/28?text=!" alt="user" width="32" height="32" class="rounded-circle">
                </a>';
                            }
                        }
                        else{
                            echo 'no';
                        }

                    }
                    

                 ?>
               

                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2" style="">
                   
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item btn btn-primary" data-bs-toggle="modal" data-bs-target="#user"href="#">Manage Users</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
            <form class="w-100 me-3">
                <input type="search" class="form-control" placeholder="Search...">
            </form>
            <div class="col-lg-4 d-flex justify-content-start ">

        <a href="" class="text-decoration-none">
            <span class="h1 text-uppercase text-warning bg-dark px-2">SOLAR</span>
            <span class="h1 text-uppercase text-dark bg-warning px-2 ml-n1">SYSTEM</span>
        </a>
       </div>
           
        </div>
    </div>
</header>
<div class="container-fluid ">
    <div class="row ">
<!-- user area strat -->
<div class="modal fade" id="user">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Manage Users</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="direction: rtl; text-align:right;">
        <div class="container mt-3" style="direction:rtl">
<div class="row">
    <div class="col">
        
    </div>
    <div class="col">
        <a type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#ManageUser" style="text-align:righ"><i class="fa fa-user" style="padding:5px;color: white;"></i>نوی یوز</a>
  <div id="ManageUser" class="collapse" style="direction: rtl; text-align: center;">
        <div class="">
            <form method="post" class="row g-3 needs-validation" novalidate style="text-align:right;" enctype="multipart/form-data">
                    <div class="col-6">
                      <label for="yourName" class="form-label">نوم</label>
                      <input type="text" name="name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please fill the feld!</div>
                    </div>
                    <div class="col-6">
                      <label for="yourName" class="form-label">یړز</label>
                      <input type="text" name="user_name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please fill the feld!</div>
                    </div>
                    <div class="col-6">
                      <label for="yourEmail" class="form-label">پلار نوم</label>
                      <input type="TEXT" name="userfname" class="form-control" id="" required >
                      <div class="invalid-feedback">Please enter number!</div>
                    </div>
                     <div class="col-6">
                      <label for="yourEmail" class="form-label">پاسورډ</label>
                      <input type="password" name="password" class="form-control" id="" required >
                      <div class="invalid-feedback">Please enter number!</div>
                    </div>
                    <div class="col-6">
                      <label for="yourEmail" class="form-label">تايدی پاسورډ</label>
                      <input type="password"class="form-control" id="" required >
                      <div class="invalid-feedback">Please enter number!</div>
                    </div>
                    <div class="col-6">
                      <label for="yourEmail" class="form-label">ایمل</label>
                      <input type="email" name="user_email" class="form-control" id="" required >
                      <div class="invalid-feedback">Please enter price!</div>
                    </div>
                   <label for="for add" class="form-label">ادرس</label>
                     <div class="col-6 input-group" >
                      
                   
                      <div class="invalid-feedback">Please enter price!</div>

                        <label for="for add" class="form-label">ولایت</label>
                      <select id="province" name="province" onchange="province(this.value)">
                      <?php 
                      try{
                            require_once('DBConnection.php');
  
                             $sql="SELECT * FROM `province`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["province_id"].'">'.$row["province_name"].'</option>';
                                 }
     
                                }
                      }
                      catch(Exception $e){

                      }

                        ?>
                      </select>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#province').on('change', function(){
                                var pro_id = $(this).val();
                                $.ajax({
                                    url: 'ajax.php',
                                    method:'POST',
                                    data: {proID: pro_id},
                                    dataType: "text",
                                    success:function(html){
                                            $('#dist').html(html);
                                    }
                                });
                            });
                          });
                      </script>
                      <label for="for add" class="form-label">ولسوالی</label>
                      <select id="dist" name="dist">
                         <option value="">ولسوالی</option>
                      </select>
                       <label for="for add" class="form-label">کلی</label>
                      <input  class="form-control" id="locationd" name="location">
                      <div class="invalid-feedback">Please enter price!</div>
                    </div>
                      <div class="form-label">د اړیکو شمرې</div>
                      <div class="col-12">
                      <label for="for add" class="form-label">1. موبایل نمبر</label>
                      <input type="text" name="mobile" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter price!</div>
                       <label for="for add" class="form-label">2. موبایل نمبر</label>
                      <input type="text" name="mobile1" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter price!</div>
                       <label for="for add" class="form-label">3.موبایل نمبر</label>
                      <input type="text" name="mobile2" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter price!</div>
                       <div class="col-12">
                      <label for="for file" class="form-label">انځور</label>
                      <input class="form-control" type="file" name="image" value="" />
                      <div class="invalid-feedback">Please enter price!</div>
                    </div>
                    </div>
                     <div class="col-12">
                      <label for="yourName" class="form-label">رول</label>
                      <select class="form-control" name="role">
                          <option value="1">Admin</option>
                          <option value="2">User</option>
                      </select>
                    </div>
                    
                   
                          <div class="text-center mt-5">

                            <input type="submit" name="createUser"class="btn btn-primary btn-submit" >
                           
                         </div>                   

                     
                    </form>
        </div>
  </div>

    </div>
</div>
  
</div>



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
    if (isset($_POST["createUser"])) {
       createUser();
    }

  ?>
<!-- user area end -->
       <main class="col-lg-9 col-md-8 col-sm-3 overflow-auto h-100">

            <div class="bg-light border rounded-3 p-3">
              <div class="row">
                   <!-- Customers Card -->
            <div class="col-xxl-4 col-md-4" style="direction:rtl; text-align: right;">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>پلټنه</h6>
                    </li>
                    <li>  <a  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addcustomer" style="text-align:right;">
                      نوی مشتری <i class="bi-plus"></i>
                        </a></li>
                    <li><a class="dropdown-item" href="#"style="text-align:right;">نن</a></li>
                    <li><a class="dropdown-item" href="#"style="text-align:right;">میاشت</a></li>
                    <li><a class="dropdown-item" href="#"style="text-align:right;">کال</a></li>
                     <li>  <a  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#customerHistory" style="text-align:right;">
                      تاریخچه<i class="bi-plu"></i>
                        </a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">مشتریان <span>| کال</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <?php 

                             try{

                                   include('DBConnection.php');
                                   $sql2 ="SELECT COUNT(customer.customer_id) AS NumberOfcustomer FROM customer;";
                                   $result = $conn->query($sql2);
                                     if ($result->num_rows>0) {

                                         $row = $result->fetch_assoc();
                                          echo '<h6>'.$row['NumberOfcustomer'].'</h6>'; 
                                    }
                                
                               }
                               catch(Exception $e){
                             }
                         ?>
                      
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">ریات شوی</span>

                    </div>
                  </div>

                </div>
              </div>

<!--  add new customer modal start here------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
 <!-- edite and delete customer profiles -->

<?php
    try{
          $name='';
            $fname='';
            $email ='';

        if(isset($_GET['editeprofiles'])){
           $id= $_GET['editeprofiles'];
            echo '<script> 
                    $(document).ready(function(){
                            $("#addcustomer").modal("show");
                        });
                     
              
                 
           
                 </script>';
                  $sql = "SELECT * FROM `customer` INNER JOIN location ON customer.customer_address = location.location_id INNER JOIN district ON location.location_district = district.district_id INNER JOIN province ON district.province_id = province.province_id WHERE customer_id='$id';";
                  include('DBConnection.php');
                  $result = $conn->query($sql);

                  if ($result->num_rows>0) {
                    $sql2 ="SELECT * FROM `mobile_numbers` WHERE customer_id ='$id'";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows>0) {
                        
                    }
                      while($row = $result->fetch_assoc()){
                        $name = $row["customer_name"];
                        $fname = $row["customer_f_name"];
                        $email = $row["customer_email"];
                      }
                  }
        }
       
    }catch(Exception $e){

    }
 ?>
    <div class="modal fade" id="addcustomer" data-backdrop="static" data-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                
                <div class="px-4 py-5">
                        <h5 class="card-title"><span>د مشتری معلومات د ننه کړي!</span></h5>
                   
                  <form method="post" class="row g-3 needs-validation" novalidate style="text-align:right;" enctype="multipart/form-data">
                    <div class="col-12">
                      <label for="yourName" class="form-label">نوم</label>
                      <input type="text" name="customoer_name" class="form-control" id="" required value=<?php echo $name;  ?>>
                      <div class="invalid-feedback">Please fill the feld!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">پلار نوم</label>
                      <input type="tex" name="  customerfname" class="form-control" id="" required value=<?php echo $fname;  ?>>
                      <div class="invalid-feedback">Please enter number!</div>
                    </div>
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">ایمل</label>
                      <input type="email" name="customer_email" class="form-control" id="" required value=<?php echo $email;  ?>>
                      <div class="invalid-feedback">Please enter price!</div>
                    </div>
                   <label for="for add" class="form-label">ادرس</label>
                     <div class="col-12 input-group" >
                      
                   
                      <div class="invalid-feedback">Please enter price!</div>

                        <label for="for add" class="form-label">ولایت</label>
                      <select id="province" name="province" onchange="province(this.value)">
                      <?php 
                      try{
                            require_once('DBConnection.php');
  
                             $sql="SELECT * FROM `province`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["province_id"].'">'.$row["province_name"].'</option>';
                                 }
     
                                }
                      }
                      catch(Exception $e){

                      }

                        ?>
                      </select>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#province').on('change', function(){
                                var pro_id = $(this).val();
                                $.ajax({
                                    url: 'ajax.php',
                                    method:'POST',
                                    data: {proID: pro_id},
                                    dataType: "text",
                                    success:function(html){
                                            $('#dist').html(html);
                                    }
                                });
                            });
                          });
                      </script>
                      <label for="for add" class="form-label">ولسوالی</label>
                      <select id="dist" name="dist">
                         <option value="">ولسوالی</option>
                      </select>
                       <label for="for add" class="form-label">کلی</label>
                      <input  class="form-control" id="locationd" name="location">
                      <div class="invalid-feedback">Please enter price!</div>
                    </div>
                      <div class="form-label">د اړیکو شمرې</div>
                      <div class="col-12">
                      <label for="for add" class="form-label">1. موبایل نمبر</label>
                      <input type="text" name="mobile" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter price!</div>
                       <label for="for add" class="form-label">2. موبایل نمبر</label>
                      <input type="text" name="mobile1" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter price!</div>
                       <label for="for add" class="form-label">3.موبایل نمبر</label>
                      <input type="text" name="mobile2" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter price!</div>
                       <div class="col-12">
                      <label for="for file" class="form-label">انځور</label>
                      <input class="form-control" type="file" name="image" value="" />
                      <div class="invalid-feedback">Please enter price!</div>
                    </div>
                    </div>
                    
                   
                          <div class="text-center mt-5">

                            <input type="submit" name="submit"class="btn btn-primary btn-submit" >
                            <?php 

                                function success(){
                                    //  
                                    echo '<script>  alert ("Data submite successfully");  </script
                                        window.location.href="admin.php";
                                    ';

                                }
                             ?>
                         </div>                   

                     </div>
                    </form>
            </div>
        </div>
    </div>
</div>
        
</div><!-- End Customers --------------------------------------------------------------------------------------------------------------------------------------------------Card -->
<!-- customer History modal -->
<div class="modal left fade" id="customerHistory" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
                <div class="col">
                    <div class="modal-body card ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 <h5 class="card-title text-center"><span>د مشتری تاریچه</span></h5>
                    <div class="col-lg-12 col-6 d_flex justify-content-center">
                <form action="">
                    <div class="input-group" style="height:100%">
                        <input type="text" class="form-control customerHistory" placeholder="">
                        <div class="input-group-append ">
                            <span class=" form-control bg-transparent text-warning">
                                <i class="fa fa-search "></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
                <div class="px-4 py-5">  
                 
                  <table class="table table-borderless align-middle mb-0 bg-white table-hover " style="direction:rtl" class="card">
                    <thead>
                        <tr class="cusomerHistory" id="customerhistory">
                           
                       
        
                       </tr>
                     
                      
                  </thead>
                  <tbody>
                    
                      
                    </tbody>
                  </table>


                </div>
                  <div id="laoninfo"></div>


            </div> 
                </div>
                
           
           
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.customerHistory').keyup(function(){
            var customerhistory = $(this).val();
           // alert(customerhistory);
             $.ajax({
                url:"ajax.php",
                method:"POST",
                data:{customerhistory:customerhistory},
                success:function(data){
                        $("#customerhistory").html(data);
                       // alert(customerhistory);
                }
                 });
        });
    });
</script>
<!-- customer history modal end -->
<!-- Categot modal start here ==============================================================================================================================================================================================================================================================================================-->

<div class="modal left fade" id="catagory" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
           
                <div class="col">
                    <div class="modal-body ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 <h5 class="card-title text-center"><span>کټګوری اضافه کړي!</span></h5>
                <div class="px-4 py-5">  
                  <form method="post" class="row g-3 needs-validation" novalidate style="text-align:right;">
                    
                     <div class="col-12">
                      <label for="yourName" class="form-label">نوم</label>
                      <input type="text" name="category_name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                      <div class="text-center mt-5">

                    <button class="btn btn-primary btn-submit" type="submit" name="addcate">ثبتول</button>
                    
                      </div>
                    </div>
                   
                  </form>
                  <table class="table table-borderless align-middle mb-0 bg-white table-hover mt-2" style="direction:rtl" class="card">
                    <thead>
                        <tr>
                             <th>کټګوری نوم</th>
                             <th>عملیات</th>
        
                       </tr>
                  </thead>
                  <tbody>
                    
                        <?php
                        try{
                            require_once('DBConnection.php');
                            $sql="SELECT * FROM `category` ORDER BY categ_id desc limit 10";
                            $result = $conn->query($sql);
                            if ($result->num_rows>0) {
                                while($row = $result->fetch_assoc()){
                                  echo'   <tr><td>'.$row["categ_name"].'</td>
                                    <td><a class="fa fa-edit text-decoration-none" href=""></a>
            
                                    </td>
                                     <td><a class="fa fa-trash text-decoration-none" href=""></a></td>
                                      </tr>
                                    ';  
                                }
                            }
                        } catch(Exception $e){

                        }
                            
                         ?>
                            
                        
    
                    </tbody>
                  </table>

                </div>


            </div> 
                </div>
                
           
           
        </div>
    </div>
</div>
<?php 

if (isset($_POST['addcate'])) {
     addcate();
}
 ?>
<!-- Catgory modal end here ==========================================================================================================================================================================================================================================================================-->



<!-- Company modal start here ========================================================================================================================================================================-->

<div class="modal left fade" id="company" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <div class="col">
                    <div class="modal-body ">
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                         <h5 class="card-title text-center"><span>! کمپنی اضافه کړی</span></h5>
                      <div class="px-4 py-5">  
                       <form class="row g-3 needs-validation" novalidate style="text-align:right;" method="post">
                   
                         <div class="col-12">
                          <label for="yourName" class="form-label">د کمپنی نوم</label>
                          <input type="text" name="company_name" class="form-control" id="" required>
                         <div class="invalid-feedback">Please,bill id!</div>
                        </div>
                         <div class="text-center mt-5">

                          <button class="btn btn-primary btn-submit" type="submit" name="addco">ثبتول</button>
                    
                        </div>  
                      </form>                   
                        </form>
                  <table class="table table-borderless align-middle mb-0 bg-white table-hover mt-2" style="direction:rtl" class="card">
                      <thead>
                        <tr>
                             <th>د کمپنی نوم</th>
                             <th>عملیات</th>
        
                       </tr>
                     </thead>
                  <tbody>
                    
                        <?php 
                        try{
                             require_once('DBConnection.php');
                            $sql="SELECT * FROM `company`";
                            $result = $conn->query($sql);
                            if ($result->num_rows>0) {
                                while($row = $result->fetch_assoc()){
                                  echo'   <tr><td>'.$row["comp_name"].'</td>
                                    <td><a class="fa fa-edit text-decoration-none" href=""></a>
            
                                    </td>
                                     <td><a class="fa fa-trash text-decoration-none" href=""></a></td>
                                      </tr>
                                    ';  
                                }
                            }
                        }catch(Exception $e){

                        }
                           
                         ?>
                   </tbody>
                  </table>
                    </div>                      
                  </div> 
                </div>  
        </div>
    </div>
</div>
<?php
        if (isset($_POST['addco'])) {
            addco();
        }
  ?>
<!-- Company modle end here ====================================================================================================================================================================================================-->


<!-- Company Loan profile start here ========================================================================================================================================================================-->

<div class="modal left fade" id="loan" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           
            <div class="col">
                <div class="modal-body  card " style="direction:rtl">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <form method="post">
                         <div class="mb-3 mt-3">
                            <label for="email">مشتری</label>
                             <select name ="store" id ="store" class="form-select form-select-sm">
                               <?php
                               try{
                                    $sql ="SELECT customer_id,customer_name FROM `customer`";
                                    include('DBConnection.php');
                                    $result = $conn->query($sql);
                                    if ($result->num_rows>0) {
                                      
                                    }
                                    else{
                                        echo 'No Customer Information Find';
                                    }
                                    while($row = $result->fetch_assoc()){
                                        echo '<option value="'.$row['customer_id'].'">'.$row['customer_name'].'</option>';
                                    }
                                     //loaned customer id
                                        if (isset($_POST['selecte'])) {
                                             echo $_POST['selecte'];
                                             $_SESSION['selecte'] = $_POST['selecte'];
                                            
                                         }
                               }catch(Exception $e){

                               }
                                    
                                 ?>  
                             </select>
                        </div>
                        <div class="mb-3">
                             <label for="pwd">مقدار</label>
                             <input type="text" class="form-control" id="loan_quantity" placeholder="" name="loan_quantity" required>
                        </div>
                         <div class="mb-3">
                             <label for="loan_quantity">اداینه</label>
                             <input type="text" class="form-control" id="paid_quantity" placeholder="" name="paid_quantity" required>
                        </div>
                         <div class="mb-3">
                             <label for="paid_quantity">ټوټل</label>
                             <input type="text" class="form-control" id="total_paid" placeholder="" name="total_paid" required>
                        </div>
                       
                                 <input  type="submit" class="btn btn-success form-control " name="loan" value="Save">
                 </form>  
                    
                </div>                      
            </div> 
             <script type="text/javascript">
             $(document).ready(function(){
              $('#store').on('change', function(){
                var selecte = this.value;
                  $.ajax({
                    url: 'admin.php',
                    type: 'post',
                    data: {selecte: selecte},
                    success: function(response){
                     //alert(selecte);s
                 
                  

                    }
                  });
              })
                           });
           </script>
        </div>  
    </div>
</div>

<?php
        if (isset($_POST['loan'])) {
            laon();
        }
  ?>
<!-- Loan profile modle end here ====================================================================================================================================================================================================-->


<!-- Company bill generation  profile start here ========================================================================================================================================================================-->

<div class="modal left fade" id="bill" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
            <div class="col">
                <div class="modal-body  card " style="direction:rtl">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                
                         
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control bill" placeholder="" style="width:90%">
                        <div class="input-group-append ">
                            <span class=" form-control bg-transparent text-warning">
                                <i class="fa fa-search "></i>
                            </span>
                        </div>
                    </div>
                </form>
             
            <div class="billedcustoemr">
               
                <table class="table caption-top table-bordered border-primary">
                    
                     <caption>Automict Bill Generation </caption>
                     <?php 
                        try{
                         include('DBConnection.php');
                        $sql2 = "SELECT * FROM `bill` ORDER by bill_id DESC LIMIT 1;";
                        $result = $conn->query($sql2);
                        $userid ="";
                        $goods_id ="";

                        while($row = $result ->fetch_assoc()){
                          $userid = $row["customer_id"];
                          $goods_id = $row["goods_id"];  
                        }
                       
                        $sql ="SELECT bill.bill_id, customer.customer_name,bill.quantity, goods.unit_id, goods.goods_name AS product, bill.price AS فی, bill.price*bill.quantity AS total, customer_buy_goods.currency_id,customer_buy_goods.buy_date FROM bill,customer,goods,customer_buy_goods WHERE customer.customer_id=$userid and goods.goods_id =$goods_id  ORDER by bill.bill_id DESC LIMIT 1;";
                        $result = $conn->query($sql);
                        if ($result->num_rows>0) {
                            while($row = $result->fetch_assoc()){
                                // get uint name 
                                // $unit_id = $row["unit_id"];
                                // $sql2 = "SELECT * FROM `unit` WHERE unit_id=.$unit_id";

                                // $unitrsult = $conn->query($sql2);
                                // if ($unit = $unitrsult->fetch_assoc()) {
                                //     echo $unit;
                                // }
                                // else{
                                //     echo "opps";
                                // }
                                echo '  <thead>
                     <div class="row">
                    <div class="col-xxl-4 mt-2">
                     <p style="outline-style: dotted;">'.$row["customer_name"].'</p>
                    </div>
                    <div class="col-xxl-4 mt-2">
                         <p style="outline-style: dotted; outline-top:none">'.$row["buy_date"].'</p>
                    </div>
                    <div class="col-xxl-4 mt-2">
                         <p style="outline-style: dotted; border-top: none;">نمر  '.$row["bill_id"].'</p>
                    </div>
                </div>
                 <tr>
                  <th scope="col">جنس</th>
                  <th scope="col">مقدار</th>
                  <th scope="col">قمت فی دانه</th>
                
                 </tr>
                </thead>
 

  
                <tbody>
                  <tr>
                    <th scope="row">'.$row["product"].'</th>
                    <td  style="height: 250px;">'.$row["quantity"].$unit["unit_name"].'</td>
                    <td>'.$row["فی"].'</td>
                  
                  </tr>
               </tbody></table> 
                        <p class="text-center">..........................................'.$row["total"].'...............................................</p>
               ';
                            }
                        }
                        else{
                            echo "";
                        }
   
                        }
                        catch(Exception $e){

                        }
                        
                      ?>
              
                
                <p style="outline-style: dotted; outline-color: red;" class="mt-2">خر] شوی جنس بیا نه واإس کیز</p>
                <button class="btn btn-primary" id="print">Print</button>
                <script type="text/javascript">
                   

                </script>
        </div>     
        </div>                      
            </div> 


<script type="text/javascript">
              $(document).ready(function(){
                              
              $('.bill').keyup(function(){
              var bill = $(this).val();  
              if (bill !="") {
                $.ajax({
                url:"ajax.php",
                method:"POST",
                data:{bill:bill},
                success:function(data){
                        $(".billedcustoemr").html(data);
                        //alert(bill);
                }
                 });
                } 
                });                              
                               
           });
</script>
        </div>  
    </div>
</div>

<?php
        if (isset($_POST['loan'])) {
           laon();
        }
  ?>
<!-- bill generation profile modle end here ====================================================================================================================================================================================================-->

<!-- countery modal start here ===============================================================================================================================================================================================================================================-->

<div class="modal" id="countryModal"  role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <div class="col">
                    <div class="modal-body ">
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                
                      <div class="px-4 py-5">  
                       <form class="row g-3 needs-validation" novalidate style="text-align:right;" method="post">
                        <div class="col-12">
                          <label for="yourName" class="form-label">نوم</label>
                          <input type="text" name="countery_name" class="form-control" id="" required>
                        <div class="invalid-feedback">Please,bill id!</div>
                       </div>
                         <div class="text-center mt-5">

                                 <button class="btn btn-primary btn-submit" type="submit" name="addcountery">ثبتول</button>
                    
                         </div>
                  </form>
                                  

                </div>


                   </div> 
                </div>
              
           
        </div>
    </div>
</div>

<?php 
    if (isset($_POST['addcountery'])) {
        addcounter();
    }
 ?>
<!-- currencey modal end here ============-===================================================================================================================================================================================================================================-->

<div class="modal left fade" id="currency" data-backdrop="statc" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
         
            <div class="col">
             <div class="modal-body ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                
                <div class="px-4 py-5">  
                  <form class="row g-3 needs-validation" novalidate style="text-align:right;" method="post">
                     <div class="col-12">
                      <label for="yourName" class="form-label">نوم</label>
                      <input type="text" name="currency_name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                    </div>
                     <div class="col-12">
                      <label for="yourName" class="form-label">سمبول</label>
                      <input type="text" name="currency_sign" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                    </div>
                  <div class="text-center mt-5">

                    <button class="btn btn-primary btn-submit" type="submit" name="addCurrency">ثبتول</button>
                    
                  </div> 
                  </form>
                            
                </div>
             </div> 
            </div>  
        </div>
    </div>
</div>
<?php 
  if (isset($_POST['addCurrency'])) {
      addCurrency();
  }

 ?>
 <!---------------------------------------------------  customers modal start here -------------------------------------------------------------->
 <div class="modal left fade" id="showcustomers" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
         <div class="col">
            <div class="modal-body ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 <h5 class="card-title text-center"><span>Customer Profiles</span></h5>   
                <div class="px-4 py-5">  
                  <form class="row g-3 needs-validation" novalidate style="text-align:right;" method="post">
                     <div class="col-12">
                      <label for="yourName" class="form-label">نوم</label>
                      <input type="text" name="unit_name" class="form-control customers" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                      <div class="text-center mt-5">
                                   
                      </div>
                    </div> 
                  </form>
                  <!-- <div id="cc" class="ccc">cddd</div>   -->
                    <table class="table table-borderless align-middle mb-0 bg-white table-hover mt-2" style="direction:rtl" class="card">
                      <thead id="cc">
                        <tr>
                            
        
                       </tr>
                     </thead>
                  <tbody>
                    
                        <?php
                        try{
                            require_once('DBConnection.php');
                            $sql="SELECT * FROM `customer` ORDER BY customer_id DESC LIMIT 10;";
                            $result = $conn->query($sql);
                            if ($result->num_rows>0) {
                                while($row = $result->fetch_assoc()){
                                 
                                }
                            }
                        } catch(Exception $e){

                        }
                          
                         ?>
                   </tbody>
                  </table>             
                </div>
            </div> 
         </div>
             
           
        </div>
    </div>
</div>
<script type="text/javascript">
    // Live sarch with 
    $(document).ready(function(){
        $('.customers').keyup(function(){
            var customers = $(this).val();
            $.ajax({
                url:'ajax.php',
                method:'POST',
                data:{customers:customers},
                success:function(data) {
                     //  alert(customers);
                      $('#cc').html(data);
                }
            });
        });
    });
</script>
  <!---------------------------------------------------  customers modal end here -------------------------------------------------------------->

<!-- currency unit here ==================================================================================================================================================================================================================================================-->

<div class="modal left fade" id="unit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">  
         <div class="col">
            <div class="modal-body ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 <h5 class="card-title text-center"><span>Add Unit</span></h5>   
                <div class="px-4 py-5">  
                  <form class="row g-3 needs-validation" novalidate style="text-align:right;" method="post">
                     <div class="col-12">
                      <label for="yourName" class="form-label">نوم</label>
                      <input type="text" name="unit_name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                      <div class="text-center mt-5">
                       <button class="btn btn-primary btn-submit" type="submit" name="addUnit">ثبتول</button>             
                      </div>
                    </div> 
                  </form>
                    <table class="table table-borderless align-middle mb-0 bg-white table-hover mt-2" style="direction:rtl" class="card">
                      <thead>
                        <tr>
                             <th>د کمپنی نوم</th>
                             <th>عملیات</th>
        
                       </tr>
                     </thead>
                  <tbody>
                    
                        <?php 
                            require_once('DBConnection.php');
                            $sql="SELECT * FROM `unit`";
                            $result = $conn->query($sql);
                            if ($result->num_rows>0) {
                                while($row = $result->fetch_assoc()){
                                  echo'   <tr><td>'.$row["unit_name"].'</td>
                                    <td><a class="fa fa-edit text-decoration-none" href=""></a>
            
                                    </td>
                                     <td><a class="fa fa-trash text-decoration-none" href=""></a></td>
                                      </tr>
                                    ';  
                                }
                            }
                         ?>
                   </tbody>
                  </table>             
                </div>
            </div> 
         </div>
               
           
        </div>
    </div>
</div>
<?php
    if (isset($_POST['addUnit'])) {
            addUnit(); 
    }
  ?>
<!-- unit modal end here=================================================================================================================================================================================================================================================== -->

<!-- store here ==================================================================================================================================================================================================================================================-->

<div class="modal left fade" id="store" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">  
         <div class="col">
            <div class="modal-body ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 <h5 class="card-title text-center"><span>Add Store</span></h5>   
                <div class="px-4 py-5">  
                  <form class="row g-3 needs-validation" novalidate style="text-align:right;" method="post">
                     <div class="col-12">
                      <label for="yourName" class="form-label">نوم</label>
                      <input type="text" name="store_name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                      <label for="yourName" class="form-label">سټور ادرس</label>
                        <select class="form-control"  id="address" name="address" onchange="address(this.value)">
                      <?php 
                            require_once('DBConnection.php');
  
                             $sql="SELECT * FROM `province`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["province_id"].'">'.$row["province_name"].'</option>';
                                 }
     
                                }

                        ?>
                      </select>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#address').on('change', function(){
                                var prov_id = $(this).val();
                                $.ajax({
                                    url: 'store.php',
                                    method:'POST',
                                    data: {provID: prov_id},
                                    dataType: "text",
                                    success:function(html){
                                            $('#district').html(html);
                                    }
                                });
                            });
                          });
                      </script>
                      <label for="for add" class="form-label">ولسوالی</label>
                      <select id="district" name="district" class="form-control" >
                         <option value="">ولسوالی</option>
                      </select>
                         <label for="yourName" class="form-label">کلی</label>
                      <input type="text" name="location_name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                   
                      <div class="text-center mt-5">
                       <button class="btn btn-primary btn-submit" type="submit" name="addStore">ثبتول</button>             
                      </div>
                    </div> 
                  </form>
                    <table class="table table-borderless align-middle mb-0 bg-white table-hover mt-2" style="direction:rtl" class="card">
                      <thead>
                        <tr>
                             <th>د کمپنی نوم</th>
                             <th>عملیات</th>
        
                       </tr>
                     </thead>
                  <tbody>
                    
                        <?php 
                            require_once('DBConnection.php');
                            $sql="SELECT * FROM `store`";
                            $result = $conn->query($sql);
                            if ($result->num_rows>0) {
                                while($row = $result->fetch_assoc()){
                                  echo'   <tr><td>'.$row["store_name"].'</td>
                                    <td><a class="fa fa-edit text-decoration-none" href=""></a>
            
                                    </td>
                                     <td><a class="fa fa-trash text-decoration-none" href=""></a></td>
                                      </tr>
                                    ';  
                                }
                            }
                         ?>
                   </tbody>
                  </table>             
                </div>
            </div> 
         </div>
               
           
        </div>
    </div>
</div>
<?php
    if (isset($_POST['addStore'])) {
            addStore(); 
    }
  ?>
<!-- store modal end here=================================================================================================================================================================================================================================================== -->

                    <!-- Revenue Card -->
    <div class="col-xxl-4 col-md-4" style="direction:rtl; text-align: right;">
            <div class="card info-card revenue-card" style="background-color: ">

            <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>پلټنه</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">نن</a></li>
                    <li><a class="dropdown-item" href="#">میاشت</a></li>
                    <li><a class="dropdown-item" href="#">کال</a></li>
                  </ul>
            </div>

                <div class="card-body">
                  <h5 class="card-title">ګټه <span>| میاشت</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>$3,264</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">کمه شوی</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            
                 <div class="col-xxl-4 col-md-4 "style="direction: rtl; text-align: right;">
              <div class="card info-card sales-card ss">


                <div class="filter" style="direction: rtl; text-align: right; background-color:;">
                  <a class="dropdown-item" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow uu">
                    <li class="dropdown-header text-start">
                      <h6>پلټنه</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">نن</a></li>
                    <li><a class="dropdown-item" href="#">میاشت</a></li>
                    <li><a class="dropdown-item" href="#">کال</a></li>
                  </ul>
                </div>

                <div class="card-body" style="direction:rtl; background-color:;">
                  <h5 class="card-title">خرڅ شوی <span>| نن</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">ریات شوی</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
              </div>
              <style type="text/css">
                    .ss{
                        width: 90%;
                        height: 120px;
                        transition: width 1s, height 1s;
                    }
                  .ss:hover {
                
  width: 100%;
  height: 220px;
  background-color: #88cc;
  s
  

}
              </style>

              <div class="col d-flex justify-content-end">

                  <div class="btn-group  d-flex justify-content-center" >
                      <button type="button" class="bi- btn btn-sm  dropdown-toggle" data-toggle="dropdown" id="viewbtn">ښکاره کول</button>
                      <div class="dropdown-menu dropdown-menu-right" id="view">
                         <a class="dropdown-item" href="admin.php?view=1">1</a>
                         <a class="dropdown-item" href="admin.php?view=5">5</a>
                         <a class="dropdown-item" href="admin.php?view=10">10</a>
                          <a class="dropdown-item" href="admin.php?view=20">20</a>
                          <a class="dropdown-item" href="admin.php?view=30">30</a>
                       </div>
                  </div>
                  <script type="text/javascript">
                      $(document).ready(function(){
                        $('#view').change(function(){
                                var quantity = $('#view :selected').text();
                        alert(quantity);
                        });
                        
                      });
                  </script>
                    <div class="btn-group  d-flex justify-content-center">
                      <button type="button" class="btn btn-sm  dropdown-toggle" data-toggle="dropdown">ترتیبول</button>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#">وروستی مخصولات</a>
                          <a class="dropdown-item" href="#">نوی مخصولات </a>
                          <a class="dropdown-item" href="#">تحفیف شوی محصولات</a>
                       </div>
                  </div>     
              </div>
               <div class="row" style="text-align: right;">
                    <div class="col-lg-6 card " style="text-align: right;">

                 <table class="table table-bordered border-primary text-center" style="text-align:center">
                    <thead class="overflow-auto h-100">
                                   <h5 class="card-title">تر ټول ډیر خرڅ شوی <span>| نن</span></h5>
                  <tr class="">  
                    <th>نوم</th>  
                     <th>انځور</th>
                     
                     <th>د اخسبلو بیه</th>
                     <th>د خرځ بیه</th>
                     <th>ګټه</th>
                   
                 </tr>

                    </thead>
                      <tbody>
                        <?php 
                            try{
                                 $lint =1;
    if (isset($_GET['view'])) {
        $lint = $_GET['view'];
    }
                                 $sql ="SELECT * FROM `customer_buy_goods` INNER JOIN goods ON customer_buy_goods.goods_id= goods.goods_id INNER JOIN currency on customer_buy_goods.currency_id=currency.currency_id ORDER by customer_buy_goods.quantity desc limit $lint  ";
                                 include('DBConnection.php');
                                 $result = $conn->query($sql);
                                 if ($result->num_rows>0) {
                                     while($row = $result->fetch_assoc()){
                                        echo '  <tr>
                                                    <td>'.$row["goods_name"].'</td>
                                                    <td>data</td>
                                                    <td>data</td>
                                                    <td>data</td>
                                                    <td>$12</td> 
                                                 </tr>';
                                     }
                                 }
                            }catch(Exception $e){
                               

                            }
                         ?>
                       
     
      
                      </tbody>
                     </table> 
                    </div>
         <div class="col-lg-6 card" style="direction:rtl; text-align: right;">
                    <h5 class="card-title">وروستی خرڅ شوی مخصولات<span>| نن</span></h5>
            <table class="table table-bordered border-primary " >
                <thead class="overflow-auto h-100">
                  <tr class="">
                    
                     <th>نوم</th>
                     <th>د اخسبلو بیه</th>
                     <th>د خرځ بیه</th>
                     <th>ګټه</th>  
                 </tr>
               </thead>
              <tbody>
                 <tr>
                    <?php recentlly(); ?>
                
                   
                  </tr>
               </tbody>
            </table> 
        </div>

<!-- ================================================================================================================================================chart start here -->
                    <div class="col-lg-6 card">
                        <canvas id="product" style="width:100%;max-width:600px; lis"></canvas>
                            <?php 
                                $sql ="SELECT * FROM `goods` INNER JOIN customer_buy_goods  ON goods.goods_id = customer_buy_goods.goods_id INNER JOIN category ON goods.category_id = category.categ_id;";
                                include('DBConnection.php');
                                $result = $conn ->query($sql);
                                if ($result ->num_rows>0) {
                                     $data = array();
                                foreach ($result as $value) {
                                    $ydata []=$value["quantity"];
                                    $xcate_name[]=$value["categ_name"];
                                }
                                }
                             ?>
                                <script>
                                         var xValues = <?php echo json_encode($xcate_name)  ?>;
                                         var yValues = <?php echo json_encode($ydata); ?>;
                                        var barColors = ["red", "green","blue","orange","brown"];

                                      new Chart("product", {
                                                     type: "bar",
                                                     data: {
                                                     labels: xValues,
                                                     datasets: [{
                                                     backgroundColor: barColors,
                                                     data: yValues
                                                          }]
                                                         },
                                            options: {
                                                  legend: {display: false},
                                                  title: {
                                                  display: true,
                                                  text: "تول خرڅ شوی مخصولات"
                                                         }
                                                    }
                                                });
                                </script>
                    </div>
                    <div class="col-lg-6 card">
                        <canvas id="exsitedproduct" style="width:100%;max-width:600px"></canvas>
                        <?php
                        try{
                                 include('DBConnection.php');
                            $sql="SELECT goods_name, sum(quantity),category.categ_name FROM goods LEFT JOIN category ON category.categ_id = goods.category_id GROUP BY category.categ_name;";
                            $result = $conn->query($sql);
                            if ($result->num_rows>0) {
                                $data = array();
                                foreach ($result as $value) {
                                    $data []=$value["sum(quantity)"];
                                    $cate_name[]=$value["categ_name"];
                                }
                            }
                        } catch(Exception $e){

                        }
                           
                         ?>

                                        <script>
                                           
                                         var xValues = <?php echo json_encode($cate_name)  ?>;
                                         var yValues = <?php echo json_encode($data); ?>;
                                         var barColors = [
                                           "#b91d49",
                                           "#256D85",
                                           "#231955",
                                           "1363DF",
                                           "#D61C4E",
                                           "#277BC0",
                                           "#38E54D",
                                           "#B73E3E",
                                          "#00aba9",
                                          "#2b5797",
                                          "#e8c3b9",
                                          "#FFFF00",
                                          "#1e7145",
                                          "#1B2430"
                                        ];

                                            new Chart("exsitedproduct", {
                                              type: "doughnut",
                                              data: {
                                                labels: xValues,
                                                datasets: [{
                                                  backgroundColor: barColors,
                                                  data: yValues
                                                }]
                                              },
                                              options: {
                                                title: {
                                                  display: true,
                                                  text: "موجود محصولات"
                                                }
                                              }
                                            });
                                          </script>
                    </div>
                
               </div>
            
            </div>
 <!-- chart=================================================================================================================================strat-->
<div class="modal fade" id="product">
  <div class="modal-dialog ">
    <div class="modal-content" >

      <!-- Modal Header -->
      <div class="modal-header" style="text-align: right;">
        <h4 class="modal-title text-center w-100 ">ْنوی محلول اضافه کړی</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

  
      <div class="modal-body">
        <div class="card">
           <form class="" >
        

                <div class="input-group ">
                  <input type="text" class="form-control" required placeholder="" name="goods_name">
                   <span class="input-group-text">د حصول نوم</span>
               </div>

                <div class="input-group mt-2">
                    <input type="text" class="form-control" required placeholder="" name="goods_discription">
                    <span class="input-group-text">     جزیات</span>
                </div>

                <div class="input-group mt-2">
                   <input type="text" class="form-control" required placeholder="" name="buy_price">
                    <span class="input-group-text">د اخستلو بیه</span>
                </div>

                <div class="input-group mt-2">
                    <select class="form-select form-control "required name="category_id">
                      <option>....</option>
                       <option>افغانی</option>
                       <option>دالر</option>
                       <option>کلدار</option>
                
                     </select>
                    <span class="input-group-text">کټګوری</span>
                </div>

                <div class="input-group mt-2">
                  <select class="form-select form-control "required name="country_id">
                    <option>....</option>
                    <option>افغانی</option>
                    <option>دالر</option>
                    <option>کلدار</option>
                
                    </select>
                    <span class="input-group-text">هیواد</span>
                </div>

               <div class="input-group mt-2">
                 <select class="form-select form-control "required name="company_id">
                    <option>....</option>
                    <option>افغانی</option>
                    <option>دالر</option>
                    <option>کلدار</option>
                
                 </select>
                 <span class="input-group-text">کمپنی</span>
               </div>
                  <div class="input-group mt-2">
                 <select class="form-select form-control "required name="company_id">
                    <option>....</option>
                    <option>افغانی</option>
                    <option>دالر</option>
                    <option>کلدار</option>
                
                 </select>
                 <span class="input-group-text">یونټ</span>
               </div>

                <div class="input-group mt-2" >
                      <input type="file" class="form-control" required placeholder="" name="buy_price">
                   <span class="input-group-text">انځور</span>
               </div>
     
              <div class="input-group mt-2">
                 <button class="form-control btn btn-success" name="submit">ثیتول</button>
              </div>
     
          </form>

      </div>
    </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">بندول</button>
        </div>

    </div>
  </div>
</div>
 <!-- product modal =================================== end============================================================================= -->
        </main>
        <aside class="col-sm-3 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 pb-3" style="text-align:right; b">
            <div class="bg-light border rounded-3 p-1 h-100 sticky-top" style="height: 100%;" >
                <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate" style="background-color:#fff; color:#ffffff">
                 
                    <li>
                        <a href="#" class="nav-link px-2 text-truncate">
                          <span class="d-none d-sm-inline">Dashboard</span>
                            <i class="bi bi-speedometer fs-5"></i>
                            
                        </a>
                    </li>
                      <li>
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#catagory" style="text-align:righ;">
                             <span class="d-none d-sm-inline">Catagory</span>
                          <i class="bi bi-diagram-3" style="font-size:22px;"></i>
                            </a>
                    </li>
                      <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#company" style="text-align:righ;">
                             <span class="d-none d-sm-inline">Company</span>
                          <i class="bi bi-c-square-fill"style="font-size:22px;"></i>
                            </a>
                    </li>
                     <li>
                        
                        <a  href="admin/"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#countryModal" style="text-align:righ;">
                                <span class="d-none d-sm-inline">Countery</span>
                                <i class="bi bi-bricks fs-5"></i>
                        </a>
                    </li>
                    <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#currency" style="text-align:righ;">
                                <span class="d-none d-sm-inline">currency</span>
                                <i class="fa fa-money" style="font-size:22px;"></i>
                        </a>
                    </li>
                    <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#unit" style="text-align:righ;">
                                <span class="d-none d-sm-inline">unit</span>
                                <i class="bi bi-bricks fs-5"></i>
                        </a>
                    </li>
                     <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#store" style="text-align:righ;">
                                <span class="d-none d-sm-inline">Store</span>
                                <i class="bi bi-shop fs-5"></i>
                        </a>
                    </li>
                
                    <li>
                        <a href="goods.php" class="nav-link px-2 text-truncate">
                             <span class="d-none d-sm-inline">Products</span>
                          <i class="bi bi-cart-plus fs-5" style=""></i>
                            </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#bill">
                             <span class="d-none d-sm-inline">Bill</span>
                          <i class="bi bi-receipt fs-5"></i>
                            </a>
                    </li>
                    <li>
                         <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#loan" style="text-align:righ;">
                                <span class="d-none d-sm-inline">Loan</span>
                                <i class="bi bi-shop fs-5"></i>
                        </a>
                    </li>
                      <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#showcustomers" style="text-align:righ;">
                                <span class="d-none d-sm-inline">Customers</span>
                                <i class="fa fa-user fs-5"></i>
                        </a>
                    </li>
                    </li>
                   
                </ul>
                    <!-- category search Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">د کټکوری پر اساس پلټڼه</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">ټول مخصولات</label>
                            <span class="badge border font-weight-normal"style="color:black;">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">بطری</label>
                            <span class="badge border font-weight-normal"style="color:black;">444</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">سنبر سیبل</label>
                            <span class="badge border font-weight-normal"style="color:black;">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">شمسی</label>
                            <span class="badge border font-weight-normal" style="color:black;">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">مولد</label>
                            <span class="badge border font-weight-normal"style="color:black;">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">واټر پمپ</label>
                            <span class="badge border font-weight-normal"style="color:black;">168</span>
                        </div>
                    </form>
                </div>
                <!-- category -->
            </div>
        
            </div>
            <!-- Shop Sidebar End -->
        </aside>
       
    </div>
</div>
  <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


</body>
</html>