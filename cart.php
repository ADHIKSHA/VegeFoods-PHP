
<?php
session_start();
$flag=0;
// initializing variables
$errors = array(); 
$success="";
if(isset($_SESSION['email'])){
$email=$_SESSION['email'];
$dishids = array();
// connect to the database
$db = mysqli_connect('localhost:3307', 'root', '', 'foodshala');

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM cart as c,menu as m WHERE c.email='$email' AND c.dishid=m.dishid LIMIT 15";
  $result = mysqli_query($db, $user_check_query);
}
else{
  header('location: userlogin.php');
}
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
<style type="text/css">
     img{
      width: 200px;
      height: 200px;
     } 

    </style>
    
  </head>
  <body class="goto-here">
  <p id="demo"></p>
		<div class="py-1 bg-primary">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+ 1235 2355 98</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">youremail@email.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">3-5 Business days delivery &amp; Free Returns</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">FoodShala</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
	          
	          <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span></a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Product name</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>
                  <form action="cart.php" method="POST">
                  <?php while($row = mysqli_fetch_array($result, MYSQLI_NUM)):?>
						      <tr class="text-center">
						        <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
						        
						        <td class="image-prod"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row[7] ).'"/>';?></td>
						        
						        <td class="product-name">
						        	<h3> <?php $dishid=$row[1]; array_push($dishids,$dishid);echo $row[4];?> </h3>
						        	<p><?php echo $row[5];?></p>
						        </td>
						        
						        <td class="price" ><textarea id="<?php echo 'price'.$dishid;?>" name="<?php echo 'price'.$dishid;?>" disabled><?php echo $row[6];?></textarea></td>
						        
						        <td class="quantity">
						        	<div class="input-group mb-3">
					             	<input type="text" name="<?php echo 'quantity'.$dishid;?>" id="<?php echo 'quantity'.$dishid;?>" class="quantity form-control input-number" value="1" min="1" onChange="doFun()" max="100">
                        
					          	</div>
					          </td>
						        
						        <td class="total"><input type="text" id="<?php echo 'totalcost'.$dishid;?>" name="<?php echo 'totalcost'.$dishid;?>" value="<?php echo $row[6];?>" disabled></td>
						      </tr><!-- END TR-->
                  <?php endwhile ?>
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			
    			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
    						<span id="sumofall"></span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery Charges</span>
    						<span>5%</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span id="disct"></span>
    					</p>
    				</div>
    				<p><input type="submit" name="checkouter" value="Proceed to Checkout" class="btn btn-primary py-3 px-4"></p>
            </div>
			</div>
      </form>
		</section>
<?php
  if(isset($_POST['checkouter'])){
    $success="YESS";
    //print_r($_POST);
    $sum=0;
    foreach ($dishids as $key => $value) {
      # code...
      $success="NO";
      $q="quantity".$value;
      $p="price".$value;
      $t="totalcost".$value;

      $qun=$_POST[$q];
      $pun=$_POST[$p];
      $tun=$_POST[$t];
      $sum=$sum+($qun*$pun);
      //echo $pun;
      $query="INSERT INTO transactions(email,dishid,quantity,total) VALUES ('$email','$value','$qun','$tun')";
      $res = mysqli_query($db, $query);   

    }
    $_SESSION['costings']=$sum;
    $url="checkout.php";
    if (!headers_sent())
    {
        header('Location: '.$url);
        exit;
    }
    else
    {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; 
        exit;
    }
  }
?>
		<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row">
            <div class="mouse">
                        <a href="#" class="mouse-icon">
                            <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                        </a>
                    </div>
        </div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">FoodShala</h2>
              <p>Order good food and manage your menus.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Shop</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Journal</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">Have a Questions?</h2>
                <div class="block-23 mb-3">
                  <ul>
                    <li><span class="icon icon-map-marker"></span><span class="text">Adhiksha Thorat , Maharashtra ,India</span></li>
                    <li><a href="#"><span class="icon icon-phone"></span><span class="text">8888888888</span></a></li>
                    <li><a href="#"><span class="icon icon-envelope"></span><span class="text">adhikshat1905@gmail.com</span></a></li>
                  </ul>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

          </div>
        </div>
      </div>
    </footer>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

    <script language="javascript" type="text/javascript">

      var sum=0;
      var disct=5;
      var x=[];
      x= <?php echo json_encode($dishids); ?>;
      for(var i=0;i<x.length;i++){
        var s="totalcost"+x[i];
        var temp=document.getElementById(s).value;
        sum=sum+parseInt(temp);
      }
      discount= sum-(sum*(disct/100));
      document.getElementById('sumofall').innerHTML=sum;
      document.getElementById('disct').innerHTML = discount;
      //alert(disct);
    function doFun(){
      //var x=[];
      //dishids=[];
      sum=0;
      x= <?php echo json_encode($dishids); ?>;
        //console.log(x.length);
      for(var i=0;i<x.length;i++){
        strq="quantity";
        strp="price";
        strt="totalcost";
        var tun=strt+x[i];
        var qun=strq+x[i];
        var pun=strp+x[i];
        var q= document.getElementById(qun).value;
        var p=document.getElementById(pun).innerHTML;
        var tot=p*q;
        //console.log(x[i]);
        sum=sum+tot;
        //alert(q);
        document.getElementById(tun).value = tot;
      }

      discount= sum-(sum*(disct/100));
      //alert(sum);
      document.getElementById('sumofall').innerHTML=sum;
      document.getElementById('disct').innerHTML = discount;
    };

  </script>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  </body>
</html>