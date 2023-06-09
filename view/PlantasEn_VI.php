<?php

class plantasEn_VI
{

    function __construct()
    {
    }

    function agregarPlantas()
    {

        require_once "models/plantas_MO.php";
         
        $conexion = new conexion();
        $plantas_MO = new plantas_MO($conexion);
        
        $arreglo_plantas = $plantas_MO->seleccionar();     
        

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
                                    $especie=$objeto_plantas['species'];
                                    $especie1= str_replace('_',' ',$especie);
                                    $nombre_origen=$objeto_plantas['origin_name'];
                                    $nombre_estado=$objeto_plantas['state_name'];
                                    $nombre_habito=$objeto_plantas['habit_name'];
                                    $nombre_comun=$objeto_plantas['common_name'];
                                    $stock=$objeto_plantas['stock']; 
                                    $familia=$objeto_plantas['families']['family_name']; 
                                   
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