<?php
class conexion
{
    private $enlace;
    private $resultado;

    function __construct()
    {
       
        
        try {
            //Creamos nuestra nueva instancia de PDO con el driver de Postgres
             $this->enlace = new PDO("pgsql:dbname=JARDIN_BOTANICO;host=localhost;user=postgres;password=1234");
            // $this->enlace = new PDO("pgsql:dbname=gjaksvyb;host=heffalump.db.elephantsql.com;user=gjaksvyb;password=aAWvbc_EO7u_gzs9K4hWZHimxvM4CRxW");

            
            //Habilitamos el modo de errores para visualizarlos
            $this->enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //Definimos el tipo de respuesta para todas las consultas realizadas sobre esta instancia
            $this->enlace->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
             die("Error : " . $e->getMessage() . "<br/>");
             }
    
    }

    function consultar($sql)
    {
        $this->resultado=$this->enlace->query($sql) or $this->errorConsulta($sql);
    }
     
    function filasAfectadas()
    {

        if ($this->resultado->rowCount() > 0) {

            return true;
        } else {

            return false;
        }
    }
    function extraerRegistro()
    {
        return $this->resultado->fetchAll(PDO::FETCH_OBJ);
    }

    function lastInsertId()
    {
        return $this->enlace->lastInsertId();
    }

    function errorConsulta()
    {
        $arreglo_respuesta=[
            "estado"=>"ERROR",
            "mensaje"=>"Consulta mal estructurada:sql",
            
        ];
            exit(json_encode($arreglo_respuesta));

    }
}
?>