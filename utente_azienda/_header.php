<!DOCTYPE html>
<html lang="en">
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
  <nav>
    <div class="logo">
      <img src="../assets/img/logo.png" alt="Logo">
    </div>
    <ul class="links">
      <li><a href="#">DASHBOARD</a></li>
      <li><a href="#">MY PRODUCTS</a></li>
      <li><a href="#">NEW PRODUCT</a></li>
    </ul>
    <div class="nav_buttons">
      <button class="btn_user"></button>
    </div>
  </nav>
  <script>
    $(".btn_user").click(function() {
      window.location.href = "profile.php";
    });
  </script>
  <div class="content">