<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

$post = $account->premiumPage();

include("includes/header.php");


?>
<a href="login.php" style="display: inline-block; margin:20px 0 20px 20px" class="btn btn-primary">Go Back</a>
<a href="logout.php" style="display: inline-block; margin:20px 0 20px 20px" class="btn btn-primary">Log out</a>

<div class="row">
    <?php foreach($post as $ps){ ?>
    <div class="col-sm-6 col-md-4 col-lg-3 gy-3 my-3">

        <div class="card">
            <div class="card-body">
                <div style="width:100%;height:200px;overflow:hidden;">
                    <img src="admin/uploads/<?=$ps['image']?>" class="img-thumbnail" alt="...">
                </div>

                <p class="card-text">Description : <?=$ps['album_discription']?></p>
                <a href="Premium_gallery.php?id=<?=$ps['id']?>" class="btn btn-primary">Open Album</a>
            </div>
        </div>

    </div>
    <?php
}
?>
</div>