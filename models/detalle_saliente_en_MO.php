<?php
class detalle_saliente_en_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregardetalle($id_donacion , $id_detalle,$especie,$catidad)
  {

    $sql = "insert into detalle_donacion_entrante(id_donacion,id_detalle_donacion,especie,cantidad) values ($id_donacion,'$id_detalle','$especie',$catidad)";

    $this->conexion->consultar($sql);
  }
  
 
  function eliminardonaciondet($id_donacion){
    $sql = "delete from detalle_donacion_entrante where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }

  function eliminardetalle($id_donacion,$id_detalle){
    $sql = "delete from detalle_donacion_entrante where id_donacion=$id_donacion and id_detalle_donacion='$id_detalle'";
    
    $this->conexion->consultar($sql);
  }

  function eliminardonacion($id_donacion){
    $sql = "delete from donacion_entrante where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }
 
  function restar_donacion($id_donacion,$cantidad){
    $sql = "update donacion_entrante set total_plantas=total_plantas-$cantidad where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);
  }

  function agregar_donacion($id_donacion,$cantidad){
    $sql = "update donacion_entrante set total_plantas=total_plantas+$cantidad where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);

  }

  function actdetalle($id_donacion,$id_detalle,$especie,$cantidad){
    $sql = "update detalle_donacion_entrante set especie='$especie',cantidad=$cantidad where id_donacion=$id_donacion and id_detalle_donacion='$id_detalle'";

    $this->conexion->consultar($sql);
  }
  function consulplan($id_donacion,$id_detalle,$especie){
    $sql = "select * from detalle_donacion_entrante where id_donacion=$id_donacion  and especie='$especie'";
    
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_detalle($id_donacion= '')
  {

    if (empty($id_donacion)) {

      $sql = "select * from detalle_donacion_entrante";
    } else {

      $sql = "select * from detalle_donacion_entrante where id_donacion=$id_donacion";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  
  function seleccionarMax()
  {
    $sql = "select max(id_donacion) as mayor from detalle_donacion_entrante";

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
 
}