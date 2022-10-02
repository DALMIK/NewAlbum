<?php
require_once("../includes/config.php");
require_once("../includes/classes/FormSanitizer.php");
require_once("../includes/classes/Constants.php");
require_once("../includes/classes/Account.php");

$account = new Account($con);

if (isset($_POST["submit"])) {
    
    $album_name = FormSanitizer::sanitizeFormUsername($_POST["album_name"]);
    $album_disc = FormSanitizer::sanitizeFormPassword($_POST["album_discription"]);
    $image = $_FILES['image'];
    $image_name = time() . basename($image['name']);
    $target_dir = __DIR__ . "/uploads/" . $image_name;

    move_uploaded_file($image['tmp_name'], $target_dir);
    $success = $account->addAlbum($album_name, $album_disc, $image_name);

    if ($success) {
        echo  "<h2 style='color:green; font-weight:800px;'>A New Album added</h2>";
    }
}

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>
<?php include "header.php"; ?>

<div id="card_page">
    <div class="col-lg-6">
        <h1>Add Album</h1>
        <hr>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label>Album Name or Title</label>
                <input class="form-control" placeholder="Enter Title" name="album_name">
            </div>
            <div class="form-group my-3">

                <label>Album Description</label>
                <textarea class="form-control" rows="3" placeholder="Enter Description" name="album_discription"
                    maxlength="1000"></textarea>
            </div>

            <div class="form-group my-3">
                <label>Album Image</label>
                <input type="file" name="image" id="upload" />
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit Button</button>
        </form>
    </div>
</div>