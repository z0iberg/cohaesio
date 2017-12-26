<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 13:18
 */

namespace classes\controllers;


use classes\helpers\ArrayHelper;
use classes\helpers\RouterHelper;

class Controller
{

	public $controller;
	public $action;

	public $viewPath = __DIR__ . '/../../views/';
	public $layoutPath = __DIR__ . '/../../views/layout/';
	public $layout = 'main';

    /**
     * Controller constructor.
     * @param $urlParams
     */
	public function __construct($urlParams)
	{

		$this->controller = ArrayHelper::getValue($urlParams, RouterHelper::$controllerVariable);
		$this->action = ArrayHelper::getValue($urlParams, RouterHelper::$actionVariable);

	}

	/**
	 * @param string $view
	 * @param array $variables
	 * @return string
	 */
	public function render($view, $variables = [])
	{
        $content = $this->prepareRender($this->viewPath . strtolower($this->controller) . '/' . $view, $variables);

		return $this->layout(compact('content'));
	}


	public function renderPartial($view, $variables = [])
    {
        return $this->prepareRender($this->viewPath . '/' . $view, $variables);
    }

    /**
     * @param $view
     * @param array $variables
     * @return string
     */
	public function prepareRender($view, $variables = [])
    {
        extract($variables);

        ob_start();
        include_once($view . '.php');
        $content =  ob_get_contents();
        ob_end_clean();

        return $content;
    }

	/**
	 * @param array $variables
	 * @return string
	 */
	public function layout($variables = [])
	{
		extract($variables);

		ob_start();
		include_once($this->layoutPath . $this->layout . '.php');
		$content =  ob_get_contents();
		ob_end_clean();

		return $content;
	}

	public function isPost()
	{
		if(ArrayHelper::getValue($_SERVER, 'REQUEST_METHOD') == 'POST')
			return true;
		else
			return false;
	}

	public function getPost()
	{
		if($this->isPost())
			return $_POST;
		else
			return [];
	}

}