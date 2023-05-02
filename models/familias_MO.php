<?php
class familias_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarfamilias($familia, $caracteristica)
  {

    $sql = "insert into familia (nombre_familia, caracteristicas) values ('$familia','$caracteristica' )";

    $this->conexion->consultar($sql);
  }
  function actualizarfamilias($familia, $caracteristica,$familia_org)
  {

    $sql = "update familia set nombre_familia='$familia', caracteristicas='$caracteristica'   where nombre_familia='$familia_org'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($familia = '')
  {

    if (empty($familia)) {

      $sql = "select * from familia";
    } else {

      $sql = "select * from familia where nombre_familia='$familia'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_familia($familia = '')
  {
    if ($familia) {

      $sql = "select * from familia where nombre_familia='$familia'";
    } else {

      $sql = "select * from familia";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
