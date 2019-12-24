<?php


if (YII_ENV == 'production') {
    return [
        'adminEmail' => 'dariyogienko@gmail.com',
        'uploadsUrl' => 'https://bofort.ru/uploads/',
        'uploadsPath' => '/srv/bofort/web/uploads/',

        // CloudPayment
        'cloud_id' => 'pk_7a4b78c1d5facfe91309b9e7a93ee',
        'cloud_private_key' => '96bfa59cd5f0a26e78f0a0bda342fa12',

        // SMS.RU
        'sms_key' => '94D6CAEA-57FC-6A77-0980-286E5E292D5F',

        // SEO
        'google_analytics' => 'UA-134950835-2',
        'yandex_metrika' => '52657108'
    ];
};


return [
    'adminEmail' => 'dariyogienko@gmail.com',
    'uploadsUrl' => (YII_ENV == 'prod')?'http://bofort.su/uploads/':'http://localhost:8080/uploads/',
    'uploadsPath' => (YII_ENV == 'prod')?'/srv/bofort/web/uploads/':'/home/dasha/PhpShtormProjects/bofort/web/uploads/',

    // CloudPayment
    'cloud_id' => 'pk_de50bf19d0acc03c97a4063abeb49',
    'cloud_private_key' => 'fbdaae91cc1cdf5152cb4fa55862df07',

    // SMS.RU
    'sms_key' => '55858AA9-958C-C12D-12B1-6C7CCFD02840',

    // SEO
    'google_analytics' => 'UA-134950835-1',
    'google_optimize' => 'GTM-T68NKC4',
    'yandex_metrika' => '52490173'
];
