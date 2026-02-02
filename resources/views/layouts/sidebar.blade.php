<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="35">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" style="margin-top: 25px" height="35">
            </span>
        </a>

        <a href="{{route('dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="35">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" style="margin-top: 25px" height="35">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="uil-home-alt"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{route('testimonial')}}">
                        <i class="uil-comment-alt-message"></i>
                        Testimonial
                    </a>
                </li>
                
                <li>
                    <a href="{{route('product')}}">
                        <i class="uil-comment-alt-message"></i>
                        Product
                    </a>
                </li>

                <li>
                    <a href="{{route('service')}}">
                        <i class="uil-comment-alt-message"></i>
                        Service
                    </a>
                </li>
                 <li>
                    <a href="{{route('inquiry')}}">
                        <i class="uil-comment-alt-message"></i>
                        Inquiry
                    </a>
                </li>
                

                {{--<li>
                    <a href="{{route('faq')}}">
                        <i class="uil-comment-alt-message"></i>
                        Faq
                    </a>
                </li>


                <li>
                    <a href="{{route('general-setting')}}">
                        <i class="uil-comment-alt-message"></i>
                        General Setting
                    </a>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
