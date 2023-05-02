<?php
class entidad_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarentidades($nit,$nombre,$tipo,$telefono,$correo,$contrasena)
  {

    $sql = "insert into entidad(nit,nombre_entidad,tipo_entidad,telefono,correo,contrasena, tipo_usuario) values ('$nit','$nombre','$tipo','$telefono','$correo','$contrasena','2')";

    $this->conexion->consultar($sql);
  }
  function actualizarentidades($nit,$nombre,$tipo,$telefono,$correo)
  {

    $sql = "update entidad set nombre_entidad='$nombre', tipo_entidad='$tipo',telefono='$telefono',correo='$correo' where nit='$nit'";

    $this->conexion->consultar($sql);
  }
  function actualizarentidad($nit,$nombre,$tipo,$telefono,$correo,$contrasena)
  {

    $sql = "update entidad set nombre_entidad='$nombre', tipo_entidad='$tipo',telefono='$telefono',correo='$correo',contrasena='$contrasena' where nit='$nit'";

    $this->conexion->consultar($sql);
  }
  function seleccionar_entidadem($correo){

    $sql = "select * from entidad where correo='$correo'";
    
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entidadnom($nombre){

    $sql = "select * from entidad where nombre_entidad='$nombre'";
    
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entidadte($telefono){

    $sql = "select * from entidad where telefono='$telefono'";
    
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }

  function seleccionar($nit= '')
  {

    if (empty($nit)) {

      $sql = "select * from entidad";
    } else {

      $sql = "select * from entidad where nit='$nit'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entidad($nit = '')
  {
    if ($nit) {

      $sql = "select * from entidad where nit='$nit'";
    } else {

      $sql = "select * from entidad";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
}