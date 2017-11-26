    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
                  <h2 class="t_blanco">&nbsp;Alta de Cervezas</h2>
                  <p>&nbsp;</p>
                  <div class="contenedor div_trans5">
                       <form class="form-horizontal" action="<?=DIR?>Cerveza/nuevo" method="post" name="form" enctype="multipart/form-data">

                              <?php
                              if(isset($obj)&&(is_object($obj))){
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
                               <input class="form-control" type="text" name="cerveza" value="<?=$cerveza?>" placeholder="Ingrese Tipo de Cerveza" autofocus required>
                               <p>&nbsp;</p>
                          </div>
                          
                          <label class="control-label col-xs-2 t_blanco" for="inputForm">Descripci&oacute;n:&nbsp;</label>
                          <div class="col-xs-9">
                               <textarea class="form-control" type="text" name="descripcion" rows="7" cols="50" placeholder="Ingrese Descripci&oacute;n"><?=$descripcion?></textarea>
                               <p>&nbsp;</p>
                          </div>   

                          <label class="control-label col-xs-2 t_blanco" for="inputForm">Precio:&nbsp;</label>
                          <div class="col-xs-9">
                               <input class="form-control" type="number" name="precioXLitro" value="<?=$precioXLitro?>" placeholder="Ingrese Precio por Litro" pattern="^[0-9]{1,3}$">
                               <p>&nbsp;</p>
                          </div>

                          <label class="control-label col-xs-2 t_blanco" for="inputForm">Foto:&nbsp;</label>
                          <div class="col-xs-9">
                               <input class="form-control" type="file" accept=".jpg" name="foto">
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