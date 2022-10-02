<?php
require_once("../includes/config.php");
require_once("../includes/classes/Account.php");

$account = new Account($con);

$album_Details = $account->showAlbum();

if(isset($_SESSION['admin'])){
    include "header.php";
    if(isset($_POST['submit'])){
        $ab=$_POST['gname'];
        // echo $ab;
        header( "Location:gallery.php?id=$ab" );
    }
    // print_r($aName);
    ?>
<div id="card_page">
    <div class="col-lg-6">
        <h1>Add Gallery</h1>
        <hr>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label>Choose album name for your gallery</label><br>
                <select class="form-control" name="gname">
                    <?php foreach($album_Details as $aD){ ?>
                    <option value="<?=$aD['id']?>"><?=$aD['album_name']?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Next</button>
        </form>
    </div>
</div>
<?php
}else{
header("Location: login.php");

}


?>