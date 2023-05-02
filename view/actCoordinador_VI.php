<?php

class actCoordinador_VI
{

    function __construct()
    {
    }

    function actualizarCoordinador()
    {require_once "models/coordinador_MO.php";
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
        <div class="card">
        <div class="card-header">
               Actualizar Datos del coordinador
            </div>
            <div class="card-body">
                <form id="formulario_actualizar_coordinador">

                <div class="form-group">
                                        <label for="nomnre">nombre del coordinador</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="familia" name="nombres"
                                            value="<?php echo $nombres ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="apellidos" name="apellidos"
                                            value="<?php echo $apellidos ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="number" class="form-control" id="telefono" name="telefono"
                                            value="<?php echo $telefono ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo"
                                            value="<?php echo $correo ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasena">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                                            value="<?php echo $contrasena ?>">
                                    </div>
                                    
                                    <input type="hidden" id="doc" name="documento" value="<?php echo $documento ?>">
                                    <button type="button" onclick="actualizarcoordinador();" class="btn btn-success float-right">Actualizar</button>
                    <br>

                </form>
            </div>
        </div>
        <script>

            function actualizarcoordinador() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_coordinador'));

                fetch('coordinador_CO/actualizarcoordinador', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {

                            toastr.success(respuesta.mensaje);

                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else if (respuesta.estado = 'ADVERTENCIA') {

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