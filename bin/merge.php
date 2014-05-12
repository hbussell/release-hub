#!/usr/bin/env php
<?php
// application.php

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

use \CarrLabs\GitWrapper\GitRepository;
#require_once __DIR__.'/../app/AppKernel.php';

$checkout = $argv[0];
var_dump($argv);

$repository = new GitRepository($checkout);

$branches = $repository->getBranches();
var_dump($branches);
