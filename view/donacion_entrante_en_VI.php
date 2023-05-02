<?php

class donacion_entrante_en_VI
{

    function __construct()
    {
    }

    function agregardonacionentranteen()
    {

        require_once "models/donacion_entrante_en_MO.php";
        require_once "models/municipio_MO.php";
        require_once "models/departamento_MO.php";
        require_once "models/lugar_MO.php";
        require_once "models/coordinador_MO.php";
        require_once "models/plantas_MO.php";
        require_once "models/detalle_entrante_en_MO.php";
        $conexion = new conexion();
        $donacion_en_MO = new donacion_entrante_en_MO($conexion);
        $arreglo_donacion= $donacion_en_MO->seleccionar($_SESSION['nit']);
        $max_val= $donacion_en_MO->seleccionarMax();
        //print_r($max_val);
        foreach($max_val as $valor){
            $max_valor=$valor->mayor;
        }
        
        $municipio_MO = new municipio_MO($conexion);
        $arreglo_municipio= $municipio_MO->seleccionar();
        $departamento_MO = new departamento_MO($conexion);
        $arreglo_departamento= $departamento_MO->seleccionar();
        $lugar_MO = new lugar_MO($conexion);
        $arreglo_lugar= $lugar_MO->seleccionar();
        $coordinador_MO = new coordinador_MO($conexion);
        $arreglo_coordinador= $coordinador_MO->seleccionar();
        $planta_MO = new plantas_MO($conexion);
        $arreglo_plantas= $planta_MO->seleccionar();
       // print_r($arreglo_donacion);
?>
        <div  class="card">
        <div class="card-header">
                Agregar solicitud 
            </div>
            <div class="card-body">
                <form name='prueba' id="formulario_factura">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nit">Numero factura</label>
                                <input  readonly type="text" class="form-control" id="numero" name="numero" value="<?php echo  $max_valor+1 ; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="departamento">Escoja departamento</label>
                            <select onchange="departamento1()"  class="form-control" name="departamento" id="departamento">
                                <option value="">seleccione</option>
                                <?php
                                if ($arreglo_departamento) {

                                    foreach ($arreglo_departamento as $objeto_departamento) {
                                        $nombre_departamento = $objeto_departamento->nombre_departamento;
                                        $cod_departamento = $objeto_departamento->cod_departamento;

                                ?>
                                
                                    <option value="<?php echo $cod_departamento; ?>" > <?php echo  $nombre_departamento; ?> </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                        <label for="municipio">Escoja municipio</label>
                            <select class="form-control" id="municipio" name="municipio">

                            </select>
                       </div>
                       <div class="col-md-3">
                        <label for="lugar">Escoja lugar</label>
                            <select class="form-control" id="lugar" name="lugar">

                            </select>
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
                                <h4 class="modal-title" id="titulo_modal1">Detalles de la solicitud</h4>
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
                                $arreglo_lugar = $lugar_MO->seleccionar($obj_don->cod_lugar);
                                $objeto_lugar = $arreglo_lugar[0];
                                $nombre_lugar = $objeto_lugar->nombre_lugar;?>
                            </div>
                            <div >
                                <p>Lugar: <?php echo $nombre_lugar; ?> </P>
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
                                            $detalle = new detalle_entrante_en_MO($conexion);
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
                Agregar plantas a la solicitud
            </div>
            <div class="card-body">
                <form name='prueba' id="formulario_detalle">

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
                            <button type="button" onclick="verModulo('donacion_entrante_en_VI/agregardonacionentranteen');" class="btn btn-warning float-right">Finalizar solicitud</button>
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
                Listar solicitudes de donaciones
            </div>
            <div class="card-body">

                <table id="example2" class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">N° Donacion</th>
                            <th style="text-align: center;">Coordinador </th>
                            <th style="text-align: center;">fecha </th>
                            <th style="text-align: center;">departamento</th>
                            <th style="text-align: center;">municipio</th>
                            <th style="text-align: center;">lugar</th>
                            <th style="text-align: center;">total</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_entidad">
                        <?php
                        if ($arreglo_donacion) {

                            foreach ($arreglo_donacion as $objeto_donacion) {
                                $cod_departamento = $objeto_donacion->cod_departamento;
                                $cod_municipio = $objeto_donacion->cod_municipio;
                                $cod_lugar = $objeto_donacion->cod_lugar;
                                $documento = $objeto_donacion->documento;

                                $arreglo_departamento = $departamento_MO->seleccionar($cod_departamento);
                                $objeto_departamento = $arreglo_departamento[0];
                                $nombre_departamento = $objeto_departamento->nombre_departamento;

                                $arreglo_municipio = $municipio_MO->seleccionar($cod_municipio);
                                $objeto_municipio = $arreglo_municipio[0];
                                $nombre_municipio = $objeto_municipio->nombre_municipio;

                                $arreglo_lugar = $lugar_MO->seleccionar($cod_lugar);
                                $objeto_lugar = $arreglo_lugar[0];
                                $nombre_lugar = $objeto_lugar->nombre_lugar;

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
                                    <td id="departamento_td_<?php echo $num; ?>"> <?php echo $nombre_departamento; ?> </td>
                                    <td id="municipio_td_<?php echo $num; ?>"> <?php echo $nombre_municipio; ?> </td>
                                    <td id="lugar_td_<?php echo $num; ?>"> <?php echo $nombre_lugar; ?> </td>
                                    <td style="text-align: center;" id="total_td_<?php echo $num; ?>"> <?php echo $total; ?> </td>
                                    <td  style="text-align: center;">
                                        <input type="hidden" id="id_<?php echo $num; ?>" value="<?php echo $num; ?>">
                                        <input type="hidden" id="nombre_<?php echo $num; ?>" value="<?php echo $nombre; ?>">
                                        <input type="hidden" id="fehca_<?php echo $num; ?>" value="<?php echo $fecha; ?>">
                                        <input type="hidden" id="nombre_departamento_<?php echo $num; ?>" value="<?php echo $nombre_departamento; ?>">
                                        <input type="hidden" id="nombre_municipio_<?php echo $num; ?>" value="<?php echo $nombre_municipio; ?>">
                                        <input type="hidden" id="nombre_lugar_<?php echo $num; ?>" value="<?php echo $nombre_lugar; ?>">
                                        <input type="hidden" id="total_<?php echo $num; ?>" value="<?php echo $total; ?>">
                                        <input type="hidden" id="cod_departamento_<?php echo $num; ?>" value="<?php echo $cod_departamento; ?>">
                                        <input type="hidden" id="cod_municipio_<?php echo $num; ?>" value="<?php echo $cod_municipio; ?>">
                                        <input type="hidden" id="cod_lugar_<?php echo $num; ?>" value="<?php echo $cod_lugar; ?>">
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
            function departamento11()
                    {
                        var cod_departamento= document.getElementById('departamento1').value;
                        console.log(cod_departamento);
                        let municipio1 = document.querySelector('#municipio1');
                        let lugar1 = document.querySelector('#lugar1');
                        var object = new FormData();
                        object.append("departamento",cod_departamento);
                        fetch("departamento_CO/showMunicipio", {
                        method: "POST",
                        body: object,
                        })
                        .then((respuesta) => respuesta.text())
                        .then(function (response) {
                            
                            const municipios = JSON.parse(response);
                            let template = '<option class="FORM-CONTROL" selected disable value="">Seleccione</option>'
                            let template1 = '<option class="FORM-CONTROL" selected disable value=""></option>'
                            municipios.forEach(muni => {
                            template += "<option value="+muni.cod_municipio+">"+muni.nombre_municipio+"</option>"
                            });
                            municipio1.innerHTML = template
                            
                            lugar1.innerHTML=template1
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                        municipio1.addEventListener('change', function(){
                            const valor = municipio1.value;
                            lugar(valor);
                        })
                    }
                    function lugar(municipio)
                    {
                         
                        let lugar1 = document.querySelector('#lugar1');
                        var object = new FormData();
                        object.append("municipio",municipio);
                         
                        fetch("departamento_CO/showLugar", {
                        method: "POST",
                        body: object,
                        })
                        .then((respuesta) => respuesta.text())
                        .then(function (response) {
                            
                            const lugares = JSON.parse(response);
                            let template = '<option class="FORM-CONTROL" selected disable value="">Seleccione</option>'
                            lugares.forEach(luga => {
                            template += "<option value="+luga.cod_lugar+">"+luga.nombre_lugar+"</option>"
                            });
                            lugar1.innerHTML = template
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    }
                    function departamento1()
                    {
                        var cod_depa= document.getElementById('departamento').value;
                        console.log(cod_depa);
                        let municipio = document.querySelector('#municipio');
                        let lugar = document.querySelector('#lugar');
                        var object = new FormData();
                        object.append("departamento",cod_depa);
                        fetch("departamento_CO/showMunicipio", {
                        method: "POST",
                        body: object,
                        })
                        .then((respuesta) => respuesta.text())
                        .then(function (response) {
                            
                            const municipios = JSON.parse(response);
                            let template = '<option class="FORM-CONTROL" selected disable value="">Seleccione</option>'
                            let template1 = '<option class="FORM-CONTROL" selected disable value=""></option>'
                            municipios.forEach(muni => {
                            template += "<option value="+muni.cod_municipio+">"+muni.nombre_municipio+"</option>"
                            });
                            municipio.innerHTML = template
                            
                            lugar.innerHTML=template1
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                        municipio.addEventListener('change', function(){
                            const valor = municipio.value;
                            lugar1(valor);
                        })
                    }
                    function lugar1(municipio)
                    {
                         
                        let lugar1 = document.querySelector('#lugar');
                        var object = new FormData();
                        object.append("municipio",municipio);
                         
                        fetch("departamento_CO/showLugar", {
                        method: "POST",
                        body: object,
                        })
                        .then((respuesta) => respuesta.text())
                        .then(function (response) {
                            
                            const lugares = JSON.parse(response);
                            let template = '<option class="FORM-CONTROL" selected disable value="">Seleccione</option>'
                            lugares.forEach(luga => {
                            template += "<option value="+luga.cod_lugar+">"+luga.nombre_lugar+"</option>"
                            });
                            lugar1.innerHTML = template
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    }
  
            function ocultar_agregarfactura(){
                  var cadena = new FormData(document.querySelector('#formulario_factura'));
                  //console.log(cadena);
                  fetch('donacion_entrante_en_CO/agregardonacion', {
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
                fetch('detalle_entrante_en_CO/agregardetalle', {
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
                        fetch('donacion_entrante_en_CO/eliminardonacion', {
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
                        fetch('detalle_entrante_en_CO/eliminardetalle', {
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
                let municipio = document.querySelector('#nombre_municipio_' + id).value;
                let lugar = document.querySelector('#nombre_lugar_' + id).value;
                let departamento = document.querySelector('#nombre_departamento_' + id).value;
                let cod_muni = document.querySelector('#cod_municipio_' + id).value;
                let cod_luga = document.querySelector('#cod_lugar_' + id).value;
                let cod_depa = document.querySelector('#cod_departamento_' + id).value;
           
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_donacion">
                             
                          
                              
                                    <div class="form-group">
                                        <label for="nit">Numero factura</label>
                                        <input  readonly type="text" class="form-control" id="numero" name="numero" value="${id}">
                                    </div>
                    
                            <div class="form-group">
                            <label for="departamento">Escoja departamento</label>
                            <select onchange="departamento11()"  class="form-control" name="departamento" id="departamento1">
                                <option value="">seleccione</option>
                                <?php
                                $arreglo_departamento1 = $departamento_MO->seleccionar();
                                //print_r($arreglo_departamento1);
                                if ($arreglo_departamento1) {

                                    foreach ($arreglo_departamento1 as $objeto_departamento1) {
                                        $nombre_departamento = $objeto_departamento1->nombre_departamento;
                                        $cod_departamento = $objeto_departamento1->cod_departamento;

                                ?>
                                
                                    <option value="<?php echo $cod_departamento; ?>" > <?php echo  $nombre_departamento; ?> </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="municipio">Escoja municipio</label>
                            <select class="form-control" id="municipio1" name="municipio">

                            </select>
                       </div>
                       <div class="form-group">
                        <label for="lugar">Escoja lugar</label>
                            <select class="form-control" id="lugar1" name="lugar">

                            </select>
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
               
                fetch('donacion_entrante_en_CO/actualizar', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {
                            var dato_depar = document.getElementById("departamento1");
                            var nombre_depar = dato_depar.options[dato_depar.selectedIndex].text;
                            var dato_muni = document.getElementById("municipio1");
                            var nombre_muni = dato_muni.options[dato_muni.selectedIndex].text;
                            var dato_lugar = document.getElementById("lugar1");
                            var nombre_lugar = dato_lugar.options[dato_lugar.selectedIndex].text;

                            let num = document.querySelector('#formulario_actualizar_donacion #id').value;
                            let departamento = document.querySelector('#formulario_actualizar_donacion #departamento1').value;
                            let lugar = document.querySelector('#formulario_actualizar_donacion #lugar1').value;
                            let municipio = document.querySelector('#formulario_actualizar_donacion #municipio1').value;
                            console.log(nombre_depar);
                        
                            document.querySelector('#departamento_td_' + num).innerHTML = nombre_depar;
                            document.querySelector('#nombre_departamento_' + num).value = nombre_depar;
                            document.querySelector('#cod_departamento_' + num).value = departamento;
                            document.querySelector('#lugar_td_' + num).innerHTML = nombre_lugar;
                            document.querySelector('#nombre_lugar_' + num).value = nombre_lugar;
                            document.querySelector('#cod_lugar_' + num).value = lugar;
                            document.querySelector('#municipio_td_' + num).innerHTML = nombre_muni;
                            document.querySelector('#nombre_municipio_' + num).value = nombre_muni;
                            document.querySelector('#cod_municipio_' + num).value = municipio;
                             

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
                                //print_r($arreglo_departamento1);
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
               // console.log('<?php //echo $cod_departamento; ?>');
                
            }
            function actualizardetalle() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_detalle'));

                fetch('detalle_entrante_en_CO/actualizar', {
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