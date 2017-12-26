<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 14:51
 */

use classes\controllers\Controller;

/* @var $this Controller */

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Test</title>
	<link href="/dev/css/style.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="/dev/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <?= $this->renderPartial('partials/header') ?>
	<div class="row">
		<?= $content ?>
	</div>
</div>
</body>
</html>

