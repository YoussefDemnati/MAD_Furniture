<?php
include("_header.php");
include("../include/_db_dal.inc.php");
$conn = db_connect();

if (isset($_SESSION["id"]) && isset($_SESSION["tipo"])) {
    if ($_SESSION["tipo"] != "privato") {
        header("Location: ../index.php");
    } else {
        //user data
        $id = intval($_SESSION["id"]);
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM utente WHERE id_u = $id"));
        $name = $user["nome"];
        $surname = $user["cognome"];
        $email = $user["email"];
        $address = $user["indirizzo"];

        //history
        $state = "";
        if(isset($_GET["state"])){
            switch ($_GET["state"]){
                case "waiting":
                    $state = "In attesa";
                    break;
                case "delivered":
                    $state = "consegnato";
                    break;
                case "cancelled":
                    $state = "annullato";
                default:
                    $state = "all";
            }
        }else{
            header("Location: history.php?state=all");
        }
        //$history_list = get_user_history($conn, $id, $state);

        //orders
        $order_list = get_orders_by_user($conn, $id);
    }
} else {
    header("Location: ../auth/login.php");
}
?>

<?php foreach ($order_list as $order) {
    $history_list = get_user_history($conn, $id, $state, $order["id_o"]); ?>
<div class="profile-row">
    <div class="profile-container">
<?php foreach ($history_list as $product) { ?>
        <?php
            //print_r($product);
        ?>
        div
    <?php } ?>
    </div>
</div>
<?php } ?>

<div class="profile-row">
    <div class="profile container">
        
    </div>
</div>

<?php include("_footer.php"); ?>