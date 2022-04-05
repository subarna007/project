

<div class="block" id="adventures">
        <h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Adventures</h1>
        <div class="blocks">
            <?php
            include_once "classes/index.php";
            $conn=new DBConnect();
            $result=$conn->own_query("Select * from adventure");
            if(count($result)>0){
                $i=0;
                foreach($result as $row)   
                    {if($i++<4) 
                        {
                            echo '
                            <div class="card" style="width: 18rem;">
                            <img src="img/adventures/'.$row['photo'].'" class="card-img-top" alt="'.$row['adventure_name'].'">
                                <div class="card-body">
                                <h5 class="card-title">Bungee Jumping</h5>
                                <p><i class="bi bi-geo-alt"></i>'.$row["location"].' </p>
                                <a href="adventure-details.php?loc='.$row["location"].'&ad_name='.$row["adventure_name"].'" class="btn btn-success">Check it Out</a>
                                </div>
                            </div>
                            ';
                        }
                        else{
                            break;
                        }
                    }
            }
            else{
                echo "No adventures available please add it first";
            }
            ?>
        </div>
        <center><a href="components/new_adventures.php" class="btn btn-outline-dark m-4">Check out all the available adventures</a></center>
    </div>