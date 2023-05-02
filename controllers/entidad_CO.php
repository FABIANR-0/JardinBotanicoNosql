<?php

require_once "../models/entidad_MO.php";
require_once "../librerias/conexion.php";
 
$conexion = new conexion();

$entidades_MO = new  entidad_MO($conexion);

$nit = htmlentities($_POST['nit'], ENT_QUOTES);
$nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
$tipo = htmlentities($_POST['tipo'], ENT_QUOTES);
$telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
$correo = htmlentities($_POST['correoen'], ENT_QUOTES);
$contrasena = htmlentities($_POST['contrasenaen'], ENT_QUOTES);

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
if ($arreglo_entidades) {
  $arreglo_respuesta = [
    "estado" => "ERROR",
    "mensaje" => "El nit de la entidad ($nit) esta duplicado"

  ];

  exit(json_encode($arreglo_respuesta));
}
$arreglo_entidad_email = $entidades_MO->seleccionar_entidadem($correo);
if ($arreglo_entidad_email) {
  $arreglo_respuesta = [
    "estado" => "ERROR",
    "mensaje" => "El correo  ($correo) esta duplicado"

  ];

  exit(json_encode($arreglo_respuesta));
}
$entidades_MO->agregarentidades($nit,$nombre,$tipo,$telefono,$correo,$contrasena);
/*$familia= $conexion->lastInsertId();*/
$arreglo_respuesta = [
  "nit" => $nit,
  "estado" => "EXITO",
  "mensaje" => "Registro agregado ya puedes logearte"

];

exit(json_encode($arreglo_respuesta));
?>