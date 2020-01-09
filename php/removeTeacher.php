<?php
function removeTeacher($id) {
    global $db;

    $delTeach = $db->prepare("DELETE FROM accounts WHERE ID=?");
    $delTeach->bind_param("i", $id);
    $delTeach->execute();
    $delTeach->close();

    $delForgot = $db->prepare("DELETE FROM forgotPass WHERE AccountID=?");
    $delForgot->bind_param("i", $id);
    $delForgot->execute();
    $delForgot->close();
    return true;
}
?>
