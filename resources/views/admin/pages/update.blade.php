@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Pages</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Update page {{ $page->name }}</h4>
            <div class="clearfix"></div>

            <hr/>

            {{ Form::model($page, ['url' => route('admin.pages.update.store', ['id' => $page->id]), 'id' => 'page-form', 'method' => 'put']) }}
            @include('admin.pages.partials._form')
            {{ Form::close() }}

        </div>
    </div>
@endsection
