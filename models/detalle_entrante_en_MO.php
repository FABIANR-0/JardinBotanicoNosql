<?php
class detalle_entrante_en_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregardetalle($id_donacion , $id_detalle,$especie,$catidad)
  {

    $sql = "insert into detalle_donacion_saliente(id_donacion,id_detalle_donacion,especie,cantidad) values ($id_donacion,'$id_detalle','$especie',$catidad)";

    $this->conexion->consultar($sql);
  }
  function restarStock($especie,$resta)
  {
    $sql = "update planta set stock='$resta' where especie='$especie'";

    $this->conexion->consultar($sql); 
  }
  function actualizarentidades($nit,$nombre,$tipo,$telefono,$correo)
  {

    $sql = "update entidad set nombre_entidad='$nombre', tipo_entidad='$tipo',telefono='$telefono',correo='$correo' where nit='$nit'";

    $this->conexion->consultar($sql);
  }
  function eliminardonaciondet($id_donacion){
    $sql = "delete from detalle_donacion_saliente where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }
  function eliminardetalle($id_donacion,$id_detalle){
    $sql = "delete from detalle_donacion_saliente where id_donacion=$id_donacion and id_detalle_donacion='$id_detalle'";
    
    $this->conexion->consultar($sql);
  }
  function eliminardonacion($id_donacion){
    $sql = "delete from donacion_saliente where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }
  function actualizarPlanta($especie, $cantidad){
    $sql = "update planta set stock=stock+$cantidad where especie='$especie'";

    $this->conexion->consultar($sql);

  }
  function restar_donacion($id_donacion,$cantidad){
    $sql = "update donacion_saliente set total_plantas=total_plantas-$cantidad where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);
  }
  function agregar_donacion($id_donacion,$cantidad){
    $sql = "update donacion_saliente set total_plantas=total_plantas+$cantidad where id_donacion='$id_donacion'";

    $this->conexion->consultar($sql);

  }
  function actdetalle($id_donacion,$id_detalle,$especie,$cantidad){
    $sql = "update detalle_donacion_saliente set especie='$especie',cantidad=$cantidad where id_donacion=$id_donacion and id_detalle_donacion='$id_detalle'";

    $this->conexion->consultar($sql);
  }

  function consulplan($id_donacion,$id_detalle,$especie){
    $sql = "select * from detalle_donacion_saliente where id_donacion=$id_donacion  and especie='$especie'";
    
    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }


  function seleccionar_detalle($id_donacion= '')
  {

    if (empty($id_donacion)) {

      $sql = "select * from detalle_donacion_saliente";
    } else {

      $sql = "select * from detalle_donacion_saliente where id_donacion=$id_donacion";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionarMax()
  {
    $sql = "select max(id_donacion) as mayor from detalle_donacion_saliente";

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
 
}