<?php
require ("db.php");

function editStudent($id, $fname, $sname, $subject, $year, $house) {
    global $db;

    if ($id == "NaN") {
        $addStudent = $db->prepare("INSERT INTO students(`First Name`, `Surname`, `Subject`, `Year`, `House`) VALUES (?, ?, ?, ?, ?)");
        $addStudent->bind_param("sssis", $fname, $sname, $subject, $year, $house);
        $addStudent->execute();
        $addStudent->close();
    } else {
        $updateStudent = $db->prepare("UPDATE `students` SET `First Name`=?, `Surname`=?, `Subject`=?, `Year`=?, `House`=?  WHERE `ID`=?");;
        $updateStudent->bind_param("sssisi", $fname, $sname, $subject, $year, $house, $id);
        $updateStudent->execute();
        $updateStudent->close();
    }

    return true;
}
?>
