<?php

require_once "models/detalle_saliente_en_MO.php";
require_once "models/plantas_MO.php";

class detalle_saliente_en_CO
{

  function __construct()
  {
  }

  function agregardetalle()
  {

    $conexion = new conexion();
    $detalle_en_MO = new detalle_saliente_en_MO($conexion);
    $json = file_get_contents('php://input');
    $datos=json_decode($json, true);
    //print_r($datos);
    $id_donacion=$datos['id_donacion'];
    $cantidad=$datos['cantidad'];
    $id_detalle=$datos['id_detalle'];
    $especie=$datos['especie'];
    
    if ( $cantidad==0 ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "La cantidad no puede ser cero"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    $especie_repe=$detalle_en_MO->consulplan($id_donacion,$id_detalle,$especie);
    if ($especie_repe) {
     $arreglo_respuesta = [
       "estado" => "ERROR",
       "mensaje" => "esa planta ya esta registrada en el detalle, seleccione otra"
   
     ];
   
     exit(json_encode($arreglo_respuesta));
   }
    if ( empty($id_donacion) or empty($id_detalle) or empty($especie) or empty($cantidad) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if ($cantidad>50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "la cantidad excede el limite"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
    
    $detalle_en_MO->agregardetalle($id_donacion,$id_detalle,$especie,$cantidad);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }
  function actualizar()
  {

    $conexion = new conexion();
    $detalle_en_MO = new detalle_saliente_en_MO($conexion);
   
    $id_donacion = htmlentities($_POST['id_donacion'], ENT_QUOTES);
    $id_detalle = htmlentities($_POST['id_detalle'], ENT_QUOTES);
    $cantidad_org = htmlentities($_POST['cantidad_org'], ENT_QUOTES);
    $especie = htmlentities($_POST['especie1'], ENT_QUOTES);
    $especieorg = htmlentities($_POST['especie_org'], ENT_QUOTES);
    $cantidad = htmlentities($_POST['cantidad1'], ENT_QUOTES);
  
       
      if ($cantidad>50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "la cantidad excede el limite"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if ( $cantidad==0 ) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "La cantidad no puede ser cero"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
  

    if ( empty($especie) or empty($cantidad)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if($especie==$especieorg){
   
      $detalle_en_MO->actdetalle($id_donacion,$id_detalle,$especie,$cantidad);

    }else{
      
       $detalle_en_MO->actdetalle($id_donacion,$id_detalle,$especie,$cantidad);
   
    }
  
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro actualizado"

    ];

    exit(json_encode($arreglo_respuesta));
  }
  function eliminardetalle()
  {

    $conexion = new conexion();
    $detalle_en_MO = new detalle_saliente_en_MO($conexion);
    $json = file_get_contents('php://input');
    $datos=json_decode($json, true);
    //print_r($datos);
    $id_donacion=$datos['id_donacion'];
    $id_detalle=$datos['id_detalle'];
    $cantidad=$datos['cantidad'];
    $especie=$datos['especie'];

    $detalle_en_MO->eliminardetalle($id_donacion,$id_detalle);
    $detalle_en_MO->restar_donacion($id_donacion,$cantidad);
 
    $eliminado = $conexion->filasAfectadas();
    if ($eliminado) {
  
      $mensaje = "Registro Eliminado";
      $estado = 'EXITO';
    } else {

      $mensaje = "No se realizaron cambios";
      $estado = 'ADVERTENCIA';
    }

    $arreglo_respuesta = [
      "estado" => $estado,
      "mensaje" => $mensaje
    ];

    exit(json_encode($arreglo_respuesta, true));
  }



}
