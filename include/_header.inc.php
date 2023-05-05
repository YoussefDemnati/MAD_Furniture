<!DOCTYPE html>
<html lang="en">
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
  <nav>
    <div class="logo">
      <img src="./assets/img/logo.png" alt="Logo">
    </div>

    <ul class="links">
      <li><a href="#">HOME</a></li>
      <li><a href="products.php?type=trending">TRENDING</a></li>
      <li><a href="products.php?type=new">NEW PRODUCTS</a></li>
      <li><a href="" onclick="scrollToDiv()">CATEGORIES</a></li>
    </ul>

    <div class="nav_buttons">
      <div class="search-box" id="search-box" style="display: none">
        <input type="text" id="search-query">
        <button onclick="searchProducts()"></button>
      </div>
      <button class="btn_search" id="btn_search" onclick="toggleSearchBox()"></button>
      <button class="btn_user"></button>
      <button class="btn_cart"></a></button>

    </div>
  </nav>

  <script>
    const searchBox = document.getElementById("search-box");
    const searchQuery = document.getElementById("search-query");
    const btn_search = document.getElementById("btn_search");
    $(".btn_cart").click(function() {
      window.location.href = "./utente_registrato/cart.php";
    });
    $(".btn_user").click(function() {
      window.location.href = "./utente_registrato/profile.php";
    });

    function toggleSearchBox() {
      if (searchBox.style.display === "none") {
        searchBox.style.display = "flex";
        btn_search.style.display = "none"
        document.addEventListener("click", hideSearchBox);
        document.addEventListener("keydown", hideSearchBox);
      } else {
        searchBox.style.display = "none";
        btn_search.style.display = "inline-block";
        document.removeEventListener("click", hideSearchBox);
        document.removeEventListener("keydown", hideSearchBox);
      }
    }

    function searchProducts() {
      const query = searchQuery.value.trim();
      if (query) {
        window.location.href = `products.php?search_query=${query}`;
      }
    }

    function hideSearchBox(event) {
      if (
        event &&
        event.type === "click" &&
        !searchBox.contains(event.target) &&
        event.target !== document.getElementById("btn_search")
      ) {
        searchBox.style.display = "none";
        btn_search.style.display = "inline-block";
        document.removeEventListener("click", hideSearchBox);
        document.removeEventListener("keydown", hideSearchBox);
      } else if (event && event.type === "keydown" && event.key === "Escape") {
        searchBox.style.display = "none";
        btn_search.style.display = "inline-block";
        document.removeEventListener("click", hideSearchBox);
        document.removeEventListener("keydown", hideSearchBox);
      }
    }

    function scrollToDiv() {
      const targetDiv = document.getElementById("categories");
      const topOffset = 100; // Imposta l'offset desiderato
      const targetPosition = targetDiv.getBoundingClientRect().top + window.pageYOffset - topOffset;

      window.scrollTo({
        top: targetPosition,
        behavior: "smooth"
      });
    }
  </script>
  <div class="content">