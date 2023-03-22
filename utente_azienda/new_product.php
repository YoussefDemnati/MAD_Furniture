<?php
require('_header.php');
// require('./include/_db_dal.inc.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();
    if(isset($_POST['titolo'])){
		if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
			// Otteniamo il percorso del file temporaneo che PHP ha creato quando l'immagine è stata caricata
			$tmp_name = $_FILES["file"]["tmp_name"];
		
			// Otteniamo il nome originale del file caricato
			$name = basename($_FILES["file"]["name"]);
		
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
			} else {
				// Se l'immagine non è in formato PNG, spostiamo semplicemente il file temporaneo nel percorso specificato utilizzando la funzione "move_uploaded_file()"
				move_uploaded_file($tmp_name, $filename);
			}
		}
		
		
		// $filename = $_FILES['image'];
		// $image = imagecreatefrompng($filename);
		// $imageInfo = getimagesize($filename);
		// imagepng($image, $filename, 9);
    	// $blob = 'data:' . $imageInfo['mime'] . ';base64,' . base64_encode($content);

    	new_product($conn,$_POST['titolo'],$_POST['descrizione'],$_POST['prezzo'],
		$_POST['tipo_prodotto_finito'],$_POST['altezza'],$_POST['larghezza'],
		$_POST['profondita'],$_POST['spessore'],$_POST['modello'],$_POST['casa_produttrice'],
		$_POST['indirizzo_magazzino'],$_POST['forma'],$_POST['tipo'],$png,$_POST['categoria']);
	
		unlink($filename); //boh,forse va fatto
	} else {
    echo "errore immagine";
  	}	}
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
        <input type="file" name="image" required>

		<input type="submit" value="Inserisci">
	</form>
</body>
</html>