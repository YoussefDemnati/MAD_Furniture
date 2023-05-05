<!DOCTYPE html>
<html lang="en">
<style>
.card-1{
    width: 180px;
    height: 270px;
    background-color: #DABE83 ;
    border-radius: 10px;
    /* mettere le shadow */
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card-1">
        <span class="class-text-1">Used Devices</span> <br>
    <canvas id="myChart2" width="80%" height="90%"></canvas>
    </div>
    
</body>
<script>
  var xValues = ["Desktop", "Mobile", "Tablet"];
var yValues = [90, 49, 14];
var barColors = [
  "#768C65",
  "#FF8F52",
  "#424242",
];

var myChart = new Chart(document.getElementById("myChart2"), {
  type:"doughnut",
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
</html>