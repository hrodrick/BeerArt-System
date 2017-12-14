    <?php require("Utils/Util.php");?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
		      <h2 class="t_blanco">&nbsp;Listado de Roles</h2>
		      <p>&nbsp;</p>
		      <div class="contenedor div_trans5">
		           <table class="table">
		              <thead>		              	
		                  <tr>
		                     <th width="4%"></th>
		                     <th width="4%"></th>
		                     <th width="67%"><a href="<?=DIR?>Rol/reorder/<?= $page;?>/rol/<?= ($campo!='rol')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Rol orden <?php echo ver_orden($orden);?>">Rol<?php if ($campo=='rol') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
		                     <th width="15%"><a href="<?=DIR?>Rol/reorder/<?= $page;?>/permisos/<?= ($campo!='permisos')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Permisos orden <?php echo ver_orden($orden);?>">Permisos<?php if ($campo=='permisos') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     		                     
		                     <th width="10%" align="center"><a href="<?=DIR?>Rol/reorder/<?= $page;?>/standBy/<?= ($campo!='standBy')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Stand By orden <?php echo ver_orden($orden);?>">Stand By<?php if ($campo=='standBy') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <?php
		                      if ($totalCount==0) { ?>
		                  <tr>
		                      <td colspan="5">&nbsp;</td>
		                  </tr>
		                  <tr>
		                      <td colspan="5" align="center" class="texto_blanco"><H4><<<< NO HAY REGISTROS >>>><H4></td>
		                  </tr>
		                  <tr>
		                      <td colspan="5">&nbsp;</td>
		                  </tr>
		                  <?php
		                   }
		                   else{
		                   ?>
		                   	<div class="panel-group" id="accordion">	
		                   	<?php
		                      foreach ($roles as $valor) {
		                      		$sb=standBy($valor->getStandBy());		     
		                  ?>
		                 <div id="<?php echo $valor->getId();?>" class="modal fade" role="dialog">
		                      <div class="modal-dialog">
		                          <div class="modal-content">
		                               <div class="modal-header modal-header-danger">
		                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                                    <h4>Desea Eliminar Rol?</h4>
		                               </div>
		                               <div class="modal-body">
		                                    <h4><?php echo $valor->getRol();?></h4>
		                               </div>
		                               <div class="modal-footer">
											<?='<a href="'.DIR.'Rol/borrar/'.urlencode(base64_encode($valor->getId())).'/'.$page.'/'.$campo.'/'.$orden.'" data-toggle="tooltip" title="Eliminar" class="btn btn-danger">Eliminar</a>';?>   
		                                    <a href="#" data-dismiss="modal" class="btn btn-success">Cerrar</a>
		                               </div>
		                          </div>
		                      </div>
		                 </div>                 
		                 <tr>                	
		                     <td><a href="<?=DIR?>Rol/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" data-toggle="tooltip" title="Modificar <?=$valor->getRol()?>"><img src="<?=DIR.URL_IMG?>b_edit.png"></a></td>
		                     <td><a data-toggle="modal" href="#<?php echo $valor->getId();?>" title="Eliminar <?=$valor->getRol()?>"><img src="<?=DIR.URL_IMG?>b_del.png" border="0"></a></td>
		                     <td>                	         
                                <a data-toggle="collapse" data-parent="#accordion" class="t_blanco_link" href="#c<?= $valor->getId();?>" title="Ver Descripci&oacute;n"><?= $valor->getRol();?></a>
                                <div id="c<?= $valor->getId();?>" class="panel-collapse collapse">
                                     <div class="panel-body"><textarea id="textarea1" name="texto" rows="<?php echo substr_count($valor->getDescripcion(),"\n")+1;?>" readonly="readonly" class="form-control"><?=$valor->getDescripcion();?></textarea></div>
                                </div>	                                                           	                              		                     
		                     </td>                     
		                     <td><a href="<?=DIR?>Rol/edit/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="Modificar <?=$valor->getRol()?>"><?=($valor->getPermisos()==1)?'Control Total':'Acceso Restringido'?></a></td>
		                     <td align="center"><a href="<?=DIR?>Rol/standBy/<?= urlencode(base64_encode($valor->getId()));?>/<?= $page;?>/<?= $campo;?>/<?= $orden;?>" class="t_blanco_link" data-toggle="tooltip" title="<?= $sb['tip'];?>  <?=$valor->getRol()?>"><span class="label label-<?= $sb['label'];?>"><?= $sb['standby'];?></span></a></td>
		                </tr>
		                <?php
		                }
		            }
		                ?>
		            </div>
		              </tbody>
		           </table>
		      </div>   
		      <!-- Paginacion usa la variable destino para los links   -->
		     	<?php
		     	$destino='Rol/listado/';
		     	require('Views/_xadm/paginacion.php');
		     	;?>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>  