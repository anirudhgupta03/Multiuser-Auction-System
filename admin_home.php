<?php 
session_start();
include('db.php');
include('pro_table_check.php');


if(isset($_SESSION['admin_login'])) {
    $row_c = $_SESSION['admin_login'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<style type="text/css">
body {
    background-image: url(2253.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
.right {
    margin: 20px;
    position: absolute;
    top: 0;
    right: 0;
}
a {
  color: blue;
  background-color: 009900;
  margin: 20px;
  font-size: 25px;
}
.dive
{
  color: white;
  background-color: 009900;
  margin: 150px;
  font-size: 25px;
}
div
{
  color: white;
  background-color: 009900;
  margin: 20px;
  font-size: 25px;
}
</style>
<body>

	<div class="dive" >
    	<a class="btn btn-danger" href="logout.php">LOGOUT</a>
    </div>

	<div>
		<a class="btn btn-primary btn-lg btn-block mt-5" href="view.php">View All Users</a>
		<a class="btn btn-primary btn-lg btn-block mt-5" href="admin_product.php">View All Product</a>
	</div>
	
</body>
</html>