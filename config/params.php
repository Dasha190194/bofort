<?php

return [
    'adminEmail' => 'dariyogienko@gmail.com',
    'uploadsUrl' => (YII_ENV == 'prod')?'http://bofort.su/uploads/':'http://localhost:8080/uploads/',
    'uploadsPath' => (YII_ENV == 'prod')?'/srv/bofort/web/uploads/':'/home/dasha/PhpShtormProjects/bofort/web/uploads/',
    'cloud_id' => 'pk_de50bf19d0acc03c97a4063abeb49',
    'cloud_private_key' => 'fbdaae91cc1cdf5152cb4fa55862df07',
    'sms_key' => '55858AA9-958C-C12D-12B1-6C7CCFD02840',
    'google_analytics' => (YII_ENV == 'prod') ? 'UA-134950835-2' : 'UA-134950835-1',
    'yandex_metrika' => (YII_ENV == 'prod') ? '52657108' : '52490173'
];
