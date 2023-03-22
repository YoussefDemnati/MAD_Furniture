<?php
require('./include/_db_dal.inc.php');
    $conn = db_connect();
    if($_POST[''])
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image_data = file_get_contents($_FILES['image']['tmp_name']);
    // new_product($conn);
  } else {
    echo "errore immagine";
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inserimento prodotto</title>
</head>
<body>
	<h1>Inserimento prodotto</h1>
	<form method="post" action="new_product.php" enctype="multipart/form-data">
		<label for="titolo">Titolo:</label>
		<input type="text" name="titolo" required><br>

		<label for="descrizione">Descrizione:</label>
		<textarea name="descrizione" required></textarea><br>

		<label for="prezzo">Prezzo:</label>
		<input type="number" name="prezzo" step="0.01" required><br>

		<label for="tipo_prodotto_finito">Tipo prodotto finito:</label>
		<select name="tipo_prodotto_finito" required>
			<option value="Mobili">Mobili</option>
			<option value="Elettrodomestici">Elettrodomestici</option>
			<option value="Illuminazione">Illuminazione</option>
		</select><br>

		<label for="altezza">Altezza:</label>
		<input type="number" name="altezza" step="0.01" required><br>

		<label for="larghezza">Larghezza:</label>
		<input type="number" name="larghezza" step="0.01" required><br>

		<label for="profondita">Profondità:</label>
		<input type="number" name="profondita" step="0.01" required><br>

		<label for="spessore">Spessore:</label>
		<input type="number" name="spessore" step="0.01" required><br>

		<label for="modello">Modello:</label>
		<input type="text" name="modello" required><br>

		<label for="casa_produttrice">Casa produttrice:</label>
		<input type="text" name="casa_produttrice" required><br>

		<label for="indirizzo_magazzino">Indirizzo magazzino:</label>
		<input type="text" name="indirizzo_magazzino" required><br>

		<label for="forma">Forma:</label>
		<input type="text" name="forma" required><br>

		<label for="tipo">Tipo:</label>
		<input type="text" name="tipo" required><br>

        <label for="tipo">Immagine:</label>
        <input type="file" name="image">

		<input type="submit" value="Inserisci">
	</form>
</body>
</html>