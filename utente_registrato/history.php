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
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM utente WHERE id_u = $id AND `hidden` = 0"));
        $name = $user["nome"];
        $surname = $user["cognome"];
        $email = $user["email"];
        $address = $user["indirizzo"];

        //history
        $state = "";
        if (isset($_GET["state"])) {
            switch ($_GET["state"]) {
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
        } else {
            header("Location: history.php?state=all");
        }

        //orders
        $order_list = get_orders_by_user($conn, $id, $state);
    }
} else {
    header("Location: ../auth/login.php");
}
?>

<?php
if (count($order_list) > 0) {
    foreach ($order_list as $order) {
        $history_list = get_user_history($conn, $id, $order["id_o"]);
        $shipment_date = ($order["stato"] == "In attesa" || $order["stato"] == "In attesa" ? "----/--/--" : $order["data_spedizione"]);
        $order_state = "";
        switch ($order["stato"]) {
            case "In attesa":
                $order_state = "Waiting";
                break;
            case "consegnato":
                $order_state = "Delivered";
                break;
            case "annullato":
                $order_state = "Cancelled";
            default:
                $order_state = "all";
        }
?>
        <div class="profile-row order">
            <div class="profile-col-50">
                <div class="profile-container">
                    <h2>Order #<?= $order["id_o"] ?></h2>
                    <ul>
                        <?php foreach ($history_list as $product) { ?>
                            <li><a href="../product_page.php?prod_id=<?= $product["id_p"] ?>"><?= $product["titolo"] ?></a></li>
                            <hr>
                        <?php } ?>
                    </ul>
                    Purchase date: <?= $order["data_esecuzione"] ?> | Shipment date: <?= $shipment_date ?> | State: <?= $order_state ?>
                </div>
            </div>
        </div>
<?php }
} ?>

<?php include("_footer.php"); ?>