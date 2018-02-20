Установка
===

Устанавливаем зависимость:

```
composer require yii2module/yii2-profile
```

Объявляем frontend модуль:

```php
return [
	'modules' => [
		// ...
		'profile' => [
			'class' => 'yii2module\profile\module\Module',
			'actionList' => [
				'person',
				'address',
				'car',
				//'avatar',
				'security',
				'qr',
			],
		],
		// ...
	],
];
```

Объявляем домен:

```php
return [
	'components' => [
		// ...
		'profile' => [
			'class' => 'yii2lab\domain\Domain',
			'path' => 'yii2module\profile\domain',
			'repositories' => [
				'profile' => Driver::ACTIVE_RECORD,
				'address' => Driver::ACTIVE_RECORD,
				'car' => Driver::ACTIVE_RECORD,
				'avatar' => [
					'driver' => Driver::UPLOAD,
					//'quality' => 90,
					'format' => 'png',
					'defaultName' => 'images/icon/avatar.png',
					'size' => 256,
				],
				'qr' => Driver::FILE,
				'iin' => Driver::remote(),
				'active' => Driver::ACTIVE_RECORD,
			],
			'services' => [
				'profile',
				'address',
				'car',
				'avatar',
				'iin',
				'qr',
				'active',
			],
		],
		// ...
	],
];
```
