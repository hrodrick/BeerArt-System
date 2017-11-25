    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    $checked=($obj->getPermisos()==1)?'checked':'';
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
              <h2 class="t_blanco">&nbsp;Modificaci&oacute;n de Roles</h2>
              <p>&nbsp;</p>
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Rol/editado" method="post" name="form">
                              <p>&nbsp;</p>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Rol:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="rol" value="<?=$obj->getRol()?>" placeholder="Ingrese Rol" autofocus required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Descripci&oacute;n:&nbsp;</label>
                              <div class="col-xs-9">
                                   <textarea class="form-control" type="text" name="descripcion" rows="7" cols="50" placeholder="Ingrese Descripci&oacute;n"><?=$obj->getDescripcion()?></textarea>
                                   <p>&nbsp;</p>
                              </div>              

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Permisos:&nbsp;</label>
                              <div class="col-xs-9">
                                    <div class="radio">
                                      <label><input type="radio" name="permisos" value="1" <?=($obj->getPermisos()==1)?'checked':'';?>><span class="t_blanco">Control Total</span></label>
                                    </div>
                                    <div class="radio">
                                      <label><input type="radio" name="permisos" value="2" <?=($obj->getPermisos()==2)?'checked':'';?>><span class="t_blanco">Acceso Restringido</span></label>
                                    </div>
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