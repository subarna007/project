<?php
include_once '../dashboard-components/dashboard.php';
?>

<div class="wrapper block">
    <table class='table'>
    <?php
    include_once '../config.php';
    $sql="SELECT * FROM `amenities`";
    if($result=mysqli_query($conn,$sql)){
        echo '<tr><th>S.N</th><th>Amenity name</th><th>Photo</th><th>Option</th></tr>';
        $i=0;
        if(mysqli_num_rows($result)){
            while($row=mysqli_fetch_assoc($result)){
                echo "<tr><td>".++$i."</td>";
                echo "<td>".$row['amenity_name']."</td>";
                echo "<td><img src='".$row['photo']."' width=100px height=100px> </td>";
                echo "<td><button><i class='fas fa-edit'></i></button><button onclick=''><i class='fas fa-trash'></i></button></td>";
                echo "</tr>";
            }
        }
    }
    ?>
    </table>
</div>
<?php
// if(isset($_POST['delete_amenity'])){
//     $_POST['name']
// }
?>