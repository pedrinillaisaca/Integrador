<!DOCTYPE html>
<html style="height:100%">
  <head>
    <title>Trazar rutas en Google Maps</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
      html, body{
        height:100%;
        margin: 0px;
      }
      #googleMap{
        width:100%;
        height:100%;
      }
    </style>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      function initialize() {
      // Configuración del mapa
      var mapProp = {
       zoom: 3,

       

      center: {lat: -2.95611390, lng: -78.9843250},
      mapTypeId: google.maps.MapTypeId.TERRAIN
      };
      // Agregando el mapa al tag de id googleMap
      var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        
      // Coordenada de la ruta (desde Misiones hasta Tierra del Fuego)
      var flightPlanCoordinates = [
        {lat: -2.8074398, lng: -78.9888051}
      ];
       
      // Información de la ruta (coordenadas, color de línea, etc...)
      var flightPath = new google.maps.Polyline({
        path: flightPlanCoordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
      });
       
      // Creando la ruta en el mapa
      flightPath.setMap(map);
      }
        
      // Inicializando el mapa cuando se carga la página
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="googleMap"></div>
  </body>
</html>
