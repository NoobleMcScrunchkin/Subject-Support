<?php
require("./db.php");


session_start()

function check_login() {
    return isset($_SESSION["account"]);
}

function logout() {
    session_unset();
}

function login(username, password) {
    global $db;

    $hash = password_hash(password, PASSWORD_BCRYPT);

    $finduser = $db->prepare("SELECT ID FROM accounts WHERE username=? AND password=?");
    $finduser->bind_params("ss", username, password);

    $finduser->execute();

    $finduser->bind_result($id);

    if(!$finduser->fetch())
        return false;
    
    $_SESSION["account"] = $id;

    $finduser->close();

    return true;
}

function validate_login() {
    if(!check_login()) {
        header("Location: /login.php");
        die();
    }
}

?>