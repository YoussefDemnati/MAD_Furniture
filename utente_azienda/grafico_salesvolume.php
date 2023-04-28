<div class="card-3">
        <span class="class-text-1"></span> <br>
        <!-- <span class="class-text-2"></span> <br> -->
    <canvas id="myChart4" width="400px"></canvas>
    </div>
    <script>
var chartData = {
    // labels: ['5 Mar', '10 Mar', '15 Mar', '20 Mar', '25 Mar', '30 Mar'],
    labels: ['5', '10', '15', '20', '25', '30'],
    datasets: [{
    label: 'Guadagni Mese di <? echo getMonthName(intval($month));?>',
    data: <?=json_encode(get_sales_volume_per_5days($conn,$azienda,$month,$year))?>,
    // data: [0, 0, 0, 0, 0, 0],
    borderColor: 'rgb(54, 162, 235)',
    fill: false
  }, {
    label: 'Guadagni Mese di <? echo getMonthName(intval($month-1));?>',
    data: <?=json_encode(get_sales_volume_per_5days($conn,$azienda,$month-1,$year))?>,
    // data: [0, 0, 0, 0, 0, 0],
    borderColor: 'rgb(255, 99, 132)',
    fill: false
  }]
};
new Chart("myChart4", {
  type: "line",
  data: chartData,
  options: {
    legend: {
            position: 'right',
            labels: {
              usePointStyle: true,
              pointStyle: 'circle',
              fontSize: 11
            }

          },
    responsive: false,
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Giorni'
        }
      }],
      yAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Guadagni'
        }
      }]
    }
  }
  
});
    </script>
    <?php print_r(json_encode(get_sales_volume_per_5days($conn,$azienda,$month-1,$year)));?>