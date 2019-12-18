<?php
$db = mysqli_connect("localhost", "root", "", "subject_support");

function fetch_students() {
    global $db;

    $fetchusers = $db->prepare("SELECT ID, `First Name`, `Surname`, `Subject`, `Year`, `House` FROM students");
    $fetchusers->execute();

    $res = array();

    $fetchusers->bind_result($id, $fname, $sname, $subject, $year, $house);

    while($fetchusers->fetch()) {
        array_push($res, array(
            "id" => $id,
            "fname" => $fname,
            "sname" => $sname,
            "subject" => $subject,
            "year" => $year,
            "house" => $house,
        ));
    }

    $fetchusers->close();

    return $res;
}

function find_account_name($id) {
    global $db;

    $finduser = $db->prepare("SELECT `First Name`, `Last Name` FROM accounts WHERE ID=?");
    $finduser->bind_param("i", $id);

    $finduser->execute();
    $finduser->bind_result($fname, $sname);

    if($finduser->fetch()) {
        $finduser->close();
        return $sname . ", " . $fname;
    }
    else {
        $finduser->close();
        return false;
    }
}
?>
