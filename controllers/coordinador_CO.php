<?php

require_once "models/coordinador_MO.php";

class coordinador_CO
{

  function __construct()
  {
  }
  function actualizarcoordinador()
  {

    $conexion = new conexion();
    $coordinador_MO = new  coordinador_MO($conexion);

    $nombres= htmlentities($_POST['nombres'], ENT_QUOTES);
    $apellidos=htmlentities($_POST['apellidos'], ENT_QUOTES);
    $telefono=htmlentities($_POST['telefono'], ENT_QUOTES);
    $correo=htmlentities($_POST['correo'], ENT_QUOTES);
    $contrasena=htmlentities($_POST['contrasena'], ENT_QUOTES);
    $documento=htmlentities($_POST['documento'], ENT_QUOTES);
    
    if (empty($nombres)or empty($apellidos) or empty($telefono) or empty($correo)or empty($contrasena) ) {
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
    if (strlen($nombres) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre del coordinador deber ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
      if (strlen($apellidos) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de los apellidos del coordinador deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($telefono) > 20) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del telefono del coordinador deber ser menor de 20 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($correo) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del correo del coordinador deber ser menor de 50 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($contrasena) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de la contraseña deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      

    $coordinador_MO->actualizarcoordinador($documento,$nombres,$apellidos,$telefono,$correo,$contrasena);

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
