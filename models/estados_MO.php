<?php
class estados_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarestados($codigo, $nombre)
  {

    $sql = "insert into estado_conservacion (cod_estado, nombre_estado) values ('$codigo','$nombre' )";

    $this->conexion->consultar($sql);
  }
  function actualizarestados($codigo, $nombre,$codigo_org)
  {

    $sql = "update estado_conservacion set cod_estado='$codigo', nombre_estado='$nombre'   where cod_estado='$codigo_org'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($codigo = '')
  {

    if (empty($codigo)) {

      $sql = "select * from estado_conservacion";
    } else {

      $sql = "select * from estado_conservacion where cod_estado ='$codigo'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_codigo($codigo = '')
  {
    if ($codigo) {

      $sql = "select * from estado_conservacion where cod_estado='$codigo'";
    } else {

      $sql = "select * from estado_conservacion";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
