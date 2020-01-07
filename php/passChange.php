<?php
function changePassword($current, $new, $conf) {
    if ($new == $conf) {
        global $db;

        $finduser = $db->prepare("SELECT Password FROM accounts WHERE ID=?");
        $finduser->bind_param("s", $_SESSION['accountID']);

        $finduser->execute();

        $finduser->bind_result($passHash);

        if(!$finduser->fetch()) {
            $finduser->close();
            return false;
        }

        if (password_verify($current, $passHash)) {
            $finduser->close();
            $hash = password_hash($new, PASSWORD_BCRYPT);
            $updatePass = $db->prepare("UPDATE `accounts` SET `Password`=? WHERE `accounts`.`ID`=?");
            $updatePass->bind_param("ss", $hash, $_SESSION['accountID']);
            $updatePass->execute();
            $updatePass->close();
            return true;
        } else {
            $finduser->close();
            return false;
        }
        return false;
    } else {
        return false;
    }
}
 ?>
