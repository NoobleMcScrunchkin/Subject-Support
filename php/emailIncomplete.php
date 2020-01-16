<?php
require ("../mail/class.phpmailer.php");

function emailIncomplete() {
    global $db;
    $day = date('w') - 1;
    $week_start = date('Y-m-d', strtotime('-'.$day.' days'));

    $students = $db->prepare("SELECT `ID`, `colNum`, `First Name`, `Last Name` FROM students");
    $students->execute();
    $students->bind_result($id, $num, $fname, $sname);

    $studentsArr = array();

    while($students->fetch()) {
        array_push($studentsArr, array(
            "ID" => $id,
            "colNum" => $num,
            "fname" => $fname,
            "sname" => $sname
        ));
    }

    $students->close();

    foreach($studentsArr as $student) {
        $completed = $db->prepare("SELECT `Period` FROM completed WHERE StudentID=? AND Week=?");
        $completed->bind_param("is", $student["ID"], $week_start);
        $completed->execute();
        $completed->bind_result($period);

        $periodArr = array();

        while($completed->fetch()) {
            array_push($periodArr, $period);
        }

        $completed->close();

        if (!isset($periodArr[0]) || !isset($periodArr[1]) || $periodArr[0] + $periodArr[1] != 3) {
            emailStudent($student["colNum"], $student["fname"], $student["sname"]);
        }
    }

    return true;
}

function emailStudent($number, $fname, $sname) {
    $name = $fname." ".$sname;
    $email = $number."@elizabethcollege.gg";
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
    $mail->FromName = 'Subject Support';
    $mail->addAddress($email, $name);
    $mail->IsHTML(true);
    $mail->Subject = 'Incomplete Subject Support';
    $mail->Body = $name.",<br><br>Records indicate you did not complete your subject support. Contact Mr. James as soon as possible.";
    $mail->send();
}
?>
