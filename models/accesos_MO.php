<?php
class accesos_MO
{
    private $conexion;
    
    function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    function iniciarSesion($correo,$contrasena)
    {
        //$sql="select documento from coordinador where correo='$correo' and contrasena='$contrasena'";
        $consult=array('email'=>$correo,'password'=>$contrasena);
        $this->conexion->consultar($consult,"coordinators");
        return $this->conexion->extraerRegistro();
    }
    function iniciarSesionEn($correo,$contrasena)
    {
        $consult=array('email'=>$correo,'password'=>$contrasena);
        $this->conexion->consultar($consult,"entities");
        return $this->conexion->extraerRegistro();

       
    }

}
?>
