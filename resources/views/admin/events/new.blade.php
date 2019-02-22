@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Events</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Create new event</h4>
            <div class="clearfix"></div>

            <hr/>

            <form method="post" action="{{ route('admin.events.create.store') }}" enctype="multipart/form-data">
                @include('admin.events.partials._form')
            </form>

        </div>
    </div>
@endsection

@push('scripts')

@endpush
