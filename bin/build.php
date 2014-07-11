#!/usr/bin/env php
<?php
// application.php

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';


require_once __DIR__.'/../app/AppKernel.php';


use Relhub\BuildBundle\Command\BuildCommand;

use Symfony\Component\Console\Application;
$env = 'dev';
$debug = True;
$kernel = new AppKernel($env, $debug);
$application = new Application($kernel);
#$application->run($input);


#$application = new Application();
$application->add(new BuildCommand());
$application->run();
