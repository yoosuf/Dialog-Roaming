<body class="skin-black sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>ARA</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img class="img-responsive" src="{{ URL::asset('img/logo.png') }}" style="margin:5px auto 0;"></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">

            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">


                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ URL::asset('img/user2-160x160.jpg') }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->email }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ URL::asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
                                <p>
                                    {{--{!!ucfirst(Auth::user()->name)!!} - {!!Auth::user()->email  !!}--}}

                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>




    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            {{--<div class="user-panel">--}}
                {{--<div class="pull-left image">--}}
                    {{--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />--}}
                {{--</div>--}}
                {{--<div class="pull-left info">--}}
                    {{--<p>Alexander Pierce</p>--}}
                    {{--<!-- Status -->--}}
                    {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            <!-- search form (Optional) -->
            {{--<form action="#" method="get" class="sidebar-form">--}}
                {{--<div class="input-group">--}}
                    {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
              {{--<span class="input-group-btn">--}}
                {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
              {{--</span>--}}
                {{--</div>--}}
            {{--</form>--}}
            <!-- /.search form -->

            <!-- Sidebar Menu -->


            <ul class="sidebar-menu">

            @if(Auth::user()->role_id == 1)
                    <li><a href="/password">Change Password</a></li>
                <li><a href="/users">Users</a></li>

                    {{--<li><a href="/roles">Roles</a></li>--}}

                {{--<li><a href="/service-providers">Service Providers</a></li>--}}
                {{--<li><a href="/partners">Partners</a></li>--}}

                <li><a href="/countries">Countries</a></li>
                    {{--<li><a href="/app-menus">App Menus</a></li>--}}
                {{--<li><a href="/help-managements">Help Managements</a></li>--}}
                <li><a href="/advertisements">Advertisements</a></li>

                    {{--<li><a href="/home-menus">Home Menus</a></li>--}}
                {{--<li><a href="/home-sub-menus">Home Sub Menus</a></li>--}}
                <li><a href="/mobile-apis">Mobile API</a></li>

                <li><a href="/service-provider-api">Service Provider API</a></li>


                <li><a href="/approved-partners">Approved Partners</a></li>

                {{--<li><a href="/partner-service-categories">Partner Service Categories</a></li>--}}
                {{--<li><a href="/partner-services">Partner Service Categories</a></li>--}}

                {{--<li><a href="/support-managements">Support Managements</a></li>--}}
                {{--<li><a href="/roaming-tips">Roaming Tips</a></li>--}}

            @elseif(Auth::user()->role_id == 2)


                    <li><a href="/profile">Update Information</a></li>
                    <li><a href="/password">Change Password</a></li>


                    <li><a href="/partners">Partners</a></li>

                    <li><a href="/app-menus">App Menus</a></li>
                    <li><a href="/advertisements">Advertisements</a></li>
                    <li><a href="/roaming-tips">Roaming Tips</a></li>
                    <li><a href="/home-menus">Home Menus</a></li>
                    <li><a href="/home-sub-menus">Home Sub Menus</a></li>
                    <li><a href="/support-managements">Support Managements</a></li>
                    <li><a href="/help-managements">Help Managements</a></li>


            @elseif(Auth::user()->role_id == 3)
                    <li><a href="/profile">Update Information</a></li>
                    <li><a href="/password">Change Password</a></li>
                    <li><a href="/service-categories">Service Categories</a></li>
                    <li><a href="/partner-services">Partner Services</a></li>
            @endif
                <li><a href="/logout">Logout</a></li>
            </ul>


            {{--<ul class="sidebar-menu">--}}
                {{--<li class="header">HEADER</li>--}}
                {{--<!-- Optionally, you can add icons to the links -->--}}
                {{--<li class="active"><a href="#"><i class='fa fa-link'></i> <span>Link</span></a></li>--}}
                {{--<li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>--}}
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="#">Link in level 2</a></li>--}}
                        {{--<li><a href="#">Link in level 2</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul><!-- /.sidebar-menu -->--}}
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">

    {{----}}
    {{--<aside class="main-sidebar">--}}

        {{--<!-- sidebar: style can be found in sidebar.less -->--}}
        {{--<section class="sidebar">--}}

            {{--<!-- Sidebar user panel (optional) -->--}}
            {{--<div class="user-panel">--}}
                {{--<div class="pull-left image">--}}
                    {{--<img src="{{ URL::asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />--}}
                {{--</div>--}}
                {{--<div class="pull-left info">--}}
                    {{--<p>Howdy,{{ ucfirst(Auth::user()->username) }}</p>--}}
                    {{--<!-- Status -->--}}
                    {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
                {{--</div>--}}
            {{--</div>--}}




            {{--<ul>--}}
            {{--@if(Auth::user()->role_id == 1)--}}


                    {{--<li><a href="/users">Users</a></li>--}}
                    {{--<li><a href="/roles">Roles</a></li>--}}
                    {{--<li><a href="/advertisements">Advertisements</a></li>--}}
                    {{--<li><a href="/service-providers">Service providers</a></li>--}}


                    {{--<li><a href="/partners">Partners</a></li>--}}


                    {{--<li><a href="/countries">Countries</a></li>--}}
                    {{--<li><a href="/help-managements">Help-managements</a></li>--}}
                    {{--<li><a href="/home-menus">Home-menus</a></li>--}}
                    {{--<li><a href="/mobile-apis">Mobile-apis</a></li>--}}
                    {{--<li><a href="/approved-partners">Approved-partners</a></li>--}}

                    {{--<li><a href="/partner-service-categories">Partner-service-categories</a></li>--}}
                    {{--<li><a href="/partner-services">Partner-service-categories</a></li>--}}
                    {{--<li><a href="/roaming-tips">Roaming-tips</a></li>--}}

                {{--@elseif(Auth::user()->role_id == 2)--}}

                    {{--<li><a href="/advertisements">Advertisements</a></li>--}}
                    {{--<li><a href="/roaming-tips">Roaming-tips</a></li>--}}

                {{--@elseif(Auth::user()->role_id == 3)--}}
                {{--<li><a href="/partner-service-categories">Partner-service-categories</a></li>--}}
                    {{--<li><a href="/partner-services">Partner-service-subcategories</a></li>--}}


                {{--@endif--}}




                   {{--<li><a href="/logout">Logout</a></li>--}}
               {{--</ul>--}}

        {{--</section>--}}
        {{--<!-- /.sidebar -->--}}
    {{--</aside>--}}