    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">  

        <div class="container text-center"> 
          <?php
              if ($totalCount==0) { ?>
                <h3><<<< NO HAY REGISTROS >>>></h3><br></td>
        </div><br>
          <?php }else{
              $cont=0;
              foreach ($cervezas as $value) {
                  $fotoTemp=(strlen($value->getFoto())==0)?'Choppenhauer.jpg':$value->getFoto();         
                  $cont++;
          ?>
          <div class="col-md-3" style="float:right">
            <div class="panel div_trans8">
              <div class="panel-body"><a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoTemp;?>" data-lightbox="galeria" data-title="<?= $value->getTipo();?><BR><?= $value->getDescripcion();?><BR>$<?=$value->getPrecioXLitro();?>"><img src="<?=DIR.URL_IMG_CER.'t1_'.$fotoTemp;?>" class="img-responsive" border="0" data-toggle="tooltip" title='Ver Foto' alt='<?= $value->getTipo();?>'></a></div>
              <div class="panel-heading t_blanco"><H3><?=$value->getTipo()?></H3>
                <p><?=$value->getDescripcion()?></p>  
                <H2 class="t_naranja">$<?=$value->getPrecioXLitro()?> x lt</H2>                
              </div>
              <div class="panel-footer div_trans5"><a href="<?=DIR?>Front/producto/<?=urlencode(base64_encode($value->getId()))?>" class="btn btn-warning" role="button"><span class="t_negro"><span class="glyphicon glyphicon-grain"></span> Ver Producto</a></span></div>
            </div>
          </div>          
          <?php
          if(($cont%3)==0){
            ?>
        </div><br>
          <?php 
          if($cont<$totalCount){
            ?>
        <div class="container text-center"> 
        <?php        
            }
          }
        }
      }
          ?>
        </div>
          </div>
            <?php
                include(URL_VISTA_FRONT."pie.php");
            ?> 
        </body>
