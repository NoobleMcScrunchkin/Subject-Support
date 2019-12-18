<?php
require("./php/login.php");
validate_login();

$day = date('w') - 1;
$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
// mysqli_query($db, "INSERT INTO `register` (`Week`, `StudentID`, `Completed`) VALUES ('".$week_start."', '0', '1')");
 ?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Subject Support</title>
        <link href="./index.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="./matDesign/material.min.css">
        <script src="./matDesign/material.min.js"></script>
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="./js/index.js"></script>
    </head>
    <body>
         <div class="layout mdl-layout mdl-js-layout">
             <header class="mdl-layout__header mdl-layout__header--transparent">
                 <div class="mdl-layout__header-row">
                     <span class="mdl-layout-title">Elizabeth College Subject Support</span>
                     <div class="mdl-layout-spacer"></div>
                     <nav class="mdl-navigation">
                         <a class="mdl-navigation__link" href="/">Home</a>
                         <a class="mdl-navigation__link" href="/students">Add/Remove Student</a>
                         <a class="mdl-navigation__link" href="/teachers">Add/Remove Teacher</a>
                         <a class="mdl-navigation__link" href="/passwordChange">Change Password</a>
                         <a class="mdl-navigation__link" href="/requests/logout">Logout</a>
                     </nav>
                 </div>
             </header>
             <main class="mdl-layout__content">
                 <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                     <thead>
                         <tr>
                             <th class="mdl-data-table__cell--non-numeric">Name</th>
                             <th class="mdl-data-table__cell--non-numeric">Subject</th>
                             <th class="mdl-data-table__cell--non-numeric">Tutor Group</th>
                             <th class="mdl-data-table__cell--non-numeric">Completion</th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php
                        $users = fetch_students();

                        foreach($users as $user) {
                            $completed = fetch_completed($user["id"], $week_start);
                            $completedStr = "";
                            if($completed[1] && !$completed[2]) {
                                $completedStr = "P1 Completed";
                            }
                            elseif(!$completed[1] && $completed[2]) {
                                $completedStr = "P2 Completed";
                            }
                            elseif(!$completed[1] && !$completed[2]) {
                                $completedStr = "No Periods Completed";
                            }
                            else {
                                $completedStr = "All Periods Completed";
                            }
                            ?>
                            <tr>
                            <td class="mdl-data-table__cell--non-numeric"><?=$user["sname"] . ", " . $user["fname"];?></td>
                            <td class="mdl-data-table__cell--non-numeric"><?=$user["subject"];?></td>
                            <td class="mdl-data-table__cell--non-numeric"><?=$user["year"] . " " . $user["house"];?></td>
                            <td class="mdl-data-table__cell--non=numeric">
                                 <span class="roboto" style="float: left;"><?=$completedStr?></span>
                                 <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick='complete_period(<?=$user["id"]?>, 1, <?=$completed[1] ? "true" : "false"?>);'>
                                     Mark P1 as <?=$completed[1] ? "To Do" : "Done";?>
                                 </button>
                                 <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick='complete_period(<?=$user["id"]?>, 2, <?=$completed[2] ? "true" : "false"?>);'>
                                     Mark P2 as <?=$completed[2] ? "To Do" : "Done";?>
                                 </button>
                                 <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick='complete_period(<?=$user["id"]?>, 1, <?=$completed[1] ? "true" : "false"?>, true);complete_period(<?=$user["id"]?>, 2, <?=$completed[2] ? "true" : "false"?>);'>
                                     Mark all as <?=$completed[1] && $completed[2] ? "To Do" : "Done";?>
                                 </button>
                             </td>
                            <?php
                        }
                     ?>
                     </tbody>
                 </table>
             </main>
         </div>
     </body>
</html>
