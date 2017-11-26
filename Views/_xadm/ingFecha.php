    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
            <h2 class="t_blanco">&nbsp;Listado de Pedidos por Fecha</h2>
            <div class="container">
              <p>&nbsp;</p>
              <div class="contenedor div_trans5 text-center">
                <form class="form" method="post" action="<?=DIR?>Pedido/pedidosPorFecha">

                      <p>&nbsp;</p>

                      <div class="input-group col-xs-3 div-center">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-calendar text-warning"></i></span>
                           <input type="date" class="form-control input-lg" value='<?= date('Y-m-d')?>' name="fecha" required autofocus>
                      </div>

                      <p>&nbsp;</p>

                      <div class="input-group col-xs-3 div-center">
                          <button class="btn btn-lg btn-warning btn-block" type="submit">Enviar</button>
                      </div>
               </form>
              <BR><BR><BR>
              </div>
            </div> <!-- /container -->
        </div>
            <?php
                include("pie.php");
            ?>      
    </body>      
