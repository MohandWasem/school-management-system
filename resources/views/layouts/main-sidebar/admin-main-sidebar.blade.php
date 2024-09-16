<ul class="nav navbar-nav side-menu" id="sidebarnav">
    <!-- menu item Dashboard-->
    <li>
        <a href="{{route('dashboard')}}">
            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('sidebar_trans.Dashboard') }}</span>
            </div>
            <div class="clearfix"></div>
        </a>
    </li>
    <!-- menu title -->
    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('sidebar_trans.Components') }} </li>
    <!--  Grades-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
            <div class="pull-left"><i class="ti-palette"></i><span
                    class="right-nav-text">{{ trans('sidebar_trans.Grades') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="elements" class="collapse" data-parent="#sidebarnav">
            <li><a href="{{route('Grades')}}">{{ trans('sidebar_trans.Grades_list') }}</a></li>
        </ul>
    </li>
    <!--  Classrooms-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Classrooms">
            <div class="pull-left"><i class="ti-palette"></i><span
                    class="right-nav-text">{{ trans('sidebar_trans.Classrooms') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Classrooms" class="collapse" data-parent="#sidebarnav">
            <li><a href="{{route('Classrooms.index')}}">{{ trans('sidebar_trans.Classrooms_list') }}</a></li>
        </ul>
    </li>
    <!--  Sections-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Sections">
            <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{trans('Sections_trans.title_page')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Sections" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Sections.index')}}">{{trans('Sections_trans.List_Section')}}</a> </li>
        </ul>
    </li>

    <!--  Students-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user-graduate"></i>{{trans('Students_trans.Students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
        <ul id="students-menu" class="collapse">
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('Students_trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                <ul id="Student_information" class="collapse">
                    <li> <a href="{{route('Students.create')}}">{{trans('Students_trans.add_Students')}}</a></li>
                    <li> <a href="{{route('Students.index')}}">{{trans('Students_trans.List_Students')}}</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('Students_trans.Students_Promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                <ul id="Students_upgrade" class="collapse">
                    <li> <a href="{{route('Promotion.index')}}">{{trans('Students_trans.Students_Promotions_add')}}</a></li>
                    <li> <a href="{{route('Promotion.create')}}">{{trans('Students_trans.Students_Promotions_managment')}}</a> </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('Students_trans.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                <ul id="Graduate students" class="collapse">
                    <li> <a href="{{route('Graduated.create')}}">{{trans('Students_trans.add_Graduate')}}</a> </li>
                    <li> <a href="{{route('Graduated.index')}}">{{trans('Students_trans.list_Graduate')}}</a> </li>
                </ul>
            </li>
        </ul>
    </li>

    <!--  Teachers-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers">
            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                    class="right-nav-text">{{trans('Teacher_trans.title_page')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Teachers" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Teachers.index')}}">{{trans('Teacher_trans.List_Teachers')}}</a> </li>
        </ul>
    </li>

    <!--  Parents-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents">
            <div class="pull-left"><i class="fas fa-user-tie"></i><span
                    class="right-nav-text">{{trans('Parent_trans.title_page')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Parents" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('add_parent')}}">{{trans('Parent_trans.List_Parent')}}</a> </li>
            {{-- <li> <a href="{{route('add_parent')}}">{{trans('Parent_trans.add_parent')}}</a> </li> --}}
        </ul>
    </li>

    <!--  accounts-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#accounts">
            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                    class="right-nav-text">{{trans('sidebar_trans.accounts')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="accounts" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Fees.index')}}">{{trans('sidebar_trans.fees')}}</a> </li>
            <li> <a href="{{route('FeeInvoice.index')}}">{{trans('accounts_trans.fee_invoices')}}</a> </li>
            <li> <a href="{{route('ReceiptStudent.index')}}">{{trans('Students_trans.receipt_student')}}</a> </li>
            <li> <a href="{{route('ProcessingFee.index')}}">{{trans('Students_trans.processing_fee')}}</a> </li>
            <li> <a href="{{route('PaymentStudent.index')}}">{{trans('Students_trans.PaymentStudent')}}</a> </li>
        </ul>
    </li>


    <!-- Attendance-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
            <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('sidebar_trans.Attendance')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Attendance.index')}}"> {{trans('Students_trans.List_Students')}}</a> </li>
        </ul>
    </li>

    <!-- Subjects-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">
            <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text"> {{trans('sidebar_trans.subjects')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Subjects" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('subjects.index')}}"> {{trans('sidebar_trans.subjects_list')}}</a> </li>
        </ul>
    </li>

     <!-- Quizzes-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
            <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('Students_trans.quizzes')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Quizzes.index')}}"> {{trans('Students_trans.quizzes_list')}}</a> </li>
            <li> <a href="{{route('Questions.index')}}"> {{trans('Students_trans.list_question')}}</a> </li>
        </ul>
    </li>
    <!-- library-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
            <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('sidebar_trans.library')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Library.index')}}">{{trans('sidebar_trans.library_list')}} </a> </li>
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
            <li> <a href="{{route('onlineClasses.index')}}"> {{trans('Students_trans.online_courses_with_zoom')}}</a> </li>
        </ul>
    </li>

     <!-- Settings-->
    <li>
        <a href="{{route('Settings.index')}}"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('sidebar_trans.Settings')}} </span></a>
    </li>

        </ul>
    </li>
</ul>