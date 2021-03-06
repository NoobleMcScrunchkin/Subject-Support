<?php
$db = mysqli_connect("localhost", "root", "", "subject_support");

function fetch_students() {
    global $db;

    $fetchusers = $db->prepare("SELECT `ID`, `First Name`, `Last Name`, `Subject`, `Year`, `House`, `colNum` FROM students ORDER BY `Last Name` ASC, `First Name` ASC");
    $fetchusers->execute();

    $res = array();

    $fetchusers->bind_result($id, $fname, $sname, $subject, $year, $house, $colNum);

    while($fetchusers->fetch()) {
        array_push($res, array(
            "id" => $id,
            "fname" => $fname,
            "sname" => $sname,
            "subject" => $subject,
            "year" => $year,
            "house" => $house,
            "colNum" => $colNum,
        ));
    }

    $fetchusers->close();

    return $res;
}
function fetch_accounts() {
    global $db;

    $fetchusers = $db->prepare("SELECT ID, `First Name`, `Last Name`, `Username`, `Email`, `Privileged` FROM accounts  ORDER BY `Last Name` ASC, `First Name` ASC");
    $fetchusers->execute();

    $res = array();

    $fetchusers->bind_result($id, $fname, $sname, $username, $email, $priv);

    while($fetchusers->fetch()) {
        array_push($res, array(
            "id" => $id,
            "fname" => $fname,
            "sname" => $sname,
            "username" => $username,
            "email" => $email,
            "priv" => $priv
        ));
    }

    $fetchusers->close();

    return $res;
}

function fetch_account($id) {
    global $db;

    $fetchusers = $db->prepare("SELECT `First Name`, `Last Name`, `Username`, `Email`, `Privileged` FROM accounts WHERE ID=?");
    $fetchusers->bind_param("i", $id);
    $fetchusers->execute();

    $res = array();

    $fetchusers->bind_result($fname, $sname, $username, $email, $priv);

    if($fetchusers->fetch()) {
        $fetchusers->close();
        return array(
            "id" => $id,
            "fname" => $fname,
            "sname" => $sname,
            "username" => $username,
            "email" => $email,
            "priv" => $priv
        );
    }

    $fetchusers->close();

    return false;
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

function fetch_completed($studentID, $date) {
    global $db;

    $fetchCompleted = $db->prepare("SELECT `Period` FROM completed WHERE `StudentID`=? AND `Week`=?");
    $fetchCompleted->bind_param("is", $studentID, $date);

    $fetchCompleted->execute();

    $fetchCompleted->bind_result($period);

    $completed = array(false, false, false);

    while($fetchCompleted->fetch()) {
        $completed[$period] = true;
    }

    $fetchCompleted->close();

    return $completed;
}
?>
