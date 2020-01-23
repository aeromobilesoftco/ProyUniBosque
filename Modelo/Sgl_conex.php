<?php

// Llamo a los parametros de la clase

require_once 'SglParamDB.php';

class Sgl_conex {

private static $_instancia;
private $datacon;

public static function Getinstance()
{
    if(!self::$_instancia)
    {
        self::$_instancia= new self();
    }
    
    return self::$_instancia;
}

private function __construct() {

    try{
        $this->datacon = new PDO(DB_MOTOR.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        $this->datacon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->datacon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->datacon->setAttribute(PDO::ATTR_PERSISTENT,true);
        $this->datacon->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
    }
    catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos' .E_USER_ERROR. PHP_EOL;
         echo "";
         echo "Detalle: ".$e->getMessage();
         exit;        
    }
    
}

public function abreconex()
{
    return $this->datacon;
}

public function cierraconex()
{
    return $this->datacon=null;
}

public function __clone() {
    trigger_error('No puede clonar esta clase');
}

public function __wakeup() {
    trigger_error("No puede deserializar una instancia de ". get_class($this) ." class.", E_USER_ERROR );
}
    
}

?>