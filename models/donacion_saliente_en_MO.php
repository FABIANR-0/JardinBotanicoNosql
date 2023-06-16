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
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Bogota");
    $fecha1 = date('Y-m-d');
                
    $today = new \MongoDB\BSON\UTCDateTime(strtotime($fecha1) * 1000); 
    
    $Nsql=array('number'=>(int)$id_donacion,'date'=> $today,'observations'=>'EN PROCESO','total_plants'=>0,'state'=>1,'coordinator'=>$documento,'entity'=>$nit,'detail_incoming_donations'=>array());

    $this->conexion->consultarIns($Nsql,'donations');
    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
   
  function actualizarPlanta($especie, $cantidad){
    $Nsql= array('species'=>$especie);

    $update=array('$inc'=>array('stock'=>(int)$cantidad));
    
    $this->conexion->consultarAct($Nsql,$update,"plants");


  }
  
  
  function eliminardonacion($id_donacion){
    $Nsql =array("number"=>(int)$id_donacion);
    
    $this->conexion->consultarDel($Nsql,"donations");
    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }

  function eliminardonaciondet($id_donacion){
    $sql = "delete from detalle_donacion_entrante where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }
 

  function seleccionar($nit= '')
  {
    if (empty($nit)) {

      $Nsql = array();
    } else {

      $Nsql = array('entity'=>$nit);
    }

    $this->conexion->consultar($Nsql,"donations");

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;

  }
  function seleccionardc($documento= '')
  {
    if (empty($documento)) {

      $Nsql = array();
    } else {

      $Nsql = array('coordinator'=>$documento);
    }

    $this->conexion->consultar($Nsql,"donations");

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
    $Nsql= array('number'=>(int)$id_donacion);
    $update=array('$set'=>array('state'=>(int)2,'observations'=>'CUMPLE CON LAS CONDICIONES'));
    

    $this->conexion->consultarAct($Nsql,$update,"donations");
  }

  function rechazar($id_donacion){
    $Nsql= array('number'=>(int)$id_donacion);
    $update=array('$set'=>array('state'=>(int)3,'observations'=>'NO CUMPLE CON LAS CONDICIONES'));
    
    $this->conexion->consultarAct($Nsql,$update,"donations");
   
  }
  
  function seleccionarDetalle($id_donacion= '')
  {

    if (empty($id_donacion)) {

      $Nsql = array();
    } else {

      $Nsql =  array('number'=>(int)$id_donacion);
    }

    $this->conexion->consultar($Nsql,'donations');

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