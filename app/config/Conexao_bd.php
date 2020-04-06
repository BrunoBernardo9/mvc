<?php

class Conexao_bd
{
    private static $connection;

    // /**
    // * Função para abrir a conexão com o BD
    // */
    public static function getConnection() 
    {
        $connection = null;
        if(!isset($connection)){
            $connection = new PDO("mysql:host=localhost;dbname=project;", "root", "");

            // define para que o PDO lance exceções caso ocorra erros.
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $connection;
    }

    
}

?>
