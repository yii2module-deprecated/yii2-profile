<?php
/**
 * @var $this yii\web\View
 */

$this->context->layout = '/print';
?>

<?= $this->context->renderPartial('_qr', compact('link')); ?>
