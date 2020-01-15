<?php
require("empty.php");

function editTeacher($id, $fname, $sname, $username, $email, $priv) {
    global $db;
    if ($priv == "on") {
        $priv = 1;
    } else {
        $priv = 0;
    }

    $fetchusers = $db->prepare("SELECT `ID` FROM accounts WHERE `Username`=?");
    $fetchusers->bind_param("s", $username);
    $fetchusers->execute();
    $fetchusers->store_result();

    if ($fetchusers->num_rows > 0)
    {
        $fetchusers->close();
        $num = 1;
        $done = false;
        while (!$done) {
            $var = $username.(string)$num;
            $fetchusers = $db->prepare("SELECT `ID` FROM accounts WHERE `Username`=?");
            $fetchusers->bind_param("s", $var);
            $fetchusers->execute();
            $fetchusers->store_result();
            if ($fetchusers->num_rows == 0) {
                $done = true;
            } else {
                $fetchusers->close();
                $num = (int)$num + 1;
            }
        }
        $username = $username.(string)$num;
    }
    $fetchusers->close();


    if (!isEmptyOrSpaces($fname) && !isEmptyOrSpaces($sname) && !isEmptyOrSpaces($username) && !isEmptyOrSpaces($email)) {
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
    } else {
        return false;
    }

    return true;
}
?>
