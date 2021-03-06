@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Photo Albums</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Create new album</h4>
            <div class="clearfix"></div>

            <hr/>
            {{ Form::open(['url' => route('admin.photo.album.new.store'), 'files' => true]) }}
            @include('admin.photo.album.partials._form')
            {{ Form::close() }}

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#fileupload').fileupload({
                dataType: 'json',
                beforeSend: function (xhr, data) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .bar').css(
                        'width',
                        progress + '%'
                    );
                },
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo(document.body);
                    });
                }
            });
        });
    </script>
@endpush
