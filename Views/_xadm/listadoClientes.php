   <?php require("Utils/Util.php");?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
		      <h2 class="t_blanco">&nbsp;Listado de Clientes</h2>
		      <p>&nbsp;</p>
		      <div class="contenedor div_trans5">
		           <table class="table">
		              <thead>
		                  <tr>
		                     <th width="4%"></th>
		                     <th width="4%"></th>
		                     <th width="4%"></th>		                     
		                     <th width="20%"><a href="<?=DIR?>Pedido/listadoPorCliente/<?= $page;?>/nombre/<?= ($campo!='nombre')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Cliente orden <?php echo ver_orden($orden);?>">Nombre<?php if ($campo=='nombre') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
 							 <th width="20%""><a href="<?=DIR?>Pedido/listadoPorCliente/<?= $page;?>/apellido/<?= ($campo!='apellido')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Apellido orden <?php echo ver_orden($orden);?>">Apellido<?php if ($campo=='apellido') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
 							 <th width="20%" align="right"><a href="<?=DIR?>Pedido/listadoPorCliente/<?= $page;?>/domicilio/<?= ($campo!='domicilio')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Telefono orden <?php echo ver_orden($orden);?>">Domicilio<?php if ($campo=='domicilio') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
 							 <th width="18%"><a href="<?=DIR?>Pedido/listadoPorCliente/<?= $page;?>/email/<?= ($campo!='email')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Localidad orden <?php echo ver_orden($orden);?>">E-Mail<?php if ($campo=='email') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
		                     <th width="10%" align="center"></th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <?php
		                      if ($totalCount==0) { ?>
		                  <tr>
		                      <td colspan="8">&nbsp;</td>
		                  </tr>
		                  <tr>
		                      <td colspan="8" align="center" class="texto_blanco"><H4><<<< NO HAY REGISTROS >>>><H4></td>
		                  </tr>
		                  <tr>
		                      <td colspan="8">&nbsp;</td>
		                  </tr>
		                  <?php }else{
		                      foreach ($clientes as $valor) {
		                      		$sb=standBy($valor->getStandBy());		     
		                  ?>
                  
		                 <div id="data<?php echo $valor->getId();?>" class="modal fade" role="dialog">
		                      <div class="modal-dialog modal-sm">
		                          <div class="modal-content">
		                               <div class="modal-header modal-header-warning">
		                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                                    <h4>Datos del Cliente</h4>
		                               </div>
		                               <div class="modal-body">
		                                    <h4><?php echo $valor->getNombre().' '.$valor->getApellido();?></h4>
		                                    <h5><?php echo $valor->getDomicilio();?></h5>
		                                    <h5><?php echo $valor->getLocalidad();?></h5>		                                    		                  
		                                    <h5><?php echo $valor->getTelefono();?></h5>		                                    		                  
		                                    <h5><?php echo $valor->getDni();?></h5>		                                    		                  
		                                    <h5><?php echo $valor->getEmail();?></h5>		                                    		                  
		                               </div>
		                               <div class="modal-footer">											   
		                                    <a href="#" data-dismiss="modal" class="btn btn-warning">Cerrar</a>
		                               </div>
		                          </div>
		                      </div>
		                 </div>		                 
		                 <tr>
		                     <td></td>
		                     <td></td>
		                     <td><a data-toggle="modal" href="#data<?=$valor->getId();?>" title="Ver Datos Completos de <?=$valor->getNombre()?> <?=$valor->getApellido()?>"><img src="<?=DIR.URL_IMG?>s_info.png" border="0"></a></td>
		                     <td><a href="<?=DIR?>Pedido/pedidosPorCliente/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Ver Pedidos de <?=$valor->getNombre()?> <?=$valor->getApellido()?>"><?= $valor->getNombre();?></a></td>
							 <td><a href="<?=DIR?>Pedido/pedidosPorCliente/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Ver Pedidos de <?=$valor->getNombre()?> <?=$valor->getApellido()?>"><?= $valor->getApellido();?></a></td>		                     
							 <td><a href="<?=DIR?>Pedido/pedidosPorCliente/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Ver Pedidos de <?=$valor->getNombre()?> <?=$valor->getApellido()?>"><?= $valor->getDomicilio();?></a></td>		                     
							 <td><a href="<?=DIR?>Pedido/pedidosPorCliente/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Ver Pedidos de <?=$valor->getNombre()?> <?=$valor->getApellido()?>"><?= $valor->getEmail();?></a></td>		                     
		                     <td align="center"></td>
		                </tr>
		                <?php
		                }
		            }
		                ?>
		              </tbody>
		           </table>
		      </div>   
		      <!-- Paginacion usa la variable destino para los links   -->
		     	<?php
		     	$destino='Pedido/listadoPorCliente/';
		     	require('Views/_xadm/paginacion.php');
		     	;?>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>  