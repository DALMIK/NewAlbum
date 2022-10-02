<?php
require_once("../includes/config.php");
require_once("../includes/classes/FormSanitizer.php");
require_once("../includes/classes/Constants.php");
require_once("../includes/classes/Account.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {

    $email = FormSanitizer::sanitizeFormUsername($_POST["email"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $success = $account->login($email, $password);

    if ($success) {
        $_SESSION['admin'] = $email;
        header("Location: admin.php");
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
    <link rel="stylesheet" type="text/css" href="../assets/style/style.css" />
</head>

<body>

    <div class="navbar-head">
        <nav class="Navbar">
            <ul class="navbar-list">
                <li><a href="../login.php">Home</a></li>
                <li><a href="../login.php">Go Back</a></li>
            </ul>
        </nav>
    </div>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <h3 style="color:white; font-size:xx-large; border-bottom:3px solid white">Admin Log In</h3>
            </div>

            <form method="POST">
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="email" placeholder="Email" value="<?php getInputValue("email"); ?>" required>

                <input type="password" name="password" placeholder="Password" required>

                <input type="submit" name="submitButton" value="SUBMIT">

            </form>

        </div>

    </div>

</body>

</html>