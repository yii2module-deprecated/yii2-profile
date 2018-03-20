<?php

use yii\bootstrap\Tabs;
use yii2lab\extension\menu\helpers\MenuHelper;

?>

<?= Tabs::widget([
	'items' => MenuHelper::gen('yii2module\profile\module\v1\helpers\SettingsMenu'),
]) ?>

<br/>
