<?php
class accesos_VI
{
    function __construct(){}
   
    function iniciarSesion()
    {
      require_once "librerias/front_controller.php";
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
              <title>Jardín Botánico </title>

              <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
              <!-- Font Awesome -->
              <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
              <!-- NProgress -->
              <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
              <!-- Animate.css -->
              <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

              <!-- Custom Theme Style -->
              <link href="build/css/custom.min.css" rel="stylesheet">
             
          
            </head>

            <body  class="login" >
              <!--img src="login.jpg"-->
              <div class="login">
                <a class="hiddenanchor" id="signup"></a>
                <a class="hiddenanchor" id="signin"></a>

                <div class="login_wrapper">
                  <div class="animate form login_form">
                    <section class="login_content">
                      <form action="index.php" id="login" method="post">
                        <h1>INICIAR SESIÓN</h1>
                        <div class="input-group mb-2">
                          <input type="email" name="correo" class="form-control" placeholder="Correo">
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" name="contrasena" class="form-control" placeholder="contrasena">
                        </div>
                        <div>
                      
                          <button type="button" onclick="iniciarSesion();"class="btn btn-success ">Iniciar Sesi&oacute;n</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                          <p class="change_link">Aun no tienes cuenta
                            <a href="#signup" class="to_register"> Registrate </a>
                          </p>

                          <div class="clearfix"></div>
                         

                          <div>
                              <h1><i class="fa fa-leaf"></i> Jardín Botánico</h1>
                              <p>Jardín Botánico Jorge Enrique Quintero Arenas</p>
                            
                          </div>
                        </div>
                      </form>
                    </section>
                  </div>

                  <div id="register" class="animate form registration_form">
                    <section class="login_content">
                      <form method="post" id="formulario_registrarse">
                        <h1>Registarse</h1>
                        <div>
                          <input type="number" class="form-control" name="nit" placeholder="Nit" required="" />
                        </div>
                        <br>
                        <div>
                          <input type="text" class="form-control" name="nombre" placeholder="Nombre entidad" required="" />
                        </div>
                        <div>
                          <input type="text" class="form-control" name="tipo" placeholder="Tipo entidad" required="" />
                        </div>
                        <div>
                          <input type="number" class="form-control" name="telefono" placeholder="Telefono" required="" />
                        </div>
                        <br>
                        <div>
                          <input type="email" class="form-control" name="correoen" placeholder="Correo" required="" />
                        </div>
                        <div>
                          <input type="password" class="form-control" name="contrasenaen" placeholder="Contraseña" required="" />
                        </div>
                        <div>
                          <button href="#signin" type="button" onclick="registrar();" class="btn btn-success">Registrarse</button>  
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                          <p class="change_link"> 
                            <a href="#signin" class="to_register"> Iniciar Sesi&oacute;n </a>
                          </p>

                          <div class="clearfix"></div>
                          <br />

                          <div>
                          <h1><i class="fa fa-leaf  "></i> Jardín Botánico</h1>
                              <p>Jardín Botánico Jorje Enrique Quintero Arenas</p>
                          </div>
                        </div>
                      </form>
                    </section>
                  </div>
                </div>
              </div>
            </body>
          </html>
           
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
              function registrar() {
            
                  var cadena = new FormData(document.querySelector('#formulario_registrarse'));
                  
                  fetch('./controllers/entidad_CO.php', {
                          method: 'POST',
                          body: cadena
                      })
                      .then(respuesta => respuesta.json())
                      .then(respuesta => {

                          if (respuesta.estado == 'EXITO') {
                            document.querySelector('#formulario_registrarse ').reset();
                            Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              text: respuesta.mensaje,
                              showConfirmButton: false,
                              timer: 1500
                            });

                          } else if (respuesta.estado = 'ERROR') {
                            Swal.fire({
                              position: 'top-end',
                              icon: 'error',
                              text: respuesta.mensaje,
                              showConfirmButton: false,
                              timer: 3000
                            });
                          } else if (respuesta.estado = 'ADVERTENCIA') {
                            Swal.fire({
                              position: 'top-end',
                              icon: 'warning',
                              text: respuesta.mensaje,
                              showConfirmButton: false,
                              timer: 1500
                            });
                              toastr.error(respuesta.mensaje);

                          } else {

                              toastr.error('No se devolvio un estado');
                          }
                      });
              }
              function iniciarSesion() {
            
            var cadena = new FormData(document.querySelector('#login'));
            
            fetch('./controllers/accesos1_CO.php', {
                    method: 'POST',
                    body: cadena
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {

                    if (respuesta.estado == 'EXITO') {
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: respuesta.mensaje ,
                        showConfirmButton: false,
                        timer: 3000
                      });
                     setTimeout(function () {
                      location.href = "index.php";
                      }, 3000);

                    } else if (respuesta.estado = 'ERROR') {
                      Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: respuesta.mensaje,
                        showConfirmButton: false,
                        timer: 3000
                      });
                    } else if (respuesta.estado = 'ADVERTENCIA') {
                      Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        text: respuesta.mensaje,
                        showConfirmButton: false,
                        timer: 1500
                      });
                        toastr.error(respuesta.mensaje);

                    } else {

                        toastr.error('No se devolvio un estado');
                    }
                });
        }
          </script>
        <?php
      
    }
}
?>
    
 

