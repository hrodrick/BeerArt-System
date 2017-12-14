    <?php require("Utils/Util.php");?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
		      <h2 class="t_blanco">&nbsp;Listado de Envases</h2>
		      <p>&nbsp;</p>      
	                
		      <div class="contenedor div_trans5">
		           <table class="table">
		              <thead>	
		                  <tr>
		                     <th width="4%"></th>
		                     <th width="4%"></th>
		                     <th width="5%" align="center" class="t_blanco">Foto</th>
							 <th width="57%"><a href="<?=DIR?>Envase/reorder/<?= $page;?>/tipo/<?= ($campo!='tipo')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Tipo orden <?php echo ver_orden($orden);?>">Tipo<?php if ($campo=='tipo') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
							 <th width="10%"><a href="<?=DIR?>Envase/reorder/<?= $page;?>/capacidad/<?= ($campo!='capacidad')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Capacidad orden <?php echo ver_orden($orden);?>">Capacidad<?php if ($campo=='capacidad') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
							 <th width="10%"><a href="<?=DIR?>Envase/reorder/<?= $page;?>/coeficiente/<?= ($campo!='coeficiente')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Coeficiente orden <?php echo ver_orden($orden);?>">Coeficiente<?php if ($campo=='coeficiente') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
							 <th width="10%"><a href="<?=DIR?>Envase/reorder/<?= $page;?>/standBy/<?= ($campo!='tipo')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Stand By orden <?php echo ver_orden($orden);?>">Stand By<?php if ($campo=='standBy') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <?php
		                  $totalCount=count($envases);
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
		                      foreach ($envases as $valor) {
		                      		$sb=standBy($valor->getStandBy());
		                      		$fotoTemp=(strlen($valor->getFoto())==0)?$valor->getTipo().'.jpg':$valor->getFoto();		     
		                  ?>
		                 <div id="<?php echo $valor->getId();?>" class="modal fade" role="dialog">
		                      <div class="modal-dialog">
		                          <div class="modal-content">
		                               <div class="modal-header modal-header-danger">
		                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                                    <h4>Desea Eliminar El Envase?</h4>
		                               </div>
		                               <div class="modal-body">
		                                    <h4><?php echo $valor->getTipo();?></h4>
 											<p><img src="<?=DIR.URL_IMG_ENV.'t2_'.$fotoTemp;?>"</p>		                                    
		                               </div>
		                               <div class="modal-footer">
											<?='<a href="'.DIR.'Envase/borrar/'.urlencode(base64_encode($valor->getId())).'/'.$page.'/'.$campo.'/'.$orden.'/'.$valor->getFoto().'" data-toggle="tooltip" title="Eliminar" class="btn btn-danger">Eliminar</a>';?>   
		                                    <a href="#" data-dismiss="modal" class="btn btn-success">Cerrar</a>
		                               </div>
		                          </div>
		                      </div>
		                 </div>
		                 <tr>
		                     <td><a href="<?=DIR?>Envase/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" data-toggle="tooltip" title="Modificar <?=$valor->getTipo()?>"><img src="<?=DIR.URL_IMG?>b_edit.png"></a></td>
		                     <td><a data-toggle="modal" href="#<?php echo $valor->getId();?>" title="Eliminar <?=$valor->getTipo()?>"><img src="<?=DIR.URL_IMG?>b_del.png" border="0"></a></td>
		                     <td><a href="<?=DIR.URL_IMG_ENV.'tp_'.$fotoTemp;?>" data-lightbox="galeria" data-title="<?= $valor->getTipo();?>"><img src="<?=DIR.URL_IMG_ENV.'t2_'.$fotoTemp;?>" class="img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto' alt='<?= $valor->getTipo();?>'></a></td>
		                     <td><a href="<?=DIR?>Envase/edit/<?=urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getTipo()?>"><?= $valor->getTipo();?></a></td>
							 <td align="right"><a href="<?=DIR?>Envase/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getTipo()?>"><?= number_format($valor->getCapacidad(),2,',','.');?></a></td>		                     
							 <td align="right"><a href="<?=DIR?>Envase/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getTipo()?>"><?= number_format($valor->getCoeficiente(),2,',','.');?></a></td>		                     
		                     <td align="center"><a href="<?=DIR?>Envase/standBy/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="<?= $sb['tip'];?>  <?=$valor->getTipo()?>"><span class="label label-<?= $sb['label'];?>"><?= $sb['standby'];?></span></a></td>
		                </tr>
		                <?php
		                }
		            }
		                ?>
		              </tbody>
		           </table>
		      </div>   
		      <!-- Paginacion usa la variable destino para los links   -->
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>  