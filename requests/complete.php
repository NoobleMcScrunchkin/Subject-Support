<?php
require("../php/login.php");
validate_login();

if($_SERVER["REQUEST_METHOD"] != "POST") {
    header('HTTP/1.0 403 Forbidden');
    die();
}

$studentIdStr = $_POST["studentId"];
$periodStr = $_POST["period"];
$todoStr = $_POST["todo"];

if(!isset($studentIdStr) || !isset($periodStr) || !isset($todoStr)) {
    header('HTTP/1.0 400 Bad Request');
    die();
}

if(!is_numeric($studentIdStr) || !is_numeric($periodStr)) {
    header('HTTP/1.0 400 Bad Request');
    die();
}

$studentId = intval($studentIdStr);
$period = intval($periodStr);
$todo = $todoStr == "true" ? true : false;

$day = date('w') - 1;
$week_start = date('Y-m-d', strtotime('-'.$day.' days'));

if($todo) {
    $setComplete = $db->prepare("DELETE FROM completed WHERE `Week`=? AND `StudentID`=? AND `Period`=?");
    $setComplete->bind_param("sii", $week_start, $studentId, $period);

    $setComplete->execute();
    $setComplete->close();
}
else {
    $setComplete = $db->prepare("INSERT INTO completed(`StudentID`, `Week`, `Period`) VALUES (?, ?, ?)");
    $setComplete->bind_param("isi", $studentId, $week_start, $period);

    $setComplete->execute();

    $setComplete->close();
}

echo("{'success': true}");

?>
