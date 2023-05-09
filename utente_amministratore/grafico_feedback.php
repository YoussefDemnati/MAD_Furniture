    <?php list($stars, $percentuali) = get_tot_rating_ever($conn);?>
    <div class="card-5">
        <span class="class-text-1">Feedbacks</span> <br>
        <div class="stars">
            <img src="../assets/img/stars/star_<?=$stars?>.png" alt="">
            </div>
            <div class="feedback_row">5 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_5" style="width: <?=$percentuali[4]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[4]["percentuale"])?>%</b></div>
            <div class="feedback_row">4 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_4" style="width: <?=$percentuali[3]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[3]["percentuale"])?>%</b></div>
            <div class="feedback_row">3 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_3"style="width: <?=$percentuali[2]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[2]["percentuale"])?>%</b></div>
            <div class="feedback_row">2 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_2"style="width: <?=$percentuali[1]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[1]["percentuale"])?>%</b></div>
            <div class="feedback_row">1 star&nbsp&nbsp ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_1" style="width: <?=$percentuali[0]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[0]["percentuale"])?>%</b></div>
    <br>
    </div>