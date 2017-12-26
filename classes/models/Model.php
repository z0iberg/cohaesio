<?php

namespace classes\models;
use classes\helpers\ArrayHelper;
use classes\helpers\DB;

/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 18.07.17
 * Time: 23:25
 *
 * @property \PDO $connection
 * @property boolean $isNewRecord
 * @method  $getTableName()
 */
class Model
{
	private static $connection;
	private static $config;

	public $table;
	public $isNewRecord = true;


	public static function getTableName()
	{
		return 'user';
	}

	public static function connect()
	{
		$db = new \PDO(ArrayHelper::getValue(self::$config, DB::PROVIDER) . ':host=' . ArrayHelper::getValue(self::$config, DB::HOST) . ';dbname=' . ArrayHelper::getValue(self::$config, DB::DATABASE), ArrayHelper::getValue(self::$config, DB::USERNAME), ArrayHelper::getValue(self::$config, DB::PASSWORD));
		$db->query("SET NAMES utf8");
		self::setConnection($db);
	}

	public static function setConfig($config)
	{
		self::$config = $config;
		self::connect();
	}

	public static function setConnection($connection)
	{
		self::$connection = $connection;
	}

	/**
	 * @return \PDO
	 */
	public static function getConnection()
	{
		return self::$connection;
	}

	/**
	 * @param \PDOStatement $result
	 * @return array|bool
	 */
	public static function ifSqlExecute($result)
	{
		if($result->rowCount() == 0)
			return false;
		if ($result->rowCount() >= 1)
			return self::fetchArrayData($result);
	}

	/**
	 * @param array $data
	 */
	public function load($data)
	{
		foreach ($data as $key => $datum) {
			$this->{ $key } = $datum;
		}
	}

	/**
	 * @param \PDOStatement $result
	 * @return array
	 */
	public static function fetchArrayData($result)
	{
		$return = [];
		$key = 0;
		while ($item = $result->fetch(\PDO::FETCH_ASSOC)){
			$return[$key] = self::fetchData($item);
			$key++;
		}
		return $return;
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	public static function fetchData($data)
	{
		$modelClass = get_called_class();
		$model = new $modelClass();
		$model->isNewRecord = false;
		foreach ($data as $column => $value)
			$model->{ $column } = $value;
		return $model;
	}

	public function save()
	{
		if($this->isNewRecord)
			return $this->create();
		else
			return $this->update();
	}

	public static function prepare($sql)
	{
		return self::getConnection()->prepare($sql);
	}

	public function __construct()
	{

	}

}