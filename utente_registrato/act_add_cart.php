<?php
    include("../include/_db_dal.inc.php");
    $conn = db_connect();
    $sql = "SELECT * FROM prodotto ORDER BY id_p ASC";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if(isset($_GET["add"])){

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>add to cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php foreach($rows as $key=>$value){ ?>
	    <div class="product-item">
		    <form method="post" action="cart.php?action=add&code=<?php echo $rows[$key]["id_p"]; ?>">
                <div class="product-tile-footer">
                <div class="product-title"><?php echo $rows[$key]["titolo"]; ?></div>
                <div class="product-price"><?php echo "$".$rows[$key]["prezzo"]; ?></div>
                <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
            </div>
		    </form>
	    </div>
        <?php } ?>
    </body>
</html>