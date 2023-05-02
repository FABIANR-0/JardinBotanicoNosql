<?php

class actEntidad_VI
{

    function __construct()
    {
    }

    function actualizarEntidad()
    {require_once "models/entidad_MO.php";
        $conexion=new conexion();
        $entidad_MO=new entidad_MO($conexion);
        $arreglo=$entidad_MO->seleccionar($_SESSION['nit']);

        $objeto_entidad=$arreglo[0];
        $nombre=$objeto_entidad->nombre_entidad;
        $tipo=$objeto_entidad->tipo_entidad;
        $telefono=$objeto_entidad->telefono;
        $correo=$objeto_entidad->correo;
        $contrasena=$objeto_entidad->contrasena;
        $nit=$objeto_entidad->nit;

?>
        <div class="card">
        <div class="card-header">
               Actualizar Datos de la entidad
            </div>
            <div class="card-body">
                <form id="formulario_actualizar_entidad">

                <div class="form-group">
                                        <label for="nomnre">nombre del entidad</label>
                                        <input  type="text" class="form-control" id="nombre" name="nombre"
                                            value="<?php echo $nombre ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Tipo</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="tipo" name="tipo"
                                            value="<?php echo $tipo ?>">
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
                                    
                                    <input type="hidden" id="nit" name="nit" value="<?php echo $nit ?>">
                                    <button type="button" onclick="actualizarentidad();" class="btn btn-success float-right">Actualizar</button>
                    <br>

                </form>
            </div>
        </div>
        <script>

            function actualizarentidad() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_entidad'));

                fetch('entidades_CO/actualizarentidad', {
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