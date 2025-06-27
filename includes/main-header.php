<?php 

 if(isset($_Get['action'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;
			}
		}
		}
	}
?>
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="index.php">
		
	<h2 class="atoms-heading">ATOMS</h2>

<style>
.atoms-heading {
	margin-top:0.5rem;
  font-size: 2rem;
  font-weight: 900;
  letter-spacing: 8px;
  text-transform: uppercase;
  font-family: 'Orbitron', sans-serif; /* futuristic font */
  color: #ffffff;
  background: linear-gradient(90deg, #cccccc, #666666);
  padding: 5px 10px;
  border-radius: 4px;
  text-align: center;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
  animation: glow 2s infinite ease-in-out;
}
.backkeyframe{
	margin-top:0.5rem;
  
  color: #ffffff;
  background: linear-gradient(90deg, #cccccc, #666666);
 
  border-radius: 4px;

  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
  animation: glow 2s infinite ease-in-out;
}
@keyframes glow {
  0%   { box-shadow: 0 0 10px #a94442; }
  50%  { box-shadow: 0 0 25px #d9534f; }
  100% { box-shadow: 0 0 10px #a94442; }
}
</style>

<!-- Load Orbitron font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;900&display=swap" rel="stylesheet">


	</a>
</div>		
</div>
<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder " >
<div class="search-area" style="border:0" >
    <form name="search" method="post" action="search-result.php" style="border-radius:4px;border:2px solid #a9a9a9">
        <div class="control-group">

            <input class="search-field my-input  " placeholder="Search here..." name="product"   />

            <button class="search-button my-input " type="submit" name="search" style="height:5rem;"></button>    

        </div>
    </form>
</div>
<style>
.my-input {
  padding: 10px 15px;
  border: 2px solid #ccc;
  border-radius: 8px;
  font-size: 16px;

}

.my-input:focus {
  outline: none;
  border-color: #0072ff; /* Optional: your custom focus color */
  box-shadow: none;
  
}


</style><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

				<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row"  >
					<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
<?php
if(!empty($_SESSION['cart'])){
	?>
	<div class="dropdown dropdown-cart"  >
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown" style="border:1px solid rgb(220, 220, 220);border-radius:4px" >
			<div class="items-cart-inner" >
				<div class="total-price-basket" >
					<span class="lbl">cart -</span>
					<span class="total-price">
						<span class="sign">Rs.</span>
						<span class="value"><?php echo $_SESSION['tp']; ?></span>
					</span>
				</div>
				<div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count"><?php echo $_SESSION['qnty'];?></span></div>
			
		    </div>
		</a>
		<ul class="dropdown-menu" style="border:1px solid rgb(220, 220, 220);border-radius:4px">
		
		 <?php
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

	?>
		
		
			<li>
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image">
								<a href="product-details.php?pid=<?php echo $row['id'];?>"><img  src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" width="35" height="50" alt=""></a>
							</div>
						</div>
						<div class="col-xs-7">
							
							<h3 class="name"><a href="product-details.php?pid=<?php echo $row['id'];?>"><?php echo $row['productName']; ?></a></h3>
							<div class="price">Rs.<?php echo ($row['productPrice']+$row['shippingCharge']); ?>*<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></div>
						</div>
						
					</div>
				</div><!-- /.cart-item -->
			
				<?php } }?>
				<div class="clearfix"></div>
			<hr>
		
			<div class="clearfix cart-total">
				<div class="pull-right">
					
						<span class="text">Total :</span><span class='price'>Rs.<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>
						
				</div>
			
				<div class="clearfix"></div>
					
				<a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div><!-- /.dropdown-cart -->
<?php } else { ?>
<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
				<div class="total-price-basket">
					<span class="lbl">cart -</span>
					<span class="total-price">
						<span class="sign">Rs.</span>
						<span class="value">00.00</span>
					</span>
				</div>
				<div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count">0</span></div>
			
		    </div>
		</a>
		<ul class="dropdown-menu">
		
	
		
		
			<li>
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-12">
							Your Shopping Cart is Empty.
						</div>
						
						
					</div>
				</div><!-- /.cart-item -->
			
				
			<hr>
		
			<div class="clearfix cart-total">
				
				<div class="clearfix"></div>
					
				<a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue Shooping</a>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div>
	<?php }?>




<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div>