<?php
require('_header.php');
// require('./include/_db_dal.inc.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();
		$azienda = 2;
		//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA
		if(isset($_POST['titolo'])){
		new_product($conn,$_POST['titolo'],$_POST['descrizione'],$_POST['prezzo'],
		$_POST['tipo_prodotto_finito'],$_POST['altezza'],$_POST['larghezza'],
		$_POST['profondita'],$_POST['spessore'],$_POST['modello'],$_POST['casa_produttrice'],
		$_POST['indirizzo_magazzino'],$_POST['forma'],$_POST['tipo'],$_POST['categoria'],$azienda,$_FILES['immagini']);
}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inserimento prodotto</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<h1>Inserimento prodotto</h1>
	<form method="post" action="new_product.php" enctype="multipart/form-data" >
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

        <label for="tipo">Immagine(max 5):</label>
		<input type="file" id="immagini" name="immagini[]" accept="image/*" multiple style="display: none;">
		<button type="button" onclick="document.getElementById('immagini').click()">Aggiungi foto</button>
		<br><br>
		<div id="anteprima"></div>
		<br><br>

		<input type="submit" value="Inserisci">
	</form>
</body>


<script>

		function mostraAnteprima() {
			console.log("MostraAnteprima");
			var anteprimaDiv = document.getElementById('anteprima');
			// anteprimaDiv.innerHTML = 'lalalend';
			var files = document.getElementById('immagini').files;
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				if (!file.type.match('image.*')) {
					continue;
				}
				var reader = new FileReader();
				reader.onload = (function(immagine) {
					return function(event) {
						var img = document.createElement('img');
						var delimg = document.createElement('img');
						img.src = event.target.result;
						delimg.src = "../assets/img/ics.png";
						img.setAttribute("width", "100");
						img.setAttribute("height", "100");
						delimg.setAttribute("width", "20");
						delimg.setAttribute("height", "20");
						// delimg.setAttribute("position", "absolute");
						delimg.setAttribute("top", "0");
						//da aggiustare(comprimere bene come quadrato)
						anteprimaDiv.appendChild(img);
						anteprimaDiv.appendChild(delimg);
						// anteprimaDiv.appendChild(crocetta); una X per eliminare immagine?
					};
				})(file);
				reader.readAsDataURL(file);
			}
		}

		document.getElementById('immagini').addEventListener('change', mostraAnteprima);

</script>
</html>