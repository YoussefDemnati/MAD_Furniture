<div class="card-3">
        <span class="class-text-1"></span> <br>
        <!-- <span class="class-text-2"></span> <br> -->
    <canvas id="myChart4" width="400px"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
var chartData = {
    // labels: ['5 Mar', '10 Mar', '15 Mar', '20 Mar', '25 Mar', '30 Mar'],
    labels: ['5', '10', '15', '20', '25', '30'],
    datasets: [{
    label: 'Guadagni Mese di <?= getMonthName(intval($month));?>',
    data: <?=json_encode(get_sales_volume_per_5days_ever($conn,$month,$year))?>,
    borderColor: 'rgb(54, 162, 235)',
    fill: false
  }, {
    label: 'Guadagni Mese di <?=getMonthName(intval($month-1));?>',
    data: <?=json_encode(get_sales_volume_per_5days_ever($conn,$month-1,$year))?>,
    borderColor: 'rgb(255, 99, 132)',
    fill: false
  }]
};

const lines = new Chart("myChart4", {
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
            x: {
                type: 'linear',
                scaleLabel: {
                display: true,
                labelString: 'Giorni'
            },
            y: {
                type: 'linear',
                scaleLabel: {
          display: true,
          labelString: 'Guadagni'
        }
            }
  }
  
}}});
    </script>
