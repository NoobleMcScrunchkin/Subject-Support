<?php
require ("../php/removeTeacher.php");
removeTeacher($_POST['ID']);
header("Location: /teachers");
?>
