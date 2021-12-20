<?php

declare(strict_types=1);

namespace DVCampus\Catalog\Controller;

use DVCampus\Catalog\Block\Product\RecentlyViewed;
use DVCampus\Catalog\Model\Product\Entity;
use DVCampus\Framework\Http\ControllerInterface;
use DVCampus\Framework\Http\Response\Raw;

class Product implements ControllerInterface
{
    private \DVCampus\Framework\View\PageResponse $pageResponse;

    private \DVCampus\Framework\Http\Request $request;

    private \DVCampus\Framework\Session\Session $session;

    /**
     * @param \DVCampus\Framework\View\PageResponse $pageResponse
     * @param \DVCampus\Framework\Http\Request $request
     * @param \DVCampus\Framework\Session\Session $session
     */
    public function __construct(
        \DVCampus\Framework\View\PageResponse $pageResponse,
        \DVCampus\Framework\Http\Request $request,
        \DVCampus\Framework\Session\Session $session
    ) {
        $this->pageResponse = $pageResponse;
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        /** @var Entity $product */
        $product = $this->request->getParameter('product');
        $recentlyViewedProducts = (array) $this->session->getData(RecentlyViewed::SESSION_KEY_RECENTLY_VIEWED_PRODUCTS);
        array_unshift($recentlyViewedProducts, $product->getProductId());
        $this->session->setData(
            RecentlyViewed::SESSION_KEY_RECENTLY_VIEWED_PRODUCTS,
            array_unique($recentlyViewedProducts)
        );

        return $this->pageResponse->setBody(\DVCampus\Catalog\Block\Product::class);
    }
}