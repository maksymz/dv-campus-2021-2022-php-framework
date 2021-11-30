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
    <div class="header-wrapper content-wrapper">
        <a href="/" title="{DV.Campus} PHP Framework">
            <img src="/images/logo.jpg" alt="{DV.Campus} Logo" width="200"/>
        </a>
        <nav>
            <div class="menu-btn-mobile">
                <button class="wrapper-button">
                    <i></i><i></i><i></i>
                </button>
            </div>
            <?= $this->render(\DVCampus\Catalog\Block\CategoryList::class) ?>
        </nav>
    </div>
</header>

<main class="page-wrapper">
    <?= $this->render($this->getContent(), $this->getContentBlockTemplate()) ?>
</main>

<footer>
    <div class="footer-links-wrapper content-wrapper">
        <ul class="footer-links">
            <li class="footer-link-item">
                <a href="/about-us">About Us</a>
            </li>
            <li class="footer-link-item">
                <a href="/terms-and-conditions">Terms & Conditions</a>
            </li>
            <li class="footer-link-item">
                <a href="/contact-us">Contact Us</a>
            </li>
        </ul>
    </div>
    <div class="copyright">
        <p>© Default Value 2021. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>