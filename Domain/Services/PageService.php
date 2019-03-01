<?php

namespace Domain\Services;

use Illuminate\Database\Eloquent\Model;
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

    /**
     * @param array $params
     * @param int|null $id
     * @return Model
     */
    public function savePage(array $params, int $id = null)
    {
        $params['user_id'] = auth()->user()->id;

        $page = $this->repository->updateOrCreate([
            'id' => $id ?? null,
        ], $params);

        return $page;
    }
}