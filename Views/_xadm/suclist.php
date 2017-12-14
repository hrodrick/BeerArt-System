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
		                     <th width="20%"><a href="<?=DIR?>Sucursal/reorder/<?= $page;?>/nombre/<?= ($campo!='nombre')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Sucursal orden <?php echo ver_orden($orden);?>">Nombre<?php if ($campo=='nombre') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
 							 <th width="32%""><a href="<?=DIR?>Sucursal/reorder/<?= $page;?>/domicilio/<?= ($campo!='domicilio')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Domicilio orden <?php echo ver_orden($orden);?>">Domicilio<?php if ($campo=='domicilio') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
 							 <th width="10%" align="right"><a href="<?=DIR?>Sucursal/reorder/<?= $page;?>/telefono/<?= ($campo!='telefono')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Telefono orden <?php echo ver_orden($orden);?>">Telefono<?php if ($campo=='telefono') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
 							 <th width="20%"><a href="<?=DIR?>Sucursal/reorder/<?= $page;?>/localidad/<?= ($campo!='localidad')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Localidad orden <?php echo ver_orden($orden);?>">Localidad<?php if ($campo=='localidad') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
		                     <th width="10%" align="center"><a href="<?=DIR?>Sucursal/reorder/<?= $page;?>/standBy/<?= ($campo!='standBy')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Stand By orden <?php echo ver_orden($orden);?>">Stand By<?php if ($campo=='standBy') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
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
		                 <div id="<?php echo $valor->getId();?>" class="modal fade" role="dialog">
		                      <div class="modal-dialog">
		                          <div class="modal-content">
		                               <div class="modal-header modal-header-danger">
		                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                                    <h4>Desea Eliminar La Sucursal?</h4>
		                               </div>
		                               <div class="modal-body">
		                                    <h4><?php echo $valor->getNombre();?></h4>
		                                    <h5><?php echo $valor->getDomicilio();?></h5>
		                                    <h5><?php echo $valor->getLocalidad();?></h5>		                                    		                  
		                               </div>
		                               <div class="modal-footer">
											<?='<a href="'.DIR.'Sucursal/borrar/'.urlencode(base64_encode($valor->getId())).'/'.$page.'/'.$campo.'/'.$orden.'" data-toggle="tooltip" title="Eliminar" class="btn btn-danger">Eliminar</a>';?>   
		                                    <a href="#" data-dismiss="modal" class="btn btn-success">Cerrar</a>
		                               </div>
		                          </div>
		                      </div>
		                 </div>
		                 <tr>
		                     <td><a href="<?=DIR?>Sucursal/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><img src="<?=DIR.URL_IMG?>b_edit.png"></a></td>
		                     <td><a data-toggle="modal" href="#<?=$valor->getId();?>" title="Eliminar <?=$valor->getNombre()?>"><img src="<?=DIR.URL_IMG?>b_del.png" border="0"></a></td>
		                     <td><a href="<?=DIR?>Sucursal/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getNombre();?></a></td>
							 <td><a href="<?=DIR?>Sucursal/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getDomicilio();?></a></td>		                     
							 <td align="right"><a href="<?=DIR?>Sucursal/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getTelefono();?></a></td>		                     
							 <td><a href="<?=DIR?>Sucursal/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getNombre()?>"><?= $valor->getLocalidad();?></a></td>		                     
		                     <td align="center"><a href="<?=DIR?>Sucursal/standBy/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="<?= $sb['tip'];?>  <?=$valor->getNombre()?>"><span class="label label-<?= $sb['label'];?>"><?= $sb['standby'];?></span></a></td>
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
		     	$destino='Sucursal/listado/';
		     	require('Views/_xadm/paginacion.php');
		     	;?>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>  