<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 14:51
 */
?>

<h3 class="center">Update old user</h3>
<form method="post" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="inputEmail3">First name</label>
        <div class="col-sm-10">
            <input class="form-control" id="inputEmail3" type="text" placeholder="First name" name="firstName" value="<?= \classes\helpers\ArrayHelper::getValue($newModel, 'firstName') ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="inputPassword3">Last name</label>
        <div class="col-sm-10">
            <input class="form-control" id="inputPassword3" type="text" placeholder="Last name" name="lastName" value="<?= \classes\helpers\ArrayHelper::getValue($newModel, 'lastName') ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="inputBirthday3">Birthday</label>
        <div class="col-sm-10">
            <input class="form-control" id="inputBirthday3" type="text" placeholder="Birthday" name="birthday" value="<?= \classes\helpers\ArrayHelper::getValue($newModel, 'birthday') ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button class="btn btn-success" type="submit" name="submit">Update</button>
        </div>
    </div>
</form>
