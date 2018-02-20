<?php
/**
 * @var $this yii\web\View
 */
use yii\helpers\Html;

?>

<?= $this->context->renderPartial('..\_navigation'); ?>

<div class="row">
	<div class="col-lg-12">
		
		<?= $this->context->renderPartial('_qr', compact('link')); ?>

        <p>
			<?= Html::a(t('action', 'save'), [null, 'action' => 'download'], ['class' => 'btn btn-default']) ?>
			<?= Html::a(t('action', 'print'), [null, 'action' => 'print'], ['class' => 'btn btn-default', 'target'=> '_blank']) ?>
        </p>
        
	</div>
</div>
