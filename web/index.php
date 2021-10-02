<?php

declare(strict_types=1);

require_once '../src/data.php';
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

switch ($requestUri) {
    case '':
        $page = 'home.php';
        break;
    case 'contact-us':
        $page = 'contact-us.php';
        break;
    default:
        if ($data = catalogGetCategoryByUrl($requestUri)) {
            $page = 'category.php';
            break;
        }

        if ($data = catalogGetProductByUrl($requestUri)) {
            $page = 'product.php';
            break;
        }

        break;
}


if (!isset($page)) {
    header("HTTP/1.0 404 Not Found");
    exit(0);
}

header('Content-Type: text/html; charset=utf-8');

ob_start();
require_once "../src/page.php";
echo ob_get_clean();