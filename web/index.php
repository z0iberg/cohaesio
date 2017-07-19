<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 18.07.17
 * Time: 21:21
 */
use classes\helpers\RouterHelper;
use classes\helpers\ArrayHelper;
use classes\models\Model;

error_reporting(E_ALL);
ini_set("display_errors","On");

require_once(__DIR__ . '/../config/autoload.php');

require_once(__DIR__ . '/../config/router.php');

Model::setConfig(require_once(__DIR__ . '/../config/db.php'));

RouterHelper::execute(ArrayHelper::getValue($_SERVER, 'REQUEST_URI', '/'));

