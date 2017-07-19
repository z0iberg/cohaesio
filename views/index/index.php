<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 17:07
 */
?>

<h3 class="center">User list</h3>
<a class="btn btn-success" style="margin-left: 25px" href="/user/create/">Create new user</a>
<ul class="userList">
    <?= \classes\models\UsersModel::renderUserTree($users) ?>
</ul>
