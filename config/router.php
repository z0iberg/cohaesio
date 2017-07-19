<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 13:56
 */

use classes\helpers\RouterHelper;

RouterHelper::route('/user/(?P<action>\w+)/(?P<id>\d+)?', [
	RouterHelper::$controllerVariable => 'User',
]);
RouterHelper::route('/(?P<controller>\w+)/(?P<action>\w+)/(?P<id>\d+)?');

RouterHelper::route('/');