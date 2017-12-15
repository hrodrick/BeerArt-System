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
        
      }

      function setMarkerAndCenter(latLng, address){
        
        var marker = new google.maps.Marker({
          position: latLng,
          map: map,
        });
        setMarkerTitle(marker, address);

        map.setCenter(latLng);
        //Agrega la posicion del marcado al array para luego no volver a generarlo si ya existe.
        actualPositions.push([latLng]);
      }

      function setMarkerTitle(marker, address){
        //crea una ventana de informacion para el marcador con la direccion como contenido.
        var infowindow = new google.maps.InfoWindow({
             content: address
            });

        //crea un listener para que cuando el mouse pase por encima muestre el infowindow.
        marker.addListener('mouseover', function() {
            infowindow.open(marker.get('map'), marker);
          });
        //crea un listener para que cuando el mouse salga del marcador se cierre la infowindow.
        marker.addListener('mouseout', function(){
          
            infowindow.close();
          });

      }


      // Geo codifica la direccion y la envia al metodo setMarkerAndCenter junto con la direccion.

      function geoCodeAddress(address){
        geocoder.geocode( { 'address': address}, function(results, status) {
          console.log('direccion: ' + address);
          //si el estado de la llamado es OK
          if (status == google.maps.GeocoderStatus.OK) {
              
            //Verigica que el marcador no exista.
            latLng = results[0].geometry.location;
            if(isLocationFree(latLng)){
              setMarkerAndCenter(latLng, address);
            }else{
              map.setCenter(latLng);
            }

          } else {
              //si no es OK devuelvo error
              alert("No podemos encontrar la direccion, error: " + status);
          }
        });
      }

      //Toma la opcion del select y la envia a GeoCodeAddress()

       function codeAddressBySelectedOption() {
         
        //Obtengo el select del formulario.
        var select = document.getElementById("selectSucs");
        //obtengo la direccion de la sucursal del formulario
        var  address = select.options[select.selectedIndex].id;

        console.log('direccion: ' + address);
        
        //hago la llamada al geodecoder
        geoCodeAddress(address);
      }


      //TODO test if works. Verifica que el marcador exista en la ubicacion especifica
      function isLocationFree(latLng){
          
          for (var i = actualPositions.length - 1; i >= 0; i--) {
            
            if (actualPositions[i][0] === latLng[0] && actualPositions[i][1] === latLng[1]) {
              return false;              
            }
          }
          return true;
      }
