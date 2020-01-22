<?php
require ("../php/login.php");
require ("../php/editTeacher.php");
validate_login();
if (!fetch_account($_SESSION['accountID'])["priv"]) {
    header('HTTP/1.0 403 Forbidden');
}
if (editTeacher(strip_tags($_POST["ID"]), strip_tags($_POST["fname"]), strip_tags($_POST["sname"]), strip_tags($_POST["username"]), strip_tags($_POST["email"]), strip_tags($_POST["priv"]))) {
    header("Location: ../teachers");
} else {
    header("Location: ../teachers?invalid=1");
}
?>
