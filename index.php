<?php session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		
		}else{
			$message="Product ID is invalid";
		}
	}
	$_SESSION['message'] = "Product has been added to the cart!";
	header("Location: index.php");
	exit();
	
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Shopping Portal Home Page</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/red.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/">
		<link rel="stylesheet" href="assets/css/owl.carousel.css">

<style>
	/* 5 per row on large screens */
@media (min-width: 1200px) {
  .col-lg-2-4 {
    flex: 0 0 auto;
    width: 20%;
  }
}

/* Product image styling */
.product-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 6px;
}

/* Product name trimming */
.product-name {
  font-size: 0.95rem;
  font-weight: 500;
  height: 38px;
  overflow: hidden;
}

/* Price styling */
.price {
  font-size: rem;
}

</style>
	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<?php if (isset($_SESSION['message'])) { ?>
  <div class="alert alert-success text-center" style="margin: 20px auto; max-width: 600px;">
    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
  </div>
<?php } ?>

<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
		<div class="furniture-container homepage-container">
		<div class="row">
		
			<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
				<!-- ================================== TOP NAVIGATION ================================== -->
	<?php include('includes/side-menu.php');?>
<!-- ================================== TOP NAVIGATION : END ================================== -->
			</div><!-- /.sidemenu-holder -->	
			
			<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
				<!-- ========================================== SECTION – HERO ========================================= -->
				<div id="hero" class="homepage-slider3" 
     style="box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
            border-radius: 8px; 
            background-color: #f8f9fa; 
            overflow: hidden; 
            margin-bottom: 20px;">

  <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm text-center">
    <?php
    $sliderDir = "assets/images/sliders/myslider/";
    $images = glob($sliderDir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    foreach ($images as $imgPath) {
      $imgName = basename($imgPath);
      echo '
      <div class="full-width-slider">
        <div class="item">
          <img src="' . $imgPath . '" alt="' . $imgName . '" 
               style="height:400px; max-width: 100%; object-fit: contain; display: inline-block;">
        </div>
      </div>';
    }
    ?>
  </div>
</div>

	
<!-- ========================================= SECTION – HERO : END ========================================= -->	
				<!-- ============================================== INFO BOXES ============================================== -->
				<div class="info-boxes wow fadeInUp" ">
	<div class="info-boxes-inner" >
		<div class="row" >
			<div class="col-md-6 col-sm-4 col-lg-4" >
				<div class="info-box backkeyframe" style="border:4px solid #f0eeeb;border-radius:4px;">
					<div class="row">
						<div class="col-xs-2">
						     <i class="icon fa fa-dollar"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading green">Return Policy</h4>
						</div>
					</div>	
					<h6 class="text">Same Day</h6>
				</div>
			</div><!-- .col -->

			<div class="hidden-md col-sm-4 col-lg-4">
				<div class="info-box backkeyframe"  style="border:4px solid #f0eeeb;border-radius:4px;">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-truck"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading orange">free shipping</h4>
						</div>
					</div>
					<h6 class="text">free ship-on oder over Rs. 499.00</h6>	
				</div>
			</div><!-- .col -->

			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box backkeyframe" style="border:4px solid #f0eeeb;border-radius:4px;">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-gift"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading red">Special Sale</h4>
						</div>
					</div>
					<h6 class="text">All items-sale up to 10% off </h6>	
				</div>
			</div><!-- .col -->
		</div><!-- /.row -->
	</div><!-- /.info-boxes-inner -->
	
</div>
<!-- ============================================== INFO BOXES : END ============================================== -->		
			</div><!-- /.homebanner-holder -->
			
		</div><!-- /.row -->
<!-- PRODUCTS SECTION START -->
<section class="new-products mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="section-title">All Products</h3>
  </div>

  <div class="row">
    <?php
    $ret = mysqli_query($con, "SELECT * FROM products");
    if (mysqli_num_rows($ret) > 0) {
      while ($row = mysqli_fetch_array($ret)) {
    ?>
        <div class="col-4 col-md-3 col-lg-2-4 mb-4" > <!-- 2.4 col for 5 per row on large screens -->
          <div class="card h-100 shadow-sm border-0" style="margin:2px;background-color:;padding:5px;box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 8px;" >
            <a href="product-details.php?pid=<?php echo $row['id']; ?>">
              <img src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>"
                   class="card-img-top product-image"
                   alt="<?php echo htmlentities($row['productName']); ?>">
            </a>
            <div class="card-body text-center" >
              <h6 class="product-name ">
                <?php echo htmlentities($row['productName']); ?>
              </h6>
              <p class="price " style="margin-top:-20px;">
                <strong class="text-danger">₹<?php echo htmlentities($row['productPrice']); ?></strong>
                <small class="text-muted"><del>₹<?php echo htmlentities($row['productPriceBeforeDiscount']); ?></del></small>
              </p>
              <?php if ($row['productAvailability'] == 'In Stock') { ?>
                <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                   class="btn btn-sm btn-success w-100 " style="margin-buttom: 200px;background-color:red" >
                  <i class="fa fa-cart-plus"></i> Add to cart
                </a>
              <?php } else { ?>
                <span class="badge bg-danger w-100">Out of Stock</span>
              <?php } ?>
            </div>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<div class='col-12 text-center'><p>Updating soon...</p></div>";
    }
    ?>
  </div>
</section>
<!-- PRODUCTS SECTION END -->

		<!-- ============================================== SCROLL TABS ============================================== -->
		

         <!-- ============================================== TABS ============================================== -->
	
		
<hr />

<?php include('includes/brands-slider.php');?>
</div>
</div>
<?php include('includes/footer.php');?>
	
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	<script>
  setTimeout(function() {
    let alert = document.querySelector('.alert');
    if(alert){
      alert.style.transition = "opacity 0.5s ease";
      alert.style.opacity = 0;
      setTimeout(() => alert.remove(), 500);
    }
  }, 3000); // Hide after 3 seconds
</script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
		

  $(document).ready(function(){
    $("#owl-main").owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 3000,
      nav: true,
      dots: true
    });
  });
</script>
<script src="assets/js/owl.carousel.min.js"></script>

	<!-- For demo purposes – can be removed on production : End -->

	

</body>
</html>