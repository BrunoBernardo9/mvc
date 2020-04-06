<?php
require_once 'app/config/Constante.php';
require_once 'app/controllers/Controller.php';
require_once 'app/controllers/UtilsController.php';

class ControllerCliente extends Controller
{
	public function pageListar()
	{
		UtilsController::validarRequisicao();

		// Array que é percorrido no layouts/header.php da view.
		$array_css = '';

		// Array que é percorrido no layouts/footer.php da view.
		$array_js = ['listar.js',  'utils.js'];

		// Informação que é printada no layouts/header.php da view.
		$title = 'Listar | Gerenciador de Clientes';

		// View que é para ser renderizada.
		$view = 'listar';

		// Verifica se é para mostrar o header na página.
		$header = true;

		// Busca todos os clientes cadastrados para listar
		require_once "app/models/classes/Cliente.class.php";

		$Cliente = new Cliente;
		$param['listaClientes'] = $Cliente->buscarClientes();
		$param['listaEnderecos'] = $Cliente->buscarEnderecosClientes();
		unset($Cliente);

		$this->setCss($array_css);
		$this->setJs($array_js);
		$this->render($view, $title, $header, $param);
	}

	// /**
	// * Página para adicionar Clientes.
	// */
	public function pageAdicionar()
	{
		UtilsController::validarRequisicao();

		// Array que é percorrido no layouts/header.php da view.
		$array_css = '';

		// Array que é percorrido no layouts/footer.php da view.
		$array_js = ['adicionar.js', 'utils.js'];

		// Informação que é printada no layouts/header.php da view.
		$title = 'Adicionar | Gerenciador de Clientes';

		// View que é para ser renderizada.
		$view = 'adicionar';

		// Verifica se é para mostrar o header na página.
		$header = true;

		$this->setCss($array_css);
		$this->setJs($array_js);
		$this->render($view, $title, $header);
	}


	/**
	* Adiciona Cliente.
 	*/
	 public function adicionar()
	 {
		 require_once "app/models/classes/Cliente.class.php";
 
		 $Cliente = new Cliente;
 
		 $nome 		= $_POST['nome']; 
		 $cpf 		   = $_POST['cpf']; 
		 $rg 		   = $_POST['rg']; 
		 $dataNasc = $_POST['dataNasc']; 
		 $telefone   = $_POST['telefone']; 
		 $endereco = isset($_POST['enderecos']) ? $_POST['enderecos']: isset($_POST['enderecos']); 
				
		 $adicionou = $Cliente->adicionar($nome, $cpf, $rg, $dataNasc, $telefone, $endereco);
 
		 unset($Cliente);

		 if (!empty($adicionou)) {
		 	echo json_encode(array("status" => "sucesso", "mensagem" => "Cliente adicionado com sucesso"));
		 } else {
		 	echo json_encode(array("status" => "erro", "mensagem" => "Falha ao adicionar cliente"));
		 }
	 }

	 /**
	* Edita dados do Cliente.
 	*/
	 public function editar()
	 {
		 require_once "app/models/classes/Cliente.class.php";
 
		 $Cliente = new Cliente;
 
		 $id            = $_POST['id'];
		 $nome 		= $_POST['nome']; 
		 $cpf 		   = $_POST['cpf']; 
		 $rg 		   = $_POST['rg']; 
		 $dataNasc = $_POST['dataNasc']; 
		 $telefone   = $_POST['telefone']; 
		 $enderecosEdita = isset($_POST['enderecosEdita']) ? $_POST['enderecosEdita']: isset($_POST['enderecosEdita']); 
		 $enderecoNovo = isset($_POST['enderecos']) ? $_POST['enderecos']: isset($_POST['enderecos']); 
		
		//  Atualiza os dados que já existiam
		 $atualizou = $Cliente->editar($id, $nome, $cpf, $rg, $dataNasc, $telefone, $enderecosEdita, $enderecoNovo);
 
		//  print_r($atualizou);
		 unset($Cliente);		 

		 if ($atualizou) {
		 	echo json_encode(array("status" => "sucesso", "mensagem" => "Dados atualizados com sucesso"));
		 } else {
		 	echo json_encode(array("status" => "erro", "mensagem" => "Falha ao atualizar dados"));
		 }
	 }
	 
	/**
	* Excluir Cliente.
 	*/
	 public function excluir()
	 {
		 require_once "app/models/classes/Cliente.class.php";
 
		 $Cliente = new Cliente;
 
		 $id = $_POST['id']; 

		 $excluiu = $Cliente->excluir($id);
 
		 unset($Cliente);

		 if (!empty($excluiu)) {
		 	echo json_encode(array("status" => "sucesso", "mensagem" => "Cliente excluído com sucesso"));
		 } else {
		 	echo json_encode(array("status" => "erro", "mensagem" => "Falha ao excluir cliente"));
		 }
	 }

	/**
	* Excluir endereço selecionado.
 	*/
	 public function excluirEndereco()
	 {
		 require_once "app/models/classes/Cliente.class.php";
 
		 $Cliente = new Cliente;
 
		 $id = $_POST['id']; 

		 $excluiu = $Cliente->excluirEndereco($id);
 
		 unset($Cliente);

		 if (!empty($excluiu)) {
		 	echo json_encode(array("status" => "sucesso", "mensagem" => "Endereço excluído com sucesso"));
		 } else {
		 	echo json_encode(array("status" => "erro", "mensagem" => "Falha ao excluir endereço"));
		 }
	 }
	 

}
