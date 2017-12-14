    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?> 
    <body background="<?=DIR.URL_IMG.$imagen;?>">      
        <div id="wrapper">
            <div id="encabezado"></div>

            <div class="container">
              <p>&nbsp;</p>
              <div class="contenedor div_trans5 text-center">
                <form class="form-signin" method="post" action="<?=DIR?>Usuario/chq">

                      <h2 class="t_blanco">Please sign in</h2>
                     <?php
                     if(isset($error)){ 
                      ?>
                      <div class="input-group col-xs-3 div-center alert alert-danger">
                           <strong><?=$error?> Incorrecto!!!</strong> Intente nuevamente!!!
                      </div>
                      <?php
                      }
                      ?>
                      <p>&nbsp;</p>

                      <div class="input-group col-xs-3 div-center">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-user text-warning"></i></span>
                           <input type="text" id="inputText" class="form-control input-lg" placeholder="User" name="user" required autofocus>
                      </div>
                
                      <p>&nbsp;</p>
                
                      <div class="input-group col-xs-3 div-center">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock text-warning"></i></span>
                           <input type="password" id="inputPassword" class="form-control input-lg" placeholder="Password" name="pass" required>
                      </div>

                      <p>&nbsp;</p>

                      <div class="input-group col-xs-3 div-center">
                          <button class="btn btn-lg btn-warning btn-block" type="submit">Sign in</button>
                      </div>
               </form>
             
              <BR><BR><BR>
              </div>
            </div> <!-- /container -->
        </div>
            <?php
                include("pie.php");
            ?>      
    </body>      
