<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if ($errors->has('name'))
        <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
    @endif
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    @if ($errors->has('slug'))
        <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
    @endif
</div>
<div class="form-group">
    <label for="access_level">Access level</label>
    {!! Form::select('access_level', accessLevelList(), null, ['class' => 'form-control']) !!}
    @if ($errors->has('access_level'))
        <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $errors->first('access_level') }}</strong>
                </span>
    @endif
</div>

    <div id="gridEditor">

    </div>


<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>


@push('scripts')
    <script type="application/javascript">
        $('#gridEditor').gridEditor({
            content_types: ['summernote'],
            summernote: {
                config: { shortcuts: false }
            }
        });

        $('#page-form').on('submit', function () {
            var html = $('#myGrid').gridEditor('getHtml');
            $('textarea.myTextarea').val(html);
        });
    </script>
@endpush