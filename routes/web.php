<?php

$app->get('/', function () use ($app) {
    return 'Hello IT, have you tried turning it off and on again?';
});

$app->get('webhook', 'FacebookController@verifyUrl');

$app->post('webhook', 'FacebookController@webhook');
