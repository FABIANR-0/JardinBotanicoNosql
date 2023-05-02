<?php
class menu_VI
{
    function __construct(){}

    function verMenu()
    {   require_once "models/coordinador_MO.php";
        $conexion=new conexion();
        $coordinador_MO=new coordinador_MO($conexion);
        $arreglo=$coordinador_MO->seleccionar($_SESSION['documento']);

        $objeto_coordinador=$arreglo[0];
        $nombres=$objeto_coordinador->nombres;
        $apellidos=$objeto_coordinador->apellidos;
        $telefono=$objeto_coordinador->telefono;
        $correo=$objeto_coordinador->correo;
        $contrasena=$objeto_coordinador->contrasena;
        $documento=$objeto_coordinador->documento;
        ?>

  <!DOCTYPE html>
  <html lang="en">
    <head>
   
    
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Meta, title, CSS, favicons, etc. -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="imagen.jpeg"  />

      <title>Jardín Botánico</title>
      <link rel="stylesheet" href="datatables/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="datatables/datatables/datatables.min.css">
      <link rel="stylesheet" type="text/css" href="datatables/datatables/DataTables-1.12.1/css/dataTables.bootstrap4.min.css">
      <!-- Bootstrap -->
      <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
      <!-- iCheck -->
      <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
      <link rel="stylesheet" href="vendors/toastr/toastr.min.css">
      <!-- bootstrap-progressbar -->
      <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
      <!-- JQVMap -->
      <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
      <!-- bootstrap-daterangepicker -->
      <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <!-- Custom Theme Style -->
      <link href="build/css/custom.min.css" rel="stylesheet">
 
    </head>

    <body class="nav-md">
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="index.php" class="site_title"><i  class="fa fa-leaf "></i> <span>Jardín Botánico </span></a>
              </div>

              <div class="clearfix"></div>

              <!-- menu profile quick info -->
              <div class="profile clearfix">
                <div class="profile_pic">
                  <img src="production/images/user.png" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                  <span>Bienvenido</span>
                  <h2><?php echo $nombres ?> </h2>
                </div>
              </div>
              <!-- /menu profile quick info -->

              <br />

              <!-- sidebar menu -->
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                  <h3>General</h3>
                  <ul class="nav side-menu">
                    <li><a><i class="fa fa-pagelines"></i> Inventario <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="nav-item" ><a href="#" onclick="verModulo('plantas_VI/agregarPlantas');">Plantas</a></li>
                        <li class="nav-item"><a  href="#" onclick="verModulo('familias_VI/agregarFamilias');">Familias</a></li>
                        <li class="nav-item"><a  href="#" onclick="verModulo('origenes_VI/agregarOrigenes');">Origenes</a></li>
                        <li class="nav-item"><a  href="#" onclick="verModulo('estados_VI/agregarEstados');">Estados de conservacion</a></li>
                        <li  class="nav-item"><a  href="#" onclick="verModulo('habitos_VI/agregarHabitos');">Habitos de crecimiento</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-list-alt"></i> Donaciones <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="#" onclick="verModulo('donacion_saliente_co_VI/vizualizarPeticiones');">Salientes</a></li>
                        <li><a href="#"onclick="verModulo('donacion_entrante_co_VI/vizualizarDonaciones');">Entrantes</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa  fa-briefcase"></i> Entidades <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="#" onclick="verModulo('entidades_VI/agregarentidades');">Gestionar</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
                 
              </div>
              <!-- /sidebar menu -->

              <!-- /menu footer buttons -->
              <div class="sidebar-footer hidden-small">
               
                 
                  <a data-toggle="tooltip" data-placement="top" title="Logout"  href="#" onclick="salir()"  >
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
                
              </div>
              <!-- /menu footer buttons -->
            </div>
          </div>

          <!-- top navigation -->
          <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="production/images/user.png" alt=""><?php echo $nombres ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" onclick="verModulo('actCoordinador_VI/actualizarCoordinador');">Visualizar/Editar Datos</a>
                        
                      <a class="dropdown-item"  href="#" onclick="salir()" ><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a>
                    </div>
                  </li>

                
                </ul>
              </nav>
            </div>
          </div>
          <!-- /top navigation -->

          <!-- page content -->
          <div class="right_col" role="main">
            <!-- top tiles -->
            <div class="content"   >
              <div class="tile_count" id="contenido">
               
               
              </div>
            </div>
          </div>
          
       
        </div>
        <div class="modal fade" id="Ventana_Modal" tabindex="-1" aria-labelledby="titulo_modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="titulo_modal"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="contenido_modal">

                            </div>
                        </div>
                    </div>
                </div>
        <footer class="main-footer navbar  navbar-dark">
                    <strong> </strong> Jardin Botánico Jorge Enrique Quintero Arenas
                </footer>
      </div>
   
      <!-- jQuery -->
      <script src="vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="vendors/iCheck/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="vendors/Flot/jquery.flot.js"></script>
      <script src="vendors/Flot/jquery.flot.pie.js"></script>
      <script src="vendors/Flot/jquery.flot.time.js"></script>
      <script src="vendors/Flot/jquery.flot.stack.js"></script>
      <script src="vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="vendors/moment/min/moment.min.js"></script>
      <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
      <script src="vendors/toastr/toastr.min.js"></script>
      
      <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
      <!--script src="datatables/jquery/jquery.min.js"></script>
      <script src="datatables/bootstrap/js/bootstrap.min.js"></script-->
      <script type="text/javascript" src="datatables/datatables/datatables.min.js"></script>
      <script type="text/javascript" src="datatables/main.js"></script>

      <script src="datatables/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
      <script src="datatables/datatables/JSZip-2.5.0/jszip.min.js"></script>    
      <script src="datatables/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
      <script src="datatables/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
      <script src="datatables/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
      <script src="https://kit.fontawesome.com/7d38072211.js" crossorigin="anonymous"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <!-- Custom Theme Scripts -->
      <script src="build/js/custom.min.js"></script>
      <script>
                  function verModulo(ruta) {

                      $.post(ruta, function(respuesta) {
                          $('#contenido').html(respuesta);
                      });
                  }

                  function salir() {
                      $.post('accesos_CO/salir', function() {
                          location.href = "index.php";
                      });
                  }
                  function sololetras(e){
            
                      key=e.keyCode || e.which;
                      
                      teclado = String.fromCharCode(key).toLowerCase();
                      
                      letras = " abcdefghijklmnñopqrstuvwxyz";
                      
                      especiales = " 8-37-38-46-164";
                      
                      teclado_especial = false;
                      
                      for(var i in especiales){
                      if(key==especiales[i]){
                          teclado_especial=true; break;
                      
                      }}
                      
                      if(letras.indexOf(teclado)==-1 && !teclado_especial){
                      return false;
                    }
                  
                  }
                
            function verActualizarCoordinador() {
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_coordinador">
                                    <div class="form-group">
                                        <label for="nomnre">nombre del coordinador</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="familia" name="familia"
                                            value="<?php echo $nombres ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="caracteristica" name="caracteristica"
                                            value="<?php echo $apellidos ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono"
                                            value="<?php echo $telefono ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input type="text" class="form-control" id="correo" name="correo"
                                            value="<?php echo $correo ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasena">Contrasena</label>
                                        <input type="text" class="form-control" id="contrasena" name="contrasena"
                                            value="<?php echo $contrasena ?>">
                                    </div>
                                    
                                    <input type="hidden" id="doc" name="documento" value="<?php echo $documento ?>">
                                    <button type="button" onclick="actualizarcoordinador();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar Datos Coordinador';

                document.querySelector('#contenido_modal').innerHTML = cadena;
                console.log('fwffdddddddddddwf');
                }

               
              </script>
    </body>
  </html>

      
<?php
  }
}
?>