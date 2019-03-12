<a href="/ajax/like/type/{{ $likeType }}/id/{{$likeId}}" class="btn-like btn btn-sm btn-primary btn-counter"
   data-placement="bottom" data-count="{{ $likeObject->likesCount ?? 0 }}" data-html="true"
   data-toggle="tooltip"
   @if($likeObject->likes_users)
   title="
<ul>
   @foreach($likeObject->likes_users as $user)
   {{ $user->name }}
   @endforeach

           </ul>"
        @endif
><i class="fa fa-heart"></i></a>