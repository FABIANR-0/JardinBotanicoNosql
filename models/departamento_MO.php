<?php
class departamento_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }
 

  function seleccionar($cod_departamento= '')
  {

    if (empty($cod_departamento)) {

      $sql = "select * from departamento";
    } else {

      $sql = "select * from departamento where cod_departamento='$cod_departamento'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function showMunicipio($cod_departamento)
    {

        $sql = "select * from municipio where cod_departamento='$cod_departamento'";

        $this->conexion->consultar($sql);

        $arreglo = $this->conexion->extraerRegistro();
    
         return $arreglo;
    }
    function showLugar($cod_municipio)
    {

        $sql = "select * from lugar where cod_municipio='$cod_municipio'";

        $this->conexion->consultar($sql);

        $arreglo = $this->conexion->extraerRegistro();
    
         return $arreglo;
    }
 
 
}