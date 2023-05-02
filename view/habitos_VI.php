<?php

class habitos_VI
{

    function __construct()
    {
    }

    function agregarHabitos()
    {

        require_once "models/habitos_MO.php";
        $conexion = new conexion();
        $habitos_MO = new habitos_MO($conexion);
        $arreglo_habito = $habitos_MO->seleccionar();

?>
        <div class="card">
        <div class="card-header">
                Agregar habito de crecimiento
            </div>
            <div class="card-body">
                <form id="formulario_agregar_habito">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Codigo habito</label>
                                <input type="text" class="form-control" id="codigo" name="codigo">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">nombre habito de crecimiento</label>
                                <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="button" onclick="agregarhabito();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar habitos de crecimiento
            </div>
            <div class="card-body">

                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Codigo Habito</th>
                            <th style="text-align: center;">Nombre Habito</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_habito">
                        <?php
                        if ($arreglo_habito) {

                            foreach ($arreglo_habito as $objeto_habito) {

                                $codigo = $objeto_habito->cod_habito;
                                $nombre = $objeto_habito->nombre_habito;
                        ?>
                                <tr>
                                    <td id="codigo_td_<?php echo $codigo; ?>"> <?php echo $codigo; ?> </td>
                                    <td id="nombre_td_<?php echo $codigo; ?>"> <?php echo $nombre; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="codigo_<?php echo $codigo; ?>" value="<?php echo $codigo; ?>">
                                        <input type="hidden" id="nombre_<?php echo $codigo; ?>" value="<?php echo $nombre; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarhabito('<?php echo $codigo; ?>')"></i>
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
            function agregarhabito() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_habito'));

                fetch('habitos_CO/agregarhabitos', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let codigo = document.querySelector('#formulario_agregar_habito #codigo').value;
                        let nombre = document.querySelector('#formulario_agregar_habito #nombre').value;
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="codigo_td_${codigo}"> ${codigo} </td>
                                            <td id="nombre_td_${codigo}"> ${nombre } </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="codigo_${codigo}" value="${codigo}">
                                                <input type="hidden" id="nombre_${codigo}" value="${nombre }">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarhabito('${codigo}')"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_habito').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_habito ').reset();

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarhabito(cod) {

                let codigo = document.querySelector('#codigo_' + cod).value;
                let nombre = document.querySelector('#nombre_' + cod).value;
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_habito">

                              
                          
                                    <div class="form-group">
                                        <label for="codigo">Codigo del origen</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                            value="${codigo}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre del origen</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre"
                                            value="${nombre}">
                                    </div>
                                    <input type="hidden" id="codige" name="codige" value="${codigo}">
                                    <button type="button" onclick="actualizarhabito();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar habito';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarhabito() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_habito'));

                fetch('habitos_CO/actualizarhabitos', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let codigo = document.querySelector('#formulario_actualizar_habito #codigo').value;

                            let codige = document.querySelector('#formulario_actualizar_habito #codige').value;

                            let nombre = document.querySelector('#formulario_actualizar_habito #nombre').value;

                            document.querySelector('#codigo_td_' + codige).innerHTML = codigo;
                            document.querySelector('#codigo_' + codige).value = codigo;
                            document.querySelector('#nombre_td_' + codige).innerHTML = nombre;
                            document.querySelector('#nombre_' + codige).value = nombre;
                            document.querySelector('#codige').value = codigo;


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