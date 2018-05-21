<?php
include_once '../Config/config.php'

if(isset($_GET['method'])){
    if($_GET['method']=="insertUser"){
        insertUser();
    }
    }
    else{
        echo "Wrong metod name!";
        die();
    }
}else{
    echo "Wrong metod name!";
    die();
}



?>