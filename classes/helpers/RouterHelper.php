<?php

namespace classes\helpers;

/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 0:14
 */

class RouterHelper {

	private static $routes = array();

	private static $controllersPath = 'classes\controllers\\';

	private static $controllersSuffix = 'Controller';

	static $controllerVariable = 'controller';
	static $actionVariable = 'action';

	static $defaultControllerVariable = 'Index';
	static $defaultActionVariable = 'Index';

	private static function getDefaultParams(){
		return [
			self::$controllerVariable => self::$defaultControllerVariable,
			self::$actionVariable => self::$defaultActionVariable
		];
	}

	/**
	 * @param $pattern
	 * @param array $params
	 */
	public static function route($pattern, $params = []) {
		$pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
		self::$routes[$pattern] = array_merge(self::getDefaultParams(), $params);
	}

	/**
	 * @param $url
	 * @return mixed
	 */
	public static function execute($url) {
		foreach (self::$routes as $pattern => $urlParams) {
			if (preg_match($pattern, $url, $routeParams)) {
				array_shift($routeParams);
				if(array_key_exists(self::$actionVariable, $routeParams))
					$urlParams[self::$actionVariable] = ucfirst(ArrayHelper::getValue($routeParams, self::$actionVariable));
				if(array_key_exists(self::$controllerVariable, $routeParams))
					$urlParams[self::$controllerVariable] = ucfirst(ArrayHelper::getValue($routeParams, self::$controllerVariable));
				$className = self::$controllersPath . ArrayHelper::getValue($urlParams, self::$controllerVariable) . self::$controllersSuffix;
//				try {
					$class = new $className($urlParams);
					echo call_user_func_array([$class, 'action' . ArrayHelper::getValue($urlParams, self::$actionVariable)], self::getUrlParams($routeParams));
//				} catch ( \Error $e) {
//					die('Something wrong. Too be continue.');
//				}
			}
		}
	}

	public static function getUrlParams($urlParams)
	{
		foreach ($urlParams as $key => $urlParam) {
			if(is_int($key) || $key == self::$controllerVariable || $key == self::$actionVariable)
				unset($urlParams[$key]);
		}
		return $urlParams;
	}

	//TODO: coming soon
	public static function generateUrl($url, $params)
	{

	}
}