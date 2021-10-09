<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

$requestDispatcher = new \DVCampus\Framework\Http\RequestDispatcher([
    new \DVCampus\Cms\Router(),
    new \DVCampus\Catalog\Router(),
    new \DVCampus\ContactUs\Router(),
]);
$requestDispatcher->dispatch();

exit;

switch ($requestUri) {
    default:


        break;
}