<?php
class DBConnect{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "7sem_project";
    private $dsn="";
    function __construct(){
        $sql="Create Database if not exists $this->dbname";
        $this->dsn='mysql:host=' . $this->host;
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $stmt=$pdo->prepare($sql);
            if($stmt->execute()){
                $this->create_table();
            }
            else{
                // echo "<script>console.log('Database creation failed');</script>";
            }
        }
        catch (PDOException $e) {
            // echo $e;
            echo "<script>alert('DB Connection failed.Please contact DB administrator');</script>";
        }
    }

    public function create_table(){
        $sql="create table if not exists food( id int not null auto_increment unique, food_name varchar(80) not null primary key, cost double not null, food_photo varchar(100) not null ,category INT NOT NULL);";
         $sql.="CREATE table if not exists food_category( id int not null auto_increment unique, category varchar(80) not null primary key );";  
        $statement=$this->prepare_stmt($sql);
              $statement->execute();
    }
    public function connection(){
        try{
            $this->dsn='mysql:host=' . $this->host.';dbname='.$this->dbname;           
            $pdo=new PDO($this->dsn,$this->user,$this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  
            return $pdo;          
        }
        catch(PDOException $e){
            echo "<script>alert('Database connectivity failed .Call administrator.');</script>";
        }
    }

    public function remove_connection(){
        $this->dsn=null;
    }

    private function prepare_stmt($sql){
        $statement=$this->connection()->prepare($sql);
        return $statement;
    }
    
    public function insertion($table_name,$array1,$array2){
        $return_data=100;
            $sql="Insert into $table_name(";
            if(count($array1)==count($array2)){
               $i=0;
               while($i<count($array1)-1){
                $sql.="`".$array1[$i++]."`,";
                
               }
               $sql.="`".$array1[$i]."`) values(";
               $i=0;
               while($i<count($array1)-1){
                   $sql.="?,";
                   $i++;
               }
               $sql.="?);";
            //   echo $sql;
               $statement=$this->prepare_stmt($sql);
               try{
               if( $statement->execute($array2))
                $return_data=1;
               }
               catch(PDOException $e){
                   echo "Error occured: ";
                    print_r($statement->errorInfo());
                //    echo "<br>";

               }
            }
       
        return $return_data;
    }

    public function select($table_name,$key=[],$value=[]){
        $sql="Select * from $table_name ";
       
        if(count($key)==count($value)&&count($key)!=0){
            $sql.="where ";
            $i=0;
            while($i<count($key)-1){
                $sql.=" $key[$i]"."='".$value[$i]."' and ";
                $i++;
            }
            $sql.=$key[$i]."='".$value[$i]."' order by id asc;";
            // echo $sql;
        }
        try{
            $statement=$this->connection()->query($sql);
            $return=$statement->fetchAll();            
            // echo json_encode($return);
        }
        catch(PDOException $e){
            // //echo $sql;
            echo "Error occured Selection :";
            $return=["error_occured"];
        }
        return $return;
    }
   public function deletion($table_name,$key,$value){
        $sql="Delete from $table_name ";
       $return_data=0;
        if(count($key)==count($value)&&count($key)!=0){
            $sql.="where ";
            $i=0;
            echo $value[$i];
            while($i<count($key)-1){
                $sql.=" $key[$i]"."='".$value[$i]."' and ";
                $i++;
            }
            $sql.="$key[$i]='$value[$i]'";
        }
        // echo $sql;
        $statement=$this->prepare_stmt($sql);
        try{
            $statement->execute();            
            $return_data=1;
        }
        catch(PDOException $e){
            echo "Error occured Deletion".$e;
            
        }
        return $return_data;
    }
    public function updation($table_name,$key,$value,$init_key,$init_value){
        $sql="Update `$table_name` ";
        $return_data=0;
        if(count($key)==count($value)&&count($key)!=0){
            $sql.="set ";$i=0;
            while($i<count($key)-1){
                $sql.=$key[$i]."='".$value[$i]."' , ";$i++;
            }
            $sql.=$key[$i]."='".$value[$i]."' where ";
            $i=0;
            while($i<count($init_key)-1){
                $sql.=$init_key[$i]."='".$init_value[$i]."' and ";$i++;
            }
            $sql.=$init_key[$i]."='".$init_value[$i]."';";
            // echo $sql;
            try{
                $statement=$this->prepare_stmt($sql);
                $statement->execute();
                // echo $sql;            
                $return_data=1;
            }
            catch(PDOException $e){
                echo "Error occured Updation :".$e;                
            }
            return $return_data;
        }
    }

    public function total_rows($table_name,$param="*",$condition=""){
        $sql="Select $param from $table_name $condition";
        // echo $sql;
        $statement=$this->connection()->query($sql);
        $result=$statement->fetchAll();
        if($param=="count(*)") {
            return $result[0]['count(*)'];
        }
        else return $result;
    }

  
    public function generic_func($sql){
        $statement=$this->prepare_stmt($sql);
        try{$statement->execute();return 1;}
        catch(PDOException $e){
            return 0;
        }
    }
    
    public function own_query($sql){
        $statement=$this->prepare_stmt($sql);
        try{
            $statement->execute();
            $result=$statement->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            return [];
        }
    }

}
        // Testing each function
                    // $ram=new DBConnect();
                    // echo $ram->create_tbl("sangam thapa");
                    // $update=$ram->updation('users',['id'],['23'],['id'],['2']);
                    // echo "<br>".$update;
                    // $delete=$ram->deletion('users',['id'],['truncate table rooms']);
                    // echo $delete;
                    // $array1=['id','name','conn_id','available'];
                    // $array2=['2','sangam','3345','1'];
                    // $ins=$ram->insertion('users',$array1,$array2);
                    // echo $ins;
                    // $select=$ram->select('users',[],[]);
                    // if($select!=false){
                    //     print_r($select);
                    // }
                    // else{
                    //     echo "Np record found";
                    // }



                    
