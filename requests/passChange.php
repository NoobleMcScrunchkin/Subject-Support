<?php
require("../php/login.php");
require("../php/passChange.php");
validate_login();
if (!changePassword($_POST['currentPass'], $_POST['newPass'], $_POST['newPassConf'])) {
    header("Location: ../passwordChange.php?incorrect=1");
} else {
    header("Location: ../");
}
?>
