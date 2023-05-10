<button class="back-button" onclick="location.href='./dashboard.php'">Back</button>
<form method="post" action="#" enctype="multipart/form-data" class="new_product_form">
    <input type="hidden" id="finito" name="finito">
    <div class="error"><?php echo @$response; ?></div>
    <div class="new_element">
        <label for="titolo">Titolo:</label><br>
        <input type="text" name="titolo" required style="font-size: 19pt;"><br>
    </div>
    <div class="new_element">
        <label for="descrizione">Descrizione:</label><br>
        <textarea name="descrizione" required></textarea><br>
    </div>
    <div class="new_element">
        <label for="prezzo">Prezzo:</label><br>
        <input type="number" name="prezzo" required><br>
    </div>
    <div class="new_element">
        <label for="categoria">Categoria:</label><br>
        <select name="categoria" required>
            <?php
            $categories = get_categories();
            foreach ($categories as $cat) { ?>
                <option value="<?= $cat["id_cat"] ?>"><?= $cat["nome"] ?></option>
            <?php } ?>
        </select><br>
    </div>
    <div class="new_element">
    <label for="tipo_prodotto_finito">Tipo prodotto finito:</label><br>
        <select name="tipo_prodotto_finito" required>
            <?php
            $tipi = get_tipi_prodotto_finito();
            foreach ($tipi as $t) {?>
                <option value="<?= $t["id_tipo"] ?>"><?= $t["nome"] ?></option>
            <?php } ?>
        </select><br>
    </div>
    <div class="new_element">
        <label for="altezza">Altezza:</label><br>
        <input type="number" name="altezza" required><br>
    </div>
    <div class="new_element">
        <label for="larghezza">Larghezza:</label><br>
        <input type="number" name="larghezza" required><br>
    </div>
    <div class="new_element">
        <label for="profondita">Profondità:</label><br>
        <input type="number" name="profondita" required><br>
    </div>
    <div class="new_element">
        <label for="modello">Modello:</label><br>
        <input type="text" name="modello" required><br>
    </div>
    <div class="new_element">
        <label for="casa_produttrice">Casa produttrice:</label><br>
        <input type="text" name="casa_produttrice" required><br>
    </div>
    <div class="new_element">
        <label for="indirizzo_magazzino">Indirizzo magazzino:</label><br>
        <input type="text" name="indirizzo_magazzino" required><br>
    </div>
    <div class="new_element">
        <label for="tipo">Immagine(max 5):</label><br>
        <input type="file" id="immagini" name="immagini[]" accept="image/*" multiple style="display: none;">
        <button type="button" onclick="document.getElementById('immagini').click()">Aggiungi foto</button>
        <br><br>
        <div id="anteprima"></div>
        <div id="anteprima1"></div>
        <br><br>
    </div>

    <input type="submit" value="Inserisci" class="new_button">
</form>