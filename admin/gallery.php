<?php 
require_once("../includes/config.php");
require_once("../includes/classes/FormSanitizer.php");
require_once("../includes/classes/Constants.php");
require_once("../includes/classes/Account.php");

include "header.php"; 
$account = new Account($con);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $gallery_details = $account->gallery($id);
}else{
    header("Location:viewGallery.php");
}

?>


<table class="table table-striped" style="overflow:scroll;">
    <thead style="border:2px solid grey; background-color:grey;">
        <tr>
            <th scope="col">S.no</th>
            <th scope="col">Album id</th>
            <th scope="col">Image</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($gallery_details as $gs){ ?>
        <tr>
            <th scope="row"><?=$i++?></th>
            <td><?=$gs['a_id']?></td>
            <td><img style="width:15rem; height:10rem;" src="gallery_images/<?=$gs['g_image']?>" alt="">
            </td>
            <td><?=$gs['date']?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>