@extends('layouts.backend')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin/events/index">Events</a></li>
@stop


@section('content')
    <div class="card">
        <div class="card-header">Events</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')

            <a href="{{ route('admin.events.new') }}" class="btn btn-primary float-right">Create Event</a>
            <div class="clearfix"></div>

            <hr/>
            <table class="table table-bordered display nowrap" id="events-table" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Manage</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#events-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '{!! route('ajax.events.index') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'start_date', name: 'start_date', searchable: false},
                    {data: 'end_date', name: 'end_date', searchable: false},
                    {data: 'manage', name: 'manage'},
                ]
            });
        });
    </script>
@endpush
