<?php

require_once "models/familias_MO.php";

class familias_CO
{

  function __construct()
  {
  }

  function agregarfamilias()
  {

    $conexion = new conexion();

    $familias_MO = new  familias_MO($conexion);
   
    $familia = htmlentities($_POST['familia'], ENT_QUOTES);
    $caracteristica=htmlentities($_POST['caracteristica'], ENT_QUOTES);
   
    if ( empty($familia) or empty($caracteristica) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($familia) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre de la familia deber ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($caracteristica) > 500) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de las caracteristicas de la familia deber ser menor de 500 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
 
    $arreglo_familias = $familias_MO->seleccionar_familia($familia);
    if ($arreglo_familias) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El nombre de la familia ($familia) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $familias_MO->agregarfamilias( $familia, $caracteristica);

    
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "familia" => $familia,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarfamilias()
  {

    $conexion = new conexion();
    $familias_MO = new  familias_MO($conexion);
 
    $familia = htmlentities($_POST['familia'], ENT_QUOTES);
    $caracteristica = htmlentities($_POST['caracteristica'], ENT_QUOTES);
    $familia_org=htmlentities($_POST['family'], ENT_QUOTES);

    if (  empty($familia) or empty($caracteristica) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($familia) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre debe  ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($caracteristica) > 500) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño de las caracteristicas de la familia deber ser menor de 500 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    if($familia == $familia_org){
      $familias_MO->actualizarfamilias($familia, $caracteristica,$familia_org);

      $actualizado = $conexion->filasAfectadas();
  
      if ($actualizado) {
  
        $mensaje = "Registro Actualizado";
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
    }else {
      $arreglo_familias = $familias_MO->seleccionar_familia($familia);
      if ($arreglo_familias) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El nombre de la familia ($familia) esta duplicado"

        ];

        exit(json_encode($arreglo_respuesta));
      }

    }
    $familias_MO->actualizarfamilias($familia, $caracteristica,$familia_org);

    $actualizado = $conexion->filasAfectadas();

    if ($actualizado) {

      $mensaje = "Registro Actualizado";
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
