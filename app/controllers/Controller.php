<?php
class Controller
{
    protected $array_css; // Array de CSS que a página vai receber.
	protected $array_js;  // Array de JS que a página vai receber.

	/**
	* Gets e setters
	*/
	public function setCss($array_css)
    {
    	$this->array_css = $array_css;
    }

    public function setJs($array_js)
    {
    	$this->array_js = $array_js;
    }

    public function getCss()
    {
    	return $this->array_css;
    }

    public function getJs()
    { 
    	return $this->array_js;
    }

    /**
     * Renderiza uma view na tela, quando é requisição.
     * @param $view   - Nome da view a ser renderizada.
     * @param $title  - Titulo da página, que é visivel na página.
     * @param $header - Verifica se é para mostrar o header na página.
     * @param $param  - Caso queira mandar algum valor para a view mostrar.
     */
    public function render($view, $title, $header, $param = '')
    {
    	$css = $this->getCss(); // Variavel fica visivel no header.
        $js  = $this->getJs();  // Variavel fica visivel no footer.

        require_once 'app/views/layouts/head.php';
        if($header){
          require_once 'app/views/layouts/header.php';
        }
        require_once 'app/views/' . $view . '.php';        
        require_once 'app/views/layouts/footer.php';
    }
}
