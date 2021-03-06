<?php
require ("php/login.php");
validate_login();

$user = fetch_account($_SESSION["accountID"]);

if (!$user['priv']) {
    header("HTTP/1.0 403 Forbidden");
    die();
}

if ($_POST["ID"] != "NaN") {
    $finduser = $db->prepare("SELECT `First Name`, `Last Name`, `Subject`, `Year`, `House`, `colNum` FROM students WHERE ID=?");
    $finduser->bind_param("i", $_POST["ID"]);
    $finduser->bind_result($fname, $sname, $subject, $year, $house, $colNum);
    $finduser->execute();
    $finduser->fetch();
    $finduser->close();
}
?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Subject Support</title>
        <link rel="stylesheet" href="login.css"></link>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(window, document, undefined).ready(function() {

                $('input').blur(function() {
                    var $this = $(this);
                    if ($this.val())
                    $this.addClass('used');
                    else
                    $this.removeClass('used');
                });

                var $ripples = $('.ripples');

                $ripples.on('click.Ripples', function(e) {

                    var $this = $(this);
                    var $offset = $this.parent().offset();
                    var $circle = $this.find('.ripplesCircle');

                    var x = e.pageX - $offset.left;
                    var y = e.pageY - $offset.top;

                        $circle.css({
                            top: y + 'px',
                            left: x + 'px'
                        });

                        $this.addClass('is-active');

                    });

                    $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
  	                     $(this).removeClass('is-active');
                     });

                 });

                 window.onload = function() {
                     $('input').each(function() {
                         var $this = $(this);
                         if ($this.val())
                         $this.addClass('used');
                         else
                         $this.removeClass('used');
                    });
                }
             </script>
         </head>
         <body>
             <hgroup>
                 <h1><br></h1>
             </hgroup>
             <form action="./requests/editStudent.php" method="post">
                 <input type="hidden" name="ID" value="<?=$_POST['ID']?>">
                 <div class="group">
                     <input type="text" name="fname" value="<?php if ($_POST['ID'] != "NaN") { echo $fname; } ?>"><span class="highlight"></span><span class="bar"></span>
                     <label class="text">First Name</label>
                 </div>
                 <div class="group">
                     <input type="text" name="sname" value="<?php if ($_POST['ID'] != "NaN") { echo $sname; } ?>"><span class="highlight"></span><span class="bar"></span>
                     <label class="text">Last Name</label>
                 </div>
                 <div class="group">
                     <input type="number" name="colNum" value="<?php if ($_POST['ID'] != "NaN") { echo $colNum; } ?>"><span class="highlight"></span><span class="bar"></span>
                     <label class="text">College Number</label>
                 </div>
                 <div class="group">
                     <input type="text" name="subject" value="<?php if ($_POST['ID'] != "NaN") { echo $subject; } ?>"><span class="highlight"></span><span class="bar"></span>
                     <label class="text">Subject</label>
                 </div>
                 <div class="group">
                     <input type="number" name="year" value="<?php if ($_POST['ID'] != "NaN") { echo $year; } ?>"><span class="highlight"></span><span class="bar"></span>
                     <label class="text">Year</label>
                 </div>
                 <div class="group">
                     <input type="text" name="house" value="<?php if ($_POST['ID'] != "NaN") { echo $house; } ?>"><span class="highlight"></span><span class="bar"></span>
                     <label class="text">House</label>
                 </div>
                 <button type="submit" class="button buttonBlue">Submit
                     <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                 </button>
             </form>
             <footer>
                 <img src="./res/logo.png">
             </footer>
     </body>
</html>
