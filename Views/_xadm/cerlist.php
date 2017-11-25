    <?php require("Utils/Util.php");?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
		      <h2 class="t_blanco">&nbsp;Listado de Cervezas</h2>
		      <p>&nbsp;</p>
		      <div class="contenedor div_trans5">
		           <table class="table">
		              <thead>		              	
		                  <tr>
		                     <th width="4%"></th>
		                     <th width="4%"></th>
		                     <th width="8%" class="t_blanco">Foto</th>
		                     <th width="66%"><a href="<?=DIR?>Cerveza/reorder/<?= $page;?>/tipo/<?= ($campo!='tipo')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Cerveza orden <?php echo ver_orden($orden);?>">Cerveza<?php if ($campo=='tipo') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
 							 <th width="8%" align="center"><a href="<?=DIR?>Cerveza/reorder/<?= $page;?>/precioXLitro/<?= ($campo!='precioXLitro')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Precio orden <?php echo ver_orden($orden);?>">Precio<?php if ($campo=='precioXLitro') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
		                     <th width="10%" align="center"><a href="<?=DIR?>Cerveza/reorder/<?= $page;?>/standBy/<?= ($campo!='standBy')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Stand By orden <?php echo ver_orden($orden);?>">Stand By<?php if ($campo=='standBy') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <?php
		                      if ($totalCount==0) { ?>
		                  <tr>
		                      <td colspan="6">&nbsp;</td>
		                  </tr>
		                  <tr>
		                      <td colspan="6" align="center" class="texto_blanco"><H4><<<< NO HAY REGISTROS >>>><H4></td>
		                  </tr>
		                  <tr>
		                      <td colspan="6">&nbsp;</td>
		                  </tr>
		                  <?php }else{
		                      foreach ($cervezas as $valor) {
		                      		$sb=standBy($valor->getStandBy());
		                      		$fotoTemp=(strlen($valor->getFoto())==0)?'Choppenhauer.jpg':$valor->getFoto();		     
		                  ?>
		                 <div id="<?php echo $valor->getId();?>" class="modal fade" role="dialog">
		                      <div class="modal-dialog">
		                          <div class="modal-content">
		                               <div class="modal-header modal-header-danger">
		                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                                    <h4>Desea Eliminar La Cerveza?</h4>
		                               </div>
		                               <div class="modal-body">
		                                    <h4><?php echo $valor->getTipo();?></h4>
 											<p><img src="<?=DIR.URL_IMG_CER.'t2_'.$fotoTemp;?>"</p>		                                    
		                               </div>
		                               <div class="modal-footer">
											<?='<a href="'.DIR.'Cerveza/borrar/'.urlencode(base64_encode($valor->getId())).'/'.$page.'/'.$campo.'/'.$orden.'/'.$valor->getFoto().'" data-toggle="tooltip" title="Eliminar" class="btn btn-danger">Eliminar</a>';?>   
		                                    <a href="#" data-dismiss="modal" class="btn btn-success">Cerrar</a>
		                               </div>
		                          </div>
		                      </div>
		                 </div>
		                 <tr>
		                     <td><a href="<?=DIR?>Cerveza/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" data-toggle="tooltip" title="Modificar <?=$valor->getTipo()?>"><img src="<?=DIR.URL_IMG?>b_edit.png"></a></td>
		                     <td><a data-toggle="modal" href="#<?php echo $valor->getId();?>" title="Eliminar <?=$valor->getTipo()?>"><img src="<?=DIR.URL_IMG?>b_del.png" border="0"></a></td>
		                     <td><a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoTemp;?>" data-lightbox="galeria" data-title="<?= $valor->getTipo();?>"><img src="<?=DIR.URL_IMG_CER.'t2_'.$fotoTemp;?>" class="img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto' alt='<?= $valor->getTipo();?>'></a></td>
		                     <td><a href="<?=DIR?>Cerveza/edit/<?=urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getTipo()?>"><?= $valor->getTipo();?></a></td>
							 <td align="right"><a href="<?=DIR?>Cerveza/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getTipo()?>"><?= $valor->getPrecioXLitro();?></a></td>		                     
		                     <td align="center"><a href="<?=DIR?>Cerveza/standBy/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="<?= $sb['tip'];?>  <?=$valor->getTipo()?>"><span class="label label-<?= $sb['label'];?>"><?= $sb['standby'];?></span></a></td>
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
		     	$destino='Cerveza/listado/';
		     	require('Views/_xadm/paginacion.php');
		     	;?>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>  