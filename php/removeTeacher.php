<?php
function removeTeacher($id) {
    global $db;

    $delForgot = $db->prepare("DELETE FROM accounts WHERE ID=?");
    $delForgot->bind_param("i", $id);
    $delForgot->execute();
    $delForgot->close();
    return true;
}
?>
