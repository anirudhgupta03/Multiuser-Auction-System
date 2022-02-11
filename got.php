<?php 
session_start();
include('db.php');
include('pro_table_check.php');
if(isset($_SESSION['user'])) {
    $row_c = $_SESSION['user'];
}

if (!isset($_SESSION['user'])) {
	header("location:index.php");
}

$home = false;
$view = false;
$bids = true;
$products = false;

?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<style>
/*.bg-nav {
    background-color: rgba(24, 44, 97, .6);
    background-color:  rgba(179, 55, 113, .6);
    background-color: rgba(87, 75, 144, .6);
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    z-index: 5;
}*/

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

</style>

<body>

	<?php include 'nav.php'; ?>

<br><br>
	
<div class="container mt-5 mb-5">
    <div class="card-deck mt-5">
        
    <?php
        $query_bid = "select * from tbl_bid where uid = '$row_c->uid';";
        $run_bid = $con->query($query_bid);

        while($row_bid = $run_bid->fetch_object())
        {
            $query_pur = "select * from tbl_purchase where bid_id = '$row_bid->bid_id';";
            $run_pur = $con->query($query_pur);
            $row_pur = $run_pur->num_rows;
            if($row_pur >= 1)
            {
                $query_pro = "select * from tbl_product where pro_id = '$row_bid->pro_id';";
                $run_pro = $con->query($query_pro);
                $row_pro = $run_pro->fetch_object();
                ?>

                <div class="col-12 mt-4">
					<div class="card">
						<div class="card-body">
							<h3 class="text-dark"><h3 class="card-title mt-4">You&nbsp;got:&nbsp;<?php echo $row_pro->name; ?></h3></h3>
							<h3 class="card-text font-weight-light">Original Price:&nbsp;&#8377;&nbsp;<?php echo $row_pro->price; ?></h3>
							<h3 class="card-text font-weight-light">Bid&nbsp;you&nbsp;made&nbsp;for&nbsp;this&nbsp;Product:&nbsp;&#8377;&nbsp;<?php echo $row_bid->bid_amount; ?></h3>
						</div>
					</div>
				</div>
                <?php
            }
        }
    ?>

    </div>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>