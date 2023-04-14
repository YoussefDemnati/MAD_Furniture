<!DOCTYPE html>
<html lang="en">
<style>
  .card-1 {
    padding: 5px;
    padding-left: 10px;
    width: 160px;
    height: 80px;
    background-color: #DABE83;
    border-radius: 10px;
    filter: drop-shadow(0px 8px 4px rgba(0, 0, 0, 0.25));
  }

  .class-text-title {
    font-size: 1.2em;
  }

  .class-text-subtitle {
    padding-left: 2px;
    font-size: 0.7em;
    color: #607D8B;
  }

  .class-text-money {
    padding-top: 10px;
    font-weight: bold;
    font-size: 1.7em;
    color: #545351;
  }

  .class-text-versus{
    font-weight: bold;
    font-size: 0.5em;
    color: #545351;
    float:left;
    margin-top: 4px;
  }
  .triangolo_versus{
    float:left; width:20px; height:20px;
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
    <span class="class-text-title">Net Profit</span> <br>
    <span class="class-text-subtitle">This month</span><br>
    <span class="class-text-money"><?=net_profit($conn,$azienda)?>$</span><br>
    <div style="margin-left:5px;">
    <img class="triangolo_versus" src="../assets/img/triangolo_verde.png">
    <span class="class-text-versus">230$ VS YESTERDAY</span>
    </div>
  </div>
</body>

</html>