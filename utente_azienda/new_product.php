<?php
require('_header.php');
// require('./include/_db_dal.inc.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();
		$azienda = 2;
		//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA
		if(isset($_POST['titolo'])){
			if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
				// Otteniamo il percorso del file temporaneo che PHP ha creato quando l'immagine è stata caricata
				$tmp_name = $_FILES["image"]["tmp_name"];
		
				// Otteniamo il nome originale del file caricato
				$name = basename($_FILES["image"]["name"]);
		
				// Otteniamo l'estensione del file (ad esempio "png", "jpg", "gif", ecc.)
				$ext = pathinfo($name, PATHINFO_EXTENSION);
		
				// Creiamo un nuovo nome di file per la versione compressa dell'immagine
				$filename = pathinfo($name, PATHINFO_FILENAME) . '_compressed.' . $ext;
		// Se l'immagine è in formato PNG
        if ($ext == 'png') {
            // Creiamo una nuova immagine PNG dal file temporaneo utilizzando la funzione "imagecreatefrompng()"
            $png = imagecreatefrompng($tmp_name);

            // Disabilitiamo la miscelazione di colori per mantenere l'opacità dell'immagine utilizzando le funzioni "imagealphablending()" e "imagesavealpha()"
            imagealphablending($png, false);
            imagesavealpha($png, true);

            // Impostiamo la qualità della compressione PNG (0 = migliore qualità, 9 = peggiore qualità)
            $quality = 9;

            // Salviamo la versione compressa dell'immagine PNG utilizzando la funzione "imagepng()"
            imagepng($png, $filename, $quality);

            // Liberiamo la memoria utilizzata dalla variabile $png utilizzando la funzione "imagedestroy()"
            imagedestroy($png);
        }
		// Comprimiamo l'immagine finché non raggiunge una dimensione massima di 64 KB
        $max_size = 64000;
        while (filesize($filename) > $max_size) {
            if ($ext == 'png') {
                // Riduciamo gradualmente la qualità della compressione PNG finché l'immagine non raggiunge la dimensione massima
                $quality--;
                imagepng(imagecreatefrompng($filename), $filename, $quality);
            } else {
                // Riduciamo gradualmente la qualità della compressione JPEG finché l'immagine non raggiunge la dimensione massima
                $quality -= 5;
                if ($quality < 0) $quality = 0;
                imagejpeg(imagecreatefromjpeg($filename), $filename, $quality);
            }
        }
		// Carichiamo il contenuto dell'immagine compressa in una variabile
        $image_content = file_get_contents($filename);

        // Convertiamo l'immagine compressa in formato Blob
        $blob = mysqli_real_escape_string($conn, $image_content);

		new_product($conn,$_POST['titolo'],$_POST['descrizione'],$_POST['prezzo'],
		$_POST['tipo_prodotto_finito'],$_POST['altezza'],$_POST['larghezza'],
		$_POST['profondita'],$_POST['spessore'],$_POST['modello'],$_POST['casa_produttrice'],
		$_POST['indirizzo_magazzino'],$_POST['forma'],$_POST['tipo'],$_POST['categoria'],$azienda,$blob);
}
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

		<label for="categoria">Categoria:</label>
		<select name="categoria" required>
			<option value="1">Cucina</option>
			<option value="2">Salotto</option>
			<option value="3">Bagno</option>
			<option value="4">Camera Da Letto</option>
		</select><br>

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
        <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" required>

		<input type="submit" value="Inserisci">
	</form>
</body>
</html>