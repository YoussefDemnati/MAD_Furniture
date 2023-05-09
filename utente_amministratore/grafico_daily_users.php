<div class="card-34">
        <span class="class-text-title">Daily Users</span> <br>
        <span class="class-text-money">Today</span> <br>
        <!-- <span class="class-text-2"></span> <br> -->
    <canvas id="myChart4" width="400px"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

var chartData = {
    // labels: ['5 Mar', '10 Mar', '15 Mar', '20 Mar', '25 Mar', '30 Mar'],
    labels: ['00:00', '4:00', '8:00', '12:00', '16:00', '20:00'],
    datasets: [{
    label:"",
    data: [2,3,13,13,104,1],
    borderColor: 'rgb(54, 162, 235)',
    fill: false
  }]
};

const lines = new Chart("myChart4", {
  type: "line",
  data: chartData,
  options: {
    legend: {
      display: false
    },
    responsive: false,
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Giorni'
        }
      }]
    }
  }
  
});
    </script>
