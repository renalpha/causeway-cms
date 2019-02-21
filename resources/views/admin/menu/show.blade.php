@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Menu</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Manage {{ $menu->label }}</h4>
            <div class="clearfix"></div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        URL
                    </th>
                    <th>
                        Manage
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($menu->items()->whereNull('parent_id')->get() as $item)
                    <tr>
                        <td>
                            {{ $item->label }}
                        </td>
                        <td>
                            {{ $item->url }}
                        </td>
                        <th>
                            <a href="" class="btn btn-sm btn-warning">Edit</a>
                            <a href="" class="btn btn-sm btn-danger">Remove</a>
                        </th>
                    </tr>
                    @foreach($item->items as $subItem)
                        <tr class="subItems">
                            <td>
                                {{ $subItem->label }}
                            </td>
                            <td>
                                {{ $subItem->url }}
                            </td>
                            <th>
                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Remove</a>
                            </th>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
