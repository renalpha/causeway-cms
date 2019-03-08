<?php

namespace App\Http\Controllers;

use Domain\Services\ForumService;
use Domain\Services\GroupService;

/**
 * Class GroupController
 * @package App\Http\Controllers
 */
class ForumController extends Controller
{
    /**
     * @var GroupService $groupService
     */
    private $forumService;

    /**
     * GroupController constructor.
     * @param ForumService $forumService
     */
    public function __construct(ForumService $forumService)
    {
        $this->forumService = $forumService;
    }

    public function index()
    {
        return view('forum.index', [
            'forumCategories' => $this->forumService->getActiveCategories(),
        ]);
    }
}
