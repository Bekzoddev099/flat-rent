<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'bootstrap.php';

$User = new \RentApp\User();

$User->delete(1);