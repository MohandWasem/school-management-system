<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
    @livewireStyles
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0"> {{ trans('sidebar_trans.Dashboard_admin') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('Students_trans.Students_count')}}</p>
                                    <h4>{{App\Models\Student::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                href="{{route('Students.index')}}" target="_blank"><span class="text-danger"> {{trans('Students_trans.views')}}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('Teacher_trans.teacher_count')}}</p>
                                    <h4>{{App\Models\Teacher::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a 
                                href="{{route('Teachers.index')}}" target="_blank"><span class="text-danger"> {{trans('Students_trans.views')}}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('Parent_trans.parent_count')}}</p>
                                    <h4>{{App\Models\MyParent::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a 
                                href="{{route('add_parent')}}" target="_blank"><span class="text-danger"> {{trans('Students_trans.views')}}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('classroom_trans.classroom_count')}}</p>
                                    <h4>{{App\Models\Classroom::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a 
                                href="{{route('Sections.index')}}" target="_blank"><span class="text-danger">{{trans('Students_trans.views')}} </span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 class="card-title">{{trans('auth.Latest_operations_on_the_system')}}</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="months-tab" data-toggle="tab"
                                                    href="#months" role="tab" aria-controls="months"
                                                    aria-selected="true"> Months</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="year-tab" data-toggle="tab" href="#year"
                                                    role="tab" aria-controls="year" aria-selected="false">Year
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="months" role="tabpanel"
                                        aria-labelledby="months-tab">
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/05.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Supercharge your motivation</h6>
                                                <p class="sm-mb-5 d-block">I truly believe Augustine’s words are
                                                    true. </p>
                                                <span class="mb-0">by - <b class="text-info">PotenzaUser</b></span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-primary mb-0"><b>45,436</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-secondary mb-0"><b>$05,236</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/02.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Helen keller a teller seller</h6>
                                                <p class="sm-mb-5 d-block">We also know those epic stories,
                                                    those modern.</p>
                                                <span class="mb-0">by - <b class="text-warning">WebminUser</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-success mb-0"><b>23,462</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-danger mb-0"><b>$166</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/03.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">The other virtues practice</h6>
                                                <p class="sm-mb-5 d-block">One of the most difficult aspects of
                                                    achieving. </p>
                                                <span class="mb-0">by - <b class="text-danger">TheCorps</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-warning mb-0"><b>5,566</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-info mb-0"><b>$4,126</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/04.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">You will begin to realise</h6>
                                                <p class="sm-mb-5 d-block">Remind yourself you have nowhere to
                                                    go except. </p>
                                                <span class="mb-0">by - <b class="text-success">PGSinfotech</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-dark mb-0"><b>5,446</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-success mb-0"><b>$436</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="year" role="tabpanel" aria-labelledby="year-tab">
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/09.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Walk out 10 years into</h6>
                                                <p class="sm-mb-5 d-block">Understanding the price and having
                                                    the willingness to pay. </p>
                                                <span class="mb-0">by - <b class="text-danger">TheZayka</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-dark mb-0"><b>12,549</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="theme-color mb-0"><b>$1,656</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/06.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Step out on to the path</h6>
                                                <p class="sm-mb-5 d-block">Success to you and then pull it out
                                                    when you are.</p>
                                                <span class="mb-0">by - <b class="text-info">CarDealer</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-primary mb-0"><b>1,366</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-secondary mb-0"><b>$4,536</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/07.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Briefly imagine that you</h6>
                                                <p class="sm-mb-5 d-block">Motivators for your personality and
                                                    your personal goals. </p>
                                                <span class="mb-0">by - <b class="text-success">SamMartin</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-success mb-0"><b>465</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-danger mb-0"><b>$499</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/08.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">You continue doing what</h6>
                                                <p class="sm-mb-5 d-block">The first thing to remember about
                                                    success is that. </p>
                                                <span class="mb-0">by - <b class="text-warning">Cosntro</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-warning mb-0"><b>4,456</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-info mb-0"><b>$6,485</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
    <div class="row">

        <div  style="height: 400px;" class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border" style="position: relative;">
                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block w-100">
                                <h5 style="font-family: 'Cairo', sans-serif" class="card-title"> {{trans('auth.Latest_operations_on_the_system')}}</h5>
                            </div>
                            <div class="d-block d-md-flex nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                            href="#students" role="tab" aria-controls="students"
                                            aria-selected="true">  {{trans('auth.students')}}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                            role="tab" aria-controls="teachers" aria-selected="false">{{trans('auth.teachers')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                            role="tab" aria-controls="parents" aria-selected="false"> {{trans('auth.parents')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="fee_invoices-tab" data-toggle="tab" href="#fee_invoices"
                                            role="tab" aria-controls="fee_invoices" aria-selected="false">{{trans('auth.invoices')}}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                <div class="tab-content" id="myTabContent">

                    {{--students Table--}}
                    <div class="tab-pane fade active show" id="students" role="tabpanel" aria-labelledby="students-tab">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                <tr  class="table-info text-danger">
                                    <th>#</th>
                                    <th> {{trans('Students_trans.name')}}</th>
                                    <th> {{trans('Students_trans.email')}}</th>
                                    <th>{{trans('Students_trans.gender')}}</th>
                                    <th> {{trans('Students_trans.Grade')}}</th>
                                    <th> {{trans('Students_trans.classrooms')}}</th>
                                    <th>{{trans('Students_trans.section')}}</th>
                                    <th> {{trans('Students_trans.created_at')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$student->Name}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->genders->Name}}</td>
                                        <td>{{$student->grades->Name}}</td>
                                        <td>{{$student->classrooms->Name_classroom}}</td>
                                        <td>{{$student->sections->Name_Section}}</td>
                                        <td class="text-success">{{$student->created_at}}</td>
                                        @empty
                                            <td class="alert-danger" colspan="8"> {{trans('Students_trans.no_info')}}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{--teachers Table--}}
                    <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                <tr  class="table-info text-danger">
                                    <th>#</th>
                                    <th> {{trans('Teacher_trans.Name_Teacher')}}</th>
                                    <th>{{trans('Teacher_trans.Gender')}}</th>
                                    <th> {{trans('Teacher_trans.Joining_Date')}}</th>
                                    <th>{{trans('Teacher_trans.specialization')}}</th>
                                    <th> {{trans('Students_trans.created_at')}}</th>
                                </tr>
                                </thead>

                                @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                                    <tbody>
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$teacher->Name}}</td>
                                        <td>{{$teacher->genders->Name}}</td>
                                        <td>{{$teacher->Joining_Date}}</td>
                                        <td>{{$teacher->specializations->Name}}</td>
                                        <td class="text-success">{{$teacher->created_at}}</td>
                                        @empty
                                            <td class="alert-danger" colspan="8"> {{trans('Students_trans.no_info')}}</td>
                                    </tr>
                                    </tbody>
                                @endforelse
                            </table>
                        </div>
                    </div>

                    {{--parents Table--}}
                    <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                <tr  class="table-info text-danger">
                                    <th>#</th>
                                    <th> {{ trans('Parent_trans.Name_Father') }}</th>
                                    <th> {{ trans('Parent_trans.Email') }}</th>
                                    <th> {{ trans('Parent_trans.National_ID_Father') }}</th>
                                    <th> {{ trans('Parent_trans.Phone_Father') }}</th>
                                    <th> {{trans('Students_trans.created_at')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(\App\Models\MyParent::latest()->take(5)->get() as $parent)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$parent->Name_Father}}</td>
                                        <td>{{$parent->email}}</td>
                                        <td>{{$parent->National_ID_Father}}</td>
                                        <td>{{$parent->Phone_Father}}</td>
                                        <td class="text-success">{{$parent->created_at}}</td>
                                        @empty
                                            <td class="alert-danger" colspan="8"> {{trans('Students_trans.no_info')}}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{--sections Table--}}
                    <div class="tab-pane fade" id="fee_invoices" role="tabpanel" aria-labelledby="fee_invoices-tab">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                <tr  class="table-info text-danger">
                                    <th>#</th>
                                    <th>تاريخ الفاتورة</th>
                                    <th> {{trans('accounts_trans.name_student')}}</th>
                                    <th> {{trans('Students_trans.Grade')}}</th>
                                    <th> {{trans('Students_trans.classrooms')}}</th>
                                    <th> {{trans('accounts_trans.Type_of_fees')}}</th>
                                    <th>{{trans('accounts_trans.amount')}}</th>
                                    <th> {{trans('Students_trans.created_at')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(\App\Models\Feeinvoice::latest()->take(10)->get() as $Fee_invoice)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$Fee_invoice->invoice_date}}</td>
                                        <td>{{$Fee_invoice->student->Name}}</td>
                                        <td>{{$Fee_invoice->Grade->Name}}</td>
                                        <td>{{$Fee_invoice->Classroom->Name_classroom}}</td>
                                        <td>{{$Fee_invoice->Fee->Name}}</td>
                                        <td>{{ number_format($Fee_invoice->amount, 2) }}</td>
                                        <td class="text-success">{{$Fee_invoice->created_at}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="alert-danger" colspan="8">  {{trans('Students_trans.no_info')}}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        </div>

                    </div>

                </div>
             </div>
             </div>
             </div>
            </div>


            <livewire:calendar />

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

</body>

</html>
