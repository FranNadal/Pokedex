<?php

class database{

private $conexion=null;

                public function __construct(){

                    $config = parse_ini_file('config.ini', true); // El segundo parámetro 'true' hace que se devuelvan las secciones
                    $db_host = $config['database']['host'];
                    $db_user = $config['database']['user'];
                    $db_password = $config['database']['password'];
                    $db_name = $config['database']['database'];


                    $this->conexion = new mysqli($db_host, $db_user, $db_password, $db_name);

                    if ($this->conexion->connect_error) {
                        die("Error de conexión: " . $this->conexion->connect_error);
                    }
                }

                public function getConexion(){
                    return $this->conexion;
                }

                public function closeConexion()
                {
                    if($this->conexion!==null){
                        $this->conexion->close();
                    }
                }

}
?>
