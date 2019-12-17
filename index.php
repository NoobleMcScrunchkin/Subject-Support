<?php
require("./php/login.php");
validate_login();
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Subject Support</title>
        <link href="./index.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="./matDesign/material.min.css">
        <script src="./matDesign/material.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <?php
        $day = date('w') - 1;
        $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
        // mysqli_query($db, "INSERT INTO `register` (`Week`, `StudentID`, `Completed`) VALUES ('".$week_start."', '0', '1')");
         ?>
         <div class="Content">
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
                     <tr>
                         <td class="mdl-data-table__cell--non-numeric">Aslett, Kieran</td>
                         <td class="mdl-data-table__cell--non-numeric">Computer Science</td>
                         <td class="mdl-data-table__cell--non-numeric">Costen, Dave</td>
                         <td class="mdl-data-table__cell--non-numeric">13 North</td>
                         <td class="mdl-data-table__cell--non-numeric">
                             <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                 Mark as Done
                             </button>
                         </td>
                     </tr>
                 </tbody>
             </table>
         </div>
    </body>
</html>
