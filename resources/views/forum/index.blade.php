@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum</div>

                    <div class="card-body">

                        <div id="page-body">
                            <main>
                                <div class="panel panel-default">
                                    @foreach($forumCategories as $category)
                                        @include('forum.partials.category._category')
                                    @endforeach
                                </div>

                            </main>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection