<?php
require("../php/login.php");
login($_POST['username'], $_POST['password']);
header("Location: ../");
 ?>
