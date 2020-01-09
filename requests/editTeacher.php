<?php
require ("../php/login.php");
require ("../php/editTeacher.php");
validate_login();
editTeacher($_POST["ID"], $_POST["fname"], $_POST["sname"], $_POST["username"], $_POST["email"], $_POST["priv"]);
header("Location: ../teachers");
?>
