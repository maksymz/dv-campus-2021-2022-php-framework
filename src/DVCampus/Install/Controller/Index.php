<?php

declare(strict_types=1);

namespace DVCampus\Install\Controller;

use DVCampus\Framework\Http\Response\Html;

class Index implements \DVCampus\Framework\Http\ControllerInterface
{
    private \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter;

    private \DVCampus\Framework\Http\Response\Html $html;

    /**
     * @param \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter
     * @param \DVCampus\Framework\Http\$page\Html $html
     */
    public function __construct(
        \DVCampus\Framework\Database\Adapter\AdapterInterface $adapter,
        \DVCampus\Framework\Http\Response\Html $html
    ) {
        $this->adapter = $adapter;
        $this->html = $html;
    }

    /**
     * @return Html
     */
    public function execute(): Html
    {
        $connection = $this->adapter->getConnection();

        $this->html->setBody('Testing controller');

        return $this->html;
    }
}
