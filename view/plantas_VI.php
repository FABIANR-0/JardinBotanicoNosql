<?php

class plantas_VI
{

    function __construct()
    {
    }

    function agregarPlantas()
    {

        require_once "models/plantas_MO.php";
        require_once "models/estados_MO.php";
        require_once "models/familias_MO.php";
        require_once "models/habitos_MO.php";
        require_once "models/origenes_MO.php";
        $conexion = new conexion();
        $plantas_MO = new plantas_MO($conexion);
        $familias_MO = new familias_MO($conexion);
        $origenes_MO = new origenes_MO($conexion);
        $habitos_MO = new habitos_MO($conexion);
        $estados_MO = new estados_MO($conexion);
        $arreglo_plantas = $plantas_MO->seleccionar();     
        $arreglo_familias = $familias_MO->seleccionar();   
        $arreglo_origenes = $origenes_MO->seleccionar();  
        $arreglo_habitos = $habitos_MO->seleccionar();
        $arreglo_estados = $estados_MO->seleccionar();

?>
        
        <div class="card">
            <div class="card-header">
                Agregar plantas al inventario
            </div>
            <div class="card-body">
                <form id="formulario_agregar_plantas">

                    <div class="row">
                       
                        <div class="col-md-3">
                            <label for="familia">Nombre familia</label>
                            <select class="form-control" name="familia" id="familia">
                                <option value=""></option>
                                <?php
                                if ($arreglo_familias) {

                                    foreach ($arreglo_familias as $objeto_familia) {
                                        $nombre_familia = $objeto_familia->nombre_familia;

                                ?>
                                        <option value="<?php echo $nombre_familia; ?>"><?php echo  $nombre_familia; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="cod_origen">Nombre origen</label>
                            <select class="form-control" name="cod_origen" id="cod_origen">
                                <option value=""></option>
                                <?php
                                if ($arreglo_origenes) {

                                    foreach ($arreglo_origenes as $objeto_origen) {
                                        $cod_origen = $objeto_origen->cod_origen;
                                        $nombre_origen = $objeto_origen->nombre_origen;

                                ?>
                                        <option value="<?php echo $cod_origen; ?>"><?php echo  $nombre_origen; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="cod_estado">Estado de conservacion</label>
                            <select class="form-control" name="cod_estado" id="cod_estado">
                                <option value=""></option>
                                <?php
                                if ($arreglo_estados) {

                                    foreach ($arreglo_estados as $objeto_estado) {
                                        $cod_estado = $objeto_estado->cod_estado;
                                        $nombre_estado = $objeto_estado->nombre_estado;

                                ?>
                                        <option value="<?php echo $cod_estado; ?>"><?php echo  $nombre_estado; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="cod_habito">Habito de crecimiento</label>
                            <select class="form-control" name="cod_habito" id="cod_habito">
                                <option value=""></option>
                                <?php
                                if ($arreglo_habitos) {

                                    foreach ($arreglo_habitos as $objeto_habito) {
                                        $cod_habito = $objeto_habito->cod_habito;
                                        $nombre_habito = $objeto_habito->nombre_habito;

                                ?>
                                        <option value="<?php echo $cod_habito; ?>"><?php echo  $nombre_habito; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="especie">Nombre Especie</label>
                                <input  onkeypress="return sololetras(event)" type="text" class="form-control" id="especie" name="especie">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_comun">Nombre comun</label>
                                <input onkeypress="return sololetras(event)" type="text" class="form-control" id="nombre_comun" name="nombre_comun">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input  type="number" class="form-control" id="stock" name="stock">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="caracteristica">Caracteristicas</label>
                                <input type="text" class="form-control" id="caracteristica" name="caracteristica">

                            </div>
                        </div>
                        <div class="col-md-12">
                        <br>
                            <button type="button" onclick="agregarplantas();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
             <div class="card">
                <div class="card-header">
                    Listar plantas del inventario
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center;">Especie</th>
                                <th style="text-align: center;">Familia</th>
                                <th style="text-align: center;">Origen</th>
                                <th style="text-align: center;">Estado</th>
                                <th style="text-align: center;">Habito</th>
                                <th style="text-align: center;">Nombre Comun</th>
                                <th style="text-align: center;">Stock</th>
                                <th style="text-align: center;">Accion</th>
                            </tr>
                        </thead>
                        <tbody id="lista_plantas">
                        <?php
                            if ($arreglo_plantas) {

                                foreach ($arreglo_plantas as $objeto_plantas) {
                                    $cod_origen= $objeto_plantas->cod_origen;
                                    $cod_estado= $objeto_plantas->cod_estado;
                                    $cod_habito= $objeto_plantas->cod_habito;
    
                                    $arreglo_origen = $origenes_MO->seleccionar($cod_origen);
                                    $objeto_origen = $arreglo_origen[0];
                                    $nombre_origen = $objeto_origen->nombre_origen;
                                    $arreglo_estado = $estados_MO->seleccionar($cod_estado);
                                    $objeto_estado = $arreglo_estado[0];
                                    $nombre_estado = $objeto_estado->nombre_estado;
                                    $arreglo_habito = $habitos_MO->seleccionar($cod_habito);
                                    $objeto_habito = $arreglo_habito[0];
                                    $nombre_habito = $objeto_habito->nombre_habito;

                                    $especie= $objeto_plantas->especie;
                                    $especie1= str_replace('_',' ',$especie);
                                    $familia = $objeto_plantas->nombre_familia;
                                    $nombre_comun = $objeto_plantas->nombre_comun;
                                    $stock = $objeto_plantas->stock;
                                   
                            ?>
                                    <tr>
                                        <td id="especie_td_<?php echo $especie; ?>"> <?php echo $especie1; ?> </td>
                                        <td id="familia_td_<?php echo $especie; ?>"> <?php echo $familia; ?> </td>
                                        <td id="nombre_origen_td_<?php echo $especie; ?>"> <?php echo $nombre_origen; ?> </td>
                                        <td id="nombre_estado_td_<?php echo $especie; ?>"> <?php echo $nombre_estado; ?> </td>
                                        <td id="nombre_habito_td_<?php echo $especie; ?>"> <?php echo $nombre_habito; ?> </td>
                                        <td id="nombre_comun_td_<?php echo $especie; ?>"> <?php echo $nombre_comun; ?> </td>
                                        <td id="stock_td_<?php echo $especie; ?>"> <?php echo $stock; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="especie_<?php echo $especie; ?>" value="<?php echo $especie; ?>">
                                            <input type="hidden" id="familia_<?php echo $especie; ?>" value="<?php echo $familia; ?>">
                                            <input type="hidden" id="nombre_origen_<?php echo $especie; ?>" value="<?php echo $nombre_origen; ?>">
                                            <input type="hidden" id="nombre_estado_<?php echo $especie; ?>" value="<?php echo $nombre_estado; ?>">
                                            <input type="hidden" id="nombre_habito_<?php echo $especie; ?>" value="<?php echo $nombre_habito; ?>">
                                            <input type="hidden" id="nombre_comun_<?php echo $especie; ?>" value="<?php echo $nombre_comun; ?>">
                                            <input type="hidden" id="stock_<?php echo $especie; ?>" value="<?php echo $stock; ?>">
                                            <input type="hidden" id="cod_origen<?php echo $especie; ?>" value="<?php echo $cod_origen; ?>">
                                            <input type="hidden" id="cod_estado<?php echo $especie; ?>" value="<?php echo $cod_estado; ?>">
                                            <input type="hidden" id="cod_habito<?php echo $especie; ?>" value="<?php echo $cod_habito; ?>">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarplantas('<?php echo $especie; ?>')"></i>
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
            </div>
        <script type="text/javascript" src="datatables/main.js"></script>

        <script>
           
            function agregarplantas() {

                var dato_familia = document.getElementById("familia");
                var familia = dato_familia.options[dato_familia.selectedIndex].text;
                var dato_origen = document.getElementById("cod_origen");
                var nombre_origen = dato_origen.options[dato_origen.selectedIndex].text;
                var dato_estado = document.getElementById("cod_estado");
                var nombre_estado1 = dato_estado.options[dato_estado.selectedIndex].text;
                var dato_habito = document.getElementById("cod_habito");
                var nombre_habito1 = dato_habito.options[dato_habito.selectedIndex].text;

                var cadena = new FormData(document.querySelector('#formulario_agregar_plantas'));

                fetch('plantas_CO/agregarplantas', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let especie1 = document.querySelector('#formulario_agregar_plantas #especie').value;
                        let especie = especie1.replace(' ','_');
                        let stock = document.querySelector('#formulario_agregar_plantas #stock').value;
                        let nombre_comun = document.querySelector('#formulario_agregar_plantas #nombre_comun').value;
                        let cod_origen = document.querySelector('#formulario_agregar_plantas #cod_origen').value;
                        let cod_estado = document.querySelector('#formulario_agregar_plantas #cod_estado').value;
                        let cod_habito = document.querySelector('#formulario_agregar_plantas #cod_habito').value;

                        if (respuesta.estado == 'EXITO') {
             
                            let fila = `
                             <tr>
                                        <td id="especie_td_${especie}"> ${especie1} </td>
                                        <td id="familia_td_${especie}"> ${familia} </td>
                                        <td id="nombre_origen_td_${especie}"> ${nombre_origen} </td>
                                        <td id="nombre_estado_td_${especie}"> ${nombre_estado1} </td>
                                        <td id="nombre_habito_td_${especie}"> ${nombre_habito1} </td>
                                        <td id="nombre_comun_td_${especie}"> ${nombre_comun} </td>
                                        <td id="stock_td_${especie}"> ${stock} </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="especie_${especie}" value="${especie}">
                                            <input type="hidden" id="familia_${especie}" value="${familia}">
                                            <input type="hidden" id="nombre_origen_${especie}" value="${nombre_origen}">
                                            <input type="hidden" id="nombre_estado_${especie}" value="${nombre_estado1}">
                                            <input type="hidden" id="nombre_habito_${especie}" value="${nombre_habito1}">
                                            <input type="hidden" id="nombre_comun_${especie}" value="${nombre_comun}">
                                            <input type="hidden" id="stock_${especie}" value="${stock}">
                                            <input type="hidden" id="cod_origen${especie}" value="${cod_origen}">
                                            <input type="hidden" id="cod_estado${especie}" value="${cod_estado}">
                                            <input type="hidden" id="cod_habito${especie}" value="${cod_habito}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarplantas('${especie}')"></i>
                                        </td>
                                    </tr>
                                    `;
                            document.querySelector('#lista_plantas').insertAdjacentHTML('afterbegin', fila);
                            
                            document.querySelector('#formulario_agregar_plantas ').reset();
                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarplantas(especie) {
                //let especie1 = document.querySelector('#especie_' + especie).value;
                let familia = document.querySelector('#familia_' + especie).value;
                let nombre_origen = document.querySelector('#nombre_origen_' + especie).value;
                let nombre_estado = document.querySelector('#nombre_estado_' + especie).value;
                let nombre_habito = document.querySelector('#nombre_habito_' + especie).value;
                let codi_origen = document.querySelector('#cod_origen' + especie).value;
                let codi_estado = document.querySelector('#cod_estado' + especie).value;
                let codi_habito = document.querySelector('#cod_habito' + especie).value;
                let nombre_comun = document.querySelector('#nombre_comun_' + especie).value;
                let stock = document.querySelector('#stock_' + especie).value;
                //console.log(codi_origen);
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_plantas">
                            <div class="form-group">
                            <label for="familia">Nombre familia</label>
                            <select class="form-control" name="familia" id="familia">
                                <option value="${familia}">${familia}</option>
                                <?php
                                if ($arreglo_familias) {

                                    foreach ($arreglo_familias as $objeto_familia) {
                                        $nombre_familia = $objeto_familia->nombre_familia;

                                ?>
                                        <option value="<?php echo $nombre_familia; ?>"><?php echo  $nombre_familia; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="cod_origen">Nombre origen</label>
                            <select class="form-control" name="cod_origen" id="cod_origen1">
                                <option value="${codi_origen}">${nombre_origen}</option>
                                <?php
                                if ($arreglo_origenes) {

                                    foreach ($arreglo_origenes as $objeto_origen) {
                                        $cod_origen = $objeto_origen->cod_origen;
                                        $nombre_origen = $objeto_origen->nombre_origen;
                                 

                                ?>
                                        <option value="<?php echo $cod_origen; ?>"><?php echo  $nombre_origen; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="cod_estado">Estado de conservacion</label>
                            <select class="form-control" name="cod_estado" id="cod_estado1">
                                <option value="${codi_estado}">${nombre_estado}</option>
                                <?php
                                if ($arreglo_estados) {

                                    foreach ($arreglo_estados as $objeto_estado) {
                                        $cod_estado = $objeto_estado->cod_estado;
                                        $nombre_estado = $objeto_estado->nombre_estado;

                                ?>
                                        <option value="<?php echo $cod_estado; ?>"><?php echo  $nombre_estado; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cod_habito">Habito de crecimiento</label>
                            <select class="form-control" name="cod_habito" id="cod_habito1">
                                <option value="${codi_habito}">${nombre_habito}</option>
                                <?php
                                if ($arreglo_habitos) {

                                    foreach ($arreglo_habitos as $objeto_habito) {
                                        $cod_habito = $objeto_habito->cod_habito;
                                        $nombre_habito = $objeto_habito->nombre_habito;

                                ?>
                                        <option value="<?php echo $cod_habito; ?>"><?php echo  $nombre_habito; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                                    <div class="form-group">
                                        <label for="nombre_comun">nombre comun</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre_comun" name="nombre_comun"
                                            value="${nombre_comun}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                            value="${stock}">
                                    </div>
                                    <input    type="hidden" id="especie" name="especie" value="${especie}">
                                    <button type="button" onclick="actualizarplantas();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar plantas';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarplantas() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_plantas'));
                var dato_origen = document.getElementById("cod_origen1");
                var nombre_origen = dato_origen.options[dato_origen.selectedIndex].text;
                var dato_estado = document.getElementById("cod_estado1");
                var nombre_estado = dato_estado.options[dato_estado.selectedIndex].text;
                var dato_habito = document.getElementById("cod_habito1");
                var nombre_habito = dato_habito.options[dato_habito.selectedIndex].text;

                fetch('plantas_CO/actualizarplantas', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') { 
                            let especie = document.querySelector('#formulario_actualizar_plantas #especie').value;
                            let familia = document.querySelector('#formulario_actualizar_plantas #familia').value;
                            let nombre_comun = document.querySelector('#formulario_actualizar_plantas #nombre_comun').value;
                            let cod_origen = document.querySelector('#formulario_actualizar_plantas #cod_origen1').value;
                            let cod_estado = document.querySelector('#formulario_actualizar_plantas #cod_estado1').value;
                            let cod_habito = document.querySelector('#formulario_actualizar_plantas #cod_habito1').value;
                            let stock = document.querySelector('#formulario_actualizar_plantas #stock').value;
                           


                            document.querySelector('#familia_td_' + especie).innerHTML = familia;
                            document.querySelector('#familia_' + especie).value = familia;
                            document.querySelector('#nombre_origen_td_' + especie).innerHTML = nombre_origen;
                            document.querySelector('#nombre_origen_' + especie).value = nombre_origen;
                            document.querySelector('#nombre_estado_td_' + especie).innerHTML = nombre_estado;
                            document.querySelector('#nombre_estado_' + especie).value = nombre_estado;
                            document.querySelector('#nombre_habito_td_' + especie).innerHTML = nombre_habito;
                            document.querySelector('#nombre_habito_' + especie).value = nombre_habito;
                            document.querySelector('#nombre_comun_td_' + especie).innerHTML = nombre_comun;
                            document.querySelector('#nombre_comun_' + especie).value = nombre_comun;
                            document.querySelector('#stock_td_' + especie).innerHTML = stock;
                            document.querySelector('#stock_' + especie).value = stock;
                            document.querySelector('#cod_origen' + especie).value = cod_origen;
                            document.querySelector('#cod_estado' + especie).value = cod_estado;
                            document.querySelector('#cod_habito' + especie).value = cod_habito;
                            
                        
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