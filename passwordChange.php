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

                 $(document).ready(function() {
                  $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                      event.preventDefault();
                      checkPass();
                      return false;
                    }
                  });
                });

                 function checkPass() {
                     var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
                     if (document.getElementById("password").value.match(passw) && document.getElementById("password").value == document.getElementById("passConf").value) {
                         document.getElementById("passForm").submit();
                     } else {
                         alert("Password does not match or meet the requirements");
                     }
                }
             </script>
         </head>
         <body>
             <hgroup>
                 <h1><br></h1>
             </hgroup>
             <form id="passForm" action="./requests/passChange.php" method="post">
                 <div class="group">
                     <input id="currentPass" onclick="if (<?=(isset($_GET['incorrect']) && $_GET['incorrect'] == 1)?> ) { document.getElementById('currentLabel').removeAttribute('style'); }" type="password" name="currentPass"><span class="highlight"></span><span class="bar"></span>
                     <label id="currentLabel" <?php if (isset($_GET['incorrect']) && $_GET['incorrect'] == 1) { echo 'style="color: red"';} ?> >Current Password</label>
                 </div>
                 <div class="group">
                     <input id="password" type="password" name="newPass"><span class="highlight"></span><span class="bar"></span>
                     <label>New Password</label>
                 </div>
                 <div class="group">
                     <input id="passConf" type="password" name="newPassConf"><span class="highlight"></span><span class="bar"></span>
                     <label>Confirm Password</label>
                 </div>
                 <button type="button" onclick="checkPass();" class="button buttonBlue">Change Password
                     <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                 </button>
             </form>
             <footer>
                 <img src="./res/logo.png">
             </footer>
     </body>
</html>
