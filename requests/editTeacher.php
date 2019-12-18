<?php
require ("../php/editTeacher.php");
editTeacher($_POST["ID"], $_POST["fname"], $_POST["sname"], $_POST["username"], $_POST["email"]);
header("Location: /teachers");
?>
