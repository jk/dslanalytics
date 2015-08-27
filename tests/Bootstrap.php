<?php

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

// Set the default timezone. While this doesn't cause any tests to fail, PHP
// complains if it is not set in 'date.timezone' of php.ini.
date_default_timezone_set('UTC');

// Ensure that composer has installed all dependencies
if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install --dev\n\n"
        . "See http://getcomposer.org for help with installing composer\n");
}

//define('FIXTURES_DIR', __DIR__ . '/fixtures');
//if (!file_exists(FIXTURES_DIR) || !is_dir(FIXTURES_DIR)) {
//    die("Fixtures directory: ".FIXTURES_DIR." does not exist. Please provide fixtures.\n");
//}

// Include the composer autoloader
$autoloader = require_once(dirname(__DIR__) . '/vendor/autoload.php');

//\VCR\VCR::turnOn();
//\VCR\VCR::configure()
//    ->setCassettePath(__DIR__.'/fixtures/vcr');
