   <?php 
	    $i = rand(1,9);
	    $imagen="0".$i.".jpg";
    ?>
    <body background="<?=DIR.URL_IMG.$imagen;?>">    
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
            	<div class="contenedor div_trans5 text-center">
                <form class="form" method="post" action="<?=DIR?>Ventas/ltsVendEntreFechas">

                      <p>&nbsp;</p>

                      <table class="t_blanco" align="center">
                      	<tr>
                      		<td>Desde</td>
                      		<td>Hasta</td>
                      	</tr>
                      	<tr>
                      		<td>
                      			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar text-warning"></i></span>
                           		<input type="date" class="form-control input-lg" value='<?= date('Y-m-d')?>' name="inicio" required>
                      		</td>
                      		<td>
                      			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar text-warning"></i></span>
                           		<input type="date" class="form-control input-lg" value='<?= date('Y-m-d')?>' name="fin" required>	
                      		</td>
                      	</tr>
                      </table>

                      <p>&nbsp;</p>

                      <div class="input-group col-xs-3 div-center">
                          <button class="btn btn-lg btn-warning btn-block" type="submit">Enviar</button>
                      </div>
               </form>
              </div>      
		      <?php
		      	if(isset($cervezas)){
		      		if(!isset($msj))
		      			$msj = "Litros vendidos entre el ". $inicio . "y el " . $fin.".";

		      ?>
		      <div class="contenedor div_trans5">
		      			<h4 class="t_blanco" align="center"> <?=$msj?> </h4>
		           <table class="table" align="center">
		              <thead>		              	
		                  <tr class="t_blanco">
		                     <th width="8%"> Foto </th>
		                     <th width="20%"> Cerveza </th>
		                     <th width="20%"> Litros Vendidos </th>
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
		                  <?php }
		                  	else{
		                      foreach ($cervezas as $valor) {
		                      		$fotoTemp = $valor->getFoto();		     
		                  ?>
		                <tr class="t_blanco">
		                     <td width="10%"> <a href="<?=DIR.URL_IMG_CER.'tp_'.$fotoTemp;?>" data-lightbox="galeria"
		                     		data-title="<?= $valor->getTipo();?>">
		                     		<img width="50%" src="<?=DIR.URL_IMG_CER.'t2_'.$fotoTemp;?>" class="img-thumbnail" border="0"
		                     		data-toggle="tooltip" title='Ver Foto' alt='<?= $valor->getTipo();?>'> </a>
		                     </td>
		                     <td width="20%"> <?= $valor->getTipo();?> </td>
		                     <td width="20%"> <?= number_format($litrosPorCerveza[$valor->getId()],2,',','.') ?> lts. </td>
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