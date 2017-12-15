    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>" onload="domi()">
         
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">      
          <h2 class="t_blanco">&nbsp;Confirmar Pedido de <span class="t_naranja">$<?= number_format($_SESSION['pedido']->getTotal(),2,',','.')?></span></h2>
          <p>&nbsp;</p>
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Pedido/nuevo" method="post" name="form">
                
                              <p>&nbsp;</p>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Lugar:&nbsp;</label>
                              <div class="col-xs-9">
                                    <div class="radio">
                                      <label><input type="radio" name="lugar" value="1" onChange="domi()" checked><span class="t_blanco">Entrega a Domicilio</span></label>
                                    </div>
                                    <div class="radio">
                                      <label><input type="radio" name="lugar" value="2" onChange="domi()"><span class="t_blanco">Retiro en Sucursal</span></label>
                                    </div>
                                   <p>&nbsp;</p>
                              </div>      

                              <div id="domicilio" style="display:none">
                                <label class="control-label col-xs-2 t_blanco" for="inputForm">Domicilio:&nbsp;</label>
                                <div class="col-xs-9">
                                     <input class="form-control" type="text" name="dom">
                                     <p>&nbsp;</p>
                                </div>
                              </div>

                              <div id="horario" style="display:none">
                                <label class="control-label col-xs-2 t_blanco" for="inputForm">Franja horaria de Entrega:&nbsp;</label>
                                <div class="col-xs-9">
                                      <div class="radio">
                                        <label><input type="radio" name="horario" value="0" checked><span class="t_blanco">Por la ma&ntilde;ana de 09:00 a 13:00 hs.</span></label>
                                      </div>
                                      <div class="radio">
                                        <label><input type="radio" name="horario" value="1"><span class="t_blanco">Por la tarde de 15:00 a 18:00 hs.</span></label>
                                      </div>
                                     <p>&nbsp;</p>
                                </div>  
                              </div>

                              <div id="sucursal" style="display:none">
                                <label class="control-label col-xs-2 t_blanco" for="inputForm">Sucursal:&nbsp;</label>
                                <div class="col-xs-9">
                                      <select name="suc" class="form-control" id="selectSucs" 
                                              onchange="codeAddressBySelectedOption();">
                                        <?php
                                        foreach ($sucursales as $value) {
                                            echo '<option value='.$value->getId().' id="'.$value->getDomicilio().', '.$value->getLocalidad().'" >'
                                                  .$value->getNombre().' - '.$value->getDomicilio().
                                              '</option>';
                                        }?>
                                      </select>                                  
                                </div>
                              </div>
                                                   
                              <!-- <div id="mapa" style="display:none"> -->
                              <div id="mapa" style="display:none;">
                                   <div class="col-xs-4">&nbsp;</div>
                                   <!-- <div id="map" class="col-xs-8" style="height: 300px; width: 100%;" ></div> -->
                                   <div id="map" style="height: 300px; width: 100%;"> </div>
                                    <p>&nbsp;</p>                                 
                              </div>

                              <div class="col-xs-12 text-center">
                                  <p>&nbsp;</p>
                              </div>                                

                              <div class="col-xs-12 text-center">
                                  <input type="hidden" name="idSuc" value="1">
                                  <button type="submit" class="btn btn-warning">Terminar Compra</button>
                                  <p>&nbsp;</p>
                              </div>                                  
            
                   </form>
          <script type="text/javascript">
            function domi(){
                if (document.form.lugar[0].checked) {
                  document.getElementById('domicilio').style.display='';
                  document.getElementById('horario').style.display='';
                  document.getElementById('sucursal').style.display='none';
                  document.getElementById('mapa').style.display='none';                  
                  document.form.dom.value="<?= $_SESSION['usuario']->getDomicilio()?>";
                  document.form.suc.selectedIndex="-1";                    
                }
                else{
                  document.getElementById('domicilio').style.display='none';    
                  document.getElementById('horario').style.display='none';    
                  document.getElementById('sucursal').style.display='block';
                  document.getElementById('mapa').style.display='block';
                  document.form.dom.value='';
                  document.form.suc.value=<?=$sucursales[1]->getId()?>;
                  document.form.suc.selectedIndex="1";     
                  initMap();
                  <?php
                    foreach ($sucursales as $sucursal) {
                  ?>
                      geoCodeAddress( "<?=$sucursal->getDomicilio().', '.$sucursal->getLocalidad()?>");
                  <?php
                    }
                  ?>
                  
                }
            }            
          </script>                   
              </div>  
            </div> <!-- /container -->
        </div>
    <BR><BR><BR><BR>
            <?php

                include(URL_VISTA_FRONT."pie.php");
            ?> 
        </body>
     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATADjGhTAzoJCuKIL9yplek_UDeCYfvUE"></script> 
    <script src="<?=DIR.URL_JS?>google-maps.js" type="text/javascript"></script>
    <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5-j4JtjfJ33vcWn0iG9ZiY-WvTT7ifrE"></script> -->

