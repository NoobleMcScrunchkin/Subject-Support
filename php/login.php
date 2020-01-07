<?php
require("db.php");

session_start();

function check_login() {
    return isset($_SESSION["accountID"]);
}

function logout() {
    session_unset();
}

function login($username, $password) {
    global $db;

    $finduser = $db->prepare("SELECT ID, Password FROM accounts WHERE Username=?");
    $finduser->bind_param("s", $username);

    $finduser->execute();

    $finduser->bind_result($id, $passHash);

    if(!$finduser->fetch()) {
        $finduser->close();
        return false;
    }

    if (password_verify($password, $passHash)) {
        $finduser->close();
        $_SESSION["accountID"] = $id;
        return true;
    } else {
        $finduser->close();
        return false;
    }
    return false;
}

function validate_login() {
    if(!check_login()) {
        header("Location: ./login");
        die();
    }
}

?>
