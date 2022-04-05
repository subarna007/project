<?php

include_once "../dashboard-components/dashboard.php";
?>
<div class="wrapper">
    <?php
            include_once "../classes/index.php";
            include_once "../classes/dynamic_table.php";
            table("See Ordered Foods",
            ["S.N","Food Name","Qty","Price","Payment_Status","Date Ordered"],
            ["id","food_name","qty","price","payment_status","date2"],"10","food_order","10");
            $conn=new DBConnect();
            $result=$conn->own_query("Select 8 fro");
    ?>
</div>