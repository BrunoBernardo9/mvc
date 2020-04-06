<?php 
/**
* Classe para ficar funções que é comum entre todos os controllers.
*/

class UtilsController {

    /**
	* Verifica se o atual usuário ta logado, caso não esteja direciona ele para realizar o login.
	*/
    public static function validarRequisicao()
    {
		if($_SERVER['REQUEST_URI'] == '/project/login'){
			if(!empty($_SESSION['sessão']['usuario'])){
				// Caso esteja na página de login e já esteja logado, manda para a home.
				header('location: /project/listar');
			}
		}
		else{
			if(empty($_SESSION['sessão']['usuario'])){
				// Caso a sessão expirou, manda para a página de login.
				header('location: /project/login');
			}
		}
    }
} 