<?php
use models\User;
$app->get('/(:locale)(/)'/*, $accessControl('some')*/, function ($locale = APP_DEFAULT_LOCALE) use ($app) {
    $title = 'title';

    //$users = User::all()->toJson();
    $app->render('index.twig', compact('title', 'locale'));
})
    ->name('url_home')
    ->conditions(array('locale' => '(ru|en)'))
;
