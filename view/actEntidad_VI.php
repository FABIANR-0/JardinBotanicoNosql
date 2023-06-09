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
        foreach ($arreglo as $document) {

            $nombre=$document['entity_name'];
            $tipo=$document['entity_type'];
            $telefono=$document['cellphone'];;
            $correo=$document['email'];;
            $contrasena=$document['password'];;
            $nit=$document['nit'];;
           
  
          }
        

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
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
                                            <option value="PRIVADA">PRIVADA</option>
                                            <option value="PUBLICA">PUBLICA</option>
                                        </select>
                                         
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