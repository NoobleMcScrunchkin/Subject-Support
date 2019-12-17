<?php
$db = mysqli_connect("localhost", "root", "", "subject_support");

function fetch_students() {
    global $db;

    $fetchusers = $db->prepare("SELECT * FROM students");
    $fetchusers->execute();

    $res = array();

    $fetchusers->bind_result($id, $fname, $sname, $subject, $teacherId, $year, $house, $completed);

    while($fetchusers->fetch()) {
        array_push($res, array(
            "id" => $id,
            "fname" => $fname,
            "sname" => $sname,
            "subject" => $subject, // didn't put in teacher as a teacher may have multiple subjects
            "teacher" => $teacherId, // links to teacher db which then has details bout teacher
            "year" => $year,
            "house" => $house,
            "completed" => $completed
        ));
    }

    return $res;
}
?>