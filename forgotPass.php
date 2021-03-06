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
             </script>
         </head>
         <body>
             <hgroup>
                 <h1><br></h1>
             </hgroup>
             <form action="./passEmail.php" method="post">
                 <div class="group">
                     <input type="text" name="username"><span class="highlight"></span><span class="bar"></span>
                     <label class="text">Username</label>
                 </div>
                 <button type="submit" class="button buttonBlue">Send Email
                     <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                 </button>
             </form>
             <footer>
                 <img src="./res/logo.png">
             </footer>
     </body>
</html>
