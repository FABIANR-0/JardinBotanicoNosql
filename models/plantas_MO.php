<?php
class plantas_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarplantas($especie,$familia,$cod_estado,$cod_habito,$cod_origen,$nombre_comun, $stock, $caracteristica)
  {

    $sql = "insert into planta (especie,nombre_familia,cod_estado,cod_habito,cod_origen,nombre_comun, stock, caracteristicas) values ('$especie','$familia','$cod_estado','$cod_habito','$cod_origen','$nombre_comun',$stock,'$caracteristica' )";

    $this->conexion->consultar($sql);
  }
  function actualizarplantas($especie,$familia,$cod_estado,$cod_habito,$cod_origen,$nombre_comun, $stock)
  {

    $sql = "update planta set nombre_familia='$familia', cod_estado='$cod_estado',cod_habito='$cod_habito',cod_origen='$cod_origen',nombre_comun='$nombre_comun', stock='$stock'  where especie='$especie'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($especie = '')
  {

    if (empty($especie)) {

      $sql = "select * from planta";
    } else {

      $sql = "select * from planta where especie='$especie'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_planta($especie = '')
  {
    if ($especie) {

      $sql = "select * from planta where especie='$especie'";
    } else {

      $sql = "select * from planta";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
