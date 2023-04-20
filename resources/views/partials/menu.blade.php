<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a> 
        @php 
        $s =  App\Repositories\SettingRepo::all();
        $s = $s->flatMap(function($s){
            return [$s->type => $s->description];
        });
        @endphp
        <div class="">
            <img style="width:" height="48px" src="{{ $s['logo'] }}" alt="">
        </div>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div> 
    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38" class="rounded-circle" alt="photo"></a>
                    </div>
                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i> &nbsp;{{ 
                                Auth::user()->user_type=='super_admin'?'Admin':(Auth::user()->user_type=='admin'?'Ban giám hiệu':(Auth::user()->user_type=='teacher'?'Giáo viên':(Auth::user()->user_type=='parent'?'Phụ huynh':'Học sinh')))
                            }}
                        </div>
                    </div>
                    <div class="ml-3 align-self-center">
                        <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li> 
                 
                <li class="nav-inamtem">
                    <a href="{{ route('gift.index') }}" class="nav-link {{ (Route::is('gift.index')) ? 'active' : '' }}"><i class="icon-book2"></i> <span>Danh sách quà </span></a>
                </li> 
                <li class="nav-inamtem">
                    <a href="{{ route('member.index') }}" class="nav-link {{ (Route::is('member.index')) ? 'active' : '' }}"><i class="icon-user"></i> <span>Quản lý khách hàng </span></a>
                </li> 
                <li class="nav-inamtem">
                    <a href="{{ route('settings') }}" class="nav-link {{ (Route::is('settings')) ? 'active' : '' }}"><i class="icon-cog3"></i> <span>Cài đặt chung </span></a>
                </li> 
            </ul>
        </div>
    </div>
</div>
