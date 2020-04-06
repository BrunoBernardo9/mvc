<?php

class Route 
{
	private $route;        // Variavel que receber todas as rotas possiveis do sistema.
	private $https = true; // Identifica se a rota deve transformar todas requisições em HTTPS.

	

	public function iniciarAplicacao()
	{
		$this->iniciarRotas();
		$url = $this->getUrl();
		$this->run($url);
	}
	/**
	* Inicia todas as rotas possiveis do sistema.
	*/
	protected function iniciarRotas()
	{	
		$array_routes['/project/login'] = array( 
			"controller" => "ControllerLogin", 
			"action"      => "pageLogin"        
		);

		$array_routes['/project/logout'] = array( 
			"controller" => "ControllerLogin", 
			"action"     => "logout"
		);

		$array_routes['/project/listar'] = array( 
			"controller" => "ControllerCliente", 
			"action"      => "pageListar"        
		);

		$array_routes['/project/adicionar'] = array( 
			"controller" => "ControllerCliente", 
			"action"      => "pageAdicionar"        
		);

		// -------------------------------------------------------------------
		// Rotas de API (Para requisições AJAX)

		$array_routes['/project/validarLogin'] = array( 
			"controller" => "ControllerLogin", 
			"action"      => "validarLogin"
		); 

		$array_routes['/project/adicionarCliente'] = array( 
			"controller" => "ControllerCliente", 
			"action"      => "adicionar"
		); 

		$array_routes['/project/editarCliente'] = array( 
			"controller" => "ControllerCliente", 
			"action"      => "editar"
		); 

		$array_routes['/project/excluirCliente'] = array( 
			"controller" => "ControllerCliente", 
			"action"      => "excluir"
		); 

		$array_routes['/project/excluirEndereco'] = array( 
			"controller" => "ControllerCliente", 
			"action"      => "excluirEndereco"
		); 
	
		$this->route = $array_routes;

	}


	/**
	* Direciona o usuário para o controller referente a sua rota
	* @param $url - atual URL do usuário.
	*/
	protected function run($url)
	{	
		if(!empty($this->route[$url])){
			require_once "controllers/".$this->route[$url]['controller'].".php";

			$Controller = new $this->route[$url]['controller'];
			$action     = $this->route[$url]['action'];
			$Controller->$action();
		}
		else{
			echo 'erro';
		}
	}

	/**
	* Identifica qual é a atual URL do usuário.
	* @return String com a atual URL do usuário.
	*/
	protected function getUrl()
	{
		if($this->https){
			if (isset($_SERVER['HTTPS'])) {
				return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			}
			else{
				header('location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			}
		}else{
			if (isset($_SERVER['HTTPS'])){
				header('location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			}
			else{
				return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			}
		}
	}
}
