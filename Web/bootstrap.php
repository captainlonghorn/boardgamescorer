<?php
const DEFAULT_APP = 'Frontend';

// In cas eof invalid app, default app then 404
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) {
    $_GET['app'] = DEFAULT_APP;
}

// Including class for autoload
require __DIR__.'/../lib/Framework/SplClassLoader.php';

// On va ensuite enregistrer les autoloads correspondant à chaque vendor (OCFram, App, Model, etc.)
$OCFramLoader = new SplClassLoader('Framework', __DIR__.'/../lib');
$OCFramLoader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();

// Il ne nous suffit plus qu'à déduire le nom de la classe et à l'instancier
$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$test = new App\Frontend\FrontendApplication;

$app = new $appClass;

$app->run();