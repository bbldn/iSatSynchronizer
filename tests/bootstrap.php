<?php

use Symfony\Component\Dotenv\Dotenv;

$path = dirname(__DIR__);

/* @noinspection PhpIncludeInspection */
require "{$path}/vendor/autoload.php";

$bootstrapPath = "{$path}/config/bootstrap.php";
if (true === file_exists($bootstrapPath)) {
    /* @noinspection PhpIncludeInspection */
    require $bootstrapPath;
} elseif (true === method_exists(Dotenv::class, 'bootEnv')) {
    /* @noinspection PhpUndefinedMethodInspection */
    (new Dotenv())->bootEnv("{$path}/.env");
}
