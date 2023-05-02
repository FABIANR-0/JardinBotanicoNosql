<?php

class origenes_VI
{

    function __construct()
    {
    }

    function agregarOrigenes()
    {

        require_once "models/origenes_MO.php";
        $conexion = new conexion();
        $origenes_MO = new origenes_MO($conexion);
        $arreglo_origenes = $origenes_MO->seleccionar();

?>
        <div class="card">
        <div class="card-header">
                Agregar origenes
            </div>
            <div class="card-body">
                <form id="formulario_agregar_origenes">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Codigo origen</label>
                                <input type="text" class="form-control" id="codigo" name="codigo">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">nombre origen</label>
                                <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="button" onclick="agregarorigenes();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar origenes
            </div>
            <div class="card-body">

                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Codigo Origen</th>
                            <th style="text-align: center;">Nombre Origen</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_origenes">
                        <?php
                        if ($arreglo_origenes) {

                            foreach ($arreglo_origenes as $objeto_origenes) {

                                $codigo = $objeto_origenes->cod_origen;
                                $nombre = $objeto_origenes->nombre_origen;
                        ?>
                                <tr>
                                    <td id="codigo_td_<?php echo $codigo; ?>"> <?php echo $codigo; ?> </td>
                                    <td id="nombre_td_<?php echo $codigo; ?>"> <?php echo $nombre; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="codigo_<?php echo $codigo; ?>" value="<?php echo $codigo; ?>">
                                        <input type="hidden" id="nombre_<?php echo $codigo; ?>" value="<?php echo $nombre; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarorigenes('<?php echo $codigo; ?>')"></i>
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

        <script>
            function agregarorigenes() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_origenes'));

                fetch('origenes_CO/agregarorigenes', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let codigo = document.querySelector('#formulario_agregar_origenes #codigo').value;
                        let nombre = document.querySelector('#formulario_agregar_origenes #nombre').value;
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="codigo_td_${codigo}"> ${codigo} </td>
                                            <td id="nombre_td_${codigo}"> ${nombre } </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="codigo_${codigo}" value="${codigo}">
                                                <input type="hidden" id="nombre_${codigo}" value="${nombre }">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarorigenes('${codigo}')"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_origenes').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_origenes ').reset();

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarorigenes(cod) {

                let codigo = document.querySelector('#codigo_' + cod).value;
                let nombre = document.querySelector('#nombre_' + cod).value;
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_origenes">

                              
                          
                                    <div class="form-group">
                                        <label for="codigo">Codigo del origen</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                            value="${codigo}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre del origen</label>
                                        <input onkeypress="return sololetras(event)" type="text" class="form-control" id="nombre" name="nombre"
                                            value="${nombre}">
                                    </div>
                                    <input type="hidden" id="codige" name="codige" value="${codigo}">
                                    <button type="button" onclick="actualizarorigenes();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar origenes';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarorigenes() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_origenes'));

                fetch('origenes_CO/actualizarorigenes', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let codigo = document.querySelector('#formulario_actualizar_origenes #codigo').value;

                            let codige = document.querySelector('#formulario_actualizar_origenes #codige').value;

                            let nombre = document.querySelector('#formulario_actualizar_origenes #nombre').value;

                            document.querySelector('#codigo_td_' + codige).innerHTML = codigo;
                            document.querySelector('#codigo_' + codige).value = codigo;
                            document.querySelector('#nombre_td_' + codige).innerHTML = nombre;
                            document.querySelector('#nombre_' + codige).value = nombre;



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