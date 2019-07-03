<?php

return [
    'api_token'       => env('API_TOKEN', 'the-api-token'),
    'leads'           => env('HANDESK_LEADS_ENABLED', false),
    'roadmap'         => env('HANDESK_ROADMAP_ENABLED', false),
    'sendRatingEmail' => env('HANDESK_RATING_EMAIL_ENABLED', true),
    'api_notification_url' =>env('...'),
    'api_notification_token'=>env('...'),
    'api_notificatioin_enabled'=>env('...')
];
