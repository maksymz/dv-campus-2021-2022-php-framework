<?php
/** @var \DVCampus\Catalog\Block\CategoryList $block */
?>
<ul>
    <?php foreach ($block->getCategories() as $category) : ?>
        <li>
            <a href="/<?= $category->getUrl() ?>"><?= $category->getName() ?></a>
        </li>
    <?php endforeach; ?>
</ul>