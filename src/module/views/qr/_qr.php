<?php

/**
 * @var $link string
 */

use yii2lab\qr\domain\widgets\Qr;
use yii\helpers\Html;
use yii2module\article\widgets\PostView;

?>

<?= Qr::widget(['text' => $link, 'type' => Qr::TYPE_IMG]) ?>

<h4>
	<?= Yii::t('profile/qr', 'link_to_convertation') ?>
</h4>

<p>
    <?= Html::a($link, $link) ?>
</p>

<?= PostView::widget(['name' => 'use-qr']) ?>
