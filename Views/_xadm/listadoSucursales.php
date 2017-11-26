    <?php require("Utils/Util.php");?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
		      <h2 class="t_blanco">&nbsp;Listado de Sucursales</h2>
		      <p>&nbsp;</p>
		      <div class="contenedor div_trans5">
		           <table class="table">
		              <thead>	              	
		                  <tr>
		                     <th width="4%"></th>
		                     <th width="4%"></th>
		                     <th width="20%"><a href="<?=DIR?>Pedido/listadoPorSucursal/<?= $page;?>/nombre/<?= ($campo!='nombre')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Sucursal orden <?php echo ver_orden($orden);?>">Nombre<?php if ($campo=='nombre') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
 							 <th width="32%""><a href="<?=DIR?>Pedido/listadoPorSucursal/<?= $page;?>/domicilio/<?= ($campo!='domicilio')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Domicilio orden <?php echo ver_orden($orden);?>">Domicilio<?php if ($campo=='domicilio') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
 							 <th width="10%" align="right"><a href="<?=DIR?>Pedido/listadoPorSucursal/<?= $page;?>/telefono/<?= ($campo!='telefono')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Telefono orden <?php echo ver_orden($orden);?>">Telefono<?php if ($campo=='telefono') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
 							 <th width="20%"><a href="<?=DIR?>Pedido/listadoPorSucursal/<?= $page;?>/localidad/<?= ($campo!='localidad')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Localidad orden <?php echo ver_orden($orden);?>">Localidad<?php if ($campo=='localidad') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
		                     <th width="10%" align="center"></th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <?php
		                      if ($totalCount==0) { ?>
		                  <tr>
		                      <td colspan="7">&nbsp;</td>
		                  </tr>
		                  <tr>
		                      <td colspan="7" align="center" class="texto_blanco"><H4><<<< NO HAY REGISTROS >>>><H4></td>
		                  </tr>
		                  <tr>
		                      <td colspan="7">&nbsp;</td>
		                  </tr>
		                  <?php }else{
		                      foreach ($sucursales as $valor) {
		                      		$sb=standBy($valor->getStandBy());		     
		                  ?>
		                 <tr>
		                     <td></td>
		                     <td></td>
		                     <td><a href="<?=DIR?>Pedido/pedidosPorSucursal/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getNombre();?></a></td>
							 <td><a href="<?=DIR?>Pedido/pedidosPorSucursal/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getDomicilio();?></a></td>		                     
							 <td align="right"><a href="<?=DIR?>Pedido/pedidosPorSucursal/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getTelefono();?></a></td>		                     
							 <td><a href="<?=DIR?>Pedido/pedidosPorSucursal/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getLocalidad();?></a></td>		                     
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
		     	$destino='Pedido/listadoPorSucursal/';
		     	require('Views/_xadm/paginacion.php');
		     	;?>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>  