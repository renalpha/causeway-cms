@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Pages</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Create new page</h4>
            <div class="clearfix"></div>

            <hr/>

            <form method="post" action="{{ route('admin.pages.new.store') }}" enctype="multipart/form-data" id="page-form">
                @include('admin.pages.partials._form')
            </form>

        </div>
    </div>
@endsection
