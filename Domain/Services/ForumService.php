<?php

namespace Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Repositories\ForumCategoryRepository;
use Infrastructure\Repositories\ForumThreadRepository;

/**
 * Class ForumService
 * @package Domain\Services
 */
class ForumService extends AbstractService
{
    /** @var ForumThreadRepository  */
    protected $threadRepository;

    /** @var ForumCategoryRepository  */
    protected $categoryRepository;

    /**
     * PhotoAlbumService constructor.
     * @param ForumThreadRepository $forumThreadRepository
     * @param ForumCategoryRepository $forumCategoryRepository
     */
    public function __construct(ForumThreadRepository $forumThreadRepository, ForumCategoryRepository $forumCategoryRepository)
    {
        $this->threadRepository = $forumThreadRepository;
        $this->categoryRepository = $forumCategoryRepository;
    }

    public function updateOrCreateCategory(array $match, array $params)
    {
        $this->repository = $this->categoryRepository;
        $params['parent_id'] = !empty($params['parent_id']) ? $params['parent_id'] : null;
        return parent::updateOrCreate($match, $params); // TODO: Change the autogenerated stub
    }

    public function updateOrCreateThread(array $match, array $params)
    {
        $this->repository = $this->threadRepository;
        return parent::updateOrCreate($match, $params); // TODO: Change the autogenerated stub
    }

    /**
     * @return Collection
     */
    public function getActiveCategories(): Collection
    {
        return $this->categoryRepository->whereNull('parent_id')->get();
    }
}