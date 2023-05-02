<?php

class entidades_VI
{

    function __construct()
    {
    }

    function agregarentidades()
    {

        require_once "models/entidad_MO.php";
        $conexion = new conexion();
        $entidades_MO = new entidad_MO($conexion);
        $arreglo_entidad= $entidades_MO->seleccionar();

?>
        <div class="card">
        <div class="card-header">
                Agregar entidades 
            </div>
            <div class="card-body">
                <form id="formulario_agregar_entidad">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nit">NIT Entidad</label>
                                <input    type="number" class="form-control" id="nit" name="nit">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">nombre Entidad</label>
                                <input   type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Tipo de Entidad</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="PRIVADA">PRIVADA</option>
                                    <option value="PUBLICA">PUBLICA</option>
                                </select>
                                <!--input onkeypress="return sololetras(event)"  type="text" class="form-control" id="tipo" name="tipo"-->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Telefono</label>
                                <input   type="number" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="nombre">Correo de la Entidad</label>
                                <input   type="text" class="form-control" id="correo" name="correo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Contraseña</label>
                                <input    type="text" class="form-control" id="contrasena" name="contrasena">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <button type="button" onclick="agregarentidad();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar entidades
            </div>
            <div class="card-body">

                <table id="example1" class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nit</th>
                            <th style="text-align: center;">Nombre </th>
                            <th style="text-align: center;">Tipo </th>
                            <th style="text-align: center;">Telefono </th>
                            <th style="text-align: center;">correo</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_entidad">
                        <?php
                        if ($arreglo_entidad) {

                            foreach ($arreglo_entidad as $objeto_entidad) {

                                $nit = $objeto_entidad->nit;
                                $nombre = $objeto_entidad->nombre_entidad;
                                $tipo = $objeto_entidad->tipo_entidad;
                                $telefono = $objeto_entidad->telefono;
                                $correo = $objeto_entidad->correo;
                        ?>
                                <tr>
                                    <td id="nit_td_<?php echo $nit; ?>"> <?php echo $nit; ?> </td>
                                    <td id="nombre_td_<?php echo $nit; ?>"> <?php echo $nombre; ?> </td>
                                    <td id="tipo_td_<?php echo $nit; ?>"> <?php echo $tipo; ?> </td>
                                    <td id="telefono_td_<?php echo $nit; ?>"> <?php echo $telefono; ?> </td>
                                    <td id="correo_td_<?php echo $nit; ?>"> <?php echo $correo; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="nit_<?php echo $nit; ?>" value="<?php echo $nit; ?>">
                                        <input type="hidden" id="nombre_<?php echo $nit; ?>" value="<?php echo $nombre; ?>">
                                        <input type="hidden" id="tipo_<?php echo $nit; ?>" value="<?php echo $tipo; ?>">
                                        <input type="hidden" id="telefono_<?php echo $nit; ?>" value="<?php echo $telefono; ?>">
                                        <input type="hidden" id="correo_<?php echo $nit; ?>" value="<?php echo $correo; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarentidad('<?php echo $nit; ?>')"></i>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>


            </div>
        </div>
        <script type="text/javascript" src="datatables/ent.js"></script>
        <script>
            function agregarentidad() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_entidad'));
                //console.log(cadena);
                fetch('entidades_CO/agregarentidades', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let nit = document.querySelector('#formulario_agregar_entidad #nit').value;
                        let nombre = document.querySelector('#formulario_agregar_entidad #nombre').value;
                        let tipo = document.querySelector('#formulario_agregar_entidad #tipo').value;
                        let telefono = document.querySelector('#formulario_agregar_entidad #telefono').value;
                        let correo = document.querySelector('#formulario_agregar_entidad #correo').value;
                        let contrasena = document.querySelector('#formulario_agregar_entidad #contrasena').value;
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="nit_td_${nit}"> ${nit} </td>
                                            <td id="nombre_td_${nit}"> ${nombre } </td>
                                            <td id="tipo_td_${nit}"> ${tipo } </td>
                                            <td id="telefono_td_${nit}">${telefono }  </td>
                                            <td id="correo_td_${nit}">${contrasena }  </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="nit_${nit}" value="${nit}">
                                                <input type="hidden" id="nombre_${nit}" value="${nombre}">
                                                <input type="hidden" id="tipo_${nit}" value="${tipo}">
                                                <input type="hidden" id="telefono_${nit}" value="${telefono}">
                                                <input type="hidden" id="correo_${nit}" value="${correo}">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarentidad('${nit}')"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_entidad').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_entidad ').reset();

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarentidad(nit) {
                let nitt = document.querySelector('#nit_' + nit).value;
                let nombre = document.querySelector('#nombre_' + nit).value;
                let tipo = document.querySelector('#tipo_' + nit).value;
                let telefono = document.querySelector('#telefono_' + nit).value;
                let correo = document.querySelector('#correo_' + nit).value;
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_entidad">

                              
                          
                                    <div class="form-group">
                                        <label for="nombre">nombre de la entidad</label>
                                        <input     type="text" class="form-control" id="nombre" name="nombre"
                                            value="${nombre}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo">tipo de entidad</label>
                
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="${tipo}">${tipo}</option>
                                            <option value="PRIVADA">PRIVADA</option>
                                            <option value="PUBLICA">PUBLICA</option>
                                        </select>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="nit">telefono de la entidad</label>
                                        <input   type="number" class="form-control" id="telefono" name="telefono"
                                            value="${telefono}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">correo</label>
                                        <input type="text" class="form-control" id="correo" name="correo"
                                            value="${correo}">
                                    </div>
                                    <input type="hidden" id="nit" name="nit" value="${nit}">
                                    <button type="button" onclick="actualizarentidad();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar entidad';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarentidad() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_entidad'));

                fetch('entidades_CO/actualizarentidades', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let nit = document.querySelector('#formulario_actualizar_entidad #nit').value;
                            let nombre = document.querySelector('#formulario_actualizar_entidad #nombre').value;
                            let tipo = document.querySelector('#formulario_actualizar_entidad #tipo').value;
                            let telefono = document.querySelector('#formulario_actualizar_entidad #telefono').value;
                            let correo = document.querySelector('#formulario_actualizar_entidad #correo').value;
                            

                            document.querySelector('#nit_td_' + nit).innerHTML = nit;
                            document.querySelector('#nit_' + nit).value = nit;
                            document.querySelector('#nombre_td_' + nit).innerHTML = nombre;
                            document.querySelector('#nombre_' + nit).value = nombre;
                            document.querySelector('#tipo_td_' + nit).innerHTML = tipo;
                            document.querySelector('#tipo_' + nit).value = tipo;
                            document.querySelector('#telefono_td_' + nit).innerHTML = telefono;
                            document.querySelector('#telefono_' + nit).value = telefono;
                            document.querySelector('#correo_td_' + nit).innerHTML = correo;
                            document.querySelector('#correo_' + nit).value = correo;

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