<!DOCTYPE html>
<html lang="en">
<style>
.card-4{
    width: 450px;
    height: 240px;
    background-color: #FFFFFF ;
    border-radius: 10px;
    filter: drop-shadow(0px 8px 4px rgba(0, 0, 0, 0.25));
}
.stars{
    margin:10px;
}
.feedback_row{
margin-bottom: 10px;
}
.feedback_row_white{
    display: inline-block;
    width: 70%;
    background-color: #F3F3F3;
}
.feedback_row_coloured{
    display: inline-block;
    background-color: #C19E54;
}
.stars_5{
    width: 60%;
}
.stars_4{
    width: 40%;
}
.stars_3{
    width: 20%;
}
.stars_2{
    width: 70%;
}
.stars_1{
    width: 20%;
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
    <div class="card-4">
        <span class="class-text-1">Feedbacks</span> <br>
        <div class="stars">
            <img src="./assets/img/stars/star_<?=$stars_num?>.png" alt="">
            </div>
            <div class="feedback_row">5 stars   <span class="feedback_row_white">   ‎<span class="feedback_row_coloured stars_5">‎</span></span>  56%</div>
            <div class="feedback_row">4 stars   <span class="feedback_row_white">   ‎<span class="feedback_row_coloured stars_4">‎</span></span>  36%</div>
            <div class="feedback_row">3 stars   <span class="feedback_row_white">   ‎<span class="feedback_row_coloured stars_3">‎</span></span>  16%</div>
            <div class="feedback_row">2 stars   <span class="feedback_row_white">   ‎<span class="feedback_row_coloured stars_2">‎</span></span>  6%</div>
            <div class="feedback_row">1 star   <span class="feedback_row_white">   ‎<span class="feedback_row_coloured stars_1">‎</span></span>  16%</div>
         <br>
    </div>
    
</body>
</html>