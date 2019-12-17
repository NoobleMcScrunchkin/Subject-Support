<?php
$db = mysqli_connect("localhost", "root", "", "subject_support");

function fetch_students() {
    global $db;

    $fetchusers = $db->prepare("SELECT ID, `First Name`, `Surname`, `Subject`, `Teacher`, `Year`, `House` FROM students");
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

    $fetchusers->close();

    return $res;
}

function find_account_name($id) {
    global $db;

    $finduser = $db->prepare("SELECT `First Name`, `Surname` FROM `accounts` WHERE `ID`=?");
    $finduser->bind_param("i", $id);

    $finduser->execute();
    $finduser->bind_result($fname, $sname);

    if($finduser->fetch()) {
        $finduser->close();
        return $fname . ", " . $sname;
    }
    else {
        $finduser->close();
        return false;
    }
}
?>