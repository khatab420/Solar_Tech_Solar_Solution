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
    <div class="row flex-grow-sm-1 flex-grow-0">
        <aside class="col-sm-3 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 pb-3">
            <div class="bg-light border rounded-3 p-1 h-100 sticky-top">
                <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
                 
                    <li>
                        <a href="#" class="nav-link px-2 text-truncate">
                            <i class="bi bi-speedometer fs-5"></i>
                            <span class="d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
               
                    <li>
                        <a href="goods.php" class="nav-link px-2 text-truncate"><i class="bi bi-bricks fs-5"></i>
                            <span class="d-none d-sm-inline">Products</span> </a>
                    </li>
                   
                </ul>
            </div>
        </aside>
        <main class="col-lg-8 col-md-8 col-sm-3 overflow-auto h-100">

            <div class="bg-light border rounded-3 p-3">
              <div class="col d-flex justify-content-end">
                <a  class=" text-decoration-none" data-bs-toggle="modal" data-bs-target="#product" style="text-align:right;">
   Add new product <i class="bi-plus"></i>
  </a>
              </div>
              <table class="table mt-2">
  <thead class="table-success overflow-auto h-100">
      
      <tr class="">
        <th>goods_id</th>
        <th>goods_name</th>
        <th>goods_discription</th>
        <th>buy_price</th>
        <th>entry_date</th>
        <th>category_id</th>
        <th>company_id</th>
        <th>  country_id</th>
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

            <!-- The Modal -->
<div class="modal fade" id="product">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">add</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        aaaaddd
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
        </main>
    </div>
</div>
</body>
</html>