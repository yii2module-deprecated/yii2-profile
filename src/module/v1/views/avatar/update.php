<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\Model
 * @var $avatar \yii2module\profile\domain\v2\entities\AvatarEntity
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2module\profile\widget\Avatar;

$this->title = Yii::t('profile/avatar', 'title');

?>

<?= $this->context->renderPartial('..\_navigation'); ?>

<div class="row">
 
    <div class="col-lg-3">
	
	    <?= Avatar::widget(['height' => 256, 'entity' => $avatar]) ?>
     
	    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	    <?= $form->field($model, 'imageFile')->fileInput() ?>

        <div class="form-group">
		    <?= Html::submitButton(Yii::t('action', 'upload'), ['class' => 'btn btn-primary']) ?>
        </div>
	
	    <?php ActiveForm::end() ?>
	
	    <?php if($avatar->name) { ?>
		    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <div class="form-group">
			    <?= Html::submitButton(Yii::t('action', 'delete'), [
				    'class' => 'btn btn-danger',
				    'value' => 'delete',
				    'name' => 'submit',
			    ]) ?>
            </div>
		
		    <?php ActiveForm::end() ?>
	    <?php } ?>
    </div>
    
</div>
