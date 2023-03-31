<?php
require '../include/_db_dal.inc.php';

session_start();
$conn = db_connect();

if(isset($_POST["email"])){
    $response = login_user($_POST["email"], $_POST["password"]);
}
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <!-- message -->
        <div class="msg animate slide-in-down"></div>
        <!-- end message -->
        <div class="giga_logo">
            <img src="../assets/img/logo.png" alt="MAD Furniture">
        </div>

        <div class="signup-container">
            <h1>Welcome Back!</h1>
            <form action="" method="POST">
            <div class="error"><?php echo @$response; ?></div>
                <div class="input_field">
                    <label for="email">Email</label>
                    <input type="email" id="tb_email" name="email" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="tb_password" required maxlength="255">
                    
                </div>
                <div class="input_field align-left">
                    <input type="checkbox" id="show-password-checkbox" style="display: inline; width: auto; height: auto;">
                    <!-- <label for="show-password-checkbox" style="font-size: 12pt">show password</label> -->
                    <span style="margin-top: 0; display: inline; ">show password</span>
                </div>
                <button class="btn_signup"  type="submit">Login</button>

                <span>Don't Have an Account? <a href="./register_privato.php">Signup</a></span>
            </form>
        </div>

<script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous">
</script>

<script>
    // data
    var clear;
    var msgDuration = 2000; // 2 seconds

    // cache DOM
    var $msg = $('.msg');
 
    const form = document.querySelector('form');
    const emailInput = document.getElementById('tb_email');
    const passwordInput = document.getElementById('tb_password');
    const showPasswordCheckbox = document.getElementById('show-password-checkbox');

    $msg.on('transitionend', timer);

    // render message
    function render($msgError){
        hide();
        $msg.addClass('msg-error active').text($msgError);
    }

    function timer(){
        clearTimeout(clear);
        clear = setTimeout(function(){
            hide();
        }, msgDuration)
    }

    function hide(){
        $msg.removeClass('msg-error active');
    }

    showPasswordCheckbox.addEventListener('change', function() {
        const type = this.checked ? 'text' : 'password';
        passwordInput.type = type;
    });

</script>


<?php
include './_footer.php';
?>