<?php

require_once "models/departamento_MO.php";

class departamento_CO
{

  function __construct()
  {
  }

  function showMunicipio()
  {

    $conexion = new conexion();

    $departamento_MO = new  departamento_MO($conexion);
   
    $cod_departamento = htmlentities($_POST['departamento'], ENT_QUOTES);
    
    $arreglo = $departamento_MO->showMunicipio($cod_departamento);

    if (!$arreglo) {
        $response = ["message" => 'ERROR LOS MUNICIPIOS NO SE ENCUENTRAN DISPONIBLES'];
        exit(json_encode($response));
    }
    exit(json_encode($arreglo));
  }
  function showLugar()
  {

    $conexion = new conexion();

    $departamento_MO = new  departamento_MO($conexion);
   
    $cod_municipio = htmlentities($_POST['municipio'], ENT_QUOTES);
    
    $arreglo = $departamento_MO->showLugar($cod_municipio);

    if (!$arreglo) {
        $response = ["message" => 'ERROR LOS MUNICIPIOS NO SE ENCUENTRAN DISPONIBLES'];
        exit(json_encode($response));
    }
    exit(json_encode($arreglo));
  }
}
