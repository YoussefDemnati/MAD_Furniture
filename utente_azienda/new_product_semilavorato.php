<?php
require('_header.php');
require('../include/_db_dal.inc.php');

debug_to_console($_SESSION["tipo"]);

if($_SESSION["tipo"] != "azienda"){
    header("Location: ../index.php");
}

$conn = db_connect();
$id_azienda = $_SESSION["id"];

if (isset($_POST['titolo'])) {
    $result = new_product_semilavorato(
        $conn,
        $_POST['titolo'],
        $_POST['descrizione'],
        $_POST['prezzo'],
        $_POST['altezza'],
        $_POST['larghezza'],
        $_POST['spessore'],
        $_POST['casa_produttrice'],
        $_POST['indirizzo_magazzino'],
        $_POST['forma'],
        $id_azienda,
        $_POST['materiale'],
        $_FILES['immagini']
    );
}

?>

<button class="back-button" onclick="location.href='./dashboard.php'">Back</button>
<form method="post" action="#" enctype="multipart/form-data" class="new_product_form">
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
    
    <div class="new_element">
        <label for="altezza">Altezza:</label><br>
        <input type="number" name="altezza" required><br>
    </div>
    <div class="new_element">
        <label for="larghezza">Larghezza:</label><br>
        <input type="number" name="larghezza" required><br>
    </div>
    <div class="new_element">
        <label for="spessore">Spessore:</label><br>
        <input type="number" name="spessore" required><br>
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
        <label for="forma">Forma:</label><br>
        <input type="text" name="forma" required><br>
    </div>
    <div class="new_element">
        <label for="tipo">Immagine(max 5):</label><br>
        <input type="file" id="immagini" name="immagini[]" accept="image/*" multiple style="display: none;">
        <button type="button" onclick="document.getElementById('immagini').click()">Aggiungi foto</button>
        <br><br>
        <div id="anteprima"></div>
        <br><br>
    </div>

    <input type="submit" value="Inserisci" class="new_button">
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
                    delimg.src = "../assets/img/ics.png";
                    img.setAttribute("width", "100");
                    img.setAttribute("height", "100");
                    delimg.setAttribute("width", "20");
                    delimg.setAttribute("height", "20");
                    delimg.setAttribute("position", "absolute");
                    delimg.setAttribute("top", "0");
                    //non va in "top" sto scemo
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
</div>

<?php
require('_footer.php');
?>