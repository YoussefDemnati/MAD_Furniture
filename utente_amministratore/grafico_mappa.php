
    <style>
    /* piccola furbata per far sparire il logo "mapbox" */
    .mapboxgl-ctrl-logo {
    display: none !important;
    }
    .mapboxgl-ctrl-bottom-right{
      display: none !important;
    }
    </style>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
    <div id='map' style='width: 90%; height: 600px; border:2px solid #4f4f4f;'></div>
    <canvas id='chart' style='display:none'></canvas>

    <script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FiYXp6YSIsImEiOiJjbGVzN3l2NTQxM3JpNDRydnhxMGlkOHE4In0.OyYYWu4daNGgU6Wl1Wpwrg';
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [12.50575740974683,41.88315307105061],
  zoom: 4.5
});

<?php 
$cities = [];
foreach(get_province($conn) as $provincia) {
    $name = $provincia['nome'];
    $coordinates = [$provincia['longitudine'], $provincia['latitudine']];
    $data = implode(get_number_users_provincia($conn, $provincia['id_pv']));
    $cities[] = ['name' => $name, 'coordinates' => $coordinates, 'data' => $data];
}

?>

var cities = <?php echo json_encode($cities); ?>;

cities.forEach(function(city) {

    var marker = new mapboxgl.Marker({
    color: "red", // Imposta il colore del marker
  })
  .setLngLat(city.coordinates) // Imposta la posizione del marker
    .setPopup(new mapboxgl.Popup({ offset: 25, backgroundColor: 'rgba(255,255,255,0.9)' })
    .setHTML(city.name + '<br>' + 'Utenti: ' + city.data)) // Aggiungi un popup al marker
    .addTo(map); // Aggiungi il marker alla mappa

var el = document.createElement('div');



new mapboxgl.Marker(el)
  .setLngLat(city.coordinates)
  .addTo(map);
});
    </script>