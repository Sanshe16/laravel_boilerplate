<!-- Fixed Sidebar Left -->

<div class="fixed-sidebar">
    <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">

        <a href="{{route('dashboard')}}" class="logo">
            <div class="img-wrap">
                <img loading="lazy" src="{{ URL::asset('frontend/img/logo.png') }}" width="35" height="35" alt="Olympus">
            </div>
        </a>

        <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="left-menu">
                @include('backend.partial.sidebar.admin-list-sidebar')
            </ul>
        </div>
    </div>

    <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
        <a href="{{route('dashboard')}}" class="logo">
            <div class="img-wrap">
                <img loading="lazy" src="{{ URL::asset('frontend/img/logo.png') }}" width="35" height="35" alt="Olympus">
            </div>
            <div class="title-block">
                <h6 class="logo-title">olympus</h6>
            </div>
        </a>

        <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="left-menu">
                @include('backend.partial.sidebar.admin-list-sidebar',['sidebarNames' => config('constant.sidebar-list')])
            </ul>
        </div>
    </div>
</div>

<!-- ... end Fixed Sidebar Left -->


<!-- Fixed Sidebar Left -->

<div class="fixed-sidebar fixed-sidebar-responsive">

    <div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive">
        <a href="#" class="logo js-sidebar-open">
            <img loading="lazy" src="{{ URL::asset('frontend/img/logo.png') }}" alt="Olympus">
        </a>

    </div>

    <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
        <a href="#" class="logo">
            <div class="img-wrap">
                <img loading="lazy" src="{{ URL::asset('frontend/img/logo.png') }}" alt="Olympus">
            </div>
            <div class="title-block">
                <h6 class="logo-title">olympus</h6>
            </div>
        </a>

        <div class="mCustomScrollbar" data-mcs-theme="dark">

            <div class="control-block">
                <div class="author-page author vcard inline-items">
                    <div class="author-thumb">
                        <img alt="author" src="{{ URL::asset('frontend/img/author-page.jpg') }}" class="avatar">
                        <span class="icon-status online"></span>
                    </div>
                    <a href="/home" class="author-name fn">
                        <div class="author-title">
                            James Spiegel <svg class="olymp-dropdown-arrow-icon"><use xlink:href="#olymp-dropdown-arrow-icon"></use></svg>
                        </div>
                        <span class="author-subtitle">SPACE COWBOY</span>
                    </a>
                </div>
            </div>

            <div class="ui-block-title ui-block-title-small">
                <h6 class="title">MAIN SECTIONS</h6>
            </div>

            <ul class="left-menu">
                <li>
                    <a href="#" class="js-sidebar-open">
                        <svg class="olymp-close-icon left-menu-icon"><use xlink:href="#olymp-close-icon"></use></svg>
                        <span class="left-menu-title">Collapse Menu</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('dashboard')}}">
                        <svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   data-original-title="NEWSFEED"><use xlink:href="#olymp-newsfeed-icon"></use></svg>
                        <span class="left-menu-title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="Mobile-28-YourAccount-PersonalInformation.html">
                        <svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="#olymp-star-icon"></use></svg>
                        <span class="left-menu-title">Fav Pages Feed</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>
</div>

<!-- ... end Fixed Sidebar Left -->
