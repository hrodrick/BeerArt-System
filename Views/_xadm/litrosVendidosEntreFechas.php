   <?php 
	    $i = rand(1,9);
	    $imagen="0".$i.".jpg";
	    if(!empty($cervezas)){
	    	$ancla = "onload='listado()'";
	    }else{
	    	$ancla = '';
	    }
    ?>
      <script>
      	function listado(){
      		document.location.href = "#lista";
      	}
      </script>    
    <body background="<?=DIR.URL_IMG.$imagen;?>" <?=$ancla;?>>   
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
            	<div class="contenedor div_trans5 text-center">
            	
              <div class="contenedor div_trans5 text-center">
                <form class="form" method="post" action="<?=DIR?>Ventas/ltsVendEntreFechas">

                      <p>&nbsp;</p>

                      <label class="t_blanco">Desde</label>
                      <div class="input-group col-xs-3 div-center">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-calendar text-warning"></i></span>
                           <input type="date" class="form-control input-lg" value='<?= date('Y-m-d')?>' name="inicio" required autofocus>
                      </div>

                      <p>&nbsp;</p>

                      <label class="t_blanco">Hasta</label>
                      <div class="input-group col-xs-3 div-center">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-calendar text-warning"></i></span>
                           <input type="date" class="form-control input-lg" value='<?= date('Y-m-d')?>' name="fin" required autofocus>
                      </div>

                      <p>&nbsp;</p>
                      
                      <div class="input-group col-xs-3 div-center">
                          <button class="btn btn-lg btn-warning btn-block" type="submit">Enviar</button>
                      </div>
               </form>

              </div>      
		      <?php
		      	if(!empty($cervezas)){
		      		if(!isset($msj))
                		$fechaIni = date(FECHA,strtotime($inicio)); 		      			
                		$fechaFin = date(FECHA,strtotime($fin)); 		      			
		      			$msj = "Litros vendidos entre el ". $fechaIni . " y el " . $fechaFin;

		      ?>
		      <a name="lista"></a>
		      <div class="contenedor div_trans5">
		      			<h4 class="t_blanco" align="center"> <?=$msj?> </h4>
		           <table class="table" align="center">
		              <thead>		              	
		                  <tr class="t_blanco">
		                     <th width="10%" class="t_naranja"> Foto </th>
		                     <th width="63%" class="t_naranja"> Cerveza </th>
		                     <th width="27%" class="t_naranja"> Litros Vendidos </th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <?php
		                      if ($totalCount==0) { ?>
		                  <tr>
		                      <td colspan="3">&nbsp;</td>
		                  </tr>
		                  <tr>
		                      <td colspan="3" align="center" class="texto_blanco"><H4><<<< NO HAY REGISTROS >>>><H4></td>
		                  </tr>
		                  <tr>
		                      <td colspan="3">&nbsp;</td>
		                  </tr>
		                  <?php }
		                  	else{
		                      foreach ($cervezas as $valor) {
		                      		$fotoTemp=(strlen($valor->getCerveza()->getFoto())==0)?'Choppenhauer.jpg':$valor->getCerveza()->getFoto();		     
		                  ?>
		                <tr class="t_blanco">
		                     <td> <a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoTemp;?>" data-lightbox="galeria" 
		                     		 data-title="<?= $valor->getCerveza()->getTipo();?>">
		                     		<img width="50%" src="<?=DIR.URL_IMG_CER.'t2_'.$fotoTemp;?>" class="img-thumbnail" 
		                     			 border="0"
		                     		data-toggle="tooltip" title='Ver Foto' alt='<?= $valor->getCerveza()->getTipo();?>'>
		                     	  </a>
		                     </td>

		                     <?php
		                     	$lts = 0; 
			                    foreach ($valor->getListaEnvasesDTO() as $env) {
			                    	
									$lts += $env->getEnvase()->getCapacidad() * $env->getCantidadHistoricaVendida(); 
								}
		                     ?>

		                     <td align="left"> <?= $valor->getCerveza()->getTipo();?> </td>
		                     <td> <?= number_format($lts,2,',','.') ?> lts. </td>
		                </tr>
		                <?php
		                		} // for-end
		            		}// else-end
		            	}//first IF-end
		                ?>
		              </tbody>
		           </table>
		      </div>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>  
