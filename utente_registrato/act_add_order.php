<?php
    include("../include/_db_dal.inc.php");
    $conn = db_connect();
    $id = intval($_SESSION["id"]);

    $transport_company_list = get_transport_company($conn);
    $product_list = get_products_by_user($conn, $id);

    $order_id = add_order($conn, rand(7, 14), rand(1, count($transport_company_list)), $id);

    foreach ($product_list as $product) {
        add_order_element($conn, $order_id, $product["id_p"]);
    }

    $sql = "DELETE
            FROM elemento_carrello
            WHERE id_u = $id";
    $conn->query($sql);
    header("Location: history.php?state=waiting");
?>