<?php
function editTeacher($id, $fname, $sname, $username, $email) {
    global $db;

    if ($id == "NaN") {
        $addStudent = $db->prepare("INSERT INTO accounts(`First Name`, `Last Name`, `Username`, `Password`, `Email`, `Privileged`) VALUES (?, ?, ?, ?, ?, 0)");
        $password = password_hash("Password01", PASSWORD_BCRYPT);
        $addStudent->bind_param("sssss", $fname, $sname, $username, $password, $email);
        $addStudent->execute();
        $addStudent->close();
    } else {
        $updateStudent = $db->prepare("UPDATE `accounts` SET `First Name`=?, `Last Name`=?, `Username`=?, `Email`=? WHERE `ID`=?");
        $updateStudent->bind_param("ssssi", $fname, $sname, $username, $email, $id);
        $updateStudent->execute();
        $updateStudent->close();
    }

    return true;
}
?>
