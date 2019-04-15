<?php

?>

<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <?php echo \cebe\gravatar\Gravatar::widget(
            [
                'email' => 'username@example.com',
                'options' => [
                    'alt' => 'username',
                ],
                'size' => 64,
            ]
        ); ?>
    </div>
    <div class="pull-left info">
        <p>username</p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>




<?php

// prepare menu items, get all modules
$menuItems = [];

$favouriteMenuItems[] = ['label' => 'MAIN NAVIGATION', 'options' => ['class' => 'header']];


$developerMenuItems = [];
$developerMenuItems[] = [
    'url' => ['/sub/action/one'],
    'icon' => 'cog',
    'label' => 'Sub 1',
];
$developerMenuItems[] = [
    'icon' => 'cog',
    'label' => 'No Link',
];
$developerMenuItems[] = [
    'icon' => 'cog',
    'label' => 'Not visible',
    'visible' => false,
];
$developerMenuItems[] = [
    'icon' => 'cog',
    'label' => 'Folder',
    'items' => [
        [
            'url' => ['/sub/action/two'],
            'icon' => 'cog',
            'label' => 'SubSub 2',
        ],
    ],
];
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
        'url' => ['/boats/index'],
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
        'url' => ['/boats/index?shipowner='.Yii::$app->user->getId()],
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
