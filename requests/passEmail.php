<?php
require("../php/login.php");
require ("../php/passEmail.php");
validate_login();
changeForgotPass($_POST['code'], $_POST['newPass'], $_POST['newPassConf']);
header("Location: ../");
?>
