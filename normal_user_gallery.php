<?php 
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

include("includes/header.php"); 
$account = new Account($con);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $gallery_details = $account->gallery($id);
    if(count($gallery_details)==0){
        ?>
<script>
alert("No Gallery Images Exist in this Album");
</script>
<?php
    }
    }else{
    header("Location:premium_page.php");
    }

?>
<a href="login.php" style="display: inline-block; margin:20px 0 20px 20px" class="btn btn-primary">Go Back</a>
<div style="width:90%; margin:0 auto">

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">

            <?php
             $var='active'; 
             foreach($gallery_details as $gd) { 
                if($var=='active') {     ?>

            <div class="carousel-item active">
                <img src=" admin/gallery_images/<?=$gd['g_image']?>" class="d-block w-100" alt="...">
            </div>

            <?php 
            $var=''; 
            }else{
            ?>
            <div class="carousel-item">
                <img src=" admin/gallery_images/<?=$gd['g_image']?>" class="d-block w-100" alt="...">
            </div>
            <?php 
            } 
            ?>
            <?php 
            } 
            ?>

        </div>
        <button style="background-color: rgba(15, 15, 15, 0.144);" class="carousel-control-prev" type="button"
            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button style="background-color: rgba(15, 15, 15, 0.144);" class="carousel-control-next" type="button"
            data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>