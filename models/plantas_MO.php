<?php
class plantas_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarplantas($especie,$familia,$estado,$habito,$origen,$nombre_comun, $stock, $caracteristica)
  {

    $Nsql=array('species'=>$especie,'common_name'=>$nombre_comun,'origin_name'=>$origen,'state_name'=>$estado,'habit_name'=>$habito,'characteristics'=>$caracteristica,'stock'=>(int)$stock,'families'=>array('family_name'=>$familia));
    //$sql = "insert into planta (especie,nombre_familia,cod_estado,cod_habito,cod_origen,nombre_comun, stock, caracteristicas) values ('$especie','$familia','$cod_estado','$cod_habito','$cod_origen','$nombre_comun',$stock,'$caracteristica' )";

    $this->conexion->consultarIns($Nsql,"plants");
  }
  function actualizarplantas($especie,$familia,$cod_estado,$cod_habito,$cod_origen,$nombre_comun, $stock)
  {

    $sql = "update planta set nombre_familia='$familia', cod_estado='$cod_estado',cod_habito='$cod_habito',cod_origen='$cod_origen',nombre_comun='$nombre_comun', stock='$stock'  where especie='$especie'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($especie = '')
  {

    if (empty($especie)) {

      $Nsql = array();
    } else {

      $Nsql = array('species'=>$especie);
    }

    $this->conexion->consultar($Nsql,"plants");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_planta($especie = '')
  {
    if ($especie) {

      $Nsql = array('species'=>$especie);
    } else {

      $Nsql = array();
    }

    $this->conexion->consultar($Nsql,"plants");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
