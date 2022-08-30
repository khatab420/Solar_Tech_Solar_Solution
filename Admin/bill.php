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
              <!--   <a  class=" d-flex justify-content-end text-decoration-none" data-bs-toggle="modal" data-bs-target="#product" style="text-align:right;">
                      Add new product <i class="bi-plus"></i>
                 </a> -->
                
              </div>
             <div class="row">
    <!--   today sell table start here =================================================================================================-->
              <div class="col"></div>
              <div class="col-lg-10 card" style="direction:rtl;">

                   <h5 class="card-title d-flex d-sm-inline">بیل او انوایس <span>| نن</span></h5>
                   
                  <tr class="">

                 <table class="table table-bordered border-primary" >
                   <a  class=" d-flex justify-content text-decoration-none text-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="text-align:righ;">
                       Create New Bill <i class="bi-plus"></i>
                   </a>

                 <thead class="overflow-auto h-100">
                                  
                    
                    <th>بیل آی ډی</th>
                    <th>مشتری آی ډی</th>
                    <th>د محصول آی ډي</th>
                    <th>خرڅونکی آی ډی</th>
                    <th>سټور آی ډي</th>
                    <th>تاریخ</th>
                    <th>مقدار</th>
                    <th>حالت</th>
                    <th>پولی واخد</th>
                    <th>حالت</th>
                    
                 </tr>

                        </thead>
                      <tbody>

                         <tr>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                            <td>data</td>
                           
                        </tr>
     
      
                </tbody>
                 </table> 
             </div>
     <!--   today sell table start here =================================================================================================-->
       

  <!--         <button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#staticBackdrop"> <i class="fa fa-info"></i> Get information
</button> -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                
                <div class="px-4 py-5">

                   
                  <form class="row g-3 needs-validation" novalidate style="text-align:right;">
                    <div class="col-12">
                      <label for="yourName" class="form-label">بیل آی ډي</label>
                      <input type="text" name="" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">بیل نمر</label>
                      <input type="email" name="email" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter number!</div>
                    </div>
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">پولی واخد</label>
                      <input type="email" name="email" class="form-control" id="" required>
                      <div class="invalid-feedback">Please enter price!</div>
                    </div>
                      <div class="col-12">
                      <label for="yourName" class="form-label">مشتری آی ډی</label>
                      <input type="text" name="name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill id!</div>
                    </div>
                      <div class="col-12">
                      <label for="yourName" class="form-label">محصول آی ډي</label>
                      <input type="text" name="name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill info!</div>
                    </div>
                      <div class="col-12">
                      <label for="yourName" class="form-label">قمت</label>
                      <input type="text" name="name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill info!</div>
                    </div>
                      <div class="col-12">
                      <label for="yourName" class="form-label">مقدار</label>
                      <input type="text" name="name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill ifo!</div>
                    </div>
                      <div class="col-12">
                      <label for="yourName" class="form-label">د خر څوونکی آی ډي</label>
                      <input type="text" name="name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill info!</div>
                    </div>
                      <div class="col-12">
                      <label for="yourName" class="form-label">سټور آی ډي</label>
                      <input type="text" name="name" class="form-control" id="" required>
                      <div class="invalid-feedback">Please,bill info!</div>
                    </div>

                    
                  

                
                  </form>



                <div class="text-center mt-5">


                    <button class="btn btn-primary" type="submit">ثبتول</button>
                    


                </div>                   

                </div>


            </div>
        </div>
    </div>
</div>
                
                   
 <!-- bill modal =================================== end============================================================================= -->
        </main>
        <aside class="col-sm-3 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 pb-3" style="text-align:right;">
            <div class="bg-light border rounded-3 p-1 h-100 sticky-top">
                <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
                 
                    <li>
                        <a href="#" class="nav-link px-2 text-truncate">
                          <span class="d-none d-sm-inline">Dashboard</span>
                            <i class="bi bi-speedometer fs-5"></i>
                            
                        </a>
                    </li>
               
                    <li>
                        <a href="goods.php" class="nav-link px-2 text-truncate">
                             <span class="d-none d-sm-inline">Products</span>
                          <i class="bi bi-bricks fs-5"></i>
                            </a>
                    </li>

                    <li>
                        <a href="goods.php" class="nav-link px-2 text-truncate">
                             <span class="d-none d-sm-inline">Bill</span>
                          <i class="bi bi-receipt fs-5"></i>
                            </a>
                    </li>
                    <li>
                        <a href="goods.php" class="nav-link px-2 text-truncate">
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


</body>
</html>
