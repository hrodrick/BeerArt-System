    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG?><?php echo $imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
                <h1 class="t_blanco">&nbsp;<b>Choppenhauer</b> <small>Cerveza Artesanal </small></h1>
                <h2 class="t_blanco">&nbsp;Panel de Control</h2>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include(URL_VISTA_BACK."pie.php");
            ?>      
    </body>