function space_removal($doctor_name){
    $array=explode(" ",$doctor_name);
        $d_name="";
        foreach($array as $row){
            $d_name.="$row"."_";
        }
        return $d_name;
}

function remove_underscore($doctor_name){
    $array=explode("_",$doctor_name);
    $d_name="";
    foreach($array as $row){
        $d_name.="$row"." ";
    }
    return $d_name;
}

function fileUpload($target_dir,$file){
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($file["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    // $uploadOk = 0;
    // }

    // Check file size
    if ($file["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else {
        $filename=time();
       $target_file=$target_dir.$filename.".".$imageFileType;
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $uploadOk=$filename.".".$imageFileType;
            // echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $uploadOk;
}

function generate_id($id){
        $loop=strlen($id);
        $str="AIOH00000";
        $count_str=strlen($str);
        $j=0;
        while($j!=strlen($id)){
            $str[$count_str-$loop]=$id[$j];
            $j++;
            $loop--;
        }
        return $str;
}

function alerts($color,$heading,$body=""){
echo '<link rel="stylesheet" href="../css/alert.css">';
echo '
<div class="alert '.$color.'">
  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
  <h2>'.$heading.'</h2> '.$body.'
</div>
';
}
function food_card($food_name,$food_photo,$cost){
    echo '
    <div class="card" style="width: 18rem;">
      <img src="'.$food_photo.'" class="card-img-top" alt="'.$food_name.'">
        <div class="card-body">
            <h5 class="card-title"> '.$food_name.'</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-'.$cost.'/plate</span>
            <span><span id="add"><i class="fa fa-plus" onclick="numbers(\'add\',this)"></i></span><span id="qty">0</span><span id="minus"><i class="fa fa-minus" onclick="numbers(\'minus\',this)"></i></span></span>
            <button onclick="cart(\''.$food_name.'\',\''.$food_photo.'\',\''.$cost.'\',this)" class="btn btn-outline-success">Add to Cart</button>
        </div>
    </div>
  '; 
  }

?>
