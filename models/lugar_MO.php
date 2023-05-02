<?php
class lugar_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }
 

  function seleccionar($cod_lugar= '')
  {

    if (empty($cod_lugar)) {

      $sql = "select * from lugar";
    } else {

      $sql = "select * from lugar where cod_lugar='$cod_lugar'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
 
}