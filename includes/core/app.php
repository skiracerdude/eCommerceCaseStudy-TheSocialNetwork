<?php


class App
{

	protected $controller = 'index';

	protected $method = 'index';

	protected $params = [];

	public function __construct()
	{

		$url = $this->parseUrl();
		if(file_exists('../includes/controllers/' . $url[0] . '.php'))
		{
			
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../includes/controllers/'. $this->controller .'.php';

		$this->controller = new $this->controller;

		if(isset($url[1]))
		{
			if(method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);

	}


	public function parseUrl(){
		if(isset($_GET['url'])){
			 $url1 = trim($_GET['url'], 'public/');
			return $url = explode('/', filter_var(rtrim($url1, '/'), FILTER_SANITIZE_URL));
		}
	}
}