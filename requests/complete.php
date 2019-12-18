<?
require("../php/login.php");
validate_login();

if($_SERVER["REQUEST_METHOD"] != "POST") {
    header('HTTP/1.0 403 Forbidden');
    die();
}

$studentIdStr = $_POST["studentId"];
$periodStr = $_POST["period"];

if(!isset($studentIdStr) || !isset($periodStr)) {
    header('HTTP/1.0 400 Bad Request');
    die();
}

if(!is_numeric($studentIdStr) || !is_numeric($periodStr)) {
    header('HTTP/1.0 400 Bad Request');
    die();
}

$studentId = intval($studentIdStr);
$period = intval($periodStr)

$day = date('w') - 1;
$week_start = date('Y-m-d', strtotime('-'.$day.' days'));

$setComplete = $db->prepare("INSERT INTO completed(`StudentID`, `Week`, `Period` VALUES (?, ?, ?)");
$setComplete->bind_param("isi", $studentId, $week_start, $period);

$setComplete->execute();

echo("{'success': true}");

?>