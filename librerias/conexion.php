<?php
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
if(isset($_SESSION['documento']) or isset($_SESSION['nit'])){
    require_once "vendor/autoload.php";
}

class conexion
{
    private $enlace;
    private $resultado;
    private $database;
    private $collection;

    function __construct()
    {
        if(isset($_SESSION['documento']) or isset($_SESSION['nit'])){
           
        }else{
            require_once "../vendor/autoload.php";
        }
       
        
        
        //use Exception;
        
        //phpinfo();
        /*$uri ="fabianrincon1407:KT2Wh5L9evNlMTUZ@cluster0.wmm4x2c.mongodb.net/?retryWrites=true&w=majority";
        // Specify Stable API version 1
        $apiVersion = new ServerApi(ServerApi::V1);
        // Create a new client and connect to the server
        $client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);
        */
        //$client = new MongoDB\Client("mongodb://localhost:27017");
        $this->enlace= new MongoDB\Client("mongodb+srv://fabianrincon1407:KT2Wh5L9evNlMTUZ@cluster0.wmm4x2c.mongodb.net/?retryWrites=true&w=majority");
        try {

            $this->database = $this->enlace->company;
            $this->collection = $this->database ->coordinators; 

            /*//$result = $collection->find(array());
            //$result = $collection->find(array('user' => 'fabianrc0'));

            //print_r($result);

            //echo '<h2>Actresses after updating and deleting bad data</h2>';

            foreach ($result as $document) {
                echo $document['_id'] . " /" .$document['user'] . " /" . $document['state'] . '</br>';
            }*/
            // Send a ping to confirm a successful connection
            //$client->selectDatabase('admin')->command(['ping' => 1]);
            //echo "Pinged your deployment. You successfully connected to MongoDB!\n";
        } catch (Exception $e) {
            printf($e->getMessage());
        }
    }
    function consultar($consult,$collec)
    {
        if($collec=="coordinators"){
            $this->collection = $this->database ->coordinators; 
        }elseif($collec=="plants"){
            $this->collection = $this->database ->plants; 
        }
       
        $this->resultado=$this->collection->find($consult);//find(array('email'=>'frinconc@ufpso.edu.co','password'=>'1234'));
        //find(array('email'=>'frinconc@ufpso.edu.co','password'=>'1234'))
    }

    function consultarAct($consult,$update,$collec)
    {
        if($collec=="coordinators"){
            $this->collection = $this->database ->coordinators; 
        }elseif($collec=="plants"){
            $this->collection = $this->database ->plants; 
        }
       
        $this->resultado=$this->collection->updateone($consult,$update);//find(array('email'=>'frinconc@ufpso.edu.co','password'=>'1234'));
        //find(array('email'=>'frinconc@ufpso.edu.co','password'=>'1234'))
    }
    function consultarIns($consult,$collec)
    {
        if($collec=="coordinators"){
            $this->collection = $this->database ->coordinators; 
        }elseif($collec=="plants"){
            $this->collection = $this->database ->plants; 
        }
       
        $this->resultado=$this->collection->insertOne($consult);//find(array('email'=>'frinconc@ufpso.edu.co','password'=>'1234'));
        //find(array('email'=>'frinconc@ufpso.edu.co','password'=>'1234'))
    }
    

    function extraerRegistro()
    {
        return $this->resultado;
    }
}
/*class conexion
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
}*/
?>