@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Events</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Create new event</h4>
            <div class="clearfix"></div>

            <hr/>

            {{ Form::open(['url' => route('admin.events.new.store'), 'id' => 'event-form']) }}
                @include('admin.events.partials._form')
            {{ Form::close() }}

        </div>
    </div>
@endsection

@push('scripts')

@endpush
