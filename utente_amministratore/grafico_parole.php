<!DOCTYPE html>
<html lang="en">
<style>
.card-23{
    width: 370px;
    height: 240px;
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
    <div class="card-23">
        <span class="class-text-title">Products category</span> <br>
        <!-- <span class="class-text-2">Searched 99k times</span> <br> -->
    <canvas id="myChart3" ></canvas>
    </div>
    <script>
var xValues = ["Tavolo da Cucina", "Letto Matrimoniale", "Tappeto", "Gatto Da Compagnia"];
var yValues = [55, 49, 44, 24];
var barColors = [
  "#768C65",
  "#FF8F52",
  "#424242",
  "#F0F0F0",
];

new Chart("myChart3", {
  type: "horizontalBar",
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
      display: false,
    }
}
});
    </script>
</body>
</html>