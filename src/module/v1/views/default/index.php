<?php

use yii\widgets\DetailView;
use yii2lab\helpers\yii\Html;
use yii2module\account\domain\v2\entities\LoginEntity;
use yii2module\profile\domain\v2\entities\ProfileEntity;

/**
 * @var ProfileEntity $profileEntity
 */

$this->title = Yii::t('profile/profile', 'title');

$icon = Html::fa('pencil', ['class' => 'text-primary']);

?>

<?= ''/*$this->context->renderPartial('../_navigation');*/ ?>

<div class="row">

    <div class="container">

        <ul class="media-list">
            <!-- Комментарий (уровень 1) -->
            <div class="media">
                <div class="media-left">
					<?= Html::a(Html::img($profileEntity->avatar->url, ['style' => 'height: 64px']), ['/profile/avatar'], [
						'title' => Yii::t('action', 'update'),
					]) ?>
                </div>
                <div class="media-body">
                    <h2>
						<?= NBSP . $profileEntity->person->first_name . SPC . $profileEntity->person->last_name ?>
                    </h2>
                </div>
            </div>
        </ul>

        <h3>Account</h3>
		
		<?= DetailView::widget([
			'model' => Yii::$domain->account->auth->identity,
			'attributes' => [
				'id',
				'login',
				'status',
				'roles' => [
					'attribute' => 'roles',
					'format' => 'raw',
					'value' => function (LoginEntity $loginEntity) {
						return Html::ul($loginEntity->roles);
					},
				],
				'email',
				'created_at',
			],
		]) ?>

        <h3>
            Person
			<?= NBSP . Html::a($icon, ['/profile/person'], [
				'title' => Yii::t('action', 'update'),
			]) ?>
        </h3>

        <div>
			<?= DetailView::widget([
				'model' => $profileEntity->person,
				'attributes' => [
					'first_name',
					'last_name',
					'iin',
					'birth_date',
					'sex',
				],
			]) ?>
        </div>

        <h3>
            Address
			<?= NBSP . Html::a($icon, ['/profile/address'], [
				'title' => Yii::t('action', 'update'),
			]) ?>
        </h3>

        <div>
			<?= DetailView::widget([
				'model' => $profileEntity->address,
				'attributes' => [
					'country_id',
					'region_id',
					'city_id',
					'district',
					'street',
					'home',
					'apartment',
					'zip_code',
					'city',
					'region',
					'country',
				],
			]) ?>
        </div>
    </div>
</div>
