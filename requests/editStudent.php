<?php
require ("../php/login.php");
require ("../php/editStudent.php");
validate_login();
if (!fetch_account($_SESSION['accountID'])["priv"]) {
    header('HTTP/1.0 403 Forbidden');
}
if (editStudent(strip_tags($_POST["ID"]), strip_tags($_POST["fname"]), strip_tags($_POST["sname"]), strip_tags($_POST["subject"]), strip_tags($_POST["year"]), strip_tags($_POST["house"]), strip_tags($_POST["colNum"]))) {
    header("Location: ../students");
} else {
    header("Location: ../students?invalid=1");
}
?>
