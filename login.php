<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {
    
    $email = FormSanitizer::sanitizeFormUsername($_POST["email"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $success = $account->login($email, $password);

    if ($success) {
        $_SESSION["userLoggedIn"] = $email;
        header("Location: index.php");
    }

   
}

function getInputValue($name)
{
if (isset($_POST[$name])) {
echo $_POST[$name];
}
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Album</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="navbar-head" style="padding-top:20px">
        <nav class="Navbar">
            <ul class="navbar-list">
                <li><a href="login.php">Home</a></li>
                <li><a href="admin/login.php">Admin Panel</a></li>
            </ul>
        </nav>
        <h3 style="color:white;font-weight:bolder;font-size:xx-large; border-bottom:3px solid white; margin-left:30rem">
            Normal User
            Page
        </h3>
    </div>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <h3 style="color:white;font-size:xx-large; border-bottom:3px solid white">Log In</h3>
                <span style="color:gold;font-size:large; text-decoration:underline;">To Get Premium Membership</span>
            </div>

            <form method="POST">
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="email" placeholder="Email" value="<?php getInputValue("email"); ?>" required>

                <input type="password" name="password" placeholder="Password" required>

                <input type="submit" name="submitButton" value="SUBMIT">

            </form>


        </div>
        <div class="row" style="width:900px; height:600px; overflow:scroll">

            <?php
            $post = $account->showNaiveAlbum();
            if(empty($post)){
                echo "No album Exits";
            }else{
             foreach($post as $ps){ 
            ?>
            <div class=" col-sm-12 col-md-6 col-lg-4 mx-3 my-3 gy-3 my-3">

                <div class="card">
                    <div class="card-body">
                        <div style="width:100%;height:200px;overflow:hidden;">
                            <img src="admin/uploads/<?=$ps['image']?>" class="img-thumbnail" alt="...">
                        </div>

                        <h3 class="card-text"><?=$ps['album_name']?></h3>
                        <p class="card-text">Description : <?=$ps['album_discription']?></p>
                        <a href="normal_user_gallery.php?id=<?=$ps['id']?>" class="btn btn-primary">Open Album</a>
                    </div>
                </div>

            </div>
            <?php
}
}
?>
        </div>
    </div>

    </div>

</body>

</html>