//variables que uso
var lat = null;
var long = null; 
var actualPositions = [];
var map = null;
var geocoder = null;
var marker = null;



function initMap() {
        geocoder = new google.maps.Geocoder();
        var uluru = {lat: -38.04, lng: -57.55};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        
      }

      function setMarkerAndCenter(latLng){
        
        var marker = new google.maps.Marker({
          position: latLng,
          map: map
        });
        map.setCenter(latLng);
        actualPositions.push([latLng]);
      }

       function codeAddress() {
         
        //obtengo la direccion de la sucursal del formulario
        var address = document.getElementById("select").name;
        //hago la llamada al geodecoder
        geocoder.geocode( { 'address': address}, function(results, status) {
           
          //si el estado de la llamado es OK
          if (status == google.maps.GeocoderStatus.OK) {
              
            latLng = results[0].geometry.location;
            if(isLocationFree(latLng)){
              setMarkerAndCenter(latLng);
            }else{
              map.setCenter(latLng);
            }

          } else {
              //si no es OK devuelvo error
              alert("No podemos encontrar la direcci&oacute;n, error: " + status);
          }
        });
      }

      function isLocationFree(latLng){
          
          for (var i = actualPositions.length - 1; i >= 0; i--) {
            
            if (actualPositions[i][0] === latLng[0] && actualPositions[i][1] === latLng[1]) {
              return false;
              
            }
          }
          return true;
      }

