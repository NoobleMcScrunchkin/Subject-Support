<?php
require("empty.php");

function editStudent($id, $fname, $sname, $subject, $year, $house) {
    global $db;

    if (!isEmptyOrSpaces($fname) && !isEmptyOrSpaces($sname)) {
        if ($id == "NaN") {
            $addStudent = $db->prepare("INSERT INTO students(`First Name`, `Last Name`, `Subject`, `Year`, `House`) VALUES (?, ?, ?, ?, ?)");
            $addStudent->bind_param("sssis", $fname, $sname, $subject, $year, $house);
            $addStudent->execute();
            $addStudent->close();
        } else {
            $updateStudent = $db->prepare("UPDATE `students` SET `First Name`=?, `Last Name`=?, `Subject`=?, `Year`=?, `House`=?  WHERE `ID`=?");;
            $updateStudent->bind_param("sssisi", $fname, $sname, $subject, $year, $house, $id);
            $updateStudent->execute();
            $updateStudent->close();
        }
    } else {
        return false;
    }

    return true;
}
?>
