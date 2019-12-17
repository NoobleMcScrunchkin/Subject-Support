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
    </head>
    <body>
         <div class="layout mdl-layout mdl-js-layout">
             <header class="mdl-layout__header mdl-layout__header--transparent">
                 <div class="mdl-layout__header-row">
                     <span class="mdl-layout-title">Elizabeth College Subject Support</span>
                     <div class="mdl-layout-spacer"></div>
                     <nav class="mdl-navigation">
                         <a class="mdl-navigation__link" href="/passwordChange.php">Change Password</a>
                         <a class="mdl-navigation__link" href="/requests/logout.php">Logout</a>
                     </nav>
                 </div>
             </header>
             <main class="mdl-layout__content">
                 <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                     <thead>
                         <tr>
                             <th class="mdl-data-table__cell--non-numeric">Name</th>
                             <th class="mdl-data-table__cell--non-numeric">Subject</th>
                             <th class="mdl-data-table__cell--non-numeric">Teacher</th>
                             <th class="mdl-data-table__cell--non-numeric">Tutor Group</th>
                             <th class="mdl-data-table__cell--non-numeric">Completion</th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php
                        $users = fetch_students();

                        foreach($users as $user) {
                            ?>
                            <tr>
                            <td class="mdl-data-table__cell--non-numeric"><?=$users["fname"] . ", " . $users["sname"];?></td>
                            <td class="mdl-data-table__cell--non-numeric"><?=$users["subject"];?></td>
                            <td class="mdl-data-table__cell--non-numeric">Teacher Placeholder</td>
                            <td class="mdl-data-table__cell--non-numeric"><?=$users["year"] . " " . $users["house"];?></td>
                            <td class="mdl-data-table__cell--non=numeric">
                                 <span class="roboto">Not Completed (Placeholder)</span>
                                 <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                     Mark P1 as Done
                                 </button>
                                 <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                     Mark P2 as Done
                                 </button>
                                 <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                     Mark all as Done
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
