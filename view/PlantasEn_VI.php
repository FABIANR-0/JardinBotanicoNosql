<?php

class plantasEn_VI
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
                                    $familia = $objeto_plantas->nombre_familia;
                                    $nombre_comun = $objeto_plantas->nombre_comun;
                                    $stock = $objeto_plantas->stock;
                                   
                            ?>
                                    <tr>
                                        <td id="especie_td_<?php echo $especie; ?>"> <?php echo $especie; ?> </td>
                                        <td id="familia_td_<?php echo $especie; ?>"> <?php echo $familia; ?> </td>
                                        <td id="nombre_origen_td_<?php echo $especie; ?>"> <?php echo $nombre_origen; ?> </td>
                                        <td id="nombre_estado_td_<?php echo $especie; ?>"> <?php echo $nombre_estado; ?> </td>
                                        <td id="nombre_habito_td_<?php echo $especie; ?>"> <?php echo $nombre_habito; ?> </td>
                                        <td id="nombre_comun_td_<?php echo $especie; ?>"> <?php echo $nombre_comun; ?> </td>
                                        <td id="stock_td_<?php echo $especie; ?>"> <?php echo $stock; ?> </td>
                                     
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

  
<?php
    }
}
?>