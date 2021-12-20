<?php

declare(strict_types=1);

namespace DVCampus\Catalog\Block\Product;

use DVCampus\Catalog\Model\Product\Entity;

class RecentlyViewed extends \DVCampus\Framework\View\Block
{
    public const SESSION_KEY_RECENTLY_VIEWED_PRODUCTS = 'recently_viewed_products';

    public const RECENTLY_VIEWED_PRODUCTS_COUNT = 16;

    protected string $template = '../src/DVCampus/Catalog/view/product/recently_viewed.php';

    private \DVCampus\Framework\Http\Request $request;

    private \DVCampus\Framework\Session\Session $session;

    private \DVCampus\Catalog\Model\Product\Repository $productRepository;

    /**
     * @param \DVCampus\Framework\Http\Request $request
     * @param \DVCampus\Framework\Session\Session $session
     * @param \DVCampus\Catalog\Model\Product\Repository $productRepository
     */
    public function __construct(
        \DVCampus\Framework\Http\Request $request,
        \DVCampus\Framework\Session\Session $session,
        \DVCampus\Catalog\Model\Product\Repository $productRepository
    ) {
        $this->session = $session;
        $this->productRepository = $productRepository;
        $this->request = $request;
    }

    /**
     * @return Entity[]
     */
    public function getProducts(): array
    {
        $productIds = (array) $this->session->getData(self::SESSION_KEY_RECENTLY_VIEWED_PRODUCTS);

        /** @var Entity $product */
        if ($product = $this->request->getParameter('product')) {
            if (($key = array_search($product->getProductId(), $productIds, true)) !== false) {
                unset($productIds[$key]);
            }
        }

        if (empty($productIds)) {
            return [];
        }

        $in = str_repeat('?,', count($productIds) - 1) . '?';
        $select = $this->productRepository->select()
            ->where("product_id IN($in)")
            ->limit(self::RECENTLY_VIEWED_PRODUCTS_COUNT)
            ->orderBy(sprintf('FIELD(product_id,%s)', implode(',', $productIds)));

        return $this->productRepository->fetchEntities($select, array_values($productIds));
    }
}
