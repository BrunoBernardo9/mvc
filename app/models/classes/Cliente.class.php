<?php

require_once "app/models/dao/ClienteDao.php";

class Cliente 
{
	private $ClienteDao;

	/**
	* Abre conexão com a DAO.
	*/
	private function abreConexaoBD()
	{
		$this->ClienteDao = new ClienteDao;
	}

	/**
	* Fecha a conexão com a DAO.
	*/
	private function fechaConexaoBD()
	{
		unset($this->ClienteDao);
	}

	/**
	 * Adiciona Cliente
	 * @return Array 
	 */
	public function adicionar($nome, $cpf, $rg, $dataNasc, $telefone, $endereco)
	{
		// Abre conexão com a DAO.
		$this->abreConexaoBD();

		// Adiciona o cliente e retorna o idCliente
		$idCliente = $this->ClienteDao->adicionarDao($nome, $cpf, $rg, $dataNasc, $telefone);

		if(!empty($idCliente)){
			if(!empty($endereco)){
				foreach($endereco as $end){
					$adiciona = $this->ClienteDao->adicionarEnderecoDao($idCliente, $end);
				}
			} else {
				$adiciona = 1;
			}
		} 
		
		// Fecha conexão com a DAO.
		$this->fechaConexaoBD();

        return $adiciona;
	}

	/**
	 * Edita Cliente
	 * @return Array 
	 */
	public function editar($id, $nome, $cpf, $rg, $dataNasc, $telefone, $enderecosEdita, $enderecoNovo)
	{
		// Abre conexão com a DAO.
		$this->abreConexaoBD();

		// Atualizado dados na tabela cliente
		$atualizouCliente = $this->ClienteDao->editarDao($id, $nome, $cpf, $rg, $dataNasc, $telefone);

		if($atualizouCliente){
			if(!empty($enderecosEdita)){
				foreach($enderecosEdita as $endEdita){
					// print_r($endEdita);
					$dadosArray = explode(" - ", $endEdita);
					$idEndereco = $dadosArray[0];
					$endereco    = $dadosArray[1];

					$this->ClienteDao->editarEnderecoExistenteDao($id, $idEndereco, $endereco);
					$atualizouCliente = 1;
				}
			} else {
				$atualizouCliente = 1;
			}

			if(!empty($enderecoNovo)){
				foreach($enderecoNovo as $endNovo){
					$this->ClienteDao->editarEnderecoNovoDao($id, $endNovo);
					// print_r($endNovo);
					$atualizouCliente = 1;
				}
			} else {
				$atualizouCliente = 1;
			}
		}
		
		// Fecha conexão com a DAO.
		$this->fechaConexaoBD();

        return $atualizouCliente;
	}

	/**
	 * Busca Clientes cadastrados
	 * @return Array 
	 */
	public function buscarClientes()
	{
		// Abre conexão com a DAO.
		$this->abreConexaoBD();

		$dados = $this->ClienteDao->buscarClientesDao();
		
		// Fecha conexão com a DAO.
		$this->fechaConexaoBD();

        return $dados;
	}

	/**
	 * Busca endereços Clientes cadastrados
	 * @return Array 
	 */
	public function buscarEnderecosClientes()
	{
		// Abre conexão com a DAO.
		$this->abreConexaoBD();

		$dados = $this->ClienteDao->buscarEnderecosClientesDao();
		
		// Fecha conexão com a DAO.
		$this->fechaConexaoBD();

        return $dados;
	}

	/**
	 * Exclui registro do cliente
	 * @return Array 
	 */
	public function excluir($id)
	{
		// Abre conexão com a DAO.
		$this->abreConexaoBD();

        $deleta = $this->ClienteDao->excluir($id);
		
		// Fecha conexão com a DAO.
		$this->fechaConexaoBD();

        return $deleta;
	}

/**
	 * Exclui endereço selecionado do cliente
	 * @return Array 
	 */
	public function excluirEndereco($id)
	{
		// Abre conexão com a DAO.
		$this->abreConexaoBD();

        $deleta = $this->ClienteDao->excluirEndereco($id);
		
		// Fecha conexão com a DAO.
		$this->fechaConexaoBD();

        return $deleta;
	}
	

}

?>
