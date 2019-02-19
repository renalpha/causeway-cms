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
    <label for="full_day_event">Full day event?</label>
    {!! Form::checkbox('full_day_event', 1, null, ['class' => 'form-control']) !!}
    @if ($errors->has('full_day_event'))
        <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $errors->first('full_day_event') }}</strong>
                </span>
    @endif
</div>
<div class="form-group">
    <label for="start">Start date</label>
    {!! Form::text('start', null, ['class' => 'form-control']) !!}
    @if ($errors->has('start'))
        <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $errors->first('start') }}</strong>
                </span>
    @endif
</div>
<div class="form-group">
    <label for="end">End date</label>
    {!! Form::text('end', null, ['class' => 'form-control']) !!}
    @if ($errors->has('end'))
        <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $errors->first('end') }}</strong>
                </span>
    @endif
</div>
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>