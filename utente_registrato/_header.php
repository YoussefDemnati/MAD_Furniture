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
      <li><a href="../index.php">HOME</a></li>
      <li><a href="../products.php?type=trending">TRENDING</a></li>
      <li><a href="../products.php?type=new">NEW PRODUCTS</a></li>
      <li><a href="../index.php">CATEGORIES</a></li>
    </ul>

    <div class="nav_buttons">
      <button class="btn_search" id="btn_search" onclick="toggleSearchBox()"></button>
      <button class="btn_user"></button>
      <button class="btn_cart"></button>
    </div>
  </nav>

  <script>
    $(".btn_cart").click(function() {
      window.location.href = "cart.php";
    });
    $(".btn_user").click(function() {
      window.location.href = "profile.php";
    });
  </script>
  <div class="content">