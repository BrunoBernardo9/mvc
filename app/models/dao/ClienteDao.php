<?php

require_once "app/config/Conexao_bd.php";

class ClienteDao	 
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
  * Adiciona Cliente e retorna o ID do cliente para cadastras os endereços na tabela endereco
  * @return Array 
  */
  public function adicionarDao($nome, $cpf, $rg, $dataNasc, $telefone)
  {
    $stmt = $this->pdo->prepare("INSERT INTO cliente (nome, cpf, rg, dataNasc, telefone) VALUES(:nome, :cpf, :rg, :dataNasc, :telefone)");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':cpf', $cpf);
    $stmt->bindValue(':rg', $rg);
    $stmt->bindValue(':dataNasc', $dataNasc);
    $stmt->bindValue(':telefone', $telefone);
    $stmt->execute();
    return $this->pdo->lastInsertId();
  }

  /**
  * Edita dados do cliente na tabela cliente
  * @return Array 
  */
  public function editarDao($id, $nome, $cpf, $rg, $dataNasc, $telefone)
  {
    $stmt = $this->pdo->prepare("UPDATE cliente SET nome = :nome, cpf = :cpf, rg = :rg, dataNasc =:dataNasc, telefone = :telefone WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':cpf', $cpf);
    $stmt->bindValue(':rg', $rg);
    $stmt->bindValue(':dataNasc', $dataNasc);
    $stmt->bindValue(':telefone', $telefone);
    return $stmt->execute();
  }

  /**
  * Edita endereço exisstente
  * @return Array 
  */
  public function editarEnderecoExistenteDao($id, $idEndereco, $endereco)
  {
    $stmt = $this->pdo->prepare("UPDATE endereco SET endereco = :endereco WHERE idCliente = :idCliente AND id = :idEndereco");
    $stmt->bindValue(':idCliente', $id);
    $stmt->bindValue(':idEndereco', $idEndereco);
    $stmt->bindValue(':endereco', $endereco);
    return $stmt->execute();
  }

  /**
  * Adiciona endereço novo para o cliente
  * @return Array 
  */
  public function editarEnderecoNovoDao($id, $endNovo)
  {
    $stmt = $this->pdo->prepare("INSERT INTO endereco (idCliente, endereco) VALUES(:idCliente, :endereco)");
    $stmt->bindValue(':idCliente', $id);
    $stmt->bindValue(':endereco', $endNovo);
    return $stmt->execute();
  }

  /**
  * Adiciona endereço para o cliente
  * @return Array 
  */
  public function adicionarEnderecoDao($idCliente, $end)
  {
    $stmt = $this->pdo->prepare("INSERT INTO endereco (idCliente, endereco) VALUES(:idCliente, :endereco)");
    $stmt->bindValue(':idCliente', $idCliente);
    $stmt->bindValue(':endereco', $end);
    return $stmt->execute();
  }

  /**
  * Busca Clientes cadastrados para listar na página
  * @return Array 
  */
  public function buscarClientesDao()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM cliente");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

    /**
  * Busca endereços  dos Clientes cadastrados para listar na página
  * @return Array 
  */
  public function buscarEnderecosClientesDao()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM endereco");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  

   /**
  * Excluir o registro de um cliente. 
  * @return Array 
  */
  public function excluir($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM endereco WHERE idCliente = :id");
    $stmt = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id");
    
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }  

   /**
  * Excluir o endereço de um cliente. 
  * @return Array 
  */
  public function excluirEndereco($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM endereco WHERE id = :id");
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }  
}
?>
