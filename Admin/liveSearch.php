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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../style.css?verssion=5" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>



    <table class="table table-borderless">
    <thead>
      <tr>
        <th>نوم</th>
        <th>د پلار نوم</th>
        <th>ایمل</th>
      </tr>
    </thead>
    <tbody>
     <?php  if (isset($_POST['inputs']) ){
       $error ="";
       $search = $_POST['inputs'];
       require_once('DBConnection.php');
       $sql="SELECT * FROM `customer` WHERE customer_name LIKE '$search%'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
           while($row = $result->fetch_assoc()){

              echo'


      <tr>
        <td>'.$row["customer_name"].'</td>
        <td>'.$row["customer_f_name"].'</td>
        <td>'.$row["customer_email"].'</td>
         <td> <input class="userinfo" type="checkbox" data-id='.$row["customer_id"].' id="userinfo"></td>
      </tr>



 ';

                }

         }
         else {
           $error ='<div class="alert alert-info mt-3" role="alert" style="direction:rtl; text-align:right">
     مشتری شتون نه لري!
   </div>';
   echo $error;
         }

    }
    // get prin and quantity from sell modal stor into a session varible for further use
    if (isset($_POST['price'])) {
         $_SESSION['price'] = $_POST['price'];

    }
    $price = $_SESSION['price'];
    if (isset($_POST['loan_quantity'])) {
         $_SESSION['loan_quantity'] = $_POST['loan_quantity'];

    }

       $quantity = $_SESSION['loan_quantity'];

    // sell confirmed
        if ( isset($_GET["id"])) {
          // $stor = $_POST['store'];

           $_SESSION['userid'];
           $currency=$_SESSION['currency'];
           $goods_id = $_SESSION['goods_id'];
           $buy_price = $_SESSION['buy_price'];
           $entry_date = $_SESSION['entry_date'];
           $currency= $_SESSION['currency'];
           $unit_id =$_SESSION['unit_id'];
          include('DBConnection.php');

           $userid = $_GET["id"];
           $store_id = $_GET["store_id"];
           $sqll="SET FOREIGN_KEY_CHECKS = 0;";
           $conn->query($sqll);

           $sql ="INSERT INTO `customer_buy_goods` (`customer_id`, `store_id`, `goods_id`, `buy_date`, `quantity`, `price`, `currency_id`, `seller_id`)
                                            VALUES (' $userid', '$store_id', '$goods_id', ' $entry_date', '   $quantity', '$price ', '$currency', '')";
            // udate goods table
            $sql4 ="SELECT quantity FROM goods WHERE goods_id = '$goods_id'";
            $result4 =$conn->query($sql4);
            if ($result4->num_rows>0) {
                while($row = $result4->fetch_assoc()){
                   $beforQantity = $row["quantity"];
                   echo $afterQauntity = $beforQantity - $quantity;
                }
                 $sqlupdate ="UPDATE goods SET quantity='$afterQauntity' WHERE goods_id = '$goods_id'";
                 if (!$conn->query($sqlupdate)) {
                     echo "the opretion was not completed";
                 }
            }

           if ( $conn->query($sql)) {

              // create bill for buyer customer
               $sql2 ="INSERT INTO `bill` (`bill_id`, `goods_id`, `customer_id`, `seller_id`, `currency_id`, `quantity`, `store_id`, `unit_id`, `price`)
                                   VALUES (NULL, '$goods_id', '$userid', '', '$currency', '$quantity', '$store_id', '$unit_id','$price')";
                 $sqll="SET FOREIGN_KEY_CHECKS = 0;";
                $conn->query($sqll);
                if ($conn->query($sql2)) {
                   echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");

               </script>;';
                }
           }
         }

    ?>

    <script type="text/javascript">

     $(document).ready(function() {
     $("#alert-danger").hide();

       $("#alert-danger").fadeTo(2, 500).slideUp(500, function() {
         $("#alert-danger").slideUp(500);
       });

   });
    </script>
      <script type="text/javascript">

              $(document).ready(function(){
                $('.userinfo').click(function(){
                  var id = $(this).data('id');
                  $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    data: {id: id},
                    success: function(response){
                      $('.fffff').html(response);



                    }
                  });

                });
              });
            </script>
             <script type="text/javascript">
 // get the buyer id to generate bill
              $(document).ready(function(){
                $('.userinfo').click(function(){
                  var id = $(this).data('id');
                  $.ajax({
                    url: 'admin.php',
                    type: 'post',
                    data: {id: id},
                    success: function(response){
                      $('.billedcustoemr').html(response);



                    }
                  });

                });
              });
            </script>
             <?php
    $sql3 ="SELECT * FROM `store`";
           include('DBConnection.php');
           $result = $conn->query($sql3);
           if ($result->num_rows>0) {
            echo' <form method="post">
                    <select name ="store" id ="store" class="form-select form-select-sm mt-2">';
            while($row = $result->fetch_assoc()){
                  echo' <option value="'.$row['store_id'].'">'.$row['store_name'].'</option>';
            }
              echo ' </select>
                 </form>';
           }
           ?>
          <div class="mb-3">
               <label for="pwd">مقدار</label>
               <input type="text" class="form-control loan_quantity" id="loan_quantity" placeholder="" name="quantity" required value="">
               <label for="loan_quantity">قمت</label>
              <input type="text" class="form-control price" id="paid_quantity" placeholder="" name="price" required value="">
          </div>
          <div class="insput">

          </div>


    </tbody>
  </table>
  <script>
    $(document).ready(function(){
      var data $('.loan_quantity').val();
      if (data=="") {
        $("userinfo").attr("disabled", true);
      }
    });
  </script>

           <script type="text/javascript">
             $(document).ready(function(){
              $('select').on('change', function(){
                var selecte = this.value;
                  $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    data: {selecte: selecte},
                    success: function(response){
                      $('.fffff').html(response);




                    }
                  });
              });
                           });
               $(document).ready(function(){

    $('.loan_quantity').keyup(function(){
    var loan_quantity = $(this).val();
    if (loan_quantity !="") {
         $.ajax({
                url:"liveSearch.php",
                method:"POST",
                data:{loan_quantity:loan_quantity},
                success:function(data){
                       // $(".insput").html(data);
                       // alert(loan_quantity);
                }
                 });
        }
                });

     });
                $(document).ready(function(){

    $('.price').keyup(function(){
    var price = $(this).val();
    if (price !="") {
         $.ajax({
                url:"liveSearch.php",
                method:"POST",
                data:{price:price},
                success:function(data){
                     //  $(".insput").html(data);
                       // alert(price);
                }
                 });
        }
                });

     });


           </script>

           <div class="bill"></div>

     <table class="table caption-top" style="direction:rtl; visibility: hidden;">
  <caption>List of users</caption>
  <thead>
    <tr>

      <th scope="col">نوم</th>
      <th scope="col">پلار نوم</th>
      <th scope="col">لیمل</th>
    </tr>
  </thead>
  <tbody>

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
     <script>
     $(document).ready(function(){
        //document.getElementById("userinfo").disabled=true;
        $("#userinfo").disabled=true;
     });

     </script>
  </tbody>
</table>
  </body>
</html>
