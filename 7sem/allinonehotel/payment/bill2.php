<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<style>
    body{
    margin-top:20px;
    color: #555b66;
    }
    .text-secondary-d1 {
        color: #728299;
    }
    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }
    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }
    .brc-default-l1 {
        border-color: #dce9f0 ;
    }

    .ml-n1, .mx-n1 {
        margin-left: -.25rem ;
    }
    .mr-n1, .mx-n1 {
        margin-right: -.25rem ;
    }
    .mb-4, .my-4 {
        margin-bottom: 1.5rem ;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
    }

    .text-grey-m2 {
        color: #888a8d ;
    }

    .text-success-m2 {
        color: #86bd68 ;
    }

    .font-bolder, .text-600 {
        font-weight: 600 ;
    }

    .text-110 {
        font-size: 110% ;
    }
    .text-blue {
        color: #478fcc ;
    }
    .pb-25, .py-25 {
        padding-bottom: .75rem ;
    }

    .pt-25, .py-25 {
        padding-top: .75rem ;
    }
    .bgc-default-tp1 {
        background-color: rgba(121,169,197,.92) ;
    }
    .bgc-default-l4, .bgc-h-default-l4:hover {
        background-color: #f3f8fa ;
    }
    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }
    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120% ;
    }
    .text-primary-m1 {
        color: #4087d4 ;
    }

    .text-danger-m1 {
        color: #dd4949 ;
    }
    .text-blue-m2 {
        color: #68a3d5 ;
    }
    .text-150 {
        font-size: 150% ;
    }
    .text-60 {
        font-size: 60% ;
    }
    .text-grey-m1 {
        color: #7b7d81 ;
    }
    .align-bottom {
        vertical-align: bottom ;
    }

