    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
              <h2 class="t_blanco">&nbsp;Modificaci&oacute;n de Sucursales</h2>
              <p>&nbsp;</p>
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Sucursal/editado" method="post" name="form">
                              <p>&nbsp;</p>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Nombre:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="nombre" value="<?=$obj->getNombre()?>" placeholder="Ingrese Nombre de Sucursal" autofocus required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Domicilio:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="domicilio" value="<?=$obj->getDomicilio()?>" placeholder="Ingrese Domicilio">
                                   <p>&nbsp;</p>
                              </div>         

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Localidad:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="localidad" value="<?=$obj->getLocalidad()?>" placeholder="Ingrese Localidad" required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Tel&eacute;fono:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="tel" name="telefono" value="<?=$obj->getTelefono()?>" placeholder="Ingrese Tel&eacute;fono">
                                   <p>&nbsp;</p>
                              </div>        

                              <div class="col-xs-12 text-center">                  
                                  <input type="hidden" name="page" value="<?=$page?>">
                                  <input type="hidden" name="campo" value="<?=$campo?>">
                                  <input type="hidden" name="orden" value="<?=$orden?>">
                                  <input type="hidden" name="id" value="<?=$obj->getId()?>">
                                  <input type="hidden" name="standBy" value="<?=$obj->getStandBy()?>">
                                  <button type="submit" class="btn btn-warning">Modificar</button>
                                  <p>&nbsp;</p>
                              </div>                    
                   </form>
              </div>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>      
