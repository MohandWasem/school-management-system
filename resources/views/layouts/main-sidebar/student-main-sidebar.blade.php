<ul class="nav navbar-nav side-menu" id="sidebarnav">
    <!-- menu item Dashboard-->
    <li>
        <a href="{{ url('/student/dashboard') }}">
            <div class="pull-left"><i class="ti-home"></i><span
                    class="right-nav-text">{{ trans('sidebar_trans.Dashboard') }}</span>
            </div>
            <div class="clearfix"></div>
        </a>
    </li>
    <!-- menu title -->
    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('sidebar_trans.Components') }} </li>


    <!-- الامتحانات-->
    <li>
        <a href="{{route('Exams.index')}}"><i class="fas fa-book-open"></i><span
            class="right-nav-text">{{trans('sidebar_trans.tests')}}</span></a>
    </li>


    <!-- Settings-->
    <li>
        <a href="{{route('profile.student')}}"><i class="fas fa-id-card-alt"></i><span
            class="right-nav-text"> {{trans('sidebar_trans.profile_teacher')}}</span></a>
    </li>

</ul>