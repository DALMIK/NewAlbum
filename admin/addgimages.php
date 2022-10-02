<?php
require_once("../includes/config.php");
require_once("../includes/classes/FormSanitizer.php");
require_once("../includes/classes/Constants.php");
require_once("../includes/classes/Account.php");

$account = new Account($con);

if(isset($_SESSION['admin'])){
    include "header.php";
    if(isset($_POST['submit'])){
        
        foreach($_FILES['images']['name'] as $key=>$value){
            $a_id = $_GET['id'];
            $image_name = time() . basename($value);
            $target_dir = __DIR__ . "/gallery_images/" . $image_name;
            move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_dir);
            $success= $account->addGallery($a_id,$image_name);
        }
        
if($success){
?>
<script>
alert("Gallery Added Succefully");
</script>
<?php
}else{
    echo "something Went Wrong Try again!!!";
    header("Location: addGallery.php");
}
}
?>
<div id="card_page">
    <div class="col-lg-6">
        <h1>Add Gallery</h1>
        <hr>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group my-3">
                <input type="file" name="images[]" id="" multiple />
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit Button</button>
        </form>
    </div>
</div>
<?php
}else{
header("Location: admin.php");

}


?>