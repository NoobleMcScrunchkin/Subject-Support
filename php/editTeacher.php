<?php
function editTeacher($id, $fname, $sname, $username, $email, $priv) {
    global $db;
    if ($priv == "on") {
        $priv = 1;
    } else {
        $priv = 0;
    }

    if ($id == "NaN") {
        $addTeacher = $db->prepare("INSERT INTO accounts(`First Name`, `Last Name`, `Username`, `Password`, `Email`, `Privileged`) VALUES (?, ?, ?, ?, ?, ?)");
        $password = password_hash("Password01", PASSWORD_BCRYPT);
        $addTeacher->bind_param("sssssi", $fname, $sname, $username, $password, $email, $priv);
        $addTeacher->execute();
        $addTeacher->close();
    } else {
        $updateTeacher = $db->prepare("UPDATE `accounts` SET `First Name`=?, `Last Name`=?, `Username`=?, `Email`=?, `Privileged`=? WHERE `ID`=?");
        $updateTeacher->bind_param("ssssii", $fname, $sname, $username, $email, $priv, $id);
        $updateTeacher->execute();
        $updateTeacher->close();
    }

    return true;
}
?>
