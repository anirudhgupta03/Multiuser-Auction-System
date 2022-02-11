<?php
	date_default_timezone_set("Asia/Kolkata");
    $user = "root";
    $pass = "";
    $db = "online-auction-master";
	
	$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
    
    $qry = "SELECT * FROM tbl_product";
    $res = mysqli_query($db_connect, $qry);
    while($row = mysqli_fetch_assoc($res)){
        $bid_s_time = $row['bidstarttime'];
        $bid_e_time = $row['bidendtime'];
        $product_id = $row['pro_id'];

        $nt = new DateTime($bid_s_time);
        $bid_s_time = $nt->getTimestamp();
        $currentstatus = $row['status'];

        $nt = new DateTime($bid_e_time);
        $bid_e_time = $nt->getTimestamp();

        $date = time();
        
        if($bid_e_time > $date && $currentstatus != 'Disable')
        {
            $qry = "UPDATE tbl_product SET Status = 'On Sale' WHERE pro_id = '$product_id'";
            mysqli_query($db_connect, $qry);
        }
        else if($bid_e_time > $date && $currentstatus == 'Disable')
        {
            
        }
        else if($currentstatus != 'Sold')
        {
            $qry = "UPDATE tbl_product SET Status = 'Sold' WHERE pro_id = '$product_id'";
            mysqli_query($db_connect, $qry);

            $query = "select * from tbl_bid where pro_id = '$product_id' ORDER BY bid_amount DESC";
            $run = $db_connect->query($query);
            $num = $run->num_rows;
            if($num > 0)
            {
                $res_q = $run->fetch_object();
                $bid_id = ($res_q)->bid_id;
                $buyer_id = ($res_q)->uid;
                $purchase_qry = "INSERT  into tbl_purchase (bid_id, buyer_id) values ($bid_id, $buyer_id) ;";
         
                mysqli_query($db_connect, $purchase_qry);
            }
            
        }
    }
?>