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
    $Nsql=array('nit'=>$nit,'entity_name'=>$nombre,'entity_type'=>$tipo,'cellphone'=>$telefono,'email'=>$correo,'password'=>$contrasena);

    $this->conexion->consultarIns($Nsql,"entities");


  }
  function actualizarentidades($nit,$nombre,$tipo,$telefono,$correo)
  {
    $Nsql= array('nit'=>$nit);

    $update=array('$set'=>array('entity_name'=>$nombre,'entity_type'=>$tipo,'cellphone'=>$telefono,'email'=>$correo ));
    
    $this->conexion->consultarAct($Nsql,$update,"entities");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;

     
  }
  function actualizarentidad($nit,$nombre,$tipo,$telefono,$correo,$contrasena)
  {
    $Nsql= array('nit'=>$nit);

    $update=array('$set'=>array('entity_name'=>$nombre,'entity_type'=>$tipo,'cellphone'=>$telefono,'email'=>$correo,'password'=>$contrasena));
    
    $this->conexion->consultarAct($Nsql,$update,"entities");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entidadem($correo){
    $Nsql = array('email'=>$correo);
  
    $this->conexion->consultar($Nsql,"entities");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entidadnom($nombre){
    $Nsql = array('entity_name'=>$nombre);
  
    $this->conexion->consultar($Nsql,"entities");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entidadte($telefono){

    $Nsql = array('cellphone'=>$telefono);
  
    $this->conexion->consultar($Nsql,"entities");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }

  function seleccionar($nit= '')
  {
    
    if (empty($nit)) {

      $Nsql = array();
    } else {

      $Nsql = array('nit'=>$nit);
    }

    $this->conexion->consultar($Nsql,"entities");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entidad($nit = '')
  {
    if ($nit) {

      $Nsql = array('nit'=>$nit);
    } else {

      $Nsql = array();
    }

    $this->conexion->consultar($Nsql,"entities");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
}