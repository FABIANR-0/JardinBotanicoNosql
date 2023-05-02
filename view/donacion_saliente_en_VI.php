<?php

class donacion_saliente_en_VI
{

    function __construct()
    {
    }

    function agregardonacionsalienteen()
    {

        require_once "models/donacion_saliente_en_MO.php";
        require_once "models/coordinador_MO.php";
        require_once "models/plantas_MO.php";
        require_once "models/detalle_saliente_en_MO.php";
        $conexion = new conexion();
        $donacion_en_MO = new donacion_saliente_en_MO($conexion);
        $arreglo_donacion= $donacion_en_MO->seleccionar($_SESSION['nit']);
        $max_val= $donacion_en_MO->seleccionarMax();
        //print_r($max_val);
        foreach($max_val as $valor){
            $max_valor=$valor->mayor;
        }
        
        $coordinador_MO = new coordinador_MO($conexion);
        $arreglo_coordinador= $coordinador_MO->seleccionar();
        $planta_MO = new plantas_MO($conexion);
        $arreglo_plantas= $planta_MO->seleccionar();
       // print_r($arreglo_donacion);
?>
        <div  class="card">
        <div class="card-header">
                Agregar donacion
            </div>
            <div class="card-body">
                <form name='prueba' id="formulario_factura">
                    
                            
                    
                      
                    <div class="row">
                         <div class="col-md-4">
                                 
                         </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nit">Numero donacion</label>
                                <input  readonly type="text" class="form-control" id="numero" name="numero" value="<?php echo  $max_valor+1 ; ?>">
                            </div>
                        </div>
                        
                      
                        <div class="col-md-12">
                            <br>
                             
                            <button type="button" onclick="ocultar_agregarfactura();" class="btn btn-success float-right">Agregar detalles</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>
        <?php foreach($arreglo_donacion as $obj_don){ ?>
        <div  class="modal fade" id="nueva_<?php echo $obj_don->id_donacion; ?>" tabindex="-1" aria-labelledby="titulo" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="titulo_modal1">Detalles de la donacion</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="otro_contenido_modal">
                            <div class="col-md-9">
                            <p>N° Donacion: <?php echo $obj_don->id_donacion; ?> </P>
                            </div>
                            <div >
                                <p>Fecha: <?php echo $obj_don->fecha; ?> </P>
                            </div>
                            <div class="col-md-9">
                            <?php 
                            if($obj_don->estado==1){?>
                            <p>Estado: Pendiente</P>
                            <?php 
                            }else if($obj_don->estado==2){?>
                                <p>Estado: Aprobada</P>
                            <?php 
                            }else if($obj_don->estado==3){?>
                                <p>Estado: Rechazada</P>
                            <?php 
                            }
                                 ?>
                            </div>
                            <div >
                                <p>Lugar: UFPSO?> </P>
                            </div>

                            <table class="table table-bordered table-sm table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">N° detalle</th>
                                            <th scope="col">Especie</th>
                                            <th style="text-align: center;">cantidad</th>
                                            <?php 
                                            $fechas = explode("-", $obj_don->fecha);
                                            date_default_timezone_set('UTC');
                                            date_default_timezone_set("America/Bogota");
                                            $fecha1 = date('Y-m-d');
                                            $fechas1 = explode("-", $fecha1);
                                              if($obj_don->estado!=1 or $fechas1[0]-$fechas[0]>=1 or $fechas1[1]-$fechas[1]>=1 or $fechas1[2]-$fechas[2]>2){

                                              }
                                              else{
                                              ?>
                                            <th style="text-align: center;">Accion</th>
                                            <?php 
                                             }?>
                                        </tr>
                                    </thead>
                                    <tbody id="listar_entidad">
                                        <?php  
                                            $detalle = new detalle_saliente_en_MO($conexion);
                                            $arreglo_detalle= $detalle->seleccionar_detalle($obj_don->id_donacion);
                                            //print_r($arreglo_detalle);
                                            foreach ($arreglo_detalle as $objeto_detalle) {
                                                $id_detalle = $objeto_detalle->id_detalle_donacion;
                                                $id_donacion = $objeto_detalle->id_donacion;
                                                $planta = $objeto_detalle->especie;
                                                $total= $objeto_detalle->cantidad;?>
                                        <tr>
                                            <td id="detalle_td_<?php echo $id_donacion; ?>_<?php echo $id_detalle; ?>"> <?php echo $id_detalle; ?> </td>
                                            <td id="planta_td_<?php echo $id_donacion; ?>_<?php echo $id_detalle; ?>"> <?php echo $planta; ?> </td>
                                            <td style="text-align: center;" id="total_td_<?php echo $id_donacion; ?>_<?php echo $id_detalle; ?>"> <?php echo $total; ?> </td>
                                            <?php 
                                              if($obj_don->estado!=1 or $fechas1[0]-$fechas[0]>=1 or $fechas1[1]-$fechas[1]>=1 or $fechas1[2]-$fechas[2]>2){

                                              }else{?>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="especie_<?php echo $id_donacion; ?>_<?php echo $id_detalle; ?>" value="<?php echo $planta; ?>">
                                                <input type="hidden" id="total_<?php echo $id_donacion; ?>_<?php echo $id_detalle; ?>" value="<?php echo $total; ?>">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal"   style="cursor: pointer;" onclick="verActualizardetalle('<?php echo $id_detalle; ?>','<?php echo $id_donacion; ?>')"></i>
                                            </td>
                                            <?php 
                                             }?>
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
        <div style="display:none;" id="formulario_detalle" class="card">
         <div class="card-header">
                Agregar plantas a la donacion a realizar
            </div>
            <div class="card-body">
                <form name='prueba' id="formulario_agregar_entidad">

                    <div class="row">
                    <div style="display:none;" >
                    <input  readonly type="text" class="form-control" id="numero1" name="numero1" value="<?php echo  $max_valor+1 ; ?>">
                    </div>
                    <div class="col-md-3">
                            <div class="form-group">
                                <label for="nit">Numero detalle</label>
                                <input  readonly type="text" class="form-control" id="numero_detalle" name="numero-detalle" value="1">
                            </div>
                        </div>
                    <div class="col-md-3">
                            <label for="planta">selesccione la planta</label>
                            <select   class="form-control" name="planta" id="planta">
                                <option value="">seleccione</option>
                                <?php
                                if ($arreglo_plantas) {

                                    foreach ($arreglo_plantas as $objeto_plantas) {
                                        $especie = $objeto_plantas->especie;
                                        

                                ?>
                                
                                    <option value="<?php echo $especie; ?>" > <?php echo  $especie; ?> </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input   type="number" class="form-control" id="cantidad" name="cantidad">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <button type="button" onclick="agregardetalle();" class="btn btn-success float-right">Añadir</button>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <button type="button" onclick="verModulo('donacion_saliente_en_VI/agregardonacionsalienteen');" class="btn btn-warning float-right">Finalizar solicitud</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>
        <div style="display:none;" id="tabla_detalle"class="card">
            <div class="card-header">
                Lista del detalle de la donacion
            </div>
            <div class="card-body">

                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">N° detalle</th>
                            <th scope="col">Especie</th>
                            <th style="text-align: center;">cantidad</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_detalle">
                        
                    </tbody>
                </table>


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar donaciones
            </div>
            <div class="card-body">

                <table id="example2" class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">N° Donacion</th>
                            <th style="text-align: center;">Coordinador </th>
                            <th style="text-align: center;">fecha </th>
                             
                            <th style="text-align: center;">total</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_entidad">
                        <?php
                        if ($arreglo_donacion) {

                            foreach ($arreglo_donacion as $objeto_donacion) {
                                
                                $documento = $objeto_donacion->documento;

                                

                                $arreglo_coordinador = $coordinador_MO->seleccionar($documento);
                                $nombre = $arreglo_coordinador[0]->nombres;
                                
                                $num = $objeto_donacion->id_donacion;
                                $fecha = $objeto_donacion->fecha;
                                $total = $objeto_donacion->total_plantas;
                                $estado= $objeto_donacion->estado;
                               
                        ?>
                                <tr ><?php if($estado=='3'){ ?>
                                    <td class="table-danger" id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }else if($estado=='2'){?>
                                    <td class="table-success"  id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }else if($estado=='1'){?>
                                    <td class="table-secondary"  id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }?>
                                    
                                    <td id="nombre_td_<?php echo $num; ?>"> <?php echo $nombre; ?> </td>
                                    <td id="fecha_td_<?php echo $num; ?>"> <?php echo $fecha; ?> </td>
                                    
                                    <td style="text-align: center;" id="total_td_<?php echo $num; ?>"> <?php echo $total; ?> </td>
                                    <td  style="text-align: center;">
                                        <input type="hidden" id="id_<?php echo $num; ?>" value="<?php echo $num; ?>">
                                        <input type="hidden" id="nombre_<?php echo $num; ?>" value="<?php echo $nombre; ?>">
                                        <input type="hidden" id="fehca_<?php echo $num; ?>" value="<?php echo $fecha; ?>">
                                         
                                        <input type="hidden" id="total_<?php echo $num; ?>" value="<?php echo $total; ?>">
                                         
                                        <input type="hidden" id="documento_<?php echo $num; ?>" value="<?php echo $documento; ?>">

                                        <i class="fa fa-eye"   style="cursor: pointer;" data-toggle="modal" data-target="#nueva_<?php echo $num; ?>"></i>
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizardonacion('<?php echo $num; ?>','<?php echo $fecha; ?>','<?php echo $estado; ?>')"></i>
                                        <i class="fa fa-trash"   style="cursor: pointer;" onclick="verEliminarDonacion('<?php echo $num; ?>','<?php echo $fecha; ?>','<?php echo $estado; ?>',this)"></i>

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
        <script type="text/javascript" src="datatables/don.js"></script>
        <script type="text/javascript" src="datatables/ent.js"></script>
        <script>
             function verModulo(ruta) {

                $.post(ruta, function(respuesta) {
                    $('#contenido').html(respuesta);
                });
                }
             
                  
  
            function ocultar_agregarfactura(){
                  var cadena = new FormData(document.querySelector('#formulario_factura'));
                  //console.log(cadena);
                  fetch('donacion_saliente_en_CO/agregardonacion', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        
                        if (respuesta.estado == 'EXITO') {

                            toastr.success(respuesta.mensaje);
                            $("#formulario_factura").hide();
                            $("#formulario_detalle").show();
                            $("#tabla_detalle").show();
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
                   
                  
                }

            function agregardetalle() {
                //var cadena = new FormData(document.getElementById('formulario_detalle'));
                let id_detalle = document.querySelector('#formulario_detalle #numero_detalle').value;
                let id_donacion = document.querySelector('#formulario_detalle #numero1').value;
                let cantidad = document.querySelector('#formulario_detalle #cantidad').value;
                //console.log(cantidad);
                var dato_especie = document.getElementById("planta");
                var especie = dato_especie.options[dato_especie.selectedIndex].text;
                var data2 = {
                        "id_donacion":id_donacion,
                        "id_detalle":id_detalle,
                        "cantidad":cantidad,
                        "especie":especie
                        };
                fetch('detalle_saliente_en_CO/agregardetalle', {
                        method: 'POST',
                        body: JSON.stringify(data2),
                        headers: {
                            'Content-Type': 'application/json'// AQUI indicamos el formato
                        }
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        
                       
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="detalle_td_${id_detalle}"> ${id_detalle} </td>
                                            <td id="especie_td_${id_detalle}"> ${especie } </td>
                                            <td id="cantidad_td_${id_detalle}"> ${cantidad } </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="detalle_${id_detalle}" value="${id_detalle}">
                                                <input type="hidden" id="especie_${id_detalle}" value="${especie}">
                                                <input type="hidden" id="cantidad_${id_detalle}" value="${cantidad}">
                                                <input type="hidden" id="donacion_${id_detalle}" value="${id_donacion}">

                                                <i class="fa fa-trash"  style="cursor: pointer;" onclick="verEliminarDetalle('${id_donacion}','${id_detalle}','${cantidad}','${especie}',this)"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_detalle').insertAdjacentHTML('afterbegin', fila);
                            //document.querySelector('#formulario_detalle').reset();
                            console.log(parseInt(id_detalle)+1);
                            document.querySelector('#numero_detalle').value = parseInt(id_detalle)+1;
                            document.querySelector('#cantidad' ).value ="";
                            //dato_especie.options[dato_especie.selectedIndex].text="";

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }
            function verEliminarDonacion(id,fecha,estado,e) {
                var today = new Date();
                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();
                var fechareal = year+'-'+month+'-'+day;
                let arrf1= fechareal.split('-');
                let arrf2= fecha.split('-');

                if(arrf1[0]-arrf2[0]>=1 || arrf1[1]-arrf2[1]>=1 || arrf1[2]-arrf2[2]>2 || estado!='1'){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'el tiempo y/o estado de dicha solicitud no permite su eliminación',
                    })
                }else{
                    Swal.fire({
                    title: 'Estas seguro de eliminar la solicitud?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'si, eliminar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var data2 = {
                        "id_donacion":id
                        };
                        //console.log(data2);
                        fetch('donacion_saliente_en_CO/eliminardonacion', {
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
                                'Eliminado!',
                                'Su solicitud ha sido eliminada',
                                'success'
                                )
                                e.closest("tr").remove();
                                
                            } else if (respuesta.estado = 'ERROR') {

                                Swal.fire(
                                'Error!',
                                'Su solicitud no fue eliminada',
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
            function verEliminarDetalle(id_donacion,id_detalle,cantidad,especie,e) {
          
                    Swal.fire({
                    title: 'Estas seguro de eliminar esta planta de la solicitud?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'si, eliminar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var data2 = {
                        "id_donacion":id_donacion,
                        "id_detalle":id_detalle,
                        "cantidad":cantidad,
                        "especie":especie
                        };
                        //console.log(data2);
                        fetch('detalle_saliente_en_CO/eliminardetalle', {
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
                                'Eliminado!',
                                'La planta ha sido eliminada',
                                'success'
                                )
                                e.closest("tr").remove();
                                
                            } else if (respuesta.estado = 'ERROR') {

                                Swal.fire(
                                'Error!',
                                'Esta planta no fue eliminada',
                                'danger'
                                )

                            } else {

                                toastr.error('No se devolvio un estado');
                            }
                        })
                   
                    }
                 })
                
            }

            function verActualizardonacion(id,fecha,estado) {
                var today = new Date();
                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();
                var fechareal = year+'-'+month+'-'+day;
                let arrf1= fechareal.split('-');
                let arrf2= fecha.split('-');

                if(arrf1[0]-arrf2[0]>=1 || arrf1[1]-arrf2[1]>=1 || arrf1[2]-arrf2[2]>2 || estado!='1'){

                document.querySelector('#titulo_modal').innerHTML = 'Ya no es posible actualizar ';

                document.querySelector('#contenido_modal').innerHTML = `<p>el tiempo y/o estado de dicha peticion no permite su actualizacion</p>`;
                }else{
               
           
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_donacion">
                             
                          
                              
                                    <div class="form-group">
                                        <label for="nit">Numero factura</label>
                                        <input  readonly type="text" class="form-control" id="numero" name="numero" value="${id}">
                                    </div>
                    
                          
                       <input    type="hidden" id="id" name="id" value="${id}">
                       <button type="button" onclick="actualizardonacion();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                        
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar peticion';
                document.querySelector('#contenido_modal').innerHTML = cadena;
               // console.log('<?php //echo $cod_departamento; ?>');
                }
            }

            function actualizardonacion() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_donacion'));
               
                fetch('donacion_saliente_en_CO/actualizar', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {
                            
                            let num = document.querySelector('#formulario_actualizar_donacion #id').value;
                             
                        
                            
                             

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
            function verActualizardetalle(id_detalle,id_donacion){
                console.log(id_detalle);
                let especie = document.querySelector('#especie_' +id_donacion+'_'+id_detalle).value;
                let cantidad = document.querySelector('#total_' +id_donacion+'_'+id_detalle).value;
           
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_detalle">
                             
                          
                              
                                    <div class="form-group">
                                        <label for="nit">Numero factura</label>
                                        <input  readonly type="text" class="form-control" id="numero_detalle" name="numero_detalle1" value="${id_detalle}">
                                    </div>
                    
                            <div class="form-group">
                            <label for="especie">Escoja especie</label>
                            <select    class="form-control" name="especie1" id="especie1">
                                <option value="${especie}">${especie}</option>
                                <?php
                                $arreglo_plantas1= $planta_MO->seleccionar();
                                 
                                if ($arreglo_plantas1) {

                                    foreach ($arreglo_plantas1 as $objeto_planta1) {
                                        $especie = $objeto_planta1->especie;
                                       

                                ?>
                                
                                    <option value="<?php echo $especie; ?>" > <?php echo  $especie; ?> </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad1" name="cantidad1"
                                            value="${cantidad}">
                                    </div>
                        <input    type="hidden" id="cantidad_org" name="cantidad_org" value="${cantidad}">
                        <input    type="hidden" id="especie_org" name="especie_org" value="${especie}">
                       <input    type="hidden" id="id_detalle" name="id_detalle" value="${id_detalle}">
                       <input    type="hidden" id="id_donacion" name="id_donacion" value="${id_donacion}">
                       <button type="button" onclick="actualizardetalle();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                        
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar peticion';
                document.querySelector('#contenido_modal').innerHTML = cadena;
               
                
            }
            function actualizardetalle() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_detalle'));

                fetch('detalle_saliente_en_CO/actualizar', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {
                            var dato_espe = document.getElementById("especie1");
                            var nombre_espe = dato_espe.options[dato_espe.selectedIndex].text;

                           


                            let id_detalle = document.querySelector('#formulario_actualizar_detalle #id_detalle').value;
                            let id_donacion = document.querySelector('#formulario_actualizar_detalle #id_donacion').value;
                            let especie_id = document.querySelector('#formulario_actualizar_detalle #especie1').value;
                            let cantidad = document.querySelector('#formulario_actualizar_detalle #cantidad1').value;
                            let cantidadorg = document.querySelector('#formulario_actualizar_detalle #cantidad_org').value;
                            let valor=cantidad-cantidadorg;
                            let total = parseInt(document.querySelector('#total_'+ id_donacion).value, 10);
                            let totaln=total+valor;
                            document.querySelector('#planta_td_'+id_donacion+'_'+id_detalle).innerHTML = nombre_espe;
                            document.querySelector('#especie_' +id_donacion+'_'+id_detalle).value = nombre_espe;
                            document.querySelector('#total_td_'+id_donacion).innerHTML = totaln;
                            document.querySelector('#total_' +id_donacion).value = totaln;
                            document.querySelector('#total_td_'+id_donacion+'_'+id_detalle).innerHTML = cantidad;
                            document.querySelector('#total_'+id_donacion+'_'+id_detalle).value = cantidad;

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