<div class="profile-sidebar">
    <ul class="list-group">
        <li>
            <a class="list-group-item"><i class="fa fa-home"></i> <span>Navigation</span></a>
        </li>
        <li><a href="{{ route('admin.dashboard') }}" class="list-group-item {{ (request()->is('admin/dashboard'))? 'active' :'' }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li><a href="{{ route('admin.pages.index') }}" class="list-group-item {{ (request()->is('admin/pages*'))? 'active' :'' }}"><i class="fa fa-file"></i> <span>Pages</span></a>
            <ul class="submenu" style="display: {{ (request()->is('admin/photo/album/new'))? 'block' :'' }};">
                <li><a href="{{ route('admin.pages.create') }}" class="list-group-item"><i class="fa fa-file-text"></i> <span>New page</span></a></li>
            </ul>
        </li>
        <li><a href="{{ route('admin.events.index') }}" class="list-group-item {{ (request()->is('admin/events*'))? 'active' :'' }}"><i class="fa fa-calendar"></i> <span>Events</span></a>
            <ul class="submenu" style="display: {{ (request()->is('admin/photo/album/new'))? 'block' :'' }};">
                <li><a href="{{ route('admin.events.create') }}" class="list-group-item"><i class="fa fa-calendar-check-o"></i> <span>New event</span></a></li>
            </ul>
        </li>
        <li><a href="{{ route('admin.album.index') }}" class="list-group-item {{ (request()->is('admin/photo/album*'))? 'active' :'' }}"><i class="fa fa-photo"></i> <span>Photos</span></a>
            <ul class="submenu" style="display: {{ (request()->is('admin/photo/album/new'))? 'block' :'' }};">
                <li><a href="{{ route('admin.album.create') }}" class="list-group-item"><i class="fa fa-file-photo-o"></i> <span>New album</span></a></li>
            </ul>
        </li>
    </ul>
</div>