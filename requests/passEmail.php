<?php
require("../php/login.php");
require ("../php/passEmail.php");
validate_login();
if (changeForgotPass($_POST['code'], $_POST['newPass'], $_POST['newPassConf'])) {
    header("Location: ../");
} else {
    header("Location: ../passEmail.php");
}
?>
