    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
          <h2 class="t_blanco">&nbsp;Estado de Pedidos</h2>
          <p>&nbsp;</p>
          <div class="contenedor div_trans5">
               <table class="table">
                  <thead>                   
                      <tr>
                         <th width="10%" class="t_naranja"></th>
                         <th width="15%" class="t_naranja">Fecha</th>
                         <th width="20%" class="t_naranja">Email</th>
                         <th width="20%" class="t_naranja">Sucursal</th>                         
                         <th width="15%" class="t_naranja">Estado</th>                         
                         <th width="10%" class="t_naranja">Importe</th>                         
                         <th width="10%" class="t_naranja"></th>                         
                      </tr>
                  </thead> 
                  <tbody>                    
            <?php
            if(count($pedidos)>0){
              foreach ($pedidos as $key => $valuePedidos) {
                $estado=array('En Preparacion','Enviado','Entregado');
                $fecha=date(FECHA,strtotime($valuePedidos->getFecha()));
            ?>      
               <table class="table">            
                <tbody>             
                      <tr>
                         <td width="10%" class="t_blanco" align="right"><a data-toggle="modal" href="#data<?=$valuePedidos->getId();?>" title="Ver Datos Completos del Pedido <?=$valuePedidos->getFecha()?>"><img src="<?=DIR.URL_IMG?>s_info.png" border="0"></a></td>
                         <td width="15%" class="t_blanco"><?= $fecha;?></td>
                         <td width="20%" class="t_blanco"><?= $valuePedidos->getCliente()->getEmail();?></td>
                         <td width="20%" class="t_blanco"><?= $valuePedidos->getSucursal()->getDomicilio();?></td>
                         <td width="15%" class="t_negro">
                          <?php 
                              var_dump($valuePedidos->getEstado()); //TODO remove this line
                           ?>
                            <form action="<?=DIR?>Pedido/cambioEstado" method="post">
                              <select name="estado" onChange="submit();">
                                <?php
                                  $selected='selected';
                                  foreach ($estado as $est) {

                                    $selected = ( $est == $valuePedidos->getEstado() ) ? 'selected' : '';
                                    $desabilitado = '';
                                    
                                    if( $_SESSION['usuario']->getIdRol() != 1){

                                      $desabilitado = ( $est < $valuePedidos->getEstado() ) ? 'disabled' : '';
                                    }
                                 ?>
                                      <option value="<?=$est?>" <?=$desabilitado;?> <?=$selected;?> > <?= $estado[$est];?> </option>

                                <?php

                                  }
                                ?>
                                  <input type="hidden" name="idPedido" value="<?=$valuePedidos->getId()?>">
                                  <input type="hidden" name="page" value="<?=$page?>">
                              </select>
                            </form>
                          </td>                         
                         <td width="10%" class="t_blanco" align="right">$<?= number_format($valuePedidos->getTotal(),2,',','.')?></td>                         
                         <td width="10%" class="t_blanco" align="right"></td>                         
                      </tr>
                </tbody>
               </table>

          <!-- Principio Modal Pedido  -->   
                     <div id="data<?php echo $valuePedidos->getId();?>" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                   <div class="modal-header modal-header-warning">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4>Datos del Pedido</h4>
                                        <h4>Fecha: <?=$fecha?></h4>
                                        <h4>Cliente: <?=$valuePedidos->getCliente()->getEmail()?></h4>
                                   </div>
                                   <div class="modal-body">
                                     <table class="table">
                                        <thead>                   
                                            <tr>
                                               <th width="2%" class="t_naranja"></th>
                                               <th width="10%" class="t_naranja"></th>
                                               <th width="15%" class="t_naranja">Cerveza</th>
                                               <th width="6%" class="t_naranja"></th>                         
                                               <th width="15%" class="t_naranja">Envase</th>
                                               <th width="6%" align="right" class="t_naranja">Capacidad</th>
                                               <th width="6%" align="right" class="t_naranja">Precio</th>
                                               <th width="6%" align="right" class="t_naranja">Cantidad</th>                       
                                               <th width="8%" align="right" class="t_naranja">SubTotal</th>
                                               <th width="2%" class="t_naranja"></th>                                                 
                                            </tr>
                                        </thead>                                     
                                          <?php 
                                              $total=0;
                                              foreach ($valuePedidos->getPedido() as $key => $valor) {
                                                  $fotoCerveza=(strlen($valor->getCerveza()->getFoto())==0)?'Choppenhauer.jpg':$valor->getCerveza()->getFoto(); 
                                                  $fotoEnvase=(strlen($valor->getEnvase()->getFoto())==0)?$valor->getEnvase()->getTipo().'.jpg':$valor->getEnvase()->getFoto(); 
                                          ?>
                                         <tr>
                                             <td></td>                      
                                             <td><a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoCerveza;?>" data-lightbox="galeria" data-title="<?= $valor->getCerveza()->getTipo();?>"><img src="<?=DIR.URL_IMG_CER.'t2_'.$fotoCerveza;?>" class="img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto Cerveza <?= $valor->getCerveza()->getTipo();?>' alt='<?= $valor->getCerveza()->getTipo();?>'></a></td>
                                             <td class="t_negro">&nbsp;<?= $valor->getCerveza()->getTipo();?></td>
                                             <td><a href="<?=DIR.URL_IMG_ENV.'tp_'.$fotoEnvase;?>" data-lightbox="galeria" data-title="<?= $valor->getEnvase()->getTipo();?>"><img src="<?=DIR.URL_IMG_ENV.'t2_'.$fotoEnvase;?>" class="img-circle img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto Envase <?= $valor->getEnvase()->getTipo();?>' alt='<?= $valor->getEnvase()->getTipo();?>'></a></td>                         
                                             <td class="t_negro">&nbsp;<?= $valor->getEnvase()->getTipo();?></td>
                                             <td align="right" class="t_negro"><?= number_format($valor->getEnvase()->getCapacidad(),2,',','.');?> lts.</td>
                                             <td align="right" class="t_negro">$<?= number_format($valor->getPrecioUnitario(),2,',','.');?></td>                         
                                             <td align="right" class="t_negro"><?= number_format($valor->getCantidad(),2,',','.');?></td>                         
                                             <td align="right" class="t_negro">$<?= number_format($valor->getSubtotal(),2,',','.')?></td>                      
                                             <td></td>                            
                                        </tr>
                                        <?php
                                        }
                               
                                              if($valuePedidos->contarLineas()>0){?>                    
                                         <tr>                    
                                             <td align="right" class="t_negro" colspan="9"><b>Total comprado <span class="t_naranja">$<?= number_format($valuePedidos->getTotal(),2,',','.')?></span></b></td>
                                             <td></td>                          
                                        </tr>                    
                                      </tbody>
                                    </table>
                                        <?php
                                        }
                                        ?>                                         

                                   </div>
                                   <div class="modal-footer">                        
                                        <a href="#" data-dismiss="modal" class="btn btn-warning">Cerrar</a>
                                   </div>
                              </div>
                          </div>
                     </div> 
          <!-- Fin Modal Pedido  -->                                    


               <?php
             }
           }
           else{
            ?>
            <h4 class="t_blanco">&nbsp;No Hay Pedidos</h4>
            <?php
           }
               ?>

          </div>   
          <!-- Paginacion usa la variable destino para los links   -->
          <?php
          $destino='Pedido/estadoPedidos/';
          require('Views/_xadm/paginacion.php');
          ;?>          
            </div> <!-- /container -->
        </div>
    <BR><BR>
            <?php
                include(URL_VISTA_BACK."pie.php");
            ?> 
        </body>