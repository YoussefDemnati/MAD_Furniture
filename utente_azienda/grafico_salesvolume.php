<div class="card-3">
        <span class="class-text-1">Products category</span> <br>
        <span class="class-text-2">Searched 99k times</span> <br>
    <canvas id="myChart4" width="400px"></canvas>
    </div>
    <?php 
    $currentDate = new DateTime();
    $month = $currentDate->format('m');
    $year = $currentDate->format('Y');
    $array=sales_volume($conn,$azienda,$month,$year);
    $data=$array[1];
    $giorni_mese= 30;//DA FINIRE
    for ($i = 1; $i <= $giorni_mese; $i++) {
        echo $i;
    }
     ?>
    <script>
var chartData = {
    labels: ['5 Mar', '10 Mar', '15 Mar', '20 Mar', '25 Mar', '30 Mar'],
    labels: ['5', '10', '15', '20', '25', '30'],
    datasets: [{
    label: 'Guadagni Mese Attuale',
    data: [1500, 2500, 3000, 3200, 4000, 5500],
    borderColor: 'rgb(54, 162, 235)',
    fill: false
  }, {
    label: 'Guadagni Mese Scorso',
    data: [1500, 2500, 3000, 3200, 4000, 5500],
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