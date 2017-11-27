    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>" onload="domi();">
        
        <script type="text/javascript" src="<?= DIR.URL_JS ?>google-maps.js" charset="utf-8"></script>

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

                              <div id="sucursal" style="display:none">
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Sucursal:&nbsp;</label>
                              <div class="col-xs-9">
                                    <select name="suc" class="form-control" id="select" onchange="codeAddress()">
                                      <?php
                                      foreach ($sucursales as $value) {
                                          echo '<option value='.$value->getId().'>'.$value->getNombre().' - '.$value->getDomicilio().'</option>';
                                      }?>
                                    </select>
                                    <p>&nbsp;</p>
                              </div>             
                               
                              </div>
                            
                            <div id="map"  align="center" style="height: 300px;
                                                                width: 100%;" ></div> 
          
                            <p>&nbsp;</p>
                            <div id="fechaEntrega">
                              <label class="control-label col-xs-2 t_blanco" for="inputForm"> Fecha de entrega:&nbsp; </label>
                              <div class="col-xs-9">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar text-warning"></i></span>
                                  <input type="date" class="form-control input-lg" value='<?= date('Y-m-d')?>' name="fechaEntrega" required>
                              </div>
                            </div>
                            <p>&nbsp;</p>
                            <div id="horarioEntrega">
                              <label class="control-label col-xs-2 t_blanco" for="inputForm"> Horario de entrega:&nbsp; </label>
                              <div class="col-xs-9">
                                  <input type="time" class="form-control input-lg" name="horarioEntrega" required>
                              </div>
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
                  divDom=document.getElementById('domicilio');
                  divDom.style.display='';
                  divSuc=document.getElementById('sucursal');
                  divSuc.style.display='none';
                  document.form.dom.value="<?= $_SESSION['cliente']->getDomicilio()?>";
                  document.form.suc.selectedIndex="-1";                    
                }
                else{
                  divDom=document.getElementById('domicilio');
                  divDom.style.display='none';    
                  divSuc=document.getElementById('sucursal');                             
                  divSuc.style.display='';
                  document.form.dom.value='';
                  document.form.suc.value=<?=$sucursales[1]->getId()?>;
                  document.form.suc.selectedIndex="1";                
                }
            }

            

          </script>                 
              </div>  
            </div> <!-- /container -->
        </div>
    <BR><BR><BR><BR>
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATADjGhTAzoJCuKIL9yplek_UDeCYfvUE&callback=initMap">
            </script>
            <?php
                include(URL_VISTA_FRONT."pie.php");
            ?> 
        </body>
        

