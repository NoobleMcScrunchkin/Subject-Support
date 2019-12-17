<?php
require ("../php/passEmail.php");
changeForgotPass($_POST['code'], $_POST['newPass'], $_POST['newPassConf']);
header("Location: /");
?>
