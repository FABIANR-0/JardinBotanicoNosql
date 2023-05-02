<?php

class familias_VI
{

    function __construct()
    {
    }

    function agregarFamilias()
    {

        require_once "models/familias_MO.php";
        $conexion = new conexion();
        $familias_MO = new familias_MO($conexion);
        $arreglo_familias = $familias_MO->seleccionar();

?>
        <div class="card">
            <div class="card-header">
                Agregar familias
            </div>
            <div class="card-body">
                <form id="formulario_agregar_familias">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="familia">Nombre Familia</label>
                                <input onkeypress="return sololetras(event)" type="text" class="form-control" id="familia" name="familia">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="caracteristica">Caracteristica</label>
                                <input type="text" class="form-control" id="caracteristica" name="caracteristica">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="button" onclick="agregarfamilias();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar familias
            </div>
            <div class="card-body">

                <table class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre Familia</th>
                            <th style="text-align: center;">Caracteristicas</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_familias">
                        <?php
                        if ($arreglo_familias) {

                            foreach ($arreglo_familias as $objeto_familias) {

                                $familia = $objeto_familias->nombre_familia;
                                $caracteristica = $objeto_familias->caracteristicas;
                        ?>
                                <tr>
                                    <td id="familia_td_<?php echo $familia; ?>"> <?php echo $familia; ?> </td>
                                    <td id="caracteristica_td_<?php echo $familia; ?>"> <?php echo $caracteristica; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="familia_<?php echo $familia; ?>" value="<?php echo $familia; ?>">
                                        <input type="hidden" id="caracteristica_<?php echo $familia; ?>" value="<?php echo $caracteristica; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarfamilias('<?php echo $familia; ?>')"></i>
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
            function agregarfamilias() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_familias'));

                fetch('familias_CO/agregarfamilias', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let familia = document.querySelector('#formulario_agregar_familias #familia').value;
                        let caracteristica = document.querySelector('#formulario_agregar_familias #caracteristica').value;
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="familia_td_${familia}"> ${familia} </td>
                                            <td id="caracteristica_td_${familia}"> ${caracteristica} </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="familia_${familia}" value="${familia}">
                                                <input type="hidden" id="caracteristica_${familia}" value="${caracteristica}">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarfamilias('${familia}')"></i>
                                            </td>
                                        </tr>
                                        `;
                            document.querySelector('#lista_familias').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_familias ').reset();

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarfamilias(nombre) {

                let familia = document.querySelector('#familia_' + nombre).value;
                let caracteristica = document.querySelector('#caracteristica_' + nombre).value;
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_familias">

                              
                          
                                    <div class="form-group">
                                        <label for="familia">nombre de la  familia</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="familia" name="familia"
                                            value="${familia}">
                                    </div>
                                    <div class="form-group">
                                        <label for="caracteristica">caracteristica</label>
                                        <input type="text" class="form-control" id="caracteristica" name="caracteristica"
                                            value="${caracteristica}">
                                    </div>
                                    <input type="hidden" id="family" name="family" value="${familia}">
                                    <button type="button" onclick="actualizarfamilias();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar familias';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarfamilias() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_familias'));

                fetch('familias_CO/actualizarfamilias', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let familia = document.querySelector('#formulario_actualizar_familias #familia').value;

                            let nombre = document.querySelector('#formulario_actualizar_familias #family').value;

                            let caracteristica = document.querySelector('#formulario_actualizar_familias #caracteristica').value;

                            document.querySelector('#familia_td_' + nombre).innerHTML = familia;
                            document.querySelector('#familia_' + nombre).value = familia;
                            document.querySelector('#caracteristica_td_' + nombre).innerHTML = caracteristica;
                            document.querySelector('#caracteristica_' + nombre).value = caracteristica;



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