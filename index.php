<?php 

require_once("includes/config.php");
// print_r($_SESSION['userLoggedIn']);
if(!isset($_SESSION['userLoggedIn'])){
    echo "nice";
    header("Location: login.php");
}else if(isset($_SESSION['userLoggedIn'])){
    echo "not nice";
    header("Location: premium_page.php");
}


?>