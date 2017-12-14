    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
              <h2 class="t_blanco">&nbsp;Alta de Sucursales</h2>
              <p>&nbsp;</p>
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Sucursal/nuevo" method="post" name="form">

                              <?php
                              if(isset($obj)&&(is_object($obj))){
                              ?>
                              <div class="col-xs-12 alert alert-danger text-center">
                                   <strong>Sucursal existente!!</strong> Elija otro nombre!!
                              </div>
                              <?php
                              }
                              if(isset($msg)){
                              ?>
                                <div class="col-xs-12 alert alert-warning text-center">
                                     <strong><?=$msg;?></strong>
                                </div>                            
                                <?php
                              }?>                     
                              <p>&nbsp;</p>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Nombre:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="nombre" value="<?=$nombre?>" placeholder="Ingrese Nombre de Sucursal" autofocus required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Domicilio:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="domicilio" value="<?=$domicilio?>" placeholder="Ingrese Domicilio">
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Localidad:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="localidad" value="<?=$localidad?>" placeholder="Ingrese Localidad" required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Tel&eacute;fono:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="tel" name="telefono" value="<?=$telefono?>" placeholder="Ingrese Tel&eacute;fono">
                                   <p>&nbsp;</p>
                              </div>                      

                              <div class="col-xs-12 text-center">                  
                                  <button type="submit" class="btn btn-warning">Agregar</button>
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
