<?php
class donacion_saliente_en_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregardonacion($id_donacion,$nit,$documento,$fecha)
  {

    $sql = "insert into donacion_entrante(id_donacion,nit,documento,fecha,observacion,total_plantas,estado) values ('$id_donacion','$nit','$documento','$fecha','EN PROCESO',0,default)";

    $this->conexion->consultar($sql);
  }
   
  function actualizarPlanta($especie, $cantidad){
    $sql = "update planta set stock=stock+$cantidad where especie='$especie'";

    $this->conexion->consultar($sql);

  }
  
  
  function eliminardonacion($id_donacion){
    $sql = "delete from donacion_entrante where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }

  function eliminardonaciondet($id_donacion){
    $sql = "delete from detalle_donacion_entrante where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }
 

  function seleccionar($nit= '')
  {

    if (empty($nit)) {

      $sql = "select * from donacion_entrante";
    } else {

      $sql = "select * from donacion_entrante where nit='$nit'";
    }
 
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionardc($documento= '')
  {

    if (empty($documento)) {

      $sql = "select * from donacion_entrante";
    } else {

      $sql = "select * from donacion_entrante where documento='$documento'";
    }
 
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionardon($id_donacion){
    if (empty($id_donacion)) {

      $sql = "select * from donacion_entrante";
    } else {

      $sql = "select * from donacion_entrante where id_donacion='$id_donacion'";
    }
 
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function actualizar($id_donacion ){
     
    $sql = "update donacion_entrante   where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);

  }
  function aceptar($id_donacion){
    $sql = "update donacion_entrante set  estado='2',observacion='CUMPLE CON LAS CONDICIONES' where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);
  }

  function rechazar($id_donacion){
    $sql = "update donacion_entrante set  estado='3',observacion='NO CUMPLE CON LAS CONDICIONES' where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);
  }
  
  function seleccionarDetalle($id_donacion= '')
  {

    if (empty($id_donacion)) {

      $sql = "select * from detalle_donacion_entrante";
    } else {

      $sql = "select * from detalle_donacion_entrante where id_donacion='$id_donacion'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionarMax()
  {
    $sql = "select max(id_donacion) as mayor from donacion_entrante";

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
 
}