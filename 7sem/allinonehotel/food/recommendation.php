<?php
// include_once "../classes/index.php";
// $conn=new DBConnect();
// $arr=array();
// $food_ordered="Pizza";
// $result1=$conn->own_query("Select distinct(username) from food_order where food_name='$food_ordered';");
// if(count($result1)){
//     foreach($result1 as $row){
//         $result2=$conn->own_query("Select * from food_order where username='".$row["username"]."';");
//         array_push($arr,$result2);
//     }
// }
// print_r($arr);
?>

<?php
echo "<pre>";
/*
 * @DanDuus - http://dan.thoeisen.dk
 * Original Python impl: http://www.quuxlabs.com/blog/2010/09/matrix-factorization-a-simple-tutorial-and-implementation-in-python/
@INPUT:
    R     : a matrix to be factorized, dimension N x M
    P     : an initial matrix of dimension N x K
    Q     : an initial matrix of dimension M x K
    K     : the number of latent factors
    steps : the maximum number of steps to perform the optimization
    alpha : the learning rate
    beta  : the regularization parameter
@OUTPUT:
    the final matrices P and transposed(Q)
*/
function matrix_factorization($R, $P, $Q, $K, $steps=5000, $alpha=0.0002, $beta=0.02){
    $Q = transpose($Q);
	for($step = 0; $step<$steps; $step++){
		for($i = 0; $i<count($R); $i++){
			for($j = 0; $j<count($R[$i]); $j++){
				if ($R[$i][$j] > 0){
					$sigmaPQ = 0;
					for($z = 0; $z < $K; $z++){
						$sigmaPQ += $P[$i][$z] * $Q[$z][$j];
					}
                    $eij = $R[$i][$j] - $sigmaPQ;
                    for ($k = 0; $k < $K; $k++){
                        $P[$i][$k] = $P[$i][$k] + $alpha * (2 * $eij * $Q[$k][$j] - $beta * $P[$i][$k]);
						$Q[$k][$j] = $Q[$k][$j] + $alpha * (2 * $eij * $P[$i][$k] - $beta * $Q[$k][$j]);
					}
				}
			}
		}
        $e = 0;
		for ($i = 0; $i < count($R); $i++){
            for ($j = 0; $j < count($R[$i]); $j++){
                if ($R[$i][$j] > 0){
					//pow(x, y, z) = x to the power of y modulo z.

					$sigmaPQ = 0;
					for($z = 0; $z < $K; $z++){
						$sigmaPQ += $P[$i][$z] * $Q[$z][$j];
					}
                    $e = $e + pow($R[$i][$j] - $sigmaPQ, 2);
                    for ($k = 0; $k < $K; $k++){
						$e = $e + ($beta/2) * ( pow($P[$i][$k],2) + pow($Q[$k][$j],2) );
					}
				}
			}
		}
        if ($e < 0.001){
			break;
		}
	}
    return [$P, transpose($Q)];
}

//Example ratings matrix (This could be from a database)
$R = [
         [5,3,0,1],
         [4,0,0,1],
         [1,1,0,5],
         [1,0,0,4],
         [0,1,5,4],
        ];
print_r($R);
$N = count($R);
$M = count($R[0]);
//Number of latent factors
$K = 2;

$P = generateRandomArray($N, $K);
$Q = generateRandomArray($M, $K);



$calculatedRatingsMatrix = matrix_factorization($R, $P, $Q, $K);
echo "This is the final matrix - where all user-item pairs with 0 has been approximated";
var_dump(matrixmult($calculatedRatingsMatrix[0], transpose($calculatedRatingsMatrix[1])));


/*
 * Helper functions
 * */
function matrixmult($matrix_a,$matrix_b){
    $matrix_a_count=count($matrix_a);
    $c=count($matrix_b[0]);
    $matrix_b_count=count($matrix_b);
    if(count($matrix_a[0])!=$matrix_b_count){throw new Exception('Incompatible matrices');}
    $matrix_return=array();
    for ($i=0;$i< $matrix_a_count;$i++){
        for($j=0;$j<$c;$j++){
            $matrix_return[$i][$j]=0;
            for($k=0;$k<$matrix_b_count;$k++){
                $matrix_return[$i][$j]+=$matrix_a[$i][$k]*$matrix_b[$k][$j];
            }
        }
    }
    return($matrix_return);
}
function generateRandomArray($dim, $num){
    $newArray = array();
    for($i = 0; $i < $dim; $i++){
        for($j = 0; $j < $num; $j++){
            $newArray[$i][$j] = mt_rand() / mt_getrandmax();
        }
    }
    return $newArray;

}
function transpose($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}
?>