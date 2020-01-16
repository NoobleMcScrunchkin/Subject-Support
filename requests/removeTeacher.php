<?php
require("../php/login.php");
require("../php/removeTeacher.php");
validate_login();
if (!fetch_account($_SESSION['accountID'])["priv"]) {
    header('HTTP/1.0 403 Forbidden');
}
removeTeacher($_POST['ID']);
header("Location: ../teachers");
?>
