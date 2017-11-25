    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
                  <h2 class="t_blanco">&nbsp;Modificaci&oacute;n de Cervezas</h2>
                  <p>&nbsp;</p>
                  <div class="contenedor div_trans5">
                       <form class="form-horizontal" action="<?=DIR?>Cerveza/editado" method="post" name="form" enctype="multipart/form-data">

                                  <?php
                                  if($error){
                                  ?>
                                  <label class="control-label col-xs-2 t_blanco" for="inputForm"></label>
                                  <div class="col-xs-9 alert alert-danger text-center">
                                       <strong>Cerveza existente!!</strong> Elija otro tipo!!
                                  </div>
                                  <?php
                                }?>

                                  <p>&nbsp;</p>
                                  <label class="control-label col-xs-2 t_blanco" for="inputForm">Tipo:&nbsp;</label>
                                  <div class="col-xs-9">
                                       <input class="form-control" type="text" name="cerveza" value="<?=$obj->getTipo()?>" autofocus required>
                                       <p>&nbsp;</p>
                                  </div>

                                  <label class="control-label col-xs-2 t_blanco" for="inputForm">Descripci&oacute;n:&nbsp;</label>
                                  <div class="col-xs-9">
                                       <textarea class="form-control" type="text" name="descripcion" rows="7" cols="50"><?=$obj->getDescripcion()?></textarea>
                                       <p>&nbsp;</p>
                                  </div>  

                                  <label class="control-label col-xs-2 t_blanco" for="inputForm">Precio:&nbsp;</label>
                                  <div class="col-xs-9">
                                       <input class="form-control" type="number" name="precioXLitro" value="<?=$obj->getPrecioXLitro()?>" pattern="^[0-9]{1,3}$">
                                       <p>&nbsp;</p>
                                  </div>

                                  <label class="control-label col-xs-2 t_blanco" for="inputForm">Foto:&nbsp;</label>
                                  <div class="col-xs-9">
                                       <input class="form-control" type="file" accept="image/jpg" name="foto">
                                       <p>&nbsp;</p>
                                  </div>
          

                                       <?php
                                       $fotoTemp=$obj->getFoto();
                                       if(!empty($fotoTemp)){
                                       ?>
                                  <div class="col-xs-12 text-center">
                                       <a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoTemp;?>" data-lightbox="galeria" data-title="Foto" data-toggle="tooltip" title="Ver Foto"><img src="<?=DIR.URL_IMG_CER.'t2_'.$fotoTemp;?>" border="0"></a>&nbsp;<a href="<?=DIR.'Cerveza/eliminoFoto/'.$obj->getId().'/'.$page.'/'.$campo.'/'.$orden.'/'.$obj->getFoto();?>" data-toggle="tooltip" title="Eliminar Foto">&nbsp;<img src="<?=DIR.URL_IMG?>tacho.png"></a>                                 
                                       <p>&nbsp;</p>
                                  </div>
                                       <?php
                                        }
                                       ?>  
                                  <div class="col-xs-12 text-center">
                                      <input type="hidden" name="page" value="<?=$page?>">
                                      <input type="hidden" name="campo" value="<?=$campo?>">
                                      <input type="hidden" name="orden" value="<?=$orden?>">
                                      <input type="hidden" name="id" value="<?=$obj->getId()?>">
                                      <input type="hidden" name="standBy" value="<?=$obj->getStandBy()?>">
                                      <input type="hidden" name="fotoOld" value="<?=$obj->getFoto()?>">
                                      <input type="hidden" name="cervezaOld" value="<?=$obj->getTipo()?>">
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
