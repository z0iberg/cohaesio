<?php

namespace classes\controllers;

use classes\models\UsersModel;

/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 13:11
 */
class IndexController extends Controller
{

	public function actionIndex()
	{
		$users = UsersModel::findAll();

		if(!$users)
			$users = [];

		return $this->render('index', compact('users'));
	}

}