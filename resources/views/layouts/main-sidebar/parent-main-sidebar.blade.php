<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('parent/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('sidebar_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('sidebar_trans.Components') }}  </li>


        <!-- الابناء-->
        <li>
            <a href="{{route('children.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('sidebar_trans.childern')}}</span></a>
        </li>

        <!-- تقرير الحضور والغياب-->
        <li>
            <a href="{{route('attendance.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('sidebar_trans.report_childern')}}</span></a>
        </li>

        <!-- تقرير المالية -->
        <li>
            <a href="{{route('fees.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('sidebar_trans.report_money')}}</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{route('profile.parent')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text"> {{trans('sidebar_trans.profile_teacher')}}</span></a>
        </li>

    </ul>
</div>