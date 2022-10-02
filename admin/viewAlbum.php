<?php 
require_once("../includes/config.php");
require_once("../includes/classes/FormSanitizer.php");
require_once("../includes/classes/Constants.php");
require_once("../includes/classes/Account.php");

include "header.php"; 
$account = new Account($con);

if(isset($_GET['idp'])){
    $id = $_GET['idp'];
    $success = $account->publish($id);
    if($success){
?>

<script>
alert("Album Published Succefully");
</script>

<?php
}
}

if(isset($_GET['idup'])){
    $id = $_GET['idup'];
    $success = $account->unpublish($id);
    if($success){
?>

<script>
alert("Album UnPublished Succeffully");
</script>

<?php
}
}
if(isset($_GET['idPp'])){
    $id = $_GET['idPp'];
    $success = $account->premium($id);
    if($success){
?>

<script>
alert("Now only Premium can see this album");
</script>

<?php
}
}
?>

<div class="gallery d-flex flex-wrap justify-content-center justify gap-2 mb-4">
    <?php
        $post = $account->showAlbum();
        foreach($post as $ps){
    ?>


    <div class="card mb-3" style="max-width: 640px; height:auto">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="uploads/<?php echo $ps['image'];?>" class="card-img-top" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title"><strong><?=$ps['album_name']?></strong></h4>
                    <h6 class="card-text"><?=$ps['album_discription']?></h6>
                    <a href="?idp=<?=$ps['id']?>" class="btn btn-success">publish</a>
                    <a href="?idup=<?=$ps['id']?>" class="btn btn-danger">unpublish</a>
                    <a href="?idPp=<?=$ps['id']?>" class="btn btn-warning">Premium</a>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
    ?>



</div>