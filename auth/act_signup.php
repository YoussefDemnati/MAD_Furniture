<?php
require('../include/_db_dal.inc.php');
if (!empty($_GET["type"])) {
    if ($_GET["type"] == "privato") {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $type = $_POST["type"];
        $password = $_POST["password"];
        signup_privato($first_name, $last_name, $email, $address, $password, $_GET["type"]);
    } 
    elseif ($_GET["type"] == "azienda") {
        $company_name = $_POST["company_name"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        signup_azienda($company_name, $address, $email, $phone, $password);
    } 
    else {
        header("Location: register_privato.php");
    }
} else {
    header("Location: register_privato.php");
}
