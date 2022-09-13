<?php
  function addproduct(){
    include('DBConnection.php');
    $goods_name =$_POST['goods_name'];
    $goods_discription = $_POST['goods_discription'];
    $buy_price = $_POST['buy_price'];
    $currency_id = $_POST['currency_id'];
    $category_id = $_POST['category_id'];
    $country_id = $_POST['country_id'];
    $company_id = $_POST['company_id'];
    $unit_id = $_POST['unit_id'];
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
     $sqll="SET FOREIGN_KEY_CHECKS = 0;";
     $conn->query($sqll);
     $sql2="INSERT INTO `goods` (`goods_id`, `goods_name`, `goods_discription`, `buy_price`, `entry_date`, `image`, `category_id`, `company_id`, `country_id`, `unit_id`, `currency`)
      VALUES (NULL, '$goods_name', '$goods_discription', '$buy_price', '2022-09-13', '$targetFilePath', '$category_id', '$company_id', '$country_id', '$unit_id', '$currency_id');";
      if ( $conn->query($sql2)) {
         echo' <script LANGUAGE="JavaScript">
                 swal("په بریالی توګه !", "د محضول مغلومات اضافه شول!", "success");
                
               </script>;'; 
      }
      else{
         echo' ("<script LANGUAGE="JavaScript">
                 window.alert("Opps!");
                 window.location.href="admin.php";
               </script>");'; 
      }
     
  } 

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
    <title>admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="admin.css?verssion=2">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<header class="py-3 mb-4 border-bottom shadow">
    <div class="container-fluid align-items-center d-flex">

        <div class="col-lg-4 d-flex justify-content-start ">

                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-warning bg-dark px-2">SOLAR</span>
                    <span class="h1 text-uppercase text-dark bg-warning px-2 ml-n1">SYSTEM</span>
                </a>
            </div>
        <div class="flex-grow-1 d-flex align-items-center">
            <form class="w-100 me-3">
                <input type="search" class="form-control" placeholder="Search...">
            </form>
            <div class="flex-shrink-0 dropdown">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://via.placeholder.com/28?text=!" alt="user" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2" style="">
                   
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid ">
    <div class="row ">

       <main class="col-lg-9 col-md-8 col-sm-3 overflow-auto h-100">

            <div class="bg-light border rounded-3 p-3">
              <div class="row">
                   <!-- Customers Card -->
            <div class="col-xxl-4 col-md-4" style="direction:rtl;">

              <div class="card info-card customers-card">

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
                  <h5 class="card-title">مشتریان <span>| کال</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1244</h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">ریات شوی</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->


                    <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4" style="direction:rtl;">
              <div class="card info-card revenue-card" style="background-color: #eef;">

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

                 <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">


                <div class="filter" style="direction: rtl;">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">نن</a></li>
                    <li><a class="dropdown-item" href="#">میاشت</a></li>
                    <li><a class="dropdown-item" href="#">کال</a></li>
                  </ul>
                </div>

                <div class="card-body" style="direction:rtl;">
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
              

              <div class="col d-flex justify-content-end">

                  <div class="btn-group  d-flex justify-content-center">
                      <button type="button" class="bi- btn btn-sm  dropdown-toggle" data-toggle="dropdown">ښکاره کول</button>
                      <div class="dropdown-menu dropdown-menu-right">
                         <a class="dropdown-item" href="#">10</a>
                          <a class="dropdown-item" href="#">20</a>
                          <a class="dropdown-item" href="#">30</a>
                       </div>
                  </div>
                    <div class="btn-group  d-flex justify-content-center">
                      <button type="button" class="btn btn-sm  dropdown-toggle" data-toggle="dropdown">ترتیبول</button>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#">وروستی مخصولات</a>
                          <a class="dropdown-item" href="#">نوی مخصولات </a>
                          <a class="dropdown-item" href="#">تحفیف شوی محصولات</a>
                       </div>
                  </div>
                <a  class=" d-flex justify-content-end text-decoration-none" data-bs-toggle="modal" data-bs-target="#product" style="text-align:right;">
                      Add new product <i class="bi-plus"></i>
                 </a>
                
              </div>
              <div class="card table-responsive">
                 <table class="table mt-2 table-ligh table table-hover  ">
                <thead class="overflow-auto h-100">
      
                  <tr class="">

                     <th>goods_id</th>
                     <th>goods_name</th>
                     <th>goods_discription</th>
                     <th>buy_price</th>
                     <th>entry_date</th>
                     <th>category_id</th>
                     <th>company_id</th>
                     <th> country_id</th>
                     <th>currency</th>
                 </tr>

               </thead>
              <tbody>

                 <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>jdata</td>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
     
      
               </tbody>
             </table> 
              </div>
            
            </div>
 <!-- add product modal =================================================================================================================================strat-->
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
           <form class="post" method="post" enctype="multipart/form-data">
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

                    <select class="form-select form-control "required name="currency_id">
                         
                      <?php
                      //  $sql="SELECT * FROM `currency`";
                        include('DBConnection.php');
                        $sql="SELECT * FROM `currency`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["currency_id"].'">'.$row["currency_name"].'</option>';
                                 }
     
                                }
                        else "no record found";

                      ?>
                      
                
                     </select>
                    <span class="input-group-text">پولی واحد</span>
                </div>
                <div class="input-group mt-2">
                    <select class="form-select form-control "required name="category_id">
                      <?php
                     
                        include('DBConnection.php');
                        $sql="SELECT * FROM `category`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["categ_id"].'">'.$row["categ_name"].'</option>';
                                 }
     
                                }
                        else "no record found";

                      ?>
                
                     </select>
                    <span class="input-group-text">کټګوری</span>
                </div>

                <div class="input-group mt-2">
                  <select class="form-select form-control "required name="country_id">
                 <?php
                     
                        include('DBConnection.php');
                        $sql="SELECT * FROM `country`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["count_id"].'">'.$row["count_name"].'</option>';
                                 }
     
                                }
                        else "no record found";

                      ?>
                
                    </select>
                    <span class="input-group-text">هیواد</span>
                </div>

               <div class="input-group mt-2">
                 <select class="form-select form-control "required name="company_id">
                    <?php
                     
                        include('DBConnection.php');
                        $sql="SELECT * FROM `company`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["comp_id"].'">'.$row["comp_name"].'</option>';
                                 }
     
                                }
                        else "no record found";

                      ?>
                
                 </select>
                 <span class="input-group-text">کمپنی</span>
               </div>
                  <div class="input-group mt-2">
                 <select class="form-select form-control "required name="unit_id">
                   <?php
                     
                        include('DBConnection.php');
                        $sql="SELECT * FROM `unit`";
                             $result=$conn->query($sql);
                             if ($result->num_rows>0) {

                                 while ($row = $result->fetch_assoc()) {
                                     echo'<option value="'.$row["unit_id"].'">'.$row["unit_name"].'</option>';
                                 }
     
                                }
                        else "no record found";

                      ?>
                
                 </select>
                 <span class="input-group-text">یونټ</span>
               </div>

                <div class="input-group mt-2" >
                      <input type="file" class="form-control" required placeholder="" name="image">
                   <span class="input-group-text">انځور</span>
               </div>
     
              <div class="input-group mt-2">
                 <button class="form-control btn btn-success" name="addproduct">ثیتول</button>
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
<?php
if(isset($_POST['addproduct'])){
  echo  addproduct();
}
?>
 <!-- product modal =================================== end============================================================================= -->
        </main>
         <aside class="col-sm-3 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 pb-3" style="text-align:right;">
            <div class="bg-light border rounded-3 p-1 h-100 sticky-top">
                <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
                 
                    <li>
                        <a href="admin.php" class="nav-link px-2 text-truncate">
                          <span class="d-none d-sm-inline">Dashboard</span>
                            <i class="bi bi-speedometer fs-5"></i>
                            
                        </a>
                    </li>
                      <li>
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#catagory" style="text-align:righ;">
                             <span class="d-none d-sm-inline">Catagory</span>
                          <i class="bi bi-bricks fs-5"></i>
                            </a>
                    </li>
                      <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#company" style="text-align:righ;">
                             <span class="d-none d-sm-inline">Company</span>
                          <i class="bi bi-bricks fs-5"></i>
                            </a>
                    </li>
                     <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#country" style="text-align:righ;">
                                <span class="d-none d-sm-inline">Countery</span>
                                <i class="bi bi-bricks fs-5"></i>
                        </a>
                    </li>
                    <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#currency" style="text-align:righ;">
                                <span class="d-none d-sm-inline">currency</span>
                                <i class="bi bi-bricks fs-5"></i>
                        </a>
                    </li>
                    <li>
                        
                        <a  href="#"  class=" nav-link px-2 text-truncate" data-bs-toggle="modal" data-bs-target="#unit" style="text-align:righ;">
                                <span class="d-none d-sm-inline">unit</span>
                                <i class="bi bi-bricks fs-5"></i>
                        </a>
                    </li>
                    
                    <li>
                        <a href="sells.php" class="nav-link px-2 text-truncate">
                             <span class="d-none d-sm-inline">Sells</span>
                          <i class="bi bi-shop fs-5"></i>
                            </a>
                    </li>
                    <li>
                        <a href="goods.php" class="nav-link px-2 text-truncate">
                             <span class="d-none d-sm-inline">Products</span>
                          <i class="bi bi-bricks fs-5"></i>
                            </a>
                    </li>

                    <li>
                        <a href="bill.php" class="nav-link px-2 text-truncate">
                             <span class="d-none d-sm-inline">Bill</span>
                          <i class="bi bi-receipt fs-5"></i>
                            </a>
                    </li>
                    <li>
                        <a href="loan.php" class="nav-link px-2 text-truncate">
                             <span class="d-none d-sm-inline"> Loan</span>
                          <i class="bi bi-bank fs-5"></i>
                            </a>
                    </li>
                   
                </ul>
            </div>
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
    <script>
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
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
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>

</body>
</html>