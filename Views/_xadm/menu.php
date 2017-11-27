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
        <li><a href="<?=DIR?>Usuario/index" data-toggle="tooltip" title="Ir al Menu Principal"><span class="glyphicon glyphicon-home"></span> Home</a></li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title="Alta - Baja - Listados y Modificaciones de Roles">Roles <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=DIR?>Rol/roladd" data-toggle="tooltip" title="Alta de Roles">Alta</a></li>
            <li><a href="<?=DIR?>Rol/listado" data-toggle="tooltip" title="Listado de Roles">Listado</a></li>
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title="Alta - Baja - Listados y Modificaciones de Personal">Personal <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=DIR?>Usuario/useradd" data-toggle="tooltip" title="Alta de Personal">Alta</a></li>
            <li><a href="<?=DIR?>Usuario/listado" data-toggle="tooltip" title="Listado de Personal">Listado</a></li>
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title="Alta - Baja - Listados y Modificaciones de Sucursales">Sucursales <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=DIR?>Sucursal/sucadd" data-toggle="tooltip" title="Alta de Sucursales">Alta</a></li>
            <li><a href="<?=DIR?>Sucursal/listado" data-toggle="tooltip" title="Listado de Sucursales">Listado</a></li>
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title="Alta - Baja - Listados y Modificaciones de Clientes">Clientes <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=DIR?>Cliente/cliadd" data-toggle="tooltip" title="Alta de Clientes">Alta</a></li>
            <li><a href="<?=DIR?>Cliente/listado" data-toggle="tooltip" title="Listado de Clientes">Listado</a></li>
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title="Alta - Baja - Listados y Modificaciones de Cervezas">Cervezas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=DIR?>Cerveza/ceradd" data-toggle="tooltip" title="Alta de Cervezas">Alta</a></li>
            <li><a href="<?=DIR?>Cerveza/listado" data-toggle="tooltip" title="Listado de Cervezas">Listado</a></li>
            <li role="separator" class="divider"></li>            
            <li><a href="<?=DIR?>Cerveza/listadoConEnv" data-toggle="tooltip" title="Envases por Cerveza">Envases por Cerveza</a></li>              
          </ul>
        </li>

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title="Alta - Baja - Listados y Modificaciones de Envases">Envases <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=DIR?>Envase/envadd" data-toggle="tooltip" title="Alta de Envases">Alta</a></li>
            <li><a href="<?=DIR?>Envase/listado" data-toggle="tooltip" title="Listado de Envases">Listado</a></li>         
          </ul>
        </li> 

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title="Control de Pedidos">Pedidos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=DIR?>Pedido/estadoPedidos" data-toggle="tooltip" title="Cambio Estado">Cambio Estado</a></li>
            <li><a href="<?=DIR?>Pedido/listadoPorCliente" data-toggle="tooltip" title="Listados de Pedidos">Listado Por Cliente</a></li>         
            <li><a href="<?=DIR?>Pedido/listadoPorFecha" data-toggle="tooltip" title="Listados de Pedidos">Listado Por Fecha</a></li>         
            <li><a href="<?=DIR?>Pedido/listadoPorSucursal" data-toggle="tooltip" title="Listados de Pedidos">Listado Por Sucursal</a></li>         
            <li><a href="<?=DIR?>Pedido/estadoPedidos" data-toggle="tooltip" title="Listados de Pedidos">Listado Por Cerveza</a></li>         
          </ul>
        </li> 

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip"
            title="Datos de las ventas">Ventas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li> 
              <a href="<?=DIR?>Usuario/litrosVendidosEntreFechas" data-toggle="tooltip" title="litros vendidos entre fechas"> Lts. vendidos por  período</a> 
            </li>
          </ul>
        </li> 

      </ul>
 

                     <div id="MisDatos<?= $_SESSION['usuario']->getId();?>" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                   <div class="modal-header modal-header-warning">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4>Datos del Usuario</h4>
                                   </div>
                                   <div class="modal-body">
                                        <h4><?php echo $_SESSION['usuario']->getNombre().' '.$_SESSION['usuario']->getApellido();?></h4>
                                        <h5><?php echo $_SESSION['usuario']->getDomicilio();?></h5>
                                        <h5><?php echo $_SESSION['usuario']->getLocalidad();?></h5>                                                          
                                        <h5><?php echo $_SESSION['usuario']->getTelefono();?></h5>                                                         
                                        <h5><?php echo $_SESSION['usuario']->getDni();?></h5>                                                      
                                        <h5><?php echo $_SESSION['usuario']->getEmail();?></h5>                                                             
                                   </div>
                                   <div class="modal-footer">                        
                                        <a href="<?=DIR?>Usuario/darseDeBaja/<?= urlencode(base64_encode($_SESSION['usuario']->getId()));?>" data-toggle="tooltip" title="Eliminar usuario" class="btn btn-danger">Darme de baja</a>
                                        <a href="<?=DIR?>Usuario/edit/<?= urlencode(base64_encode($_SESSION['usuario']->getId()));?>" data-toggle="tooltip" title="Modificar Mis Datos" class="btn btn-primary">Modificar</a>
                                        <a href="#" data-dismiss="modal" class="btn btn-warning">Cerrar</a>
                                   </div>
                              </div>
                          </div>
                     </div> 

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-toggle="tooltip" title=""><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['usuario']->getNombre().' '.$_SESSION['usuario']->getApellido()?> <span class="caret"></span></a>
          <ul class="dropdown-menu">        
            <li><a data-toggle="modal" href="#MisDatos<?= $_SESSION['usuario']->getId();?>" data-toggle="tooltip" title="Ver Mis Datos"><span class="glyphicon glyphicon-user"></span> Mis Datos</a></li>
            <li><a href="<?=DIR?>Usuario/logOut" data-toggle="tooltip" title="Cerrar Sesion"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
          </ul>
        </li> 
      </ul>
    </div>
    </header>
  </div>
</nav>
