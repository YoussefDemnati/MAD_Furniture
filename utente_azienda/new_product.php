<?php
require('_header.php');
require('../include/_db_dal.inc.php');

debug_to_console($_SESSION["tipo"]);

// DA INSERIRE
if($_SESSION["tipo"] != "azienda"){
    header("Location: ../index.php");
}
// DA INSERIRE

$conn = db_connect();
$id_azienda = $_SESSION["id"];
// $id_azienda = 1;

debug_to_console($_SESSION["id"]);

if (isset($_POST['titolo']) && isset($_POST['finito'])) {
    $response = new_product_finito(
        $conn,
        $_POST['titolo'],
        $_POST['descrizione'],
        $_POST['prezzo'],
        $_POST['tipo_prodotto_finito'],
        $_POST['altezza'],
        $_POST['larghezza'],
        $_POST['profondita'],
        $_POST['modello'],
        $_POST['casa_produttrice'],
        $_POST['indirizzo_magazzino'],
        $_POST['categoria'],
        $id_azienda,
        $_FILES['immagini']
    );
}
if (isset($_POST['titolo']) && isset($_POST['semilavorato'])) {
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
<div class="choose_product_type">
    <span style="margin:auto; font-size:2em;">Che prodotto vuoi inserire?</span>
    <br><br>
    <div class="button_div">
    <button class="prodotto_finito">Prodotto Finito</button>
    <button class="prodotto_semi_lavorato">Prodotto Semi Lavorato</button>
    </div>
</div>
<div class="semilavorato">
    <?php require('./new_product_semilavorato.php'); ?>
</div>

<div class="finito">
    <?php require('./new_product_finito.php'); ?>
</div>
<script>
const btnSemilavorato = document.querySelector('.prodotto_semi_lavorato');
const btnFinito = document.querySelector('.prodotto_finito');
const divSemilavorato = document.querySelector('.semilavorato');
const divFinito = document.querySelector('.finito');

btnSemilavorato.addEventListener('click', function() {
  divSemilavorato.style.display = 'block';
  divSemilavorato.style.visibility = 'visible';
  btnSemilavorato.style.border = '3px solid #4F4F4F';
  divFinito.style.display = 'none';
  divFinito.style.visibility = 'hidden';
  btnFinito.style.border = '0px';
});

btnFinito.addEventListener('click', function() {
    divFinito.style.display = 'block';
    divFinito.style.visibility = 'visible';
    btnFinito.style.border = '3px solid #4F4F4F';
  divSemilavorato.style.display = 'none';
  divSemilavorato.style.visibility = 'hidden';
  btnSemilavorato.style.border = '0px';
});
// ---
function mostraAnteprima() {
        console.log("MostraAnteprima");
        var anteprimaDiv="";
        if(divFinito.style.display == 'block')
        var anteprimaDiv = document.getElementById('anteprima1');
        else if(divSemilavorato.style.display == 'block')
        var anteprimaDiv = document.getElementById('anteprima2');
        // anteprimaDiv.innerHTML = 'lalalend';
        var files = document.getElementById('immagini').files;
        for (var i = 0; i < files.length; i++) {
            console.log(files[i])
            var file = files[i];
            if (!file.type.match('image.*'))
            {
                console.log("cointnu");
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
                    // delimg.setAttribute("top", "0");
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
<?php
require('_footer.php');
?>
