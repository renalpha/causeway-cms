<table class="footable table table-striped table-bordered table-white table-hover default footable-loaded">
    <thead>
    <tr>
        <th data-class="expand" class="footable-visible footable-first-column"><i class="fa fa-list-ol"></i> <a
                    href="./viewforum.php?f=1&amp;sid=8f6049e8ed25d252a57d5ad44830afd7" data-original-title="" title="">{{ $category->title }}</a></th>
        <th class="large80 footable-visible" data-hide="phone"><i class="fa fa-bar-chart-o"></i> Statistics</th>
        <th class="large20 footable-visible footable-last-column" data-hide="phone"><i class="fa fa-comments-o"></i> Last post</th>
    </tr>

    </thead>
    <tbody>
    @foreach($category->children as $subcategory)
        @include('forum.partials.category._subcategory', ['category' => $subcategory])
    @endforeach
    </tbody>
</table>