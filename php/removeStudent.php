<?php
function removeStudent($id) {
    global $db;

    $delStudent = $db->prepare("DELETE FROM students WHERE ID=?");
    $delStudent->bind_param("i", $id);
    $delStudent->execute();
    $delStudent->close();

    $delStudentOther = $db->prepare("DELETE FROM completed WHERE StudentID=?");
    $delStudentOther->bind_param("i", $id);
    $delStudentOther->execute();
    $delStudentOther->close();
    return true;
}
?>
