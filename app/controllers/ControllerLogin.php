<?php
require_once 'app/config/Constante.php';
require_once 'app/controllers/Controller.php';
//require_once PATH . "/controllers/UtilsController.php";

class ControllerLogin extends Controller
{
	public function pageLogin()
	{
		//UtilsController::validarRequisicao();

		// Array que é percorrido no layouts/header.php da view.
		$array_css = '';

		// Array que é percorrido no layouts/footer.php da view.
		$array_js = ['utils.js', 'login.js'];
		// $array_js = '';

		// Informação que é printada no layouts/header.php da view.
		$title = 'Login | Gerenciador de Clientes';

		// View que é para ser renderizada.
		$view = 'login';

		// Verifica se é para mostrar o header na página.
		$header = false;

		$this->setCss($array_css);
		$this->setJs($array_js);
		$this->render($view, $title, $header);
	}

	/**
	 * Valida o login do contador.
	 */
	public function validarLogin()
	{
		require_once 'app/models/classes/Login.class.php';

		$Login = new Login;

		$nome = $_POST['nome'];
		$senha = $_POST['senha'];

		$return_login = $Login->validarLogin($nome, $senha);

		unset($Login);

		// print_r($return_login);

		if (!empty($return_login)) {
			$_SESSION['sessão']['usuario']    = $return_login['usuario'];

			echo json_encode(array("status" => "sucesso", "mensagem" => "Login realizado com sucesso."));
		} else {
			echo json_encode(array("status" => "erro", "mensagem" => "Usuário ou senha incorreto."));
		}
	}

	/**
	 * Realiza o logout do usuário que está logado.
	 */
	public function logout()
	{
		unset($_SESSION['sessão']);
		header('location: /project/login');
	}

	// /**
	//  * Solicita uma nova senha e envia a nova senha por e-mail.
	//  */
	// public function esqueciMinhaSenha()
	// {
	// 	require_once PATH . "/models/classes/Utils.class.php";
	// 	require_once PATH . "/models/classes/Contador.class.php";

	// 	$Contador = new Contador;

	// 	$email = $_POST['email'];
	// 	$senha = Utils::stringAleatoria();

	// 	$return = $Contador->atualizarSenha($email, $senha);

	// 	unset($Contador);

	// 	if ($return) {
	// 		// Senha atualizada com sucesso.
	// 		require_once PATH . "/models/classes/Email.class.php";

	// 		$EmailClass = new Email("68.243.096/0001-52");
	// 		$conteudo  = "Sua senha nova é: {$senha}";
	// 		$returnEmail = $EmailClass->dispararEmail('Sua senha nova', $email, 'contato@supersoft.com.br', 'Esc. Virtual - Contato', $conteudo);
	// 		unset($EmailClass);

	// 		if ($returnEmail) {
	// 			echo json_encode(array("status" => "sucesso", "mensagem" => "Senha nova enviado em seu e-mail"));
	// 		} else {
	// 			echo json_encode(array("status" => "erro", "mensagem" => "Oops, ocorreu algum erro ao enviar o e-mail. Tente novamente mais tarde."));
	// 		}
	// 	} else {
	// 		echo json_encode(array("status" => "erro", "mensagem" => "Oops, ocorreu algum erro ao alterar a senha. Tente novamente mais tarde."));
	// 	}
	// }
}
