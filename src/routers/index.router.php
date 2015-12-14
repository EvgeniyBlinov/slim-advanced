<?php
$app->get('/(:locale)(/)'/*, $accessControl('some')*/, function ($locale = APP_DEFAULT_LOCALE) use ($app) {
    $title = 'title';

    echo "<pre>";var_dump(
        'вывести темлейт',
        'подключить illuminate database',
    $app->config['templates.path']
    );die;
    $app->render('index.twig', compact('title', 'locale'));
})
    ->name('url_home')
    ->conditions(array('locale' => '(ru|en)'))
;
