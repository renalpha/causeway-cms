@extends('layouts.site')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('site.forum.index') }}">Forum</a></li>
    <li class="breadcrumb-item"><a href="{{ route('site.forum.category', ['forumCategory' => $category->slug]) }}">{{ $category->title }}</a></li>
    <li class="breadcrumb-item active">{{ $thread->title }}</li>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Thread title: {{ $thread->title }}</div>

                    <div class="card-body">

                        <div id="page-body">
                            <main>
                                <div class="panel panel-default">
                                    <div class="responsive-images">
                                    {!! $thread->content !!}
                                    </div>
                                    <hr/>
                                </div>
                                <div class="panel">
                                    @include('comments.comments', ['commentsObject' => $thread, 'type' => \Domain\Entities\Forum\Thread::class])
                                </div>
                            </main>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('topscripts')
    <script type="text/javascript">
        window.Laravel.threadId = <?php echo $thread->id; ?>;
    </script>
@endpush