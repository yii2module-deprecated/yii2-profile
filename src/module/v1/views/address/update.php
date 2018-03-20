<?php

use common\enums\app\ApiVersionEnum;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii2lab\geo\widgets\GeoSelector;

$this->title = Yii::t('profile/address', 'title');

?>

<?= $this->context->renderPartial('..\_navigation'); ?>

<div class="row">
    <div class="col-lg-3">
        <?php $form = ActiveForm::begin(); ?>

        <?= GeoSelector::widget([
            'form' => $form,
            'model' => $model,
	        'default' => [
	            'country_id' => 1894,
            ],
            'url' => [
                'country' => ApiVersionEnum::VERSION_DEFAULT . '/country',
                'region' => ApiVersionEnum::VERSION_DEFAULT . '/region',
                'city' => ApiVersionEnum::VERSION_DEFAULT . '/city',
            ],
        ]) ?>

        <?= $form->field($model, 'street')->textInput(['id'=>'street','placeholder'=>$model->street]) ?>
     
        <?= $form->field($model, 'home')->textInput(['id'=>'home','placeholder'=>$model->home]) ?>
     
        <?= $form->field($model, 'apartment')->textInput(['id'=>'apartment','placeholder'=>$model->apartment]) ?>
        
        <div class="form-group">
            <?= Html::submitButton(Yii::t('action', 'save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    
    </div>
</div>
