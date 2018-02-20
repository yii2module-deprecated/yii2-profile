<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?= $this->context->renderPartial('..\_navigation'); ?>

<div class="row">
 
	<div class="col-lg-3">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($modelMain, 'first_name')->textInput(); ?>

		<?= $form->field($modelMain, 'last_name')->textInput(); ?>

		<?= $form->field($modelMain, 'birth_date')->textInput(); ?>

		<?= $form->field($modelMain, 'iin')->textInput(); ?>

		<?= $form->field($modelMain, 'sex')->radioList([
			0 => Yii::t('profile/person', 'sex_male'),
			1 => Yii::t('profile/person', 'sex_female'),
		]); ?>

		<div class="form-group">
			<?= Html::submitButton(t('action', 'save'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>

    <div class="col-lg-1"></div>
    
    <div class="col-lg-3">
        <img src="<?= $avatar->url ?>" />
	
	    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	    <?= $form->field($modelAvatar, 'imageFile')->fileInput() ?>

        <div class="form-group">
		    <?= Html::submitButton(t('action', 'upload'), ['class' => 'btn btn-primary']) ?>
        </div>
	
	    <?php ActiveForm::end() ?>
	
	    <?php if($avatar->name) { ?>
		    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <div class="form-group">
			    <?= Html::submitButton(t('action', 'delete'), [
				    'class' => 'btn btn-danger',
				    'value' => 'delete',
				    'name' => 'submit',
			    ]) ?>
            </div>
		
		    <?php ActiveForm::end() ?>
	    <?php } ?>
    </div>
    
</div>
