
    <div class="card-2">
        <span class="class-text-title">Products category</span> <br>
        <span class="class-text-subtitle">Searched 99k times</span> <br>
    <canvas id="myChart3" ></canvas>
    </div>
    <script>
var xValues = <?= get_categories($conn); ?>
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