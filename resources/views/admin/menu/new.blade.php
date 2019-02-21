@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Menu</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Create new Menu</h4>
            <div class="clearfix"></div>

            <hr/>

            <form method="post" action="{{ route('admin.menu.new.store') }}" enctype="multipart/form-data" id="menu-form">
                @include('admin.Menu.partials._form')
            </form>

        </div>
    </div>
@endsection
