<?php
function emailPass($username) {
    require ("./mail/class.phpmailer.php");
    global $db;

    $getEmail = $db->prepare("SELECT Email, ID, 'First Name' FROM accounts WHERE Username=?");
    $getEmail->bind_param("s", $username);
    $getEmail->execute();
    $getEmail->bind_result($email, $id, $name);

    if(!$getEmail->fetch()) {
        $getEmail->close();
        return false;
    }

    $getEmail->close();

    $code = rand(100000, 999999);
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "0703projectmail@gmail.com";
    $mail->Password = "P@ssword01";
    $mail->From = '0703projectmail@gmail.com';
    $mail->FromName = 'Password Reset';
    $mail->addAddress($email, $name);
    $mail->IsHTML(true);
    $mail->Subject = 'Password Reset';
    $mail->Body = "Your code is: ".$code;

    if (!$mail->send()) {
        return false;
    } else {
        $delForgot = $db->prepare("DELETE FROM forgotPass WHERE accountID=?");
        $delForgot->bind_param("s", $id);
        $delForgot->execute();
        $delForgot->close();

        $addForgot = $db->prepare("INSERT INTO forgotPass(`AccountID`, `Code`) VALUES (?, ?)");
        $addForgot->bind_param("ss", $id, $code);
        $addForgot->execute();
        $addForgot->close();
        return true;
    }

    return false;
}

function changeForgotPass($code, $newPass, $passConf) {
    global $db;

    $getEmail = $db->prepare("SELECT accountID FROM forgotPass WHERE Code=?");
    $getEmail->bind_param("s", $code);
    $getEmail->execute();
    $getEmail->bind_result($id);

    if(!$getEmail->fetch()) {
        $getEmail->close();
        return false;
    }

    if ($newPass != $passConf) {
        $getEmail->close();
        return false;
    }

    $getEmail->close();

    $hash = password_hash($newPass, PASSWORD_BCRYPT);
    $updatePass = $db->prepare("UPDATE `accounts` SET `Password` = ? WHERE `accounts`.`ID` = ?");
    $updatePass->bind_param("ss", $hash, $id);
    $updatePass->execute();
    $updatePass->close();

    $delForgot = $db->prepare("DELETE FROM forgotPass WHERE accountID=?");
    $delForgot->bind_param("s", $id);
    $delForgot->execute();
    $delForgot->close();

    return true;

}

?>
