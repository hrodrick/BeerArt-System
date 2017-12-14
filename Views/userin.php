    <?php
    $i = rand(1,9);
    $imagen="0".$i.".jpg";
    ?>   
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>    
    <body background="<?=DIR.URL_IMG.$imagen;?>">      
        <div id="wrapper">
            <div id="encabezado"></div>
            <?php include(URL_VISTA_FRONT."menu.php");?>
            <div class="container">
              <p>&nbsp;</p>
              <div class="contenedor div_trans5 text-center">
                <form class="form-signin" method="post" action="<?=DIR?>Front/chq">

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
                      <p>&nbsp;</p>

                      <div class="input-group col-xs-3 div-center">
                        <form action="<?=DIR?>Front/facebookChq" method="post" id="fb">                        
                          <input type="hidden" name="usuario" id='user'>                             
                          <fb:login-button data-size="large" data-button-type="login_with" scope="public_profile,email" onlogin="checkLoginState();"> </fb:login-button>                          
       <!--                   <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div> -->
                        </form>
                      </div>                
              <BR><BR><BR>
              </div>
            </div> <!-- /container -->
        </div>
            <?php
                include("pie.php");
            ?>      
    </body>      
