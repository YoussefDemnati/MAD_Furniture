<!DOCTYPE html>
<html lang="en">
<style>
.card-14{
    width: 70%;
    height: 350px;
    background-color: #DABE83 ;
    border-radius: 10px;
    padding:10px;
    filter: drop-shadow(0px 8px 4px rgba(0, 0, 0, 0.25));
}
</style>
<div class="card-14">
        <span class="class-text-1">Used Devices</span> <br>
    <canvas id="myChart_device" ></canvas>
    </div>
    
</body>
<script>
  var xValues = ["Desktop", "Mobile", "Tablet"];
var yValues = [90, 49, 14];
var barColors = [
  "#575757",
  "#949494",
  "#FFFFFF",
];

var myChart = new Chart(document.getElementById("myChart_device"), {
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