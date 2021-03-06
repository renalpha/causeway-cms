@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Sounds</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Create new sound</h4>
            <div class="clearfix"></div>

            <hr/>

            {{ Form::open(['url' =>route('admin.sound.new.store'), 'files' => 'true', 'id' => 'sound-form']) }}
            @include('admin.sound.partials._form')
            {{ Form::close() }}

        </div>
    </div>
@endsection
