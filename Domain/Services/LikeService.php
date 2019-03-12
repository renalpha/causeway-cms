<?php

namespace Domain\Services;

use App\Models\Notification;
use Domain\Entities\Comment\Comment;
use Domain\Entities\PandaComment\PandaComment;

/**
 * Class PandaLikeService
 *
 * @package Domain\Services
 */
class LikeService extends AbstractService
{
    /**
     * @var array
     */
    public $likeAbleTypes;

    /**
     * PandaLikeService constructor.
     */
    public function __construct()
    {
        $this->likeAbleTypes = [
            'groupNotification',
            'comment',
        ];
    }

    /**
     * Like subject by type and id.
     *
     * @param string $type
     * @param string $id
     * @return bool
     * @throws \Exception
     */
    public function likeSubjectByTypeAndId(string $type, string $id): bool
    {
        switch ($type) {
            case 'groupNotification':
                $notification = Notification::where('id', $id)->firstOrFail();
                auth()->user()->liking($notification);
                break;
            case 'comment':
                $comment = Comment::where('id', $id)->firstOrFail();
                auth()->user()->liking($comment);
                break;
        }
        return true;
    }
}