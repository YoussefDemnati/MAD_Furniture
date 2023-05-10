<button class="back-button" onclick="location.href='./dashboard.php'">Back</button>
<form method="post" action="#" enctype="multipart/form-data" class="new_product_form">
<input type="hidden" id="semilavorato" name="semilavorato">    
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
        <label for="categoria">Materiale:</label><br>
        <select name="materiale" required>
            <?php
            $materials = get_materials();
            foreach ($materials as $m) {?>
                <option value="<?= $m["id_m"] ?>"><?= $m["nome"] ?></option>
            <?php } ?>
        </select><br>
    </div>
    
        <input type="file" id="immagini" name="immagini[]" accept="image/*" multiple style="display: none;">
        <button type="button" onclick="document.getElementById('immagini').click()">Aggiungi foto</button>
        <br><br>
        <div id="anteprima2"></div>
        <br><br>
        <input type="submit" value="Inserisci" class="new_button">
    </div>

</form>