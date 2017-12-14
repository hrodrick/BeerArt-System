    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";  
    ?>
 
    <body background="<?=DIR.URL_IMG.$imagen;?>">      
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">
              <h2 class="t_blanco">&nbsp;Registro de Cliente</h2>
              <p>&nbsp;</p>
             
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Front/inicio" method="post" name="form">

                              <p>&nbsp;</p>
                              <H2 class="text-center t_blanco">Se registr&oacute; con &eacute;xito</H2>
                              <p>Controle su correo para habilitar su cuenta.</p>
                              <p>&nbsp;</p>                              
                              <div class="col-xs-12 text-center">  
                                  <button type="submit" class="btn btn-warning">Continuar</button>
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
