<?php
$db = mysqli_connect("localhost", "root", "", "subject_support");

function fetch_students() {
    global $db;

    $fetchusers = $db->prepare("SELECT * FROM students");
    $fetchusers->execute();

    $res = array();

    $fetchusers->bind_result($id, $fname, $sname, $subject, $teacherId, $year, $house);

    while($fetchusers->fetch()) {
        array_push($res, array(
            "id" => $id,
            "fname" => $fname,
            "sname" => $sname,
            "subject" => $subject,
            "teacher" => $teacherId,
            "year" => $year,
            "house" => $house,
        ));
    }

    return $res;
}
?>