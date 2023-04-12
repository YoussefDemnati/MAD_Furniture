<?php
require('_header.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();
$azienda = 2;
//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA
if(isset($_POST['bottone1'])){
   
}

if(isset($_POST['bottone2'])){
    // Il bottone 2 è stato premuto, esegui questo codice...
}

$products = get_products($conn, $azienda);
?>
<?php
foreach($products as $p){?>

<form method="POST" action="products.php">
    <pre> Titolo: <?=$p['titolo']?>    Prezzo: <?=$p['prezzo']?>
	<input type="hidden" name="azienda" value=<?=$azienda?>></input><input type="hidden" name="prodotto" value=<?=$p['id_p']?>></input><button type="submit" name="edit">Edit</button><button type="submit" name="delete">Delete</button></pre>
</form>
<?php
}
?>
</body>
</html>
