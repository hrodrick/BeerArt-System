    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">      

          <p>&nbsp;</p>
          <div class="contenedor div_trans5 text-center">
            <h4 class="t_blanco">&nbsp;<?= $msg;?></h4>
          </div>   
            </div> <!-- /container -->
        </div>
    <BR><BR>
            <?php
                include(URL_VISTA_FRONT."pie.php");
            ?> 
        </body>