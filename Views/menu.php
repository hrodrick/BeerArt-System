      <!-- Static navbar -->
<nav class="navbar navbar-inverse" style="margin-top:6px;">
  <div class="container-fluid div_trans8">
    <header>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
          <span class="sr-only">Menu</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar-1">
      <ul class="nav navbar-nav">
        <li><a href="<?=DIR?>Front/inicio" data-toggle="tooltip" title="Ir al Menu Principal"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="<?=DIR?>Front/listBeer" data-toggle="tooltip" title="Productos"><span class="glyphicon glyphicon-grain"></span> Productos</a></li>
        <li><a href="<?=DIR?>Front/contacto" data-toggle="tooltip" title="Contacto"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
        <li><a href="<?=DIR?>Front/registro" data-toggle="tooltip" title="Registro"><span class="glyphicon glyphicon-user"></span> Registrese</a></li>
      </ul>
      <?php
        if(isset($_SESSION['usuario'])){
      ?>
                     <div id="MisDatos<?= $_SESSION['usuario']->getId();?>" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                   <div class="modal-header modal-header-warning">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4>Datos del Usuario</h4>
                                   </div>
                                   <div class="modal-body">
                                        <h4 align="center"><?php echo $_SESSION['usuario']->getNombre().' '.$_SESSION['usuario']->getApellido();?></h4>
                                        <h5>Domicilio: <?php echo $_SESSION['usuario']->getDomicilio();?></h5>
                                        <h5>Localidad: <?php echo $_SESSION['usuario']->getLocalidad();?></h5>                                                          
                                        <h5>Telefono: <?php echo $_SESSION['usuario']->getTelefono();?></h5>                                                         
                                        <h5>DNI: <?php echo $_SESSION['usuario']->getDni();?></h5>                                                      
                                        <h5>E-Mail: <?php echo $_SESSION['usuario']->getEmail();?></h5>                                                            
                                   </div>
                                   <div class="modal-footer">                        
                                        <a href="<?=DIR?>Front/edit/<?= urlencode(base64_encode($_SESSION['usuario']->getId()));?>" data-toggle="tooltip" title="Modificar Mis Datos" class="btn btn-primary">Modificar</a>
                                        <a href="#" data-dismiss="modal" class="btn btn-warning">Cerrar</a>
                                   </div>
                              </div>
                          </div>
                     </div>
      <?php
      if(isset($_SESSION['pedido'])){
      ?>                      
      <ul class="nav navbar-nav navbar-right">
          <li><a href="<?=DIR?>Pedido/myCart" data-toggle="tooltip" title="Mi Carro"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge warning"><?=$_SESSION['pedido']->contarLineas()?></span></a></li>   
      <?php
      }else{
      ?>
      <ul class="nav navbar-nav navbar-right">        
      <?php      
      }
      ?>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title=""><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['usuario']->getNombre().' '.$_SESSION['usuario']->getApellido()?> <span class="caret"></span></a>
          <ul class="dropdown-menu">        
            <li><a data-toggle="modal" href="#MisDatos<?= $_SESSION['usuario']->getId();?>" data-toggle="tooltip" title="Ver Mis Datos"><span class="glyphicon glyphicon-user"></span> Mis Datos</a></li>
            <li><a href="<?=DIR?>Pedido/myCart"  data-toggle="modal"data-toggle="tooltip" title="Ver Mi Carro"><span class="glyphicon glyphicon-shopping-cart"></span> Mi Carro</a></li>
            <li><a href="<?=DIR?>Pedido/pedidos"  data-toggle="modal"data-toggle="tooltip" title="Ver Mis Pedidos"><span class="glyphicon glyphicon-th-list"></span> Mis Pedidos</a></li>
         <?php
         if($_SESSION['usuario']->getIdRol()){
         ?>   
            <li><a href="<?=DIR?>Usuario/index" target="_blank" data-toggle="modal"data-toggle="tooltip" title="Ir al Panel de Control"><span class="glyphicon glyphicon-tasks"></span> Panel de Control</a></li>
          <?php
          }
          ?>            
            <li><a href="<?=DIR?>Front/logOut" data-toggle="tooltip" title="Cerrar Sesion"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
          </ul>
        </li> 
      </ul>
      <?php
      }else{
      ?>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="<?=DIR?>Front/userin" data-toggle="tooltip" title="Iniciar Sesion"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
      </ul>
      <?php
      }
      ?>
    </div>
    </header>
  </div>
</nav>
