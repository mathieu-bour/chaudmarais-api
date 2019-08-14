<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

// APP_VERSION
$version = "unknown";
$composerData = json_decode(file_get_contents(__DIR__ . "/../composer.json"));
putenv("APP_VERSION={$composerData->version}");

// APP_BUILD
$build = "unknown";

if (file_exists(__DIR__ . "/../build.txt")) {
    $build = trim(file_get_contents(__DIR__ . "/../build.txt"));
} else if (`which git`) {
    $base = realpath(dirname(__DIR__));
    $gitSha1 = exec("cd $base && git log --pretty=format:'%H' -n 1");
    $build = substr($gitSha1, 0, 7);
}

putenv("APP_BUILD=$build");

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);
$app->withFacades();
$app->withEloquent();

$app->configure("auth");

$app->register(App\Providers\AppServiceProvider::class);

return $app;
