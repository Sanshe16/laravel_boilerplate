<li>
    <a href="#" class="js-sidebar-open">
        <svg class="olymp-menu-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="OPEN MENU"><use xlink:href="#olymp-menu-icon"></use></svg>
    </a>
</li>
<li>
    <a href="{{route('dashboard')}}">
        <svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   data-original-title="Dashboard"><use xlink:href="#olymp-newsfeed-icon"></use></svg>
        @isset($sidebarNames)
            <span>{{$sidebarNames['dashboard']}}</span>
        @endisset

    </a>
</li>
<li class="menu">
    <a href="{{route('roles.index')}}" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="right"   data-original-title="Roles"  class="feather feather-target olymp-newsfeed-icon mr-4"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
        @isset($sidebarNames)
            <span>{{$sidebarNames['roles']}}</span>
        @endisset
    </a>
</li>
