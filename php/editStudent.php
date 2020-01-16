<?php
require("empty.php");

function editStudent($id, $fname, $sname, $subject, $year, $house, $colNum) {
    global $db;

    if (!isEmptyOrSpaces($fname) && !isEmptyOrSpaces($sname)) {
        if ($id == "NaN") {
            $addStudent = $db->prepare("INSERT INTO students(`First Name`, `Last Name`, `Subject`, `Year`, `House`, `colNum`) VALUES (?, ?, ?, ?, ?, ?)");
            $addStudent->bind_param("sssisi", $fname, $sname, $subject, $year, $house, $colNum);
            $addStudent->execute();
            $addStudent->close();
        } else {
            $updateStudent = $db->prepare("UPDATE `students` SET `First Name`=?, `Last Name`=?, `Subject`=?, `Year`=?, `House`=?, `colNum`=? WHERE `ID`=?");;
            $updateStudent->bind_param("sssisii", $fname, $sname, $subject, $year, $house, $colNum, $id);
            $updateStudent->execute();
            $updateStudent->close();
        }
    } else {
        return false;
    }

    return true;
}
?>
