<!DOCTYPE html>
<html lang="en">
<style>
.card-1{
    width: 180px;
    height: 270px;
    background-color: #DABE83 ;
    border-radius: 10px;
    filter: drop-shadow(0px 8px 4px rgba(0, 0, 0, 0.25));
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
    <div class="card-1">
        <span class="class-text-1">Products category</span> <br>
        <span class="class-text-2">10.220</span><br>
        <span class="class-text-3">Total Products</span><br>
    <canvas id="myChart" width="80%" height="90%"></canvas>
    </div>
    <script>
var xValues = ["Cucina", "Salotto", "Camera Da Letto", "Bagno"];
var yValues = [55, 49, 44, 24];
var barColors = [
  "#768C65",
  "#FF8F52",
  "#424242",
  "#F0F0F0",
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues,
      borderWidth: 0
    }]
  },
  options: {
    legend: {
            position: 'bottom',
            labels: {
              usePointStyle: true,
              pointStyle: 'circle',
              fontSize: 11
            }

          }
  }
});
    </script>
</body>
</html>