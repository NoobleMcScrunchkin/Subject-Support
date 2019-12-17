<?php
require("../php/passChange.php");
if (!changePassword($_POST['currentPass'], $_POST['newPass'], $_POST['newPassConf'])) {
    header("Location: /passwordChange.php");
} else {
    header("Location: /");
}
?>
