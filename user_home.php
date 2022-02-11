<?php 
session_start();
include('db.php');
include('pro_table_check.php');

if(isset($_SESSION['user'])) {
    $row_c = $_SESSION['user'];
}

if(!isset($_SESSION['user'])) {
    header("location:index.php");
}

$home = true;
$view = false;
$bids = false;
$products = false;

?>





<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<style>
/*
body {
	background-image: url(Silver-Blur-Background-Wallpaper.jpg);
	background-repeat: no-repeat;
	background-size: cover;
	background-attachment: fixed;
}*/

.bg-gray {
    background-color: rgba(24, 44, 97, .3);
}
.container_flex {
	background-color: gray;
	display: flex;
	flex-direction: row-reverse;
}

.bg-nav {
    background-color: rgb(24, 44, 97) !important;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    z-index: 5;
}

.bg-darkblue {
    background-color: rgb(24, 44, 97) !important;
}

.item {
	margin: 0;
}

.product_img {
	background-size: cover;
}

/*.card {
	width: 30%;
}*/

.row {
	display: flex;
	align-items: stretch;

}

.max-width {
	max-width: 30%;
}

.bg-card {
	background-color: rgba(189, 195, 199, .7);/*
	background-color: rgba(112, 111, 211, .7);*/
	color: #6c757d !important;
}


.bg-card-footer {
	background-color: rgba(236, 240, 241, .5);/*
	background-color: rgba(39, 60, 117, .7);*/
}

.text {
  color: #6c757d !important;
}

a.text:hover,
a.text:focus {
  color: #57606f !important;
}
</style>

<body>

	<?php include 'nav.php'; ?>

		
<br><br><br>

    <?php
    $query1 = "select * from tbl_product where status = 'On Sale' ORDER BY pro_id DESC;";
	$run_q1 = $con->query($query1);
	$showing_products = $run_q1->num_rows;
    ?>

    <h4 class="m-3 text-info">Showing <?php echo $showing_products; ?>&nbsp;Products&nbsp;for&nbsp;Sale</h4>

    <form>
		    <div class="container mt-5 mb-5">
				<?php

				?>
				<div class="row">
				<?php
				
				while ($row_q1 = $run_q1->fetch_object()) {
					$bid_s_time = $row_q1->bidstarttime;
        			$bid_e_time = $row_q1->bidendtime;
        			$product_id = $row_q1->pro_id;

        			$nt = new DateTime($bid_s_time);
        			$bid_s_time = $nt->getTimestamp();


        			$nt = new DateTime($bid_e_time);
        			$bid_e_time = $nt->getTimestamp();

        			$date = time();

					$pro_id = $row_q1->pro_id;
					$query5 = "select * from tbl_bid where pro_id = $pro_id;";
					$run_q5 = $con->query($query5);
					$total_bids = $run_q5->num_rows;
						?>
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">	
								<div class="card mt-3 mb-3">
									<?php  
									$query6 = "select * from tbl_img where pro_id = $pro_id LIMIT 1";
									$run_q6 = $con->query($query6);
									$row_q6 = $run_q6->fetch_object();
									$image_name = $row_q6->img_name;
									$image_destination = "product_images/".$image_name;
									?>
									<h4 class="btn btn-sm btn-light mt-3"><?php echo "Bid ends : $row_q1->bidendtime"; ?></h4>
									<img class="product_img card-img-top" src="<?php echo $image_destination; ?>"  height="200vh" width="100%" alt="Product Image">
									<div class="card-body bg-gray">
										<a class="card-title text-dark" href="view_product.php?pro_id=<?php echo $pro_id; ?>"><h5><?php echo $row_q1->name; ?></h5></a>
										
										<h4 class="font-weight-light">&nbsp;&#8377;<?php echo $row_q1->price; ?></h4>
										
										<?php if($bid_s_time < $date) { ?>
										<a href="buyer_bid.php?pro_id=<?php echo $row_q1->pro_id;?>" class="btn btn-sm btn-light mt-3">Bid</a>
										<?php }
										else { ?>
										<h4 class="btn btn-sm btn-light mt-3"><?php echo "Bid has not started"; ?></h4>
										<?php } ?>

									</div>
									<div class="card-footer bg-card-footer text-muted">
										<?php

										echo $total_bids." ";
										($total_bids >1 ? $printing = "bids on this product" : $printing = "bid on this product");
										echo $printing;
										?>  
									</div>
								</div>
							</div>
						<?php
				}
				?>
				</div>
			</div>
	</form>

	
	

	


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>