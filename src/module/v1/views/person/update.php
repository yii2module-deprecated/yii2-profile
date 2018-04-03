<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('profile/person', 'title');

?>

<?= $this->context->renderPartial('../_navigation'); ?>

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
			<?= Html::submitButton(Yii::t('action', 'save'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>

</div>
