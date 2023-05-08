</div>
    
    <div class="footer_container">
        <div class="footer">
        <div class="footer_section logo_footer">
            <img src="./assets/img/logo.png" alt="Logo">
        </div>
        <div class="footer_section contacts">
            <h2>Contacts</h2>
            <ul>
                <li>Address: ----------------------</li>
                <li>Phone: ----------------------</li>
                <li>Email: ----------------------</li>
            </ul>
        </div>
        <div class="footer_section about_us">
            <h2>About Us</h2>
            <ul> 
                <li>Miner's Foreman: Youssef Demnati</li>
                <li>Miner N°1: Nikita Macreniuc</li>
                <li>Miner N°2: Azzalin Gabriele</li>
            </ul>
        </div>
        <div class="footer_section account">
            <h2>Account</h2>
            <ul>
                <li><a href="#">My Account</a></li>
                <li><a href="#">Cart</a></li>
                <li><a href="#">Wishlist</a></li>
                <li><a href="#">My Orders</a></li>
                <li><a href="#">Logout</a></li>
                <li><a href="#">Delete Account</a></li>
            </ul>
        </div>
        <div class="footer_section other">
            <h2>Other</h2>
            <ul>
                <li><a href="./auth/login.php">Login</a></li>
                <li><a href="./auth/register_privato.php">Signup</a></li>
                <li><a href="./utente_amministratore/dashboard.php">Dashboard Admin</a></li>
                <li><a href="./utente_azienda/dashboard.php">Dashboard Azienda</a></li>
            </ul>
        </div>
        <div class="footer_section support">
                <h2>Support Center</h2>
                <p>Ask us Something, Usually Answers in 24H.</p>
                <form action="#">
                    <textarea name="message" id="message" cols="40" rows="7"></textarea>
                    <br>
                    <button onclick="sendEmail(); return false;">Invia
                    </button>
                </form>
        </div>

        <script>
            function sendEmail() {
                var message = document.getElementById('message').value;
                var email = 'youssef.demnati.studenti@isii.it';
                var subject = 'Domanda di supporto';
                var body = encodeURIComponent(message);
                var link = 'mailto:' + email + '?subject=' + subject + '&body=' + body;
                window.location.href = link;
                console.log(link);
            }
        </script>

    </div>
    <div class="copyright">
        <span id="copyright">Copiright © 2023 MAD Miners Co. All Right Reserved</span>
        <img src="../assets/img/paypal.png" alt="paypal" id="paypal">
        <a href="#" class="go_up">
            <img src="../assets/img/go_up.png" alt="Torna Su">
        </a>                        
    </div>
</div>


</body>
</html>