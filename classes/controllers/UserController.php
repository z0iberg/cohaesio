<?php

namespace classes\controllers;
use classes\helpers\ArrayHelper;
use classes\models\UsersModel;

/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 13:11
 */
class UserController extends Controller
{

	public function actionIndex($id = null)
	{
		echo 'index action';
	}

	public function actionCreate($id = null)
	{
		$newModel = new UsersModel();
		if($this->isPost()) {
			$newModel->load($this->getPost());
			if($id)
				$parent = UsersModel::getById($id);
			else
				$parent = [];

			$newModel->parent_id = ArrayHelper::getValue($parent, 'id');
			$newModel->level = ArrayHelper::getValue($parent, 'level', 0) + 1;

			if($newModel->level < 6 && $newModel->save())
				header('location: /');
		}

		return $this->render('create', compact('newModel'));
	}

	public function actionUpdate($id)
	{
		$newModel = UsersModel::getById($id);
		if($this->isPost()) {
			$newModel->load($this->getPost());

			var_dump($newModel->save());

			if($newModel->save())
				header('location: /');
		}

		return $this->render('update', compact('newModel'));
	}

	public function actionDelete($id)
	{
		$model = UsersModel::getById($id);
		if($model->delete())
			header('location: /');
	}

}