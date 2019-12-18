<?php
require ("../php/removeStudent.php");
removeStudent($_POST['ID']);
header("Location: /students");
?>
