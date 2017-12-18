    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    $fecha = date(FECHA,strtotime($fecha));
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
          <h2 class="t_blanco">&nbsp;Pedidos de Fecha: <?=$fecha;?></h2>
          <p>&nbsp;</p>
          <div class="contenedor div_trans5">          
            <?php
            if(count($pedidos)>0){
              foreach ($pedidos as $key => $valuePedidos) {
                $estado=array('En Preparacion','Enviado','Entregado');
                $fecha = date(FECHA,strtotime($valuePedidos->getFecha()));                
            ?>
               <table class="table">
                  <thead>                   
                      <tr>
                         <th width="10%" class="t_naranja"></th>
                         <th width="80%" class="t_blanco">Pedido de Fecha: <?= $fecha;?> - <?=$estado[$valuePedidos->getEstado()]?><BR>
                                                          Cliente: <?= $valuePedidos->getCliente()->getApellido();?>, <?= $valuePedidos->getCliente()->getNombre();?><BR>
                                                          E-Mail: <?= $valuePedidos->getCliente()->getEmail();?></th>
                         <th width="10%" class="t_naranja"></th>                         
                      </tr>
                  </thead> 
                  <tbody>
                <tr>            
                  <td></td>
                  <td> 
                 <table>
                    <thead>                   
                        <tr>
                           <th width="10%" class="t_naranja"></th>
                           <th width="6%" class="t_naranja"></th>
                           <th width="15%" class="t_naranja">Cerveza</th>
                           <th width="3%" class="t_naranja"></th>                         
                           <th width="10%" class="t_naranja">Envase</th>
                           <th width="6%" align="right" class="t_naranja">Capacidad</th>
                           <th width="6%" align="right" class="t_naranja">Precio</th>
                           <th width="6%" align="right" class="t_naranja">Cantidad</th>                       
                           <th width="8%" align="right" class="t_naranja">SubTotal</th>
                           <th width="10%" class="t_naranja"></th>                                                 
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
                         <td class="t_blanco">&nbsp;<?= $valor->getCerveza()->getTipo();?></td>
                         <td><a href="<?=DIR.URL_IMG_ENV.'tp_'.$fotoEnvase;?>" data-lightbox="galeria" data-title="<?= $valor->getEnvase()->getTipo();?>"><img src="<?=DIR.URL_IMG_ENV.'t2_'.$fotoEnvase;?>" class="img-circle img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto Envase <?= $valor->getEnvase()->getTipo();?>' alt='<?= $valor->getEnvase()->getTipo();?>'></a></td>                         
                         <td class="t_blanco">&nbsp;<?= $valor->getEnvase()->getTipo();?></td>
                         <td align="right" class="t_blanco"><?= number_format($valor->getEnvase()->getCapacidad(),2,',','.');?> lts.</td>
                         <td align="right" class="t_blanco">$<?= number_format($valor->getPrecioUnitario(),2,',','.');?></td>                         
                         <td align="right" class="t_blanco"><?= number_format($valor->getCantidad(),2,',','.');?></td>                         
                         <td align="right" class="t_blanco">$<?= number_format($valor->getSubtotal(),2,',','.')?></td>                      
                         <td></td>                            
                    </tr>
                    <?php
                    }
           
                          if($valuePedidos->contarLineas()>0){?>                    
                     <tr>                    
                         <td align="right" class="t_blanco" colspan="9"><b>Total comprado <span class="t_naranja">$<?= number_format($valuePedidos->getTotal(),2,',','.')?></span></b></td>
                         <td></td>                          
                    </tr>                    
                    <?php
                    }
                    ?>                                      
                  </tbody>
                </table>
                </td>
                <td></td>
              </tr>
            </tbody>
               </table>
               <?php
             }
           }
           else{
            ?>
            <h4 class="t_blanco">&nbsp;No Tiene Pedidos</h4>
            <?php
           }
               ?>
          </div>   
          <!-- Paginacion usa la variable destino para los links   -->
          <?php
          if(count($pedidos)>0){
              $destino='Pedido/pedidosPorFecha/'.date("Y-m-d",strtotime($valuePedidos->getFecha())).'/';
          }
          require('Views/_xadm/paginacion.php');
          ;?>          
            </div> <!-- /container -->
        </div>
    <BR><BR>
            <?php
                include(URL_VISTA_BACK."pie.php");
            ?> 
        </body>
        

