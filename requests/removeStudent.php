<?php
require("../php/login.php");
validate_login();
require ("../php/removeStudent.php");
removeStudent($_POST['ID']);
header("Location: ../students");
?>
