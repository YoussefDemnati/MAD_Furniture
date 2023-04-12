<?php
require('_header.php');
require('_header.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();
		$azienda = 2;
		//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA ciao
		if(isset($_POST['titolo'])){
		new_product($conn,$_POST['titolo'],$_POST['descrizione'],$_POST['prezzo'],
		$_POST['tipo_prodotto_finito'],$_POST['altezza'],$_POST['larghezza'],
		$_POST['profondita'],$_POST['spessore'],$_POST['modello'],$_POST['casa_produttrice'],
		$_POST['indirizzo_magazzino'],$_POST['forma'],$_POST['tipo'],$_POST['categoria'],$azienda,$_FILES['immagini']);
}
		
?>

	<h1>Inserimento prodotto</h1>
	<form method="post" action="new_product.php" enctype="multipart/form-data" >
		<label for="titolo">Titolo:</label>
		<input type="text" name="titolo" required><br>

		<label for="descrizione">Descrizione:</label>
		<textarea name="descrizione" required></textarea><br>

		<label for="prezzo">Prezzo:</label>
		<input type="number" name="prezzo" required><br>

		<label for="categoria">Categoria:</label>
		<select name="categoria" required>
            <?php 
            $categories = get_categories();
            foreach($categories as $cat) {debug_to_console($cat); ?>
                <option value="<?=$cat["id_cat"]?>"><?=$cat["nome"]?></option>
            <?php } ?>
		</select><br>

		<label for="tipo_prodotto_finito">Tipo prodotto finito:</label>
		<select name="tipo_prodotto_finito" required>
			<option value="Divani ">Divani</option>
			<option value="Tavoli ">Tavoli</option>
			<option value="Armadi">Armadi</option>
            <option value="Librerie ">Librerie</option>
			<option value="Cucine ">Cucine</option>
			<option value="Materassi">Materassi</option>
            <option value="Poltrone ">Poltrone</option>
			<option value="Lampade ">Lampade</option>
			<option value="Tappeti">Tappeti</option>
            <option value="Specchi ">Specchi</option>
			<option value="Scrivanie ">Scrivanie </option>
			<option value="Letti">Letti</option>
            <option value="Comò ">Comò</option>
			<option value="Pouf ">Pouf</option>
			<option value="Cassettiere">Cassettiere</option>
            <option value="Consolle ">Consolle</option>
			<option value="Panche ">Panche</option>
			<option value="Credenze">Credenze</option>
            <option value="Mensole ">Mensole</option>
			<option value="Portaoggetti ">Portaoggetti</option>
			<option value="Contenitori">Contenitori</option>
            <option value="Mobili da giardino ">Mobili da giardino</option>
			<option value="Attrezzi da cucina ">Attrezzi da cucina</option>
			<option value="Accessori per la casa">Accessori per la casa</option>
            <option value="Accessori per il bagno ">Accessori per il bagno</option>
			<option value="Materiali per la decorazione ">Materiali per la decorazione</option>
		</select><br>

		<label for="altezza">Altezza:</label>
		<input type="number" name="altezza" required><br>

		<label for="larghezza">Larghezza:</label>
		<input type="number" name="larghezza" required><br>

		<label for="profondita">Profondità:</label>
		<input type="number" name="profondita" required><br>

		<label for="spessore">Spessore:</label>
		<input type="number" name="spessore" required><br>

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
						// delimg.src = "..assets/img/ics.png";
						img.setAttribute("width", "100");
						img.setAttribute("height", "100");
						//da aggiustare(comprimere bene)
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
    </div>

<?php
require('_footer.php');
?>