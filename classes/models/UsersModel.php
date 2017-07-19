<?php

namespace classes\models;

/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 18.07.17
 * Time: 23:16
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property integer $birthday
 * @property integer $level
 * @property integer $parent_id
 * @property array children
 */
class UsersModel extends Model
{

	CONST MAX_LEVEL = 5;

	public static function getTableName()
	{
		return 'user';
	}

	public static function findAll()
	{
		$sql = sprintf("SELECT `%s`.* FROM `%s` WHERE `level` = 1", self::getTableName(), self::getTableName());
		$result = self::prepare($sql);
		if($result->execute())
			return self::ifSqlExecute($result);
		else
			var_dump($result->errorInfo());
	}

	public static function getById($id)
	{
		$sql = sprintf("SELECT * FROM `%s` WHERE `id` = %s", self::getTableName(), $id);
		$result = self::prepare($sql);
		if($result->execute())
			return self::fetchData($result->fetch(\PDO::FETCH_ASSOC));
		else
			return self::fetchData([]);
	}

	public function getChildren()
	{
		if($this->level <= self::MAX_LEVEL) {
			$sql = sprintf("SELECT * FROM `%s` WHERE `parent_id` = %s", self::getTableName(), $this->id);
			$result = self::prepare($sql);
			if ($result->execute())
				return self::ifSqlExecute($result);
			else
				return false;
		} else return false;
	}

	public function getParentId()
	{
		if(is_null($this->parent_id))
			return 'NULL';
		else
			return $this->parent_id;
	}

	public function create()
	{
		$sql = sprintf("INSERT INTO `%s`(`firstName`, `lastName`, `birthday`, `level`, `parent_id`) VALUES ('%s','%s','%s',%s,%s)",
			self::getTableName(), $this->firstName, $this->lastName, $this->birthday, $this->level, $this->getParentId());
		$result = self::prepare($sql);
		return $result->execute();
	}

	public function update()
	{
		$sql = sprintf("UPDATE `%s` SET `firstName` = '%s', `lastName` = '%s', `birthday` = '%s', `level` = %s, `parent_id` = %s WHERE `id` = %s",
			self::getTableName(), $this->firstName, $this->lastName, $this->birthday, $this->level, $this->getParentId(), $this->id);
		$result = self::prepare($sql);
		return $result->execute();
	}

	public function delete()
	{
		$sql = sprintf("DELETE FROM `%s` WHERE `id` = %s", self::getTableName(), $this->id);
		$result = self::prepare($sql);
		return $result->execute();
	}

	/**
	 * @param UsersModel[] $users
	 * @return string
	 */
	public static function renderUserTree($users)
	{
		$tree = '';
		foreach ($users as $user) {
			$button = '<div class="pull-left user-button">
				<a href="/user/create/' . $user->id . '"><i class="fa fa-plus-square"></i></a>
				<a href="/user/delete/' . $user->id . '"><i class="fa fa-minus-square"></i></a>
				<a href="/user/update/' . $user->id . '"><i class="fa fa-pencil-square"></i></a>
			</div>';
			$tree .= '<li class="col-md-10">' . $user->firstName . ' ' . $user->lastName . $button;
			$children = $user->getChildren();
			if($children && count($children) > 0)
			{
				$tree .= '<ul>' . self::renderUserTree($children) . '</ul>';
			}
			$tree .= '</li>';
		}
		return $tree;
	}

}