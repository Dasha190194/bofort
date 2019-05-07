<?php

// prepare menu items, get all modules
$menuItems = [];

$favouriteMenuItems[] = ['label' => 'MAIN NAVIGATION', 'options' => ['class' => 'header']];


$developerMenuItems = [];

$developerMenuItems[] = [
    'url' => ['/sub/action/three'],
    'icon' => 'cog',
    'label' => 'Sub 3',
];
$developerMenuItems[] = [
    'url' => ['/sub/action/param', 'id' => 'a'],
    'icon' => 'cog',
    'label' => 'Param A',
];
$developerMenuItems[] = [
    'url' => ['/sub/action/param', 'id' => 'b'],
    'icon' => 'cog',
    'label' => 'Param B',
];

if(Yii::$app->user->identity->isAdmin()):
    $menuItems[] = [
        'url' => ['/admin/orders'],
        'icon' => 'cog',
        'label' => 'Заказы',
    ];
    $menuItems[] = [
        'url' => ['/admin/actions/index'],
        'icon' => 'cog',
        'label' => 'Акции',
    ];
    $menuItems[] = [
        'url' => ['/admin/category/index'],
        'icon' => 'cog',
        'label' => 'Категории',
    ];
    $menuItems[] = [
        'url' => ['/admin/promo'],
        'icon' => 'cog',
        'label' => 'Промокоды',
    ];
    $menuItems[] = [
        'url' => ['/admin/services'],
        'icon' => 'cog',
        'label' => 'Дополнительные услуги',
    ];
    $menuItems[] = [
        'url' => ['/admin/users'],
        'icon' => 'cog',
        'label' => 'Пользователи',
    ];

    $developerMenuItems = [];
    $developerMenuItems[] = [
        'url' => ['/admin/boats'],
        'icon' => 'cog',
        'label' => 'Все катера',
    ];
    $developerMenuItems[] = [
        'url' => ['/admin/boats/create'],
        'icon' => 'cog',
        'label' => 'Создать катер',
    ];
    $menuItems[] = [
        'icon' => 'cog',
        'label' => 'Катера',
        'items' => $developerMenuItems,
    ];

    $menuItems[] = [
        'url' => ['/admin/documents'],
        'icon' => 'cog',
        'label' => 'Документы',
    ];
    $menuItems[] = [
        'url' => ['/admin/notifications/index'],
        'icon' => 'cog',
        'label' => 'Уведомления',
    ];

endif;

if(Yii::$app->user->identity->isShipowner()):
    $developerMenuItems = [];
    $developerMenuItems[] = [
        'url' => ['/admin/boats'],
        'icon' => 'cog',
        'label' => 'Мои катера',
    ];
    $developerMenuItems[] = [
        'url' => ['/admin/boats/create'],
        'icon' => 'cog',
        'label' => 'Создать катер',
    ];
    $menuItems[] = [
        'icon' => 'cog',
        'label' => 'Катера',
        'items' => $developerMenuItems,
    ];
endif;


echo dmstr\widgets\Menu::widget([
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
]);
?>
