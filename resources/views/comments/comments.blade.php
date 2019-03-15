<div class="detailBox">
    <div class="actionBox">
        <ul class="list-group commentList" data-comment="{{ $commentsObject->id }}">
            <li class="list-group-item flex-column align-items-start list-group-item-secondary" id="forumReply">
                <p><strong>Discussion</strong></p>
                <form class="replyForm" role="form" method="post" action="{{ route('comment.store', ['type' => $type, 'id' => $commentsObject->id]) }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Your comments" name="comment" id="summernote"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Post</button>
                    </div>
                </form>
            </li>
            @if(isset($commentsObject->comments))
                @foreach($commentsObject->comments()->limit(30)->get() as $comment)
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="commenterImage">
                            @if(file_exists($comment->profile_picture ?? '/images/placeholder_profile.png'))
                                <img src="{{ $comment->profile_picture ?? '/images/placeholder_profile.png' }}" alt="User"/>
                            @endif
                        </div>
                        <div class="commentText">
                            <p class="commentName"><strong>{{ $comment->name }}</strong></p>
                            <p class="commentContent">{!! $comment->comment !!}</p>
                            <div class="clearfix">
                                <span class="date sub-text btn btn-sm btn-like btn-outline-dark">on <span class="commentDate">{{ $comment->created_at->diffForHumans() }}</span></span>

                                @include('like.like', [
                                'likeObject' => $comment,
                                'likeId' => $comment->id,
                                'likeType' => 'comment'
                                ])

                                <a href="#" class="btn btn-sm btn-primary btn-like pull-right btn-quote-action" data-comment-id="{{ $comment->id }}">
                                    Quote
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>