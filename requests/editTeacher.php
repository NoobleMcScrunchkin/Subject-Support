<?php
require ("../php/login.php");
require ("../php/editTeacher.php");
validate_login();
if (!fetch_account($_SESSION['accountID'])["priv"]) {
    header('HTTP/1.0 403 Forbidden');
}
if (editTeacher($_POST["ID"], $_POST["fname"], $_POST["sname"], $_POST["username"], $_POST["email"], $_POST["priv"])) {
    header("Location: ../teachers");
} else {
    header("Location: ../teachers?invalid=1");
}
?>
