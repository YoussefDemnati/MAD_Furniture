
    <div class="card-1">
        <?php $variabile_bella1 = total_sales($conn,$azienda,$day,$month,$year);?>
        <?php //$variabile_bella1 = total_sales($conn,$azienda,$day-1,$month,$year);?>
        <span class="class-text-title">Total Sales</span> <br>
        <span class="class-text-subtitle">Today</span><br>
        <span class="class-text-money"><?=$variabile_bella1?>$</span><br>
        <img class="triangolo_versus" src="../assets/img/triangolo_verde.png">
        <span class="class-text-versus">230$ VS YESTERDAY</span>
    </div>