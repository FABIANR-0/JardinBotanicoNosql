<?php
class habitos_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarhabitos($codigo, $nombre)
  {

    $sql = "insert into habito_crecimiento (cod_habito, nombre_habito) values ('$codigo','$nombre' )";

    $this->conexion->consultar($sql);
  }
  function actualizarhabitos($codigo, $nombre,$codigo_org)
  {

    $sql = "update habito_crecimiento set cod_habito='$codigo', nombre_habito='$nombre'   where cod_habito='$codigo_org'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($codigo = '')
  {

    if (empty($codigo)) {

      $sql = "select * from habito_crecimiento";
    } else {

      $sql = "select * from habito_crecimiento where cod_habito ='$codigo'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_codigo($codigo = '')
  {
    if ($codigo) {

      $sql = "select * from habito_crecimiento where cod_habito='$codigo'";
    } else {

      $sql = "select * from habito_crecimiento";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
