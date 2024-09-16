
@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{trans('Students_trans.quizzes_list')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('Students_trans.quizzes_list')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{trans('Students_trans.quizzes_list')}}</li>
                </ol>
            </div>
        </div>
    </div>
    @section('PageTitle')
    {{trans('Students_trans.quizzes_list')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{trans('Students_trans.matreial')}} </th>
                                            <th> {{trans('Students_trans.name_quizz')}}</th>
                                            <th> {{trans('Students_trans.open_or_exam_degree')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->Name}}</td>
                                                <td>{{$quizze->Name}}</td>
                                                <td>
                                                    {{-- @if ($quizze->degree->count() > 0 && $quizze->id == $quizze->degree[0]->quizz_id)
                                                        {{$quizze->degree[0]->score}}
                                                    @else
                                                        <a href="{{route('Exams.show',$quizze->id)}}"
                                                            class="btn btn-outline-success btn-sm" role="button"
                                                            aria-pressed="true" onclick="alertAbuse()">
                                                            <i class="fas fa-person-booth"></i></a>
                                                    @endif --}}

                                                    @php
                                                        // احصل على أول درجة مسجلة للاختبار (إن وجدت)
                                                        $firstDegree = $quizze->degree->first(); 
                                                    @endphp

                                                    @if ($firstDegree && $firstDegree->quizz_id == $quizze->id)
                                                        <!-- عرض درجة الطالب -->
                                                        {{ $firstDegree->score }}
                                                    @else
                                                        <!-- عرض زر للانتقال إلى صفحة الاختبار -->
                                                        <a href="{{ route('Exams.show', $quizze->id) }}"
                                                            class="btn btn-outline-success btn-sm" 
                                                            role="button"
                                                            aria-pressed="true" 
                                                            onclick="alertAbuse()">
                                                            <i class="fas fa-person-booth"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        function alertAbuse() {
            alert("برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك ");
        }
    </script>

@endsection