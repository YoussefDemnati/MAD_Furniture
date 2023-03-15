
<html>
    <body>
        <!-- message -->
        <div class="msg animate slide-in-down"></div>
        <!-- end message -->
        <div class="giga_logo">
            <img src="../assets/img/logo.png" alt="MAD Furniture">
        </div>

        <div class="signup-container">
            <h1>Benvenuto!</h1>
            <form action="" method="post">
                <div class="input_field">
                    <label for="firstname">Firs name</label>
                    <input type="text" name="name" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="">Last name</label>
                    <input type="text" name="secondname" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="email">Email</label>
                    <input type="email" name="email" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="address">Address</label>
                    <input type="text" name="address" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="password">Password</label>
                    <input type="password" name="password" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="conf_password">Confirm password</label>
                    <input type="conf_password" name="conf_password" required maxlength="255">
                </div>
                <button class="btn_signup" type="submit">Signup</button>
                
                <span>Already Have an Account? <a href="#">Login</a></span>
            </form>

        </div>
    </body>
</html>

<script>
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous">
</script>
<script>
    (function(){

    // data
    var clear;
    var msgDuration = 2000; // 2 seconds
    var $msgSuccess = 'Operazione avvenuta con successo!';
    var $msgDanger  = 'Careful with that!';

    // cache DOM
    var $msg        = $('.msg');
    var $signup = $('.btn_signup')

    // render message
    function render(message){

        hide();

        switch (message) {
            case 'success':
                $msg.addClass('msg-success active').text($msgSuccess);
                break;
            case 'danger':
                $msg.addClass('msg-danger active').text($msgDanger);
                break;
        }
    }

    function timer(){
        clearTimeout(clear);
        clear = setTimeout(function(){
            hide();
        }, msgDuration)
    }

    function hide(){
        $msg.removeClass('msg-success msg-danger active');
    }

    // bind events
    $signup .on('click', function(){render('danger');});

    $msg       .on('transitionend', timer);

    })();

</script>

<?php
include './_footer.php';
?>