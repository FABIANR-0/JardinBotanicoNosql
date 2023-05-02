<?php
require_once "models/accesos_MO.php";

class accesos_CO
{
    function __construct(){}

    function iniciarSesion($correo,$contrasena)
    {
        $conexion=new conexion();
        
        $accesos_MO=new accesos_MO($conexion);
        
        $arreglo=$accesos_MO->iniciarSesion($correo,$contrasena);

       if($arreglo)
        { 
            
            $objeto_accesos=$arreglo[0];

            $documento=$objeto_accesos->documento;
            
            $_SESSION['documento']=$documento;
        }else{
            $arregloen=$accesos_MO->iniciarSesionEn($correo,$contrasena);
            if($arregloen)
            {
                $objeto_accesos=$arregloen[0];
    
                $nit=$objeto_accesos->nit;
                
                $_SESSION['nit']=$nit;
            }
        }

        header('Location: index.php');
    }

    function salir()
    {
        session_destroy();
        
    }

}
?>