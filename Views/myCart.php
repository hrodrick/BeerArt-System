    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">      
          <h2 class="t_blanco">&nbsp;Mi Carro</h2>
          <p>&nbsp;</p>
          <div class="contenedor div_trans5">
               <table class="table">
                  <thead>                   
                      <tr>
                         <th width="21%"></th>
                         <th width="8%" class="t_naranja"></th>
                         <th width="10%" class="t_naranja">Cerveza</th>
                         <th width="4%" class="t_naranja"></th>                         
                         <th width="10%" class="t_naranja">Envase</th>
                         <th width="6%" align="right" class="t_naranja">Capacidad</th>
                         <th width="6%" align="right" class="t_naranja">Precio</th>
                         <th width="6%" align="right" class="t_naranja">Cantidad</th>                       
                         <th width="8%" align="right" class="t_naranja">SubTotal</th>
                         <th width="21%"></th>                         
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                          if(!isset($_SESSION['pedido']) || !$_SESSION['pedido']->contarLineas()>0){?>
                      <tr>
                          <td colspan="10">&nbsp;</td>
                      </tr>
                      <tr>
                          <td colspan="10" align="center" class="texto_blanco"><H4><<<< NO HAY PEDIDOS >>>><H4></td>
                      </tr>
                      <tr>
                          <td colspan="10">&nbsp;</td>
                      </tr>
                      <?php }else{
                          $total=0;
                          foreach ($_SESSION['pedido']->getPedido() as $key => $valor) {
                              $fotoCerveza=(strlen($valor->getCerveza()->getFoto())==0)?'Choppenhauer.jpg':$valor->getCerveza()->getFoto(); 
                              $fotoEnvase=(strlen($valor->getEnvase()->getFoto())==0)?$valor->getEnvase()->getTipo().'.jpg':$valor->getEnvase()->getFoto(); 
                      ?>
                     <div id="<?php echo $key;?>" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                   <div class="modal-header modal-header-danger">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4>Desea Eliminar La Cerveza?</h4>
                                   </div>
                                   <div class="modal-body">
                                        <H3><?=$valor->getCerveza()->getTipo();?></H3>
                                        <H4><?= $valor->getEnvase()->getTipo()?></H4>
                                        <H4><?=$valor->getCantidad()?> x $<?= number_format($valor->getSubtotal(),2,',','.')?></H4>
                                        <p><img src="<?=DIR.URL_IMG_CER.'t2_'.$fotoCerveza;?>"</p>                                       
                                   </div>
                                   <div class="modal-footer">
                                        <?='<a href="'.DIR.'Pedido/borrarLinea/'.urlencode(base64_encode($key)).'" data-toggle="tooltip" title="Eliminar" class="btn btn-danger">Eliminar</a>';?>   
                                        <a href="#" data-dismiss="modal" class="btn btn-success">Cerrar</a>
                                   </div>
                              </div>
                          </div>
                     </div>
                     <tr>
                         <td align="right"><a data-toggle="modal" href="#<?php echo $key;?>" title="Eliminar <?=$valor->getEnvase()->getTipo()?> <?=$valor->getCerveza()->getTipo()?>"><img src="<?=DIR.URL_IMG?>b_del.png" border="0"></a></td>
                         <td><a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoCerveza;?>" data-lightbox="galeria" data-title="<?= $valor->getCerveza()->getTipo();?>"><img src="<?=DIR.URL_IMG_CER.'t2_'.$fotoCerveza;?>" class="img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto Cerveza <?= $valor->getCerveza()->getTipo();?>' alt='<?= $valor->getCerveza()->getTipo();?>'></a></td>
                         <td class="t_blanco"><?= $valor->getCerveza()->getTipo();?></td>
                         <td><a href="<?=DIR.URL_IMG_ENV.'tp_'.$fotoEnvase;?>" data-lightbox="galeria" data-title="<?= $valor->getEnvase()->getTipo();?>"><img src="<?=DIR.URL_IMG_ENV.'t2_'.$fotoEnvase;?>" class="img-circle img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto Envase <?= $valor->getEnvase()->getTipo();?>' alt='<?= $valor->getEnvase()->getTipo();?>'></a></td>                         
                         <td class="t_blanco"><?= $valor->getEnvase()->getTipo();?></td>
                         <td align="right" class="t_blanco"><?= number_format($valor->getEnvase()->getCapacidad(),2,',','.');?> lts.</td>
                         <td align="right" class="t_blanco">$<?= number_format($valor->getPrecioUnitario(),2,',','.');?></td>                         
                         <td align="right" class="t_blanco"><?= number_format($valor->getCantidad(),2,',','.');?></td>                         
                         <td align="right" class="t_blanco">$<?= number_format($valor->getSubtotal(),2,',','.')?></td>
                         <td></td>                         
                    </tr>
                    <?php
                    }
                }
            
                          if(isset($_SESSION['pedido']) && $_SESSION['pedido']->contarLineas()>0){?>                    
                     <tr>                    
                         <td align="right" class="t_blanco" colspan="9"><b>El Total de su compra es de <span class="t_naranja">$<?= number_format($_SESSION['pedido']->getTotal(),2,',','.')?></span></b></td>
                         <td></td>                          
                    </tr>  
                     <tr>                    
                         <td align="center" class="t_blanco" colspan="10"><a href="<?=DIR?>Pedido/confirmar"><button type="button" class="form-control btn btn-warning">Confirmar Compra</span></button></a></td>
                    </tr>                      
                    <?php
                    }
                    ?>                                      
                  </tbody>
               </table>
          </div>   
            </div> <!-- /container -->
        </div>
    <BR><BR>
            <?php
                include(URL_VISTA_FRONT."pie.php");
            ?> 
        </body>
        

