<?php
function removeStudent($id) {
    global $db;

    $delForgot = $db->prepare("DELETE FROM students WHERE ID=?");
    $delForgot->bind_param("i", $id);
    $delForgot->execute();
    $delForgot->close();
    return true;
}
?>
