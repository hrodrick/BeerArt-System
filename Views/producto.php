    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">  


          <?php
                  $fotoTemp=(strlen($cerveza->getFoto())==0)?'Choppenhauer.jpg':$cerveza->getFoto();         
          ?>
        <div class="row div_trans8"> 
            <div class="col-md-3 text-center">
              <div class="panel div_trans2">
                <div class="panel-heading"><a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoTemp;?>" data-lightbox="galeria" data-title="<?= $cerveza->getTipo();?><BR><?= $cerveza->getDescripcion();?><BR>$<?=$cerveza->getPrecioXLitro();?>"><img src="<?=DIR.URL_IMG_CER.'t1_'.$fotoTemp;?>" class="img-responsive" border="0" data-toggle="tooltip" title='Ver Foto' alt='<?= $cerveza->getTipo();?>'></a></div>
                <div class="panel-body t_blanco"><H3><?=$cerveza->getTipo()?></H3>
                  <p><?=$cerveza->getDescripcion()?></p>                
                </div>
                <div class="panel-footer div_trans2"><H2 class="t_naranja">$<?=$cerveza->getPrecioXLitro()?> x lt</H2></div>
              </div>
            </div>



            <div class="col-md-9 text-left">
              <div class="panel div_trans2">
                <div class="panel-heading t_blanco"><H3>Envases</H3></div>
                <div class="panel-body t_blanco">                
                <table class="table">
                  <thead>
                    <tr class="t_naranja">
                      <th width="8%"></th>
                      <th width="17%">Envase</th>
                      <th width="10%">Capacidad</th>
                      <th width="10%">Importe</th>
                      <th width="10%">Cantidad</th>
                      <th width="15%">Sub-Total</th>
                      <th width="30%"></th>
                    </tr>
                  </thead>
                  <tbody>
      <?php
      $envases=$cerveza->getEnvases();
      foreach ($envases as $valor) {
        $fotoEnvTemp=(strlen($valor->getFoto())==0)?$valor->getTipo().'.jpg':$valor->getFoto();
        $precio=$valor->getCoeficiente()*$cerveza->getPrecioXLitro();
        ?>      
</script>      
          <form name="envases<?=$valor->getId()?>" method="post" action="<?=DIR?>Pedido/addCart/">  
              <tr>
                <td align="center"><a href="<?=DIR.URL_IMG_ENV.'tp_'.$fotoEnvTemp;?>" data-lightbox="galeria" data-title="<?= $valor->getTipo();?>"><img src="<?=DIR.URL_IMG_ENV.'t2_'.$fotoEnvTemp;?>" class="img-circle img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto' alt="<?= $valor->getTipo();?>"></a></td>
                <td class="t_blanco"><?= $valor->getTipo();?></td>
                <td class="t_blanco" align="right"><?= number_format($valor->getCapacidad(),2,',','.');?> lts.</td>                        
                <td align="right"><label class="form-control">$<?= number_format($precio,2,',','.');?></label></td>                        
                <td align="right"><input type="number" class="form-control col-sm-3" min=0 name="cant" id="cant<?=$valor->getId()?>" onChange="subTotal<?=$valor->getId()?>(<?=$precio?>)"></td>                        
                <td align="right"><input  class="form-control col-sm-3" name="subtotal" id="sub<?=$valor->getId()?>" disabled></td>                
                <td>
                  <input type="hidden" name="idCerveza" value=<?=$cerveza->getId()?>>                  
                  <input type="hidden" name="idEnvase" value=<?=$valor->getId()?>>                                                   
                <?php
                if(isset($_SESSION['usuario'])){
                ?>  
                  <button type="submit" class="form-control btn btn-warning" id="boton<?=$valor->getId()?>" disabled><span class="t_negro"><span class="glyphicon glyphicon-shopping-cart"></span><b> Agregar al Carro</b></button></span>               
                <?php
                }else{
                ?>                  
                  <a href="<?=DIR?>Front/userin"><button type="button" class="form-control btn btn-warning"><span class="t_negro"><span class="glyphicon glyphicon-log-in"></span><b> Log In</b></button></span></a>
                <?php
                }
                ?>                  
                </td>                        
              </tr>
          </form>
          <script type="text/javascript">
            function subTotal<?=$valor->getId()?>(precio){
              var total=0;
              total = precio * document.envases<?=$valor->getId()?>.cant<?=$valor->getId()?>.value;
              total = parseFloat(total).toFixed(2);
              document.envases<?=$valor->getId()?>.sub<?=$valor->getId()?>.value = total;
              if (total == 0){
                document.envases<?=$valor->getId()?>.boton<?=$valor->getId()?>.disabled = true;
              }else{
                document.envases<?=$valor->getId()?>.boton<?=$valor->getId()?>.disabled = false;             
              }
            }
          </script>
      <?php
      }
      ?>
              <tr>
                <td height="10px" colspan="8"></td>
              </tr>
            </tbody>
        </table>

             </div> 
            </div>
          </div>

        </div>
      </div>
    </div>
    <BR><BR>
            <?php
                include(URL_VISTA_FRONT."pie.php");
            ?> 
        </body>
        

