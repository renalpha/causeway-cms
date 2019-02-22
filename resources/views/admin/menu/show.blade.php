@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Menu</div>

        <div class="card-body">
            @include('layouts.partials._status_messages')
            <h4>Manage {{ $menu->label }}</h4>
            <div class="clearfix"></div>

            <ul class="list-group sortableNav">
                <?php
                $itemKey = 0;
                $subItemKey = 0;
                ?>
                @foreach($menu->items()->whereNull('parent_id')->get() as $item)
                    <li class="list-group-item list-group-item-action list-group-item-sortable" id="item-{{ $item->id }}">
                        <div>{{ $item->label }}
                            <div class="pull-right">
                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Remove</a>
                            </div>
                        </div>
                        <ul class="list-group">
                            @foreach($item->items as $subItem)
                                <li class="list-group-item list-group-item-action list-group-item-sortable" id="item-{{ $subItem->id }}">
                                    <div>{{ $subItem->label }}
                                        <div class="pull-right">
                                            <a href="" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="" class="btn btn-sm btn-danger">Remove</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("ul.sortableNav").nestedSortable({
                listType: 'ul',
                disableNesting: 'no-nest',
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                maxLevels: 2,
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                update: function (event, ui) {
                    var data = JSON.stringify($(this).nestedSortable('toArray', {startDepthCount: 0}));
                    console.log(data);
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {data: data},
                        dataType: "json",
                        type: 'POST',
                        url: '{{ route('admin.menu.show.sort', ['id' => $menu->id]) }}'
                    });
                }
            });
        });
    </script>
@endpush