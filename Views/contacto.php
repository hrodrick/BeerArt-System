    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">
              <h2 class="t_blanco">&nbsp;Contacto</h2>
              <p>&nbsp;</p>
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Front/contacto" method="post" name="form">
                              <p>&nbsp;</p>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Nombre:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="nombre" placeholder="Ingrese su Nombre" autofocus required>
                                   <p>&nbsp;</p>
                              </div>

                              <p>&nbsp;</p>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">E-Mail:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="email" placeholder="Ingrese su E-Mail" autofocus required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Consulta:&nbsp;</label>
                              <div class="col-xs-9">
                                   <textarea class="form-control" type="text" name="consulta" rows="7" cols="50" placeholder="Ingrese su Consulta"></textarea>
                                   <p>&nbsp;</p>
                              </div>                      

                              <div class="col-xs-12 text-center">
                                  <button type="submit" class="btn btn-warning">Enviar</button>
                                  <p>&nbsp;</p>
                              </div>                    
                   </form>
              </div>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include(URL_VISTA_FRONT."pie.php");
            ?>      
    </body> 
