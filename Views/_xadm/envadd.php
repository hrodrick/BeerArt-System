    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
              <h2 class="t_blanco">&nbsp;Alta de Envases</h2>
              <p>&nbsp;</p>
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Envase/nuevo" method="post" name="form" enctype="multipart/form-data">

                              <?php
                              if(isset($obj)&&(is_object($obj))){
                              ?>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm"></label>
                              <div class="col-xs-9 alert alert-danger text-center">
                                   <H4>ERROR!!! Envase existente!!</H4>
                              </div>
                              <?php
                            }?>                       
                      <p>&nbsp;</p>

                      <label class="control-label col-xs-2 t_blanco" for="inputForm">Tipo:&nbsp;</label>
                      <div class="col-xs-9">
                           <input class="form-control" type="text" name="tipo" value="<?=$tipo?>" placeholder="Ingrese Tipo de Envase" autofocus required>
                           <p>&nbsp;</p>
                      </div>

                      <label class="control-label col-xs-2 t_blanco" for="inputForm">Capacidad:&nbsp;</label>
                      <div class="col-xs-9">
                           <input class="form-control" type="number" step="0.01" name="capacidad" value="<?=$capacidad?>" placeholder="Ingrese Capacidad">
                           <p>&nbsp;</p>
                      </div>

                      <label class="control-label col-xs-2 t_blanco" for="inputForm">Coeficiente:&nbsp;</label>
                      <div class="col-xs-9">
                           <input class="form-control" type="number" step="0.01" name="coeficiente" value="<?=$coeficiente?>" placeholder="Ingrese Coeficiente">
                           <p>&nbsp;</p>
                      </div>              

                      <label class="control-label col-xs-2 t_blanco" for="inputForm">Foto:&nbsp;</label>
                      <div class="col-xs-9">
                           <input class="form-control" type="file" accept="image/jpg" name="foto">
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