</style>
<?php
include_once "../classes/index.php";
include_once "../payment/setting.php";
$username="";
$conn=new DBConnect();
 if(isset($_GET["id"])){
    if(!empty($_GET["id"])||$_GET["id"]!=""){
       
        $result1=$conn->own_query("Select b.room_name,b.price,b.payment_date,b.check_in_date,b.check_out_day,u.id, u.full_name, u.username, u.address, u.contact from user_details u inner join bookings b where b.user_id=u.id and check_in_date='".$_GET["cin"]."' and check_out_day='".$_GET["cout"]."' and b.user_id=".$_GET["id"]." and b.payment_date='0'");
        // echo "Select b.room_name,b.price,b.payment_date,u.id, u.full_name, u.username, u.address, u.contact from user_details u inner join bookings b where b.user_id=u.id and check_in_date='".$_GET["cin"]."' and check_out_day='".$_GET["cout"]."' and b.user_id=".$_GET["id"]." and b.payment_date='0'";
        // echo "<pre>";print_r($result1);echo "</pre>";
        // foreach($result1 as $row1)
        {
            $i=1;
            $total=0.0;
    ?>
    <div class="page-content container">
    <div class="page-header text-blue-d2">
        <!-- <h1 class="page-title text-secondary-d1">
           
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #111-222
            </small>
        </h1> -->

        <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" onclick="this.style.display='none';document.getElementById('pay_now').style.display='none';window.print();this.style.display='block';document.getElementById('pay_now').style.display='block';" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
                
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                            <span class="text-default-d3"><h1>All in One Hotel</h1></span>
                            <h3><center>Gwarko,Kathmandu</center></h3>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle"><?php $username=$result1[0]["username"];echo $result1[0]["username"]?></span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                <?=$result1[0]["address"]?>
                            </div>
                            
                            <div class="my-1">
                                <i class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                                 <b class="text-600"><?=$result1[0]["contact"]?></b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> <?=$pid?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span><?= date("Y/m/d")?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <?php 
                            if($result1[0]["payment_date"]==0){
                                $payment_status='<span class="badge badge-warning badge-pill px-25" style="background-color:red;color:white;border-radius:7px;">Unpaid</span>';
                            }
                            else{
                                $payment_status='<span class="badge badge-warning badge-pill px-25" style="background-color:green;color:white;border-radius:7px;">Paid</span>';
                            }
                            echo $payment_status;
                            ?></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">S.N.</div>
                        <div class="col-9 col-sm-5">Description</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                        <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                        <div class="col-2">Amount</div>
                    </div>

                   
                        <?php
                               if(isset($_GET["package"])){
                                if($_GET["package"]=="no"){
                                    // print_r($row1);
                                    foreach($result1 as $row1){
                                            // $i=1;
                                            // $total=0.0;
                                            
                                            $diff=date_diff(date_create($row1["check_in_date"]),date_create($row1["check_out_day"]));
                                            $b= $diff->format("%a");
                                           
                                            $price=(float)$row1["price"]*intval($b);
                                            // if($price==0){
                                            //     continue;
                                            // }
                                            echo'
                                            <div class="text-95 text-secondary-d3">
                                            <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                                <div class="d-none d-sm-block col-1">'.$i++.'</div>
                                                <div class="col-9 col-sm-5">'.$row1["room_name"].'</div>
                                                <div class="d-none d-sm-block col-2">1</div>
                                                <div class="d-none d-sm-block col-2 text-95">NRs-';
                                                echo $price.'(Stay: '.$b.' days)'.'</div>
                                                <div class="col-2 text-secondary-d2">NRs-';                                            
                                                echo $price;  $total+=$price;
                                                echo '</div>
                                            </div>                                    
                                            ';
                                        }
                                        $sql="Select * from food_order where user_id=".$_GET["id"]." and date2>='".str_replace("/","-",$_GET['cin'])."' and date2<='".str_replace("-","/",$_GET["cout"])."' and payment_status='0'";
                                        // echo $sql;
                                        $result2=$conn->own_query($sql);
                                        // print_r($result2);
                                        
                                            if(count($result2)>0){
                                                foreach($result2 as $row2){
                                                echo '
                                                <div class="row mb-2 mb-sm-0 py-25">
                                                    <div class="d-none d-sm-block col-1">
                                                        '.++$i.'
                                                    </div>
                                                    <div class="col-9 col-sm-5">
                                                    '.$row2["food_name"].'
                                                    </div>
                                                    <div class="d-none d-sm-block col-2">
                                                    '.$row2["qty"].'
                                                    </div>
                                                    <div class="d-none d-sm-block col-2 text-95">
                                                        NRs-'.$row2["price"].'
                                                    </div>
                                                    <div class="col-2 text-secondary-d2">
                                                        NRs-'.$row2["qty"]*$row2["price"].'
                                                    </div>
                                                </div>
                                                ';
                                                $price=(float)$row2["price"];
                                                $qty=(float)$row2["qty"];
                                                $total=$total+$qty*$price;
                                                }
                                            }                                        
                                            
                                    }
                                    else{
                                        echo '<div class="text-95 text-secondary-d3">';
                                        echo'
                                        <div class="text-95 text-secondary-d3">
                                        <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                            <div class="d-none d-sm-block col-1">'.$i.'</div>
                                            <div class="col-9 col-sm-5">'.ucfirst($_GET["package"]).' package</div>
                                            <div class="d-none d-sm-block col-2">1</div>
                                            <div class="d-none d-sm-block col-2 text-95">NRs-'.$_GET["pkg_price"].'</div>
                                            <div class="col-2 text-secondary-d2">NRs-';
                                            echo $_GET["pkg_price"]; $price=(float)$_GET["pkg_price"]; $total+=$price;
                                            echo '</div>
                                        </div>                                    
                                        ';
                                    }
                                    if($_GET["package"]!="gold"){
                                        $result3=$conn->own_query("Select * from adventure_booked ab inner join adventure a on a.id=ab.adventure_id and ab.booking_name='".$username."' and ab.date_booked>='".$_GET["cin"]."' and ab.date_booked<='".$_GET["cout"]."'");
                                             if(count($result3)>0){
                                                foreach($result3 as $row2){
                                                    $qty=1;
                                                echo '
                                                <div class="row mb-2 mb-sm-0 py-25">
                                                    <div class="d-none d-sm-block col-1">
                                                        '.++$i.'
                                                    </div>
                                                    <div class="col-9 col-sm-5">
                                                    '.ucfirst($row2["adventure_name"]).'
                                                    </div>
                                                    <div class="d-none d-sm-block col-2">
                                                    '.$qty.'
                                                    </div>
                                                    <div class="d-none d-sm-block col-2 text-95">
                                                        NRs-'.$row2["price"].'
                                                    </div>
                                                    <div class="col-2 text-secondary-d2">
                                                        NRs-'.$qty*$row2["price"].'
                                                    </div>
                                                </div>
                                                ';
                                                $price=(float)$row2["price"];
                                                $qty=(float)$qty;
                                                $total=$total+$qty*$price;
                                                }
                                            }
                                    }
                               }

                        ?>
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <!-- Extra note such as company or payment information... -->
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1">NRs-<?=$total?></span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Tax (10%)
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1">NRs-
                                        <?php
                                            $tax=0.1*$total;
                                            $t_total=$tax+$total;
                                            echo $tax;
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2">NRs- <?=$t_total?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        
                        <span class="text-secondary-d1 text-105"><center>Thank you for visiting us.Please visit us again.</center></span>
                        
                        <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                <input  name="tAmt" id="tAmt" type="hidden" value="<?php echo $t_total;?>">
                                <input id="amt" name="amt" type="hidden" value="<?php echo $total;?>">
                                <input name="txAmt" id="txAmt" type="hidden" value="<?php echo $tax;?>">
                                <input value="0" name="psc" type="hidden">
                                <input value="0" name="pdc" type="hidden">
                                <input value="EPAYTEST" name="scd" type="hidden">
                                <input value="<?=$pid?>" name="pid" type="hidden">
                                <?php echo ' <input value="http://localhost/project/7sem/allinonehotel/payment/success.php?id='.$_GET["id"].'&cin='.$_GET["cin"].'&cout='.$_GET["cout"].'&package='.$_GET["package"].'&pkg_price='.$_GET["pkg_price"].'" type="hidden" name="su">
                                <input value="http://localhost/project/7sem/allinonehotel/payment/failure.php?" type="hidden" name="fu">
                               ';?>
                                <button type='submit' id='pay_now' class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</button>
                    
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
        }
    }
 }
 else{
     echo "First select bill to generate";
 }
?>