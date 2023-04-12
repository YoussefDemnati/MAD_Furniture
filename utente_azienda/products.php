<?php
require('_header.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();
$azienda = 2;
//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA

$products = get_products($conn, $azienda);
?>
<?php
foreach($products as $p){?>

<form method="POST" action="product_page.php">
    <pre> Titolo: <?=$p['titolo']?>    Prezzo: <?=$p['prezzo']?>
	<input type="hidden" name="azienda" value=<?=$azienda?>></input><input type="hidden" name="prodotto" value=<?=$p['id_p']?>></input><button type="submit" name="edit">Edit</button><button type="submit" name="delete">Delete</button></pre>
</form>
<?php
}
?>
</body>
</html>
