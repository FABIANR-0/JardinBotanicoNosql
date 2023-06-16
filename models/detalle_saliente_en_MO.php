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
    $Nsql= array('number'=>(int)$id_donacion);
     
    $val=$id_detalle-1;
    
    $update=array('$set'=>array("detail_incoming_donations.$val.amount_plants"=>(int)$catidad,"detail_incoming_donations.$val.species"=>$especie,"detail_incoming_donations.$val.number"=>(int)$id_detalle),'$inc'=>array('total_plants'=>(int)$catidad));
    $update1=array('$pull'=>array('detail_incoming_donations'=>array('$in'=> [null])));
    
   
    $this->conexion->consultarAct($Nsql,$update,"donations");
    $this->conexion->consultarAct($Nsql,$update1,"donations");
    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
    
  }
  
 
  function eliminardonaciondet($id_donacion){
    $sql = "delete from detalle_donacion_entrante where id_donacion=$id_donacion";
    
    $this->conexion->consultar($sql);
  }

  function eliminardetalle($id_donacion,$id_detalle,$cantidad,$especie){
    $Nsql= array('number'=>(int)$id_donacion,"detail_incoming_donations.species"=>$especie);
    $this->conexion->consultar($Nsql,"donations");

    $arreglo = $this->conexion->extraerRegistro();
    $pos=0;
    foreach($arreglo as $document){
      foreach( $document['detail_incoming_donations'] as $spec){
        if($spec['species']==$especie){
          break;
        }
        $pos++;
      }
    
    }

    //$val=$id_detalle-1;
    $Nsql1= array('number'=>(int)$id_donacion);

    $update=array('$unset'=>array("detail_incoming_donations.$pos"=>1),'$inc'=>array('total_plants'=>-(int)$cantidad));
    $update1=array('$pull'=>array('detail_incoming_donations'=>array('$in'=> [null])));
    
    $this->conexion->consultarAct($Nsql1,$update,"donations");
    $this->conexion->consultarAct($Nsql1,$update1,"donations");
    $arreglo1 = $this->conexion->extraerRegistro();

    return $arreglo1;
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

  function actdetalle($id_donacion,$id_detalle,$especieorg,$especie,$cantidad,$diferencia){
    $Nsql= array('number'=>(int)$id_donacion,"detail_incoming_donations.species"=>$especieorg);
    $this->conexion->consultar($Nsql,"donations");

    $arreglo = $this->conexion->extraerRegistro();
    $pos=0;
    foreach($arreglo as $document){
      foreach( $document['detail_incoming_donations'] as $spec){
        if($spec['species']==$especieorg){
          break;
        }
        $pos++;
      }
    
    }
   
    $update=array('$set'=>array("detail_incoming_donations.$pos.amount_plants"=>(int)$cantidad,"detail_incoming_donations.$pos.species"=>$especie),'$inc'=>array('total_plants'=>(int)$diferencia));
   
    $this->conexion->consultarAct($Nsql,$update,"donations");
   
    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  
  }
  function consulplan($id_donacion,$id_detalle,$especie){
    $Nsql = array('number'=>(int)$id_donacion);
    
    $this->conexion->consultar($Nsql,"donations");

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