<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('sidebar_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('sidebar_trans.Components')}} </li>

        <!-- الاقسام-->
        <li>
            <a href="{{route('sections.index')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">الاقسام</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('studentDash.index')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">الطلاب</span></a>
        </li>


        <!-- Quizze-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Quizze-menu">
                <div class="pull-left"><i class="fas fa-book-open"></i><span
                        class="right-nav-text">{{trans('Students_trans.quizzes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Quizze-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('Quizz.index')}}"> {{trans('Students_trans.quizzes_list')}}</a></li>
                <li><a href="#"> {{trans('Students_trans.List_questions')}}</a></li>
            </ul>

        </li>

        <!-- reports-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">التقارير</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('attendanceReport.index')}}">تقرير الحضور والغياب</a></li>
                <li><a href="#">تقرير الامتحانات</a></li>
            </ul>

        </li>

        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('Students_trans.online_courses')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('ZoomOnline.index')}}"> {{trans('Students_trans.online_courses_with_zoom')}}</a> </li>
            </ul>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text"> {{trans('sidebar_trans.profile_teacher')}}</span></a>
        </li>

    </ul>
</div>
