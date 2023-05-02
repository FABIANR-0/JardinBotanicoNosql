<?php
class municipio_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }
 

  function seleccionar($cod_municipio= '')
  {

    if (empty($cod_municipio)) {

      $sql = "select * from municipio";
    } else {

      $sql = "select * from municipio where cod_municipio='$cod_municipio'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
 
}