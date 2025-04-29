<?php


class database{
    //creo la variable conexion
    private  $conexion = null;

    public function __construct(){
        $config = parse_ini_file('config.ini', true);

        $host = $config['database']['host'];
        $user = $config['database']['user'];
        $password = $config['database']['password'];
        $database = $config['database']['database'];

        $this->conexion = new mysqli($host, $user, $password, $database);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

    }

    /**
     * @return mysqli
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    public function close() {
        if ($this->conexion !== null) {
            $this->conexion->close();
        }
    }
}