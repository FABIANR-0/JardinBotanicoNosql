<?php
class donacion_entrante_en_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregardonacion($id_donacion , $nit,$documento,$fecha,$cod_departamento,$cod_municipio,$cod_lugar)
  {

    $sql = "insert into donacion_saliente(id_donacion,nit,documento,fecha,cod_lugar,cod_municipio,cod_departamento,observacion,total_plantas,estado) values ('$id_donacion','$nit','$documento','$fecha','$cod_lugar','$cod_municipio','$cod_departamento','EN PROCESO',0,default)";

    $this->conexion->consultar($sql);
  }
   
  function actualizarPlanta($especie, $cantidad){
    $sql = "update planta set stock=stock+$cantidad where especie='$especie'";

    $this->conexion->consultar($sql);

  }
  function consultarespera($nit){

    $sql = "select * from donacion_saliente where nit='$nit' and estado='1'";
    
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  
  function eliminardonacion($id_donacion){
    $sql = "delete from donacion_saliente where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }

  function eliminardonaciondet($id_donacion){
    $sql = "delete from detalle_donacion_saliente where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }
 

  function seleccionar($nit= '')
  {

    if (empty($nit)) {

      $sql = "select * from donacion_saliente";
    } else {

      $sql = "select * from donacion_saliente where nit='$nit'";
    }
 
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionardc($documento= '')
  {

    if (empty($documento)) {

      $sql = "select * from donacion_saliente";
    } else {

      $sql = "select * from donacion_saliente where documento='$documento'";
    }
 
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionardon($id_donacion){
    if (empty($id_donacion)) {

      $sql = "select * from donacion_saliente";
    } else {

      $sql = "select * from donacion_saliente where id_donacion='$id_donacion'";
    }
 
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function actualizar($id_donacion,$cod_departamento,$cod_municipio,$cod_lugar){
     
    $sql = "update donacion_saliente set cod_departamento='$cod_departamento',cod_municipio='$cod_municipio',cod_lugar='$cod_lugar' where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);

  }
  function aceptar($id_donacion){
    $sql = "update donacion_saliente set  estado='2',observacion='CUMPLE CON LAS CONDICIONES' where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);
  }
  function rechazar($id_donacion){
    $sql = "update donacion_saliente set  estado='3',observacion='NO CUMPLE CON LAS CONDICIONES' where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);
  }
  function seleccionarDetalle($id_donacion= '')
  {

    if (empty($id_donacion)) {

      $sql = "select * from detalle_donacion_saliente";
    } else {

      $sql = "select * from detalle_donacion_saliente where id_donacion='$id_donacion'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionarMax()
  {
    $sql = "select max(id_donacion) as mayor from donacion_saliente";

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
 
}