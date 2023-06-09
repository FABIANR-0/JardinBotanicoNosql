<?php

require_once "models/entidad_MO.php";

class entidades_CO
{

  function __construct()
  {
  }

  function agregarentidades()
  {

    $conexion = new conexion();

    $entidades_MO = new  entidad_MO($conexion);
   
    $nit = htmlentities($_POST['nit'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $tipo = htmlentities($_POST['tipo'], ENT_QUOTES);
    $telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
    $correo = htmlentities($_POST['correo'], ENT_QUOTES);
    $contrasena = htmlentities($_POST['contrasena'], ENT_QUOTES);
   
    if ( empty($nit) or empty($nombre) or empty($tipo) or empty($telefono) or empty($correo) or empty($contrasena)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (!(filter_var($correo, FILTER_VALIDATE_EMAIL))) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "por favor ingrese un correo valido"
      ];
      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nit) > 20) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nit debe ser menor de 20 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el nombre de la entidad debe ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if ($tipo!="privada" and $tipo!="publica" and $tipo!="PRIVADA" and $tipo!="PUBLICA" ) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el tipo de entidad solo puede ser publica o privada"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($telefono) > 20) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el telefono debe tener menos 20 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($correo) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el correo debe tener menos de 50 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($contrasena) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "la contraseña debe tener menos de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
 
    $arreglo_entidades = $entidades_MO->seleccionar_entidad($nit);
    foreach($arreglo_entidades as $doc_entidades){
      if ($nit==$doc_entidades['nit']) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El nit de la entidad ($nit) esta duplicado"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
    }

  
    $arreglo_entidad_email = $entidades_MO->seleccionar_entidadem($correo);
    foreach($arreglo_entidad_email as $doc_entidades_ema){
      if ($correo==$doc_entidades_ema['email']) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El correo  ($correo) esta duplicado"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
    }
    
    $arreglo_entidad_nombre = $entidades_MO->seleccionar_entidadnom($nombre);
    foreach($arreglo_entidad_nombre as $doc_entidades_nam){
      if ($nombre==$doc_entidades_nam['entity_name']) 
        {
          $arreglo_respuesta = [
            "estado" => "ERROR",
            "mensaje" => "El nombre  ($nombre) esta duplicado"
    
          ];
    
          exit(json_encode($arreglo_respuesta));
        }
    }
     
    $arreglo_entidad_telefono = $entidades_MO->seleccionar_entidadte($telefono);
    foreach($arreglo_entidad_telefono as $doc_entidades_tele){
      if ($telefono==$doc_entidades_tele['cellphone']) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El telefono  ($telefono) esta duplicado"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
    }
   
    $entidades_MO->agregarentidades($nit,$nombre,$tipo,$telefono,$correo,$contrasena);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "nit" => $nit,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }


  function actualizarentidades()
  {

    $conexion = new conexion();
    $entidad_MO = new  entidad_MO($conexion);

    $nit = htmlentities($_POST['nit'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $tipo = htmlentities($_POST['tipo'], ENT_QUOTES);
    $telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
    $correo = htmlentities($_POST['correo'], ENT_QUOTES);
 
    if ( empty($nit) or empty($nombre) or empty($tipo) or empty($telefono) or empty($correo) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (!(filter_var($correo, FILTER_VALIDATE_EMAIL))) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "por favor ingrese un correo valido"
      ];
      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el nombre de la entidad debe ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if ($tipo!="privada" and $tipo!="publica" and $tipo!="PRIVADA" and $tipo!="PUBLICA") {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el tipo de entidad solo puede ser publica o privada"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($telefono) > 20) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el telefono debe tener menos 20 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($correo) > 50) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el correo debe tener menos de 50 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
   
    

    $actualizado = $entidad_MO->actualizarentidades($nit,$nombre,$tipo,$telefono,$correo);

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
  function actualizarentidad()
  {

    $conexion = new conexion();
    $entidad_MO = new  entidad_MO($conexion);

    $nit = htmlentities($_POST['nit'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $tipo = htmlentities($_POST['tipo'], ENT_QUOTES);
    $telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
    $correo = htmlentities($_POST['correo'], ENT_QUOTES);
    $contrasena = htmlentities($_POST['contrasena'], ENT_QUOTES);
 
    if ( empty($nit) or empty($nombre) or empty($tipo) or empty($telefono) or empty($correo)  or empty($contrasena) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (!(filter_var($correo, FILTER_VALIDATE_EMAIL))) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "por favor ingrese un correo valido"
      ];
      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el nombre de la entidad debe ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if ($tipo!="privada" and $tipo!="publica" and $tipo!="PRIVADA" and $tipo!="PUBLICA") {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el tipo de entidad solo puede ser publica o privada"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($telefono) > 20) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el telefono debe tener menos 20 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($correo) > 50) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "el correo debe tener menos de 50 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($contrasena) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "la contraseña debe tener menos de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    

    $actualizado = $entidad_MO->actualizarentidad($nit,$nombre,$tipo,$telefono,$correo,$contrasena);

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
