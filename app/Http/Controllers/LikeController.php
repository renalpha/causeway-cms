<?php

namespace App\Http\Controllers;

use Domain\Services\LikeService;
use Illuminate\Http\Request;

/**
 * Class LikeController
 *
 * @package App\Http\Controllers\
 */
class LikeController extends Controller
{
    protected $likeService;

    /**
     * LikeController constructor.
     *
     * @param LikeService $likeService
     */
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    /**
     * Like action.
     *
     * @param Request $request
     * @param string $type
     * @param string $id
     * @throws \Exception
     */
    public function like(Request $request, string $type, string $id)
    {
        if (!in_array($type, $this->likeService->likeAbleTypes, true)) {
            throw new \Exception('This subject type is not supported...');
        }

        $this->likeService->likeSubjectByTypeAndId($type, $id);
    }
}