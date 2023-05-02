<?php
class origenes_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarorigenes($origen, $nombre)
  {

    $sql = "insert into origen (cod_origen, nombre_origen) values ('$origen','$nombre' )";

    $this->conexion->consultar($sql);
  }
  function actualizarorigenes($origen, $nombre,$origen_org)
  {

    $sql = "update origen set nombre_origen='$nombre', cod_origen='$origen'   where cod_origen='$origen_org'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($cod_origen = '')
  {

    if (empty($cod_origen)) {

      $sql = "select * from origen";
    } else {

      $sql = "select * from origen where cod_origen ='$cod_origen'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_codigo($origen = '')
  {
    if ($origen) {

      $sql = "select * from origen where cod_origen='$origen'";
    } else {

      $sql = "select * from origen";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
