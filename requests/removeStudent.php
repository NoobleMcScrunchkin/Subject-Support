<?php
require("../php/login.php");
require("../php/removeStudent.php");
validate_login();
if (!fetch_account($_SESSION['accountID'])["priv"]) {
    header('HTTP/1.0 403 Forbidden');
}
removeStudent($_POST['ID']);
header("Location: ../students");
?>
