<?php
    require '../include/_db_dal.inc.php';
    
    if(isset($_POST["email"])){
        $response = signup_azienda($_POST["company_name"], 
        $_POST["address"], 
        $_POST["email"], 
        $_POST["phone"], 
        $_POST["password"]);
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
            <h1>Welcome!</h1>
            <form action="" method="POST">
                <div class="error"><?php echo @$response; ?></div>

                <div class="input_field">
                    <label for="company_name">Name</label>
                    <input type="text" name="company_name" id="tb_company_name" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="tb_address" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="email">Email</label>
                    <input type="email" id="tb_email" name="email" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="tb_phone" required maxlength="255">
                </div>
                <div class="input_field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="tb_password" required maxlength="255">
                    
                </div>
                <div class="input_field">
                    <label for="conf_password">Confirm password</label>
                    <input type="password" name="conf_password" id="tb_conf_password" required maxlength="255">
                </div>
                
                <div class="input_field align-left">
                    <input type="checkbox" id="show-password-checkbox" style="display: inline; width: auto; height: auto;">
                    <!-- <label for="show-password-checkbox" style="font-size: 12pt">show password</label> -->
                    <span style="margin-top: 0; display: inline; ">show password</span>
                </div>
                <button class="btn_signup" type="submit">Signup</button>


                <span>Already Have an Account? <a href="#">Login</a></span>
            </form>
        </div>
        <div class="btn_change_signup_container">
            <button class="btn_change_signup" onclick="window.location.href='register_privato.php';">Accedi come Privato</button>
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
    const companyNameInput = document.getElementById('tb_company_name');
    const addressInput = document.getElementById('tb_address');
    const phoneInput = document.getElementById('tb_phone');
    const emailInput = document.getElementById('tb_email');
    const passwordInput = document.getElementById('tb_password');
    const confirmPasswordInput = document.getElementById('tb_conf_password');
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

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const companyNameValue = companyNameInput.value.trim();
        const addressValue = addressInput.value.trim();
        const phoneValue = phoneInput.value.trim();
        const emailValue = emailInput.value.trim();
        const passwordValue = passwordInput.value.trim();
        const confirmPasswordValue = confirmPasswordInput.value.trim();

        if (companyNameValue === '' || addressValue === '' || phoneValue === '' || emailValue === '' || passwordValue === '' || confirmPasswordValue === '') {
            render('Please fill out all fields.');
            return;
        }

        if (passwordValue !== confirmPasswordValue) {
            render('Passwords do not match.');
            return;
        }

        if (passwordValue.length < 8) {
            render('Password must be at least 8 characters long.');
            return;
        }

        if (!/^[0-9]{10}$/.test(phoneValue)) {
            render('Phone number must be a 10-digit number.');
            return;
        }

        form.submit();
    });

    showPasswordCheckbox.addEventListener('change', function() {
        const type = this.checked ? 'text' : 'password';
        passwordInput.type = type;
        confirmPasswordInput.type = type;
    });

</script>

<?php
include './_footer.php';
?>