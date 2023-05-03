<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0-rc.1/Chart.bundle.js" integrity="sha512-k6NtHct+yY+ZCN0jl3GhtiAeJue4Z6KAbkcKGQN/9dbLAJBq9EFS4c3p5QRvNukX3BTPfJptH9jhh0KikPuWAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<div class="card-1">
        <span class="class-text-title">Products category</span> <br>
        <span class="class-text-money">10.220</span><br>
        <span class="class-text-subtitle">Total Products</span><br>
    <canvas id="myChart3" width="80%" height="90%"></canvas>
    </div>
      <?php $listanomi=[]; $listaconteggio=[];
      foreach(get_categories_perc($conn) as $item){
        array_push($listanomi,$item['nome']);
      }
      foreach(get_categories_perc($conn) as $item){
        array_push($listaconteggio,$item['conteggio']);
      } debug_to_json($listaconteggio);?>
          <script>
var xValues = <?=json_encode($listanomi)?>;
var yValues = <?=json_encode($listaconteggio)?>;
var barColors = [
  "#768C65",
  "#FF8F52",
  "#424242",
  "#F0F0F0",
];

new Chart("myChart3", {
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
