    <?php require("Utils/Util.php");?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">      
		      <h2 class="t_blanco">&nbsp;Listado de Envases por Cervezas</h2>
		      <p>&nbsp;</p>
		      <div class="contenedor div_trans5">
		           <table class="table">
		              <thead>		              	
		                  <tr>
		                     <th width="8%" class="t_blanco">Foto</th>
		                     <th width="78%"><a href="<?=DIR?>Cerveza/reorderConEnv/<?= $page;?>/tipo/<?= ($campo!='tipo')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Cerveza orden <?php echo ver_orden($orden);?>">Cerveza<?php if ($campo=='tipo') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
 							 <th width="8%" align="center"><a href="<?=DIR?>Cerveza/reorderConEnv/<?= $page;?>/precioXLitro/<?= ($campo!='precioXLitro')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Precio orden <?php echo ver_orden($orden);?>">Precio<?php if ($campo=='precioXLitro') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>		                     
		                     <th width="10%" align="center"><a href="<?=DIR?>Cerveza/reorderConEnv/<?= $page;?>/standBy/<?= ($campo!='standBy')?'asc':ver_orden($orden);?>" class="t_blanco_link" data-toggle="tooltip" data-html="true"  title="Ordenar por Stand By orden <?php echo ver_orden($orden);?>">Stand By<?php if ($campo=='standBy') {?>&nbsp;<img src="<?php echo $img;?>" border="0"><?php }?></a></th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <div class="panel-group" id="accordion">		              	
		                  <?php
		                      if ($totalCount==0) { ?>
		                  <tr>
		                      <td colspan="4">&nbsp;</td>
		                  </tr>
		                  <tr>
		                      <td colspan="4" align="center" class="texto_blanco"><H4><<<< NO HAY REGISTROS >>>><H4></td>
		                  </tr>
		                  <tr>
		                      <td colspan="4">&nbsp;</td>
		                  </tr>
		                  <?php }else{
		                      foreach ($cervezas as $valorCer) {
		                      		$sb=standBy($valorCer->getStandBy());
		                      		$fotoTemp=(strlen($valorCer->getFoto())==0)?'Choppenhauer.jpg':$valorCer->getFoto();		     
		                  ?>
	                  
		                 <tr>
							 <td><a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoTemp;?>" data-lightbox="galeriaCer" data-title="<?= $valorCer->getTipo();?>"><img src="<?=DIR.URL_IMG_CER.'t2_'.$fotoTemp;?>" class="img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto'></a></td>
		                     <td class="t_blanco"><a data-toggle="collapse" data-parent="#accordion" class="t_blanco_link" href="#c<?= $valorCer->getId();?>" title="Ver Envases"><?= $valorCer->getTipo();?></a>
                                <div id="c<?= $valorCer->getId();?>" class="panel-collapse collapse div_trans5">
								<form action="<?=DIR?>Cerveza/editConEnv" method="post" name="form<?=$valorCer->getId()?>">   						          
						           <table class="table">
						              <thead>	
						                  <tr bgcolor="black">
						                     <th width="4%"></th>
						                     <th width="8%" align="center" class="t_blanco">Foto</th>
											 <th width="52%" align="center" class="t_blanco">Envase</th>
											 <th width="10%" align="center" class="t_blanco">Capacidad</th>
											 <th width="10%" align="center" class="t_blanco">Coeficiente</th>
											 <th width="12%" align="center" class="t_blanco">Stand By</th>
						                  </tr>
						              </thead>
						              <tbody>
                                     <?php
                                     $envases=$valorCer->getEnvases();
                                     foreach ($envases as $key => $value) {
		                      			$fotoTemp=(strlen($value->getFoto())==0)?$value->getTipo().'.jpg':$value->getFoto();
                                     	?>
					                 <tr>
					                     <td>
											<div class="checkbox">
											  <label><input type="checkbox" name="envxcerCheck[]" value="<?=$value->getIdEnvase();?>" <?=($value->getTiene())?'checked':'';?>></label>
											</div>		                     	
					                     </td>
					                     <td align="center"><a href="<?=DIR.URL_IMG_ENV.'tp_'.$fotoTemp;?>" data-lightbox="galeriaEnv<?=$valorCer->getId()?>" data-title="<?= $value->getTipo();?>"><img src="<?=DIR.URL_IMG_ENV.'t2_'.$fotoTemp;?>" class="img-thumbnail" border="0" data-toggle="tooltip" title='Ver Foto'></a></td>
					                     <td class="t_negro"><?= $value->getTipo();?></td>
										 <td align="right" class="t_negro"><?= number_format($value->getCapacidad(),2,',','.');?></td>		                     
										 <td align="right" class="t_negro"><?= number_format($value->getCoeficiente(),2,',','.');?></td>		                     
					                     <td align="center"><span class="label label-<?= $sb['label'];?>"><?= $sb['standby'];?></span></td>
					                </tr>


					                <?php
					            	}?>
					                <tr>
					                	<td colspan="6">
					                      <div class="col-xs-12 text-center">
					                          <input type="hidden" name="page" value="<?=$page?>">
					                          <input type="hidden" name="campo" value="<?=$campo?>">
					                          <input type="hidden" name="orden" value="<?=$orden?>">
					                          <input type="hidden" name="idCerveza" value="<?=$valorCer->getId()?>">
					                          <button type="submit" class="btn btn-warning">Modificar</button>
					                          <p>&nbsp;</p>
					                      </div>                    
					                   </form>
					                	</td>
					                </tr>
					              </tbody>
					           </table>					            	
                                </div>	
							 </td>                                
							 <td align="right" class="t_blanco"><?= $valorCer->getPrecioXLitro();?></td>		                     
		                     <td align="center" class="t_blanco"><span class="label label-<?= $sb['label'];?>"><?= $sb['standby'];?></span></td>
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