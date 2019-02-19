<?php

namespace Domain\Services;

use Infrastructure\Repositories\PageRepository;

/**
 * Class PageService
 * @package Domain\Services
 */
class PageService extends AbstractService
{
    /**
     * PageService constructor.
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->repository = $pageRepository;
    }
}