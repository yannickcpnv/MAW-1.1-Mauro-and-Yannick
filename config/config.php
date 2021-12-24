<?php

$dotenv = Dotenv\Dotenv::createImmutable(
    __DIR__,
    getenv('APP_ENV') === 'test' ? '.env.test' : '.env'
);
$dotenv->load();
