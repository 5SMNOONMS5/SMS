<?php

namespace Maxin\Sms\Providers;

class YunpianConfig
{   
    const ENDPOINT           = 'url';

    const REQUIRE_PARAMETERS = 'requireParameters';

    const SINGLE = [
        self::ENDPOINT           => 'v2/sms/single_send.json',
        self::REQUIRE_PARAMETERS => [
            'apikey', 'mobile', 'text'
        ]
    ];

    const TEMPLATE = [
        self::ENDPOINT           => 'v2/sms/tpl_single_send.json',
        self::REQUIRE_PARAMETERS => [
            'apikey', 'mobile', 'tpl_id', 'tpl_value'
        ]
    ];

    const USER = [
        self::ENDPOINT           => 'v2/user/get.json',
        self::REQUIRE_PARAMETERS => [
            'apikey'
        ]
    ];
}
