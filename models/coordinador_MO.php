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

      $Nsql = array();
    } else {

      $Nsql = array('Document'=>$documento);
    }

    $this->conexion->consultar($Nsql,"coordinators");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function actualizarcoordinador($documento,$nombres,$apellidos,$telefono,$correo,$contrasena)
  {

    $Nsql= array('Document'=>$documento);
    $update=array('$set'=>array('first_name'=>$nombres,'last_name'=>$apellidos,'cellphone'=>$telefono,'email'=>$correo,'password'=>$contrasena));
    

    $this->conexion->consultarAct($Nsql,$update,"coordinators");
    
    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
}