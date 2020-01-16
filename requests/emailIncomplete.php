<?php
require ("../php/login.php");
require ("../php/emailIncomplete.php");
validate_login();
if (!fetch_account($_SESSION['accountID'])["priv"]) {
    header('HTTP/1.0 403 Forbidden');
}
emailIncomplete();
header("Location: ../?email=1");

?>
