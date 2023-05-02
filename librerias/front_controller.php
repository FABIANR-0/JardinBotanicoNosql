<?php
class front_controller
{
    function __construct($ruta)
    {
        if(empty($ruta))
        {
            $carpeta='view';
            $clase='menu_VI';
            $metodo='verMenu';
        }else if($ruta=='p')
        {
            $carpeta='view';
            $clase='menuEn_VI';
            $metodo='verMenu';
        }else
        {
            $arreglo_ruta=explode('/',$ruta);
            $clase=$arreglo_ruta[0];
            $metodo=$arreglo_ruta[1];

            $sufijo=substr($clase,-2);
            if($sufijo=='CO')
            {
                $carpeta="controllers";
            }
            else if($sufijo=='VI')
            {
                $carpeta="view";
            }
            else if($sufijo=='MO')
            {
                $carpeta="models";
            }
        }

        $archivo=$clase.".php";

        require_once "$carpeta/$archivo";
        $objeto=new $clase();
        $objeto->$metodo();
    }
}
?>