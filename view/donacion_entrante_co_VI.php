<?php

class donacion_entrante_co_VI
{

    function __construct()
    {
    }

    function vizualizarDonaciones()
    {

        require_once "models/donacion_saliente_en_MO.php";
        require_once "models/entidad_MO.php";
        require_once "models/plantas_MO.php";
        require_once "models/detalle_saliente_en_MO.php";
        $conexion = new conexion();
        $donacion_en_MO = new donacion_saliente_en_MO($conexion);
        $arreglo_donacion= $donacion_en_MO->seleccionardc($_SESSION['documento']);
        $entidad_MO = new entidad_MO($conexion);
       /* $arreglo_entidad= $entidad_MO->seleccionar();
        $planta_MO = new plantas_MO($conexion);
        $arreglo_plantas= $planta_MO->seleccionar();
        //print_r($arreglo_donacion);*/
?>
         
 

        <div class="card">
            <div class="card-header">
                Listar donaciones
            </div>
            <div class="card-body">

                <table id="example2" class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">N° Donacion</th>
                            <th style="text-align: center;">nit </th>
                            <th style="text-align: center;">nombre entidad </th>
                            <th style="text-align: center;">fecha </th>
                            <th style="text-align: center;">total</th>
                            <th style="text-align: center;">Validar</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_entidad">
                        <?php
                        if ($arreglo_donacion) {

                            foreach ($arreglo_donacion as $objeto_donacion) {
                                
                                $nit = $objeto_donacion['entity'];
                                $arreglo_entidad = $entidad_MO->seleccionar($nit);
                                foreach ($arreglo_entidad as $objeto_enti) {
                                    $nombre = $objeto_enti['entity_name'];
                                }
                                
                                $num = $objeto_donacion['number'];
                                $fecha = $objeto_donacion['date'];
                                $total = $objeto_donacion['total_plants'];
                                $estado= $objeto_donacion['state'];
                                $dateTime = $fecha->toDateTime();
                               
                        ?>
                                <tr><?php if($estado=='3'){ ?>
                                    <td class="table-danger" id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }else if($estado=='2'){?>
                                        <td class="table-success" id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }else if($estado=='1'){?>
                                        <td  class="table-secondary" id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }?>
                                    <td id="nombre_td_<?php echo $num; ?>"> <?php echo $nit; ?> </td>
                                    <td id="nombre_td_<?php echo $num; ?>"> <?php echo $nombre; ?> </td>
                                    <td id="fecha_td_<?php echo $num; ?>"> <?php echo  date_format($dateTime,'Y-m-d'); ?> </td>
                                    <td id="total_td_<?php echo $num; ?>"> <?php echo $total; ?> </td>
                                    <td style="text-align: center;"> 
                                    <i class="fa fa-check-circle"  style="cursor: pointer;" onclick="aceptar_solicitud('<?php echo $num; ?>' )"></i>
                                    <i class="fa fa-times-circle"  style="cursor: pointer;" onclick="rechazar_solicitud('<?php echo $num; ?>' )"></i>

                                     </td>
                                    <td  style="text-align: center;">
                                        <input type="hidden" id="id_<?php echo $num; ?>" value="<?php echo $num; ?>">
                                        <input type="hidden" id="nombre_<?php echo $num; ?>" value="<?php echo $nombre; ?>">
                                        <input type="hidden" id="fehca_<?php echo $num; ?>" value="<?php echo $fecha; ?>">
                                        <input type="hidden" id="total_<?php echo $num; ?>" value="<?php echo $total; ?>">
                                        <input type="hidden" id="estado_<?php echo $num; ?>" value="<?php echo $estado; ?>">

                                        <i class="fa fa-eye"   style="cursor: pointer;" data-toggle="modal" data-target="#nueva_<?php echo $num; ?>"></i>

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
        <?php 
        $arreglo_donacion= $donacion_en_MO->seleccionardc($_SESSION['documento']);
        foreach($arreglo_donacion as $obj_don){
            $fecha = $obj_don['date'];
            $dateTime = $fecha->toDateTime(); ?>
        <div  class="modal fade" id="nueva_<?php echo $obj_don['number']; ?>" tabindex="-1" aria-labelledby="titulo" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="titulo_modal1">Detalles de la solicitud</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="otro_contenido_modal">
                            <div class="col-md-9">
                            <p>N° Donacion: <?php echo $obj_don['number']; ?> </P>
                            </div>
                            <div >
                                <p>Fecha: <?php echo  date_format($dateTime,'Y-m-d'); ?> </P>
                            </div>
                            <div class="col-md-9">
                            <?php 
                            if($obj_don['state']==1){?>
                            <p>Estado: Pendiente</P>
                            <?php 
                            }else if($obj_don['state']==2){?>
                                <p>Estado: Aprobada</P>
                            <?php 
                            }else if($obj_don['state']==3){?>
                                <p>Estado: Rechazada</P>
                            <?php 
                            }
                                 ?>
                            </div>
                            <div >
                                <p>Lugar: UFPSO </P>
                            </div>

                            <table class="table table-bordered table-sm table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">N° detalle</th>
                                            <th scope="col">Especie</th>
                                            <th style="text-align: center;">cantidad</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="listar_entidad">
                                        <?php  
                                            /*$detalle = new detalle_saliente_en_MO($conexion);
                                            $arreglo_detalle= $detalle->seleccionar_detalle($obj_don->id_donacion);*/
                                            //print_r($arreglo_detalle);
                                            foreach ($obj_don['detail_incoming_donations'] as $objeto_detalle) {
                                                $id_detalle = $objeto_detalle['number'];
                                                $planta = $objeto_detalle['species'];
                                                $total= $objeto_detalle['amount_plants'];?>
                                        <tr>
                                            <td id="detalle_td_<?php echo $id_detalle; ?>"> <?php echo $id_detalle; ?> </td>
                                            <td id="planta_td_<?php echo $id_detalle; ?>"> <?php echo $planta; ?> </td>
                                            <td style="text-align: center;" id="total_td_<?php echo $id_detalle; ?>"> <?php echo $total; ?> </td>
                                           
                                        </tr>
                                        <?php 
                                        }
                                    
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
          </div>
          <?php
                }
         ?>
        <script type="text/javascript" src="datatables/don.js"></script>
        <script type="text/javascript" src="datatables/ent.js"></script>
        <script>
             function verModulo(ruta) {

                $.post(ruta, function(respuesta) {
                    $('#contenido').html(respuesta);
                });
                }
       
            function aceptar_solicitud(id_donacion){
                var estado=document.querySelector('#estado_' +id_donacion).value;
                if( estado!='1'){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Esta donacion ya fue rechazada o aceptada',
                    })
                }else{
                    
                    Swal.fire({
                    title: 'Aceptara esta solicitud, desea agregarlo al inventario interno?',
                    icon: 'success',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'confirmar, añadir',
                    denyButtonText: 'confirmar, no añadir',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var data2 = {
                        "id_donacion":id_donacion
                        };
                        //console.log(data2);
                        fetch('donacion_saliente_en_CO/aceptar_solicitud_add', {
                        method: 'POST',
                        body: JSON.stringify(data2),
                        headers: {
                            'Content-Type': 'application/json'// AQUI indicamos el formato
                        }
                        })
                        .then(respuesta => respuesta.json())
                        .then(respuesta => {
                        
                            if (respuesta.estado == 'EXITO') {

                                Swal.fire(
                                'Aprobado!',
                                'La donacion ha sido aprobada se añadio al stock',
                                'success'
                                )
                                document.getElementById("id_td_"+id_donacion).className = "table-success";
                                document.querySelector('#estado_' +id_donacion).value = 2;
                                
                            } else if (respuesta.estado = 'ERROR') {

                                Swal.fire(
                                'Error!',
                                'La donacion no fue aprobada',
                                'danger'
                                )

                            } else {

                                toastr.error('No se devolvio un estado');
                            }
                        })
                   
                    } else if (result.isDenied) {
                        var data2 = {
                        "id_donacion":id_donacion
                        };
                        //console.log(data2);
                        fetch('donacion_saliente_en_CO/aceptar_solicitud', {
                        method: 'POST',
                        body: JSON.stringify(data2),
                        headers: {
                            'Content-Type': 'application/json'// AQUI indicamos el formato
                        }
                        })
                        .then(respuesta => respuesta.json())
                        .then(respuesta => {
                        
                            if (respuesta.estado == 'EXITO') {

                                Swal.fire(
                                'Aprobado!',
                                'La donacion ha sido aprobada no se añadio al stock',
                                'success'
                                )
                                document.getElementById("id_td_"+id_donacion).className = "table-success";
                                document.querySelector('#estado_' +id_donacion).value = 2;
                                
                            } else if (respuesta.estado = 'ERROR') {

                                Swal.fire(
                                'Error!',
                                'La donacion no fue aprobada',
                                'danger'
                                )

                            } else {

                                toastr.error('No se devolvio un estado');
                            }
                 })
                    }
                    
                })
                }
            }
            function rechazar_solicitud(id_donacion1){
                var estado1=document.querySelector('#estado_' +id_donacion1).value;
                if( estado1!='1'){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Esta donacion ya fue rechazada o aceptada',
                    })
                }else{
                    Swal.fire({
                    title: 'Estas seguro de rechazar esta donacion?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'si, rechazar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var data2 = {
                        "id_donacion":id_donacion1
                        };
                        //console.log(data2);
                        fetch('donacion_saliente_en_CO/rechazar_solicitud', {
                        method: 'POST',
                        body: JSON.stringify(data2),
                        headers: {
                            'Content-Type': 'application/json'// AQUI indicamos el formato
                        }
                        })
                        .then(respuesta => respuesta.json())
                        .then(respuesta => {
                        
                            if (respuesta.estado == 'EXITO') {

                                Swal.fire(
                                'Rechazado!',
                                'La donacion ha sido rechazada',
                                'success'
                                )
                                document.getElementById("id_td_"+id_donacion1).className = "table-danger";
                                document.querySelector('#estado_' +id_donacion1).value = 3;
                                
                            } else if (respuesta.estado = 'ERROR') {

                                Swal.fire(
                                'Error!',
                                'La donacion fue rechazada',
                                'danger'
                                )

                            } else {

                                toastr.error('No se devolvio un estado');
                            }
                        })
                   
                    }
                 })
                }
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