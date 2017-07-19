<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 13:16
 */

namespace classes\helpers;


class ArrayHelper
{

	/**
	 * @param array $arr
	 * @param string $key
	 * @param null $defaultValue
	 * @return mixed
	 */
	public static function getValue($arr, $key, $defaultValue = null)
	{
		if(is_object($arr) && property_exists($arr, $key))
			return $arr->$key;
		if(is_array($arr) && array_key_exists($key, $arr))
			return $arr[$key];
		else
			return $defaultValue;
	}

}