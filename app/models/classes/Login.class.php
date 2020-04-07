<?php

require_once "app/models/dao/LoginDao.php";

class Login 
{
	private $LoginDao;

	/**
	* Abre conexão com a DAO.
	*/
	private function abreConexaoBD()
	{
		$this->LoginDao = new LoginDao;
	}

	/**
	* Fecha a conexão com a DAO.
	*/
	private function fechaConexaoBD()
	{
		unset($this->LoginDao);
	}

	/**
	 * Valida o login. 
	 * @param $nome - Nome do usuário.
	 * @param $Senha - Senha do usuário.
	 * @return Array 
	 */
	public function validarLogin($nome, $senha)
	{
		// Abre conexão com a DAO.
		$this->abreConexaoBD();

        $return_validacao = $this->LoginDao->validarLoginDao($nome, $senha);
		
		// Fecha conexão com a DAO.
		$this->fechaConexaoBD();

        return $return_validacao;
	}
}

?>
