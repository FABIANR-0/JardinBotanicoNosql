<?php
class coordinador_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

 

  function seleccionar($documento= '')
  {

    if (empty($documento)) {

      $sql = "select * from coordinador";
    } else {

      $sql = "select * from coordinador where documento='$documento'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function actualizarcoordinador($documento,$nombres,$apellidos,$telefono,$correo,$contrasena)
  {

    $sql = "update coordinador set nombres='$nombres', apellidos='$apellidos',telefono='$telefono',correo='$correo',contrasena='$contrasena'  where documento='$documento'";

    $this->conexion->consultar($sql);
  }
 
}