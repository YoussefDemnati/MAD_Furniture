
<!DOCTYPE html>
<html>
  <head>
    <style>
    /* piccola furbata per far sparire il logo "mapbox" */
    .mapboxgl-ctrl-logo {
    display: none !important;
    }
    </style>
    <meta charset="UTF-8">
    <title>Mappa personalizzata con Chart.js e Mapbox</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
  </head>
  <body>
    <div id='map' style='width: 800px; height: 500px;'></div>
    <canvas id='chart' style='display:none'></canvas>
    <script>
      // Crea la mappa
mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FiYXp6YSIsImEiOiJjbGVzN3l2NTQxM3JpNDRydnhxMGlkOHE4In0.OyYYWu4daNGgU6Wl1Wpwrg';
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [12.50575740974683,41.88315307105061],
  zoom: 4.5
});
var cities = [
        { name: 'Milano', coordinates: [9.1900, 45.4642] },
        { name: 'Roma', coordinates: [12.4964, 41.9028] },
        { name: 'Napoli', coordinates: [14.2681, 40.8518] },
        { name: 'Palermo', coordinates: [13.3613, 38.1157] }
      ];


cities.forEach(function(city) {

    var marker = new mapboxgl.Marker({
    color: "red", // Imposta il colore del marker
  })
  .setLngLat(city.coordinates) // Imposta la posizione del marker
    .setPopup(new mapboxgl.Popup({ offset: 25, backgroundColor: 'rgba(255,255,255,0.9)' })
    .setHTML(city.name + '<br>' + '4.140')) // Aggiungi un popup al marker
    .addTo(map); // Aggiungi il marker alla mappa

var el = document.createElement('div');



new mapboxgl.Marker(el)
  .setLngLat(city.coordinates)
  .addTo(map);
});
    </script>
  </body>
</html>