<?php

require_once "models/estados_MO.php";

class estados_CO
{

  function __construct()
  {
  }

  function agregarestados()
  {

    $conexion = new conexion();

    $estados_MO = new  estados_MO($conexion);
   
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre=htmlentities($_POST['nombre'], ENT_QUOTES);
   
    if ( empty($codigo) or empty($nombre) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($codigo) > 4) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo deber ser menor de 4 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del nombres deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
 
    $arreglo_estados = $estados_MO->seleccionar_codigo($codigo);
    if ($arreglo_estados) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El codigo ($codigo) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $estados_MO->agregarestados( $codigo, $nombre);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "codigo" => $codigo,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarestados()
  {

    $conexion = new conexion();
    $estados_MO = new  estados_MO($conexion);
 
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $codigo_org=htmlentities($_POST['codige'], ENT_QUOTES);

    if (  empty($codigo) or empty($nombre) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($codigo) > 4) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del codigo debe ser menor de 4 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre  deber ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    if($codigo == $codigo_org){
      $estados_MO->actualizarestados($codigo, $nombre,$codigo_org);

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
      $arreglo_estados = $estados_MO->seleccionar_codigo($codigo);
      if ($arreglo_estados) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El codigo ($codigo) esta duplicado"

        ];

        exit(json_encode($arreglo_respuesta));
      }

    }
    $estados_MO->actualizarestados($codigo, $nombre,$codigo_org);

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
