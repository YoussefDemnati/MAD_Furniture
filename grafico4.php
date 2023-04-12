<!DOCTYPE html>
<html lang="en">
<style>
.card-3{
    width: 500px;
    height: 240px;
    background-color: #DABE83 ;
    border-radius: 10px;
    /* mettere le shadow */
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Chart</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <div class="card-3">
        <span class="class-text-1">Products category</span> <br>
        <span class="class-text-2">Searched 99k times</span> <br>
    <canvas id="myChart4" width="400px"></canvas>
    </div>
    <script>
var chartData = {
  labels: ['5 Mar', '10 Mar', '15 Mar', '20 Mar', '25 Mar', '30 Mar'],
  labels: ['5', '10', '15', '20', '25', '30'],
  datasets: [{
    label: 'Guadagni Mese Attuale',
    data: [2000, 3000, 4000, 3500, 5000, 6000],
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
</body>
</html>