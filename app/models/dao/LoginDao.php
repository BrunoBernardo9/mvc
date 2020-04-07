<?php

require_once "app/config/Conexao_bd.php";

class LoginDao	 
{
    public function __construct()
    {
      $this->pdo = Conexao_bd::getConnection();
    }

    public function __destruct()
    {
      unset($this->pdo);
    }

    /**
    * Valida a autenticação do contador.
    * @param $nome - Nome do usuário.
    * @param $senha - Senha do usuárop.
    * @return Integer 
    */
    public function validarLoginDao($nome, $senha)
    {
      $stmt = $this->pdo->prepare("SELECT * FROM login WHERE usuario = :nome AND senha = :senha");
      $stmt->bindValue(':nome', $nome);
      $stmt->bindValue(':senha', $senha);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }     
}
?>
