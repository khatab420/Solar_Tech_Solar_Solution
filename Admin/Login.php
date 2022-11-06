<?php
 $error='';
   if (isset($_POST["login"])) {
   
   	 session_start();
   include('DBConnection.php');
    
      // username and password sent from form 
      $username = mysqli_real_escape_string($conn,$_POST['user_name']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      $sql = "SELECT seller_user_name,seller_password,role FROM seller WHERE seller_user_name = '$username' and seller_password = '$password'";
      $result =$conn->query($sql);


      // If result matched $myusername and $mypassword, table row must be 1 row
 if($result->num_rows) {
  while ($row = $result->fetch_assoc()){
    $role = $row["role"];
       $_SESSION['login_user'] = $username;
        if ($role==1) {
          
          header("location:admin.php");

        }
        else {
        echo $error = '<div class="alert alert-danger" role="alert">
  A simple danger alert—check it out!
</div>';
      }if($role==2){

          header("location:seller.php");
        
      }
        }
  }
  else {
         $error = '<div class="alert alert-danger" role="alert" id="alert-danger">
                      Invalid User Nmae or password!
                      </div>';
      }
 
      
   
   }


  ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
  <link rel="stylesheet" type="text/css" href="admin.css?verssion=6">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="css/style.css">

	<title>Login</title>
</head>
<body>
	<div class="container-fluid">
		<div class="main-content">
			<div class="row">
				<div class="col-lg-8 bg-success d-flex justify-content-center">

					
				</div>
				<div class="col-lg-4">
        
   

  
  <body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-5">
          <h2 class="heading-section"><a href="" class="text-decoration-none">
            <span class="h1 text-uppercase text-warning bg-dark px-2">SOLAR</span>
            <span class="h1 text-uppercase text-dark bg-warning px-2 ml-n1">SYSTEM</span>
        </a></h2>
        </div>
      </div>
      
        
          <div class="login-wrap py-5">
            <div class="img d-flex align-items-center justify-content-center" style="background-image: url(uploads/1662775755597991552631bf1cb52914butter3.jpg);"><i class="fa fa-user"></i></div>

            <h3 class="text-center mb-0">Welcome</h3>
            <p class="text-center">Sign in by entering the information below</p>
            <form class="login-form" method="post">
              <div class="form-group">
                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
                <input type="text" class="form-control" placeholder="Username" name="user_name" required>
              </div>
              <div class="form-group">
                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
              </div>
               <?php echo $error; ?>
              <div class="form-group d-md-flex">
                <div class="w-100 text-md-right">
                  <a href="#">Forgot Password</a>
                </div>

              </div>
            
              <div class="form-group">
                <button type="submit" class="btn form-control btn-primary rounded submit px-3" name="login">Login</button>
              </div>
            </form>
          
          </div>
       

    </div>
  </section>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

 
			
				</div>
			</div>
		</div>
	</div>
</body>
<style type="text/css">
	.col-lg-8 {
  background: linear-gradient(90deg, #55bbb5 50%, #555aac);
  height: 720px;


}


</style>
 <script type="text/javascript">
  $(document).ready(function() {
  $("#alert-danger").hide();
  
    $("#alert-danger").fadeTo(2, 500).slideUp(500, function() {
      $("#alert-danger").slideUp(500);
    });

});
 </script>
<script type="text/javascript">
// 	$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
//   var $this = $(this),
//       label = $this.prev('label');

// 	  if (e.type === 'keyup') {
// 			if ($this.val() === '') {
//           label.removeClass('active highlight');
//         } else {
//           label.addClass('active highlight');
//         }
//     } else if (e.type === 'blur') {
//     	if( $this.val() === '' ) {
//     		label.removeClass('active highlight'); 
// 			} else {
// 		    label.removeClass('highlight');   
// 			}   
//     } else if (e.type === 'focus') {
      
//       if( $this.val() === '' ) {
//     		label.removeClass('highlight'); 
// 			} 
//       else if( $this.val() !== '' ) {
// 		    label.addClass('highlight');
// 			}
//     }

// });

// $('.tab a').on('click', function (e) {
  
//   e.preventDefault();
  
//   $(this).parent().addClass('active');
//   $(this).parent().siblings().removeClass('active');
  
//   target = $(this).attr('href');

//   $('.tab-content > div').not(target).hide();
  
//   $(target).fadeIn(600);
  
// });
</script>
<style type="text/css">
  
</style>
</html>