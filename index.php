<?php
include 'include\_header.inc.php';
?>
<div class="big_mama">
    <div>
        <span id="big_mama_sub">NEW ARRIVAL</span>

        <span id="big_mama_title">MINIMAL CHAIR</span>

        <span id="big_mama_desc">Take a look to some new minimal products.</span>

        <button>SHOP NOW</button>
    </div>
    <img src="./assets/img/minimal_chair.png" alt="">
</div>

<div class="home_volantino">
    <div class="promo">
        <div>
            <h2>TABLE LAMP</h2>
            <span>- 30% On  New Minimal Table Lamp  </span>
            <a href="">View Product</a>
        </div>
        <img src="./assets/img/table_lamp.png" alt="">
    </div>
    <div class="promo">
        <div>
            <h2>TABLE LAMP</h2>
            <span>- 30% On  New Minimal Table Lamp  </span>
            <a href="">View Product</a>
        </div>
        <img src="./assets/img/table_lamp.png" alt="">
    </div>
    <div class="promo">
        <div>
            <h2>TABLE LAMP</h2>
            <span>- 30% On  New Minimal Table Lamp  </span>
            <a href="">View Product</a>
        </div>
        <img src="./assets/img/table_lamp.png" alt="">
    </div>
    <div class="promo">
        <div>
            <h2>TABLE LAMP</h2>
            <span>- 30% On  New Minimal Table Lamp  </span>
            <a href="">View Product</a>
        </div>
        <img src="./assets/img/table_lamp.png" alt="">
    </div>
</div>

<p class="subtitle">Most Bought Products of The Week</p>
<h1 class="title">TRENDING PRODUCTS</h1>

<div class="home_trending">
    <div class="home_trending_product">
        <div>
            <img src="./assets/img/lampada.png" alt="">
        </div>
        <img src="./assets/img/stars/star_4.png" alt="">
        <p>Vintage Table Lamp in Wood and Metal</p>
        <span>36.98 $</span>
    </div>
    <div class="home_trending_product">
        <div>
            <img src="./assets/img/lampada.png" alt="">
        </div>
        <img src="./assets/img/stars/star_4.png" alt="">
        <p>Vintage Table Lamp in Wood and Metal</p>
        <span>36.98 $</span>
    </div>
    <div class="home_trending_product">
        <div>
            <img src="./assets/img/lampada.png" alt="">
        </div>
        <img src="./assets/img/stars/star_4.png" alt="">
        <p>Vintage Table Lamp in Wood and Metal</p>
        <span>36.98 $</span>
    </div>
    <div class="home_trending_product">
        <div>
            <img src="./assets/img/lampada.png" alt="">
        </div>
        <img src="./assets/img/stars/star_4.png" alt="">
        <p>Vintage Table Lamp in Wood and Metal</p>
        <span>36.98 $</span>
    </div>
    <div class="home_trending_product">
        <div>
            <img src="./assets/img/lampada.png" alt="">
        </div>
        <img src="./assets/img/stars/star_4.png" alt="">
        <p>Vintage Table Lamp in Wood and Metal</p>
        <span>36.98 $</span>
    </div>
    <div class="home_trending_product">
        <div>
            <img src="./assets/img/lampada.png" alt="">
        </div>
        <img src="./assets/img/stars/star_4.png" alt="">
        <p>Vintage Table Lamp in Wood and Metal</p>
        <span>36.98 $</span>
    </div>
</div>

<a id="home_see_more_trending" href="#">See More...</a>

<p class="subtitle">Take a look to all the available categories</p>
<h1 class="title">CATEGORIES</h1>

<div class="home_categories_container">
    <button id="go-left">     </button>
    <div class="home_categories">
        <div class="carousell-wrapper">
            <div class="home_category"> 
            <div>
                <h2>Kitchen</h2>
                <span>products for the kitchen</span>
                <a href="">View Category</a>
            </div>
            <img src="./assets/img/kitchen.png" alt="">
            </div>
            <div class="home_category"> 
            <div>
                <h2>Kitchen</h2>
                <span>products for the kitchen</span>
                <a href="">View Category</a>
            </div>
            <img src="./assets/img/kitchen.png" alt="">
            </div>
            <div class="home_category"> 
            <div>
                <h2>Kitchen</h2>
                <span>products for the kitchen</span>
                <a href="">View Category</a>
            </div>
            <img src="./assets/img/kitchen.png" alt="">
            </div>
            <div class="home_category"> 
            <div>
                <h2>Kitchen</h2>
                <span>products for the kitchen</span>
                <a href="">View Category</a>
            </div>
            <img src="./assets/img/kitchen.png" alt="">
            </div>
            <div class="home_category"> 
            <div>
                <h2>Kitchen</h2>
                <span>products for the kitchen</span>
                <a href="">View Category</a>
            </div>
            <img src="./assets/img/kitchen.png" alt="">
            </div>
            <div class="home_category"> 
            <div>
                <h2>Kitchen</h2>
                <span>products for the kitchen</span>
                <a href="">View Category</a>
            </div>
            <img src="./assets/img/kitchen.png" alt="">
            </div>
            <div class="home_category"> 
            <div>
                <h2>Kitchen</h2>
                <span>products for the kitchen</span>
                <a href="">View Category</a>
            </div>
            <img src="./assets/img/kitchen.png" alt="">
            </div>
        </div>
    </div>
    <button id="go-right">     </button>
</div>
    

<script>
  var container = document.querySelector('.home_categories');
  var buttonLeft = document.querySelector('#go-left');
  var buttonRight = document.querySelector('#go-right');

  buttonLeft.addEventListener('click', function() {
    sideScroll(container,'left',25,200,20);
  });
  
  buttonRight.addEventListener('click', function() {
    sideScroll(container,'right',25,200,20);
  });

  function sideScroll(element,direction,speed,distance,step){
    var scrollAmount = 0;
    var slideTimer = setInterval(function(){
      if(direction == 'left'){
        element.scrollLeft -= step;
      } else {
        element.scrollLeft += step;
      }
      scrollAmount += step;
      if(scrollAmount >= distance){
        window.clearInterval(slideTimer);
      }
    }, speed);
  }
</script>


<?php
include 'include\_footer.inc.php';
?>
>>>>>>> fe1931db6d7f05e48e93ae3235299bcee018e379
