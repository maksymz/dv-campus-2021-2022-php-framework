<?php
/** @var \DVCampus\Framework\View\Renderer $this */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{DV.Campus} PHP Framework</title>
    <link rel="preload" as="style" href="/css/reset.css"/>
    <link rel="stylesheet" href="/css/reset.css"/>
    <link rel="preload" as="style" href="/css/main.min.css"/>
    <link rel="stylesheet" href="/css/main.min.css"/>
</head>
<body>
<header>
    <a href="/" title="{DV.Campus} PHP Framework">
        <img src="/logo.jpg" alt="{DV.Campus} Logo" width="200"/>
    </a>
    <nav>
        <?= $this->render(\DVCampus\Catalog\Block\CategoryList::class) ?>
    </nav>
</header>

<main>
    <?= $this->render($this->getContent(), $this->getContentBlockTemplate()) ?>
</main>

<footer>
    <nav>
        <ul>
            <li>
                <a href="/about-us">About Us</a>
            </li>
            <li>
                <a href="/terms-and-conditions">Terms & Conditions</a>
            </li>
            <li>
                <a href="/contact-us">Contact Us</a>
            </li>
        </ul>
    </nav>
    <p>© Default Value 2021. All Rights Reserved.</p>
</footer>
</body>
</html>