<?php
require ("../php/login.php");
require ("../php/editStudent.php");
validate_login();
editStudent($_POST["ID"], $_POST["fname"], $_POST["sname"], $_POST["subject"], $_POST["year"], $_POST["house"]);
header("Location: ../students");
?>
