<?php
require("../php/login.php");
validate_login();
require ("../php/removeTeacher.php");
removeTeacher($_POST['ID']);
header("Location: ../teachers");
?>
