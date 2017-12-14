    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";  
    ?>
 
    <body background="<?=DIR.URL_IMG.$imagen;?>">      
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_BACK."menu.php");?>
            <div class="container">
              <h2 class="t_blanco">&nbsp;Alta de Clientes</h2>
              <p>&nbsp;</p>
             
              <div class="contenedor div_trans5">
                   <form class="form-horizontal" action="<?=DIR?>Cliente/nuevo" method="post" name="form">

                              <?php
                              if(isset($obj)&&(is_object($obj))){
                              ?>
                              <div class="col-xs-12 alert alert-danger text-center">
                                   <strong>E-Mail existente!!</strong> Elija otra direccion!!
                              </div>
                              <?php
                              }
                              if(isset($msg)){
                              ?>
                                <div class="col-xs-12 alert alert-warning text-center">
                                     <strong><?=$msg;?></strong>
                                </div>                            
                                <?php
                              }?>    

                              <p>&nbsp;</p>
                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Nombre:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="nombre" value="<?=$nombre?>" placeholder="Ingrese su Nombre" autofocus required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Apellido:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="apellido" value="<?=$apellido;?>" placeholder="Ingrese su Apellido">
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Domicilio:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="domicilio" value="<?=$domicilio;?>" placeholder="Ingrese su Domicilio">
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Localidad:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="text" name="localidad" value="<?=$localidad;?>" placeholder="Ingrese su Localidad">
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Tel&eacute;fono:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="tel" name="telefono" value="<?=$telefono;?>" placeholder="Ingrese su Tel&eacute;fono">
                                   <p>&nbsp;</p>
                              </div>                      

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">DNI:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="number" name="dni" value="<?=$dni;?>" max="99999999" pattern="[0-9]{7,8}" placeholder="Ingrese su DNI">
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Email:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="email" name="email" value="<?=$email;?>" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" placeholder="Ingrese su Email" required>
                                   <p>&nbsp;</p>
                              </div>

                              <label class="control-label col-xs-2 t_blanco" for="inputForm">Constrase&ntilde;a:&nbsp;</label>
                              <div class="col-xs-9">
                                   <input class="form-control" type="password" name="contra" required>
                                   <p>&nbsp;</p>
                              </div>

                              <div class="col-xs-12 text-center">  
                                  <input type="hidden" name="idRol" value=0>
                                  <button type="submit" class="btn btn-warning">Agregar</button>
                                  <p>&nbsp;</p>
                              </div>                    
                   </form>
              </div>
            </div> <!-- /container -->
        </div>
          <BR><BR><BR>
            <?php
                include("pie.php");
            ?>      
    </body>      
