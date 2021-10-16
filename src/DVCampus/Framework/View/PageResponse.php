<?php
declare(strict_types=1);

namespace DVCampus\Framework\View;

use DVCampus\Framework\Http\Response\Html;

class PageResponse extends Html
{
    private \DVCampus\Framework\View\Renderer $renderer;

    /**
     * @param \DVCampus\Framework\View\Renderer $renderer
     */
    public function __construct(
        \DVCampus\Framework\View\Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    /**
     * @param string $contentBlocClassm
     * @param string $template
     * @return PageResponse
     */
    public function setBody(string $contentBlocClass, string $template = ''): PageResponse
    {
        return parent::setBody((string) $this->renderer->setContent($contentBlocClass, $template));
    }
}
