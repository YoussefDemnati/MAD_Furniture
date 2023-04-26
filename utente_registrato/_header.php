<!DOCTYPE html>
<html lang="en">
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>

  <body>
    <nav>
      <div class="logo">
        <img src="../assets/img/logo.png" alt="Logo">
      </div>

      <ul class="links">
        <li><a href="#">HOME</a></li>
        <li><a href="#">TRENDING</a></li>
        <li><a href="#">NEW PRODUCT</a></li>
        <li><a href="#">CATEGORIES</a></li>
      </ul>

      <div class="nav_buttons">
        <button class="btn_search"></button>
        <button class="btn_user"></button>
        <button class="btn_cart"></button>
      </div>
    </nav>
    <script>
      $(".btn_cart").click(function(){
          window.location.href="cart.php";
      });
      $(".btn_user").click(function(){
          window.location.href="profile.php";
      });
      $(".btn_search").click(function(){
          window.location.href="index.php";
      });
    </script>
    <div class="content">
